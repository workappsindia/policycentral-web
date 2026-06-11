<?php
/**
 * Migration 064: Include compliance content in the XML sitemap + bust cache.
 *
 * Two fixes in one batch:
 *  1. Rank Math only sitemaps a post type when `pt_{type}_sitemap` is enabled
 *     in its sitemap settings; the keys never existed for the CPTs registered
 *     by the compliance module, so the rule decodes and enforcement records
 *     were excluded everywhere. Turn both on.
 *  2. Production's page-sitemap.xml is still a cached copy that omits the
 *     4 use-case pages added by migration 057 (same failure mode migrations
 *     044 and 051 fixed for earlier batches). Invalidate the cache so the
 *     sitemap regenerates — this also materialises the new rbi_rule /
 *     rbi_enforcement sitemaps and the compliance-sitemap.xml of virtual
 *     views added by PCC_Sitemap.
 *
 * Idempotent: option writes set the same values; cache invalidation is safe
 * to run any number of times.
 */

function pcgpt_migration_064_compliance_sitemap_and_cache() {

    $opts = get_option('rank-math-options-sitemap', array());
    if (is_array($opts)) {
        $opts['pt_rbi_rule_sitemap']        = 'on';
        $opts['pt_rbi_enforcement_sitemap'] = 'on';
        update_option('rank-math-options-sitemap', $opts);
    }

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }

    do_action('rank_math/sitemap/invalidate');
}
