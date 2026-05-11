<?php
/**
 * Migration 037: Seed the "New Joiner Policy Onboarding" blog post.
 *
 * Idempotent. Body in data/new-joiner-policy-onboarding-acknowledgment.html.
 * Image at /assets/blog-images/new-joiner-onboarding.jpg.
 * Category: policy-management-software. Author: kaizad-shroff.
 */

function pcgpt_migration_037_seed_new_joiner_onboarding_blog_post() {

    $slug = 'new-joiner-policy-onboarding-acknowledgment';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/new-joiner-policy-onboarding-acknowledgment.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 037: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 037: category missing'); return; }

    $kaizad_id = 0;
    if (post_type_exists('pc_author')) {
        $kaizad = get_posts(array('name'=>'kaizad-shroff','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($kaizad)) $kaizad_id = (int) $kaizad[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'New Joiner Policy Onboarding: How to Ensure Every Employee Reads and Acknowledges Policies',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Most new joiners sign policies they never read. Build a 30-day onboarding flow that captures verifiable acknowledgment, comprehension checks, and an audit trail — without burying HR in manual follow-up.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 037: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($kaizad_id > 0) update_post_meta($post_id, '_pcb_guest_author', $kaizad_id);

    wp_set_post_terms($post_id, array(
        'policy-management', 'onboarding', 'policy-acknowledgment', 'hr-policy',
        'compliance', 'audit-readiness', 'governance', 'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/new-joiner-onboarding.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'new-joiner-onboarding.jpg', 'New Joiner Policy Onboarding');
    }
}
