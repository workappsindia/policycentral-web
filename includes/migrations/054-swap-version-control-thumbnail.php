<?php
/**
 * Migration 054: Swap the Policy Version Control blog featured image to the
 * designer-made SVG (policy-version-control.svg).
 *
 * Replaces the reused policy-audit-checklist.jpg placeholder that migration
 * 050 set on the Version Control post. First time an SVG is used as a
 * featured image in this site — SVGs are not part of the default WP allowed
 * upload MIMEs, so this migration writes the file directly into the uploads
 * dir rather than going through wp_upload_bits() (which would fail the MIME
 * check). The attachment is created with an explicit image/svg+xml type and
 * no resized derivatives (SVGs are resolution-independent).
 *
 * Idempotent: skips if the post's current thumbnail filename already matches.
 */

function pcgpt_migration_054_swap_version_control_thumbnail() {

    $slug         = 'policy-version-control-prevents-legal-risk';
    $new_filename = 'policy-version-control.svg';
    $new_title    = 'Policy Version Control';
    $source_path  = get_template_directory() . '/assets/blog-images/' . $new_filename;

    if (!file_exists($source_path)) {
        error_log('PCGPT Migration 054: source SVG missing at ' . $source_path);
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

    // Bypass wp_upload_bits — it runs MIME validation that rejects SVGs unless
    // an upload_mimes filter is in place. Write the file directly into the
    // current uploads dir instead.
    $upload_dir = wp_upload_dir();
    if (!empty($upload_dir['error'])) {
        error_log('PCGPT Migration 054: uploads dir error — ' . $upload_dir['error']);
        return;
    }

    $target_filename = wp_unique_filename($upload_dir['path'], $new_filename);
    $target_path     = trailingslashit($upload_dir['path']) . $target_filename;
    $target_url      = trailingslashit($upload_dir['url']) . $target_filename;

    if (!@copy($source_path, $target_path)) {
        error_log('PCGPT Migration 054: failed copying SVG to ' . $target_path);
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
        error_log('PCGPT Migration 054: wp_insert_attachment failed');
        @unlink($target_path);
        return;
    }

    // SVGs have no raster metadata — store an empty array so WP doesn't
    // attempt to generate thumbnails and so get_attached_file()/get_post_meta
    // remain consistent.
    wp_update_attachment_metadata($attach_id, array(
        'file' => _wp_relative_upload_path($target_path),
    ));

    set_post_thumbnail($post->ID, $attach_id);

    if ($current_thumb_id) {
        wp_delete_attachment($current_thumb_id, true);
    }
}
