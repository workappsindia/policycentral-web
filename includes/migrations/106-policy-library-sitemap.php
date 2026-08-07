<?php
/**
 * Migration 106: Include the Policy Templates section in the XML sitemap.
 *
 * Rank Math only sitemaps a post type / taxonomy when its `*_sitemap` setting is
 * enabled, and those keys never existed for the policy library, so the whole
 * section was missing from /sitemap_index.xml. Turn both on:
 *   - pt_pc_policy_sitemap: the 29 policy pages AND the /policies/ archive
 *     (Rank Math's post-type provider prepends the CPT archive automatically).
 *   - tax_pc_policy_category_sitemap: the 6 category hub pages.
 * Then bust the sitemap cache so the index regenerates with the new sub-sitemaps.
 *
 * Idempotent: option writes set the same values; cache invalidation is safe to
 * run any number of times.
 */

function pcgpt_migration_106_policy_library_sitemap() {

    $opts = get_option('rank-math-options-sitemap', array());
    if (is_array($opts)) {
        $opts['pt_pc_policy_sitemap']           = 'on';
        $opts['tax_pc_policy_category_sitemap'] = 'on';
        update_option('rank-math-options-sitemap', $opts);
    }

    // The /policies/ archive rule must exist before Rank Math can link it.
    flush_rewrite_rules(false);

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
