<?php
/**
 * Migration 004: Widen wp_pc_lead_intel columns
 *
 * The initial schema had VARCHAR(100)-VARCHAR(255) limits on several enrichment
 * fields. Claude's web_search responses occasionally return values that exceed
 * these (e.g., long company industry descriptions, multi-word role types),
 * causing silent INSERT failures that left the intel table empty while the
 * lead was incorrectly marked as 'enriched'.
 *
 * This migration widens those columns to comfortable limits so Claude's
 * responses always fit without truncation.
 *
 * Idempotent: each ALTER is safe to run multiple times.
 */

function pcgpt_migration_004_widen_intel_columns() {
    global $wpdb;
    $table = $wpdb->prefix . 'pc_lead_intel';

    // Only run if the table exists (migration 003 created it)
    if ($wpdb->get_var("SHOW TABLES LIKE '$table'") !== $table) {
        return;
    }

    $alters = array(
        "ALTER TABLE `$table` MODIFY COLUMN person_designation VARCHAR(500) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN person_role_type VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN company_name VARCHAR(500) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN company_industry VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN company_size VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN company_employee_count VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN company_hq VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN hr_systems TEXT DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN funding_latest_round VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN funding_amount VARCHAR(255) DEFAULT NULL",
        "ALTER TABLE `$table` MODIFY COLUMN funding_date VARCHAR(100) DEFAULT NULL",
    );

    foreach ($alters as $sql) {
        $wpdb->query($sql);
    }
}
