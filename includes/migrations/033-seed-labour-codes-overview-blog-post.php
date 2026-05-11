<?php
/**
 * Migration 033: Seed the Labour Codes Overview blog post —
 * "How India's New Labour Codes Are Forcing Companies to Rewrite Their HR Policies"
 *
 * Idempotent: skips if the slug already exists in any post status.
 * Body lives in data/india-new-labour-codes-hr-policy-rewrite.html.
 * Featured image at /assets/blog-images/labour-codes-overview.jpg.
 *
 * Category: indian-labour-codes (created in migration 032).
 * Author: tony-thomas (created in migration 005).
 */

function pcgpt_migration_033_seed_labour_codes_overview_blog_post() {

    $slug = 'india-new-labour-codes-hr-policy-rewrite';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return;
    }

    $content_file = __DIR__ . '/data/india-new-labour-codes-hr-policy-rewrite.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 033: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 033: content file empty');
        return;
    }

    $cat = get_term_by('slug', 'indian-labour-codes', 'category');
    if (!$cat || is_wp_error($cat)) {
        error_log('PCGPT Migration 033: indian-labour-codes category missing — migration 032 must run first');
        return;
    }

    $tony_id = 0;
    if (post_type_exists('pc_author')) {
        $tony = get_posts(array(
            'name'        => 'tony-thomas',
            'post_type'   => 'pc_author',
            'post_status' => array('publish', 'draft'),
            'numberposts' => 1,
        ));
        if (!empty($tony)) {
            $tony_id = (int) $tony[0]->ID;
        }
    }

    $post_id = wp_insert_post(array(
        'post_title'    => "How India's New Labour Codes Are Forcing Companies to Rewrite Their HR Policies",
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => "India's four new Labour Codes took effect on November 21, 2025, replacing 29 older laws with one unified framework. Here is what every HR policy needs to change — wage structures, appointment letters, fixed-term contracts, gig worker coverage, and more.",
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 033: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($tony_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $tony_id);
    }

    wp_set_post_terms($post_id, array(
        'indian-labour-codes',
        'code-on-wages',
        'code-on-social-security',
        'industrial-relations-code',
        'oshwc-code',
        'hr-policy',
        'compliance',
        'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/labour-codes-overview.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'labour-codes-overview.jpg', 'India New Labour Codes — HR Policy Rewrite');
    }
}
