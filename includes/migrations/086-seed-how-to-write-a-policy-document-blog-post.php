<?php
/**
 * Migration 086: Seed the "How to Write a Policy Document: Structure, Template, and Examples" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/how-to-write-a-policy-document.html. Category: policy-management-software. Author: kaizad-shroff.
 */

function pcgpt_migration_086_how_to_write_a_policy_document() {

    $slug = 'how-to-write-a-policy-document';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/how-to-write-a-policy-document.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 086: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'policy-management-software', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 086: category policy-management-software missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'kaizad-shroff', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'How to Write a Policy Document: Structure, Template, and Examples',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'A practical guide to writing a policy document that works: the structure to use, the step-by-step process from draft to acknowledgment, and the common mistakes that quietly turn a policy into a liability.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 086: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('how to write a policy', 'policy document', 'policy template', 'policy writing', 'plain language', 'policy structure', 'policy management'), 'post_tag', false);

    // Featured image — SVG copied directly into uploads (SVG isn't one of WP's
    // default allowed upload MIMEs, so bypass wp_upload_bits; same approach as
    // migration 083).
    $svg_src = get_template_directory() . '/assets/blog-images/how-to-write-a-policy-document.svg';
    if (file_exists($svg_src) && !has_post_thumbnail($post_id)) {
        $ud = wp_upload_dir();
        if (empty($ud['error'])) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $fn = wp_unique_filename($ud['path'], 'how-to-write-a-policy-document.svg');
            $tp = trailingslashit($ud['path']) . $fn;
            $tu = trailingslashit($ud['url']) . $fn;
            if (@copy($svg_src, $tp)) {
                $aid = wp_insert_attachment(array(
                    'post_mime_type' => 'image/svg+xml',
                    'post_title'     => 'How to Write a Policy Document: Structure, Template, and Examples',
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
