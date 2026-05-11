<?php
/**
 * Blog URL Rewrites
 *
 * Creates the custom URL structure for blog posts:
 *
 *   /blogs/                          → page-blogs.php (main index, handled by page slug)
 *   /blogs/author/{author-slug}/     → author.php (guest author archive)
 *   /blogs/author/{author-slug}/page/N/ → paginated author archive
 *   /blogs/{category-slug}/          → category.php (category archive)
 *   /blogs/{category-slug}/page/N/   → paginated category archive
 *   /blogs/{category-slug}/{post-slug}/ → single.php (blog post)
 *
 * Also filters post_link so WordPress generates the correct permalink for posts
 * in the frontend (otherwise get_permalink() would return /?p=ID).
 *
 * IMPORTANT: After activating/changing this, WordPress must flush rewrite rules.
 * We flush on theme activation and when the class version changes.
 */

if (!defined('ABSPATH')) exit;

class PCB_Rewrite {

    // Bump this when rewrite rules change — triggers a flush
    const VERSION = '1.2.0';

    public static function register() {
        add_action('init', array(__CLASS__, 'add_rewrite_rules'), 20);
        add_filter('post_link', array(__CLASS__, 'filter_post_link'), 10, 2);
        add_filter('query_vars', array(__CLASS__, 'add_query_vars'));
        add_action('pre_get_posts', array(__CLASS__, 'handle_blog_queries'));
        add_filter('pre_handle_404', array(__CLASS__, 'skip_404_for_blogs_pagination'), 10, 2);
        add_action('init', array(__CLASS__, 'maybe_flush_rules'), 99);
    }

    /**
     * Static WP pages do not natively support paged > 1 on their main query,
     * so WP's 404 handler fires for /blogs/page/N/ even though our template
     * (page-blogs.php) runs its own paginated WP_Query. Short-circuit the
     * 404 so the template renders.
     */
    public static function skip_404_for_blogs_pagination($preempt, $wp_query) {
        if ($preempt) return $preempt;
        if (!$wp_query->is_main_query()) return $preempt;
        $pagename = $wp_query->get('pagename');
        $paged    = (int) $wp_query->get('paged');
        if ($pagename === 'blogs' && $paged > 1) {
            return true; // Tell WP not to 404 — page-blogs.php handles the paged query itself
        }
        return $preempt;
    }

    /**
     * Register all custom rewrite rules.
     * Order matters — more specific rules must come BEFORE less specific ones.
     */
    public static function add_rewrite_rules() {

        // BLOGS INDEX PAGINATION: /blogs/page/N/
        // MUST be registered first within the 'top' bucket because
        // add_rewrite_rule with 'top' appends inside that bucket — first
        // call wins. Without this priority, the single-post rule below
        // would match /blogs/page/2/ as category="page", name="2" and 404.
        add_rewrite_rule(
            '^blogs/page/([0-9]+)/?$',
            'index.php?pagename=blogs&paged=$matches[1]',
            'top'
        );

        // AUTHOR ARCHIVE: /blogs/author/{slug}/ and paginated
        add_rewrite_rule(
            '^blogs/author/([^/]+)/page/([0-9]+)/?$',
            'index.php?pcb_author=$matches[1]&paged=$matches[2]',
            'top'
        );
        add_rewrite_rule(
            '^blogs/author/([^/]+)/?$',
            'index.php?pcb_author=$matches[1]',
            'top'
        );

        // SINGLE POST: /blogs/{category}/{post-slug}/
        add_rewrite_rule(
            '^blogs/([^/]+)/([^/]+)/?$',
            'index.php?pcb_category=$matches[1]&name=$matches[2]',
            'top'
        );

        // CATEGORY ARCHIVE: /blogs/{category}/ and paginated
        add_rewrite_rule(
            '^blogs/([^/]+)/page/([0-9]+)/?$',
            'index.php?pcb_category=$matches[1]&paged=$matches[2]',
            'top'
        );
        add_rewrite_rule(
            '^blogs/([^/]+)/?$',
            'index.php?pcb_category=$matches[1]',
            'top'
        );
    }

    public static function add_query_vars($vars) {
        $vars[] = 'pcb_category';
        $vars[] = 'pcb_author';
        return $vars;
    }

    /**
     * When WordPress hits a blog URL, we need to tell it what to query.
     * This hooks pre_get_posts to route the three custom URL patterns
     * to the correct template.
     */
    public static function handle_blog_queries($query) {
        if (!$query->is_main_query() || is_admin()) return;

        $author_slug   = $query->get('pcb_author');
        $category_slug = $query->get('pcb_category');
        $post_name     = $query->get('name');

        // Case 1: Guest author archive
        if ($author_slug && !$post_name) {
            $author = get_page_by_path($author_slug, OBJECT, 'pc_author');
            if (!$author) {
                $query->set_404();
                status_header(404);
                return;
            }
            // Query posts where _pcb_guest_author = this author's ID
            $query->set('post_type', 'post');
            $query->set('meta_query', array(
                array(
                    'key'     => '_pcb_guest_author',
                    'value'   => (string) $author->ID,
                    'compare' => '=',
                ),
            ));
            $query->set('posts_per_page', 10);
            $query->is_home     = false;
            $query->is_archive  = true;
            $query->is_author   = true;      // So template_include can pick up
            $query->set('_pcb_is_guest_author_archive', true);
            $query->set('_pcb_guest_author_id', $author->ID);
            return;
        }

        // Case 2: Single blog post at /blogs/{cat}/{post-slug}/
        if ($category_slug && $post_name) {
            // WP will resolve 'name' to the post. We just need to make sure
            // it's a post (not a page) and verify category match in template.
            $query->set('post_type', 'post');
            $query->set('_pcb_url_category', $category_slug);
            return;
        }

        // Case 3: Category archive at /blogs/{cat}/
        if ($category_slug && !$post_name) {
            $term = get_term_by('slug', $category_slug, 'category');
            if (!$term) {
                $query->set_404();
                status_header(404);
                return;
            }
            $query->set('category_name', $category_slug);
            $query->set('post_type', 'post');
            $query->set('posts_per_page', 10);
            $query->is_home     = false;
            $query->is_category = true;
            $query->is_archive  = true;
            $query->set('_pcb_is_blog_category_archive', true);
            return;
        }
    }

    /**
     * Filter permalink for regular posts to use /blogs/{category}/{post-slug}/
     */
    public static function filter_post_link($permalink, $post) {
        if (!$post || $post->post_type !== 'post') return $permalink;

        $category = pcb_get_primary_category($post->ID);
        if (!$category) {
            // Fallback — no category assigned yet (draft?); use /blogs/uncategorized/ or slug
            return home_url('/blogs/uncategorized/' . $post->post_name . '/');
        }

        return home_url('/blogs/' . $category->slug . '/' . $post->post_name . '/');
    }

    /**
     * Flush rewrite rules when our rule version changes.
     * Avoids flushing on every request (expensive).
     */
    public static function maybe_flush_rules() {
        $stored = get_option('pcb_rewrite_version', '');
        if ($stored !== self::VERSION) {
            flush_rewrite_rules(false);
            update_option('pcb_rewrite_version', self::VERSION);
        }
    }
}
