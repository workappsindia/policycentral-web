<?php
/**
 * Migration 002: Auto-create Search and Explore pages
 *
 * Creates the two WordPress pages that use custom templates:
 * - /search/  → page-search.php (AI search interface)
 * - /explore/ → page-explore.php (marketing landing page)
 *
 * Idempotent: checks if page slug already exists before creating.
 */

function pcgpt_migration_002_create_pages() {
    $pages_to_create = array(
        'search' => array(
            'title'    => 'Search',
            'template' => 'page-search.php',
        ),
        'explore' => array(
            'title'    => 'Explore',
            'template' => 'page-explore.php',
        ),
    );

    foreach ($pages_to_create as $slug => $config) {
        // Check if page with this slug already exists (even in draft/trash)
        $existing = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'page',
            'post_status'    => array('publish', 'draft', 'pending', 'private'),
            'numberposts'    => 1,
        ));

        if (!empty($existing)) {
            // Page exists — ensure it has the correct template assigned
            $existing_id = $existing[0]->ID;
            $current_template = get_post_meta($existing_id, '_wp_page_template', true);
            if ($current_template !== $config['template']) {
                update_post_meta($existing_id, '_wp_page_template', $config['template']);
            }
            continue;
        }

        // Create the page
        $page_id = wp_insert_post(array(
            'post_title'   => $config['title'],
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));

        if (!is_wp_error($page_id) && $page_id > 0) {
            update_post_meta($page_id, '_wp_page_template', $config['template']);
        }
    }
}
