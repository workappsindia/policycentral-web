<?php
/**
 * Policy Library — AI enhancements for the personalized PDF ("PolicyCentral AI").
 *
 * Generates a plain-language summary and a couple of top-up FAQs for a policy,
 * cached PER-POLICY in post meta so the expensive Claude call happens once per
 * policy (on the first lead) and every later requester reuses the cache. Content
 * is generated generically with the [Company Name] placeholder intact, so the PDF
 * builder personalizes it at render time via the same swap as the body.
 *
 * Fails soft by design: every public method returns '' / [] on any error (no
 * exceptions), so the PDF is always delivered even if the API is unavailable.
 * Model matches the rest of the site (claude-sonnet-4-5) on PCGPT_API_KEY.
 */
defined('ABSPATH') || exit;

class PCPL_AI {

    const MODEL   = 'claude-sonnet-4-5';
    const API     = 'https://api.anthropic.com/v1/messages';
    const TIMEOUT  = 120;
    const BODY_MAX = 8000; // chars of policy text fed to the model

    /** Cached-or-generated summary (string; '' on failure). */
    public static function get_summary($post_id, array $policy) {
        $cached = get_post_meta($post_id, '_pcpl_ai_summary', true);
        if (is_string($cached) && $cached !== '') return $cached;

        $system = "You write concise, plain-language executive summaries of corporate policy documents for PolicyCentral.ai. "
            . "Write 3 to 4 sentences, neutral and professional, American spelling, no markdown, no headings, no bullet points. "
            . "Summarize only what the policy actually says; do not invent specifics. "
            . "When you refer to the organization, write it exactly as [Company Name] (keep the square brackets) so it can be personalized.";
        $user = "Summarize this policy in 3 to 4 sentences for a busy reader who wants the gist.\n\n"
            . "Title: " . $policy['title'] . "\n\nPolicy content:\n" . self::plain_body($policy);

        $text = self::call($system, $user, 500);
        if ($text === '') return '';
        $text = trim(preg_replace('/\s+/', ' ', $text));
        update_post_meta($post_id, '_pcpl_ai_summary', $text);
        return $text;
    }

    /** Cached-or-generated top-up FAQs (array of {q,a}; [] on failure). */
    public static function get_faqs_topup($post_id, array $policy) {
        $cached = get_post_meta($post_id, '_pcpl_ai_faqs', true);
        if (is_array($cached) && $cached) return $cached;

        $existing = array();
        foreach (($policy['faqs'] ?? array()) as $f) {
            if (!empty($f['q'])) $existing[] = '- ' . $f['q'];
        }
        $existing_str = $existing ? implode("\n", $existing) : '(none)';

        $system = "You generate helpful FAQ pairs about a corporate policy for PolicyCentral.ai. "
            . "Output ONLY a JSON array of 2 to 3 objects, each with keys \"q\" and \"a\". "
            . "Answers are 1 to 3 sentences, plain text, American spelling, grounded in the policy, no markdown. "
            . "Do NOT duplicate or paraphrase the existing questions provided. "
            . "When referring to the organization, write it as [Company Name] (keep the brackets).";
        $user = "Policy title: " . $policy['title'] . "\n\n"
            . "Existing FAQ questions (do not duplicate these):\n" . $existing_str . "\n\n"
            . "Policy content:\n" . self::plain_body($policy) . "\n\n"
            . "Return 2 to 3 NEW FAQ pairs as a JSON array only.";

        $text = self::call($system, $user, 900);
        if ($text === '') return array();

        $faqs = self::parse_faqs($text);
        if (!$faqs) return array();
        update_post_meta($post_id, '_pcpl_ai_faqs', $faqs);
        return $faqs;
    }

    /**
     * Translate the policy body HTML into $lang_name, preserving markup.
     * Cached per policy+language in meta (_pcpl_tr_{code}). Returns '' on failure.
     */
    public static function translate($post_id, array $policy, $lang_code, $lang_name) {
        $meta_key = '_pcpl_tr_' . preg_replace('/[^a-z]/', '', strtolower($lang_code));
        $cached = get_post_meta($post_id, $meta_key, true);
        if (is_string($cached) && $cached !== '') return $cached;

        $system = "You are a professional translator specializing in corporate policy documents. "
            . "Translate the visible text of the given HTML into {$lang_name}. "
            . "CRITICAL RULES: (1) Preserve every HTML tag and attribute exactly as-is; translate ONLY the human-readable text between tags. "
            . "(2) Wherever the source refers to the organization as [Company Name], or as [Company Name] (\"the Company\"), render it in prose simply as the natural {$lang_name} equivalent of \"the Company\". Do NOT output any bracketed placeholder like [Company Name], and do NOT add an alias in parentheses. "
            . "(3) In email addresses or domains such as [Company Name].com, replace [Company Name] with the literal text yourcompany so the address stays valid (e.g. support@yourcompany.com). "
            . "(4) Keep other URLs and legal section numbers unchanged. "
            . "(5) Use natural, professional {$lang_name} appropriate for an official HR/compliance policy. "
            . "Output ONLY the translated HTML, with no preamble, notes, or code fences.";
        $user = (string) ($policy['body'] ?? '');
        if ($user === '') return '';

        $text = self::call($system, $user, 8000);
        if ($text === '') return '';
        $text = trim($text);
        if (preg_match('/```(?:html)?\s*(.+?)```/is', $text, $m)) $text = trim($m[1]);
        update_post_meta($post_id, $meta_key, $text);
        return $text;
    }

    /**
     * Structured "policy at a glance" infographic content, cached per policy in
     * _pcpl_ai_infographic. Returns [] on failure. The visual layout is rendered
     * client-side from this data (templated), so the model only supplies content.
     */
    public static function infographic($post_id, array $policy) {
        $cached = get_post_meta($post_id, '_pcpl_ai_infographic', true);
        if (is_array($cached) && $cached) return $cached;

        $system = "You are a content designer creating a one-glance visual summary (infographic) of a corporate policy for PolicyCentral.ai. "
            . "Output ONLY a JSON object with these keys: "
            . "\"headline\" (a punchy title, max 8 words), "
            . "\"summary\" (one sentence, max 20 words), "
            . "\"takeaways\" (an array of 4 to 6 objects, each {\"title\": 2-4 words, \"text\": one sentence}), "
            . "\"stats\" (an array of 0 to 3 objects {\"value\": short e.g. \"2 days\", \"label\": what it measures}; include ONLY if the policy states concrete numbers or timeframes, otherwise []). "
            . "Ground everything in the policy. Use [Company Name] for the organization. Plain text, American spelling, no markdown. "
            . "Write numeric ranges as \"X to Y\" (e.g. \"7 to 15 days\"); never use a hyphen or dash for a range. JSON only.";
        $user = "Policy title: " . $policy['title'] . "\n\nPolicy content:\n" . self::plain_body($policy);

        $text = self::call($system, $user, 1200);
        if ($text === '') return array();
        if (preg_match('/```(?:json)?\s*(.+?)```/is', $text, $m)) $text = trim($m[1]);
        if (preg_match('/\{.*\}/s', $text, $m)) $text = $m[0];
        $data = json_decode($text, true);
        if (!is_array($data) || empty($data['takeaways']) || !is_array($data['takeaways'])) return array();

        // Normalize.
        $clean = array(
            'headline'  => isset($data['headline']) ? trim((string) $data['headline']) : $policy['title'],
            'summary'   => isset($data['summary']) ? trim((string) $data['summary']) : '',
            'takeaways' => array(),
            'stats'     => array(),
        );
        foreach ($data['takeaways'] as $t) {
            $title = isset($t['title']) ? trim((string) $t['title']) : '';
            $txt   = isset($t['text'])  ? trim((string) $t['text'])  : '';
            if ($title !== '' && $txt !== '') $clean['takeaways'][] = array('title' => $title, 'text' => $txt);
        }
        if (!empty($data['stats']) && is_array($data['stats'])) {
            foreach ($data['stats'] as $s) {
                $v = isset($s['value']) ? trim((string) $s['value']) : '';
                $l = isset($s['label']) ? trim((string) $s['label']) : '';
                if ($v !== '' && $l !== '') $clean['stats'][] = array('value' => $v, 'label' => $l);
            }
        }
        if (!$clean['takeaways']) return array();
        update_post_meta($post_id, '_pcpl_ai_infographic', $clean);
        return $clean;
    }

    /** Answer a question grounded ONLY in the given policy (scoped Q&A). '' on failure. */
    public static function ask(array $policy, $question) {
        $question = trim((string) $question);
        if ($question === '') return '';
        $system = "You are PolicyGPT, PolicyCentral.ai's policy assistant. Answer the user's question using ONLY the policy provided below. "
            . "If the answer is not in the policy, say so briefly and suggest they contact their HR/compliance team. "
            . "Be concise (2 to 5 sentences), plain text, American spelling, no markdown. Refer to the organization as [Company Name].\n\n"
            . "POLICY: " . $policy['title'] . "\n\n" . self::plain_body($policy);
        $answer = self::call($system, $question, 600);
        // Belt-and-suspenders: strip any markdown the model slips in (rendered as plain text).
        $answer = preg_replace('/\*\*(.+?)\*\*/s', '$1', $answer);
        $answer = preg_replace('/(?<!\*)\*(?!\*)([^*]+)\*(?!\*)/', '$1', $answer);
        return trim($answer);
    }

    /** Strip the HTML body to plain text and cap length for the prompt. */
    private static function plain_body(array $policy) {
        $txt = html_entity_decode(wp_strip_all_tags((string) ($policy['body'] ?? '')), ENT_QUOTES, 'UTF-8');
        $txt = trim(preg_replace('/\n{3,}/', "\n\n", preg_replace('/[ \t]+/', ' ', $txt)));
        if (strlen($txt) > self::BODY_MAX) $txt = substr($txt, 0, self::BODY_MAX);
        return $txt;
    }

    /** Single non-streaming Claude call. Returns text ('' on any failure). */
    private static function call($system, $user, $max_tokens) {
        if (!defined('PCGPT_API_KEY') || empty(PCGPT_API_KEY)) {
            error_log('PCPL_AI: PCGPT_API_KEY not defined');
            return '';
        }
        $resp = wp_remote_post(self::API, array(
            'timeout' => self::TIMEOUT,
            'headers' => array(
                'Content-Type'      => 'application/json',
                'x-api-key'         => PCGPT_API_KEY,
                'anthropic-version' => '2023-06-01',
            ),
            'body' => wp_json_encode(array(
                'model'      => self::MODEL,
                'max_tokens' => (int) $max_tokens,
                'system'     => $system,
                'messages'   => array(array('role' => 'user', 'content' => $user)),
            )),
        ));
        if (is_wp_error($resp)) { error_log('PCPL_AI: ' . $resp->get_error_message()); return ''; }
        $code = wp_remote_retrieve_response_code($resp);
        $body = wp_remote_retrieve_body($resp);
        if ($code !== 200) { error_log('PCPL_AI HTTP ' . $code . ': ' . substr($body, 0, 300)); return ''; }
        $d = json_decode($body, true);
        if (!is_array($d)) return '';
        $parts = array();
        foreach ($d['content'] ?? array() as $b) {
            if (($b['type'] ?? '') === 'text' && !empty($b['text'])) $parts[] = $b['text'];
        }
        return trim(implode("\n", $parts));
    }

    /** Parse a JSON array of {q,a} from the model text (tolerates code fences). */
    private static function parse_faqs($text) {
        $text = trim($text);
        if (preg_match('/```(?:json)?\s*(.+?)```/is', $text, $m)) $text = trim($m[1]);
        if (preg_match('/\[.*\]/s', $text, $m)) $text = $m[0];
        $arr = json_decode($text, true);
        if (!is_array($arr)) return array();
        $out = array();
        foreach ($arr as $item) {
            $q = isset($item['q']) ? trim((string) $item['q']) : '';
            $a = isset($item['a']) ? trim((string) $item['a']) : '';
            if ($q !== '' && $a !== '') $out[] = array('q' => $q, 'a' => $a);
        }
        return $out;
    }
}
