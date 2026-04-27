<?php
/**
 * Migration 031: Mark /explore/ and /explore1/ as noindex/nofollow at the
 * Rank Math post-meta level.
 *
 * The PHP filters in functions.php (wp_robots / rank_math/frontend/robots)
 * already produce a noindex meta tag on the front-end. However, Rank Math
 * builds its sitemap from per-post meta_keys, not from those filters — so
 * the only reliable way to exclude these pages from the sitemap is to set
 * the canonical `rank_math_robots` post_meta to ['noindex', 'nofollow'].
 *
 * Idempotent: only writes the meta if currently empty or different from
 * the desired value.
 */

function pcgpt_migration_031_noindex_explore_pages() {

    $slugs   = array('explore', 'explore1');
    $desired = array('noindex', 'nofollow');

    foreach ($slugs as $slug) {
        $existing = get_posts(array(
            'name'        => $slug,
            'post_type'   => 'page',
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));

        if (empty($existing)) continue;

        $page_id = (int) $existing[0]->ID;
        $current = get_post_meta($page_id, 'rank_math_robots', true);

        // Only update if it's missing or doesn't match. Preserves any
        // additional directives a content editor may have added (e.g. nosnippet).
        if (!is_array($current) || !in_array('noindex', $current, true) || !in_array('nofollow', $current, true)) {
            update_post_meta($page_id, 'rank_math_robots', $desired);
        }
    }

    // Invalidate the Rank Math sitemap cache so the change surfaces on the
    // next sitemap fetch.
    if (class_exists('RankMath\Sitemap\Cache')) {
        if (method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
            RankMath\Sitemap\Cache::invalidate_storage();
        }
    }
    do_action('rank_math/sitemap/invalidate');
}
