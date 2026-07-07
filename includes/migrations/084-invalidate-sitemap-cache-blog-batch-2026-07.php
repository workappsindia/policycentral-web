<?php
/**
 * Migration 084: Invalidate the Rank Math sitemap cache after the July 2026
 * blog batch (migrations 079 to 083 add five new posts).
 *
 * New posts ride Rank Math's standard post-sitemap.xml, but the cached XML on
 * the servers omits them until the cache is busted. Ships in the same batch as
 * the content it surfaces (convention since migrations 044/051/064/076).
 *
 * Idempotent: cache invalidation is safe to run any number of times.
 */

function pcgpt_migration_084_invalidate_sitemap_cache_blog_batch_2026_07() {

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }

    do_action('rank_math/sitemap/invalidate');
}
