<?php
/**
 * Migration 108: Introduce the Industries section, and move Retail into it.
 *
 * Creates:
 *   /industries/                      -> page-industries.php  (new top-level parent)
 *   /industries/retail/               -> page-industry-retail.php
 *   /industries/pharma-healthcare/    -> page-industry-pharma-healthcare.php
 *
 * Moves Retail out of Use Cases:
 *   - The old /use-cases/retail-operations/ page is set to 'draft' so the URL
 *     stops resolving. A permanent (301) redirect to /industries/retail/ is
 *     registered in functions.php (pc_industries_legacy_redirects), which owns
 *     the old URL and preserves its search ranking.
 *
 * Sitemap: regular pages ride the pt_page sitemap (ensured on), then the cache
 * is busted so /sitemap_index.xml regenerates with the new URLs.
 *
 * Idempotent:
 *   - Re-uses existing pages by slug, re-asserts parent + template.
 *   - Only drafts the old Retail page if it is still published; never republishes.
 */

function pcgpt_migration_108_create_industries_section() {

    // ── 1. /industries/ parent ──────────────────────────────────────────────
    $parent = get_posts(array(
        'name'        => 'industries',
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'post_parent' => 0,
        'numberposts' => 1,
    ));

    if (!empty($parent)) {
        $parent_id = $parent[0]->ID;
        if (get_post_meta($parent_id, '_wp_page_template', true) !== 'page-industries.php') {
            update_post_meta($parent_id, '_wp_page_template', 'page-industries.php');
        }
    } else {
        $parent_id = wp_insert_post(array(
            'post_title'   => 'Industries',
            'post_name'    => 'industries',
            'post_parent'  => 0,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));
        if (is_wp_error($parent_id) || !$parent_id) {
            error_log('PCGPT Migration 108: failed to create /industries/ parent.');
            return;
        }
        update_post_meta($parent_id, '_wp_page_template', 'page-industries.php');
    }

    // ── 2. Industry child pages ─────────────────────────────────────────────
    $children = array(
        'retail' => array(
            'title'    => 'Retail',
            'template' => 'page-industry-retail.php',
        ),
        'pharma-healthcare' => array(
            'title'    => 'Pharma & Healthcare',
            'template' => 'page-industry-pharma-healthcare.php',
        ),
    );

    foreach ($children as $slug => $config) {
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
            if (get_post_meta($child_id, '_wp_page_template', true) !== $config['template']) {
                update_post_meta($child_id, '_wp_page_template', $config['template']);
            }
            continue;
        }

        $child_id = wp_insert_post(array(
            'post_title'   => $config['title'],
            'post_name'    => $slug,
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));
        if (!is_wp_error($child_id) && $child_id > 0) {
            update_post_meta($child_id, '_wp_page_template', $config['template']);
        }
    }

    // ── 3. Retire the old /use-cases/retail-operations/ page ────────────────
    // Match by slug under the /use-cases/ parent so we never touch the new
    // /industries/retail/ page (different slug).
    $use_cases_parent = get_posts(array(
        'name'        => 'use-cases',
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'post_parent' => 0,
        'numberposts' => 1,
    ));
    if (!empty($use_cases_parent)) {
        $old_retail = get_posts(array(
            'name'        => 'retail-operations',
            'post_type'   => 'page',
            'post_status' => array('publish'),
            'post_parent' => $use_cases_parent[0]->ID,
            'numberposts' => 1,
        ));
        if (!empty($old_retail)) {
            wp_update_post(array(
                'ID'          => $old_retail[0]->ID,
                'post_status' => 'draft',
            ));
        }
    }

    // ── 4. Sitemap: ensure pages are included, then bust the cache ──────────
    $opts = get_option('rank-math-options-sitemap', array());
    if (is_array($opts)) {
        $opts['pt_page_sitemap'] = 'on';
        update_option('rank-math-options-sitemap', $opts);
    }

    // New /industries/... URLs and the redirect must resolve immediately.
    flush_rewrite_rules(false);

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
