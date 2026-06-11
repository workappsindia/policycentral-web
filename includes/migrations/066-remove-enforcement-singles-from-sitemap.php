<?php
/**
 * Migration 066: Remove enforcement-single pages from the XML sitemap.
 *
 * Client call (2026-06-12): per-penalty pages naming entities
 * (/compliance/enforcement/{slug}/) could read as negative PR — the records
 * stay on the tracker and hub cards only. The CPT is now registered
 * non-public and the URLs 301 to the tracker, so this migration:
 *  1. turns the rbi_enforcement post type sitemap OFF (it was enabled by
 *     migration 064 earlier the same day and the URLs were briefly live), and
 *  2. invalidates the sitemap cache so rbi_enforcement-sitemap.xml drops out
 *     of sitemap_index.xml immediately.
 *
 * Idempotent: option writes set the same values; cache invalidation is safe
 * to run any number of times.
 */

function pcgpt_migration_066_remove_enforcement_singles_from_sitemap() {

    $opts = get_option('rank-math-options-sitemap', array());
    if (is_array($opts)) {
        $opts['pt_rbi_enforcement_sitemap'] = 'off';
        update_option('rank-math-options-sitemap', $opts);
    }

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }

    do_action('rank_math/sitemap/invalidate');
}
