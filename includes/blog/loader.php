<?php
/**
 * Blog Module Loader
 *
 * Bootstraps all blog-related functionality:
 * - Guest Authors CPT (pc_author)
 * - URL rewrites (/blogs/{cat}/{post}/, /blogs/author/{name}/)
 * - Content enhancements (reading time, TOC, middle-CTA injection)
 * - Admin tweaks (primary category meta box, guest author selector)
 * - Homepage integration (latest 3 posts)
 */

if (!defined('ABSPATH')) exit;

// Core classes
require_once __DIR__ . '/class-pcb-icons.php';
require_once __DIR__ . '/class-pcb-authors.php';
require_once __DIR__ . '/class-pcb-rewrite.php';
require_once __DIR__ . '/class-pcb-content.php';
require_once __DIR__ . '/class-pcb-admin.php';
require_once __DIR__ . '/class-pcb-search.php';

// Initialize modules
add_action('init', array('PCB_Authors', 'register'), 5);
add_action('init', array('PCB_Rewrite', 'register'), 10);
add_action('init', array('PCB_Admin', 'register'), 11);
add_action('init', array('PCB_Content', 'register'), 12);
add_action('init', array('PCB_Search', 'register'), 13);

/**
 * Helper: get the guest author attached to a post, or null if none.
 * Returns a WP_Post of type pc_author.
 */
function pcb_get_guest_author($post_id = null) {
    if ($post_id === null) $post_id = get_the_ID();
    $author_id = (int) get_post_meta($post_id, '_pcb_guest_author', true);
    if (!$author_id) return null;
    $author = get_post($author_id);
    if (!$author || $author->post_type !== 'pc_author' || $author->post_status !== 'publish') return null;
    return $author;
}

/**
 * Helper: get the primary category for a post.
 * Falls back to first assigned category if no primary is set.
 */
function pcb_get_primary_category($post_id = null) {
    if ($post_id === null) $post_id = get_the_ID();

    $primary_id = (int) get_post_meta($post_id, '_pcb_primary_category', true);
    if ($primary_id) {
        $term = get_term($primary_id, 'category');
        if ($term && !is_wp_error($term)) return $term;
    }

    $cats = get_the_category($post_id);
    return !empty($cats) ? $cats[0] : null;
}

/**
 * Helper: get author meta field.
 */
function pcb_author_meta($author_id, $key) {
    return get_post_meta($author_id, '_pcb_' . $key, true);
}

/**
 * Helper: get author URL (custom /blogs/author/{slug}/ URL).
 */
function pcb_author_url($author) {
    if (is_numeric($author)) $author = get_post($author);
    if (!$author) return '';
    return home_url('/blogs/author/' . $author->post_name . '/');
}
