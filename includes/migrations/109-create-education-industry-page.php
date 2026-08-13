<?php
/**
 * Migration 109: Add the Education industry page.
 *
 * Creates /industries/education/ -> page-industry-education.php under the
 * /industries/ parent (created in migration 108), then busts the sitemap cache
 * so the new URL appears in /sitemap_index.xml.
 *
 * Idempotent: re-uses the page by slug and re-asserts parent + template.
 * Skips silently if the /industries/ parent is missing.
 */

function pcgpt_migration_109_create_education_industry_page() {

    $parent = get_posts(array(
        'name'        => 'industries',
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'post_parent' => 0,
        'numberposts' => 1,
    ));
    if (empty($parent)) {
        error_log('PCGPT Migration 109: /industries/ parent not found. Run migration 108 first.');
        return;
    }
    $parent_id = $parent[0]->ID;

    $slug     = 'education';
    $title    = 'Education';
    $template = 'page-industry-education.php';

    $existing = get_posts(array(
        'name'        => $slug,
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => 1,
    ));

    if (!empty($existing)) {
        $child_id = $existing[0]->ID;
        if ((int) $existing[0]->post_parent !== (int) $parent_id) {
            wp_update_post(array('ID' => $child_id, 'post_parent' => $parent_id));
        }
        if (get_post_meta($child_id, '_wp_page_template', true) !== $template) {
            update_post_meta($child_id, '_wp_page_template', $template);
        }
    } else {
        $child_id = wp_insert_post(array(
            'post_title'   => $title,
            'post_name'    => $slug,
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));
        if (!is_wp_error($child_id) && $child_id > 0) {
            update_post_meta($child_id, '_wp_page_template', $template);
        }
    }

    flush_rewrite_rules(false);

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
