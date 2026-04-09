<?php
/**
 * Lead Intelligence — Bootstrap Loader
 *
 * Loads all Lead Intelligence classes and registers hooks.
 * Included from functions.php: require_once '.../lead-intelligence/loader.php';
 *
 * ARCHITECTURE (learned from Rank Computers hard-won debugging):
 * - Contact form saves lead immediately
 * - Fires TWO separate non-blocking AJAX loopbacks (NOT one, NOT WP-Cron):
 *     1. pc_lead_send_confirmation  → sends user email (fast, 2-5s)
 *     2. pc_lead_run_enrichment     → calls Claude + sends admin email (slow, 1-2min)
 * - Main form handler returns immediately — user redirects to thank-you instantly
 * - Both background processes run in SEPARATE PHP-FPM workers
 *
 * WHY TWO PROCESSES (not one):
 * - If Claude times out or errors, user confirmation STILL sends (they're independent)
 * - User confirmation doesn't wait for 1-2min Claude research
 * - Admin email waits properly for Claude so it has enriched intelligence
 *
 * FALLBACK: If Claude fails (API error, timeout, bad JSON, 429),
 * admin email still goes out as a BASIC notification (no intelligence block).
 * On 429 rate limit, lead resets to 'new' and retries via cron in 90s.
 */

defined('ABSPATH') || exit;

define('PCL_DIR', __DIR__);
define('PCL_URL', get_template_directory_uri() . '/includes/lead-intelligence');
define('PCL_CRON_HOOK', 'pc_lead_run_enrichment_cron');

// Load all classes
require_once PCL_DIR . '/class-pcl-db.php';
require_once PCL_DIR . '/class-pcl-enrichment.php';
require_once PCL_DIR . '/class-pcl-mailer.php';
require_once PCL_DIR . '/class-pcl-handler.php';
require_once PCL_DIR . '/class-pcl-admin.php';

// Register AJAX handlers for non-blocking background processes.
// nopriv versions are required because the loopback fires without a logged-in session.
add_action('wp_ajax_pc_lead_send_confirmation',        array('PCL_Handler', 'ajax_send_confirmation'));
add_action('wp_ajax_nopriv_pc_lead_send_confirmation', array('PCL_Handler', 'ajax_send_confirmation'));
add_action('wp_ajax_pc_lead_run_enrichment',           array('PCL_Handler', 'ajax_run_enrichment'));
add_action('wp_ajax_nopriv_pc_lead_run_enrichment',    array('PCL_Handler', 'ajax_run_enrichment'));

// Register cron hook for 429 retries (fallback path if rate-limited by Claude)
add_action(PCL_CRON_HOOK, array('PCL_Enrichment', 'process'), 10, 1);

// Bootstrap admin dashboard.
// Note: plugins_loaded has already fired by the time a theme's functions.php loads,
// so we instantiate directly. The class's constructor hooks admin_menu + admin_init
// which fire later in the WP lifecycle.
if (is_admin()) {
    new PCL_Admin();
}

/**
 * Fire a non-blocking HTTP request to our own admin-ajax.php.
 * timeout=0.01 + blocking=false tells PHP "don't wait for a response",
 * so PHP-FPM spins up a new worker to handle the background job
 * while the main request returns immediately.
 *
 * This pattern is critical — DO NOT use WP-Cron (unreliable on many hosts)
 * and DO NOT run these tasks inline (hosting kills long POST requests).
 */
function pc_fire_background($action, $body) {
    $body['action'] = $action;
    wp_remote_post(admin_url('admin-ajax.php'), array(
        'timeout'   => 0.01,
        'blocking'  => false,
        'sslverify' => apply_filters('https_local_ssl_verify', false),
        'headers'   => array('Content-Type' => 'application/x-www-form-urlencoded'),
        'body'      => $body,
    ));
}

/**
 * Helper: lookup approximate geo for an IP using ip-api.com (free, no key).
 * 1-second timeout — never block the request.
 * Returns ['geo_city', 'geo_region', 'geo_country'].
 */
function pc_lead_lookup_geo($ip) {
    $default = array('geo_city' => '', 'geo_region' => '', 'geo_country' => '');

    // Skip private/local IPs
    if (empty($ip) || in_array($ip, array('127.0.0.1', '::1'), true)
        || preg_match('/^(10\.|192\.168\.|172\.(1[6-9]|2\d|3[01])\.)/', $ip)) {
        return array_merge($default, array('geo_city' => 'Local/Dev'));
    }

    $response = wp_remote_get("http://ip-api.com/json/{$ip}?fields=city,regionName,country", array(
        'timeout'   => 1,
        'sslverify' => false,
    ));

    if (is_wp_error($response)) {
        return $default;
    }

    $body = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($body) || ($body['status'] ?? '') === 'fail') {
        return $default;
    }

    return array(
        'geo_city'    => sanitize_text_field($body['city']       ?? ''),
        'geo_region'  => sanitize_text_field($body['regionName'] ?? ''),
        'geo_country' => sanitize_text_field($body['country']    ?? ''),
    );
}
