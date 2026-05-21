<?php
/**
 * Migration 049: Seed the "How to Prepare for a Policy Audit" blog post.
 *
 * Idempotent. Body in data/policy-audit-checklist-indian-hr-compliance.html.
 * Image at /assets/blog-images/policy-audit-checklist.jpg.
 * Category: compliance-audit. Author: mansi-kumar.
 */

function pcgpt_migration_049_seed_policy_audit_checklist_blog_post() {

    $slug = 'policy-audit-checklist-indian-hr-compliance';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/policy-audit-checklist-indian-hr-compliance.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 049: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'compliance-audit', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 049: category missing'); return; }

    $mansi_id = 0;
    if (post_type_exists('pc_author')) {
        $mansi = get_posts(array('name'=>'mansi-kumar','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($mansi)) $mansi_id = (int) $mansi[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'How to Prepare for a Policy Audit: A Checklist for Indian HR and Compliance Teams',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'A six-phase checklist for Indian HR and compliance teams to audit their policy environment before a regulator does. Inventory, currency review, version control, acknowledgment trail, communication accessibility, and a ready-to-produce audit pack.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 049: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($mansi_id > 0) update_post_meta($post_id, '_pcb_guest_author', $mansi_id);

    wp_set_post_terms($post_id, array(
        'policy-audit', 'audit-readiness', 'compliance', 'hr-policy',
        'posh-act', 'governance', 'policy-management', 'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/policy-audit-checklist.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'policy-audit-checklist.jpg', 'Policy Audit Checklist for Indian HR and Compliance Teams');
    }
}
