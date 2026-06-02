<?php
/**
 * Migration 060: Seed the two 2026 Internal Ombudsman rule decodes
 *
 * Creates the rbi_rule posts so /compliance/rules/{slug} resolves and the rules
 * are theme/entity-class tagged and queryable by the rule-library index and the
 * enforcement cross-links. The rich decode body is rendered by the slug-matched
 * partials in includes/compliance/views/rules/ — post_content holds only a short
 * summary for the index card.
 *
 * Also records the repeal edges (2026 directions → the repealed 2023 MD) in the
 * instrument_edges graph.
 *
 * Idempotent: skips a decode whose slug already exists; PCC_DB::add_edge dedupes.
 */

function pcgpt_migration_060_seed_io_2026_rule_decodes() {
    if (!post_type_exists('rbi_rule')) {
        return; // CPT registers on init before admin_init; bail safely if not.
    }

    $decodes = array(
        array(
            'slug'         => 'io-commercial-banks-2026',
            'title'        => 'RBI (Commercial Banks - Internal Ombudsman) Directions, 2026',
            'excerpt'      => 'The 2026 Direction requiring larger commercial banks to maintain an independent Internal Ombudsman and escalate every rejected complaint to it before the customer reaches the RBI Ombudsman.',
            'summary'      => 'One of six entity-class Internal Ombudsman Directions that replaced the 2023 Master Direction on 14 January 2026. Applies to commercial banks with 10+ banking outlets (as on 31 March 2025); excludes SFBs, Payments Banks and Local Area Banks.',
            'entity_class' => 'Commercial Banks',
            'rbi_id'       => '13271',
            'ref_no'       => 'RBI/CEPD/2025-26/381',
            'source_url'   => 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13271',
        ),
        array(
            'slug'         => 'io-nbfc-2026',
            'title'        => 'RBI (NBFC - Internal Ombudsman) Directions, 2026',
            'excerpt'      => 'The 2026 Direction requiring larger NBFCs to maintain an independent Internal Ombudsman and escalate every rejected complaint to it before the customer reaches the RBI Ombudsman.',
            'summary'      => 'One of six entity-class Internal Ombudsman Directions (14 January 2026), issued under ss. 45L r/w 45M of the RBI Act. Applies to deposit-taking NBFCs with 10+ branches and non-deposit NBFCs ≥₹5,000 cr with public interface; excludes HFCs, CICs, IFCs and others.',
            'entity_class' => 'NBFC',
            'rbi_id'       => '13274',
            'ref_no'       => 'RBI/CEPD/2025-26/384',
            'source_url'   => 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13274',
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
}
