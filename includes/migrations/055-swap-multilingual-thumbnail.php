<?php
/**
 * Migration 055: Swap the Multilingual HR Policies blog featured image to the
 * designer-made SVG (multilingual-hr-policies.svg).
 *
 * Replaces the JPG (multilingual-hr-policies.jpg) attached by migration 048.
 * Uses the same direct-to-uploads write path as migration 054 because SVGs
 * are not part of WP's default allowed upload MIMEs.
 *
 * Idempotent: skips if the post's current thumbnail filename already matches.
 */

function pcgpt_migration_055_swap_multilingual_thumbnail() {

    $slug         = 'multilingual-hr-policies-hindi-regional-languages';
    $new_filename = 'multilingual-hr-policies.svg';
    $new_title    = 'Multilingual HR Policies in India';
    $source_path  = get_template_directory() . '/assets/blog-images/' . $new_filename;

    if (!file_exists($source_path)) {
        error_log('PCGPT Migration 055: source SVG missing at ' . $source_path);
        return;
    }

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) return;
    $post = $existing[0];

    $current_thumb_id = (int) get_post_thumbnail_id($post->ID);
    if ($current_thumb_id) {
        $current_path = get_attached_file($current_thumb_id);
        if ($current_path && basename($current_path) === $new_filename) {
            return; // already swapped
        }
    }

    $upload_dir = wp_upload_dir();
    if (!empty($upload_dir['error'])) {
        error_log('PCGPT Migration 055: uploads dir error — ' . $upload_dir['error']);
        return;
    }

    $target_filename = wp_unique_filename($upload_dir['path'], $new_filename);
    $target_path     = trailingslashit($upload_dir['path']) . $target_filename;
    $target_url      = trailingslashit($upload_dir['url']) . $target_filename;

    if (!@copy($source_path, $target_path)) {
        error_log('PCGPT Migration 055: failed copying SVG to ' . $target_path);
        return;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $attach_id = wp_insert_attachment(array(
        'post_mime_type' => 'image/svg+xml',
        'post_title'     => $new_title,
        'post_content'   => '',
        'post_status'    => 'inherit',
        'guid'           => $target_url,
    ), $target_path, $post->ID);

    if (is_wp_error($attach_id) || !$attach_id) {
        error_log('PCGPT Migration 055: wp_insert_attachment failed');
        @unlink($target_path);
        return;
    }

    wp_update_attachment_metadata($attach_id, array(
        'file' => _wp_relative_upload_path($target_path),
    ));

    set_post_thumbnail($post->ID, $attach_id);

    if ($current_thumb_id) {
        wp_delete_attachment($current_thumb_id, true);
    }
}
