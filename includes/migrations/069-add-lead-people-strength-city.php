<?php
/**
 * Migration 069: Add user-entered "people strength" and "city" columns to wp_pc_leads
 *
 * Two new optional contact-form fields land in the leads table:
 *  - people_strength : the company headcount band the lead selects (e.g. "51-200")
 *  - contact_city    : the city the lead types. Named contact_city to stay distinct
 *                      from geo_city, which is the IP-derived city we already store.
 *
 * Idempotent: checks information_schema before each ALTER (same pattern as
 * migration 003). Forward-only; safe to run multiple times.
 */

function pcgpt_migration_069_add_lead_people_strength_city() {
    global $wpdb;
    $leads_table = $wpdb->prefix . 'pc_leads';

    // Bail safely if the leads table doesn't exist yet (migration 003 creates it).
    if ($wpdb->get_var("SHOW TABLES LIKE '$leads_table'") !== $leads_table) {
        return;
    }

    $columns_to_add = array(
        'people_strength' => "VARCHAR(50)  DEFAULT ''",
        'contact_city'    => "VARCHAR(100) DEFAULT ''",
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
}
