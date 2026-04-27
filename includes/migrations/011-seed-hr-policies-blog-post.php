<?php
/**
 * Migration 011: Seed the third blog post — HR Policies Every Indian
 * Company Should Have in 2026.
 *
 * Idempotent: skips if the slug already exists in any status. Reuses Tony
 * Thomas as guest author (created in migration 005).
 *
 * Body lives in data/hr-policies-india-2026.html.
 * Featured image lives in /assets/blog-images/hr-policies-india-2026.png.
 */

function pcgpt_migration_011_seed_hr_policies_blog_post() {

    $slug = 'hr-policies-india-2026';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return; // Already seeded
    }

    $content_file = __DIR__ . '/data/hr-policies-india-2026.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 011: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 011: content file empty');
        return;
    }

    $hr_cat = get_term_by('slug', 'hr-policy-management', 'category');
    if (!$hr_cat || is_wp_error($hr_cat)) {
        error_log('PCGPT Migration 011: HR Policy Management category missing — migration 005 must run first');
        return;
    }

    // Reuse Tony Thomas as guest author
    $tony = get_posts(array(
        'name'        => 'tony-thomas',
        'post_type'   => 'pc_author',
        'post_status' => 'publish',
        'numberposts' => 1,
    ));
    $tony_id = !empty($tony) ? (int) $tony[0]->ID : 0;

    $post_id = wp_insert_post(array(
        'post_title'    => 'List of HR Policies Every Indian Company Should Have in 2026',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'A complete guide to mandatory and essential HR policies for Indian companies in 2026. POSH, maternity, gratuity, leave, data privacy, and the policies every business needs.',
        'post_category' => array((int) $hr_cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 011: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    update_post_meta($post_id, '_pcb_primary_category', (int) $hr_cat->term_id);
    if ($tony_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $tony_id);
    }

    wp_set_post_terms($post_id, array(
        'hr-policy',
        'posh',
        'maternity-benefit',
        'gratuity',
        'epf',
        'esic',
        'dpdp-act',
        'whistleblower',
        'hr-compliance',
        'indian-labor-law',
    ), 'post_tag', false);

    // Featured image — reuse helper from migration 006
    $image_path = get_template_directory() . '/assets/blog-images/hr-policy-2026-clean-under-30kb.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'hr-policy-2026-clean-under-30kb.jpg', 'List of HR Policies Every Indian Company Should Have in 2026');
    }
}
