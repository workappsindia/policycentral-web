<?php
/**
 * Migration 061: Load the FY25-26 enforcement seed records as rbi_enforcement posts
 *
 * Each record becomes one rbi_enforcement post at /compliance/enforcement/{id},
 * with the filterable dimensions set as taxonomy terms and the full normalised
 * record cached in `_pcc_record` meta (read by PCC_Enforcement → the tracker +
 * entry pages). The tracker thus becomes a true view over the CPT.
 *
 * §8 re-tagging: the seed's related_rules reference the repealed 2023 IO rule;
 * we remap that to the correct 2026 decode by entity group (Bank → commercial
 * banks, NBFC → NBFC) so cross-links point at a live decode.
 *
 * Idempotent: a record whose slug already exists is skipped.
 */

function pcgpt_migration_061_load_enforcement_records() {
    if (!post_type_exists('rbi_enforcement')) {
        return;
    }

    $records = PCC_Enforcement::seed_records();
    if (!$records) {
        return;
    }

    foreach ($records as $rec) {
        $slug = $rec['id'] ?? '';
        if (!$slug || get_page_by_path($slug, OBJECT, 'rbi_enforcement')) {
            continue; // idempotent
        }

        // §8: remap the repealed-2023 rule reference to the live 2026 decode.
        $rec = PCC_Enforcement::remap_related_rules($rec);

        $title = ($rec['entity_name'] ?? 'RBI action')
               . ' — ' . date('d M Y', strtotime($rec['action_date'] ?? 'now'));

        $post_id = wp_insert_post(array(
            'post_type'   => 'rbi_enforcement',
            'post_status' => 'publish',
            'post_name'   => $slug,
            'post_title'  => $title,
            'post_content'=> '',
        ));
        if (!$post_id || is_wp_error($post_id)) {
            continue;
        }

        // Filterable dimensions as taxonomies.
        wp_set_object_terms($post_id, $rec['re_type'],     're_type',     false);
        wp_set_object_terms($post_id, $rec['re_group'],    're_group',    false);
        wp_set_object_terms($post_id, $rec['action_type'], 'action_type', false);
        wp_set_object_terms($post_id, $rec['fiscal_year'], 'fiscal_year', false);
        wp_set_object_terms($post_id, $rec['scope_fit'],   'scope_fit',   false);
        wp_set_object_terms($post_id, (array) $rec['reason_categories'], 'reason_category', false);

        // Theme terms already exist (migration 059) — assign by ID to avoid dupes.
        $theme_ids = array();
        foreach ((array) ($rec['themes'] ?? array()) as $th_slug) {
            $t = get_term_by('slug', $th_slug, 'theme');
            if ($t) $theme_ids[] = (int) $t->term_id;
        }
        if ($theme_ids) {
            wp_set_object_terms($post_id, $theme_ids, 'theme', false);
        }

        // Cache the normalised record + sortable/queryable scalars.
        update_post_meta($post_id, '_pcc_record', PCC_Enforcement::encode($rec));
        update_post_meta($post_id, '_pcc_action_date', $rec['action_date'] ?? '');
        update_post_meta($post_id, '_pcc_entity_slug', $rec['entity_slug'] ?? '');
        if (array_key_exists('penalty_amount_lakhs', $rec) && $rec['penalty_amount_lakhs'] !== null) {
            update_post_meta($post_id, '_pcc_penalty_lakhs', $rec['penalty_amount_lakhs']);
        }
    }
}
