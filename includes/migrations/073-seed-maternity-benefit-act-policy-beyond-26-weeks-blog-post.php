<?php
/**
 * Migration 073: Seed the "Maternity Benefit Act Policy Guide: Beyond 26 Weeks" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/maternity-benefit-act-policy-beyond-26-weeks.html. Category: indian-labour-codes. Author: tony-thomas.
 */

function pcgpt_migration_073_maternity_benefit_act_policy_beyond_26_weeks() {

    $slug = 'maternity-benefit-act-policy-beyond-26-weeks';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/maternity-benefit-act-policy-beyond-26-weeks.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 073: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'indian-labour-codes', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 073: category indian-labour-codes missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'tony-thomas', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Maternity Benefit Act Policy Guide: Beyond 26 Weeks',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Learn what your maternity policy must include beyond 26 weeks leave. Covers creche, nursing breaks, WFH, compliance risks and legal obligations in India.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 073: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('maternity benefit act', 'indian labour codes', 'hr compliance', 'maternity policy', 'creche rules', 'employee benefits'), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/maternity-benefit-act.png';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'maternity-benefit-act.png', 'Maternity Benefit Act Policy Guide');
    }
}
