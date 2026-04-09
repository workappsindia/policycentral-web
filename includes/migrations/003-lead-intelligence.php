<?php
/**
 * Migration 003: Lead Intelligence System
 *
 * - Adds new columns to wp_pc_leads (reference_id, first_name, geo_*, enrichment_status, etc.)
 * - Creates wp_pc_lead_intel table for Claude enrichment data
 * - Backfills reference_id for any existing leads
 *
 * Idempotent: checks information_schema before ALTER, uses CREATE TABLE IF NOT EXISTS.
 */

function pcgpt_migration_003_lead_intelligence() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();
    $leads_table = $wpdb->prefix . 'pc_leads';
    $intel_table = $wpdb->prefix . 'pc_lead_intel';

    // ── Ensure pc_leads table exists (it normally does from the contact form handler) ──
    // If not, create it with the full schema including new columns.
    if ($wpdb->get_var("SHOW TABLES LIKE '$leads_table'") !== $leads_table) {
        $wpdb->query("CREATE TABLE $leads_table (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            reference_id VARCHAR(20) NOT NULL DEFAULT '',
            full_name VARCHAR(255) NOT NULL DEFAULT '',
            first_name VARCHAR(100) NOT NULL DEFAULT '',
            company VARCHAR(255) NOT NULL DEFAULT '',
            email VARCHAR(255) NOT NULL DEFAULT '',
            phone VARCHAR(50) DEFAULT '',
            message TEXT DEFAULT '',
            ip_address VARCHAR(45) DEFAULT '',
            user_agent TEXT DEFAULT '',
            referrer TEXT DEFAULT '',
            os VARCHAR(50) DEFAULT '',
            browser VARCHAR(50) DEFAULT '',
            device_type VARCHAR(20) DEFAULT '',
            geo_city VARCHAR(100) DEFAULT '',
            geo_region VARCHAR(100) DEFAULT '',
            geo_country VARCHAR(100) DEFAULT '',
            utm_source VARCHAR(100) DEFAULT '',
            utm_medium VARCHAR(100) DEFAULT '',
            utm_campaign VARCHAR(100) DEFAULT '',
            page_source VARCHAR(255) DEFAULT '',
            page_url TEXT DEFAULT '',
            enrichment_status VARCHAR(20) NOT NULL DEFAULT 'new',
            confirmation_sent TINYINT(1) NOT NULL DEFAULT 0,
            admin_email_sent TINYINT(1) NOT NULL DEFAULT 0,
            submitted_at DATETIME NOT NULL,
            PRIMARY KEY (id),
            KEY reference_id (reference_id),
            KEY enrichment_status (enrichment_status),
            KEY submitted_at (submitted_at)
        ) $charset;");
    } else {
        // ── Add missing columns to existing table ──
        $columns_to_add = array(
            'reference_id'      => "VARCHAR(20) NOT NULL DEFAULT ''",
            'first_name'        => "VARCHAR(100) NOT NULL DEFAULT ''",
            'geo_city'          => "VARCHAR(100) DEFAULT ''",
            'geo_region'        => "VARCHAR(100) DEFAULT ''",
            'geo_country'       => "VARCHAR(100) DEFAULT ''",
            'page_source'       => "VARCHAR(255) DEFAULT ''",
            'page_url'          => "TEXT DEFAULT NULL",
            'enrichment_status' => "VARCHAR(20) NOT NULL DEFAULT 'new'",
            'confirmation_sent' => "TINYINT(1) NOT NULL DEFAULT 0",
            'admin_email_sent'  => "TINYINT(1) NOT NULL DEFAULT 0",
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

        // Add indexes if they don't exist
        $existing_indexes = $wpdb->get_col("SHOW INDEX FROM `$leads_table`", 2);
        if (!in_array('reference_id', $existing_indexes, true)) {
            $wpdb->query("ALTER TABLE `$leads_table` ADD KEY reference_id (reference_id)");
        }
        if (!in_array('enrichment_status', $existing_indexes, true)) {
            $wpdb->query("ALTER TABLE `$leads_table` ADD KEY enrichment_status (enrichment_status)");
        }
    }

    // ── Backfill reference_id for any existing leads without one ──
    $wpdb->query(
        "UPDATE $leads_table
         SET reference_id = CONCAT('PC-', LPAD(id, 6, '0'))
         WHERE reference_id = '' OR reference_id IS NULL"
    );

    // ── Backfill first_name for any existing leads ──
    $leads_missing_first_name = $wpdb->get_results(
        "SELECT id, full_name FROM $leads_table WHERE first_name = '' OR first_name IS NULL"
    );
    foreach ($leads_missing_first_name as $row) {
        $first = strtok(trim($row->full_name), ' ');
        $wpdb->update($leads_table, array('first_name' => $first ?: ''), array('id' => $row->id));
    }

    // ── Create pc_lead_intel enrichment table ──
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta("CREATE TABLE $intel_table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        lead_id BIGINT UNSIGNED NOT NULL,
        overall_confidence TINYINT UNSIGNED NOT NULL DEFAULT 0,
        person_found TINYINT(1) NOT NULL DEFAULT 0,
        person_linkedin_url VARCHAR(500) DEFAULT NULL,
        person_designation VARCHAR(255) DEFAULT NULL,
        person_role_type VARCHAR(100) DEFAULT NULL,
        person_accuracy TINYINT UNSIGNED NOT NULL DEFAULT 0,
        company_name VARCHAR(255) DEFAULT NULL,
        company_description TEXT,
        company_website VARCHAR(500) DEFAULT NULL,
        company_industry VARCHAR(100) DEFAULT NULL,
        company_size VARCHAR(100) DEFAULT NULL,
        company_employee_count VARCHAR(100) DEFAULT NULL,
        company_founded VARCHAR(10) DEFAULT NULL,
        company_hq VARCHAR(100) DEFAULT NULL,
        company_accuracy TINYINT UNSIGNED NOT NULL DEFAULT 0,
        tech_stack TEXT,
        hr_systems VARCHAR(500) DEFAULT NULL,
        funding_found TINYINT(1) NOT NULL DEFAULT 0,
        funding_summary TEXT,
        funding_latest_round VARCHAR(50) DEFAULT NULL,
        funding_amount VARCHAR(100) DEFAULT NULL,
        funding_date VARCHAR(50) DEFAULT NULL,
        funding_investors LONGTEXT,
        funding_accuracy TINYINT UNSIGNED NOT NULL DEFAULT 0,
        news_items LONGTEXT,
        pain_points LONGTEXT,
        conversation_starters LONGTEXT,
        research_note TEXT,
        api_raw_response LONGTEXT,
        enriched_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY lead_id (lead_id)
    ) $charset;");
}
