<?php
/**
 * View: Compliance Intelligence, enforcement tracker  (/compliance/enforcement-tracker)
 * Routed here by PCC_Rewrite (pcc_view=tracker).
 *
 * Phase 2: server-renders every record from the seed dataset (crawlable HTML),
 * with data-* attributes; compliance-tracker.js does client-side filtering and
 * reads URL params (?theme= ?re_group= ?scope= ?fy= ?reason=). Phase 3 swaps the
 * JSON read for a query over the rbi_enforcement CPT.
 */
defined('ABSPATH') || exit;

// Records come from the rbi_enforcement CPT (PCC_Enforcement falls back to the
// seed JSON until migration 061 has loaded the posts).
$records = class_exists('PCC_Enforcement') ? PCC_Enforcement::get_all() : array();

// Theme slug → label.
$theme_labels = array(
    'internal-ombudsman'    => 'Internal Ombudsman',
    'kyc-ckycr'             => 'KYC & CKYCR',
    'customer-protection'   => 'Customer Protection',
    'prudential-governance' => 'Prudential & Governance',
    'fair-practices'        => 'Fair Practices (NBFC)',
    'change-of-control'     => 'Change of Control',
    'credit-reporting'      => 'Credit Reporting',
    'outsourcing'           => 'Outsourcing',
);
$scope_labels = array('in-scope' => 'In scope', 'partial' => 'Partial', 'out-of-scope' => 'Out of scope');
$group_class  = array('Bank' => 'bank', 'NBFC' => 'nbfc', 'Payment' => 'payment');

// Build filter option sets + summary from the data.
$opt_group = $opt_scope = $opt_fy = $opt_reason = $opt_theme = array();
$total_lakhs = 0.0; $monetary = 0;
foreach ($records as $r) {
    if (!empty($r['re_group']))    $opt_group[$r['re_group']] = true;
    if (!empty($r['scope_fit']))   $opt_scope[$r['scope_fit']] = true;
    if (!empty($r['fiscal_year'])) $opt_fy[$r['fiscal_year']] = true;
    foreach ((array) ($r['reason_categories'] ?? array()) as $rc) $opt_reason[$rc] = true;
    foreach ((array) ($r['themes'] ?? array()) as $th)            $opt_theme[$th] = true;
    if (isset($r['penalty_amount_lakhs']) && $r['penalty_amount_lakhs'] !== null) {
        $total_lakhs += (float) $r['penalty_amount_lakhs'];
        $monetary++;
    }
}
ksort($opt_group); ksort($opt_scope); ksort($opt_fy); ksort($opt_reason);
$total_cr = $total_lakhs / 100.0;

get_header();
?>
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-l">
    <h1>RBI <span class="g-text">Enforcement Tracker</span></h1>
    <p>RBI penal and enforcement actions against banks and NBFCs, filter by reason, entity type, theme, fiscal year, and how preventable each was with a policy-distribution layer. Each entry states only the reason cited in the RBI press release; where a penalty cites several reasons the amount shown is the total.</p>
    <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Enforcement Tracker'))); ?>
  </div>
</div>
</section>

<section class="section" style="padding-top:48px">
<div class="container">

  <!-- FILTERS -->
  <div class="trk-controls">
    <div class="trk-field"><label for="f-theme">Theme</label>
      <select id="f-theme" data-filter="theme"><option value="">All themes</option>
        <?php foreach (array_keys($opt_theme) as $slug) : ?>
          <option value="<?php echo esc_attr($slug); ?>"><?php echo esc_html($theme_labels[$slug] ?? $slug); ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="trk-field"><label for="f-group">Entity</label>
      <select id="f-group" data-filter="group"><option value="">All entities</option>
        <?php foreach (array_keys($opt_group) as $g) : ?><option value="<?php echo esc_attr($g); ?>"><?php echo esc_html($g); ?></option><?php endforeach; ?>
      </select>
    </div>
    <div class="trk-field"><label for="f-reason">Reason</label>
      <select id="f-reason" data-filter="reason"><option value="">All reasons</option>
        <?php foreach (array_keys($opt_reason) as $rc) : ?><option value="<?php echo esc_attr($rc); ?>"><?php echo esc_html($rc); ?></option><?php endforeach; ?>
      </select>
    </div>
    <div class="trk-field"><label for="f-fy">Fiscal year</label>
      <select id="f-fy" data-filter="fy"><option value="">All years</option>
        <?php foreach (array_keys($opt_fy) as $fy) : ?><option value="<?php echo esc_attr($fy); ?>"><?php echo esc_html($fy); ?></option><?php endforeach; ?>
      </select>
    </div>
    <button type="button" class="btn btn-secondary trk-clear" id="trk-clear">Clear filters</button>
  </div>

  <div class="trk-summary">
    Showing <b id="trk-count"><?php echo count($records); ?></b> of <?php echo count($records); ?> actions
    &middot; ₹<?php echo number_format($total_cr, 2); ?> cr across <?php echo $monetary; ?> monetary penalties
    &middot; FY25-26 (seed set)
  </div>

  <!-- RECORDS -->
  <div class="trk-grid" id="trk-grid">
    <?php foreach ($records as $r) :
        $group     = $r['re_group'] ?? '';
        $gclass    = $group_class[$group] ?? '';
        $scope     = $r['scope_fit'] ?? '';
        $date      = !empty($r['action_date']) ? date('d M Y', strtotime($r['action_date'])) : '';
        $nonmon    = !isset($r['penalty_amount_lakhs']) || $r['penalty_amount_lakhs'] === null;
        $themes    = (array) ($r['themes'] ?? array());
        $reasons   = (array) ($r['reason_categories'] ?? array());
        $cited     = (array) ($r['cited_reasons'] ?? array());
        $d_theme   = implode('|', $themes);
        $d_reason  = implode('|', $reasons);
    ?>
    <article class="trk-card"
      data-theme="<?php echo esc_attr($d_theme); ?>"
      data-group="<?php echo esc_attr($group); ?>"
      data-scope="<?php echo esc_attr($scope); ?>"
      data-fy="<?php echo esc_attr($r['fiscal_year'] ?? ''); ?>"
      data-reason="<?php echo esc_attr($d_reason); ?>">
      <div class="trk-top">
        <div class="trk-row1">
          <div class="trk-badges">
            <span class="trk-tag <?php echo esc_attr($gclass); ?>"><?php echo esc_html($r['re_type'] ?? $group); ?></span>
          </div>
          <span class="trk-date"><?php echo esc_html($date); ?></span>
        </div>
        <div class="trk-name"><?php if (!empty($r['permalink'])) : ?><a href="<?php echo esc_url($r['permalink']); ?>"><?php echo esc_html($r['entity_name'] ?? ''); ?></a><?php else : echo esc_html($r['entity_name'] ?? ''); endif; ?></div>
        <div class="trk-amt">
          <?php if ($nonmon) : ?>
            <span class="v nonmon"><?php echo esc_html($r['penalty_amount_display'] ?? 'Non-monetary'); ?></span>
          <?php else : ?>
            <span class="v"><?php echo esc_html($r['penalty_amount_display'] ?? ''); ?></span>
            <span class="l"><?php echo !empty($r['multi_reason']) ? 'total penalty' : 'penalty'; ?></span>
          <?php endif; ?>
        </div>
      </div>
      <div class="trk-body">
        <div class="trk-reasons">
          <?php foreach ($cited as $c) : ?>
            <div class="trk-reason"><span class="dot"></span><span><?php echo esc_html($c['text'] ?? ''); ?></span></div>
          <?php endforeach; ?>
        </div>
        <div class="trk-foot">
          <?php if (!empty($r['multi_reason'])) : ?><span class="trk-multi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Multiple reasons</span><?php endif; ?>
          <div class="trk-themes">
            <?php foreach ($themes as $th) : ?><span class="trk-theme"><?php echo esc_html($theme_labels[$th] ?? $th); ?></span><?php endforeach; ?>
          </div>
        </div>
      </div>
    </article>
    <?php endforeach; ?>
  </div>

  <div class="trk-empty" id="trk-empty">No actions match these filters. <a href="#" id="trk-reset" style="color:var(--teal);font-weight:700;text-decoration:underline">Clear them</a>.</div>

</div>
</section>

<?php pcc_disclaimer(); ?>
<?php get_footer(); ?>
