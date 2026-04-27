<?php
/**
 * Migration 010: Remove the wfh-laws-map.png inline image from the WFH blog
 *
 * Migration 009 added two inline images. We've decided to keep only the
 * second one (wfh-eight-documents.png) and drop the first (wfh-laws-map.png).
 *
 * This migration re-reads the data file and updates the post content IF the
 * stored content still references wfh-laws-map.png. Idempotent: once the
 * marker is gone, the migration short-circuits.
 */

function pcgpt_migration_010_remove_wfh_laws_map_image() {

    $slug = 'work-from-home-policy-india-2026';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Post doesn't exist; migration 008 will seed it from the latest file.
    }

    $post = $existing[0];

    // Idempotency: skip if the wfh-laws-map.png reference is already gone
    if (strpos($post->post_content, 'wfh-laws-map.png') === false) {
        return;
    }

    $content_file = __DIR__ . '/data/work-from-home-policy-india-2026.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 010: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 010: content file empty');
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_content' => $content,
    ), true);

    if (is_wp_error($result) || !$result) {
        error_log('PCGPT Migration 010: wp_update_post failed — ' .
            (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
    }
}
