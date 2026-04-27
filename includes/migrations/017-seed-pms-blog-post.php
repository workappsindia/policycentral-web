<?php
/**
 * Migration 017: Seed the fourth blog post — "What is Policy Management
 * Software?" — and create Kaizad Shroff as a new guest author.
 *
 * Idempotent on three levels:
 *  - Skips if the slug already exists in any post status.
 *  - Skips creating Kaizad if the kaizad-shroff pc_author already exists.
 *  - Skips attaching the photo if Kaizad already has a featured image.
 *
 * Body lives in data/what-is-policy-management-software.html.
 * Featured image expected at /assets/blog-images/what-is-policy-management-software.jpg
 * (will be skipped silently if the file is not present yet).
 * Author photo at /assets/authors/kaizad-shroff.jpeg (already shipped).
 */

function pcgpt_migration_017_seed_pms_blog_post() {

    /* ═══════════════════════════════════════════════════════════
       1. CREATE KAIZAD SHROFF AS GUEST AUTHOR (if missing)
       ═══════════════════════════════════════════════════════════ */
    $kaizad_id = 0;
    if (post_type_exists('pc_author')) {
        $kaizad_slug = 'kaizad-shroff';

        $existing_author = get_posts(array(
            'name'        => $kaizad_slug,
            'post_type'   => 'pc_author',
            'post_status' => array('publish', 'draft'),
            'numberposts' => 1,
        ));

        if (!empty($existing_author)) {
            $kaizad_id = (int) $existing_author[0]->ID;
        } else {
            $kaizad_id = wp_insert_post(array(
                'post_title'   => 'Kaizad Shroff',
                'post_name'    => $kaizad_slug,
                'post_status'  => 'publish',
                'post_type'    => 'pc_author',
                'post_content' => 'Kaizad Shroff is the Business Head at PolicyCentral.ai, where he leads growth, customer partnerships, and go-to-market for the platform. He works closely with HR, compliance, and operations teams across Indian enterprises to translate regulatory and governance requirements into structured, day-to-day practice.',
                'post_author'  => 1,
            ));

            if ($kaizad_id && !is_wp_error($kaizad_id)) {
                update_post_meta($kaizad_id, '_pcb_role',     'Business Head, PolicyCentral.ai');
                update_post_meta($kaizad_id, '_pcb_linkedin', 'https://www.linkedin.com/in/kaizadshroff/');
                update_post_meta($kaizad_id, '_pcb_twitter',  '');
                update_post_meta($kaizad_id, '_pcb_email',    '');

                $photo_path = get_template_directory() . '/assets/authors/kaizad-shroff.jpeg';
                if (file_exists($photo_path) && function_exists('pcgpt_attach_author_photo')) {
                    pcgpt_attach_author_photo($kaizad_id, $photo_path, 'kaizad-shroff.jpeg');
                }
            } else {
                error_log('PCGPT Migration 017: failed to create Kaizad guest author');
                $kaizad_id = 0;
            }
        }
    }

    /* ═══════════════════════════════════════════════════════════
       2. SEED THE BLOG POST
       ═══════════════════════════════════════════════════════════ */
    $slug = 'what-is-policy-management-software';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return; // Post already seeded
    }

    $content_file = __DIR__ . '/data/what-is-policy-management-software.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 017: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 017: content file empty');
        return;
    }

    // Find the Policy Management Software category (already exists per user)
    $pms_cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$pms_cat || is_wp_error($pms_cat)) {
        error_log('PCGPT Migration 017: Policy Management Software category missing — create it via WP admin first');
        return;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'What is Policy Management Software? A Complete Guide',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Learn what policy management software is, how it works, and why Indian businesses need it in 2026. Covers key features, use cases, and compliance benefits.',
        'post_category' => array((int) $pms_cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 017: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    update_post_meta($post_id, '_pcb_primary_category', (int) $pms_cat->term_id);
    if ($kaizad_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $kaizad_id);
    }

    wp_set_post_terms($post_id, array(
        'policy-management-software',
        'policy-management',
        'compliance',
        'audit-readiness',
        'iso-27001',
        'dpdp-act',
        'governance',
        'indian-enterprise',
    ), 'post_tag', false);

    // Featured image
    $image_path = get_template_directory() . '/assets/blog-images/policy-management-thumbnail.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'policy-management-thumbnail.jpg', 'What is Policy Management Software');
    }
}
