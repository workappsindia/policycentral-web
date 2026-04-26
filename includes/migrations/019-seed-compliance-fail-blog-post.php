<?php
/**
 * Migration 019: Seed the fifth blog post — "Why Most Companies Fail at
 * Policy Compliance" — under the Policy Management Software category, with
 * Kaizad Shroff as the author (created in migration 017).
 *
 * Idempotent: skips if the slug already exists.
 *
 * Body:           data/why-companies-fail-policy-compliance.html
 * Featured image: assets/blog-images/why-companies-fail-policy-compliance.jpg
 */

function pcgpt_migration_019_seed_compliance_fail_blog_post() {

    $slug = 'why-companies-fail-policy-compliance';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return;
    }

    $content_file = __DIR__ . '/data/why-companies-fail-policy-compliance.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 019: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 019: content file empty');
        return;
    }

    $pms_cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$pms_cat || is_wp_error($pms_cat)) {
        error_log('PCGPT Migration 019: Policy Management Software category missing');
        return;
    }

    // Look up Kaizad (created by migration 017)
    $kaizad_id = 0;
    if (post_type_exists('pc_author')) {
        $kaizad = get_posts(array(
            'name'        => 'kaizad-shroff',
            'post_type'   => 'pc_author',
            'post_status' => 'publish',
            'numberposts' => 1,
        ));
        $kaizad_id = !empty($kaizad) ? (int) $kaizad[0]->ID : 0;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Why Most Companies Fail at Policy Compliance',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Discover why policy compliance fails in organizations and how to fix it with better governance, tracking, and centralized policy management systems.',
        'post_category' => array((int) $pms_cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 019: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    update_post_meta($post_id, '_pcb_primary_category', (int) $pms_cat->term_id);
    if ($kaizad_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $kaizad_id);
    }

    wp_set_post_terms($post_id, array(
        'policy-compliance',
        'policy-management',
        'governance',
        'audit-readiness',
        'compliance',
        'risk-management',
        'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/why-companies-fail.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'why-companies-fail.jpg', 'Why Most Companies Fail at Policy Compliance');
    }
}
