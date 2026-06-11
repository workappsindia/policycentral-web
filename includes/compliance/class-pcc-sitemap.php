<?php
/**
 * PCC_Sitemap — Rank Math sitemap provider for the compliance section's
 * virtual views (section index, enforcement tracker, rule library, theme hubs).
 *
 * The /compliance hub URLs are rewrite-rule views with no underlying post, so
 * Rank Math's built-in providers never see them. This provider adds a
 * compliance-sitemap.xml to sitemap_index.xml listing those URLs.
 *
 * NOT listed here:
 *  - rbi_rule / rbi_enforcement singles — they ride Rank Math's standard
 *    post-type sitemaps once pt_*_sitemap is enabled (migration 064).
 *  - Theme hubs without a content partial in views/hubs/{slug}.php — those
 *    render the interim "being built" shell (see theme-hub.php) and should not
 *    be submitted for indexing. Each new hub partial joins automatically.
 *
 * This file is required lazily from loader.php inside the
 * rank_math/sitemap/providers filter, so the RankMath interface is guaranteed
 * to exist when this file parses.
 */

defined('ABSPATH') || exit;

class PCC_Sitemap implements \RankMath\Sitemap\Providers\Provider {

    /**
     * Handles only our one virtual type: compliance-sitemap.xml.
     */
    public function handles_type($type) {
        return 'compliance' === $type;
    }

    public function get_index_links($max_entries) {
        return array(
            array(
                'loc'     => \RankMath\Sitemap\Router::get_base_url('compliance-sitemap.xml'),
                'lastmod' => $this->last_modified(),
            ),
        );
    }

    /**
     * The full URL set always fits in one page (well under $max_entries),
     * so $current_page is ignored.
     */
    public function get_sitemap_links($type, $max_entries, $current_page) {
        $mod   = $this->last_modified();
        $links = array(
            array('loc' => home_url('/compliance/'),                     'mod' => $mod),
            array('loc' => home_url('/compliance/enforcement-tracker/'), 'mod' => $mod),
            array('loc' => home_url('/compliance/rules/'),               'mod' => $mod),
        );

        $themes = get_terms(array('taxonomy' => 'theme', 'hide_empty' => false));
        if (!is_wp_error($themes)) {
            foreach ($themes as $term) {
                // Same check theme-hub.php routes on: a hub is real content
                // only when its partial exists; otherwise it's the interim shell.
                if (file_exists(PCC_DIR . '/views/hubs/' . sanitize_file_name($term->slug) . '.php')) {
                    $links[] = array(
                        'loc' => home_url('/compliance/' . $term->slug . '/'),
                        'mod' => $mod,
                    );
                }
            }
        }

        return $links;
    }

    /**
     * The virtual views are live queries over the two compliance CPTs, so the
     * most recent rbi_rule / rbi_enforcement modification is an honest lastmod.
     * Returns '' when neither CPT has content yet (renderer omits <lastmod>).
     */
    private function last_modified() {
        $stamps = array_filter(array(
            get_lastpostmodified('gmt', 'rbi_rule'),
            get_lastpostmodified('gmt', 'rbi_enforcement'),
        ));
        return $stamps ? max($stamps) : '';
    }
}
