<?php
/**
 * Migration 028: Set post_excerpt on the 7 use case pages so SEO plugins
 * (Rank Math) and OG-tag generators have a meta description to work with.
 *
 * The pages were created by migration 007 without an excerpt because the
 * page content lives in PHP templates, not post_content. This migration
 * fills the excerpt field — only when it's currently empty, so any
 * editorial overrides made in WP admin are preserved.
 *
 * Idempotent: each page is updated at most once; subsequent runs skip
 * pages that already have an excerpt set.
 */

function pcgpt_migration_028_set_use_case_page_excerpts() {

    $pages = array(
        // parent
        'use-cases' => 'One product, every kind of organisational content. See how PolicyCentral.ai handles policies, circulars, SOPs, product docs, leadership messages, and specs across the same lifecycle.',

        // children
        'policy-management'         => 'Hosting, approval, distribution, acknowledgement, and audit, on one platform. Built for compliance, legal, HR, risk, and internal audit teams at regulated enterprises.',
        'corporate-updates'         => 'Leadership messages that actually reach the floor. Built for IC and CEO-office teams running internal communications at scale.',
        'sops'                      => 'SOPs that work for the workforce actually doing the work. Mobile-first, multi-language, comprehension-tested, and tracked at agent level.',
        'branch-circulars'          => 'Branch-level circulars in the right language, to the right branches, with branch-level acknowledgement dashboards and clean correction workflows.',
        'business-requirement-docs' => 'BRDs and technical handoffs that travel across time zones without losing the thread. Built for engineering, product, and architecture teams in distributed delivery organisations.',
        'product-information'       => 'Versioned, searchable product information that keeps GTM teams aligned with what shipped this week, last release, and yesterday afternoon.',
    );

    foreach ($pages as $slug => $excerpt) {
        $existing = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'page',
            'post_status'    => array('publish', 'draft', 'pending', 'private'),
            'numberposts'    => 1,
        ));

        if (empty($existing)) continue;

        $page = $existing[0];

        // Idempotency: only set if currently empty (preserves any editorial
        // override made in WP admin or via Rank Math's own meta field).
        if (trim($page->post_excerpt) !== '') continue;

        $result = wp_update_post(array(
            'ID'           => (int) $page->ID,
            'post_excerpt' => $excerpt,
        ), true);

        if (is_wp_error($result) || !$result) {
            error_log('PCGPT Migration 028: wp_update_post failed for ' . $slug . ' — ' .
                (is_wp_error($result) ? $result->get_error_message() : 'unknown'));
        }
    }
}
