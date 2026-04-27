<?php
/**
 * Migration 030: Create the /explore1/ media landing page.
 *
 * The page is a stub that ties the slug "explore1" to the page-explore-v2.php
 * template — the V2 design refined on dev. The existing /explore/ page (which
 * uses the older page-explore.php) is left untouched.
 *
 * Idempotent: if the slug already exists, only re-asserts the template
 * assignment when it has drifted.
 */

function pcgpt_migration_030_create_explore1_page() {

    $page_slug     = 'explore1';
    $page_title    = 'Explore V2';
    $page_template = 'page-explore-v2.php';

    $existing = get_posts(array(
        'name'        => $page_slug,
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => 1,
    ));

    if (!empty($existing)) {
        $page_id = $existing[0]->ID;
        if (get_post_meta($page_id, '_wp_page_template', true) !== $page_template) {
            update_post_meta($page_id, '_wp_page_template', $page_template);
        }
        return;
    }

    $page_id = wp_insert_post(array(
        'post_title'   => $page_title,
        'post_name'    => $page_slug,
        'post_status'  => 'publish',
        'post_type'    => 'page',
        'post_content' => '',
        'post_author'  => 1,
    ));

    if (!is_wp_error($page_id) && $page_id > 0) {
        update_post_meta($page_id, '_wp_page_template', $page_template);
        // Flush so /explore1/ resolves immediately on the next request.
        flush_rewrite_rules(false);
    }
}
