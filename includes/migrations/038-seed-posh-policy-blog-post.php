<?php
/**
 * Migration 038: Seed the "POSH Policy Requirements for Indian Companies" blog post.
 *
 * Idempotent. Body in data/posh-policy-requirements-indian-companies.html.
 * Image at /assets/blog-images/posh-policy.jpg.
 * Category: hr-policy-management. Author: tony-thomas.
 */

function pcgpt_migration_038_seed_posh_policy_blog_post() {

    $slug = 'posh-policy-requirements-indian-companies';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/posh-policy-requirements-indian-companies.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 038: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'hr-policy-management', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 038: category missing'); return; }

    $tony_id = 0;
    if (post_type_exists('pc_author')) {
        $tony = get_posts(array('name'=>'tony-thomas','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($tony)) $tony_id = (int) $tony[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'POSH Policy Requirements for Indian Companies',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Every workplace in India with 10 or more employees must comply with the POSH Act — written policy, Internal Complaints Committee, training, complaint handling, annual reporting. A practical guide to what is mandatory, where companies fail, and how policy governance closes the gap.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 038: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($tony_id > 0) update_post_meta($post_id, '_pcb_guest_author', $tony_id);

    wp_set_post_terms($post_id, array(
        'posh-act', 'hr-policy', 'workplace-safety', 'compliance',
        'internal-complaints-committee', 'hr-compliance', 'indian-enterprise', 'governance',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/posh-policy.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'posh-policy.jpg', 'POSH Policy Requirements');
    }
}
