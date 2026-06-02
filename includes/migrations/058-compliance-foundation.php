<?php
/**
 * Migration 058: Compliance Intelligence foundation
 *
 * - Creates wp_pc_instrument_edges — the RBI instrument dependency graph
 *   (amends / repeals / references edges between notifications).
 * - Flushes rewrite rules so the new CPT permalinks resolve:
 *     rbi_rule        → /compliance/rules/{slug}
 *     rbi_enforcement → /compliance/enforcement/{id}
 *
 * The CPTs + taxonomies themselves are registered in code
 * (includes/compliance/), which has already run on 'init' by the time this
 * migration fires on admin_init — so the flush captures their rewrite rules.
 *
 * Idempotent: dbDelta is safe to re-run; the flush is harmless to repeat.
 */

function pcgpt_migration_058_compliance_foundation() {
    global $wpdb;
    $charset     = $wpdb->get_charset_collate();
    $edges_table = $wpdb->prefix . 'pc_instrument_edges';

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta("CREATE TABLE $edges_table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        from_id VARCHAR(32) NOT NULL,
        to_id VARCHAR(32) NOT NULL,
        edge_type VARCHAR(20) NOT NULL DEFAULT 'references',
        snippet TEXT,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY from_id (from_id),
        KEY to_id (to_id),
        KEY edge_type (edge_type)
    ) $charset;");

    // Register the new CPT permalink structures.
    flush_rewrite_rules(false);
}
