<?php
/**
 * Migration 046: Create the "Compliance & Audit" blog category.
 *
 * Idempotent: skips if the term exists, refreshes name/description otherwise.
 *
 * The visual treatment (sidebar icon, fallback cover art, accent palette) for
 * this category lives in includes/blog/class-pcb-icons.php under the
 * `compliance-audit` registry key. The category page hero on category.php
 * uses the term description directly, so the description below is the
 * subtitle copy that renders on /blogs/compliance-audit/.
 */

function pcgpt_migration_046_create_compliance_audit_category() {

    $cat = array(
        'name'        => 'Compliance & Audit',
        'slug'        => 'compliance-audit',
        'description' => 'Policy audits, version control, multilingual reach, BFSI documentation — what regulators look for and how to prove it.',
    );

    $existing_term = term_exists($cat['slug'], 'category');

    if (!$existing_term) {
        wp_insert_term(
            $cat['name'],
            'category',
            array(
                'slug'        => $cat['slug'],
                'description' => $cat['description'],
            )
        );
    } else {
        $term_id = is_array($existing_term) ? (int) $existing_term['term_id'] : (int) $existing_term;
        wp_update_term($term_id, 'category', array(
            'name'        => $cat['name'],
            'description' => $cat['description'],
        ));
    }
}
