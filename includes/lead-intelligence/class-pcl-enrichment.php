<?php
/**
 * PCL_Enrichment — Claude web_search enrichment for leads
 *
 * Called from PCL_Handler::ajax_run_enrichment() in a background PHP process.
 * Runs synchronously in its own worker (1-2 minutes) — NOT in the user request.
 *
 * Flow:
 *  1. Mark lead as 'researching'
 *  2. Call Claude API (sonnet-4-5 + web_search, max_tokens 4096)
 *  3. Parse JSON from response
 *  4. Save to pc_lead_intel table
 *  5. Send enriched admin email via PCL_Mailer
 *
 * Fallback:
 *  - On API error or bad JSON → send BASIC admin email (no intel block)
 *  - On 429 rate limit → reset lead to 'new' + schedule cron retry in 90s
 */

defined('ABSPATH') || exit;

class PCL_Enrichment {

    const CLAUDE_API = 'https://api.anthropic.com/v1/messages';
    const MODEL      = 'claude-sonnet-4-5';
    const TIMEOUT    = 120;

    /**
     * Main entry point — processes one lead.
     */
    public static function process($lead_id) {
        $lead_id = (int) $lead_id;
        $lead = PCL_DB::get_lead($lead_id);

        if (!$lead) {
            error_log("PCL_Enrichment: lead $lead_id not found");
            return;
        }

        // Check API key (reuses PolicyGPT's key)
        if (!defined('PCGPT_API_KEY') || empty(PCGPT_API_KEY)) {
            error_log('PCL_Enrichment: PCGPT_API_KEY not defined');
            PCL_DB::update_status($lead_id, 'failed');
            self::send_fallback_admin_email($lead_id);
            return;
        }

        // Mark as researching
        PCL_DB::update_status($lead_id, 'researching');

        // Call Claude
        $result = self::call_claude($lead, PCGPT_API_KEY);

        if (is_wp_error($result)) {
            $msg = $result->get_error_message();
            error_log("PCL_Enrichment: API error for lead $lead_id — $msg");

            // Rate limit → reset + retry in 90s via cron
            if (strpos($msg, '429') !== false || stripos($msg, 'rate_limit') !== false) {
                PCL_DB::update_status($lead_id, 'new');
                if (!wp_next_scheduled(PCL_CRON_HOOK, array($lead_id))) {
                    wp_schedule_single_event(time() + 90, PCL_CRON_HOOK, array($lead_id));
                }
                error_log("PCL_Enrichment: rate-limited, retry in 90s for lead $lead_id");
                return;
            }

            // Permanent failure → fallback to basic admin email
            PCL_DB::update_status($lead_id, 'failed');
            self::send_fallback_admin_email($lead_id);
            return;
        }

        list($enrichment, $raw_body) = $result;

        // Save enrichment to DB — this MUST succeed before we mark enriched
        $saved = PCL_DB::save_intel($lead_id, $enrichment, $raw_body);

        if (!$saved) {
            error_log("PCL_Enrichment: save_intel failed for lead $lead_id — sending FALLBACK admin email (no intel block)");
            PCL_DB::update_status($lead_id, 'failed');
            self::send_fallback_admin_email($lead_id);
            return;
        }

        PCL_DB::update_status($lead_id, 'enriched');

        // Send enriched admin email
        $fresh_lead = PCL_DB::get_lead($lead_id);
        $intel      = PCL_DB::get_intel($lead_id);

        if (!$intel) {
            error_log("PCL_Enrichment: intel row missing after save for lead $lead_id — sending fallback");
            self::send_fallback_admin_email($lead_id);
            return;
        }

        $sent = PCL_Mailer::send_admin_notification($fresh_lead, $intel);

        if ($sent) {
            PCL_DB::update_status($lead_id, 'enriched', array('admin_email_sent' => 1));
        }

        error_log(sprintf(
            'PCL_Enrichment: lead %d enriched, confidence=%d%%, admin_email=%s',
            $lead_id,
            $enrichment['overall_confidence'] ?? 0,
            $sent ? 'sent' : 'failed'
        ));
    }

    /**
     * Fallback: send basic admin email without intel block.
     */
    private static function send_fallback_admin_email($lead_id) {
        $lead = PCL_DB::get_lead($lead_id);
        if (!$lead) return;
        $sent = PCL_Mailer::send_admin_notification($lead, null);
        if ($sent) {
            PCL_DB::update_status($lead_id, 'failed', array('admin_email_sent' => 1));
        }
    }

    /**
     * Call Claude API with web_search tool enabled.
     */
    private static function call_claude($lead, $api_key) {
        $payload = array(
            'model'      => self::MODEL,
            'max_tokens' => 4096,
            'tools'      => array(
                array('type' => 'web_search_20250305', 'name' => 'web_search'),
            ),
            'system'     => self::build_system_prompt(),
            'messages'   => array(
                array('role' => 'user', 'content' => self::build_user_message($lead)),
            ),
        );

        $response = wp_remote_post(self::CLAUDE_API, array(
            'timeout' => self::TIMEOUT,
            'headers' => array(
                'Content-Type'      => 'application/json',
                'x-api-key'         => $api_key,
                'anthropic-version' => '2023-06-01',
            ),
            'body' => wp_json_encode($payload),
        ));

        if (is_wp_error($response)) {
            return $response;
        }

        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($code !== 200) {
            return new WP_Error('api_error', "Claude API returned HTTP $code: $body");
        }

        $decoded = json_decode($body, true);
        if (!is_array($decoded)) {
            return new WP_Error('parse_error', 'Could not decode Claude API response');
        }

        // Extract text from Claude's content blocks (skip tool_use blocks)
        $text_parts = array();
        foreach ($decoded['content'] ?? array() as $block) {
            if (($block['type'] ?? '') === 'text' && !empty($block['text'])) {
                $text_parts[] = $block['text'];
            }
        }
        $text = implode("\n", $text_parts);

        $enrichment = self::parse_json($text);
        if (!$enrichment) {
            return new WP_Error('json_error', 'Could not parse enrichment JSON from: ' . substr($text, 0, 300));
        }

        return array($enrichment, $body);
    }

    /**
     * System prompt — tuned for PolicyCentral.ai's target buyer.
     *
     * PolicyCentral.ai is a Gen AI policy management platform for large enterprises.
     * It handles HR policies, IT policies, compliance manuals, SOPs, corporate updates,
     * branch circulars, product info, BRDs. Target customers span BFSI, large corporates,
     * and any organisation with 500+ employees that needs to manage internal policies.
     *
     * Target buyers: CHROs, HR Heads, Admin Heads, CCOs, CISOs, CIOs, IT Heads.
     */
    private static function build_system_prompt() {
        return <<<PROMPT
You are a B2B sales intelligence assistant for PolicyCentral.ai, an enterprise policy management SaaS platform.

ABOUT POLICYCENTRAL.AI:
PolicyCentral.ai is a Gen AI-powered platform for creating, publishing, distributing, tracking, and managing organisational policies. It handles HR policies, IT policies, compliance manuals, SOPs, corporate updates, branch circulars, product information, and BRDs. Flagship customers include HDFC Life, Kotak Mahindra Bank, SBI Life Insurance, L&T Financial Services, Reliance Nippon Life Insurance, and Arohan Financial Services.

The sweet spot is large enterprises (500+ employees) where scattered policies across email/shared drives cause compliance gaps. BFSI is strongest, but any sector with many employees + compliance obligations works (manufacturing, pharma, healthcare, IT services, retail chains, etc.).

TARGET BUYERS: CHROs, HR Heads, Admin Heads, Chief Compliance Officers, CISOs, CIOs, IT Heads, Company Secretaries.

YOUR JOB:
Research the given lead on the web and return a structured intelligence report that a sales rep can use to have a sharp, personalised first conversation.

CRITICAL: Return ONLY valid JSON — no markdown, no code fences, no preamble, no explanation. Raw JSON object only.

RESEARCH PRIORITIES (in order):
1. **Company profile** — What do they do? Industry? HQ? Year founded? Public or private? Approximate employee count (critical — drives deal size).
2. **Scale indicators** — Number of branches/offices/locations, geographic footprint, revenue if disclosed, any recent growth signals (expansion, new offices, hiring sprees).
3. **Tech stack** — What HRMS/intranet/LMS do they use? Any public signals about their IT systems (Darwinbox, Keka, Workday, SAP SuccessFactors, Oracle HCM, Zoho People, etc.)? Do they have a branded employee portal? What cloud platform (AWS, Azure, GCP)?
4. **Policy management signals** — Any public policy pages? Signs of policy management pain (outdated policies, inconsistent handbooks, compliance issues, regulatory actions)? Recent audits, fines, regulatory notices?
5. **Recent corporate news** — M&A, funding, new leadership appointments, IPO, expansion, restructuring. These ALL create policy management needs (you must update/harmonise policies during any of these).
6. **Funding** — Recent rounds, total raised, investors. Funded companies are in growth mode and typically modernise their HR/compliance tech.
7. **The person** — LinkedIn URL, likely designation based on name + company. Categorise their role type: 'hr' / 'compliance' / 'security' / 'it' / 'admin' / 'leadership' / 'other'.
8. **Pain points** — Based on research, identify 2-3 specific policy management pain points this company likely has RIGHT NOW.
9. **Conversation starters** — Craft 2-3 highly specific, personalised opening lines for a sales call. Reference real things — recent news, known systems, specific regulatory events affecting their industry.

Return this EXACT JSON structure. If a field is unknown, use null. Never invent data.

{
  "person": {
    "found": true,
    "linkedin_url": "full URL or null",
    "likely_designation": "inferred role or null",
    "role_type": "hr|compliance|security|it|admin|leadership|other",
    "accuracy": 80
  },
  "company": {
    "name": "official company name",
    "description": "2-3 sentence description of what they do",
    "website": "URL or null",
    "industry": "sector (e.g., Banking, Manufacturing, IT Services)",
    "size": "headcount tier (e.g., 500-1000, 1000-5000, 5000+)",
    "employee_count": "more precise estimate if known, e.g., '~3,200' or null",
    "founded": "year or null",
    "hq": "city, state",
    "accuracy": 85
  },
  "tech_stack": ["list", "of", "known", "systems"],
  "hr_systems": "HRMS/intranet/portal if identified, or null",
  "funding": {
    "found": false,
    "summary": "description or null",
    "latest_round": "Series A etc or null",
    "amount": "amount with currency or null",
    "date": "approximate date or null",
    "investors": [],
    "accuracy": 0
  },
  "news": [
    {
      "headline": "short headline",
      "date": "approximate date",
      "relevance": "why this matters for a policy management pitch",
      "accuracy": 75
    }
  ],
  "pain_points": [
    "specific pain point based on research"
  ],
  "conversation_starters": [
    "specific, personalised talking point referencing something real you found"
  ],
  "overall_confidence": 78,
  "research_note": "one sentence on data quality and any gaps"
}
PROMPT;
    }

    /**
     * User message — constructs the research request from the lead data.
     */
    private static function build_user_message($lead) {
        $parts = array("Research this lead for PolicyCentral.ai's sales team:");

        if (!empty($lead->full_name))  $parts[] = "Name: {$lead->full_name}";
        if (!empty($lead->company))    $parts[] = "Company: {$lead->company}";
        if (!empty($lead->email))      $parts[] = "Email domain: " . substr(strrchr($lead->email, '@'), 1);
        if (!empty($lead->phone))      $parts[] = "Phone: {$lead->phone}";
        if (!empty($lead->geo_city) && $lead->geo_city !== 'Local/Dev') {
            $parts[] = "Location (from IP): " . trim($lead->geo_city . ', ' . $lead->geo_region . ', ' . $lead->geo_country, ', ');
        }
        if (!empty($lead->message)) {
            $parts[] = "Their message: \"" . substr($lead->message, 0, 500) . "\"";
        }

        $parts[] = "";
        $parts[] = "Search the web thoroughly. Find the person on LinkedIn, profile the company, identify their tech stack and policy management pain points, and craft sharp conversation starters. Return ONLY the JSON — no markdown, no explanation.";

        return implode("\n", $parts);
    }

    /**
     * Robust JSON extraction — handles raw JSON, markdown fences, or embedded JSON.
     */
    private static function parse_json($text) {
        if (!$text) return null;

        // Direct parse
        $decoded = json_decode(trim($text), true);
        if (is_array($decoded) && isset($decoded['overall_confidence'])) {
            return $decoded;
        }

        // Strip markdown code fence
        if (preg_match('/```(?:json)?\s*(\{.+\})\s*```/s', $text, $m)) {
            $decoded = json_decode(trim($m[1]), true);
            if (is_array($decoded)) return $decoded;
        }

        // Extract first { to last }
        $start = strpos($text, '{');
        $end   = strrpos($text, '}');
        if ($start !== false && $end !== false && $end > $start) {
            $json_str = substr($text, $start, $end - $start + 1);
            $decoded  = json_decode($json_str, true);
            if (is_array($decoded)) return $decoded;
        }

        return null;
    }
}
