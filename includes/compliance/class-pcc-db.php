<?php
/**
 * PCC_DB — instrument_edges table accessors (the RBI dependency graph)
 *
 * Reads/writes wp_pc_instrument_edges. One row = a directed relationship
 * between two RBI instruments, keyed on their RBI notification IDs:
 *
 *   from_id --(amends|repeals|references)--> to_id
 *
 * Dual-purpose: impact-mapping ("which related instruments") + staleness
 * detection (an amends/repeals edge whose to_id is one of our decoded rules
 * means that decode is stale). Substrate for the future discovery graph.
 *
 * Table creation is handled by migration 058, NOT here.
 */

defined('ABSPATH') || exit;

class PCC_DB {

    const EDGE_TYPES = array('amends', 'repeals', 'references');

    public static function edges_table() {
        global $wpdb;
        return $wpdb->prefix . 'pc_instrument_edges';
    }

    /**
     * Add a dependency edge. Idempotent — an identical (from,to,type) edge
     * is not duplicated. Returns the edge row ID.
     */
    public static function add_edge($from_id, $to_id, $edge_type = 'references', $snippet = '') {
        global $wpdb;

        $from_id   = sanitize_text_field((string) $from_id);
        $to_id     = sanitize_text_field((string) $to_id);
        $edge_type = in_array($edge_type, self::EDGE_TYPES, true) ? $edge_type : 'references';

        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM " . self::edges_table() . "
             WHERE from_id = %s AND to_id = %s AND edge_type = %s",
            $from_id, $to_id, $edge_type
        ));
        if ($existing) {
            return (int) $existing;
        }

        $wpdb->insert(self::edges_table(), array(
            'from_id'    => $from_id,
            'to_id'      => $to_id,
            'edge_type'  => $edge_type,
            'snippet'    => $snippet,
            'created_at' => current_time('mysql'),
        ));

        return (int) $wpdb->insert_id;
    }

    /** Edges originating from an instrument (what it amends/repeals/references). */
    public static function edges_from($from_id) {
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM " . self::edges_table() . " WHERE from_id = %s ORDER BY id ASC",
            sanitize_text_field((string) $from_id)
        )) ?: array();
    }

    /** Edges pointing at an instrument (what amends/repeals/references it). */
    public static function edges_to($to_id) {
        global $wpdb;
        return $wpdb->get_results($wpdb->prepare(
            "SELECT * FROM " . self::edges_table() . " WHERE to_id = %s ORDER BY id ASC",
            sanitize_text_field((string) $to_id)
        )) ?: array();
    }
}
