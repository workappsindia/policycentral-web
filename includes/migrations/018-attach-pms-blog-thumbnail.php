<?php
/**
 * Migration 018: Attach the hero thumbnail to the "What is Policy Management
 * Software?" blog post.
 *
 * Migration 017 may have run before the user dropped the thumbnail file in.
 * This migration attaches policy-management-thumbnail.jpg to the post if:
 *  - the post exists, AND
 *  - it has no featured image yet, OR the current featured image filename
 *    doesn't match policy-management-thumbnail.jpg.
 *
 * Idempotent: skips silently once the new thumbnail is in place.
 */

function pcgpt_migration_018_attach_pms_blog_thumbnail() {

    $slug         = 'what-is-policy-management-software';
    $new_filename = 'policy-management-thumbnail.jpg';
    $new_title    = 'What is Policy Management Software';
    $new_path     = get_template_directory() . '/assets/blog-images/' . $new_filename;

    if (!file_exists($new_path)) {
        error_log('PCGPT Migration 018: source image missing at ' . $new_path);
        return;
    }

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 017 will seed with the file directly.
    }
    $post = $existing[0];

    $current_thumb_id = get_post_thumbnail_id($post->ID);
    if ($current_thumb_id) {
        $current_path = get_attached_file($current_thumb_id);
        if ($current_path && basename($current_path) === $new_filename) {
            return; // Already correct
        }
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($new_filename, null, file_get_contents($new_path));
    if (!empty($upload['error'])) {
        error_log('PCGPT Migration 018: wp_upload_bits failed — ' . $upload['error']);
        return;
    }

    $wp_filetype = wp_check_filetype($upload['file'], null);
    $attach_id = wp_insert_attachment(array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => $new_title,
        'post_content'   => '',
        'post_status'    => 'inherit',
    ), $upload['file'], $post->ID);

    if (is_wp_error($attach_id) || !$attach_id) {
        error_log('PCGPT Migration 018: wp_insert_attachment failed');
        return;
    }

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post->ID, $attach_id);

    if ($current_thumb_id) {
        wp_delete_attachment((int) $current_thumb_id, true);
    }
}
