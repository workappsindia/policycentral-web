<?php
/**
 * Policy Library — interactive "live policy" endpoints (translate / summary / ask).
 *
 * Powers the on-page toolbar on single policy templates: translate the policy
 * into an Indian language, show the AI summary, and ask questions scoped to the
 * policy. All Claude work runs on PCGPT_API_KEY (the client's key) via PCPL_AI,
 * and translations/summaries are cached per policy so repeat requests are free.
 * Public (nopriv) endpoints are rate-limited per IP to bound token spend.
 */
defined('ABSPATH') || exit;

class PCPL_Interactive {

    const NONCE = 'pcpl_interactive';

    public static function register() {
        foreach (array('pcpl_translate', 'pcpl_ai_summary', 'pcpl_ask', 'pcpl_faqs', 'pcpl_infographic') as $a) {
            add_action('wp_ajax_' . $a,        array(__CLASS__, str_replace('pcpl_', 'handle_', $a)));
            add_action('wp_ajax_nopriv_' . $a, array(__CLASS__, str_replace('pcpl_', 'handle_', $a)));
        }
    }

    /** Supported languages: code => [name (for the model), native (for the UI), bcp47 (for Web Speech)]. */
    public static function languages() {
        return array(
            'en' => array('name' => 'English',   'native' => 'English',   'bcp47' => 'en-IN'),
            'hi' => array('name' => 'Hindi',      'native' => 'हिन्दी',     'bcp47' => 'hi-IN'),
            'mr' => array('name' => 'Marathi',    'native' => 'मराठी',      'bcp47' => 'mr-IN'),
            'gu' => array('name' => 'Gujarati',   'native' => 'ગુજરાતી',    'bcp47' => 'gu-IN'),
            'pa' => array('name' => 'Punjabi',    'native' => 'ਪੰਜਾਬੀ',     'bcp47' => 'pa-IN'),
            'ta' => array('name' => 'Tamil',      'native' => 'தமிழ்',      'bcp47' => 'ta-IN'),
            'te' => array('name' => 'Telugu',     'native' => 'తెలుగు',     'bcp47' => 'te-IN'),
            'bn' => array('name' => 'Bengali',    'native' => 'বাংলা',      'bcp47' => 'bn-IN'),
            'kn' => array('name' => 'Kannada',    'native' => 'ಕನ್ನಡ',      'bcp47' => 'kn-IN'),
            'ml' => array('name' => 'Malayalam',  'native' => 'മലയാളം',    'bcp47' => 'ml-IN'),
            'ur' => array('name' => 'Urdu',       'native' => 'اردو',       'bcp47' => 'ur-IN'),
        );
    }

    /** Per-IP hourly rate limit; returns true if the caller is over the cap. */
    private static function rate_limited($bucket, $max) {
        $ip  = function_exists('pc_get_client_ip') ? pc_get_client_ip() : ($_SERVER['REMOTE_ADDR'] ?? '');
        $key = 'pcpl_i_' . $bucket . '_' . md5($ip);
        $n   = (int) get_transient($key);
        if ($n >= $max) return true;
        set_transient($key, $n + 1, HOUR_IN_SECONDS);
        return false;
    }

    /** Resolve slug -> policy array (or send a JSON error and exit). */
    private static function resolve_policy($slug) {
        $posts = get_posts(array('name' => $slug, 'post_type' => PCPL_CPT::POST_TYPE, 'post_status' => 'publish', 'numberposts' => 1));
        if (empty($posts)) wp_send_json_error('Policy not found.');
        $post = $posts[0];
        return array($post->ID, array(
            'title'  => html_entity_decode(get_the_title($post), ENT_QUOTES, 'UTF-8'),
            'byline' => $post->post_excerpt,
            'body'   => $post->post_content,
            'faqs'   => pcpl_meta_list($post->ID, '_pcpl_faqs'),
        ));
    }

    /**
     * Translation is a long (~1 min) generation, so it runs in the background and
     * the client polls. Responses:
     *   {done:true, html}            cache hit (or synchronous non-FPM completion)
     *   {done:false, generating:true} a worker is producing it; poll again
     *   error                         a recent attempt failed
     * The first request kicks off generation (in-worker via fastcgi_finish_request);
     * a per-(policy,lang) lock stops duplicate generations while polls come in.
     */
    public static function handle_translate() {
        check_ajax_referer(self::NONCE, 'nonce');
        $slug = isset($_POST['policy']) ? sanitize_title(wp_unslash($_POST['policy'])) : '';
        $lang = isset($_POST['lang'])   ? sanitize_key(wp_unslash($_POST['lang']))     : '';
        $langs = self::languages();
        if (!isset($langs[$lang]) || $lang === 'en') wp_send_json_error('Unsupported language.');

        require_once PCPL_DIR . '/class-pcpl-ai.php';
        list($pid, $policy) = self::resolve_policy($slug);

        $meta_key = '_pcpl_tr_' . $lang;
        $cached = get_post_meta($pid, $meta_key, true);
        if (is_string($cached) && $cached !== '') {
            wp_send_json_success(array('done' => true, 'html' => pcpl_display_text($cached), 'lang' => $lang, 'bcp47' => $langs[$lang]['bcp47']));
        }

        $lock = 'pcpl_trlock_' . $pid . '_' . $lang;
        $errk = $lock . '_err';
        if (get_transient($errk)) { delete_transient($errk); wp_send_json_error('Translation failed. Please try again.'); }
        if (get_transient($lock)) wp_send_json_success(array('done' => false, 'generating' => true));

        // Start a generation. Rate-limit only real starts, not polls/cache hits.
        if (self::rate_limited('tr', 40)) wp_send_json_error('Too many requests. Please try again later.');
        set_transient($lock, 1, 3 * MINUTE_IN_SECONDS);

        $generate = function () use ($pid, $policy, $lang, $langs, $meta_key, $lock, $errk) {
            @set_time_limit(180);
            $html = PCPL_AI::translate($pid, $policy, $lang, $langs[$lang]['name']);
            delete_transient($lock);
            if ($html === '') set_transient($errk, 1, 60);
        };

        if (function_exists('fastcgi_finish_request')) {
            // Return "generating" to the client, flush, then produce it in this worker.
            status_header(200);
            header('Content-Type: application/json; charset=' . get_option('blog_charset'));
            echo wp_json_encode(array('success' => true, 'data' => array('done' => false, 'generating' => true)));
            fastcgi_finish_request();
            try { $generate(); } catch (\Throwable $e) { delete_transient($lock); set_transient($errk, 1, 60); error_log('PCPL_Interactive translate bg: ' . $e->getMessage()); }
            exit;
        }
        // No background support: generate synchronously.
        $generate();
        $html = get_post_meta($pid, $meta_key, true);
        if (!is_string($html) || $html === '') wp_send_json_error('Translation is unavailable right now. Please try again.');
        wp_send_json_success(array('done' => true, 'html' => pcpl_display_text($html), 'lang' => $lang, 'bcp47' => $langs[$lang]['bcp47']));
    }

    public static function handle_ai_summary() {
        check_ajax_referer(self::NONCE, 'nonce');
        $slug = isset($_POST['policy']) ? sanitize_title(wp_unslash($_POST['policy'])) : '';
        if (self::rate_limited('sum', 60)) wp_send_json_error('Too many requests. Please try again later.');

        require_once PCPL_DIR . '/class-pcpl-ai.php';
        list($pid, $policy) = self::resolve_policy($slug);
        @set_time_limit(120);
        $summary = PCPL_AI::get_summary($pid, $policy);
        if ($summary === '') wp_send_json_error('Summary is unavailable right now. Please try again.');
        wp_send_json_success(array('summary' => pcpl_display_text($summary)));
    }

    public static function handle_faqs() {
        check_ajax_referer(self::NONCE, 'nonce');
        $slug = isset($_POST['policy']) ? sanitize_title(wp_unslash($_POST['policy'])) : '';
        if (self::rate_limited('faq', 60)) wp_send_json_error('Too many requests. Please try again later.');

        require_once PCPL_DIR . '/class-pcpl-ai.php';
        list($pid, $policy) = self::resolve_policy($slug);
        @set_time_limit(120);

        $clean = function ($f) {
            return array('q' => pcpl_display_text($f['q']), 'a' => pcpl_display_text($f['a']));
        };
        $curated = array();
        foreach (($policy['faqs'] ?? array()) as $f) {
            if (!empty($f['q']) && !empty($f['a'])) $curated[] = $clean($f);
        }
        $ai = PCPL_AI::get_faqs_topup($pid, $policy); // cached per policy
        $ai = is_array($ai) ? array_map($clean, $ai) : array();
        wp_send_json_success(array('curated' => $curated, 'ai' => $ai));
    }

    public static function handle_infographic() {
        check_ajax_referer(self::NONCE, 'nonce');
        $slug = isset($_POST['policy']) ? sanitize_title(wp_unslash($_POST['policy'])) : '';
        if (self::rate_limited('info', 40)) wp_send_json_error('Too many requests. Please try again later.');

        require_once PCPL_DIR . '/class-pcpl-ai.php';
        list($pid, $policy) = self::resolve_policy($slug);
        @set_time_limit(120);
        $data = PCPL_AI::infographic($pid, $policy);
        if (empty($data)) wp_send_json_error('The infographic is unavailable right now. Please try again.');
        // Hide the [Company Name] marker for on-screen display.
        if (isset($data['headline'])) $data['headline'] = pcpl_display_text($data['headline']);
        if (isset($data['summary']))  $data['summary']  = pcpl_display_text($data['summary']);
        foreach (array('takeaways', 'stats') as $k) {
            if (!empty($data[$k]) && is_array($data[$k])) {
                foreach ($data[$k] as &$item) {
                    foreach ($item as $ik => $iv) { if (is_string($iv)) $item[$ik] = pcpl_display_text($iv); }
                }
                unset($item);
            }
        }
        wp_send_json_success($data);
    }

    public static function handle_ask() {
        check_ajax_referer(self::NONCE, 'nonce');
        $slug = isset($_POST['policy'])   ? sanitize_title(wp_unslash($_POST['policy']))                 : '';
        $q    = isset($_POST['question']) ? sanitize_textarea_field(wp_unslash($_POST['question']))       : '';
        if ($q === '') wp_send_json_error('Please enter a question.');
        if (mb_strlen($q) > 500) wp_send_json_error('Please keep your question under 500 characters.');
        if (self::rate_limited('ask', 25)) wp_send_json_error('Too many questions from this connection. Please try again later.');

        require_once PCPL_DIR . '/class-pcpl-ai.php';
        list($pid, $policy) = self::resolve_policy($slug);
        @set_time_limit(120);
        $answer = PCPL_AI::ask($policy, $q);
        if ($answer === '') wp_send_json_error('Could not answer right now. Please try again.');
        wp_send_json_success(array('answer' => pcpl_display_text($answer)));
    }
}
