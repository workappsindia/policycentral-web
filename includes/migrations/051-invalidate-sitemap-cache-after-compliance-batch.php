<?php
/**
 * Migration 051: Invalidate Rank Math sitemap cache after the Compliance & Audit batch.
 *
 * Migrations 045–050 added one new category, one new author, and 4 new blog
 * posts. Without this step, post-sitemap.xml on production will continue to
 * serve a cached XML that omits the new posts (same failure mode that
 * migration 044 fixed for the labour-codes batch).
 *
 * Idempotent: cache invalidation is safe to run any number of times.
 */

function pcgpt_migration_051_invalidate_sitemap_cache_after_compliance_batch() {

    if (class_exists('RankMath\Sitemap\Cache')) {
        if (method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
            RankMath\Sitemap\Cache::invalidate_storage();
        }
    }

    do_action('rank_math/sitemap/invalidate');
}
