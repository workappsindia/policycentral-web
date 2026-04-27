<?php
/**
 * Migration 026: Refresh the Why-Companies-Fail blog thumbnail to the
 * cleaned-up v3 design (why-companies-fail.jpg).
 *
 * Migration 025 originally attached "why-companies-fail-broken-chain.jpg".
 * The user re-exported the design with the text-overlap issue fixed and
 * sized down to ~38 KB. This migration swaps the attachment on sites where
 * 025 already ran with the older filename. Idempotent.
 */

function pcgpt_migration_026_refresh_compliance_fail_thumbnail_v2() {

    $slug         = 'why-companies-fail-policy-compliance';
    $new_filename = 'why-companies-fail.jpg';
    $new_title    = 'Why Most Companies Fail at Policy Compliance';
    $new_path     = get_template_directory() . '/assets/blog-images/' . $new_filename;

    if (!file_exists($new_path)) {
        error_log('PCGPT Migration 026: source image missing at ' . $new_path);
        return;
    }

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 019 will seed with the new file directly.
    }
    $post = $existing[0];

    $current_thumb_id = get_post_thumbnail_id($post->ID);
    if ($current_thumb_id) {
        $current_path = get_attached_file($current_thumb_id);
        if ($current_path && basename($current_path) === $new_filename) {
            return; // Already on the new file
        }
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($new_filename, null, file_get_contents($new_path));
    if (!empty($upload['error'])) {
        error_log('PCGPT Migration 026: wp_upload_bits failed — ' . $upload['error']);
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
        error_log('PCGPT Migration 026: wp_insert_attachment failed');
        return;
    }

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post->ID, $attach_id);

    if ($current_thumb_id) {
        wp_delete_attachment((int) $current_thumb_id, true);
    }
}
