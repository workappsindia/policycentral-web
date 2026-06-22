<?php
/**
 * Migration 072: Seed the "AI in HR Policies: Drafting, Compliance and Management" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/ai-hr-policies-drafting-compliance-management.html. Category: hr-policy-management. Author: tony-thomas.
 */

function pcgpt_migration_072_ai_hr_policies_drafting_compliance_management() {

    $slug = 'ai-hr-policies-drafting-compliance-management';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/ai-hr-policies-drafting-compliance-management.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 072: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'hr-policy-management', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 072: category hr-policy-management missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'tony-thomas', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'AI in HR Policies: Drafting, Compliance and Management',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Learn how AI is transforming HR policy drafting and maintenance. Covering compliance tracking, version control, distribution and legal risk management.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 072: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('ai in hr', 'hr policy management', 'policy automation', 'compliance tracking', 'version control', 'regulatory change'), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/ai-hr-policies.png';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'ai-hr-policies.png', 'AI in HR Policies');
    }
}
