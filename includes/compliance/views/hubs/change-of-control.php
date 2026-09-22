<?php
/**
 * Hub content: Prior Approval for Change of Control  (/compliance/change-of-control)
 * Included by theme-hub.php between get_header() and get_footer().
 *
 * Built on the VERIFIED 28 Nov 2025 consolidated regime (see compliance-build/
 * research/2025-change-of-control-verified.md): the NBFC Acquisition of
 * Shareholding or Control Directions, 2025 (paragraphs 6 to 13), the change-in-
 * management rule in the NBFC Governance Directions, 2025 (paragraphs 10 and
 * 11), the HFC Directions, 2025 Chapter VII (paragraphs 104 to 109), and the
 * Commercial Banks Acquisition and Holding of Shares or Voting Rights
 * Directions, 2025 (paragraphs 7, 10, 14, 22, 23).
 *
 * Accuracy guardrail: only verified paragraph numbers are cited, written as
 * "paragraph N". No approval timelines are claimed. No dashes in copy.
 */
defined('ABSPATH') || exit;

// Enforcement cards for this theme, live view over the rbi_enforcement CPT.
// Facts only: we surface the change-of-control cited reason from each record.
$cc_records = array();
if (class_exists('PCC_Enforcement')) {
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (in_array('change-of-control', (array) ($rec['themes'] ?? array()), true)) {
            $cc_records[] = $rec;
        }
    }
}
$cc_total    = count($cc_records);
$cc_records  = array_slice($cc_records, 0, 3);
$tracker_url = home_url('/compliance/enforcement-tracker/');
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>Prior Approval for <br><span class="g-text">Change of Control</span></h1>
      <p>When an NBFC, housing finance company or bank must ask RBI before shares change hands, control passes or the board turns over, the two thresholds that trigger it, the public notice that follows, and what RBI has actually penalised, in plain language, linked to the source.</p>
      <div class="hub-hero-btns">
        <a href="#prevention" class="btn btn-primary">How institutions stay audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="#requires" class="btn btn-secondary">Read the requirements</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Acquisition of Shareholding or Control Directions · 28 Nov 2025</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>NBFCs · HFCs · CICs · Banks</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Last reviewed: Sep 2026</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Prior Approval for Change of Control'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Instruments</span><span class="snap-v">NBFC Directions, 2025<small>Acquisition of Control + Governance</small></span></div>
          <div class="snap-row"><span class="snap-k">Issued / in force</span><span class="snap-v">28 Nov 2025</span></div>
          <div class="snap-row"><span class="snap-k">Shareholding trigger</span><span class="snap-v">26 per cent<small>of paid-up equity, including progressive increases</small></span></div>
          <div class="snap-row"><span class="snap-k">Board trigger</span><span class="snap-v">More than 30 per cent<small>of directors, excluding independents</small></span></div>
          <div class="snap-row"><span class="snap-k">Public notice</span><span class="snap-v">30 days before<small>one national + one local paper</small></span></div>
          <div class="snap-row"><span class="snap-k">Actions in tracker</span><span class="snap-v"><?php echo (int) $cc_total; ?><small>NBFCs &amp; HFCs</small></span></div>
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
    <h2>Prior approval for change of control, in plain terms</h2>
    <p>Before anyone acquires control, before shareholding crosses 26 per cent, and before more than 30 per cent of the non-independent directors change, RBI's written permission must already be in hand. The approval comes first, the public notice second, the transaction last.</p>
  </div>
  <div class="split2">
    <div class="panel reveal">
      <div class="panel-eyebrow"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>What it is</div>
      <h3>A two-part test across two Directions</h3>
      <p>Since <b>28 Nov 2025</b> the obligation is split. The <b>Acquisition of Shareholding or Control Directions, 2025</b> cover ownership: any takeover or acquisition of control, whether or not management changes, and any change in shareholding, <b>including progressive increases over time</b>, that reaches <b>26 per cent</b> of paid-up equity. The <b>Governance Directions, 2025</b> cover the board: any change in management that turns over <b>more than 30 per cent of the directors, excluding independent directors</b>. Both need RBI's <b>prior written permission</b>, both are applied for through the <b>PRAVAAH</b> portal, and the first also requires a <b>public notice at least 30 days</b> before the transfer. Every penalty under this theme is one of those two thresholds crossed without the approval.</p>
    </div>
    <div class="panel reveal rd1">
      <div class="panel-eyebrow"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>Does this apply to you?</div>
      <h3>Applicability, by entity class</h3>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFCs in every layer</b>: deposit-taking, investment and credit companies, factors, MFIs, infrastructure finance companies, IDFs, CICs, P2P platforms and Account Aggregators. Mortgage guarantee companies and NOFHCs are carved out.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Housing finance companies</b>, directly listed in the NBFC Directions and again in Chapter VII of their own 2025 Directions, which cross-refers to the same paragraphs. An HFC accepting public deposits also needs approval for a <b>10 per cent</b> holding by a foreign investor.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Standalone primary dealers</b>: any change in shareholding pattern or capital structure needs prior approval.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial banks</b> under a different regime: any person whose aggregate holding would reach <b>5 per cent</b> ("major shareholding") needs RBI's previous approval under section 12B of the Banking Regulation Act, with holding caps of 10, 15 and 26 per cent by class of investor.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>Directors <b>re-elected on retirement by rotation</b> do not count towards the 30 per cent test. New appointments and replacements do, and the test is cumulative: several small board changes can cross it together.</span>
      </div>
    </div>
  </div>

  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Core obligations</span>
    <div class="obl-grid">
      <div class="obl reveal"><div class="obl-num">Control</div><h4>Approval before any takeover or acquisition of control</h4><p>Any takeover or acquisition of control of an NBFC needs <b>prior written permission of RBI</b>, "which may or may not result in change of management". Control takes its meaning from the SEBI Takeover Regulations, so it can pass without a majority of shares.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">26 per cent</div><h4>Shareholding, including creeping acquisitions</h4><p>Any change in shareholding that results in <b>26 per cent or more</b> of paid-up equity being acquired or transferred needs prior approval, and the Directions say so explicitly for <b>progressive increases over time</b>. Two NBFCs were penalised in 2026 for crossing this line without asking.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">30 per cent</div><h4>Board turnover above 30 per cent of directors</h4><p>Any change in management that results in a change of <b>more than 30 per cent of the directors, excluding independent directors</b>, needs prior written permission under the Governance Directions. Most penalties under this theme cite exactly this rule.</p></div>
      <div class="obl reveal"><div class="obl-num">Application</div><h4>PRAVAAH, sources of funds, declarations</h4><p>The application goes through <b>PRAVAAH</b> on the company's letterhead with information on the proposed shareholders, their <b>sources of funds</b>, declarations that they are not linked to unincorporated deposit-takers, rejected CoR applicants or criminal cases, and a <b>bankers' report</b>.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Public notice</div><h4>30 days' notice, after approval, before transfer</h4><p>A public notice in <b>one leading national and one local vernacular newspaper</b>, given by the NBFC and the transferee <b>after</b> RBI's permission and <b>at least 30 days before</b> the sale of shares or transfer of control, stating the intention, the transferee's particulars and the reasons.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">FATF</div><h4>Investors from non-compliant jurisdictions</h4><p>A new investor from or through a <b>FATF non-compliant jurisdiction</b> may not acquire significant influence, and such fresh investors together must stay <b>below 20 per cent of voting power</b>. Banks go further: no major shareholding from such jurisdictions at all.</p></div>
    </div>
    <div class="note-row" style="margin-top:16px">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span>Paragraph references are to the NBFC Acquisition of Shareholding or Control Directions, 2025 (paragraphs 6 to 13), the NBFC Governance Directions, 2025 (paragraphs 10 and 11), the HFC Directions, 2025 (paragraphs 104 to 109) and the Commercial Banks Acquisition and Holding of Shares or Voting Rights Directions, 2025 (paragraphs 7, 10, 14, 22 and 23).</span>
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
  <p class="pat-lead"><?php echo (int) $cc_total; ?> of the actions in our tracker cite a change of control or management without RBI's prior approval, and the pattern is unusually clean: no other theme has such a short list of reasons. Directors appointed until more than 30 per cent of the board had changed, and shares transferred past 26 per cent, each without the application that had to come first. These are small penalties on small and mid-sized NBFCs, and each one is a threshold that the board or the company secretary did not have in front of them at the moment it mattered. The actions below are drawn from RBI press releases.</p>
  <p class="pat-note">Each entry states only the reason cited in the RBI press release. Where a penalty covered more than one issue, the amount shown is the total and is not attributable to any single reason.</p>

  <div class="enf-grid">
    <?php foreach ($cc_records as $i => $rec) :
        $rd      = $i === 1 ? 'rd1' : ($i === 2 ? 'rd2' : '');
        $is_nbfc = ($rec['re_group'] ?? '') === 'NBFC';
        $type    = str_replace('-', ' · ', $rec['re_type'] ?? ($rec['re_group'] ?? ''));
        $date    = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
        $multi   = !empty($rec['multi_reason']);
        // The change-of-control cited reason (fall back to the first cited reason).
        $reason = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'change-of-control') { $reason = $c['text']; break; }
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
          <div class="enf-label">Cited reason (change of control)</div>
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
  <?php if ($cc_total > count($cc_records)) : ?>
  <p class="pat-note" style="margin-top:18px">Showing <?php echo count($cc_records); ?> of <?php echo (int) $cc_total; ?> change of control actions, <a href="<?php echo esc_url($tracker_url . '?theme=change-of-control'); ?>">see all of them in the enforcement tracker</a>.</p>
  <?php endif; ?>
</div>
</section>

<!-- PREVENTION / SCOPE SPLIT -->
<section id="prevention" class="section" style="background:var(--gray-50)">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Where the failures actually happen</span>
    <h2>Understanding the rule is step one.<br>Operationalising it is where penalties occur.</h2>
    <p>This is the rare RBI rule where the failure is almost always a knowledge gap at the top of the organisation: a threshold nobody checked before a board resolution or a share transfer was signed. Here's an honest split of what a policy distribution-and-attestation layer like PolicyCentral.ai does and does not address.</p>
  </div>
  <div class="scope-grid">
    <div class="scope in reveal">
      <div class="scope-head"><span class="scope-pill">PolicyCentral.ai helps here</span></div>
      <h3>Distribute · attest · prove</h3>
      <p>The "did everyone get it, read it, and can you show an auditor" layer around your change-of-control controls.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Put the two thresholds, the 26 per cent shareholding test and the 30 per cent directors test, in front of <b>every director, the company secretary, the CFO and investor relations</b> as acknowledged policy, so no board resolution or share transfer is approved by someone who has not seen them.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Distribute the <b>pre-transaction checklist</b> (cumulative board-change count, cumulative shareholding count, PRAVAAH application pack, public-notice text) with read receipts, and re-push it before every AGM, capital raise or board reshuffle.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>When the rulebook changes, as it did on <b>28 Nov 2025</b> when the thresholds moved into two separate Directions, version the policy and chase the unread automatically.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Maintain a <b>tamper-evident audit trail</b> of who received, read and acknowledged each version, the evidence a supervisory review asks for first.</span></li>
      </ul>
    </div>
    <div class="scope out reveal rd1">
      <div class="scope-head"><span class="scope-pill">A different system handles this</span></div>
      <h3>What PolicyCentral.ai is not</h3>
      <p>We're explicit about scope, these are jobs for your secretarial, legal and registry systems, not a policy platform.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>share register and cap table</b>, and the computation of aggregate and progressive holdings.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Board and shareholder governance tooling</b>, resolutions, ROC filings and the PRAVAAH application itself.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Investor due diligence</b>, source-of-funds verification and FATF jurisdiction screening.</span></li>
      </ul>
      <p style="margin:18px 0 0;font-size:12.5px;color:var(--gray-400)">Being clear about this is the point, sophisticated compliance teams trust a vendor that names its boundaries.</p>
    </div>
  </div>

  <!-- GO DEEPER -->
  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Go deeper</span>
    <div class="deep-grid">
      <a href="<?php echo esc_url($tracker_url . '?theme=change-of-control'); ?>" class="deep reveal"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div><div class="deep-txt"><h4>Enforcement tracker</h4><span>All change of control actions</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url(home_url('/compliance/prudential-governance/')); ?>" class="deep reveal rd1"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Prudential, Governance &amp; Reporting hub</h4><span>The rest of the Governance Directions: fit-and-proper, KMP, CRO</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=12964" target="_blank" rel="noopener" class="deep reveal"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>NBFC, Acquisition of Shareholding or Control Directions, 2025</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13166" target="_blank" rel="noopener" class="deep reveal rd1"><div class="ib ib-amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>Commercial Banks, Acquisition and Holding of Shares or Voting Rights Directions, 2025</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
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
      <div class="cv-kicker">For company secretaries, CFOs &amp; compliance teams</div>
      <h3>Get the change-of-control pre-transaction checklist</h3>
      <p>A one-page checklist of the two thresholds, the cumulative counts to keep, what the PRAVAAH application pack must contain, the public-notice wording and timing, and the audit-trail evidence to keep ready for a supervisory review.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn">Request the checklist <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For boards, CCOs &amp; promoters</div>
      <h3>See governance policy attestation tracked across every director</h3>
      <p>PolicyCentral.ai shows you, live and person-by-person, exactly which directors and officers have read and acknowledged the change-of-control policy and every update, with a tamper-evident trail you can export for an RBI review. Walk through it on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>
