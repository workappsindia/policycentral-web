<?php
/**
 * Policy Library — durable PDF job queue + async drains.
 *
 * A lead submission enqueues a job (wp_pcpl_pdf_jobs) and returns instantly. The
 * job (PDF build + email to requester + webmaster notification) is then drained
 * by whichever of these fires first — all idempotent via an atomic claim:
 *   1. in-request, after the response is flushed (fastcgi_finish_request);
 *   2. a scheduled single cron event (pcpl_process_job);
 *   3. the reaper (admin_init + a recurring 5-min cron) which retries anything
 *      left pending or stuck 'processing' beyond STALE_SECS.
 *
 * Failed jobs retry up to MAX_ATTEMPTS, then are marked 'failed' and the
 * webmaster is emailed the error. The actual PDF/email work lives in PCPL_Lead.
 */
defined('ABSPATH') || exit;

class PCPL_Queue {

    const HOOK_JOB    = 'pcpl_process_job';   // single-event: process one job id
    const HOOK_REAPER = 'pcpl_reaper';        // recurring: drain the queue
    const SCHEDULE    = 'pcpl_5min';
    const MAX_ATTEMPTS = 3;
    const STALE_SECS   = 300;                  // a 'processing' job older than this is retryable
    const REAP_BATCH   = 20;

    public static function table() {
        global $wpdb;
        return $wpdb->prefix . 'pcpl_pdf_jobs';
    }

    public static function register() {
        add_action(self::HOOK_JOB, array(__CLASS__, 'process_job'), 10, 1);
        add_action(self::HOOK_REAPER, array(__CLASS__, 'reaper'));
        add_filter('cron_schedules', array(__CLASS__, 'add_schedule'));

        // Ensure the recurring reaper is scheduled.
        if (!wp_next_scheduled(self::HOOK_REAPER)) {
            wp_schedule_event(time() + 60, self::SCHEDULE, self::HOOK_REAPER);
        }

        // Backstop drain whenever an admin loads wp-admin (throttled to once/min)
        // — covers environments where the WP-Cron loopback is blocked.
        add_action('admin_init', array(__CLASS__, 'maybe_reap_on_admin'));
    }

    public static function add_schedule($schedules) {
        if (!isset($schedules[self::SCHEDULE])) {
            $schedules[self::SCHEDULE] = array('interval' => 300, 'display' => 'Every 5 minutes (PCPL)');
        }
        return $schedules;
    }

    /** Insert a job row; returns the new job id (0 on failure). */
    public static function enqueue($lead_id, $policy_slug, array $payload) {
        global $wpdb;
        $now = current_time('mysql');
        $ok = $wpdb->insert(self::table(), array(
            'lead_id'     => $lead_id ? (int) $lead_id : null,
            'policy_slug' => $policy_slug,
            'payload'     => wp_json_encode($payload),
            'status'      => 'pending',
            'attempts'    => 0,
            'created_at'  => $now,
            'updated_at'  => $now,
        ));
        return $ok ? (int) $wpdb->insert_id : 0;
    }

    /**
     * Fire the fastest available drain for a single job. Always schedules a cron
     * fallback too; the atomic claim makes double-draining a no-op.
     */
    public static function kick($job_id) {
        if (!wp_next_scheduled(self::HOOK_JOB, array($job_id))) {
            wp_schedule_single_event(time(), self::HOOK_JOB, array($job_id));
        }
        spawn_cron();
    }

    /**
     * Atomically claim + process one job. Safe to call concurrently: only the
     * caller whose UPDATE flips 'pending' (or a stale 'processing') to
     * 'processing' proceeds.
     */
    public static function process_job($job_id) {
        global $wpdb;
        $job_id = (int) $job_id;
        if (!$job_id) return;
        $t   = self::table();
        $now = current_time('mysql');
        $stale = gmdate('Y-m-d H:i:s', current_time('timestamp') - self::STALE_SECS);

        $claimed = $wpdb->query($wpdb->prepare(
            "UPDATE {$t} SET status='processing', attempts=attempts+1, claimed_at=%s, updated_at=%s
             WHERE id=%d AND (status='pending' OR (status='processing' AND claimed_at < %s))",
            $now, $now, $job_id, $stale
        ));
        if (!$claimed) return; // already done, or claimed by another drain

        $job = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$t} WHERE id=%d", $job_id));
        if (!$job) return;
        $payload = json_decode($job->payload, true);
        if (!is_array($payload)) $payload = array();

        try {
            PCPL_Lead::fulfill_job($job->policy_slug, $payload); // build PDF + deliver
            $wpdb->update($t, array('status' => 'done', 'last_error' => null, 'updated_at' => current_time('mysql')), array('id' => $job_id));
        } catch (\Throwable $e) {
            $err = $e->getMessage();
            error_log('PCPL_Queue job ' . $job_id . ' failed: ' . $err);
            if ((int) $job->attempts >= self::MAX_ATTEMPTS) {
                $wpdb->update($t, array('status' => 'failed', 'last_error' => $err, 'updated_at' => current_time('mysql')), array('id' => $job_id));
                PCPL_Lead::notify_job_failed($job->policy_slug, $payload, $err);
            } else {
                // back to pending for the reaper/cron to retry
                $wpdb->update($t, array('status' => 'pending', 'last_error' => $err, 'updated_at' => current_time('mysql')), array('id' => $job_id));
            }
        }
    }

    /** Drain a bounded batch of pending / stale-processing jobs. */
    public static function reaper() {
        global $wpdb;
        $t = self::table();
        $stale = gmdate('Y-m-d H:i:s', current_time('timestamp') - self::STALE_SECS);
        $ids = $wpdb->get_col($wpdb->prepare(
            "SELECT id FROM {$t}
             WHERE status='pending' OR (status='processing' AND claimed_at < %s)
             ORDER BY id ASC LIMIT %d",
            $stale, self::REAP_BATCH
        ));
        foreach ((array) $ids as $id) {
            self::process_job((int) $id);
        }
    }

    /** admin_init backstop, throttled to at most once per minute. */
    public static function maybe_reap_on_admin() {
        if (get_transient('pcpl_reaper_lock')) return;
        set_transient('pcpl_reaper_lock', 1, MINUTE_IN_SECONDS);
        self::reaper();
    }
}
