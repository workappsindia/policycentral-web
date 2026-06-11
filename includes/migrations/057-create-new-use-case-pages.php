<?php
/**
 * Migration 057: Create the 4 new use-case child pages.
 *
 * Adds these under the existing /use-cases/ parent (created in migration 007):
 *   /use-cases/hr-employee-governance/   → page-use-case-hr-employee-governance.php
 *   /use-cases/retail-operations/        → page-use-case-retail-operations.php
 *   /use-cases/compliance-legal/         → page-use-case-compliance-legal.php
 *   /use-cases/it-security/              → page-use-case-it-security.php
 *
 * Idempotent:
 *   - If the slug already exists at that parent, re-uses it and (re)assigns template + parent.
 *   - Skips silently if the /use-cases/ parent is missing (migration 007 must have run first).
 *   - Does not touch post_status or content for existing pages.
 */

function pcgpt_migration_057_create_new_use_case_pages() {

    // 1. Find the /use-cases/ parent (must have been created by migration 007)
    $parent_slug = 'use-cases';
    $existing_parent = get_posts(array(
        'name'        => $parent_slug,
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'post_parent' => 0,
        'numberposts' => 1,
    ));

    if (empty($existing_parent)) {
        // Migration 007 should have created this. Don't proceed without it.
        error_log('PCGPT Migration 057: /use-cases/ parent page not found. Run migration 007 first.');
        return;
    }

    $parent_id = $existing_parent[0]->ID;

    // 2. New child pages
    $children = array(
        'hr-employee-governance' => array(
            'title'    => 'HR & Employee Governance',
            'template' => 'page-use-case-hr-employee-governance.php',
        ),
        'retail-operations' => array(
            'title'    => 'Retail Operations',
            'template' => 'page-use-case-retail-operations.php',
        ),
        'compliance-legal' => array(
            'title'    => 'Compliance & Legal',
            'template' => 'page-use-case-compliance-legal.php',
        ),
        'it-security' => array(
            'title'    => 'IT & Security',
            'template' => 'page-use-case-it-security.php',
        ),
    );

    foreach ($children as $slug => $config) {
        $existing = get_posts(array(
            'name'        => $slug,
            'post_type'   => 'page',
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));

        if (!empty($existing)) {
            $child_id = $existing[0]->ID;

            // Ensure correct parent
            if ((int) $existing[0]->post_parent !== (int) $parent_id) {
                wp_update_post(array(
                    'ID'          => $child_id,
                    'post_parent' => $parent_id,
                ));
            }

            // Ensure correct template
            $current_template = get_post_meta($child_id, '_wp_page_template', true);
            if ($current_template !== $config['template']) {
                update_post_meta($child_id, '_wp_page_template', $config['template']);
            }
            continue;
        }

        $child_id = wp_insert_post(array(
            'post_title'   => $config['title'],
            'post_name'    => $slug,
            'post_parent'  => $parent_id,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));

        if (!is_wp_error($child_id) && $child_id > 0) {
            update_post_meta($child_id, '_wp_page_template', $config['template']);
        }
    }

    // Flush permalinks so the new /use-cases/<slug>/ URLs resolve immediately.
    flush_rewrite_rules(false);
}
