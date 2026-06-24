<?php
/**
 * Migration 077: Seed the 15 June 2026 conduct-package decodes + light up the
 *                Customer Protection hub.
 *
 * RBI issued, on 15 Jun 2026 (effective 1 Jan 2027), a two-part conduct package:
 *   - Responsible Business Conduct (RBC) Second Amendment Directions, 2026
 *     — advertising, marketing, sale, DSA/DMA, dark patterns, mis-selling.
 *     Issued to 10 entity classes; worked reference = Commercial Banks
 *     notification id=13485 (RBI/2026-27/115), paragraphs 85A–85ZA + Annex IIA.
 *   - Undertaking of Financial Services (UFS) Amendment Directions, 2026
 *     — agency business & referral services. Issued to 7 entity classes; worked
 *     reference = Commercial Banks notification id=13495 (RBI/DoR/2026-27/125).
 *
 * Two rbi_rule posts make /compliance/rules/{slug} resolve; the rich decode
 * bodies are the slug-matched partials in includes/compliance/views/rules/.
 * Both are tagged to the existing 'customer-protection' theme, whose hub partial
 * (views/hubs/customer-protection.php) now exists — so the hub goes Live and
 * joins the compliance sitemap. The theme's display name is updated to reflect
 * the content. Sitemap cache is busted in the SAME batch as the new content.
 *
 * NOTE on dependency edges: these amend the RBC/UFS Directions, 2025, whose RBI
 * instrument IDs are not yet verified from the feed — so no edges are recorded
 * here rather than fabricate a target ID. Add them in a later migration once the
 * 2025 master-direction IDs are confirmed on rbi.org.in.
 *
 * Idempotent: skips a decode whose slug already exists; term rename and cache
 * invalidation are repeat-safe.
 */

function pcgpt_migration_077_seed_rbc_ufs_2026_conduct_decodes() {
    if (!post_type_exists('rbi_rule')) {
        return; // CPT registers on init before admin_init; bail safely if not.
    }

    // Retitle the existing customer-protection theme to match the content it now
    // carries (term seeded in migration 059; slug + URL unchanged).
    if (taxonomy_exists('theme')) {
        $term = get_term_by('slug', 'customer-protection', 'theme');
        if ($term && !is_wp_error($term)) {
            wp_update_term($term->term_id, 'theme', array(
                'name' => 'Customer Protection & Responsible Business Conduct',
            ));
        }
    }

    $decodes = array(
        array(
            'slug'         => 'rbc-advertising-misselling-2026',
            'title'        => 'RBI (Responsible Business Conduct) Second Amendment Directions, 2026 — Advertising, Marketing & Mis-selling',
            'excerpt'      => 'RBI\'s 15 June 2026 rules on how regulated entities may advertise, market and sell financial products — own and third-party: a DSA/DMA regime, hard-coded consent and disclosure, eleven banned dark patterns, and what counts as mis-selling. Effective 1 January 2027.',
            'summary'      => 'The Responsible Business Conduct Second Amendment, issued to all ten regulated-entity classes on 15 June 2026 and effective 1 January 2027. Worked reference: Commercial Banks paragraphs 85A–85ZA and Annex IIA; NBFCs/HFCs carry the same at 101A–101ZA.',
            'entity_class' => 'Banks, Co-ops, NBFCs & HFCs',
            'rbi_id'       => '13485',
            'ref_no'       => 'RBI/2026-27/115',
            'source_url'   => 'https://rbi.org.in/Scripts/NotificationUser.aspx?Id=13485&Mode=0',
        ),
        array(
            'slug'         => 'ufs-agency-referral-2026',
            'title'        => 'RBI (Undertaking of Financial Services) Amendment Directions, 2026 — Agency & Referral Services',
            'excerpt'      => 'RBI\'s 15 June 2026 companion amendment redrawing the line between an agency arrangement (fee-based, no risk participation) and a referral arrangement (introduce only, never sell) with third-party product providers. Effective 1 January 2027.',
            'summary'      => 'The Undertaking of Financial Services amendment, issued to seven regulated-entity classes on 15 June 2026 and effective 1 January 2027. Worked reference: Commercial Banks paragraphs 4, 52, 58 and 62.',
            'entity_class' => 'Banks, Co-ops & NBFCs',
            'rbi_id'       => '13495',
            'ref_no'       => 'RBI/DoR/2026-27/125',
            'source_url'   => 'https://rbi.org.in/Scripts/NotificationUser.aspx?Id=13495&Mode=0',
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
        wp_set_object_terms($post_id, 'customer-protection', 'theme', false);
        wp_set_object_terms($post_id, $d['entity_class'], 'entity_class', false);

        // Reference meta. Status reflects that the rules are notified but only
        // take effect 1 Jan 2027 (the rule-library badge is reserved for
        // 'in-force'); _pcc_issued is the notification date.
        update_post_meta($post_id, '_pcc_status', 'effective-2027');
        update_post_meta($post_id, '_pcc_rbi_id', $d['rbi_id']);
        update_post_meta($post_id, '_pcc_ref_no', $d['ref_no']);
        update_post_meta($post_id, '_pcc_source_url', $d['source_url']);
        update_post_meta($post_id, '_pcc_issued', '2026-06-15');
    }

    // The new decode URLs + the now-Live hub must reach the sitemaps: bust the
    // cache in the same batch as the content (convention since 044/051/064/068).
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
