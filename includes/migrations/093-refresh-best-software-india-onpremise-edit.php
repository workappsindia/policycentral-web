<?php
/**
 * Migration 093: Refresh the "Best Policy Management Software in India" post content
 * to pick up the on-premise deployment copy edit.
 *
 * The post was seeded by migration 085; a data-file edit alone does not update an
 * already-published post, so this re-syncs its content from the (corrected) file.
 * Idempotent: safe to run repeatedly; re-applies the same file content.
 */

function pcgpt_migration_093_refresh_best_software_india_onpremise_edit() {

    $slug = 'best-policy-management-software-india-2026';

    $posts = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'posts_per_page' => 1,
    ));
    if (empty($posts)) return; // not seeded here (e.g. fresh env) — migration 085 creates it correctly

    $content_file = __DIR__ . '/data/best-policy-management-software-india-2026.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 093: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    wp_update_post(array(
        'ID'           => (int) $posts[0]->ID,
        'post_content' => $content,
    ));
}
