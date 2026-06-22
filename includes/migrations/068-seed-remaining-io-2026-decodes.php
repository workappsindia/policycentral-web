<?php
/**
 * Migration 068: Seed the four remaining 2026 Internal Ombudsman rule decodes
 *
 * Completes the six-direction IO suite (migration 060 seeded Commercial Banks
 * + NBFC): Small Finance Banks, Payments Banks, Non-Bank PPI Issuers and
 * Credit Information Companies. All four verified on rbi.org.in 2026-06-12 —
 * see compliance-build/research/2026-io-directions-verified.md §C–F.
 *
 * Same pattern as 060: the rbi_rule post makes /compliance/rules/{slug}
 * resolve; the rich decode body is the slug-matched partial in
 * includes/compliance/views/rules/. Records the repeal edges (2026 → 2023 MD)
 * and busts the sitemap cache in the SAME commit as the new content.
 *
 * Idempotent: skips a decode whose slug already exists; PCC_DB::add_edge
 * dedupes; cache invalidation is repeat-safe.
 */

function pcgpt_migration_068_seed_remaining_io_2026_decodes() {
    if (!post_type_exists('rbi_rule')) {
        return; // CPT registers on init before admin_init; bail safely if not.
    }

    $decodes = array(
        array(
            'slug'         => 'io-sfb-2026',
            'title'        => 'RBI (Small Finance Banks - Internal Ombudsman) Directions, 2026',
            'excerpt'      => 'The 2026 Direction requiring larger Small Finance Banks to maintain an independent Internal Ombudsman and escalate every rejected complaint to it before the customer reaches the RBI Ombudsman.',
            'summary'      => 'One of six entity-class Internal Ombudsman Directions (14 January 2026), issued under s. 35A of the Banking Regulation Act. Applies to SFBs with 10+ banking outlets in India as on 31 March 2025; later entrants get six months.',
            'entity_class' => 'Small Finance Banks',
            'rbi_id'       => '13272',
            'ref_no'       => 'RBI/CEPD/2025-26/382',
            'source_url'   => 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13272',
        ),
        array(
            'slug'         => 'io-payments-banks-2026',
            'title'        => 'RBI (Payments Banks - Internal Ombudsman) Directions, 2026',
            'excerpt'      => 'The 2026 Direction requiring larger Payments Banks to maintain an independent Internal Ombudsman and escalate every rejected complaint to it before the customer reaches the RBI Ombudsman.',
            'summary'      => 'One of six entity-class Internal Ombudsman Directions (14 January 2026), issued under s. 35A of the Banking Regulation Act. Applies to Payments Banks with 10+ banking outlets in India as on 31 March 2025; later entrants get six months.',
            'entity_class' => 'Payments Banks',
            'rbi_id'       => '13273',
            'ref_no'       => 'RBI/CEPD/2025-26/383',
            'source_url'   => 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13273',
        ),
        array(
            'slug'         => 'io-ppi-2026',
            'title'        => 'RBI (Non-Bank PPI Issuers - Internal Ombudsman) Directions, 2026',
            'excerpt'      => 'The 2026 Direction requiring larger non-bank Prepaid Payment Instrument issuers to maintain an independent Internal Ombudsman and escalate every rejected complaint to it before the customer reaches the RBI Ombudsman.',
            'summary'      => 'One of six entity-class Internal Ombudsman Directions (14 January 2026), issued under s. 18 of the Payment and Settlement Systems Act, 2007. Applies to non-bank PPI issuers with more than 1 crore PPIs outstanding as on 31 March 2025 or thereafter; six-month runway on crossing the threshold.',
            'entity_class' => 'Non-Bank PPI Issuers',
            'rbi_id'       => '13275',
            'ref_no'       => 'RBI/CEPD/2025-26/385',
            'source_url'   => 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13275',
        ),
        array(
            'slug'         => 'io-cic-2026',
            'title'        => 'RBI (Credit Information Companies - Internal Ombudsman) Directions, 2026',
            'excerpt'      => 'The 2026 Direction requiring every Credit Information Company to maintain an independent Internal Ombudsman and escalate every rejected complaint to it before the complainant reaches the RBI Ombudsman.',
            'summary'      => 'One of six entity-class Internal Ombudsman Directions (14 January 2026), issued under s. 11 of the Credit Information Companies (Regulation) Act, 2005. Applies to ALL registered CICs with no size threshold; IO headcount set annually by the Consumer Protection Committee.',
            'entity_class' => 'Credit Information Companies',
            'rbi_id'       => '13276',
            'ref_no'       => 'RBI/CEPD/2025-26/386',
            'source_url'   => 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13276',
        ),
    );

    foreach ($decodes as $d) {
        $existing = get_page_by_path($d['slug'], OBJECT, 'rbi_rule');
        if ($existing) {
            $post_id = $existing->ID;
        } else {
            $post_id = wp_insert_post(array(
                'post_type'    => 'rbi_rule',
                'post_status'  => 'publish',
                'post_name'    => $d['slug'],
                'post_title'   => $d['title'],
                'post_excerpt' => $d['excerpt'],
                'post_content' => $d['summary'],
            ));
        }

        if (!$post_id || is_wp_error($post_id)) {
            continue;
        }

        // Taxonomy: theme hub + entity class.
        wp_set_object_terms($post_id, 'internal-ombudsman', 'theme', false);
        wp_set_object_terms($post_id, $d['entity_class'], 'entity_class', false);

        // Reference meta (used by the rule-library index + future data-driven views).
        update_post_meta($post_id, '_pcc_status', 'in-force');
        update_post_meta($post_id, '_pcc_rbi_id', $d['rbi_id']);
        update_post_meta($post_id, '_pcc_ref_no', $d['ref_no']);
        update_post_meta($post_id, '_pcc_source_url', $d['source_url']);
        update_post_meta($post_id, '_pcc_issued', '2026-01-14');

        // Dependency edge: this 2026 direction repeals the 2023 Master Direction.
        if (class_exists('PCC_DB')) {
            PCC_DB::add_edge(
                $d['rbi_id'], '12586', 'repeals',
                'The Master Direction – RBI (Internal Ombudsman for Regulated Entities) Directions, 2023 stands repealed.'
            );
        }
    }

    // The new decode URLs must reach rbi_rule-sitemap.xml: bust the cache in
    // the same batch as the content (convention since migrations 044/051/064).
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
