<?php
/**
 * Migration 022: Tighten the "Policy Culture" and "Key Takeaways" sections
 * of the Policy Lifecycle blog post.
 *
 * Both sections were trimmed (~230 words removed) to bring the post in line
 * with the rest of the blog set. Idempotent: short-circuits once the new
 * tightened opening line of the Policy Culture section is present.
 */

function pcgpt_migration_022_tighten_policy_lifecycle_blog() {

    $slug   = 'policy-lifecycle-management';
    $marker = 'The most advanced lifecycle process will not fix';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (empty($existing)) {
        return; // Migration 020 will seed with the tightened file directly.
    }
    $post = $existing[0];

    // Idempotency: skip if the tightened Policy Culture opening is already present
    if (strpos($post->post_content, $marker) !== false) {
        return;
    }

    $content_file = __DIR__ . '/data/policy-lifecycle-management.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 022: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 022: content file empty');
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_content' => $content,
    ), true);

    if (is_wp_error($result) || !$result) {
        error_log('PCGPT Migration 022: wp_update_post failed — ' .
            (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
    }
}
