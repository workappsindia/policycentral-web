<?php
/**
 * Migration 047: Seed the "HR Policy Compliance for Indian Banks and NBFCs" blog post.
 *
 * Idempotent. Body in data/hr-policy-compliance-indian-banks-nbfcs.html.
 * Image at /assets/blog-images/banks-nbfcs-compliance.jpg.
 * Category: compliance-audit. Author: mansi-kumar.
 */

function pcgpt_migration_047_seed_banks_nbfcs_blog_post() {

    $slug = 'hr-policy-compliance-indian-banks-nbfcs';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/hr-policy-compliance-indian-banks-nbfcs.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 047: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'compliance-audit', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 047: category missing'); return; }

    $mansi_id = 0;
    if (post_type_exists('pc_author')) {
        $mansi = get_posts(array('name'=>'mansi-kumar','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($mansi)) $mansi_id = (int) $mansi[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'HR Policy Compliance for Indian Banks and NBFCs',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'RBI inspections do not just check whether HR policies exist — they check whether they are documented, current, communicated, and acknowledged. A practical guide to what banks and NBFCs must document, where most organisations fall short, and how modern platforms close the evidence gap.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 047: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($mansi_id > 0) update_post_meta($post_id, '_pcb_guest_author', $mansi_id);

    wp_set_post_terms($post_id, array(
        'rbi-compliance', 'bfsi', 'banking-compliance', 'nbfc',
        'hr-policy', 'governance', 'audit-readiness', 'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/banks-nbfcs-compliance.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'banks-nbfcs-compliance.jpg', 'HR Policy Compliance for Indian Banks and NBFCs');
    }
}
