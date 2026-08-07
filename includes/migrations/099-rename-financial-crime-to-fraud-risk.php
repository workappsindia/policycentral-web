<?php
/**
 * Migration 099: Rename the Policy Library category
 * "Financial Crime & KYC/AML" (slug financial-crime) →
 * "Fraud Risk & KYC/AML" (slug fraud-risk).
 *
 * The section is dev-only (never shipped to prod), so there are no live URLs to
 * redirect. On dev the term was already seeded by 097 with slug financial-crime,
 * so we rename the existing term in place — preserving its term_id and all policy
 * assignments. On a fresh install 097 now seeds `fraud-risk` directly (loader.php
 * updated), so this migration finds nothing to rename and safely no-ops.
 *
 * Idempotent: only acts when the old slug exists and the new slug does not.
 */

function pcgpt_migration_099_rename_financial_crime_to_fraud_risk() {
    if (!class_exists('PCPL_CPT')) return;
    $tax = PCPL_CPT::TAXONOMY;

    $old = get_term_by('slug', 'financial-crime', $tax);
    if (!$old) return; // fresh install already has fraud-risk (or nothing) — nothing to do

    // Guard against a slug collision if fraud-risk somehow already exists.
    if (get_term_by('slug', 'fraud-risk', $tax)) {
        error_log('PCGPT Migration 099: both financial-crime and fraud-risk terms exist; leaving as-is for manual review.');
        return;
    }

    wp_update_term((int) $old->term_id, $tax, array(
        'name' => 'Fraud Risk & KYC/AML',
        'slug' => 'fraud-risk',
    ));

    // Rewrite rules cache the taxonomy term routing; refresh + bust the sitemap.
    flush_rewrite_rules(false);

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
