<?php
/**
 * PCC_Enforcement — read access to enforcement records (the tracker's data layer).
 *
 * Records are stored as rbi_enforcement CPT posts (loaded by migration 061), with
 * the full normalised record cached as JSON in the `_pcc_record` post meta and the
 * filterable dimensions also set as taxonomy terms. get_all()/get_by_slug() return
 * the record in the same shape as the seed dataset (plus a `permalink`), so the
 * tracker and entry pages are true views over the CPT.
 *
 * Fallback: before migration 061 has run (no posts yet), get_all() reads the seed
 * JSON so the tracker is never empty.
 */

defined('ABSPATH') || exit;

class PCC_Enforcement {

    /** All records, newest action first. */
    public static function get_all() {
        $posts = get_posts(array(
            'post_type'      => 'rbi_enforcement',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'meta_key'       => '_pcc_action_date',
            'orderby'        => 'meta_value',
            'order'          => 'DESC',
        ));

        if (!$posts) {
            // Pre-migration fallback: apply the same §8 remap as the loader so
            // rule↔enforcement cross-links resolve even before the records load.
            return array_map(array(__CLASS__, 'remap_related_rules'), self::seed_records());
        }

        $out = array();
        foreach ($posts as $p) {
            $rec = json_decode((string) get_post_meta($p->ID, '_pcc_record', true), true);
            if (!is_array($rec)) continue;
            $rec['permalink'] = get_permalink($p->ID);
            $out[] = $rec;
        }
        return $out;
    }

    /** One record by its slug/id, or null. */
    public static function get_by_slug($slug) {
        $post = get_page_by_path($slug, OBJECT, 'rbi_enforcement');
        if (!$post) return null;
        $rec = json_decode((string) get_post_meta($post->ID, '_pcc_record', true), true);
        if (!is_array($rec)) return null;
        $rec['permalink'] = get_permalink($post->ID);
        return $rec;
    }

    /**
     * §8 re-tag: remap the repealed-2023 IO rule reference to the live 2026
     * decode by entity group (Bank → commercial banks, NBFC → NBFC).
     */
    public static function remap_related_rules($rec) {
        $group = $rec['re_group'] ?? '';
        $rec['related_rules'] = array_values(array_map(function ($rule_slug) use ($group) {
            if ($rule_slug === 'internal-ombudsman-direction-2023') {
                return $group === 'NBFC' ? 'io-nbfc-2026' : 'io-commercial-banks-2026';
            }
            return $rule_slug;
        }, (array) ($rec['related_rules'] ?? array())));
        return $rec;
    }

    /**
     * Encode a record for storage in post meta. JSON_UNESCAPED_UNICODE keeps the
     * rupee sign etc. as literal UTF-8, and wp_slash() protects the backslashes/
     * quotes from the wp_unslash() that update_post_meta() applies on save —
     * without it, escapes like ₹ (₹) get corrupted to "u20b9".
     */
    public static function encode($rec) {
        return wp_slash(wp_json_encode($rec, JSON_UNESCAPED_UNICODE));
    }

    /** Raw seed records from the bundled JSON (fallback / source of truth for the load). */
    public static function seed_records() {
        $path = PCC_DIR . '/data/enforcement-seed-data.json';
        if (!file_exists($path)) return array();
        $d = json_decode((string) file_get_contents($path), true);
        return isset($d['records']) && is_array($d['records']) ? $d['records'] : array();
    }
}
