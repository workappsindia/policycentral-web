<?php
/**
 * Hub content: Fair Practices Code  (/compliance/fair-practices)
 * Included by theme-hub.php between get_header() and get_footer().
 *
 * Built on the VERIFIED 28 Nov 2025 consolidated regime (see compliance-build/
 * research/2025-fair-practices-verified.md): the Fair Practices Code now lives
 * as a chapter inside the NBFC Responsible Business Conduct Directions, 2025
 * (paragraphs 8 to 30, microfinance 76 to 83), the HFC Directions, 2025
 * (Chapter X, paragraphs 129 to 150) and the Commercial Banks Responsible
 * Business Conduct Directions, 2025 (paragraphs 327 to 348), plus the
 * board-approved microfinance pricing policy in the NBFC Credit Facilities
 * Directions, 2025 (paragraph 60).
 *
 * Accuracy guardrail: only verified paragraph numbers are cited, written as
 * "paragraph N". No dashes in copy. Brand is always PolicyCentral.ai.
 */
defined('ABSPATH') || exit;

// Enforcement cards for this theme, live view over the rbi_enforcement CPT.
// Facts only: we surface the fair-practices cited reason from each record.
$fp_records = array();
if (class_exists('PCC_Enforcement')) {
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (in_array('fair-practices', (array) ($rec['themes'] ?? array()), true)) {
            $fp_records[] = $rec;
        }
    }
}
$fp_total    = count($fp_records);
$fp_records  = array_slice($fp_records, 0, 3);
$tracker_url = home_url('/compliance/enforcement-tracker/');
$rbc_url     = home_url('/compliance/rules/rbc-advertising-misselling-2026/');
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>Fair Practices <br><span class="g-text">Code</span></h1>
      <p>What the Fair Practices Code requires of every lender's application form, sanction letter, loan agreement and recovery practice, where it now sits inside RBI's 2025 Responsible Business Conduct Directions, and what RBI has actually penalised NBFCs, housing finance companies and banks for, in plain language, linked to the source.</p>
      <div class="hub-hero-btns">
        <a href="#prevention" class="btn btn-primary">How institutions stay audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="#requires" class="btn btn-secondary">Read the requirements</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Responsible Business Conduct Directions · 28 Nov 2025</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>NBFCs · HFCs · MFIs · Banks</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Last reviewed: Sep 2026</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Fair Practices Code'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Instrument</span><span class="snap-v">RBC Directions, 2025<small>one per entity class; HFC Directions Chapter X</small></span></div>
          <div class="snap-row"><span class="snap-k">Issued / in force</span><span class="snap-v">28 Nov 2025</span></div>
          <div class="snap-row"><span class="snap-k">Replaces</span><span class="snap-v">Standalone FPC circulars<small>consolidated "as is"</small></span></div>
          <div class="snap-row"><span class="snap-k">Most-penalised clause</span><span class="snap-v">Gradation of risk<small>in application form and sanction letter</small></span></div>
          <div class="snap-row"><span class="snap-k">Board duty</span><span class="snap-v">Periodical review<small>of FPC compliance, reported to the Board</small></span></div>
          <div class="snap-row"><span class="snap-k">Actions in tracker</span><span class="snap-v"><?php echo (int) $fp_total; ?><small>NBFCs, HFCs &amp; banks</small></span></div>
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
    <span class="eyebrow">What the rule requires</span>
    <h2>The Fair Practices Code, in plain terms</h2>
    <p>Tell the borrower everything that affects their interest before they sign, in a language they understand; charge only what you disclosed, change it only prospectively and with notice; recover without harassment; and have the Board check, on a cycle, that all of this is actually happening.</p>
  </div>
  <div class="split2">
    <div class="panel reveal">
      <div class="panel-eyebrow"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>What it is</div>
      <h3>A code you draft, on a floor RBI sets, living in your documents</h3>
      <p>Since <b>28 Nov 2025</b> the Fair Practices Code is no longer a standalone circular. For NBFCs it is section A of the <b>Responsible Business Conduct Directions, 2025</b> (paragraphs 8 to 28), followed by the <b>Key Facts Statement</b> (paragraph 29) and <b>penal charges</b> rules (paragraph 30). Housing finance companies get the same obligations through <b>Chapter X of the HFC Directions, 2025</b>, which cross-refers to those paragraphs, and banks through the <b>Commercial Banks RBC Directions, 2025</b> (paragraphs 327 to 348). Each lender drafts its own Code, may enhance it, must not dilute it, and must publish it on its website. Almost every penalty under it is about a specific sentence missing from an application form, a sanction letter or a loan agreement.</p>
    </div>
    <div class="panel reveal rd1">
      <div class="panel-eyebrow"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>Does this apply to you?</div>
      <h3>Applicability, by entity class</h3>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFCs across all layers</b> with a customer interface: deposit-taking, investment and credit companies, factors, MFIs, infrastructure finance companies and IDFs, under the NBFC RBC Directions.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Housing finance companies</b>, both directly under Chapter X of the HFC Directions and through its cross-references to the NBFC RBC paragraphs. Three of this year's penalties were HFCs.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Any regulated entity making microfinance loans</b>: a separate, Board-approved FPC for microfinance loans, a loan card, no prepayment charges, and a Board-approved pricing policy.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial banks</b> (and SFBs, RRBs and co-operative banks under their own 2025 RBC Directions) for all lending, with the Code printed into loan application forms and circulated to every branch.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Peer-to-peer platforms</b> only for the agent and recovery conduct paragraphs; the rest of their conduct rules sit in the P2P Directions.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>The <b>15 Jun 2026 RBC Second Amendment</b> adds advertising, mis-selling and dark-pattern rules to the same Directions from <b>1 Jan 2027</b>. It is decoded separately under Customer Protection; this hub covers the lending-conduct core.</span>
      </div>
    </div>
  </div>

  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Core obligations</span>
    <div class="obl-grid">
      <div class="obl reveal"><div class="obl-num">Rate disclosure</div><h4>Gradation of risk, in the form and the sanction letter</h4><p>The Board adopts an interest rate model, and <b>the rate of interest, the approach for gradation of risk and the rationale for charging different rates to different categories of borrowers</b> must be disclosed in the <b>application form</b> and stated explicitly in the <b>sanction letter</b>, and published on the website. The single most-penalised sentence in the Code: four lenders missed it this year.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Written terms</div><h4>Sanction letter, annualised rate, copy of the agreement</h4><p>Convey the sanctioned amount and terms <b>in writing, in a language the borrower understands</b>, with the <b>annualised rate of interest</b>, keep the borrower's acceptance on record, put late-payment penalties <b>in bold</b>, and hand over a copy of the loan agreement and every enclosure. Not furnishing the copy is itself an unfair practice.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Changes</div><h4>Notice first, prospective only, condition in the agreement</h4><p>Any change to interest, charges, prepayment or foreclosure terms needs <b>notice to the borrower</b> and takes effect <b>only prospectively</b>, and the loan agreement must carry a condition permitting it. An NBFC was penalised for revising foreclosure charges without that condition, and a bank for collecting interest above the contracted rate.</p></div>
      <div class="obl reveal"><div class="obl-num">Instalments &amp; charges</div><h4>Show the split, cap the penalties</h4><p>HFC instalments must <b>clearly indicate the bifurcation between interest and principal</b>. Penal charges are charges, not penal interest: <b>not capitalised</b>, disclosed upfront in the agreement and the Key Facts Statement, and never higher for individual non-business borrowers than for others.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Microfinance</div><h4>A separate FPC, a loan card, a pricing policy</h4><p>Microfinance loans need a <b>Board-approved FPC of their own</b>, displayed in every office; a standard loan agreement and loan card; <b>no prepayment charge</b>; minimum, maximum and average rates on display; and, under the Credit Facilities Directions, a <b>Board-approved policy on pricing</b>. An NBFC was penalised in September 2026 for not having that policy.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Board review</div><h4>Periodical review of FPC compliance</h4><p>The Board must provide for <b>periodical review of compliance with the Fair Practices Code</b> and of the grievance redress mechanism at various levels of management, with a <b>consolidated report to the Board</b> at regular intervals. An NBFC was penalised in FY25-26 for having no such review system at all.</p></div>
    </div>
    <div class="note-row" style="margin-top:16px">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span>Paragraph references are to the NBFC Responsible Business Conduct Directions, 2025 (paragraphs 8, 11 to 15, 21 to 24, 29, 30 and 76 to 83), the HFC Directions, 2025 (paragraphs 140, 146 and 147), the Commercial Banks RBC Directions, 2025 (paragraphs 337, 345 to 348) and the NBFC Credit Facilities Directions, 2025 (paragraph 60).</span>
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
  <p class="pat-lead"><?php echo (int) $fp_total; ?> of the actions in our tracker cite a Fair Practices Code failure, and most of them are the same failure. The gradation-of-risk disclosure missing from the application form and the sanction letter, instalments that don't show the interest and principal split, foreclosure charges revised without the loan-agreement condition, interest collected above the contracted rate, a missing pricing policy, no Board review of FPC compliance. Every one lives in a document template or a review calendar that someone owns. The actions below are drawn from RBI press releases.</p>
  <p class="pat-note">Each entry states only the reason cited in the RBI press release. Where a penalty covered more than one issue, the amount shown is the total and is not attributable to any single reason.</p>

  <div class="enf-grid">
    <?php foreach ($fp_records as $i => $rec) :
        $rd      = $i === 1 ? 'rd1' : ($i === 2 ? 'rd2' : '');
        $is_nbfc = ($rec['re_group'] ?? '') === 'NBFC';
        $type    = str_replace('-', ' · ', $rec['re_type'] ?? ($rec['re_group'] ?? ''));
        $date    = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
        $multi   = !empty($rec['multi_reason']);
        // The fair-practices cited reason (fall back to the first cited reason).
        $reason = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'fair-practices') { $reason = $c['text']; break; }
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
          <div class="enf-label">Cited reason (Fair Practices Code)</div>
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
  <?php if ($fp_total > count($fp_records)) : ?>
  <p class="pat-note" style="margin-top:18px">Showing <?php echo count($fp_records); ?> of <?php echo (int) $fp_total; ?> Fair Practices Code actions, <a href="<?php echo esc_url($tracker_url . '?theme=fair-practices'); ?>">see all of them in the enforcement tracker</a>.</p>
  <?php endif; ?>
</div>
</section>

<!-- PREVENTION / SCOPE SPLIT -->
<section id="prevention" class="section" style="background:var(--gray-50)">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Where the failures actually happen</span>
    <h2>Understanding the rule is step one.<br>Operationalising it is where penalties occur.</h2>
    <p>The Fair Practices Code is the most document-shaped rule RBI enforces: the obligations are sentences that must appear in forms, letters and agreements used in every branch and by every agent. Here's an honest split of what a policy distribution-and-attestation layer like PolicyCentral.ai does and does not address.</p>
  </div>
  <div class="scope-grid">
    <div class="scope in reveal">
      <div class="scope-head"><span class="scope-pill">PolicyCentral.ai helps here</span></div>
      <h3>Distribute · attest · prove</h3>
      <p>The "did everyone get it, read it, and can you show an auditor" layer around your Fair Practices Code.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Push the Board-approved Code, the interest rate model and gradation-of-risk wording, the current application form and sanction letter templates, and the microfinance FPC and pricing policy to <b>every branch, sales team and recovery agent</b>, with read receipts and digital acknowledgement.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>When a template or a charge changes, version it, re-push to affected staff, retire the old version, and chase the unread automatically, so a superseded sanction letter is never the one in use.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Turn the <b>periodical review of FPC compliance</b> into a scheduled, evidenced cycle: attestation by level of management, consolidated for the Board report the Directions require.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Maintain a <b>tamper-evident audit trail</b> of who received, read and acknowledged each version, the evidence a supervisory review asks for first.</span></li>
      </ul>
    </div>
    <div class="scope out reveal rd1">
      <div class="scope-head"><span class="scope-pill">A different system handles this</span></div>
      <h3>What PolicyCentral.ai is not</h3>
      <p>We're explicit about scope, these are jobs for your loan origination and servicing stack, not a policy platform.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>loan origination system</b> that generates application forms, Key Facts Statements and sanction letters for each borrower.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Interest and charge computation</b>, instalment schedules and the interest-principal split on statements.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Collections and recovery platforms</b> and the grievance-ticketing system behind the redress mechanism.</span></li>
      </ul>
      <p style="margin:18px 0 0;font-size:12.5px;color:var(--gray-400)">Being clear about this is the point, sophisticated compliance teams trust a vendor that names its boundaries.</p>
    </div>
  </div>

  <!-- GO DEEPER -->
  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Go deeper</span>
    <div class="deep-grid">
      <a href="<?php echo esc_url($tracker_url . '?theme=fair-practices'); ?>" class="deep reveal"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div><div class="deep-txt"><h4>Enforcement tracker</h4><span>All Fair Practices Code actions</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url($rbc_url); ?>" class="deep reveal rd1"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Decode: RBC Second Amendment, 2026</h4><span>Advertising, mis-selling &amp; dark patterns from 1 Jan 2027</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=12942" target="_blank" rel="noopener" class="deep reveal"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>NBFC, Responsible Business Conduct Directions, 2025</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=12939" target="_blank" rel="noopener" class="deep reveal rd1"><div class="ib ib-amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>Housing Finance Companies Directions, 2025, Chapter X</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
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
      <div class="cv-kicker">For compliance, product &amp; legal teams</div>
      <h3>Get the Fair Practices Code template checklist</h3>
      <p>A practical checklist of every disclosure the 2025 Directions expect in your application form, sanction letter, loan agreement and Key Facts Statement, the microfinance additions, the Board review cycle, and the audit-trail evidence to keep ready for a supervisory review.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn">Request the checklist <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For CCOs, heads of credit &amp; collections</div>
      <h3>See FPC attestation tracked across every branch and agent</h3>
      <p>PolicyCentral.ai shows you, live and branch-by-branch, exactly who has read and acknowledged the current Code, the current templates and every change, with a tamper-evident trail you can export for an RBI review. Walk through it on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>
