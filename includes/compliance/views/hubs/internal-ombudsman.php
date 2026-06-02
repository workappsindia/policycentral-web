<?php
/**
 * Hub content: Internal Ombudsman & Grievance Redress  (/compliance/internal-ombudsman)
 * Included by theme-hub.php between get_header() and get_footer().
 *
 * Built on the VERIFIED 2026 regime (see compliance-build/research/
 * 2026-io-directions-verified.md): the 2023 Master Direction was repealed on
 * 14 Jan 2026 and replaced by six entity-class Directions, 2026.
 *
 * Accuracy guardrail: obligations are described without 2026 clause numbers
 * (not yet verified clause-by-clause); only the verified deferred-compliance
 * clauses 7(2)/14(2)/14(4) and the timelines are stated as specifics.
 */
defined('ABSPATH') || exit;

// Enforcement cards for this theme, live view over the rbi_enforcement CPT
// (PCC_Enforcement falls back to the seed dataset before the records are loaded).
// Facts only: we surface the IO-related cited reason from each record.
$io_records = array();
if (class_exists('PCC_Enforcement')) {
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (in_array('internal-ombudsman', (array) ($rec['themes'] ?? array()), true)) {
            $io_records[] = $rec;
        }
    }
}
$io_records  = array_slice($io_records, 0, 3);
$tracker_url = home_url('/compliance/enforcement-tracker/');
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>Internal Ombudsman &amp;<br><span class="g-text">Grievance Redress</span></h1>
      <p>What the RBI Internal Ombudsman Directions, 2026 require, who they apply to, and what RBI has actually penalised banks and NBFCs for under their internal grievance-redress mechanisms, in plain language, linked to the source.</p>
      <div class="hub-hero-btns">
        <a href="#prevention" class="btn btn-primary">How institutions stay audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="#requires" class="btn btn-secondary">Read the requirements</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Six entity-class Directions · 14 Jan 2026</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>Banks · NBFCs · SFBs · PBs · PPIs · CICs</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Last reviewed: Jun 2026</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Internal Ombudsman & Grievance Redress'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Instrument</span><span class="snap-v">IO Directions, 2026<small>six entity-class directions</small></span></div>
          <div class="snap-row"><span class="snap-k">Issued / in force</span><span class="snap-v">14 Jan 2026</span></div>
          <div class="snap-row"><span class="snap-k">Replaces</span><span class="snap-v">2023 Master Direction<small>repealed</small></span></div>
          <div class="snap-row"><span class="snap-k">Escalation to IO</span><span class="snap-v">20 days<small>≥10 days where prescribed</small></span></div>
          <div class="snap-row"><span class="snap-k">Final decision</span><span class="snap-v">30 days<small>to the complainant</small></span></div>
          <div class="snap-row"><span class="snap-k">FY25-26 actions here</span><span class="snap-v">3<small>banks &amp; NBFCs (illustrative)</small></span></div>
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
    <h2>The Internal Ombudsman, in plain terms</h2>
    <p>An independent, apex-level authority inside a regulated entity that reviews customer complaints the entity has already rejected, before the customer escalates to the RBI Ombudsman.</p>
  </div>
  <div class="split2">
    <div class="panel reveal">
      <div class="panel-eyebrow"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>What it is</div>
      <h3>A second look, before the regulator's</h3>
      <p>The Internal Ombudsman (IO) does not take complaints directly from customers. Every complaint that an entity's internal grievance machinery <b>partly or wholly rejects</b> must be auto-escalated to the IO for an independent, reasoned decision, to catch service deficiencies in-house and reduce the volume reaching the RBI Ombudsman. The IO sits at the apex of the grievance-redress mechanism and reports functionally to the Board.</p>
    </div>
    <div class="panel reveal rd1">
      <div class="panel-eyebrow"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>Does this apply to you?</div>
      <h3>Applicability, by entity class</h3>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial banks</b> with 10+ banking outlets in India (as on 31 Mar 2025). Excludes SFBs, Payments Banks and Local Area Banks.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFCs</b>, deposit-taking with 10+ branches; non-deposit with asset size ₹5,000 cr+ and a public customer interface. Excludes HFCs, Core Investment Companies, IDF/Infrastructure Finance NBFCs, and NBFCs under insolvency.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Small Finance Banks</b> and <b>Payments Banks</b>, each under their own 2026 Direction (10+ banking outlets).</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Non-bank PPI issuers</b> with more than 1 crore PPIs outstanding, and all <b>Credit Information Companies</b>, under their own 2026 Directions.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Newly cross a threshold? You have <b>six months</b> to put the framework in place.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>The single 2023 Master Direction was <b>repealed on 14 Jan 2026</b> and replaced by these six entity-class Directions. Existing IO appointments continue under the new directions.</span>
      </div>
    </div>
  </div>

  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Core obligations</span>
    <div class="obl-grid">
      <div class="obl reveal"><div class="obl-num">Escalation</div><h4>Board-approved SOP + auto-escalation</h4><p>A Board-approved SOP and an automated complaints system that auto-escalates every partly/wholly rejected complaint to the IO within 20 days, or ≥10 days before any RBI/NPCI-prescribed deadline.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Turnaround</div><h4>30-day final decision</h4><p>The final decision must reach the complainant within 30 days of the entity first receiving the complaint.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Staff awareness</div><h4>Disseminate across all offices</h4><p>The entity must widely disseminate the IO guidelines among its staff across <b>all branches and administrative offices</b> when communicating the appointment.</p></div>
      <div class="obl reveal"><div class="obl-num">Training</div><h4>Use complaint analysis in training</h4><p>Analysis of complaints handled by the IO, patterns, root causes, remedial measures, must feed into staff training and conferences.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Board oversight</div><h4>Periodic Board reporting</h4><p>The IO furnishes periodic reports to the Board committee handling customer service and supports its oversight of grievance redress.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">RBI returns</div><h4>Appointment notice &amp; quarterly returns</h4><p>Notify the IO/Dy-IO appointment to RBI's CEPD within 5 working days, and file the prescribed quarterly returns by the <b>15th</b> of the month following the quarter.</p></div>
    </div>
    <div class="note-row" style="margin-top:16px">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span>Certain provisions of the 2026 Directions (clauses 7(2), 14(2) and 14(4)) must be complied with <b>by 30 June 2026</b>.</span>
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
  <p class="pat-lead">Across both banks and NBFCs, a recurring FY25-26 theme was shortcomings in how internal grievance-redress mechanisms connected to the Internal Ombudsman, complaints not escalated in time, or no system in place to escalate them at all. The actions below are drawn from the FACE compilation of RBI press releases.</p>
  <p class="pat-note">Each entry states only the reason cited in the RBI press release. Where a penalty covered more than one issue, the amount shown is the total and is not attributable to any single reason.</p>

  <div class="enf-grid">
    <?php foreach ($io_records as $i => $rec) :
        $rd      = $i === 1 ? 'rd1' : ($i === 2 ? 'rd2' : '');
        $is_nbfc = ($rec['re_group'] ?? '') === 'NBFC';
        $type    = str_replace('-', ' · ', $rec['re_type'] ?? ($rec['re_group'] ?? ''));
        $date    = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
        $multi   = !empty($rec['multi_reason']);
        $entry   = !empty($rec['permalink']) ? $rec['permalink'] : home_url('/compliance/enforcement/' . ($rec['id'] ?? '') . '/');
        // The IO-related cited reason (fall back to the first cited reason).
        $reason = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'internal-ombudsman') { $reason = $c['text']; break; }
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
          <div class="enf-label">Cited reason (IO-related)</div>
          <div class="enf-reason"><?php echo esc_html($reason); ?></div>
          <div class="enf-foot">
            <?php if ($multi) : ?>
            <span class="enf-multi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>Multiple reasons</span>
            <?php endif; ?>
            <a href="<?php echo esc_url($entry); ?>" class="enf-src"<?php echo $multi ? '' : ' style="margin-left:auto"'; ?>>View action <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</section>

<!-- PREVENTION / SCOPE SPLIT -->
<section id="prevention" class="section" style="background:var(--gray-50)">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Where the failures actually happen</span>
    <h2>Understanding the rule is step one.<br>Operationalising it is where penalties occur.</h2>
    <p>Most of these aren't comprehension gaps, the obligation was known. The breakdown is downstream: the procedure didn't reach every relevant person, wasn't acknowledged, or wasn't reviewed on cadence. Here's an honest split of what a policy distribution-and-attestation layer like PolicyCentral does and does not address.</p>
  </div>
  <div class="scope-grid">
    <div class="scope in reveal">
      <div class="scope-head"><span class="scope-pill">PolicyCentral helps here</span></div>
      <h3>Distribute · attest · prove</h3>
      <p>The "did everyone get it, read it, and can you show an auditor" layer around the IO framework.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Push the Board-approved IO SOP to <b>every relevant staff member across every branch and administrative office</b>, with read receipts and digital acknowledgement.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Distribute complaint-pattern analysis and grievance-handling guidance as <b>trackable training content</b>.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Maintain a <b>tamper-evident audit trail</b> of who received, read and acknowledged the SOP and every update, the evidence a supervisory review asks for.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Version the SOP and <b>re-push to unread staff</b> with one click when the framework changes.</span></li>
      </ul>
    </div>
    <div class="scope out reveal rd1">
      <div class="scope-head"><span class="scope-pill">A different system handles this</span></div>
      <h3>What PolicyCentral is not</h3>
      <p>We're explicit about scope, these are jobs for grievance-workflow and case-management tooling, not a policy platform.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>automated complaints-management software</b> that routes and auto-escalates rejected complaints to the IO.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>Tracking the <b>30-day final-decision turnaround</b> on individual complaints.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>IO's case adjudication</b> and reasoned-decision recording itself.</span></li>
      </ul>
      <p style="margin:18px 0 0;font-size:12.5px;color:var(--gray-400)">Being clear about this is the point, sophisticated compliance teams trust a vendor that names its boundaries.</p>
    </div>
  </div>

  <!-- GO DEEPER -->
  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Go deeper</span>
    <div class="deep-grid">
      <a href="<?php echo esc_url(home_url('/compliance/rules/io-commercial-banks-2026/')); ?>" class="deep reveal"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Full decode: IO Directions, 2026 (Commercial Banks)</h4><span>Applicability, obligations &amp; what changed</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url(home_url('/compliance/rules/io-nbfc-2026/')); ?>" class="deep reveal rd1"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Full decode: IO Directions, 2026 (NBFC)</h4><span>Thresholds, exclusions &amp; obligations</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url($tracker_url); ?>" class="deep reveal"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div><div class="deep-txt"><h4>Enforcement tracker</h4><span>Filter all FY25-26 actions by reason &amp; entity</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a class="deep soon reveal rd1"><div class="ib ib-amber"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg></div><div class="deep-txt"><h4>IO reporting calendar</h4><span>Quarterly &amp; annual RBI due dates</span></div><span class="pill-soon">Soon</span></a>
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
      <h3>Get the IO SOP &amp; staff-dissemination checklist</h3>
      <p>A practical checklist covering what your Board-approved SOP should contain, who across your branch network needs to acknowledge it, and the audit-trail evidence to keep ready for a supervisory review.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn">Request the checklist <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For CCOs, HR &amp; InfoSec leaders</div>
      <h3>See SOP attestation tracked across every branch</h3>
      <p>PolicyCentral shows you, live and branch-by-branch, exactly who has read and acknowledged each policy and SOP, with a tamper-evident trail you can export for an RBI review. Walk through it on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>
