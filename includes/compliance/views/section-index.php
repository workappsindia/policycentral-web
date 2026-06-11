<?php
/**
 * View: Compliance Intelligence, section index  (/compliance)
 * Routed here by PCC_Rewrite (pcc_view=section).
 */
defined('ABSPATH') || exit;

get_header();

// Theme grid. A theme is live when its hub partial exists in views/hubs/
// (the same check theme-hub.php routes on and PCC_Sitemap lists on), so new
// hubs flip to "Live" here automatically. Slugs map 1:1 to the 'theme'
// taxonomy + hub URLs.
$pcc_themes = array(
    array('slug' => 'internal-ombudsman', 'label' => 'Internal Ombudsman & Grievance Redress', 'desc' => 'The 2026 entity-class Directions, who they bind, and what RBI has penalised.'),
    array('slug' => 'kyc-ckycr',          'label' => 'KYC & CKYCR Compliance',                 'desc' => 'Periodic updation, risk re-categorisation, and timely CKYCR uploads.'),
    array('slug' => 'customer-protection','label' => 'Customer Protection & Conduct',           'desc' => 'Unauthorised-transaction reversals, charges transparency, BSBD, DEA Fund.'),
    array('slug' => 'prudential-governance','label' => 'Prudential, Governance & Reporting',    'desc' => 'Exposure norms, approvals, disclosures and regulatory returns.'),
    array('slug' => 'fair-practices',     'label' => 'Fair Practices Code (NBFC)',              'desc' => 'Loan transparency, charges, and periodic FPC compliance review.'),
    array('slug' => 'change-of-control',  'label' => 'Prior Approval for Change of Control',     'desc' => 'The NBFC obligation behind a large cluster of FY25-26 penalties.'),
    array('slug' => 'credit-reporting',   'label' => 'Credit Information Reporting',             'desc' => 'Accurate, timely reporting to CICs and CRILC.'),
    array('slug' => 'outsourcing',        'label' => 'Outsourcing of Financial Services',        'desc' => 'What can and cannot be outsourced, and governance of providers.'),
);
foreach ($pcc_themes as &$pcc_t) {
    $pcc_t['live'] = file_exists(PCC_DIR . '/views/hubs/' . $pcc_t['slug'] . '.php');
}
unset($pcc_t);
$pcc_live_count = count(array_filter(array_column($pcc_themes, 'live')));
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>The decoded record of<br><span class="g-text">Indian BFSI compliance</span></h1>
      <p>Plain-language decodes of the RBI rules that matter, wired to an enforcement-action tracker of what the regulator has actually penalised banks and NBFCs for. Built for compliance, risk and audit teams. Linked to the source, honest about scope, not legal advice.</p>
      <div class="hub-hero-btns">
        <a href="<?php echo esc_url(home_url('/compliance/enforcement-tracker/')); ?>" class="btn btn-primary">Open the enforcement tracker <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="<?php echo esc_url(home_url('/compliance/rules/')); ?>" class="btn btn-secondary">Browse the rule library</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="M18 17V9M13 17V5M8 17v-3"/></svg>8 compliance themes mapped</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12a9 9 0 1 1-6.219-8.56"/><polyline points="22 4 12 14.01 9 11.01"/></svg>Tracked against RBI sources</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Last reviewed: Jun 2026</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Compliance themes</span><span class="snap-v">8<small>theme hubs</small></span></div>
          <div class="snap-row"><span class="snap-k">Live now</span><span class="snap-v"><?php echo (int) $pcc_live_count; ?> of <?php echo count($pcc_themes); ?><small>theme hubs</small></span></div>
          <div class="snap-row"><span class="snap-k">Enforcement actions tracked</span><span class="snap-v">16<small>FY25-26 (seed set)</small></span></div>
          <div class="snap-row"><span class="snap-k">Source</span><span class="snap-v">RBI &middot; FACE<small>press releases &amp; instruments</small></span></div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- THEME GRID -->
<section id="roadmap" class="section">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Browse by theme</span>
    <h2>Compliance, organised by what RBI enforces</h2>
    <p>Each theme is a hub: the rules that apply, who they bind, and the enforcement actions behind them. We're building the repository theme by theme, working backwards from what RBI actually penalises.</p>
  </div>
  <div class="rm-grid">
    <?php foreach ($pcc_themes as $i => $t) :
        $rd = 'rd' . (($i % 4) + 1); ?>
      <?php if (!empty($t['live'])) : ?>
        <a class="rm live reveal <?php echo esc_attr($rd); ?>" href="<?php echo esc_url(home_url('/compliance/' . $t['slug'] . '/')); ?>">
          <div class="rm-bar" style="background:linear-gradient(90deg,#179D97,#4338CA)"></div>
          <span class="rm-status on">Live</span>
          <div class="rm-icon" style="background:var(--teal-lt)"><svg viewBox="0 0 24 24" fill="none" stroke="#179D97" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>
          <h4><?php echo esc_html($t['label']); ?></h4>
          <p><?php echo esc_html($t['desc']); ?></p>
          <span class="rm-link">Open the hub <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
        </a>
      <?php else : ?>
        <div class="rm soon reveal <?php echo esc_attr($rd); ?>">
          <div class="rm-bar" style="background:var(--gray-200)"></div>
          <span class="rm-status next">Coming soon</span>
          <div class="rm-icon" style="background:var(--gray-100)"><svg viewBox="0 0 24 24" fill="none" stroke="#9CA3AF" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div>
          <h4><?php echo esc_html($t['label']); ?></h4>
          <p><?php echo esc_html($t['desc']); ?></p>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>
</section>

<!-- CONVERSION BAND -->
<section id="convert" class="section">
<div class="cv-glow cvg1"></div>
<div class="cv-glow cvg2"></div>
<div class="container">
  <div class="cv-inner">
    <div class="cv-card prac reveal">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg></div>
      <div class="cv-kicker">For compliance &amp; risk teams</div>
      <h3>Track what RBI is penalising, by theme and entity</h3>
      <p>The enforcement tracker lets you filter FY25-26 actions by reason, entity type, theme and how preventable they were with a policy-distribution layer. Start with the patterns most relevant to your institution.</p>
      <a href="<?php echo esc_url(home_url('/compliance/enforcement-tracker/')); ?>" class="btn">Explore the tracker <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For CCOs, HR &amp; InfoSec leaders</div>
      <h3>See policy attestation tracked across every branch</h3>
      <p>Most penalties are last-mile execution failures: a rule known at HQ but not distributed, acknowledged, or reviewed on cadence down to the branch. See how PolicyCentral closes that gap, on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>

<?php pcc_disclaimer(); ?>
<?php get_footer(); ?>
