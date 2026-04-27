<?php
/**
 * Migration 023: Trim the Policy Lifecycle blog body to a 14-minute read.
 *
 * Each of the seven stages was condensed by ~40%, plus light trims to the
 * Practical Example and Role of Technology sections. Total post went from
 * ~3,760 words (19 min) to ~2,840 words (14 min).
 *
 * Idempotent: short-circuits once the trimmed Stage 1 opener is present.
 */

function pcgpt_migration_023_trim_policy_lifecycle_blog() {

    $slug   = 'policy-lifecycle-management';
    $marker = 'Every policy starts with a trigger:';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 020 will seed with the trimmed file directly.
    }
    $post = $existing[0];

    if (strpos($post->post_content, $marker) !== false) {
        return; // Trimmed content already in place
    }

    $content_file = __DIR__ . '/data/policy-lifecycle-management.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 023: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 023: content file empty');
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_content' => $content,
    ), true);

    if (is_wp_error($result) || !$result) {
        error_log('PCGPT Migration 023: wp_update_post failed — ' .
            (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
    }
}
