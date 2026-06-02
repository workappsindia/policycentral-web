<?php
/**
 * PCC_Rewrite — URL routing for the Compliance Intelligence section.
 *
 * Virtual (view) routes — rendered by templates in includes/compliance/views/,
 * not by WP posts:
 *   /compliance                      → section index   (pcc_view=section)
 *   /compliance/enforcement-tracker  → tracker          (pcc_view=tracker)
 *   /compliance/rules                → rule-library idx  (pcc_view=rules_index)
 *   /compliance/{theme}              → theme hub         (pcc_view=hub & pcc_theme)
 *
 * Real CPT singles — handled by their own register_post_type rewrite slugs:
 *   /compliance/rules/{slug}         → single rbi_rule
 *   /compliance/enforcement/{id}     → single rbi_enforcement
 *
 * Order matters: the specific one-segment routes (section, tracker, rules) are
 * registered into the 'top' bucket BEFORE the generic /compliance/{theme} catch,
 * because add_rewrite_rule('top') is first-call-wins. Two-segment CPT URLs are
 * never shadowed by the one-segment {theme} rule ([^/]+ excludes slashes).
 *
 * Mirrors PCB_Rewrite (blog module): version-gated flush, custom query vars,
 * a 404-suppressing template_redirect, and a template_include router.
 */

defined('ABSPATH') || exit;

class PCC_Rewrite {

    // Bump when the rules below change — triggers a one-time flush.
    const VERSION = '1.0.0';

    /** Reserved first-segments that are NOT theme hubs. */
    const RESERVED = array('rules', 'enforcement', 'enforcement-tracker');

    public static function register() {
        add_action('init',               array(__CLASS__, 'add_rewrite_rules'), 20);
        add_filter('query_vars',          array(__CLASS__, 'add_query_vars'));
        add_action('template_redirect',   array(__CLASS__, 'force_http_200'));
        add_filter('template_include',    array(__CLASS__, 'route_template'));
        add_action('init',               array(__CLASS__, 'maybe_flush_rules'), 99);
    }

    public static function add_rewrite_rules() {
        // Specific one-segment routes first (first-call-wins in the 'top' bucket).
        add_rewrite_rule('^compliance/?$',                     'index.php?pcc_view=section',     'top');
        add_rewrite_rule('^compliance/enforcement-tracker/?$', 'index.php?pcc_view=tracker',     'top');
        add_rewrite_rule('^compliance/rules/?$',               'index.php?pcc_view=rules_index', 'top');

        // Generic theme hub LAST — only matches a single non-reserved segment.
        add_rewrite_rule('^compliance/([^/]+)/?$',
            'index.php?pcc_view=hub&pcc_theme=$matches[1]', 'top');
    }

    public static function add_query_vars($vars) {
        $vars[] = 'pcc_view';
        $vars[] = 'pcc_theme';
        return $vars;
    }

    /**
     * Our virtual pages have no underlying post, so WP would mark them 404.
     * When one of our view query vars is present on the main query, clear the
     * 404 and send a 200 — unless it's a hub for a theme term that doesn't exist.
     */
    public static function force_http_200() {
        $view = get_query_var('pcc_view');
        if (!$view) return;

        // Validate theme hubs against the 'theme' taxonomy; unknown → real 404.
        if ($view === 'hub') {
            $theme = get_query_var('pcc_theme');
            if (in_array($theme, self::RESERVED, true) || !term_exists($theme, 'theme')) {
                return; // leave WP's 404 in place
            }
        }

        global $wp_query;
        $wp_query->is_404    = false;
        // These are virtual section pages, not the blog index — clear is_home
        // so SEO plugins don't treat /compliance as the posts page.
        $wp_query->is_home    = false;
        $wp_query->is_archive = false;
        status_header(200);
    }

    /**
     * Load the right view template for the matched route.
     */
    public static function route_template($template) {
        $view = get_query_var('pcc_view');
        if (!$view) return $template;

        // A hub for a non-existent theme falls through to WP's 404 template.
        if ($view === 'hub') {
            $theme = get_query_var('pcc_theme');
            if (in_array($theme, self::RESERVED, true) || !term_exists($theme, 'theme')) {
                return $template;
            }
        }

        $map = array(
            'section'     => 'section-index.php',
            'tracker'     => 'tracker.php',
            'rules_index' => 'rules-index.php',
            'hub'         => 'theme-hub.php',
        );

        if (isset($map[$view])) {
            $file = PCC_DIR . '/views/' . $map[$view];
            if (file_exists($file)) {
                return $file;
            }
        }
        return $template;
    }

    public static function maybe_flush_rules() {
        if (get_option('pcc_rewrite_version') !== self::VERSION) {
            flush_rewrite_rules(false);
            update_option('pcc_rewrite_version', self::VERSION);
        }
    }
}
