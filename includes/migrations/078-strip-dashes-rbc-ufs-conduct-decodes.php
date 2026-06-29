<?php
/**
 * Migration 078: Strip dashes from the RBC/UFS conduct-decode post fields.
 *
 * Client copy preference: no em/en dashes in customer-facing copy. Migration
 * 077 seeded the two rbi_rule posts with em-dashes in their titles/excerpt and
 * en-dash clause ranges in the summary, and those surface on the
 * /compliance/rules/ index cards. 077 has already run on dev, so editing it
 * would not re-apply; this forward-only migration updates the existing posts to
 * dash-free text (colons / "to" ranges / parentheses). On a fresh environment
 * (e.g. prod) 077 creates the posts first and this immediately normalises them.
 *
 * The decode template bodies (views/rules/*.php, views/hubs/*.php) are files,
 * already dash-free in the same commit, so they need no migration.
 *
 * Idempotent: sets fixed values; safe to re-run. Skips a slug not yet present.
 */

function pcgpt_migration_078_strip_dashes_rbc_ufs_conduct_decodes() {
    if (!post_type_exists('rbi_rule')) {
        return;
    }

    $updates = array(
        'rbc-advertising-misselling-2026' => array(
            'post_title'   => 'RBI (Responsible Business Conduct) Second Amendment Directions, 2026: Advertising, Marketing & Mis-selling',
            'post_excerpt' => 'RBI\'s 15 June 2026 rules on how regulated entities may advertise, market and sell financial products (own and third-party): a DSA/DMA regime, hard-coded consent and disclosure, eleven banned dark patterns, and what counts as mis-selling. Effective 1 January 2027.',
            'post_content' => 'The Responsible Business Conduct Second Amendment, issued to all ten regulated-entity classes on 15 June 2026 and effective 1 January 2027. Worked reference: Commercial Banks paragraphs 85A to 85ZA and Annex IIA; NBFCs/HFCs carry the same at 101A to 101ZA.',
        ),
        'ufs-agency-referral-2026' => array(
            'post_title'   => 'RBI (Undertaking of Financial Services) Amendment Directions, 2026: Agency & Referral Services',
            'post_excerpt' => 'RBI\'s 15 June 2026 companion amendment redrawing the line between an agency arrangement (fee-based, no risk participation) and a referral arrangement (introduce only, never sell) with third-party product providers. Effective 1 January 2027.',
            'post_content' => 'The Undertaking of Financial Services amendment, issued to seven regulated-entity classes on 15 June 2026 and effective 1 January 2027. Worked reference: Commercial Banks paragraphs 4, 52, 58 and 62.',
        ),
    );

    foreach ($updates as $slug => $fields) {
        $post = get_page_by_path($slug, OBJECT, 'rbi_rule');
        if (!$post) {
            continue; // 077 hasn't created it yet on this env; nothing to fix.
        }
        // post_name is omitted on purpose so the slug/URL never changes.
        wp_update_post(array(
            'ID'           => $post->ID,
            'post_title'   => $fields['post_title'],
            'post_excerpt' => $fields['post_excerpt'],
            'post_content' => $fields['post_content'],
        ));
    }

    // Title/excerpt changed → refresh the sitemap (lastmod) in the same batch.
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
