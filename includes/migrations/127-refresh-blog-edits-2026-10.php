<?php
/**
 * Migration 127: Refresh October 2026 blog posts after client edits.
 *
 * - Acknowledgment evidence post: "How" bullet no longer claims the language the
 *   employee saw is recorded (per-employee language access is not tracked).
 * - NBFC outsourcing / IT governance post: removed version-history / version-control
 *   claims (feature not yet released).
 *
 * - Policy review cycles post: spelled out the OSH Code name.
 *
 * A data-file edit alone does not update an already-published post, so this
 * re-syncs content from the files. Idempotent. No-op where a post is absent.
 */

function pcgpt_migration_127_refresh_blog_edits_2026_10() {

    $map = array(
        'policy-acknowledgment-audit-evidence-india'              => 'policy-acknowledgment-audit-evidence-india.html',
        'nbfc-outsourcing-it-governance-policy-checklist-rbi'     => 'nbfc-outsourcing-it-governance-policy-checklist-rbi.html',
        'policy-review-cycles-how-often-to-review-policies-india' => 'policy-review-cycles-how-often-to-review-policies-india.html',
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
        if (!file_exists($path)) { error_log('PCGPT Migration 127: content file missing: ' . $file); continue; }
        $content = file_get_contents($path);
        if ($content === false || trim($content) === '') continue;

        wp_update_post(array(
            'ID'           => (int) $posts[0]->ID,
            'post_content' => $content,
        ));
    }
}
