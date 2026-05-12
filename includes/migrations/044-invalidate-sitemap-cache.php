<?php
/**
 * Migration 044: Invalidate Rank Math sitemap cache.
 *
 * Migrations 032–043 seeded 6 new blog posts (and the indian-labour-codes
 * category) but did not invalidate the Rank Math sitemap cache. As a result
 * post-sitemap.xml on production is still serving the cached XML from
 * 2026-04-27 and the new posts are not listed.
 *
 * This migration mirrors the sitemap-invalidation block at the bottom of
 * migration 029.
 *
 * Idempotent: cache invalidation is safe to run any number of times.
 */

function pcgpt_migration_044_invalidate_sitemap_cache() {

    if (class_exists('RankMath\Sitemap\Cache')) {
        if (method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
            RankMath\Sitemap\Cache::invalidate_storage();
        }
    }

    do_action('rank_math/sitemap/invalidate');
}
