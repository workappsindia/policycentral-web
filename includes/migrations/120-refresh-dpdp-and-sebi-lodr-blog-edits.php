<?php
/**
 * Migration 120: Refresh the DPDP Rules and SEBI LODR blog posts after client edits.
 *
 * - DPDP post: Act link now points to the MeitY PDF.
 * - SEBI LODR post: acknowledgment copy (English, response button or digital
 *   signature) and a PolicyGPT reference linking to /policygpt/.
 *
 * Posts were seeded by migrations 115/116; a data-file edit alone does not update
 * an already-published post, so this re-syncs content from the files.
 * Idempotent: re-applies the same file content. No-op where a post is absent.
 */

function pcgpt_migration_120_refresh_dpdp_and_sebi_lodr_blog_edits() {

    $map = array(
        'dpdp-rules-2025-policies-to-update'               => 'dpdp-rules-2025-policies-to-update.html',
        'mandatory-policies-listed-companies-sebi-lodr'    => 'mandatory-policies-listed-companies-sebi-lodr.html',
    );

    foreach ($map as $slug => $file) {
        $posts = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'post',
            'post_status'    => array('publish', 'draft', 'pending', 'private'),
            'posts_per_page' => 1,
        ));
        if (empty($posts)) continue;

        $path = __DIR__ . '/data/' . $file;
        if (!file_exists($path)) { error_log('PCGPT Migration 120: content file missing: ' . $file); continue; }
        $content = file_get_contents($path);
        if ($content === false || trim($content) === '') continue;

        wp_update_post(array(
            'ID'           => (int) $posts[0]->ID,
            'post_content' => $content,
        ));
    }
}
