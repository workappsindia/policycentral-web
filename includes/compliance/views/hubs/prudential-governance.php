<?php
/**
 * Hub content: Prudential, Governance & Reporting  (/compliance/prudential-governance)
 * Included by theme-hub.php between get_header() and get_footer().
 *
 * Built on the VERIFIED 28 Nov 2025 consolidated regime (see compliance-build/
 * research/2025-prudential-governance-verified.md): the NBFC Governance, Capital
 * Adequacy, Concentration Risk, IRACP, Securitisation and Financial Statements
 * Directions, 2025, plus the Supervisory Returns Directions, 2026 (31 Jul 2026),
 * and the commercial-bank equivalents.
 *
 * Accuracy guardrail: only verified paragraph numbers are cited (Governance
 * ¶12, ¶19, ¶26; Capital Adequacy ¶17; Concentration ¶13, ¶33; IRACP ¶24, ¶25,
 * ¶44; Securitisation ¶5; Supervisory Returns ¶22; Interest on Deposits ¶8).
 * Everything else is described thematically. No dashes in copy.
 */
defined('ABSPATH') || exit;

// Enforcement cards for this theme, live view over the rbi_enforcement CPT.
// Facts only: we surface the prudential/governance cited reason from each record.
$pg_records = array();
if (class_exists('PCC_Enforcement')) {
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (in_array('prudential-governance', (array) ($rec['themes'] ?? array()), true)) {
            $pg_records[] = $rec;
        }
    }
}
$pg_total    = count($pg_records);
$pg_records  = array_slice($pg_records, 0, 3);
$tracker_url = home_url('/compliance/enforcement-tracker/');
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>Prudential, Governance <br><span class="g-text">&amp; Reporting</span></h1>
      <p>What RBI's consolidated 2025 Directions require of an NBFC's balance sheet, board and regulatory returns, who they apply to layer by layer, and what RBI has actually penalised, from leverage breaches and late returns to NPA upgrades and cross-directorships, in plain language, linked to the source.</p>
      <div class="hub-hero-btns">
        <a href="#prevention" class="btn btn-primary">How institutions stay audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="#requires" class="btn btn-secondary">Read the requirements</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Consolidated Directions · 28 Nov 2025</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>NBFCs · HFCs · Banks · ARCs</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Last reviewed: Sep 2026</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Prudential, Governance & Reporting'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Instruments</span><span class="snap-v">NBFC Directions, 2025<small>Governance · Capital · Concentration · IRACP · Disclosures</small></span></div>
          <div class="snap-row"><span class="snap-k">Issued / in force</span><span class="snap-v">28 Nov 2025<small>Supervisory Returns: 31 Jul 2026</small></span></div>
          <div class="snap-row"><span class="snap-k">Layers</span><span class="snap-v">Base · Middle · Upper<small>Top Layer kept empty</small></span></div>
          <div class="snap-row"><span class="snap-k">Base Layer leverage</span><span class="snap-v">Not more than 7<small>outside liabilities / owned fund</small></span></div>
          <div class="snap-row"><span class="snap-k">NPA threshold</span><span class="snap-v">90 days overdue<small>upgrade only on full arrears</small></span></div>
          <div class="snap-row"><span class="snap-k">Actions in tracker</span><span class="snap-v"><?php echo (int) $pg_total; ?><small>banks, NBFCs &amp; ARCs</small></span></div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<!-- WHAT IT REQUIRES + APPLICABILITY -->
<section id="requires" class="section">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">What the rules require</span>
    <h2>Prudential, governance &amp; reporting, in plain terms</h2>
    <p>Keep the balance sheet within the limits set for your layer, keep the board and its key people within the governance rules, classify and disclose honestly, and file every return on time and correctly. Most penalties here are one of those four loops quietly failing.</p>
  </div>
  <div class="split2">
    <div class="panel reveal">
      <div class="panel-eyebrow"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>What it is</div>
      <h3>One framework, several directions, scaled by layer</h3>
      <p>Since <b>28 Nov 2025</b> the NBFC rulebook is a set of entity-class Directions that all read their applicability from the <b>Scale Based Regulation framework</b>: four layers (Base, Middle, Upper and a Top Layer that RBI keeps empty unless systemic risk demands otherwise). The <b>Governance</b> Directions set who may sit where and which policies the board must own; <b>Capital Adequacy</b> and <b>Concentration Risk</b> cap leverage and exposure; <b>IRACP</b> fixes when a loan is non-performing and when it may be upgraded; <b>Financial Statements</b> fix what the notes to accounts must disclose; and the <b>Supervisory Returns</b> Directions of 31 Jul 2026 fix what is filed with RBI and by when. Commercial banks carry parallel 2025 Directions, with their asset-classification rules being replaced from <b>1 Apr 2027</b>.</p>
    </div>
    <div class="panel reveal rd1">
      <div class="panel-eyebrow"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>Does this apply to you?</div>
      <h3>Applicability, by layer and entity class</h3>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFC Base Layer</b>: the leverage cap, the board-approved concentration-risk policy, the core governance chapter and the full returns calendar. P2P platforms, Account Aggregators and Type I NBFCs always sit here.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFC Middle Layer</b>: everything above plus CRAR, single-party and group exposure limits, the fit-and-proper and Chief Compliance Officer policies, and the bar on key people holding office in other Middle or Upper Layer NBFCs. Deposit-takers, CICs, IFCs and <b>HFCs</b> are always Middle Layer or above.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFC Upper Layer</b>: NBFCs RBI names each year; the Large Exposure Framework replaces the Middle Layer exposure limits.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial banks, SFBs, RRBs, co-operative banks and AIFIs</b> each have their own 2025 Governance, Concentration Risk, Securitisation, Interest Rate on Deposits and IRACP Directions, and their own 2026 Supervisory Returns and Fraud Risk Management Directions.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Asset Reconstruction Companies</b> under the ARC Directions, 2025, including the board-approved policy on management fees.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>HFCs, NBFC-MFIs, mortgage guarantee companies and CICs follow the NBFC IRACP Directions <b>unless their own 2025 Directions say otherwise</b>. Check the entity-specific instrument first.</span>
      </div>
    </div>
  </div>

  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Core obligations</span>
    <div class="obl-grid">
      <div class="obl reveal"><div class="obl-num">Leverage &amp; capital</div><h4>Base Layer leverage of 7, CRAR of 15 per cent above it</h4><p>A Base Layer NBFC's leverage ratio (<b>total outside liabilities divided by owned fund</b>) may not exceed <b>seven at any point of time</b>. Middle Layer and above hold a <b>minimum CRAR of 15 per cent</b>, with Tier 2 capped at 100 per cent of Tier 1. A leverage breach drew a penalty this year.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Exposure limits</div><h4>25 per cent single party, 40 per cent group</h4><p>A Middle Layer NBFC's credit and investment exposure may not exceed <b>25 per cent of Tier 1 capital to a single party</b> or <b>40 per cent to a single group</b> (with a small infrastructure add-on). Upper Layer NBFCs follow the Large Exposure Framework at <b>20 per cent of eligible capital</b>. Two NBFCs were penalised for breaching these in July 2026.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Governance</div><h4>No key person in another Middle or Upper Layer NBFC</h4><p>Except for a subsidiary, <b>Key Managerial Personnel may not hold any office, including a directorship, in any other NBFC-ML or NBFC-UL</b>. Directors must pass a board-approved fit-and-proper test at appointment and on a continuing basis, and NBFCs above ₹5,000 crore must appoint a Chief Risk Officer.</p></div>
      <div class="obl reveal"><div class="obl-num">Asset classification</div><h4>90 days to NPA, full arrears to come back</h4><p>An account is non-performing once interest or an instalment is <b>overdue for more than 90 days</b>. An NPA may be upgraded to standard <b>only when the entire arrears of interest and principal are paid</b>, and where a borrower has several facilities, <b>across all of them</b>. Restructured accounts follow the Resolution of Stressed Assets Directions in addition.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Disclosures</div><h4>Complaints and frauds in the notes to accounts</h4><p>The notes to accounts must carry a <b>summary of customer and Ombudsman complaints</b> (pending, received, disposed, rejected) and the <b>amount of fraud reported for the year</b>. Two NBFCs were penalised in 2026 for disclosing these incorrectly or incompletely.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Returns</div><h4>Monthly in 15 days, quarterly and yearly in 21</h4><p>Under the Supervisory Returns Directions, 2026, returns are due <b>within 15 days</b> of a month-end and <b>within 21 days</b> of a quarter-end or year-end; audited returns <b>within five working days</b> of the auditor's signature; a fraud monitoring return <b>within 14 days</b> of classification. Data must be accurate and complete, and RBI may fine for a breach.</p></div>
    </div>
    <div class="note-row" style="margin-top:16px">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span>Two further bars keep recurring in penalties: <b>no synthetic securitisation</b> (Securitisation Directions, paragraph 5, for NBFCs and banks alike) and, for banks, <b>no interest on current-account balances</b> (Interest Rate on Deposits Directions, paragraph 8) and the statutory bar on <b>loans to directors</b> under section 20 of the Banking Regulation Act.</span>
    </div>
  </div>
</div>
</section>

<!-- ENFORCEMENT PATTERN -->
<section id="pattern" class="section">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">What RBI has penalised</span>
    <h2>The pattern across FY25-26 and FY26-27</h2>
  </div>
  <p class="pat-lead"><?php echo (int) $pg_total; ?> of the actions in our tracker cite a prudential, governance or reporting failure, and they cluster tightly. NPAs upgraded before the arrears were cleared or not recognised on restructuring, a managing director or KMP sitting on another NBFC's board, a group exposure over the limit, returns and a balance sheet filed late, complaints and frauds misstated in the notes to accounts, a synthetic securitisation structure, interest paid on current accounts. Each is a known rule that a process stopped enforcing. The actions below are drawn from RBI press releases.</p>
  <p class="pat-note">Each entry states only the reason cited in the RBI press release. Where a penalty covered more than one issue, the amount shown is the total and is not attributable to any single reason.</p>

  <div class="enf-grid">
    <?php foreach ($pg_records as $i => $rec) :
        $rd      = $i === 1 ? 'rd1' : ($i === 2 ? 'rd2' : '');
        $is_nbfc = ($rec['re_group'] ?? '') === 'NBFC';
        $type    = str_replace('-', ' · ', $rec['re_type'] ?? ($rec['re_group'] ?? ''));
        $date    = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
        $multi   = !empty($rec['multi_reason']);
        // The prudential/governance cited reason (fall back to the first cited reason).
        $reason = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'prudential-governance') { $reason = $c['text']; break; }
        }
        if ($reason === '' && !empty($rec['cited_reasons'][0]['text'])) {
            $reason = $rec['cited_reasons'][0]['text'];
        }
    ?>
      <div class="enf reveal <?php echo esc_attr($rd); ?>">
        <div class="enf-top">
          <div class="enf-row1"><span class="enf-type<?php echo $is_nbfc ? ' nbfc' : ''; ?>"><?php echo esc_html($type); ?></span><span class="enf-date"><?php echo esc_html($date); ?></span></div>
          <div class="enf-name"><?php echo esc_html($rec['entity_name'] ?? ''); ?></div>
          <div class="enf-amt"><span class="v"><?php echo esc_html($rec['penalty_amount_display'] ?? ''); ?></span><span class="l"><?php echo $multi ? 'total penalty' : 'penalty'; ?></span></div>
        </div>
        <div class="enf-body">
          <div class="enf-label">Cited reason (prudential / governance)</div>
          <div class="enf-reason"><?php echo esc_html($reason); ?></div>
          <?php if ($multi) : ?>
          <div class="enf-foot">
            <span class="enf-multi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Multiple reasons</span>
          </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php if ($pg_total > count($pg_records)) : ?>
  <p class="pat-note" style="margin-top:18px">Showing <?php echo count($pg_records); ?> of <?php echo (int) $pg_total; ?> prudential, governance and reporting actions, <a href="<?php echo esc_url($tracker_url . '?theme=prudential-governance'); ?>">see all of them in the enforcement tracker</a>.</p>
  <?php endif; ?>
</div>
</section>

<!-- PREVENTION / SCOPE SPLIT -->
<section id="prevention" class="section" style="background:var(--gray-50)">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Where the failures actually happen</span>
    <h2>Understanding the rule is step one.<br>Operationalising it is where penalties occur.</h2>
    <p>A leverage cap, an exposure limit or a returns calendar only holds if the people who approve loans, appoint directors and file returns know the current rule and can prove they do. Here's an honest split of what a policy distribution-and-attestation layer like PolicyCentral.ai does and does not address.</p>
  </div>
  <div class="scope-grid">
    <div class="scope in reveal">
      <div class="scope-head"><span class="scope-pill">PolicyCentral.ai helps here</span></div>
      <h3>Distribute · attest · prove</h3>
      <p>The "did everyone get it, read it, and can you show an auditor" layer around your prudential and governance framework.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Push the board-approved policies the Directions require, concentration-risk, fit-and-proper, compliance-function, NPA classification and upgrade SOPs, the returns calendar, to <b>every credit, secretarial and finance team member</b>, with read receipts and digital acknowledgement.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>When the rulebook changes, as it did wholesale on <b>28 Nov 2025</b> and again with the <b>31 Jul 2026</b> returns and fraud directions, version the policy, re-push to affected staff, and chase the unread automatically.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Put the governance rules that trip boards, the KMP cross-office bar, the director fit-and-proper cycle, in front of directors and the company secretary as <b>trackable, acknowledged content</b> before every appointment.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Maintain a <b>tamper-evident audit trail</b> of who received, read and acknowledged each version, the evidence a supervisory review asks for first.</span></li>
      </ul>
    </div>
    <div class="scope out reveal rd1">
      <div class="scope-head"><span class="scope-pill">A different system handles this</span></div>
      <h3>What PolicyCentral.ai is not</h3>
      <p>We're explicit about scope, these are jobs for your loan, treasury and reporting stack, not a policy platform.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>loan management system</b> that ages overdues, flags NPAs and blocks premature upgrades.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Capital, leverage and exposure computation</b> and the limit-monitoring engines around them.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Regulatory reporting tools</b> that assemble and file returns with RBI, and the financial-statement close.</span></li>
      </ul>
      <p style="margin:18px 0 0;font-size:12.5px;color:var(--gray-400)">Being clear about this is the point, sophisticated compliance teams trust a vendor that names its boundaries.</p>
    </div>
  </div>

  <!-- GO DEEPER -->
  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Go deeper</span>
    <div class="deep-grid">
      <a href="<?php echo esc_url($tracker_url . '?theme=prudential-governance'); ?>" class="deep reveal"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div><div class="deep-txt"><h4>Enforcement tracker</h4><span>All prudential, governance &amp; reporting actions</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=12960" target="_blank" rel="noopener" class="deep reveal rd1"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>NBFC, Governance Directions, 2025</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=12948" target="_blank" rel="noopener" class="deep reveal"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>NBFC, Income Recognition, Asset Classification and Provisioning Directions, 2025</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13587" target="_blank" rel="noopener" class="deep reveal rd1"><div class="ib ib-amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>NBFC, Supervisory Returns Directions, 2026</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
    </div>
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
      <div class="cv-kicker">For compliance, risk &amp; finance teams</div>
      <h3>Get the board-policy &amp; returns-calendar checklist</h3>
      <p>A practical checklist of the board-approved policies the 2025 NBFC Directions expect for your layer, the governance rules to brief directors on before every appointment, the returns calendar under the 2026 Supervisory Returns Directions, and the audit-trail evidence to keep ready for a supervisory review.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn">Request the checklist <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For CCOs, CROs &amp; company secretaries</div>
      <h3>See policy attestation tracked across every team and every director</h3>
      <p>PolicyCentral.ai shows you, live and team-by-team, exactly who has read and acknowledged each prudential policy, governance rule and returns procedure, and every update, with a tamper-evident trail you can export for an RBI review. Walk through it on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>
