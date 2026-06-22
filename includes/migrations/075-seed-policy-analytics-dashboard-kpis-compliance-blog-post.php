<?php
/**
 * Migration 075: Seed the "Policy Analytics Dashboard: 10 KPIs Every CCO Tracks" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/policy-analytics-dashboard-kpis-compliance.html. Category: compliance-audit. Author: mansi-kumar.
 */

function pcgpt_migration_075_policy_analytics_dashboard_kpis_compliance() {

    $slug = 'policy-analytics-dashboard-kpis-compliance';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/policy-analytics-dashboard-kpis-compliance.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 075: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'compliance-audit', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 075: category compliance-audit missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'mansi-kumar', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Policy Analytics Dashboard: 10 KPIs Every CCO Tracks',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Discover the 10 must-track KPIs on every Chief Compliance Officer\'s policy analytics dashboard from acknowledgment rates to audit readiness scores. Built for modern compliance teams.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 075: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('compliance analytics', 'policy kpis', 'chief compliance officer', 'audit readiness', 'compliance dashboard', 'policy management'), 'post_tag', false);

    // Featured image — SVG copied directly into uploads (SVG isn't one of WP's
    // default allowed upload MIMEs, so bypass wp_upload_bits; same approach as
    // migration 055).
    $svg_src = get_template_directory() . '/assets/blog-images/policy-analytics-dashboard-kpis-compliance.svg';
    if (file_exists($svg_src) && !has_post_thumbnail($post_id)) {
        $ud = wp_upload_dir();
        if (empty($ud['error'])) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $fn = wp_unique_filename($ud['path'], 'policy-analytics-dashboard-kpis-compliance.svg');
            $tp = trailingslashit($ud['path']) . $fn;
            $tu = trailingslashit($ud['url']) . $fn;
            if (@copy($svg_src, $tp)) {
                $aid = wp_insert_attachment(array(
                    'post_mime_type' => 'image/svg+xml',
                    'post_title'     => 'Policy Analytics Dashboard: 10 KPIs Every CCO Tracks',
                    'post_status'    => 'inherit',
                    'guid'           => $tu,
                ), $tp, $post_id);
                if (!is_wp_error($aid) && $aid) {
                    wp_update_attachment_metadata($aid, array('file' => _wp_relative_upload_path($tp)));
                    set_post_thumbnail($post_id, $aid);
                }
            }
        }
    }
}
