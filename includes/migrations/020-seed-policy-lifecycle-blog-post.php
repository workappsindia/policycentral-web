<?php
/**
 * Migration 020: Seed the sixth blog post — "Policy Lifecycle Management:
 * From Draft to Employee Acknowledgement" — under the Policy Management
 * Software category, with Kaizad Shroff as the author.
 *
 * Idempotent: skips if the slug already exists.
 *
 * Body:           data/policy-lifecycle-management.html
 * Featured image: assets/blog-images/policy-lifecycle-management.jpg
 */

function pcgpt_migration_020_seed_policy_lifecycle_blog_post() {

    $slug = 'policy-lifecycle-management';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return;
    }

    $content_file = __DIR__ . '/data/policy-lifecycle-management.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 020: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 020: content file empty');
        return;
    }

    $pms_cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$pms_cat || is_wp_error($pms_cat)) {
        error_log('PCGPT Migration 020: Policy Management Software category missing');
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
        'post_title'    => 'Policy Lifecycle Management: From Draft to Employee Acknowledgement',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Learn how to manage the complete policy lifecycle, from drafting and approval to employee acknowledgement and audit-ready tracking. A step-by-step guide for compliance and HR teams.',
        'post_category' => array((int) $pms_cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 020: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    update_post_meta($post_id, '_pcb_primary_category', (int) $pms_cat->term_id);
    if ($kaizad_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $kaizad_id);
    }

    wp_set_post_terms($post_id, array(
        'policy-lifecycle',
        'policy-management',
        'acknowledgement',
        'attestation',
        'audit-readiness',
        'compliance',
        'governance',
        'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/policy-lifecycle-document.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'policy-lifecycle-document.jpg', 'Policy Lifecycle Management');
    }
}
