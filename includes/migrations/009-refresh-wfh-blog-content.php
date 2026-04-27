<?php
/**
 * Migration 009: Refresh WFH blog post content from data file
 *
 * The WFH blog post (slug: work-from-home-policy-india-2026) was originally
 * seeded by migration 008 with an earlier version of the body. We then added
 * inline images, internal links, and external authority links to the source
 * file but migration 008's idempotency guard prevented those edits from
 * reaching the database.
 *
 * This migration re-reads the data file and updates the post content IF the
 * post exists AND the stored content does not already contain the figure tags
 * (the marker for "new content already applied"). Idempotent on subsequent
 * runs because it short-circuits once <figure class="pcb-figure"> is present.
 */

function pcgpt_migration_009_refresh_wfh_blog_content() {

    $slug = 'work-from-home-policy-india-2026';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        // Post doesn't exist yet — migration 008 will seed it with the latest
        // file content directly. Nothing to do here.
        return;
    }

    $post = $existing[0];

    // Idempotency: skip if the new figure markup is already present
    if (strpos($post->post_content, 'class="pcb-figure"') !== false) {
        return;
    }

    // Re-read the data file
    $content_file = __DIR__ . '/data/work-from-home-policy-india-2026.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 009: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 009: content file empty');
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_content' => $content,
    ), true);

    if (is_wp_error($result) || !$result) {
        error_log('PCGPT Migration 009: wp_update_post failed — ' .
            (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
    }
}
