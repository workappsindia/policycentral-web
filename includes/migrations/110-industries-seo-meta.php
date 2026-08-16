<?php
/**
 * Migration 110: SEO titles and meta descriptions for the Industries section.
 *
 * The four Industries pages shipped without a Rank Math title override and
 * without a meta description, so search results fell back to the WordPress
 * default ("Industries - PolicyCentral.ai") with no snippet. This sets both
 * fields on:
 *
 *   /industries/                    hub, policy management across industries
 *   /industries/pharma-healthcare/
 *   /industries/retail/
 *   /industries/education/
 *
 * Pages are resolved by full path (not bare slug) so a same-slug page elsewhere
 * in the tree can never be written to by mistake.
 *
 * Idempotent: writes the same values every run; skips any page not found.
 * Existing values ARE overwritten, which is the point of the migration.
 */

function pcgpt_migration_110_industries_seo_meta() {

    $meta = array(
        'industries' => array(
            'title' => 'Policy Management Software by Industry | PolicyCentral.ai',
            'desc'  => 'Policy management shaped to how your industry actually works: pharma and healthcare, retail chains, and education. One trusted engine, tuned to each workflow.',
        ),
        'industries/pharma-healthcare' => array(
            'title' => 'Pharma & Healthcare Policy Management | PolicyCentral.ai',
            'desc'  => 'Controlled SOPs, quality manuals and training records with electronic signatures, audit trails and role based approvals. Supports FDA 21 CFR Part 11 workflows.',
        ),
        'industries/retail' => array(
            'title' => 'Retail Policy Management Software | PolicyCentral.ai',
            'desc'  => 'Store circulars, pricing protocols, SOPs and vendor advisories delivered to every outlet and vendor in the local language, with acknowledgement on record.',
        ),
        'industries/education' => array(
            'title' => 'Education Policy Management Software | PolicyCentral.ai',
            'desc'  => 'Course catalogues, university profiles, fee structures and eligibility rules in one living, searchable library, always current and answerable in plain language.',
        ),
    );

    foreach ($meta as $path => $fields) {
        $page = get_page_by_path($path, OBJECT, 'page');

        if (!$page) {
            error_log("PCGPT Migration 110: page /{$path}/ not found, skipped.");
            continue;
        }

        update_post_meta($page->ID, 'rank_math_title', $fields['title']);
        update_post_meta($page->ID, 'rank_math_description', $fields['desc']);
    }

    // Titles and descriptions are not part of the sitemap payload, but Rank Math
    // caches rendered output per URL. Bust it so the new tags show up at once.
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
