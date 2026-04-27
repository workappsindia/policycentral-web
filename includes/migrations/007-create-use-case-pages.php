<?php
/**
 * Migration 007: Auto-create the Use Cases parent page and 6 child pages.
 *
 * Structure:
 *   /use-cases/                             → page-use-cases.php
 *   /use-cases/policy-management/           → page-use-case-policy-management.php
 *   /use-cases/corporate-updates/           → page-use-case-corporate-updates.php
 *   /use-cases/product-information/         → page-use-case-product-information.php
 *   /use-cases/sops/                        → page-use-case-sops.php
 *   /use-cases/branch-circulars/            → page-use-case-branch-circulars.php
 *   /use-cases/business-requirement-docs/   → page-use-case-business-requirement-docs.php
 *
 * Idempotent:
 *   - If parent slug already exists, re-uses it and (re)assigns its template.
 *   - If child slug already exists at that parent, re-uses it and (re)assigns its template + parent.
 *   - Does not touch post_status or content if the page already exists.
 */

function pcgpt_migration_007_create_use_case_pages() {

    // 1. Parent page: Use Cases
    $parent_slug     = 'use-cases';
    $parent_title    = 'Use Cases';
    $parent_template = 'page-use-cases.php';

    $existing_parent = get_posts(array(
        'name'           => $parent_slug,
        'post_type'      => 'page',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'post_parent'    => 0,
        'numberposts'    => 1,
    ));

    if (!empty($existing_parent)) {
        $parent_id = $existing_parent[0]->ID;
        $current_template = get_post_meta($parent_id, '_wp_page_template', true);
        if ($current_template !== $parent_template) {
            update_post_meta($parent_id, '_wp_page_template', $parent_template);
        }
    } else {
        $parent_id = wp_insert_post(array(
            'post_title'   => $parent_title,
            'post_name'    => $parent_slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));

        if (is_wp_error($parent_id) || !$parent_id) {
            // Cannot proceed without parent — exit cleanly. Next admin_init will retry.
            return;
        }

        update_post_meta($parent_id, '_wp_page_template', $parent_template);
    }

    // 2. Child pages
    $children = array(
        'policy-management'            => array(
            'title'    => 'Policy Management',
            'template' => 'page-use-case-policy-management.php',
        ),
        'corporate-updates'            => array(
            'title'    => 'Corporate Updates',
            'template' => 'page-use-case-corporate-updates.php',
        ),
        'product-information'          => array(
            'title'    => 'Product Information',
            'template' => 'page-use-case-product-information.php',
        ),
        'sops'                         => array(
            'title'    => 'SOPs',
            'template' => 'page-use-case-sops.php',
        ),
        'branch-circulars'             => array(
            'title'    => 'Branch Circulars',
            'template' => 'page-use-case-branch-circulars.php',
        ),
        'business-requirement-docs'    => array(
            'title'    => 'Business Requirement Documents',
            'template' => 'page-use-case-business-requirement-docs.php',
        ),
    );

    foreach ($children as $slug => $config) {
        $existing = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'page',
            'post_status'    => array('publish', 'draft', 'pending', 'private'),
            'numberposts'    => 1,
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

    // Flush permalinks so /use-cases/<child>/ URLs resolve immediately.
    flush_rewrite_rules(false);
}
