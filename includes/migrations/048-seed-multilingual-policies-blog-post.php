<?php
/**
 * Migration 048: Seed the "Multilingual HR Policies" blog post.
 *
 * Idempotent. Body in data/multilingual-hr-policies-hindi-regional-languages.html.
 * Image at /assets/blog-images/multilingual-hr-policies.jpg.
 * Category: compliance-audit. Author: mansi-kumar.
 */

function pcgpt_migration_048_seed_multilingual_policies_blog_post() {

    $slug = 'multilingual-hr-policies-hindi-regional-languages';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/multilingual-hr-policies-hindi-regional-languages.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 048: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'compliance-audit', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 048: category missing'); return; }

    $mansi_id = 0;
    if (post_type_exists('pc_author')) {
        $mansi = get_posts(array('name'=>'mansi-kumar','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($mansi)) $mansi_id = (int) $mansi[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Multilingual HR Policies: Why Translating Policies Into Hindi and Regional Languages Is Now a Compliance Necessity',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'A signed acknowledgment on an English-only policy is not the same as a communicated policy. Under the new labour codes, the POSH Act, and state Shops and Establishment Acts, "communicated in a language the employee understands" is the operative standard — and most pan-India employers cannot prove it.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 048: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($mansi_id > 0) update_post_meta($post_id, '_pcb_guest_author', $mansi_id);

    wp_set_post_terms($post_id, array(
        'multilingual-policies', 'regional-languages', 'hindi-policies', 'policy-communication',
        'posh-act', 'compliance', 'employee-experience', 'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/multilingual-hr-policies.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'multilingual-hr-policies.jpg', 'Multilingual HR Policies in India');
    }
}
