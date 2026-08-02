<?php
/**
 * Migration 097: Seed the Policy Library (/policies/).
 *
 * Creates the 6 pc_policy_category terms (from pcpl_categories()) and the
 * curated policy templates from includes/policy-library/data/policies.json:
 *   post_content = body HTML, post_excerpt = byline,
 *   meta _pcpl_covers / _pcpl_faqs = JSON, category term assigned.
 *
 * Idempotent: upserts terms + posts by slug; safe to re-run when the data file
 * grows (e.g. as HR handbook policies are added).
 */

function pcgpt_migration_097_seed_policy_library() {
    if (!class_exists('PCPL_CPT') || !function_exists('pcpl_categories')) return;

    $tax = PCPL_CPT::TAXONOMY;
    $pt  = PCPL_CPT::POST_TYPE;

    // 1) Category terms
    foreach (pcpl_categories() as $slug => $c) {
        $existing = term_exists($slug, $tax);
        if (!$existing) {
            wp_insert_term($c['name'], $tax, array('slug' => $slug, 'description' => $c['desc']));
        } else {
            $tid = (int) (is_array($existing) ? $existing['term_id'] : $existing);
            wp_update_term($tid, $tax, array('name' => $c['name'], 'description' => $c['desc']));
        }
    }

    // 2) Policy templates
    $file = get_template_directory() . '/includes/policy-library/data/policies.json';
    if (!file_exists($file)) { error_log('PCGPT Migration 097: policy data file missing'); return; }
    $data = json_decode(file_get_contents($file), true);
    if (empty($data['policies'])) return;

    foreach ($data['policies'] as $p) {
        if (empty($p['slug']) || empty($p['title'])) continue;

        $existing = get_posts(array(
            'name'        => $p['slug'],
            'post_type'   => $pt,
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));

        $args = array(
            'post_title'   => $p['title'],
            'post_name'    => $p['slug'],
            'post_status'  => 'publish',
            'post_type'    => $pt,
            'post_content' => isset($p['body']) ? $p['body'] : '',
            'post_excerpt' => isset($p['byline']) ? $p['byline'] : '',
            'post_author'  => 1,
        );
        if (!empty($existing)) {
            $args['ID'] = $existing[0]->ID;
            $pid = wp_update_post($args);
        } else {
            $pid = wp_insert_post($args);
        }
        if (is_wp_error($pid) || !$pid) continue;

        // Category
        if (!empty($p['category'])) {
            $term = get_term_by('slug', $p['category'], $tax);
            if ($term) wp_set_object_terms($pid, array((int) $term->term_id), $tax);
        }
        // Meta (JSON-encoded lists)
        update_post_meta($pid, '_pcpl_covers', wp_slash(json_encode(isset($p['covers']) ? $p['covers'] : array())));
        update_post_meta($pid, '_pcpl_faqs',   wp_slash(json_encode(isset($p['faqs'])   ? $p['faqs']   : array())));
    }

    flush_rewrite_rules(false);

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
