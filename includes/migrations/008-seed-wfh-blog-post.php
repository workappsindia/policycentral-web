<?php
/**
 * Migration 008: Seed the second blog post — WFH Policy in India 2026
 *
 * Idempotent: if the slug already exists in any status (publish/draft/trash),
 * the migration skips. Reuses Tony Thomas as guest author (created in 005).
 *
 * Body lives in data/work-from-home-policy-india-2026.html.
 * Featured image lives in /assets/blog-images/work-from-home-policy.png.
 */

function pcgpt_migration_008_seed_wfh_blog_post() {

    $slug = 'work-from-home-policy-india-2026';

    // Idempotency: skip if slug already exists in ANY status (even trashed)
    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return; // Post already exists, nothing to do
    }

    // Read the post body from the data file
    $content_file = __DIR__ . '/data/work-from-home-policy-india-2026.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 008: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 008: content file empty');
        return;
    }

    // Find the HR Policy Management category (created by migration 005)
    $hr_cat = get_term_by('slug', 'hr-policy-management', 'category');
    if (!$hr_cat || is_wp_error($hr_cat)) {
        error_log('PCGPT Migration 008: HR Policy Management category missing — migration 005 must run first');
        return;
    }

    // Reuse Tony Thomas as guest author (created in migration 005)
    $tony = get_posts(array(
        'name'        => 'tony-thomas',
        'post_type'   => 'pc_author',
        'post_status' => 'publish',
        'numberposts' => 1,
    ));
    $tony_id = !empty($tony) ? (int) $tony[0]->ID : 0;

    // Insert the post
    $post_id = wp_insert_post(array(
        'post_title'    => 'Your Work From Home Policy: What to Document, What to Update',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'India has no standalone WFH law, but existing labour statutes fully apply to remote workers. Here is what every company must document in its WFH policy in 2026 to stay compliant.',
        'post_category' => array((int) $hr_cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 008: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    // Meta: primary category (for URL rewrite) + guest author
    update_post_meta($post_id, '_pcb_primary_category', (int) $hr_cat->term_id);
    if ($tony_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $tony_id);
    }

    // Tags
    wp_set_post_terms($post_id, array(
        'work-from-home',
        'wfh-policy',
        'remote-work',
        'hr-compliance',
        'indian-labor-law',
        'shops-and-establishments-act',
        'sez',
        'posh',
    ), 'post_tag', false);

    // Featured image — reuse helper from migration 006
    $image_path = get_template_directory() . '/assets/blog-images/wfh-policy-thumb.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'wfh-policy-thumb.jpg', 'Your Work From Home Policy');
    }
}
