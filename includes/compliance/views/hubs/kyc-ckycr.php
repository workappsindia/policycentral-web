<?php
/**
 * Hub content: KYC & CKYCR Compliance  (/compliance/kyc-ckycr)
 * Included by theme-hub.php between get_header() and get_footer().
 *
 * Built on the VERIFIED November 2025 regime (see compliance-build/research/
 * 2025-kyc-directions-verified.md): the single 2016 KYC Master Direction was
 * superseded on 28 Nov 2025 by entity-class KYC Directions issued under RBI's
 * consolidation of its regulations into 238 Master Directions ("as is" basis).
 *
 * Accuracy guardrail: only the verified paragraph numbers from the Commercial
 * Banks Directions are cited (6(2), 27, 38, 41(1), 42(1)). No CKYCR day-count
 * and no beneficial-owner % thresholds — not verified clause-by-clause.
 */
defined('ABSPATH') || exit;

// Enforcement cards for this theme, live view over the rbi_enforcement CPT.
// Facts only: we surface the KYC-related cited reason from each record.
$kyc_records = array();
if (class_exists('PCC_Enforcement')) {
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (in_array('kyc-ckycr', (array) ($rec['themes'] ?? array()), true)) {
            $kyc_records[] = $rec;
        }
    }
}
$kyc_total   = count($kyc_records);
$kyc_records = array_slice($kyc_records, 0, 3);
$tracker_url = home_url('/compliance/enforcement-tracker/');
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>KYC &amp; CKYCR<br><span class="g-text">Compliance</span></h1>
      <p>What the RBI Know Your Customer Directions, 2025 require, who they apply to, and what RBI has actually penalised banks and NBFCs for, from missed CKYCR uploads to V-CIP gaps, in plain language, linked to the source.</p>
      <div class="hub-hero-btns">
        <a href="#prevention" class="btn btn-primary">How institutions stay audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="#requires" class="btn btn-secondary">Read the requirements</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Entity-class KYC Directions · 28 Nov 2025</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>Banks · NBFCs · Co-ops · RRBs · AIFIs</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Last reviewed: Jun 2026</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'KYC & CKYCR Compliance'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Instrument</span><span class="snap-v">KYC Directions, 2025<small>one per entity class</small></span></div>
          <div class="snap-row"><span class="snap-k">Issued / in force</span><span class="snap-v">28 Nov 2025</span></div>
          <div class="snap-row"><span class="snap-k">Replaces</span><span class="snap-v">2016 KYC Master Direction<small>consolidated "as is"</small></span></div>
          <div class="snap-row"><span class="snap-k">Risk review</span><span class="snap-v">Every 6 months<small>risk categorisation</small></span></div>
          <div class="snap-row"><span class="snap-k">Re-KYC cadence</span><span class="snap-v">2 / 8 / 10 yrs<small>high / medium / low risk</small></span></div>
          <div class="snap-row"><span class="snap-k">FY25-26 actions here</span><span class="snap-v"><?php echo (int) $kyc_total; ?><small>banks &amp; NBFCs (illustrative)</small></span></div>
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
    <h2>KYC &amp; CKYCR, in plain terms</h2>
    <p>Know who your customer is when you onboard them, keep that knowledge current for as long as the relationship lasts, and file it with the Central KYC Records Registry so the system as a whole can rely on it.</p>
  </div>
  <div class="split2">
    <div class="panel reveal">
      <div class="panel-eyebrow"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>What it is</div>
      <h3>A lifecycle obligation, not an onboarding form</h3>
      <p>The KYC framework runs on a <b>Board-approved policy</b> built on four elements: a Customer Acceptance Policy, Risk Management, Customer Identification Procedures and Monitoring of Transactions. Identity is verified at onboarding (in person, via Aadhaar e-KYC, or by video through <b>V-CIP</b>), every customer is risk-categorised, the categorisation is <b>re-reviewed on a six-month cycle</b>, KYC is <b>periodically refreshed</b> on a risk-based cadence, and records are <b>filed with the CKYCR</b>. Most penalties land where one of these recurring loops quietly stops running.</p>
    </div>
    <div class="panel reveal rd1">
      <div class="panel-eyebrow"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>Does this apply to you?</div>
      <h3>Applicability, by entity class</h3>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial banks</b> (including SBI and corresponding new banks) under their own 2025 KYC Directions. SFBs, Payments Banks and Local Area Banks are carved out into their own directions.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFCs across all layers</b>, except NBFCs with no customer interface.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>RRBs, urban and rural co-operative banks, and All India Financial Institutions</b>, each under their own 2025 KYC Directions.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Foreign branches and majority-owned overseas subsidiaries, subject to host-country law.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>The single 2016 KYC Master Direction was <b>superseded on 28 Nov 2025</b> by these entity-class Directions, part of RBI consolidating its rulebook into 238 Master Directions. The consolidation was on an <b>"as is" basis</b>, so the underlying obligations carried over.</span>
      </div>
    </div>
  </div>

  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Core obligations</span>
    <div class="obl-grid">
      <div class="obl reveal"><div class="obl-num">Policy</div><h4>Board-approved KYC policy</h4><p>A KYC policy approved by the Board (or a committee it delegates to), built on the four key elements: Customer Acceptance Policy, Risk Management, Customer Identification Procedures and Monitoring of Transactions.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Risk review</div><h4>Re-categorise every six months</h4><p>Risk categorisation of accounts must be reviewed <b>at least once in every six months</b>, the exact obligation an NBFC was penalised for missing in FY25-26.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Re-KYC</div><h4>Periodic updation: 2 / 8 / 10 years</h4><p>KYC must be refreshed at least once every <b>two years for high-risk</b>, <b>eight years for medium-risk</b> and <b>ten years for low-risk</b> customers, measured from opening or the last updation.</p></div>
      <div class="obl reveal"><div class="obl-num">CKYCR</div><h4>File records with the registry</h4><p>Customers' KYC records must be uploaded to the <b>Central KYC Records Registry</b> within the prescribed timeline and kept current, missed uploads drew a penalty this year.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">V-CIP</div><h4>Video KYC that actually verifies</h4><p>Video-based Customer Identification must run on tech with <b>face liveness / spoof detection and accurate face matching</b>, and the institution must confirm the customer's <b>economic and financial profile</b>, not just sight their documents.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Beneficial owners</div><h4>Look through non-individual customers</h4><p>Where the customer is a company, firm or trust, the institution must <b>identify the beneficial owner(s)</b> and take all reasonable steps to verify their identity.</p></div>
    </div>
    <div class="note-row" style="margin-top:16px">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span>Paragraph references are to the Commercial Banks Directions, 2025; each entity class's own 2025 KYC Directions carry the corresponding provisions.</span>
    </div>
  </div>
</div>
</section>

<!-- ENFORCEMENT PATTERN -->
<section id="pattern" class="section">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">What RBI has penalised</span>
    <h2>The pattern across FY25-26</h2>
  </div>
  <p class="pat-lead"><?php echo (int) $kyc_total; ?> of the FY25-26 actions in our tracker cite KYC failures, and none of them are comprehension gaps. A registry upload that didn't happen on time, beneficial owners never identified, a six-month review cycle that stopped running, video KYC missing its required face-matching component, the obligation was known; the operational loop behind it broke. The actions below are drawn from the FACE compilation of RBI press releases.</p>
  <p class="pat-note">Each entry states only the reason cited in the RBI press release. Where a penalty covered more than one issue, the amount shown is the total and is not attributable to any single reason.</p>

  <div class="enf-grid">
    <?php foreach ($kyc_records as $i => $rec) :
        $rd      = $i === 1 ? 'rd1' : ($i === 2 ? 'rd2' : '');
        $is_nbfc = ($rec['re_group'] ?? '') === 'NBFC';
        $type    = str_replace('-', ' · ', $rec['re_type'] ?? ($rec['re_group'] ?? ''));
        $date    = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
        $multi   = !empty($rec['multi_reason']);
        // The KYC-related cited reason (fall back to the first cited reason).
        $reason = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'kyc-ckycr') { $reason = $c['text']; break; }
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
          <div class="enf-label">Cited reason (KYC-related)</div>
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
  <?php if ($kyc_total > count($kyc_records)) : ?>
  <p class="pat-note" style="margin-top:18px">Showing <?php echo count($kyc_records); ?> of <?php echo (int) $kyc_total; ?> KYC-related actions, <a href="<?php echo esc_url($tracker_url); ?>">see all of them in the enforcement tracker</a>.</p>
  <?php endif; ?>
</div>
</section>

<!-- PREVENTION / SCOPE SPLIT -->
<section id="prevention" class="section" style="background:var(--gray-50)">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Where the failures actually happen</span>
    <h2>Understanding the rule is step one.<br>Operationalising it is where penalties occur.</h2>
    <p>Every cited failure above is a procedure that existed on paper and broke in a branch, a back office, or a system handover. Here's an honest split of what a policy distribution-and-attestation layer like PolicyCentral does and does not address.</p>
  </div>
  <div class="scope-grid">
    <div class="scope in reveal">
      <div class="scope-head"><span class="scope-pill">PolicyCentral helps here</span></div>
      <h3>Distribute · attest · prove</h3>
      <p>The "did everyone get it, read it, and can you show an auditor" layer around your KYC framework.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Push the Board-approved KYC policy and its operating procedures, CKYCR upload SOPs, V-CIP scripts, re-KYC campaign playbooks, to <b>every relevant staff member in every branch</b>, with read receipts and digital acknowledgement.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>When the rulebook changes, as it did wholesale on <b>28 Nov 2025</b>, version the policy, re-push to affected staff, and chase the unread automatically.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Distribute KYC/AML refresher material as <b>trackable training content</b>, with completion visible per branch and per role.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Maintain a <b>tamper-evident audit trail</b> of who received, read and acknowledged each version, the evidence a supervisory review asks for first.</span></li>
      </ul>
    </div>
    <div class="scope out reveal rd1">
      <div class="scope-head"><span class="scope-pill">A different system handles this</span></div>
      <h3>What PolicyCentral is not</h3>
      <p>We're explicit about scope, these are jobs for your KYC/AML stack, not a policy platform.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>customer identification stack itself</b>, Aadhaar e-KYC, V-CIP video infrastructure, face-matching and liveness technology.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>CKYCR upload integrations</b> and registry reconciliation.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span><b>Customer risk-scoring engines</b>, transaction monitoring and AML screening systems.</span></li>
      </ul>
      <p style="margin:18px 0 0;font-size:12.5px;color:var(--gray-400)">Being clear about this is the point, sophisticated compliance teams trust a vendor that names its boundaries.</p>
    </div>
  </div>

  <!-- GO DEEPER -->
  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Go deeper</span>
    <div class="deep-grid">
      <a href="<?php echo esc_url($tracker_url); ?>" class="deep reveal"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div><div class="deep-txt"><h4>Enforcement tracker</h4><span>Filter all FY25-26 actions by reason &amp; entity</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13141" target="_blank" rel="noopener" class="deep reveal rd1"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></div><div class="deep-txt"><h4>Read the source on rbi.org.in</h4><span>Commercial Banks, KYC Directions, 2025</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a class="deep soon reveal"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Full decode: KYC Directions, 2025 (Commercial Banks)</h4><span>Applicability, obligations &amp; what changed</span></div><span class="pill-soon">Soon</span></a>
      <a class="deep soon reveal rd1"><div class="ib ib-amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Full decode: KYC Directions, 2025 (NBFC)</h4><span>Layers covered, exclusions &amp; obligations</span></div><span class="pill-soon">Soon</span></a>
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
      <div class="cv-kicker">For compliance &amp; risk teams</div>
      <h3>Get the KYC policy &amp; dissemination checklist</h3>
      <p>A practical checklist covering what your Board-approved KYC policy should contain under the 2025 Directions, which procedures every branch must hold and acknowledge, and the audit-trail evidence to keep ready for a supervisory review.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn">Request the checklist <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For CCOs, HR &amp; InfoSec leaders</div>
      <h3>See KYC procedure attestation tracked across every branch</h3>
      <p>PolicyCentral shows you, live and branch-by-branch, exactly who has read and acknowledged each KYC procedure and every update, with a tamper-evident trail you can export for an RBI review. Walk through it on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>
