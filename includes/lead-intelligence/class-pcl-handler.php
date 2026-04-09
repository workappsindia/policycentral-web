<?php
/**
 * PCL_Handler — AJAX handlers for non-blocking background processes
 *
 * These run in SEPARATE PHP-FPM workers, NOT in the main form request.
 * Called via pc_fire_background() which uses timeout=0.01 + blocking=false.
 *
 * TWO SEPARATE PROCESSES (critical — do NOT merge):
 *  1. ajax_send_confirmation → sends user confirmation (fast, 2-5s)
 *  2. ajax_run_enrichment    → calls Claude + sends admin email (slow, 1-2min)
 *
 * They must be independent so a Claude failure doesn't block the user email.
 */

defined('ABSPATH') || exit;

class PCL_Handler {

    /**
     * Background handler: send user confirmation email.
     * Invoked by: pc_fire_background('pc_lead_send_confirmation', ['lead_id' => N])
     */
    public static function ajax_send_confirmation() {
        error_log('PCL_Handler::ajax_send_confirmation: WORKER STARTED');
        @set_time_limit(60);

        // Hook to capture actual wp_mail failures
        add_action('wp_mail_failed', function($error) {
            error_log('PCL_Handler: wp_mail_failed (user confirmation) — ' . $error->get_error_message());
        });

        $lead_id = absint($_POST['lead_id'] ?? 0);
        error_log("PCL_Handler::ajax_send_confirmation: lead_id=$lead_id");

        if (!$lead_id) {
            error_log('PCL_Handler::ajax_send_confirmation: missing lead_id — aborting');
            wp_die('', '', array('response' => 400));
        }

        $lead = PCL_DB::get_lead($lead_id);
        if (!$lead) {
            error_log("PCL_Handler::ajax_send_confirmation: lead $lead_id not found in DB");
            wp_die('', '', array('response' => 404));
        }

        error_log("PCL_Handler::ajax_send_confirmation: sending email to {$lead->email}");
        $sent = PCL_Mailer::send_user_confirmation($lead);

        if ($sent) {
            PCL_DB::update_status($lead_id, $lead->enrichment_status ?: 'new', array('confirmation_sent' => 1));
            error_log("PCL_Handler: user confirmation SENT for lead $lead_id");
        } else {
            error_log("PCL_Handler: user confirmation FAILED (wp_mail returned false) for lead $lead_id");
        }

        // Finish after all the DB + mail work
        if (function_exists('fastcgi_finish_request')) {
            @fastcgi_finish_request();
        }
        wp_die();
    }

    /**
     * Background handler: run Claude enrichment + send admin email.
     * Invoked by: pc_fire_background('pc_lead_run_enrichment', ['lead_id' => N])
     */
    public static function ajax_run_enrichment() {
        error_log('PCL_Handler::ajax_run_enrichment: WORKER STARTED');
        @set_time_limit(180);

        // Hook to capture actual wp_mail failures
        add_action('wp_mail_failed', function($error) {
            error_log('PCL_Handler: wp_mail_failed (admin notification) — ' . $error->get_error_message());
        });

        $lead_id = absint($_POST['lead_id'] ?? 0);
        error_log("PCL_Handler::ajax_run_enrichment: lead_id=$lead_id");

        if (!$lead_id) {
            error_log('PCL_Handler::ajax_run_enrichment: missing lead_id — aborting');
            wp_die('', '', array('response' => 400));
        }

        // Run the enrichment pipeline (saves intel + sends enriched admin email)
        PCL_Enrichment::process($lead_id);

        // Finish AFTER all the work
        if (function_exists('fastcgi_finish_request')) {
            @fastcgi_finish_request();
        }
        wp_die();
    }
}
