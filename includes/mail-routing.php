<?php
/**
 * Mail Routing — Environment-aware email destinations
 *
 * ══════════════════════════════════════════════════════════════
 * ISOLATED FILE — DO NOT TOUCH UNLESS CHANGING MAIL DESTINATIONS
 * ══════════════════════════════════════════════════════════════
 *
 * This file controls where admin/lead notification emails go based on the
 * environment. Keeping it isolated means feature/content work on functions.php
 * or elsewhere won't accidentally change who receives lead emails.
 *
 * ROUTING RULES:
 * - Local  (policycentralai.local)   → punkaj@psdigital.io
 * - Dev    (dev.policycentral.ai)    → punkaj@psdigital.io
 * - Prod   (policycentral.ai + www)  → contact@policycentral.ai
 * - Unknown hosts                    → contact@policycentral.ai (safe default)
 *
 * TO CHANGE A DESTINATION:
 * Edit the constants below. That's the ONLY thing you should edit in this file.
 */

// ── Destination addresses (edit these to change routing) ──────────────
define('PC_MAIL_DEV_RECIPIENT',  'punkaj@psdigital.io');
define('PC_MAIL_PROD_RECIPIENT', 'contact@policycentral.ai');

/**
 * Returns the correct admin/lead notification recipient for the current host.
 * Used by contact form + FluentForm handlers in functions.php.
 */
/**
 * Resolve the current hostname reliably.
 *
 * We can't rely on HTTP_HOST alone because:
 * - In CLI / cron / background workers, HTTP_HOST may be empty or "127.0.0.1"
 * - wp_remote_post loopback requests may have a different host header
 *
 * WordPress's home_url() is the most reliable source — it reads from the
 * wp_options 'siteurl' / 'home' option which is stable regardless of context.
 */
function pc_get_current_host() {
    // Try HTTP_HOST first (most accurate for real requests)
    if (!empty($_SERVER['HTTP_HOST'])) {
        $host = strtolower($_SERVER['HTTP_HOST']);
        // Ignore useless values like "127.0.0.1" / "localhost"
        if ($host !== '127.0.0.1' && $host !== 'localhost' && $host !== '') {
            return $host;
        }
    }

    // Fall back to WordPress home_url (authoritative — reads wp_options)
    $home = get_option('home', get_option('siteurl', ''));
    if ($home) {
        $parsed = wp_parse_url($home);
        if (!empty($parsed['host'])) {
            return strtolower($parsed['host']);
        }
    }

    // Last resort: SERVER_NAME
    return isset($_SERVER['SERVER_NAME']) ? strtolower($_SERVER['SERVER_NAME']) : '';
}

function pc_get_admin_lead_email() {
    $host = pc_get_current_host();

    // Local by Flywheel
    if (strpos($host, '.local') !== false) {
        return PC_MAIL_DEV_RECIPIENT;
    }

    // Dev subdomain (any dev.* host)
    if (strpos($host, 'dev.') === 0) {
        return PC_MAIL_DEV_RECIPIENT;
    }

    // Everything else (including policycentral.ai and www.policycentral.ai) → production
    return PC_MAIL_PROD_RECIPIENT;
}

/**
 * Returns a human-readable environment label. Useful for debugging / email subjects.
 */
function pc_get_environment_label() {
    $host = pc_get_current_host();
    if (strpos($host, '.local') !== false) return 'local';
    if (strpos($host, 'dev.') === 0)       return 'dev';
    return 'production';
}

/**
 * LOCAL MAIL INTERCEPTOR
 * ═══════════════════════════════════════════════════════════════
 * On local (*.local hostnames), WP Mail SMTP can't decrypt the Gmail
 * App Password because the local wp-config.php has different AUTH_KEY
 * values than the server where the password was originally saved.
 *
 * Instead of trying to fix Gmail SMTP for local dev, we intercept
 * wp_mail() on local and save emails to wp-content/pc-mail-log/ as
 * HTML files. Open them in a browser to preview what would be sent.
 *
 * Production / Dev hostnames are NOT affected — WP Mail SMTP runs
 * normally and emails are actually sent.
 * ═══════════════════════════════════════════════════════════════
 */
if (pc_get_environment_label() === 'local') {
    // Run BEFORE WP Mail SMTP hooks wp_mail, so our interceptor wins.
    add_filter('pre_wp_mail', 'pc_local_mail_interceptor', 5, 2);
}

function pc_local_mail_interceptor($null, $atts) {
    $to      = $atts['to']      ?? '';
    $subject = $atts['subject'] ?? '(no subject)';
    $message = $atts['message'] ?? '';
    $headers = $atts['headers'] ?? array();

    // Normalize recipients
    if (is_array($to)) {
        $to_str = implode(', ', $to);
    } else {
        $to_str = (string) $to;
    }

    // Normalize headers
    if (is_array($headers)) {
        $headers_str = implode("\n", $headers);
    } else {
        $headers_str = (string) $headers;
    }

    // Build the log directory if missing
    $log_dir = WP_CONTENT_DIR . '/pc-mail-log';
    if (!file_exists($log_dir)) {
        @mkdir($log_dir, 0755, true);
        // Safety: prevent web access
        @file_put_contents($log_dir . '/.htaccess', "Order deny,allow\nDeny from all\n");
        @file_put_contents($log_dir . '/index.html', '');
    }

    // Filename: YYYYMMDD-HHMMSS-{slug-of-subject}.html
    $timestamp = date('Ymd-His');
    $slug = preg_replace('/[^a-z0-9-]+/', '-', strtolower(substr($subject, 0, 60)));
    $slug = trim($slug, '-') ?: 'email';
    $filename = "{$log_dir}/{$timestamp}-{$slug}.html";

    // Build an HTML file with the metadata in a header bar + the message below
    $meta_banner = '<div style="background:#FEF3C7;border-bottom:3px solid #D97706;padding:16px 24px;font-family:-apple-system,sans-serif;font-size:13px;">
        <div style="font-weight:800;color:#78350F;margin-bottom:8px;">📬 Local Mail Intercepted (not actually sent)</div>
        <div style="color:#92400E;"><strong>To:</strong> ' . htmlspecialchars($to_str) . '</div>
        <div style="color:#92400E;"><strong>Subject:</strong> ' . htmlspecialchars($subject) . '</div>
        <div style="color:#92400E;"><strong>Captured at:</strong> ' . date('Y-m-d H:i:s') . '</div>
        <details style="margin-top:8px;"><summary style="cursor:pointer;color:#92400E;">Headers</summary><pre style="background:#FDE68A;padding:8px;border-radius:6px;font-size:11px;overflow:auto;">' . htmlspecialchars($headers_str) . '</pre></details>
    </div>';

    // If the message is already full HTML, inject the banner after <body>.
    // Otherwise wrap it.
    if (stripos($message, '<body') !== false) {
        $output = preg_replace('/<body([^>]*)>/i', '<body$1>' . $meta_banner, $message, 1);
    } else {
        $output = '<!DOCTYPE html><html><head><meta charset="utf-8"><title>' . htmlspecialchars($subject) . '</title></head><body>' . $meta_banner . $message . '</body></html>';
    }

    @file_put_contents($filename, $output);

    // Also log the event to debug.log
    error_log("PC_MAIL_INTERCEPT: saved to {$filename} (to: {$to_str}, subject: {$subject})");

    // Return true to tell wp_mail() "we handled it, don't send"
    return true;
}
