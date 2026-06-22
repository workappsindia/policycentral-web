<?php
/**
 * Migration 074: Seed the "Policy vs Process vs Procedure: Clear Differences Explained" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/policy-vs-process-vs-procedure.html. Category: policy-management-software. Author: kaizad-shroff.
 */

function pcgpt_migration_074_policy_vs_process_vs_procedure() {

    $slug = 'policy-vs-process-vs-procedure';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/policy-vs-process-vs-procedure.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 074: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 074: category policy-management-software missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'kaizad-shroff', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Policy vs Process vs Procedure: Clear Differences Explained',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Understand the difference between policy, process, and procedure with practical examples. Learn how to structure documents for better governance and compliance.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 074: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('policy management software', 'policy vs process', 'procedure', 'governance', 'document management', 'compliance'), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/policy-vs-process.png';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'policy-vs-process.png', 'Policy vs Process vs Procedure');
    }
}
