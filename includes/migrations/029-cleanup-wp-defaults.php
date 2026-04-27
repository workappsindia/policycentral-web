<?php
/**
 * Migration 029: Remove WP-default "Hello world!" post and "Uncategorized"
 * category that were left behind on production.
 *
 * Migration 006 attempted to delete Uncategorized but only when its count was
 * zero. Hello World is in Uncategorized, so the count was 1 and the deletion
 * was skipped. This migration cleans both up explicitly.
 *
 * Idempotent:
 * - Skips deletion if either no longer exists.
 * - Hello World identified by slug "hello-world" AND post_type "post"
 *   (won't accidentally match a real post if a content writer happens to
 *   reuse the slug for a real post — they'd use a different post_type or
 *   the slug would be auto-suffixed by WP).
 * - Uncategorized only deleted if its count is now zero (defensive — a real
 *   post could have been categorized into it manually since 006 ran).
 */

function pcgpt_migration_029_cleanup_wp_defaults() {

    /* ═══════════════════════════════════════════════════════════
       1. DELETE "Hello world!" POST
       ═══════════════════════════════════════════════════════════ */
    $hello = get_posts(array(
        'name'           => 'hello-world',
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));

    if (!empty($hello)) {
        // force=true skips trash and removes immediately
        wp_delete_post((int) $hello[0]->ID, true);
    }

    /* ═══════════════════════════════════════════════════════════
       2. DELETE "Uncategorized" CATEGORY (only if empty)
       ═══════════════════════════════════════════════════════════ */
    // Re-fetch the term so the count reflects the deletion we just did above.
    $uncat = get_term_by('slug', 'uncategorized', 'category');
    if ($uncat && !is_wp_error($uncat) && (int) $uncat->count === 0) {
        wp_delete_term((int) $uncat->term_id, 'category');
    }

    /* ═══════════════════════════════════════════════════════════
       3. INVALIDATE RANK MATH SITEMAP CACHE
       ═══════════════════════════════════════════════════════════ */
    // If Rank Math is active, force a sitemap cache invalidation so the
    // changes (and the new use case pages + blog posts) appear next time
    // the sitemap is fetched. The wp-cli post-deploy step will also call
    // `wp rankmath sitemap generate` as a belt-and-suspenders regeneration.
    if (class_exists('RankMath\Sitemap\Cache')) {
        if (method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
            RankMath\Sitemap\Cache::invalidate_storage();
        }
    }
    // Also fire the documented action hook in case a different version of
    // Rank Math listens here.
    do_action('rank_math/sitemap/invalidate');
}
