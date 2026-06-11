<?php
/**
 * Migration 063: Normalise compliance copy punctuation (dashes)
 *
 * Copy edit per client review (2026-06-03): remove em/en dashes from the
 * compliance section. The template copy is fixed in the view files; this
 * migration fixes the two things that live in the DB:
 *  - Re-saves _pcc_record for every rbi_enforcement post from the corrected
 *    seed JSON (one cited reason had an em-dash; now a comma).
 *  - Re-titles the two rbi_rule decode posts, replacing the en-dash in the
 *    instrument name with a hyphen (used by the rule-library card + <title>).
 *
 * Idempotent.
 */

function pcgpt_migration_063_normalise_compliance_dashes() {
    if (!class_exists('PCC_Enforcement')) {
        return;
    }

    // Refresh enforcement records from the corrected seed JSON.
    if (post_type_exists('rbi_enforcement')) {
        foreach (PCC_Enforcement::seed_records() as $rec) {
            $slug = $rec['id'] ?? '';
            if (!$slug) continue;
            $post = get_page_by_path($slug, OBJECT, 'rbi_enforcement');
            if (!$post) continue;
            $rec = PCC_Enforcement::remap_related_rules($rec);
            update_post_meta($post->ID, '_pcc_record', PCC_Enforcement::encode($rec));
        }
    }

    // Re-title the two rule decodes (en-dash → hyphen).
    $retitle = array(
        'io-commercial-banks-2026' => 'RBI (Commercial Banks - Internal Ombudsman) Directions, 2026',
        'io-nbfc-2026'             => 'RBI (NBFC - Internal Ombudsman) Directions, 2026',
    );
    foreach ($retitle as $slug => $title) {
        $post = get_page_by_path($slug, OBJECT, 'rbi_rule');
        if ($post && $post->post_title !== $title) {
            wp_update_post(array('ID' => $post->ID, 'post_title' => $title));
        }
    }
}
