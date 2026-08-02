<?php
/**
 * Policy Library, CPT + taxonomy registration.
 *
 * pc_policy          — a "PolicyCentral.ai Policy Template" page.
 *                      Archive: /resources/policies/  Single: /resources/policies/{slug}/
 * pc_policy_category — the category hubs. /resources/policies/category/{cat}/
 */
defined('ABSPATH') || exit;

class PCPL_CPT {
    const POST_TYPE = 'pc_policy';
    const TAXONOMY  = 'pc_policy_category';

    public static function register() {
        add_action('init', array(__CLASS__, 'register_all'), 10);
        // The CPT's attachment catch-all (resources/policies/[^/]+/([^/]+)) would
        // otherwise shadow the category hub rule (resources/policies/category/...).
        // Float the taxonomy rules to the top so hubs resolve before singles.
        add_filter('rewrite_rules_array', array(__CLASS__, 'prioritize_category_rules'));
    }

    public static function prioritize_category_rules($rules) {
        $tax = array();
        $rest = array();
        foreach ($rules as $regex => $query) {
            if (strpos($regex, 'resources/policies/category/') === 0) {
                $tax[$regex] = $query;
            } else {
                $rest[$regex] = $query;
            }
        }
        return $tax + $rest;
    }

    public static function register_all() {
        register_post_type(self::POST_TYPE, array(
            'labels' => array(
                'name'               => 'Policy Templates',
                'singular_name'      => 'Policy Template',
                'menu_name'          => 'Policy Templates',
                'add_new_item'       => 'Add New Policy Template',
                'edit_item'          => 'Edit Policy Template',
                'new_item'           => 'New Policy Template',
                'view_item'          => 'View Policy Template',
                'all_items'          => 'All Policy Templates',
                'search_items'       => 'Search Policy Templates',
            ),
            'public'            => true,
            'show_in_rest'      => true,
            'menu_icon'         => 'dashicons-media-document',
            'menu_position'     => 33,
            'supports'          => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'revisions'),
            'has_archive'       => 'resources/policies',
            'rewrite'           => array('slug' => 'resources/policies', 'with_front' => false),
            'show_in_nav_menus' => false,
        ));

        register_taxonomy(self::TAXONOMY, self::POST_TYPE, array(
            'labels' => array(
                'name'          => 'Policy Categories',
                'singular_name' => 'Policy Category',
                'menu_name'     => 'Categories',
                'all_items'     => 'All Categories',
                'edit_item'     => 'Edit Category',
                'add_new_item'  => 'Add New Category',
            ),
            'public'            => true,
            'hierarchical'      => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'rewrite'           => array('slug' => 'resources/policies/category', 'with_front' => false),
        ));
    }
}
