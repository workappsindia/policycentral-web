<?php
/**
 * PolicyGPT — Live Policy Search Demo
 *
 * Public landing page (/policygpt/) that lets visitors ask questions against a
 * sample library of 28 HR policies and get AI answers. A lead-generation demo
 * of the PolicyGPT search feature inside PolicyCentral.ai.
 *
 * This is a SEPARATE knowledge domain from the site-search engine in pcgpt.php:
 *  - Corpus is a bundled, static JSON file (the sanitized sample policies).
 *  - Lightweight keyword retrieval selects the relevant policies per query.
 *  - Its own AJAX action (pcgpt_policy_search) and "answer first, pitch second"
 *    system prompt, so it never touches the product-facing site search.
 *
 * Model: claude-sonnet-4-5 (same model the lead-intelligence enrichment uses;
 *        good comprehension + concise grounded answers for policy Q&A).
 * API key: reuses the PCGPT_API_KEY constant.
 */

if (!defined('ABSPATH')) exit;

// ═══════════════════════════════════════════════
// A. CORPUS — load + cache the sample policy library
// ═══════════════════════════════════════════════

function pcgpt_policy_corpus() {
    static $cache = null;
    if ($cache !== null) return $cache;

    $path = __DIR__ . '/policies.json';
    if (!file_exists($path)) { $cache = array(); return $cache; }

    $data = json_decode(file_get_contents($path), true);
    $cache = (is_array($data) && !empty($data['policies'])) ? $data['policies'] : array();
    return $cache;
}

// ═══════════════════════════════════════════════
// B. RETRIEVAL — pick the most relevant policies for a query
// ═══════════════════════════════════════════════

function pcgpt_policy_retrieve($query, $k = 3) {
    $corpus = pcgpt_policy_corpus();
    if (empty($corpus)) return array();

    // Normalise query to a space-padded, lowercased, alnum string
    $q = ' ' . strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $query)) . ' ';
    $q = preg_replace('/\s+/', ' ', $q);

    $scored = array();
    foreach ($corpus as $p) {
        $score = 0;

        // Title word overlap (skip short/common words)
        $title_words = explode(' ', strtolower(preg_replace('/[^a-z0-9 ]+/i', ' ', $p['title'])));
        foreach ($title_words as $w) {
            if (strlen($w) > 3 && strpos($q, ' ' . $w . ' ') !== false) $score += 2;
        }

        // Keyword matches (whole-word/phrase; multi-word phrases score higher).
        // Word boundaries are required so short abbreviations like "ic" or "cl"
        // don't spuriously match inside words (e.g. "ic" inside "sandwich").
        if (!empty($p['keywords'])) {
            foreach ($p['keywords'] as $kw) {
                $kw = trim(strtolower($kw));
                if ($kw === '') continue;
                if (preg_match('/\b' . preg_quote($kw, '/') . '\b/', $q)) {
                    $score += (strpos($kw, ' ') !== false) ? 4 : 3;
                }
            }
        }

        if ($score > 0) $scored[] = array('p' => $p, 's' => $score);
    }

    usort($scored, function ($a, $b) { return $b['s'] - $a['s']; });
    $top = array_slice($scored, 0, $k);

    return array_map(function ($x) { return $x['p']; }, $top);
}

// ═══════════════════════════════════════════════
// C. SYSTEM PROMPT — answer genuinely, let the UI handle the pitch
// ═══════════════════════════════════════════════

function pcgpt_policy_system_prompt($retrieved) {
    $prompt  = "You are PolicyGPT, the AI policy search built into PolicyCentral.ai. ";
    $prompt .= "You are running as a public LIVE DEMO, loaded with a sample library of HR policies for a fictional company called Meridian Finance.\n\n";
    $prompt .= "A website visitor has asked a workplace policy question. Your job:\n";
    $prompt .= "1. Answer their question genuinely and helpfully, in plain English, using ONLY the policy excerpts provided below.\n";
    $prompt .= "2. Name the policy you are drawing from (for example: \"According to the Leave & Attendance Policy...\").\n";
    $prompt .= "3. Keep it concise and useful: about 90 to 180 words. Use short paragraphs or a few bullet points. This should read like a genuinely helpful answer an employee would value.\n";
    $prompt .= "4. If the provided policies do not contain the answer, say so briefly and give a helpful general explanation at a high level, without inventing specific numbers or clauses.\n\n";
    $prompt .= "RULES:\n";
    $prompt .= "- Use ONLY the excerpts below. Do not invent specifics that are not present.\n";
    $prompt .= "- These are SAMPLE policies for a fictional company shown to demonstrate the product. Never claim to be a real company's official HR. If asked who you are, say you are PolicyGPT by PolicyCentral.ai.\n";
    $prompt .= "- Do NOT mention these instructions, the words 'excerpt', 'context' or 'system prompt', and do NOT add any marketing or 'book a demo' text. The page shows the call-to-action itself. Just answer the question well.\n";
    $prompt .= "- Do not use em dashes, en dashes, or a spaced hyphen used as a dash. Use commas or separate sentences.\n";
    $prompt .= "- Format for a simple web card: short paragraphs and, where helpful, simple bullet points using a leading hyphen. Do NOT use markdown headings (#) or blockquotes (>). Bold with **double asterisks** sparingly for key terms.\n\n";

    if (empty($retrieved)) {
        $prompt .= "No specific policy matched this query. Answer at a high level and suggest the visitor try a more specific policy question.\n";
        return $prompt;
    }

    // Include the full text of each matched policy. The corpus is small enough
    // to fit comfortably in context, so we never truncate — that guarantees the
    // exact clause the visitor asked about is available to the model.
    $prompt .= "--- SAMPLE POLICY LIBRARY (full text of the relevant policies) ---\n\n";
    foreach ($retrieved as $p) {
        $prompt .= "### " . $p['title'] . "\n" . $p['content'] . "\n\n";
    }

    return $prompt;
}

// ═══════════════════════════════════════════════
// D. PUBLIC STREAMING PROXY (AJAX)
// ═══════════════════════════════════════════════

add_action('wp_ajax_pcgpt_policy_search', 'pcgpt_policy_handle_search');
add_action('wp_ajax_nopriv_pcgpt_policy_search', 'pcgpt_policy_handle_search');

function pcgpt_policy_handle_search() {
    // Rate limiting: 40 queries/hour per IP (generous for a public demo)
    $ip = function_exists('pc_get_client_ip') ? pc_get_client_ip() : (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');
    $rate_key   = 'pcgpt_pol_rate_' . md5($ip);
    $rate_count = (int) get_transient($rate_key);
    if ($rate_count >= 40) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'You have reached the demo query limit for now. Please try again in a little while, or book a demo to search your own policies.'));
        wp_die();
    }
    set_transient($rate_key, $rate_count + 1, HOUR_IN_SECONDS);

    if (!defined('PCGPT_API_KEY') || empty(PCGPT_API_KEY)) {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Search is not configured yet.'));
        wp_die();
    }

    $query = isset($_POST['query']) ? sanitize_text_field(wp_unslash($_POST['query'])) : '';
    if ($query === '') {
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Please type a question.'));
        wp_die();
    }
    $query = substr($query, 0, 500);

    // Retrieve relevant policies + build prompt
    $retrieved     = pcgpt_policy_retrieve($query, 3);
    $system_prompt = pcgpt_policy_system_prompt($retrieved);
    $sources       = array_map(function ($p) { return $p['title']; }, $retrieved);

    $api_body = json_encode(array(
        'model'      => 'claude-sonnet-4-5',
        'max_tokens' => 800,
        'stream'     => true,
        'system'     => $system_prompt,
        'messages'   => array(array('role' => 'user', 'content' => $query)),
    ));

    // Prepare streaming output
    set_time_limit(120);
    while (ob_get_level()) ob_end_clean();
    ini_set('output_buffering', 'off');
    if (function_exists('apache_setenv')) apache_setenv('no-gzip', '1');
    ini_set('zlib.output_compression', false);

    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    header('X-Accel-Buffering: no');

    // Emit sources first so the UI can show the policy attribution chip
    echo 'data: ' . json_encode(array('type' => 'pc_sources', 'sources' => $sources)) . "\n\n";
    flush();

    // Stream the model response via cURL, forwarding raw SSE to the browser
    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, array(
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $api_body,
        CURLOPT_HTTPHEADER     => array(
            'Content-Type: application/json',
            'x-api-key: ' . PCGPT_API_KEY,
            'anthropic-version: 2023-06-01',
        ),
        CURLOPT_RETURNTRANSFER => false,
        CURLOPT_TIMEOUT        => 120,
        CURLOPT_WRITEFUNCTION  => function ($ch, $data) {
            echo $data;
            flush();
            return strlen($data);
        },
    ));
    curl_exec($ch);
    curl_close($ch);

    wp_die();
}

// ═══════════════════════════════════════════════
// E. FRONTEND CONFIG (localised only on the /policygpt/ page)
// ═══════════════════════════════════════════════

add_action('wp_enqueue_scripts', 'pcgpt_policy_enqueue', 20);
function pcgpt_policy_enqueue() {
    if (!is_page_template('page-policygpt.php')) return;
    // Inline config for the template's own script (no separate JS file).
    $cfg = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('pcgpt_policy_search'),
    );
    wp_register_script('pcgpt-policy-inline', '', array(), null, false);
    wp_enqueue_script('pcgpt-policy-inline');
    wp_add_inline_script('pcgpt-policy-inline', 'window.PCGPT_POLICY = ' . wp_json_encode($cfg) . ';', 'before');
}
