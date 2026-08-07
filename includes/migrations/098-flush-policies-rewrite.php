<?php
/**
 * Migration 098: Flush rewrite rules after moving the Policy Library from
 * /resources/policies/ to /policies/ (CPT + taxonomy rewrite slugs changed).
 *
 * The pc_policy CPT registers with the new slug on `init`, but WP caches the
 * rewrite rules in the DB until flushed. This regenerates them so
 * /policies/, /policies/{slug}/ and /policies/category/{cat}/ resolve.
 * Idempotent: flushing repeatedly is harmless.
 */

function pcgpt_migration_098_flush_policies_rewrite() {
    // Ensure the CPT/taxonomy are registered before flushing.
    if (class_exists('PCPL_CPT') && method_exists('PCPL_CPT', 'register_all')) {
        PCPL_CPT::register_all();
    }
    flush_rewrite_rules(false);

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
