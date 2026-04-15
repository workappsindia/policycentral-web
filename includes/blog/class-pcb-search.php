<?php
/**
 * Blog Search Extensions
 *
 * Extends the default WP search for blog posts so that a search term
 * also matches posts written by a Guest Author whose name matches.
 *
 * Example: searching "Tony" returns:
 *  - Any post with "Tony" in the title/content/excerpt (WP default)
 *  - PLUS any post whose _pcb_guest_author meta points to the Guest Author
 *    "Tony Thomas"
 *
 * Implemented in two steps:
 *  1. pre_get_posts: for the main frontend blog search, find Guest Author
 *     IDs whose post_title matches the term, then find posts referencing
 *     those authors via meta. Stash the post IDs in a global.
 *  2. posts_search: if that global has IDs, OR them into the SQL search
 *     clause so WordPress returns those posts alongside the text matches.
 */

if (!defined('ABSPATH')) exit;

class PCB_Search {

    /** Stash for post IDs collected in pre_get_posts → used in posts_search. */
    private static $author_post_ids = array();

    public static function register() {
        add_action('pre_get_posts', array(__CLASS__, 'collect_author_matches'));
        add_filter('posts_search',  array(__CLASS__, 'inject_author_clause'), 10, 2);
    }

    /**
     * When the main frontend query is a search for blog posts, find
     * pc_author entries matching the term and then find all posts
     * whose _pcb_guest_author meta references those entries.
     */
    public static function collect_author_matches($query) {
        // Reset stash on every main-query run to avoid leakage across requests
        self::$author_post_ids = array();

        if (is_admin()) return;
        if (!$query->is_main_query()) return;
        if (!$query->is_search()) return;

        $s = trim((string) $query->get('s'));
        if ($s === '') return;

        // Only extend when searching posts (our sidebar search adds post_type=post)
        $post_type = $query->get('post_type');
        if ($post_type && $post_type !== 'post') return;

        // Find Guest Author posts whose title/content matches
        $matching_authors = get_posts(array(
            'post_type'      => 'pc_author',
            's'              => $s,
            'post_status'    => 'publish',
            'posts_per_page' => 20,
            'fields'         => 'ids',
            'suppress_filters' => true,
        ));

        if (empty($matching_authors)) return;

        global $wpdb;
        $ids_placeholder = implode(',', array_fill(0, count($matching_authors), '%d'));
        $sql = $wpdb->prepare(
            "SELECT DISTINCT post_id FROM {$wpdb->postmeta}
             WHERE meta_key = '_pcb_guest_author' AND meta_value IN ($ids_placeholder)",
            $matching_authors
        );
        $post_ids = $wpdb->get_col($sql);

        if (!empty($post_ids)) {
            self::$author_post_ids = array_map('intval', $post_ids);
        }
    }

    /**
     * Inject an OR clause into the search SQL so WordPress returns the
     * collected post IDs alongside the text-matched posts.
     *
     * The default $search clause looks like:
     *   "  AND (((wp_posts.post_title LIKE '%foo%') OR ...))"
     *
     * We wrap it as:
     *   "  AND (((wp_posts.post_title LIKE ...)) OR wp_posts.ID IN (1,2,3))"
     */
    public static function inject_author_clause($search, $query) {
        if (empty(self::$author_post_ids)) return $search;
        if (trim($search) === '') return $search;

        global $wpdb;
        $ids = implode(',', self::$author_post_ids);

        // $search can contain multiple AND clauses (e.g. WP may append an
        // "AND (wp_posts.post_password = '')" check), so injecting at the
        // end of the string would target the wrong close paren.
        //
        // Instead, target the end of the first "AND ((...))" block — which
        // is the search's own grouping — and OR our IDs into it.
        //
        // Pattern matches the innermost ))) that closes WP's three-level
        // search grouping: `AND (((...) OR (...) OR (...)))`
        $replaced = preg_replace(
            '#\)\)\)#',
            ')) OR ' . $wpdb->posts . '.ID IN (' . $ids . '))',
            $search,
            1
        );

        return $replaced !== null ? $replaced : $search;
    }
}
