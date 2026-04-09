<?php
/**
 * Migration 001: Initial PolicyGPT tables and seed data
 *
 * Creates three DB tables and seeds them with default content:
 * - wp_pcgpt_knowledge  (12 knowledge base categories)
 * - wp_pcgpt_queries    (search query logs)
 * - wp_pcgpt_config     (contact info + bot behaviour)
 *
 * Idempotent: uses dbDelta() for tables (safe to re-run) and INSERT IGNORE for seeds.
 */

function pcgpt_migration_001_initial_tables() {
    global $wpdb;
    $charset = $wpdb->get_charset_collate();

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    // Knowledge base table
    dbDelta("CREATE TABLE {$wpdb->prefix}pcgpt_knowledge (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        category_id VARCHAR(50) NOT NULL,
        content LONGTEXT NOT NULL,
        updated_by BIGINT UNSIGNED NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY category_id (category_id)
    ) $charset;");

    // Query logs table
    dbDelta("CREATE TABLE {$wpdb->prefix}pcgpt_queries (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        query TEXT NOT NULL,
        response LONGTEXT NULL,
        category VARCHAR(50) NULL,
        ip_address VARCHAR(45) DEFAULT '',
        user_agent TEXT DEFAULT '',
        session_id VARCHAR(64) DEFAULT '',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY created_at (created_at)
    ) $charset;");

    // Config table (contact info, bot behaviour)
    dbDelta("CREATE TABLE {$wpdb->prefix}pcgpt_config (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        config_key VARCHAR(100) NOT NULL,
        config_value LONGTEXT NOT NULL,
        updated_by BIGINT UNSIGNED NULL,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY config_key (config_key)
    ) $charset;");

    // Seed default knowledge base content (uses INSERT IGNORE to avoid overwriting)
    $table_kb = $wpdb->prefix . 'pcgpt_knowledge';
    $defaults = pcgpt_get_default_knowledge();
    foreach ($defaults as $cat_id => $content) {
        $wpdb->query($wpdb->prepare(
            "INSERT IGNORE INTO $table_kb (category_id, content, updated_at) VALUES (%s, %s, %s)",
            $cat_id, $content, current_time('mysql')
        ));
    }

    // Seed contact defaults
    $table_config = $wpdb->prefix . 'pcgpt_config';
    $contact = json_encode(array(
        'name'  => 'Kaizad Shroff',
        'role'  => 'Business Head',
        'phone' => '+91 98909 88498',
        'email' => 'contact@policycentral.ai',
        'web'   => 'https://www.policycentral.ai',
        'wa'    => 'https://wa.me/919890988498',
    ));
    $wpdb->query($wpdb->prepare(
        "INSERT IGNORE INTO $table_config (config_key, config_value, updated_at) VALUES (%s, %s, %s)",
        'contact', $contact, current_time('mysql')
    ));

    // Seed behaviour defaults
    $behaviour = json_encode(array(
        'name'    => 'PolicyGPT',
        'tone'    => 'confident_witty',
        'length'  => 'balanced',
        'pricing' => 'deflect',
        'custom'  => 'Always emphasise that PolicyCentral.ai is trusted by leading BFSI organisations including HDFC Life and Kotak Mahindra Bank. Be direct and confident. Avoid generic AI-sounding language.',
        'avoid'   => 'Specific pricing numbers, competitor names, unannounced features, internal roadmap details',
    ));
    $wpdb->query($wpdb->prepare(
        "INSERT IGNORE INTO $table_config (config_key, config_value, updated_at) VALUES (%s, %s, %s)",
        'behaviour', $behaviour, current_time('mysql')
    ));
}
