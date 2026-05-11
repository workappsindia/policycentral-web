<?php
/**
 * Migration 035: Seed the "Fixed-Term Employee Policies" blog post.
 *
 * Idempotent. Body in data/fixed-term-employee-policy-india-labour-codes.html.
 * Image at /assets/blog-images/fixed-term-employee.jpg.
 * Category: indian-labour-codes. Author: tony-thomas.
 */

function pcgpt_migration_035_seed_fixed_term_employee_blog_post() {

    $slug = 'fixed-term-employee-policy-india-labour-codes';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/fixed-term-employee-policy-india-labour-codes.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 035: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'indian-labour-codes', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 035: category missing'); return; }

    $tony_id = 0;
    if (post_type_exists('pc_author')) {
        $tony = get_posts(array('name'=>'tony-thomas','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($tony)) $tony_id = (int) $tony[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Fixed-Term Employee Policies: What Indian Companies Must Document Under the New Labour Codes',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Fixed-term employment is now governed by a strict documentation framework under the Industrial Relations Code and Code on Social Security. The six documents every Indian HR team must have in place — appointment letter clauses, pro-rata gratuity, non-renewal templates, and more.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 035: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($tony_id > 0) update_post_meta($post_id, '_pcb_guest_author', $tony_id);

    wp_set_post_terms($post_id, array(
        'indian-labour-codes', 'fixed-term-employment', 'industrial-relations-code',
        'code-on-social-security', 'gratuity', 'hr-policy', 'employment-contract', 'compliance',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/fixed-term-employee.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'fixed-term-employee.jpg', 'Fixed-Term Employee Policies');
    }
}
