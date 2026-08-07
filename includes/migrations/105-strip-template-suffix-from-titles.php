<?php
/**
 * Migration 105: Drop the trailing " Template" from pc_policy titles.
 *
 * The section is already called "Policy Templates" and every card CTA says
 * "View template", so "... Policy Template" in each title read as repetitive.
 * Strip the suffix from post_title (slug/permalink is unaffected). policies.json
 * has been cleaned to match so fresh re-seeds (097) produce the same titles.
 *
 * Idempotent: once stripped, the suffix no longer matches.
 */

function pcgpt_migration_105_strip_template_suffix_from_titles() {
    if (!class_exists('PCPL_CPT')) return;

    $ids = get_posts(array(
        'post_type'   => PCPL_CPT::POST_TYPE,
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => -1,
        'fields'      => 'ids',
    ));

    foreach ($ids as $pid) {
        $title = get_post_field('post_title', $pid);
        $new   = preg_replace('/\s+Template$/', '', (string) $title);
        if (is_string($new) && $new !== '' && $new !== $title) {
            wp_update_post(array('ID' => $pid, 'post_title' => $new));
        }
    }

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
