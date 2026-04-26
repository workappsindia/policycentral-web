<?php
/**
 * Migration 021: Refresh the Policy Lifecycle blog post body to swap
 * "retire / retirement" terminology for "archive / archiving".
 *
 * Policies are never truly retired — they are archived and removed from
 * circulation. This migration corrects the language across the post body.
 *
 * Idempotent: short-circuits once the H3 heading already says "Archiving"
 * (the unambiguous marker for "new content already applied").
 */

function pcgpt_migration_021_refresh_policy_lifecycle_blog() {

    $slug = 'policy-lifecycle-management';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 020 will seed with the corrected file directly.
    }
    $post = $existing[0];

    // Idempotency: skip if the H3 heading already uses "Archiving"
    if (strpos($post->post_content, 'Stage 7: Monitoring, Review, and Archiving') !== false) {
        return;
    }

    $content_file = __DIR__ . '/data/policy-lifecycle-management.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 021: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 021: content file empty');
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_content' => $content,
    ), true);

    if (is_wp_error($result) || !$result) {
        error_log('PCGPT Migration 021: wp_update_post failed — ' .
            (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
    }
}
