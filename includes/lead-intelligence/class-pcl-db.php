<?php
/**
 * PCL_DB — Database operations for Lead Intelligence
 *
 * Reads/writes to wp_pc_leads (enhanced by migration 003)
 * and wp_pc_lead_intel (enrichment data).
 *
 * Table creation is handled by migration 003, NOT here.
 */

defined('ABSPATH') || exit;

class PCL_DB {

    public static function leads_table() {
        global $wpdb;
        return $wpdb->prefix . 'pc_leads';
    }

    public static function intel_table() {
        global $wpdb;
        return $wpdb->prefix . 'pc_lead_intel';
    }

    /**
     * Format a sequential reference ID: PC-000001
     */
    public static function format_reference_id($id) {
        return 'PC-' . str_pad((int) $id, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Update reference_id and first_name for a newly-inserted lead.
     * Called from pc_handle_contact_form after wp_insert.
     */
    public static function finalize_lead($lead_id, $full_name) {
        global $wpdb;
        $first = strtok(trim($full_name), ' ');
        $ref = self::format_reference_id($lead_id);

        $wpdb->update(
            self::leads_table(),
            array(
                'reference_id' => $ref,
                'first_name'   => $first ?: '',
            ),
            array('id' => $lead_id)
        );

        return $ref;
    }

    /**
     * Update a lead's enrichment status and optional extra fields.
     */
    public static function update_status($lead_id, $status, $extra = array()) {
        global $wpdb;
        $wpdb->update(
            self::leads_table(),
            array_merge(array('enrichment_status' => $status), $extra),
            array('id' => $lead_id)
        );
    }

    /**
     * Get a single lead row by ID.
     */
    public static function get_lead($lead_id) {
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM " . self::leads_table() . " WHERE id = %d",
            (int) $lead_id
        ));
    }

    /**
     * Get enrichment row by lead ID.
     */
    public static function get_intel($lead_id) {
        global $wpdb;
        return $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM " . self::intel_table() . " WHERE lead_id = %d",
            (int) $lead_id
        ));
    }

    /**
     * Save or update enrichment data for a lead.
     */
    public static function save_intel($lead_id, $data, $raw_response) {
        global $wpdb;

        $row = array(
            'lead_id'               => (int) $lead_id,
            'overall_confidence'    => (int) ($data['overall_confidence'] ?? 0),
            'person_found'          => (int) ($data['person']['found'] ?? 0),
            'person_linkedin_url'   => $data['person']['linkedin_url']        ?? null,
            'person_designation'    => $data['person']['likely_designation']  ?? null,
            'person_role_type'      => $data['person']['role_type']           ?? null,
            'person_accuracy'       => (int) ($data['person']['accuracy']     ?? 0),
            'company_name'          => $data['company']['name']           ?? null,
            'company_description'   => $data['company']['description']    ?? null,
            'company_website'       => $data['company']['website']        ?? null,
            'company_industry'      => $data['company']['industry']       ?? null,
            'company_size'          => $data['company']['size']           ?? null,
            'company_employee_count'=> $data['company']['employee_count'] ?? null,
            'company_founded'       => $data['company']['founded']        ?? null,
            'company_hq'            => $data['company']['hq']             ?? null,
            'company_accuracy'      => (int) ($data['company']['accuracy'] ?? 0),
            'tech_stack'            => is_array($data['tech_stack'] ?? null)
                                        ? wp_json_encode($data['tech_stack'])
                                        : ($data['tech_stack'] ?? null),
            'hr_systems'            => $data['hr_systems'] ?? null,
            'funding_found'         => (int) ($data['funding']['found'] ?? 0),
            'funding_summary'       => $data['funding']['summary']       ?? null,
            'funding_latest_round'  => $data['funding']['latest_round']  ?? null,
            'funding_amount'        => $data['funding']['amount']        ?? null,
            'funding_date'          => $data['funding']['date']          ?? null,
            'funding_investors'     => wp_json_encode($data['funding']['investors'] ?? array()),
            'funding_accuracy'      => (int) ($data['funding']['accuracy'] ?? 0),
            'news_items'            => wp_json_encode($data['news'] ?? array()),
            'pain_points'           => wp_json_encode($data['pain_points'] ?? array()),
            'conversation_starters' => wp_json_encode($data['conversation_starters'] ?? array()),
            'research_note'         => $data['research_note'] ?? null,
            'api_raw_response'      => $raw_response,
            'enriched_at'           => current_time('mysql'),
        );

        $existing = $wpdb->get_var($wpdb->prepare(
            "SELECT id FROM " . self::intel_table() . " WHERE lead_id = %d",
            (int) $lead_id
        ));

        // Suppress errors going to stdout/response; we want them logged instead
        $prev_show = $wpdb->show_errors;
        $wpdb->show_errors = false;
        $wpdb->suppress_errors(true);

        if ($existing) {
            $result = $wpdb->update(self::intel_table(), $row, array('lead_id' => (int) $lead_id));
        } else {
            $result = $wpdb->insert(self::intel_table(), $row);
        }

        // Restore and log any DB error
        $wpdb->show_errors = $prev_show;
        $wpdb->suppress_errors(false);

        if ($result === false) {
            error_log('PCL_DB::save_intel FAILED for lead ' . $lead_id . ' — ' . $wpdb->last_error);
            error_log('PCL_DB::save_intel last query: ' . substr($wpdb->last_query, 0, 500));
        } else {
            error_log('PCL_DB::save_intel OK for lead ' . $lead_id . ' (' . ($existing ? 'updated' : 'inserted') . ')');
        }

        return $result !== false;
    }

    /**
     * List leads for admin dashboard with filters + pagination.
     */
    public static function list_leads($args = array()) {
        global $wpdb;

        $status = $args['status'] ?? '';
        $search = $args['search'] ?? '';
        $limit  = max(1, (int) ($args['limit']  ?? 25));
        $offset = max(0, (int) ($args['offset'] ?? 0));

        $where = '1=1';
        $params = array();

        if ($status) {
            $where .= ' AND l.enrichment_status = %s';
            $params[] = $status;
        }

        if ($search) {
            $like = '%' . $wpdb->esc_like($search) . '%';
            $where .= ' AND (l.full_name LIKE %s OR l.company LIKE %s OR l.email LIKE %s OR l.reference_id LIKE %s)';
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        $params[] = $limit;
        $params[] = $offset;

        $sql = $wpdb->prepare(
            "SELECT l.*,
                    i.overall_confidence,
                    i.company_industry,
                    i.company_size,
                    i.company_employee_count,
                    i.funding_found,
                    i.funding_latest_round
             FROM " . self::leads_table() . " l
             LEFT JOIN " . self::intel_table() . " i ON i.lead_id = l.id
             WHERE $where
             ORDER BY l.submitted_at DESC
             LIMIT %d OFFSET %d",
            ...$params
        );

        return $wpdb->get_results($sql) ?: array();
    }

    /**
     * Count leads, optionally filtered by status.
     */
    public static function count_leads($status = '') {
        global $wpdb;
        if ($status) {
            return (int) $wpdb->get_var($wpdb->prepare(
                "SELECT COUNT(*) FROM " . self::leads_table() . " WHERE enrichment_status = %s",
                $status
            ));
        }
        return (int) $wpdb->get_var("SELECT COUNT(*) FROM " . self::leads_table());
    }

    /**
     * Get all leads for CSV export (no pagination).
     */
    public static function get_all_for_export() {
        global $wpdb;
        return $wpdb->get_results(
            "SELECT l.*,
                    i.overall_confidence,
                    i.company_industry,
                    i.company_size,
                    i.funding_found,
                    i.funding_latest_round,
                    i.funding_amount
             FROM " . self::leads_table() . " l
             LEFT JOIN " . self::intel_table() . " i ON i.lead_id = l.id
             ORDER BY l.submitted_at DESC"
        ) ?: array();
    }
}
