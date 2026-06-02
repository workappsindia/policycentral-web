<?php
/**
 * Compliance Intelligence, Bootstrap Loader
 *
 * Loads the Compliance Intelligence module: decoded RBI rules + an
 * enforcement-action tracker, served under /compliance. Included from
 * functions.php: require_once '.../compliance/loader.php';
 *
 * BUILD PHASES (Claude Code owns the mechanics):
 *   Phase 1 (this), foundation: CPTs, taxonomies, instrument_edges table.
 *   Phase 2       , page templates + /compliance/{theme} routing (PCC_Rewrite).
 *   Phase 3       , tracker/hubs/indexes as true views over the CPT data.
 *   Phase 4       , RBI ingestion pipeline (server-side Claude, WP-cron).
 *
 * SECURITY NOTE: the ingestion pipeline's Claude API key is server-side only
 * (wp-config / env), called from PHP, never exposed to front-end JS.
 */

defined('ABSPATH') || exit;

define('PCC_DIR', __DIR__);
define('PCC_URL', get_template_directory_uri() . '/includes/compliance');

require_once PCC_DIR . '/class-pcc-db.php';
require_once PCC_DIR . '/class-pcc-cpt.php';
require_once PCC_DIR . '/class-pcc-enforcement.php';
require_once PCC_DIR . '/class-pcc-rewrite.php';

// Register custom post types + taxonomies (hooks 'init').
PCC_CPT::register();

// Register /compliance URL routing + view templates.
PCC_Rewrite::register();

/**
 * Is the current request a Compliance Intelligence page?
 * True for the virtual views (section/hub/tracker/rule index) and the
 * rbi_rule / rbi_enforcement CPT singles. Used to scope asset enqueues.
 */
function pcc_is_compliance_view() {
    return (bool) get_query_var('pcc_view')
        || is_singular(array('rbi_rule', 'rbi_enforcement'));
}

/**
 * Site-style breadcrumb (matches the use-case pages: starts with Home, sits
 * below the page header). $trail = array of ['label'=>..., 'url'=>...]; the last
 * item (or any without a url) renders as the current page.
 */
function pcc_breadcrumb($trail) {
    $chevron = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>';
    echo '<div class="breadcrumb"><a href="' . esc_url(home_url('/')) . '">Home</a>';
    $last = count($trail) - 1;
    foreach ($trail as $i => $item) {
        echo $chevron;
        if ($i === $last || empty($item['url'])) {
            echo '<span>' . esc_html($item['label']) . '</span>';
        } else {
            echo '<a href="' . esc_url($item['url']) . '">' . esc_html($item['label']) . '</a>';
        }
    }
    echo '</div>';
}

/**
 * Standard compliance disclaimer band, rendered at the bottom of every
 * compliance page, just above the footer.
 */
function pcc_disclaimer() {
    ?>
    <div class="container" style="padding-top:48px;padding-bottom:64px">
      <div class="disc" style="margin-top:0">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
        <span>PolicyCentral.ai builds policy management software, not legal advice. These are plain-language summaries to help your teams understand what applies to them. Always verify against the original instrument on <a href="https://www.rbi.org.in" target="_blank" rel="noopener">rbi.org.in</a> and consult your compliance/legal team before acting.</span>
      </div>
    </div>
    <?php
}

/**
 * Render the "what RBI penalised" pen-cards for a rule decode, a live view over
 * the rbi_enforcement CPT (records whose related_rules include this rule slug).
 * Returns trusted HTML for the decode templates to echo.
 */
function pcc_render_penalised_for_rule($rule_slug) {
    if (!class_exists('PCC_Enforcement')) {
        return '';
    }
    $out = '';
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (!in_array($rule_slug, (array) ($rec['related_rules'] ?? array()), true)) {
            continue;
        }
        $multi = !empty($rec['multi_reason']);
        $entry = !empty($rec['permalink'])
            ? $rec['permalink']
            : home_url('/compliance/enforcement/' . ($rec['id'] ?? '') . '/');

        // Prefer the Internal-Ombudsman-themed cited reason; else the first.
        $reason = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'internal-ombudsman') { $reason = $c['text']; break; }
        }
        if ($reason === '' && !empty($rec['cited_reasons'][0]['text'])) {
            $reason = $rec['cited_reasons'][0]['text'];
        }

        $tag = $multi ? ' <span style="font-weight:500;color:var(--gray-400)">· total penalty, multiple reasons</span>' : '';
        $out .= '<a href="' . esc_url($entry) . '" class="pen">'
              . '<span class="pen-amt">' . esc_html($rec['penalty_amount_display'] ?? '') . '</span>'
              . '<span class="pen-mid"><span class="n">' . esc_html($rec['entity_name'] ?? '') . $tag . '</span>'
              . '<span class="r">' . esc_html($reason) . '</span></span>'
              . '<span class="pen-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>'
              . '</a>';
    }
    return $out;
}
