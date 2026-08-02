<?php
/**
 * Policy Library — lead capture + personalized-PDF delivery.
 *
 * AJAX (priv + nopriv) action `pcpl_lead`: validates (name + email required,
 * corporate-email only), generates a personalized PDF, emails it to the
 * requester, notifies the webmaster, and stores the lead in the shared
 * wp_pc_leads table (so it appears in the existing Lead Intelligence admin).
 */
defined('ABSPATH') || exit;

class PCPL_Lead {

    public static function register() {
        add_action('wp_ajax_pcpl_lead',       array(__CLASS__, 'handle'));
        add_action('wp_ajax_nopriv_pcpl_lead', array(__CLASS__, 'handle'));
    }

    public static function handle() {
        check_ajax_referer('pcpl_lead', 'nonce');

        $name    = isset($_POST['name'])    ? sanitize_text_field(wp_unslash($_POST['name']))    : '';
        $company = isset($_POST['company']) ? sanitize_text_field(wp_unslash($_POST['company'])) : '';
        $email   = isset($_POST['email'])   ? sanitize_email(wp_unslash($_POST['email']))         : '';
        $mobile  = isset($_POST['mobile'])  ? sanitize_text_field(wp_unslash($_POST['mobile']))  : '';
        $slug    = isset($_POST['policy'])  ? sanitize_title(wp_unslash($_POST['policy']))        : '';

        if ($name === '' || $email === '') {
            wp_send_json_error('Please enter your name and work email.');
        }
        if (!is_email($email)) {
            wp_send_json_error('Please enter a valid email address.');
        }
        if (function_exists('pc_is_corporate_email') && !pc_is_corporate_email($email)) {
            wp_send_json_error('Please use your corporate email. Personal providers (Gmail, Yahoo, Outlook, etc.) are not accepted.');
        }

        $ip  = function_exists('pc_get_client_ip') ? pc_get_client_ip() : ($_SERVER['REMOTE_ADDR'] ?? '');
        $key = 'pcpl_lead_' . md5($ip);
        $n   = (int) get_transient($key);
        if ($n >= 10) wp_send_json_error('Too many requests. Please try again later.');
        set_transient($key, $n + 1, HOUR_IN_SECONDS);

        $posts = get_posts(array('name' => $slug, 'post_type' => PCPL_CPT::POST_TYPE, 'post_status' => 'publish', 'numberposts' => 1));
        if (empty($posts)) wp_send_json_error('Sorry, that policy could not be found.');
        $post = $posts[0];
        $policy = array(
            'title'  => get_the_title($post),
            'byline' => $post->post_excerpt,
            'body'   => $post->post_content,
            'faqs'   => pcpl_meta_list($post->ID, '_pcpl_faqs'),
        );

        require_once PCPL_DIR . '/class-pcpl-pdf.php';
        try {
            $pdf = PCPL_PDF::build($policy, $company);
        } catch (\Throwable $e) {
            error_log('PCPL_Lead PDF error: ' . $e->getMessage());
            wp_send_json_error('We could not generate the PDF just now. Please try again.');
        }

        $updir = wp_upload_dir();
        $dir   = trailingslashit($updir['basedir']) . 'pcpl-tmp';
        if (!file_exists($dir)) wp_mkdir_p($dir);
        $fname = 'PolicyCentral-' . $slug . '-' . wp_generate_password(6, false) . '.pdf';
        $path  = trailingslashit($dir) . $fname;
        file_put_contents($path, $pdf);

        $sent = self::mail_user($email, $name, $policy['title'], $path);
        self::notify_webmaster($name, $company, $email, $mobile, $policy['title']);
        self::store_lead($name, $company, $email, $mobile, $policy['title'], $ip);

        @unlink($path);

        if (!$sent) {
            wp_send_json_error('We captured your request but the email could not be sent. Our team will follow up.');
        }
        wp_send_json_success(array('message' => 'Done! Check your inbox, we have emailed you the personalized policy PDF.'));
    }

    private static function mail_user($email, $name, $title, $path) {
        $subject = 'Your personalized ' . $title;
        $body  = "Hi " . $name . ",\n\n";
        $body .= "Thanks for your interest. Attached is your personalized copy of the " . $title . " from PolicyCentral.ai.\n\n";
        $body .= "This template is a starting point, please review and adapt it with your compliance/legal team before use.\n\n";
        $body .= "Want these policies to live inside your organisation, versioned, translated, acknowledged, and answerable by AI? Reply to this email or visit " . home_url('/') . "\n\n";
        $body .= "PolicyCentral.ai";
        $headers = array('Content-Type: text/plain; charset=UTF-8');
        return wp_mail($email, $subject, $body, $headers, array($path));
    }

    private static function notify_webmaster($name, $company, $email, $mobile, $title) {
        $to = function_exists('pc_lead_recipient') ? pc_lead_recipient() : get_option('admin_email');
        $subject = 'New Policy Template lead: ' . $title;
        $body  = "A new policy-template PDF was requested.\n\n";
        $body .= "Policy:  " . $title . "\n";
        $body .= "Name:    " . $name . "\n";
        $body .= "Company: " . ($company !== '' ? $company : '(not provided)') . "\n";
        $body .= "Email:   " . $email . "\n";
        $body .= "Mobile:  " . ($mobile !== '' ? $mobile : '(not provided)') . "\n";
        $body .= "Time:    " . current_time('mysql') . "\n";
        wp_mail($to, $subject, $body);
    }

    private static function store_lead($name, $company, $email, $mobile, $title, $ip) {
        global $wpdb;
        $table = $wpdb->prefix . 'pc_leads';
        if ($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table)) !== $table) return;
        $wpdb->insert($table, array(
            'full_name'         => $name,
            'company'           => $company,
            'email'             => $email,
            'phone'             => $mobile,
            'message'           => 'Requested personalized PDF: ' . $title,
            'ip_address'        => $ip,
            'os'                => function_exists('pc_detect_os') ? pc_detect_os() : '',
            'browser'           => function_exists('pc_detect_browser') ? pc_detect_browser() : '',
            'device_type'       => wp_is_mobile() ? 'Mobile' : 'Desktop',
            'page_source'       => 'Policy Template: ' . $title,
            'page_url'          => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw(wp_unslash($_SERVER['HTTP_REFERER'])) : '',
            'enrichment_status' => 'new',
            'submitted_at'      => current_time('mysql'),
        ));
    }
}
