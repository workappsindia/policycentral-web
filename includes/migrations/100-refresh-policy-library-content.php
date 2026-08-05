<?php
/**
 * Migration 100: Re-sync Policy Library content from policies.json.
 *
 * Refreshes post_content (body), post_excerpt (byline) and the _pcpl_covers /
 * _pcpl_faqs meta for every pc_policy that already exists, matched by slug.
 * Does NOT create posts or terms (097 owns seeding) and never touches a policy
 * that isn't present, so it is a safe content-only refresh.
 *
 * Trigger for this migration: the customer-complaint-grievance-policy body had
 * its "Grievance Redressal Process" steps mis-seeded as six empty <h2> sections
 * (rendering big & bold) and carried literal **markdown** markers; the corrected
 * body lives in policies.json. This migration lands that fix on each environment.
 *
 * Idempotent: re-running simply re-applies the current JSON to the DB.
 */

function pcgpt_migration_100_refresh_policy_library_content() {
    if (!class_exists('PCPL_CPT')) return;
    $pt = PCPL_CPT::POST_TYPE;

    $file = get_template_directory() . '/includes/policy-library/data/policies.json';
    if (!file_exists($file)) { error_log('PCGPT Migration 100: policy data file missing'); return; }
    $data = json_decode(file_get_contents($file), true);
    if (empty($data['policies'])) return;

    foreach ($data['policies'] as $p) {
        if (empty($p['slug'])) continue;

        $existing = get_posts(array(
            'name'        => $p['slug'],
            'post_type'   => $pt,
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));
        if (empty($existing)) continue; // seeding is 097's job, not this refresh

        wp_update_post(array(
            'ID'           => $existing[0]->ID,
            'post_content' => isset($p['body'])   ? $p['body']   : '',
            'post_excerpt' => isset($p['byline']) ? $p['byline'] : '',
        ));
        update_post_meta($existing[0]->ID, '_pcpl_covers', wp_slash(json_encode(isset($p['covers']) ? $p['covers'] : array())));
        update_post_meta($existing[0]->ID, '_pcpl_faqs',   wp_slash(json_encode(isset($p['faqs'])   ? $p['faqs']   : array())));
    }

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
