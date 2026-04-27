<?php
/**
 * Migration 015: Refresh the WFH blog title + body content.
 *
 * Two changes for the post seeded by migration 008:
 *  1. Title: "Work From Home Policy in India: What Companies Should Document
 *     in 2026" → "Your Work From Home Policy: What to Document, What to Update"
 *  2. Body: opening line softened (drops "In 2026,"), framing paragraph
 *     re-pointed to the new title, inline image extension swapped (.png →
 *     .jpg), and a new "When to Refresh Your WFH Policy" H2 added.
 *
 * Idempotent: short-circuits once the post already has the new title.
 */

function pcgpt_migration_015_refresh_wfh_blog_title_and_content() {

    $slug      = 'work-from-home-policy-india-2026';
    $new_title = 'Your Work From Home Policy: What to Document, What to Update';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 008 will seed with the new title + content directly.
    }
    $post = $existing[0];

    // Idempotency: if the title already matches, both updates are done.
    if ($post->post_title === $new_title) {
        return;
    }

    $content_file = __DIR__ . '/data/work-from-home-policy-india-2026.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 015: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 015: content file empty');
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_title'   => $new_title,
        'post_content' => $content,
    ), true);

    if (is_wp_error($result) || !$result) {
        error_log('PCGPT Migration 015: wp_update_post failed — ' .
            (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
    }
}
