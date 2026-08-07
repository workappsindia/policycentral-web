<?php
/**
 * Migration 102: Create the Policy Library PDF job queue table.
 *
 * wp_pcpl_pdf_jobs is the durable source of truth for personalized-PDF delivery.
 * A lead submission enqueues a row here; the request returns instantly and the
 * job is drained asynchronously (fastcgi_finish_request in-request, a scheduled
 * cron event, and a reaper that retries anything left pending/stale). Because the
 * job is persisted, delivery survives WP-Cron being unavailable (e.g. behind HTTP
 * Basic Auth on dev) — the reaper picks it up on the next admin_init or cron tick.
 *
 * Idempotent: dbDelta creates the table only if absent.
 */

function pcgpt_migration_102_create_pcpl_pdf_jobs_table() {
    global $wpdb;
    $table   = $wpdb->prefix . 'pcpl_pdf_jobs';
    $charset = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $sql = "CREATE TABLE {$table} (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        lead_id BIGINT(20) UNSIGNED NULL,
        policy_slug VARCHAR(200) NOT NULL DEFAULT '',
        payload LONGTEXT NULL,
        status VARCHAR(20) NOT NULL DEFAULT 'pending',
        attempts SMALLINT(5) UNSIGNED NOT NULL DEFAULT 0,
        last_error TEXT NULL,
        claimed_at DATETIME NULL,
        created_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
        updated_at DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
        PRIMARY KEY  (id),
        KEY status_created (status, created_at),
        KEY claimed_at (claimed_at)
    ) {$charset};";

    dbDelta($sql);
}
