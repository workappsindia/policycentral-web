<?php
/**
 * Migration 121: Lead attribution columns on wp_pc_leads
 *
 * Paid-ad attribution (ChatGPT Ads to /explore1/) needs the full UTM set on the lead
 * record itself, not just in GA4:
 *  - utm_content / utm_term : ad id and keyword (utm_source/medium/campaign already exist)
 *  - gclid                  : Google click id, if present
 *  - landing_page           : path of the first page of the visit
 *  - ext_referrer           : document.referrer captured client-side (the existing
 *                             `referrer` column is the server-seen HTTP_REFERER, which for
 *                             an AJAX post is just the form page itself)
 * Also widens utm_source/medium/campaign from 100 to 200 chars.
 *
 * Idempotent: checks information_schema before each ALTER. Forward-only.
 */

function pcgpt_migration_121_lead_attribution_columns() {
    global $wpdb;
    $leads_table = $wpdb->prefix . 'pc_leads';

    if ($wpdb->get_var("SHOW TABLES LIKE '$leads_table'") !== $leads_table) {
        return;
    }

    $columns_to_add = array(
        'utm_content'  => "VARCHAR(200) DEFAULT ''",
        'utm_term'     => "VARCHAR(200) DEFAULT ''",
        'gclid'        => "VARCHAR(200) DEFAULT ''",
        'landing_page' => "VARCHAR(200) DEFAULT ''",
        'ext_referrer' => "VARCHAR(200) DEFAULT ''",
    );

    foreach ($columns_to_add as $col => $definition) {
        $exists = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM information_schema.COLUMNS
             WHERE TABLE_SCHEMA = DATABASE()
             AND TABLE_NAME = %s
             AND COLUMN_NAME = %s",
            $leads_table, $col
        ));

        if (!$exists) {
            // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
            $wpdb->query("ALTER TABLE `$leads_table` ADD COLUMN `$col` $definition");
        }
    }

    // Widen the three pre-existing UTM columns (MODIFY is a safe no-op if already 200).
    foreach (array('utm_source', 'utm_medium', 'utm_campaign') as $col) {
        // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
        $wpdb->query("ALTER TABLE `$leads_table` MODIFY COLUMN `$col` VARCHAR(200) DEFAULT ''");
    }
}
