<?php
/**
 * Migration 027: Refresh the Policy Lifecycle blog thumbnail to the cleaned-up
 * v3 design (policy-lifecycle-document.jpg).
 *
 * Migration 024 originally attached "policy-lifecycle-statement-small.jpg".
 * The user re-exported the design with a stronger composition ("From draft to
 * signed" + Information Security Policy mockup + Acknowledged stamp) and the
 * file was optimised to ~47 KB. This migration swaps the attachment on sites
 * where 024 already ran with the older filename. Idempotent.
 */

function pcgpt_migration_027_refresh_policy_lifecycle_thumbnail_v2() {

    $slug         = 'policy-lifecycle-management';
    $new_filename = 'policy-lifecycle-document.jpg';
    $new_title    = 'Policy Lifecycle Management';
    $new_path     = get_template_directory() . '/assets/blog-images/' . $new_filename;

    if (!file_exists($new_path)) {
        error_log('PCGPT Migration 027: source image missing at ' . $new_path);
        return;
    }

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 020 will seed with the new file directly.
    }
    $post = $existing[0];

    $current_thumb_id = get_post_thumbnail_id($post->ID);
    if ($current_thumb_id) {
        $current_path = get_attached_file($current_thumb_id);
        if ($current_path && basename($current_path) === $new_filename) {
            return;
        }
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($new_filename, null, file_get_contents($new_path));
    if (!empty($upload['error'])) {
        error_log('PCGPT Migration 027: wp_upload_bits failed — ' . $upload['error']);
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
        error_log('PCGPT Migration 027: wp_insert_attachment failed');
        return;
    }

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post->ID, $attach_id);

    if ($current_thumb_id) {
        wp_delete_attachment((int) $current_thumb_id, true);
    }
}
