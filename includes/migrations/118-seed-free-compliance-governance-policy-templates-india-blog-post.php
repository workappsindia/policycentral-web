<?php
/**
 * Migration 118: Seed the "Free Compliance and Governance Policy Templates for Indian Companies (2026)" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/free-compliance-governance-policy-templates-india.html. Category: policy-management-software. Author: kaizad-shroff.
 */

function pcgpt_migration_118_free_compliance_governance_policy_templates_india() {

    $slug = 'free-compliance-governance-policy-templates-india';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/free-compliance-governance-policy-templates-india.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 118: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 118: category policy-management-software missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'kaizad-shroff', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Free Compliance and Governance Policy Templates for Indian Companies (2026)',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => '29 free policy templates for Indian companies across governance, KYC/AML, information security, finance, ESG and HR, each downloadable as a PDF personalized with your company name, plus how to map them to DPDP, SEBI and RBI obligations and adapt them properly.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 118: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('policy templates', 'free policy templates india', 'code of conduct template', 'kyc policy template', 'data privacy policy template', 'compliance policies', 'policy management'), 'post_tag', false);

    // Featured image: SVG copied directly into uploads (SVG isn't one of WP's
    // default allowed upload MIMEs, so bypass wp_upload_bits; same approach as
    // migration 083).
    $svg_src = get_template_directory() . '/assets/blog-images/free-compliance-governance-policy-templates-india.svg';
    if (file_exists($svg_src) && !has_post_thumbnail($post_id)) {
        $ud = wp_upload_dir();
        if (empty($ud['error'])) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $fn = wp_unique_filename($ud['path'], 'free-compliance-governance-policy-templates-india.svg');
            $tp = trailingslashit($ud['path']) . $fn;
            $tu = trailingslashit($ud['url']) . $fn;
            if (@copy($svg_src, $tp)) {
                $aid = wp_insert_attachment(array(
                    'post_mime_type' => 'image/svg+xml',
                    'post_title'     => 'Free Compliance and Governance Policy Templates for Indian Companies (2026)',
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
