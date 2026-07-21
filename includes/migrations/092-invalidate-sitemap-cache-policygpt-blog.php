<?php
/**
 * Migration 092: Invalidate the Rank Math sitemap cache after the AI Policy Search
 * blog post (migration 091). Same convention as 076/084/089.
 *
 * Idempotent: cache invalidation is safe to run any number of times.
 */

function pcgpt_migration_092_invalidate_sitemap_cache_policygpt_blog() {

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }

    do_action('rank_math/sitemap/invalidate');
}
