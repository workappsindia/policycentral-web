<?php
/**
 * Migration 012: Swap the HR Policies blog featured image to the new
 * designer-made thumbnail.
 *
 * Migration 011 originally attached a PIL-generated PNG. We've replaced it
 * with hr-policy-2026-under-50kb.jpg, a richer designer asset.
 *
 * Idempotent:
 *  - If the post doesn't exist, no-op (migration 011 will seed it with the
 *    new file directly on a fresh deploy).
 *  - If the current featured image already matches the new filename, no-op.
 *  - Otherwise, attach the new file as the featured image and remove the
 *    previous attachment.
 */

function pcgpt_migration_012_swap_hr_blog_thumbnail() {

    $slug         = 'hr-policies-india-2026';
    $new_filename = 'hr-policy-2026-clean-under-30kb.jpg';
    $new_title    = 'List of HR Policies Every Indian Company Should Have in 2026';
    $new_path     = get_template_directory() . '/assets/blog-images/' . $new_filename;

    if (!file_exists($new_path)) {
        error_log('PCGPT Migration 012: source image missing at ' . $new_path);
        return;
    }

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Post doesn't exist yet; migration 011 seeds with the new file directly.
    }
    $post = $existing[0];

    // Idempotency: if current thumbnail filename already matches, skip.
    $current_thumb_id = get_post_thumbnail_id($post->ID);
    if ($current_thumb_id) {
        $current_path = get_attached_file($current_thumb_id);
        if ($current_path && basename($current_path) === $new_filename) {
            return;
        }
    }

    // Upload the new file as a fresh attachment
    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($new_filename, null, file_get_contents($new_path));
    if (!empty($upload['error'])) {
        error_log('PCGPT Migration 012: wp_upload_bits failed — ' . $upload['error']);
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
        error_log('PCGPT Migration 012: wp_insert_attachment failed');
        return;
    }

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);

    // Set new thumbnail
    set_post_thumbnail($post->ID, $attach_id);

    // Delete the old attachment (file + DB row) if it existed
    if ($current_thumb_id) {
        wp_delete_attachment((int) $current_thumb_id, true);
    }
}
