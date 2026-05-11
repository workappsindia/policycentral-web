<?php
/**
 * Migration 034: Seed the "50% Basic Salary Rule" blog post.
 *
 * Idempotent: skips if the slug already exists in any post status.
 * Body lives in data/50-percent-basic-salary-rule-compensation-policy.html.
 * Featured image at /assets/blog-images/fifty-percent-basic-salary.jpg.
 *
 * Category: indian-labour-codes (created in migration 032).
 * Author: tony-thomas (created in migration 005).
 */

function pcgpt_migration_034_seed_50_percent_basic_salary_blog_post() {

    $slug = '50-percent-basic-salary-rule-compensation-policy';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/50-percent-basic-salary-rule-compensation-policy.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 034: content file missing'); return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'indian-labour-codes', 'category');
    if (!$cat || is_wp_error($cat)) {
        error_log('PCGPT Migration 034: indian-labour-codes category missing'); return;
    }

    $tony_id = 0;
    if (post_type_exists('pc_author')) {
        $tony = get_posts(array('name'=>'tony-thomas','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($tony)) $tony_id = (int) $tony[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'The 50% Basic Salary Rule: How to Update Your Compensation Policy Before an Audit',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Basic pay must be at least 50% of total remuneration under the new Wage Code, effective November 21, 2025. A practical guide to modelling the impact, updating your compensation policy, and communicating it before a labour audit lands.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 034: wp_insert_post failed'); return;
    }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($tony_id > 0) update_post_meta($post_id, '_pcb_guest_author', $tony_id);

    wp_set_post_terms($post_id, array(
        'indian-labour-codes', 'code-on-wages', 'compensation-policy',
        'payroll-compliance', 'basic-pay', 'hr-policy', 'audit-readiness', 'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/fifty-percent-basic-salary.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'fifty-percent-basic-salary.jpg', '50% Basic Salary Rule');
    }
}
