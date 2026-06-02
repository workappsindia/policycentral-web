<?php
/**
 * PCC_CPT — Custom post types & taxonomies for Compliance Intelligence
 *
 * CPTs:
 *   rbi_rule        → rule-decode pages (also the registry node).  /compliance/rules/{slug}
 *   rbi_enforcement → enforcement entries (one RBI action each).   /compliance/enforcement/{id}
 *
 * Taxonomies (per enforcement-tracker-schema.json → wordpress_mapping):
 *   enforcement: re_type, re_group, reason_category, theme, scope_fit, fiscal_year, action_type
 *   rule:        theme, entity_class, department
 *
 * 'theme' is shared by both CPTs (it maps 1:1 to a hub page).
 *
 * The section drives its own URLs via custom templates/views (PCC_Rewrite, Phase 2),
 * so taxonomies are registered with rewrite=false + query_var=false — no taxonomy
 * archives, no public query-var collisions. They still power admin filtering,
 * REST, and our own view queries.
 */

defined('ABSPATH') || exit;

class PCC_CPT {

    public static function register() {
        // Taxonomies first (priority 9) so object-type association is in place
        // before the CPTs register at priority 10.
        add_action('init', array(__CLASS__, 'register_taxonomies'), 9);
        add_action('init', array(__CLASS__, 'register_post_types'), 10);
    }

    public static function register_post_types() {
        register_post_type('rbi_rule', array(
            'labels'            => self::labels('RBI Rule', 'RBI Rules'),
            'public'            => true,
            'show_in_rest'      => true,
            'menu_icon'         => 'dashicons-book-alt',
            'menu_position'     => 31,
            'supports'          => array('title', 'editor', 'excerpt', 'custom-fields', 'revisions'),
            'has_archive'       => false,
            'rewrite'           => array('slug' => 'compliance/rules', 'with_front' => false),
            'show_in_nav_menus' => false,
        ));

        register_post_type('rbi_enforcement', array(
            'labels'            => self::labels('Enforcement Action', 'Enforcement Actions'),
            'public'            => true,
            'show_in_rest'      => true,
            'menu_icon'         => 'dashicons-shield',
            'menu_position'     => 32,
            'supports'          => array('title', 'editor', 'custom-fields', 'revisions'),
            'has_archive'       => false,
            'rewrite'           => array('slug' => 'compliance/enforcement', 'with_front' => false),
            'show_in_nav_menus' => false,
        ));
    }

    public static function register_taxonomies() {
        // Shared: one term per hub page, on both CPTs.
        self::tax('theme', array('rbi_rule', 'rbi_enforcement'), 'Theme', 'Themes');

        // Enforcement-only.
        self::tax('re_type',         array('rbi_enforcement'), 'RE Type',         'RE Types');
        self::tax('re_group',        array('rbi_enforcement'), 'RE Group',        'RE Groups');
        self::tax('reason_category', array('rbi_enforcement'), 'Reason Category', 'Reason Categories');
        self::tax('scope_fit',       array('rbi_enforcement'), 'Scope Fit',       'Scope Fit');
        self::tax('fiscal_year',     array('rbi_enforcement'), 'Fiscal Year',     'Fiscal Years');
        self::tax('action_type',     array('rbi_enforcement'), 'Action Type',     'Action Types');

        // Rule-only.
        self::tax('entity_class', array('rbi_rule'), 'Entity Class',   'Entity Classes');
        self::tax('department',   array('rbi_rule'), 'RBI Department',  'RBI Departments');
    }

    private static function tax($key, $object_types, $single, $plural) {
        register_taxonomy($key, $object_types, array(
            'labels'            => self::labels($single, $plural),
            'public'            => true,
            'hierarchical'      => false,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => false, // we drive our own URLs
            'rewrite'           => false, // no taxonomy archives; hubs are custom views
        ));
    }

    private static function labels($single, $plural) {
        return array(
            'name'          => $plural,
            'singular_name' => $single,
            'menu_name'     => $plural,
            'all_items'     => "All {$plural}",
            'add_new_item'  => "Add New {$single}",
            'edit_item'     => "Edit {$single}",
            'new_item'      => "New {$single}",
            'view_item'     => "View {$single}",
            'search_items'  => "Search {$plural}",
            'not_found'     => "No {$plural} found",
        );
    }
}
