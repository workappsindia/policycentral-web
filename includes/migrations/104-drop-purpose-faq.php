<?php
/**
 * Migration 104: Drop the "What is the purpose of this policy?" FAQ.
 *
 * Its answer duplicated each policy's visible intro, so it is removed from every
 * pc_policy's _pcpl_faqs meta. policies.json has been cleaned to match, so fresh
 * re-seeds (097) produce the same result.
 *
 * Idempotent: once removed, there is nothing left to filter.
 */

function pcgpt_migration_104_drop_purpose_faq() {
    if (!class_exists('PCPL_CPT')) return;

    $ids = get_posts(array(
        'post_type'   => PCPL_CPT::POST_TYPE,
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => -1,
        'fields'      => 'ids',
    ));

    foreach ($ids as $pid) {
        $faqs = function_exists('pcpl_meta_list') ? pcpl_meta_list($pid, '_pcpl_faqs') : array();
        if (!$faqs) continue;
        $filtered = array_values(array_filter($faqs, function ($f) {
            return ($f['q'] ?? '') !== 'What is the purpose of this policy?';
        }));
        if (count($filtered) !== count($faqs)) {
            update_post_meta($pid, '_pcpl_faqs', wp_slash(json_encode($filtered)));
        }
    }

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
