<?php
/**
 * Migration 050: Seed the "How Policy Version Control Prevents Legal Risk" blog post.
 *
 * Idempotent. Body in data/policy-version-control-prevents-legal-risk.html.
 * Image at /assets/blog-images/policy-audit-checklist.jpg (reused from blog 049
 * pending a dedicated Version Control thumbnail; can be swapped via a follow-up
 * migration once a unique asset is produced).
 * Category: compliance-audit. Author: mansi-kumar.
 */

function pcgpt_migration_050_seed_policy_version_control_blog_post() {

    $slug = 'policy-version-control-prevents-legal-risk';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/policy-version-control-prevents-legal-risk.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 050: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'compliance-audit', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 050: category missing'); return; }

    $mansi_id = 0;
    if (post_type_exists('pc_author')) {
        $mansi = get_posts(array('name'=>'mansi-kumar','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($mansi)) $mansi_id = (int) $mansi[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'How Policy Version Control Prevents Legal Risk',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'When a dispute lands, the first question regulators and tribunals ask is which version of the policy applied — and most organisations cannot answer with evidence. A practical breakdown of the five elements of policy version control and the legal exposure they close.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 050: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($mansi_id > 0) update_post_meta($post_id, '_pcb_guest_author', $mansi_id);

    wp_set_post_terms($post_id, array(
        'policy-version-control', 'audit-readiness', 'compliance', 'governance',
        'policy-management', 'legal-risk', 'documentation', 'indian-enterprise',
    ), 'post_tag', false);

    // Note: reusing the policy-audit-checklist thumbnail until a dedicated
    // Version Control hero image is produced. A future migration can call
    // delete_post_thumbnail() + pcgpt_attach_post_featured_image() to swap.
    $image_path = get_template_directory() . '/assets/blog-images/policy-audit-checklist.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'policy-version-control.jpg', 'How Policy Version Control Prevents Legal Risk');
    }
}
