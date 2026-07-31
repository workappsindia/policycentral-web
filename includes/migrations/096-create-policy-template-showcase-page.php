<?php
/**
 * Migration 096: Create the Policy Template showcase (prototype) page.
 *
 * Creates /policy-template-showcase/ using page-policy-template-showcase.php,
 * a design prototype for the upcoming /resources/policies/ Policy Templates
 * library. Marked noindex (Rank Math) and kept out of the sitemap since it is
 * a review-only page that the real CPT section will replace.
 *
 * Idempotent: if the slug exists, only ensures the template + noindex are set.
 */

function pcgpt_migration_096_create_policy_template_showcase_page() {
    $slug     = 'policy-template-showcase';
    $template = 'page-policy-template-showcase.php';

    $existing = get_posts(array(
        'name'        => $slug,
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => 1,
    ));

    if (!empty($existing)) {
        $id = $existing[0]->ID;
    } else {
        $id = wp_insert_post(array(
            'post_title'   => 'Policy Template Showcase',
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));
    }

    if (!is_wp_error($id) && $id > 0) {
        if (get_post_meta($id, '_wp_page_template', true) !== $template) {
            update_post_meta($id, '_wp_page_template', $template);
        }
        // Keep the prototype out of search indexes.
        update_post_meta($id, 'rank_math_robots', array('noindex'));
    }
}
