<?php
/**
 * Migration 062: Repair _pcc_record encoding on enforcement posts
 *
 * Migration 061 originally stored the cached record with wp_json_encode() but no
 * wp_slash(), so update_post_meta()'s wp_unslash() stripped the backslash from
 * escapes like ₹ (₹) — surfacing as "u20b9" on the tracker. This re-saves
 * every record from the seed with the corrected encoder (PCC_Enforcement::encode).
 *
 * Fresh environments where 061 runs with the fixed code don't need this, but it's
 * idempotent there too (re-saves identical, correct data).
 */

function pcgpt_migration_062_fix_enforcement_record_encoding() {
    if (!post_type_exists('rbi_enforcement') || !class_exists('PCC_Enforcement')) {
        return;
    }

    foreach (PCC_Enforcement::seed_records() as $rec) {
        $slug = $rec['id'] ?? '';
        if (!$slug) continue;

        $post = get_page_by_path($slug, OBJECT, 'rbi_enforcement');
        if (!$post) continue;

        $rec = PCC_Enforcement::remap_related_rules($rec);
        update_post_meta($post->ID, '_pcc_record', PCC_Enforcement::encode($rec));
    }
}
