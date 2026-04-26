<?php
/**
 * Migration 013: Refresh HR Policies blog assets to optimised versions.
 *
 * The user replaced both the inline pyramid image and the hero thumbnail
 * with smaller, cleaner files:
 *  - inline:    hr-policy-stack.png         → hr-policy-stack.jpg
 *  - thumbnail: hr-policy-2026-under-50kb.jpg → hr-policy-2026-clean-under-30kb.jpg
 *
 * This migration handles already-seeded sites (local) where migrations 011
 * and 012 ran with the older filenames. Idempotent: each step short-circuits
 * once the target state is reached.
 */

function pcgpt_migration_013_refresh_hr_blog_images() {

    $slug             = 'hr-policies-india-2026';
    $new_thumb_file   = 'hr-policy-2026-clean-under-30kb.jpg';
    $new_thumb_title  = 'List of HR Policies Every Indian Company Should Have in 2026';
    $new_thumb_path   = get_template_directory() . '/assets/blog-images/' . $new_thumb_file;

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Post doesn't exist; migration 011 will seed with the new files directly.
    }
    $post = $existing[0];

    /* ─── Step 1: Refresh post content if inline still references .png ─── */
    if (strpos($post->post_content, 'hr-policy-stack.png') !== false) {
        $content_file = __DIR__ . '/data/hr-policies-india-2026.html';
        if (file_exists($content_file)) {
            $content = file_get_contents($content_file);
            if ($content !== false && trim($content) !== '') {
                wp_update_post(array(
                    'ID'           => (int) $post->ID,
                    'post_content' => $content,
                ));
            } else {
                error_log('PCGPT Migration 013: content file empty');
            }
        } else {
            error_log('PCGPT Migration 013: content file missing at ' . $content_file);
        }
    }

    /* ─── Step 2: Swap thumbnail if it isn't already the new filename ─── */
    if (!file_exists($new_thumb_path)) {
        error_log('PCGPT Migration 013: thumbnail source missing at ' . $new_thumb_path);
        return;
    }

    $current_thumb_id = get_post_thumbnail_id($post->ID);
    if ($current_thumb_id) {
        $current_path = get_attached_file($current_thumb_id);
        if ($current_path && basename($current_path) === $new_thumb_file) {
            return; // Already on the new thumbnail
        }
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($new_thumb_file, null, file_get_contents($new_thumb_path));
    if (!empty($upload['error'])) {
        error_log('PCGPT Migration 013: wp_upload_bits failed — ' . $upload['error']);
        return;
    }

    $wp_filetype = wp_check_filetype($upload['file'], null);
    $attach_id = wp_insert_attachment(array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => $new_thumb_title,
        'post_content'   => '',
        'post_status'    => 'inherit',
    ), $upload['file'], $post->ID);

    if (is_wp_error($attach_id) || !$attach_id) {
        error_log('PCGPT Migration 013: wp_insert_attachment failed');
        return;
    }

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post->ID, $attach_id);

    if ($current_thumb_id) {
        wp_delete_attachment((int) $current_thumb_id, true);
    }
}
