<?php
/**
 * Migration 091: Seed the "Questions Employees Keep Asking HR / AI Policy Search" blog post.
 *
 * Idempotent (skips if the slug already exists). Body in
 * data/ai-policy-search-questions-employees-ask-hr.html.
 * Category: hr-policy-management. Author: tony-thomas.
 */

function pcgpt_migration_091_ai_policy_search_employee_questions() {

    $slug = 'ai-policy-search-questions-employees-ask-hr';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/ai-policy-search-questions-employees-ask-hr.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 091: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'hr-policy-management', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 091: category hr-policy-management missing'); return; }

    $author_id = 0;
    if (post_type_exists('pc_author')) {
        $a = get_posts(array('name' => 'tony-thomas', 'post_type' => 'pc_author', 'post_status' => array('publish', 'draft'), 'numberposts' => 1));
        if (!empty($a)) $author_id = (int) $a[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'The Questions Employees Keep Asking HR, and Why AI Policy Search Finally Answers Them',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'Employees ask HR the same policy questions on loop, sandwich leave, notice period, POSH, because policies are stored as documents but asked as questions. Here is how AI policy search closes that gap, and how to try it live on 28 real HR policies.',
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 091: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($author_id > 0) update_post_meta($post_id, '_pcb_guest_author', $author_id);

    wp_set_post_terms($post_id, array('ai policy search', 'policygpt', 'employee self service', 'conversational ai', 'hr policy questions', 'sandwich leave', 'policy management'), 'post_tag', false);

    // Featured image — SVG copied directly into uploads (SVG isn't one of WP's
    // default allowed upload MIMEs, so bypass wp_upload_bits; same approach as migration 088).
    $svg_src = get_template_directory() . '/assets/blog-images/ai-policy-search-questions-employees-ask-hr.svg';
    if (file_exists($svg_src) && !has_post_thumbnail($post_id)) {
        $ud = wp_upload_dir();
        if (empty($ud['error'])) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            $fn = wp_unique_filename($ud['path'], 'ai-policy-search-questions-employees-ask-hr.svg');
            $tp = trailingslashit($ud['path']) . $fn;
            $tu = trailingslashit($ud['url']) . $fn;
            if (@copy($svg_src, $tp)) {
                $aid = wp_insert_attachment(array(
                    'post_mime_type' => 'image/svg+xml',
                    'post_title'     => 'AI Policy Search: the questions employees keep asking HR',
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
