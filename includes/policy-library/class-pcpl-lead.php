<?php
/**
 * Policy Library — lead capture + personalized-PDF delivery (async).
 *
 * AJAX (priv + nopriv) action `pcpl_lead`: validates (name + email required,
 * corporate-email only), stores the lead in wp_pc_leads, then ENQUEUES a PDF job
 * (PCPL_Queue) and returns immediately. The heavy work — generate the PDF, email
 * it to the requester, notify the webmaster — runs asynchronously via the queue
 * drains (fastcgi_finish_request in-request, cron, and the reaper). This keeps
 * the request instant and lets later AI enhancements run without a spinner.
 *
 * Note: a template download is NOT a sales lead — the webmaster gets a plain
 * "downloaded" notice with the PDF attached, never the PCL_Mailer lead report,
 * and enrichment is never triggered. (rev 3 — async queue)
 */
defined('ABSPATH') || exit;

class PCPL_Lead {

    const DONE_MSG = "Thanks! We're preparing your personalized PDF now, it will land in your inbox in a minute or two.";

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

        if ($name === '' || $company === '' || $email === '') {
            wp_send_json_error('Please enter your name, company, and work email.');
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
        $title = html_entity_decode(get_the_title($posts[0]), ENT_QUOTES, 'UTF-8');

        // ── Capture the session/tracking snapshot now (the async worker won't have $_SERVER) ──
        $ua       = isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field(wp_unslash($_SERVER['HTTP_USER_AGENT'])) : '';
        $referrer = isset($_SERVER['HTTP_REFERER']) ? esc_url_raw(wp_unslash($_SERVER['HTTP_REFERER'])) : '';
        $os       = function_exists('pc_detect_os') ? pc_detect_os() : '';
        $browser  = function_exists('pc_detect_browser') ? pc_detect_browser() : '';
        $device   = wp_is_mobile() ? 'Mobile' : 'Desktop';
        $geo      = function_exists('pc_lead_lookup_geo') ? pc_lead_lookup_geo($ip) : array();
        $geo_str  = trim(implode(', ', array_filter(array($geo['geo_city'] ?? '', $geo['geo_region'] ?? '', $geo['geo_country'] ?? ''))));
        $ts       = current_time('mysql');

        // ── Store the lead immediately (survives even if PDF delivery later fails) ──
        list($lead_id, $ref) = self::store_lead(array(
            'name' => $name, 'company' => $company, 'email' => $email, 'mobile' => $mobile,
            'title' => $title, 'ip' => $ip, 'ua' => $ua, 'referrer' => $referrer,
            'os' => $os, 'browser' => $browser, 'device' => $device,
            'geo_city' => $geo['geo_city'] ?? '', 'geo_region' => $geo['geo_region'] ?? '', 'geo_country' => $geo['geo_country'] ?? '',
            'page_url' => $referrer, 'ts' => $ts,
        ));

        // ── Build the job payload (everything the async worker needs) ──
        $payload = array(
            'name' => $name, 'company' => $company, 'email' => $email, 'mobile' => $mobile,
            'title' => $title, 'ref' => $ref,
            'ip' => $ip, 'ua' => $ua, 'os' => $os, 'browser' => $browser, 'device' => $device,
            'geo_str' => $geo_str, 'referrer' => $referrer, 'page_url' => $referrer, 'ts' => $ts,
        );

        require_once PCPL_DIR . '/class-pcpl-queue.php';
        $job_id = PCPL_Queue::enqueue($lead_id, $slug, $payload);

        if (!$job_id) {
            // Queue insert failed — deliver synchronously so the request isn't lost.
            try {
                self::fulfill_job($slug, $payload);
            } catch (\Throwable $e) {
                error_log('PCPL_Lead sync fallback failed: ' . $e->getMessage());
                wp_send_json_error('We captured your request but could not generate the PDF just now. Our team will follow up.');
            }
            wp_send_json_success(array('message' => self::DONE_MSG));
        }

        self::respond_and_drain($job_id, self::DONE_MSG);
    }

    /**
     * Flush the success response to the client, then drain the job. When
     * fastcgi_finish_request is available (PHP-FPM) the job runs in this same
     * worker after the client already has its response — no cron loopback needed.
     * Otherwise we fall back to a scheduled cron event; the reaper backs both up.
     */
    private static function respond_and_drain($job_id, $message) {
        if (function_exists('fastcgi_finish_request')) {
            // PHP-FPM: return the response to the client, then process in the same
            // worker. No cron loopback needed (works even behind Basic Auth on dev).
            status_header(200);
            header('Content-Type: application/json; charset=' . get_option('blog_charset'));
            echo wp_json_encode(array('success' => true, 'data' => array('message' => $message)));
            fastcgi_finish_request();
            PCPL_Queue::process_job($job_id);
            exit;
        }

        // No in-request async available: process inline before responding, so
        // delivery never depends on the WP-Cron loopback (which Basic Auth blocks
        // on dev). Costs the requester a short wait on a policy's first-ever lead.
        PCPL_Queue::process_job($job_id);
        wp_send_json_success(array('message' => $message));
    }

    /**
     * Job worker: build the personalized PDF and deliver it (requester email +
     * webmaster notification). Throws on any hard failure so the queue retries.
     */
    public static function fulfill_job($slug, array $p) {
        @set_time_limit(180); // this worker may make 2 Claude calls on a policy's first run

        $posts = get_posts(array('name' => $slug, 'post_type' => PCPL_CPT::POST_TYPE, 'post_status' => 'publish', 'numberposts' => 1));
        if (empty($posts)) throw new \RuntimeException('policy not found: ' . $slug);
        $post = $posts[0];

        $policy = array(
            'title'  => html_entity_decode(get_the_title($post), ENT_QUOTES, 'UTF-8'),
            'byline' => $post->post_excerpt,
            'body'   => $post->post_content,
            'faqs'   => pcpl_meta_list($post->ID, '_pcpl_faqs'),
        );

        // PolicyCentral AI enhancements — cached per policy, fail soft (never block delivery).
        require_once PCPL_DIR . '/class-pcpl-ai.php';
        // Environment-matched QR: point it at the same host that generated this PDF
        // (so it matches the clickable link and actually resolves). dev.* uses the
        // dev set, everything else the prod set; both are pre-generated + verified.
        $host   = (string) wp_parse_url(home_url(), PHP_URL_HOST);
        $qr_dir = (strpos($host, 'dev.') === 0) ? 'qr/dev/' : 'qr/';
        $qr     = PCPL_ASSETS . '/' . $qr_dir . $slug . '.png';
        $enh = array(
            'summary'    => PCPL_AI::get_summary($post->ID, $policy),
            'ai_faqs'    => PCPL_AI::get_faqs_topup($post->ID, $policy),
            'policy_url' => home_url('/policies/' . $slug . '/'),
            'qr_path'    => file_exists($qr) ? $qr : '',
        );

        require_once PCPL_DIR . '/class-pcpl-pdf.php';
        $pdf = PCPL_PDF::build($policy, isset($p['company']) ? $p['company'] : '', $enh);

        $updir = wp_upload_dir();
        $dir   = trailingslashit($updir['basedir']) . 'pcpl-tmp';
        if (!file_exists($dir)) wp_mkdir_p($dir);
        $path  = trailingslashit($dir) . 'PolicyCentral-' . $slug . '-' . wp_generate_password(6, false) . '.pdf';
        file_put_contents($path, $pdf);

        $sent = self::mail_user($p['email'], $p['name'], $policy['title'], $path);
        self::notify_admin($p, $path);

        @unlink($path);

        if (!$sent) throw new \RuntimeException('mail_user failed for ' . $p['email']);
    }

    /** Store the download in wp_pc_leads; returns [lead_id, ref]. */
    private static function store_lead(array $p) {
        global $wpdb;
        $ref = ''; $lead_id = 0;
        $table = $wpdb->prefix . 'pc_leads';
        if ($wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table)) === $table) {
            $wpdb->insert($table, array(
                'full_name'         => $p['name'],
                'company'           => $p['company'],
                'email'             => $p['email'],
                'phone'             => $p['mobile'],
                'message'           => 'Downloaded policy template: ' . $p['title'],
                'ip_address'        => $p['ip'],
                'user_agent'        => $p['ua'],
                'referrer'          => $p['referrer'],
                'os'                => $p['os'],
                'browser'           => $p['browser'],
                'device_type'       => $p['device'],
                'geo_city'          => $p['geo_city'],
                'geo_region'        => $p['geo_region'],
                'geo_country'       => $p['geo_country'],
                'page_source'       => 'Policy Template: ' . $p['title'],
                'page_url'          => $p['page_url'],
                'enrichment_status' => 'new',
                'submitted_at'      => $p['ts'],
            ));
            $lead_id = (int) $wpdb->insert_id;
            if ($lead_id && class_exists('PCL_DB') && method_exists('PCL_DB', 'finalize_lead')) {
                $ref = PCL_DB::finalize_lead($lead_id, $p['name']);
            }
        }
        return array($lead_id, $ref);
    }

    private static function mail_user($email, $name, $title, $path) {
        $subject = 'Your personalized ' . $title;
        $body  = "Hi " . $name . ",\n\n";
        $body .= "Thanks for your interest. Attached is your personalized copy of the " . $title . " from PolicyCentral.ai.\n\n";
        $body .= "This template is a starting point, please review and adapt it with your compliance/legal team before use.\n\n";
        $body .= "Want these policies to live inside your organisation, versioned, translated, acknowledged, and answerable by AI? Reply to this email or visit " . home_url('/') . "\n\n";
        $body .= "PolicyCentral.ai";
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: PolicyCentral.ai <marketing@policycentral.ai>',
        );
        return wp_mail($email, $subject, $body, $headers, array($path));
    }

    /**
     * Send the webmaster a rich "Policy Template Downloaded" HTML notification
     * (same design language as the lead admin email, incl. Session & Tracking)
     * with the personalized PDF attached. It is a download, NOT a sales lead —
     * no lead-intelligence report and no Claude enrichment is triggered.
     */
    private static function notify_admin(array $p, $pdf_path) {
        $to   = function_exists('pc_get_admin_lead_email') ? pc_get_admin_lead_email() : get_option('admin_email');
        $html = self::build_download_html($p);
        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: PolicyCentral.ai <marketing@policycentral.ai>',
            'Reply-To: ' . $p['name'] . ' <' . $p['email'] . '>',
        );
        $attachments = ($pdf_path && file_exists($pdf_path)) ? array($pdf_path) : array();
        wp_mail($to, 'Policy Template downloaded: ' . $p['title'], $html, $headers, $attachments);
    }

    /** After MAX_ATTEMPTS the webmaster is told a delivery failed, with the error. */
    public static function notify_job_failed($slug, array $p, $err) {
        $to = function_exists('pc_get_admin_lead_email') ? pc_get_admin_lead_email() : get_option('admin_email');
        $subject = 'Policy PDF delivery FAILED: ' . $slug;
        $body  = "A personalized policy PDF job failed after repeated attempts and has been given up.\n\n";
        $body .= "Policy: " . $slug . "\n";
        $body .= "Requester: " . ($p['name'] ?? '') . " <" . ($p['email'] ?? '') . ">\n";
        $body .= "Company: " . ($p['company'] ?? '') . "\n\n";
        $body .= "Error: " . $err . "\n\n";
        $body .= "The lead is stored in Lead Intelligence; please follow up manually.";
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: PolicyCentral.ai <marketing@policycentral.ai>',
        );
        wp_mail($to, $subject, $body, $headers);
    }

    /** Rich HTML for the webmaster download notification (Session & Tracking table retained). */
    private static function build_download_html($d) {
        $name = esc_html($d['name'] ?: '—');
        $first= esc_html(strtok(trim($d['name']), ' ') ?: $d['name']);
        $co   = esc_html($d['company'] !== '' ? $d['company'] : '—');
        $email= esc_html($d['email']);
        $phone= esc_html($d['mobile'] !== '' ? $d['mobile'] : '—');
        $title= esc_html($d['title']);
        $ref  = esc_html($d['ref'] ?: 'PC-DOWNLOAD');
        $ip   = esc_html($d['ip']);
        $ua   = esc_html($d['ua']);
        $os   = esc_html($d['os']);
        $brow = esc_html($d['browser']);
        $dev  = esc_html($d['device']);
        $geo  = esc_html($d['geo_str']);
        $refr = esc_html($d['referrer']);
        $purl = esc_html($d['page_url']);
        $ts   = esc_html($d['ts']);
        $phone_raw = preg_replace('/\D/', '', (string) $d['mobile']);
        $wa_msg = rawurlencode("Hi {$first}, this is PolicyCentral.ai — thanks for downloading the {$d['title']}. Would you like a quick walkthrough of how we make policies like this live inside your organisation?");

        return <<<HTML
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#F3F4F6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F3F4F6;"><tr><td align="center" style="padding:32px 16px;">
<table role="presentation" width="680" cellpadding="0" cellspacing="0" style="max-width:680px;width:100%;background:#FFFFFF;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.06);">

  <tr><td style="background:linear-gradient(135deg,#0694A2 0%,#4338CA 50%,#7C3AED 100%);padding:24px 32px;">
    <table width="100%" cellpadding="0" cellspacing="0"><tr>
      <td style="color:#fff;">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.75);margin-bottom:4px;">Internal · Template Download</div>
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:22px;font-weight:900;color:#fff;letter-spacing:-.02em;">Policy Template Downloaded</div>
      </td>
      <td align="right" style="vertical-align:top;">
        <div style="font-family:'JetBrains Mono',monospace;font-size:12px;color:#fff;background:rgba(255,255,255,.18);padding:6px 12px;border-radius:20px;font-weight:700;">{$ref}</div>
        <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:rgba(255,255,255,.6);margin-top:6px;">{$ts}</div>
      </td>
    </tr></table>
  </td></tr>

  <tr><td style="background:#E0F7F6;border-bottom:1px solid #B9ECE8;padding:10px 32px;">
    <table width="100%" cellpadding="0" cellspacing="0"><tr>
      <td style="font-family:'Plus Jakarta Sans',sans-serif;font-size:11px;font-weight:800;color:#0F766E;letter-spacing:.08em;text-transform:uppercase;">● Personalized PDF generated &amp; emailed to the requester</td>
      <td align="right"><span style="background:#0F766E;color:#fff;font-family:'Plus Jakarta Sans',sans-serif;font-size:9px;font-weight:800;padding:3px 10px;border-radius:4px;text-transform:uppercase;letter-spacing:.06em;">PDF Attached</span></td>
    </tr></table>
  </td></tr>

  <tr><td style="padding:28px 32px 8px;">
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:12px;">Downloaded By</div>
    <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #E5E7EB;border-radius:12px;overflow:hidden;"><tr>
      <td width="50%" style="background:#F9FAFB;border-right:1px solid #E5E7EB;padding:14px 18px;vertical-align:top;">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#9CA3AF;margin-bottom:4px;">Contact</div>
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;color:#111827;line-height:1.3;">{$name}</div>
        <div style="font-size:12px;color:#6B7280;margin-top:2px;">{$email}</div>
        <div style="font-size:12px;color:#6B7280;">{$phone}</div>
      </td>
      <td width="50%" style="background:#F9FAFB;padding:14px 18px;vertical-align:top;">
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.08em;text-transform:uppercase;color:#9CA3AF;margin-bottom:4px;">Company</div>
        <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:16px;font-weight:800;color:#0694A2;line-height:1.3;">{$co}</div>
        <div style="font-size:12px;color:#6B7280;margin-top:2px;">{$geo}</div>
      </td>
    </tr></table>
  </td></tr>

  <tr><td style="padding:16px 32px 4px;">
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:8px;">Template Downloaded</div>
    <div style="background:#F9FAFB;border-left:3px solid #0694A2;border-radius:0 10px 10px 0;padding:14px 18px;font-size:15px;font-weight:700;color:#111827;line-height:1.5;">{$title}<div style="font-size:12px;font-weight:500;color:#6B7280;margin-top:4px;">The personalized PDF is attached to this email.</div></div>
  </td></tr>

  <tr><td style="padding:14px 32px 20px;">
    <table cellpadding="0" cellspacing="0"><tr>
      <td style="padding-right:8px;"><a href="mailto:{$email}?subject=Re:%20Your%20{$ref}%20policy%20template" style="display:inline-block;padding:10px 18px;background:#F3F4F6;border:1px solid #E5E7EB;border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:700;color:#0694A2;text-decoration:none;">✉️ Email {$first}</a></td>
      <td><a href="https://wa.me/{$phone_raw}?text={$wa_msg}" style="display:inline-block;padding:10px 18px;background:#F3F4F6;border:1px solid #E5E7EB;border-radius:8px;font-family:'Plus Jakarta Sans',sans-serif;font-size:12px;font-weight:700;color:#25D366;text-decoration:none;">WhatsApp</a></td>
    </tr></table>
  </td></tr>

  <tr><td style="padding:0 32px;"><div style="height:1px;background:#E5E7EB;"></div></td></tr>

  <tr><td style="padding:24px 32px 16px;">
    <div style="font-family:'Plus Jakarta Sans',sans-serif;font-size:10px;font-weight:800;letter-spacing:.12em;text-transform:uppercase;color:#9CA3AF;margin-bottom:12px;">Session &amp; Tracking</div>
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#F9FAFB;border:1px solid #E5E7EB;border-radius:10px;overflow:hidden;">
      <tr><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;width:140px;">IP Address</td><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:12px;color:#4B5563;">{$ip}</td></tr>
      <tr><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;">Device</td><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:12px;color:#4B5563;">{$brow} · {$os} · {$dev}</td></tr>
      <tr><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;vertical-align:top;">Page URL</td><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#2563EB;word-break:break-all;">{$purl}</td></tr>
      <tr><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;vertical-align:top;">Referrer</td><td style="padding:10px 16px;border-bottom:1px solid #E5E7EB;font-family:'JetBrains Mono',monospace;font-size:11px;color:#2563EB;word-break:break-all;">{$refr}</td></tr>
      <tr><td style="padding:10px 16px;font-family:'JetBrains Mono',monospace;font-size:11px;color:#9CA3AF;vertical-align:top;">User-Agent</td><td style="padding:10px 16px;font-family:'JetBrains Mono',monospace;font-size:10px;color:#6B7280;word-break:break-all;line-height:1.5;">{$ua}</td></tr>
    </table>
  </td></tr>

  <tr><td style="background:#F9FAFB;padding:16px 32px;text-align:center;border-top:1px solid #E5E7EB;">
    <div style="font-family:'JetBrains Mono',monospace;font-size:10px;color:#9CA3AF;margin-bottom:4px;">{$ref} · POLICY TEMPLATE DOWNLOAD · INTERNAL</div>
    <div style="font-size:11px;color:#9CA3AF;">© 2026 PolicyCentral.ai · Do not forward</div>
  </td></tr>

</table></td></tr></table></body></html>
HTML;
    }
}
