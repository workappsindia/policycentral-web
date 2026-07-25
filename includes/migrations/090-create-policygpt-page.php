<?php
/**
 * Migration 090: Create the PolicyGPT live-demo landing page
 *
 * Creates /policygpt/ using the page-policygpt.php template (the PolicyGPT
 * search demo loaded with the sample HR policy library).
 *
 * Idempotent: if the slug already exists, only ensures the template is set.
 */

function pcgpt_migration_090_create_policygpt_page() {
    $slug     = 'policygpt';
    $template = 'page-policygpt.php';

    $existing = get_posts(array(
        'name'        => $slug,
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => 1,
    ));

    if (!empty($existing)) {
        $id = $existing[0]->ID;
        if (get_post_meta($id, '_wp_page_template', true) !== $template) {
            update_post_meta($id, '_wp_page_template', $template);
        }
    } else {
        $id = wp_insert_post(array(
            'post_title'   => 'PolicyGPT',
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));
        if (!is_wp_error($id) && $id > 0) {
            update_post_meta($id, '_wp_page_template', $template);
        }
    }

    // Bust the Rank Math sitemap cache so the new page appears in the sitemap.
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
