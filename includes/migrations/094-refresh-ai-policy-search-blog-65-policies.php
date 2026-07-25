<?php
/**
 * Migration 094: Refresh the "AI policy search: questions employees ask HR" post
 * to reflect the expanded PolicyGPT demo corpus (28 -> 65 policies).
 *
 * The post was seeded by migration 091; a data-file edit alone does not update an
 * already-published post, so this re-syncs its content from the (updated) file.
 * Idempotent: safe to run repeatedly; re-applies the same file content.
 */

function pcgpt_migration_094_refresh_ai_policy_search_blog_65_policies() {

    $slug = 'ai-policy-search-questions-employees-ask-hr';

    $posts = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'posts_per_page' => 1,
    ));
    if (empty($posts)) return; // not seeded here (e.g. fresh env) — migration 091 creates it correctly

    $content_file = __DIR__ . '/data/ai-policy-search-questions-employees-ask-hr.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 094: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    wp_update_post(array(
        'ID'           => (int) $posts[0]->ID,
        'post_content' => $content,
    ));
}
