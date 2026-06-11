<?php
/**
 * Decode: RBI (Non-Bank Prepaid Payment Instruments Issuers - Internal Ombudsman) Directions, 2026
 * /compliance/rules/io-ppi-2026   (rbi_rule single)
 *
 * Verified against the RBI notification id=13275 (RBI/CEPD/2025-26/385),
 * 14 Jan 2026, issued under s. 18 of the Payment and Settlement Systems Act,
 * 2007. See compliance-build/research/2026-io-directions-verified.md (§E,
 * 2026-06-12). Obligations described thematically, NO unverified clause numbers.
 */
defined('ABSPATH') || exit;

$rbi_url  = 'https://www.rbi.org.in/Scripts/BS_ViewMasDirections.aspx?id=13275';
$hub_url  = home_url('/compliance/internal-ombudsman/');
$track    = home_url('/compliance/enforcement-tracker/');
?>
<section id="rule-head">
<div class="rh-mesh"></div>
<div class="container">
  <div class="rh-inner">
    <h1>RBI <span class="g-text">(Non-Bank PPI Issuers - Internal Ombudsman)</span> Directions, 2026</h1>
    <p class="lede">The 2026 Direction requiring larger non-bank Prepaid Payment Instrument issuers, wallets and prepaid cards, to maintain an independent Internal Ombudsman and escalate every rejected customer complaint to it before the customer reaches the RBI Ombudsman. Issued under section 18 of the Payment and Settlement Systems Act, 2007, one of six entity-class Directions that replaced the 2023 Master Direction on 14 January 2026.</p>
    <div class="rh-actions">
      <a href="<?php echo esc_url($hub_url); ?>" class="btn btn-secondary">← Back to the hub</a>
      <a href="<?php echo esc_url($rbi_url); ?>" target="_blank" rel="noopener" class="btn btn-primary">Read on rbi.org.in <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></a>
    </div>
    <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Rule Library', 'url' => home_url('/compliance/rules/')), array('label' => 'PPI Issuers IO Directions, 2026'))); ?>
  </div>
</div>
</section>

<div class="container">
<div class="doc">
  <aside class="toc">
    <div class="toc-label">On this page</div>
    <ul>
      <li><a href="#summary" class="toc-link">In one line</a></li>
      <li><a href="#applies" class="toc-link">Who it applies to</a></li>
      <li><a href="#obligations" class="toc-link">What it requires</a></li>
      <li><a href="#changed" class="toc-link">What changed from 2023</a></li>
      <li><a href="#penalised" class="toc-link">What RBI penalised</a></li>
      <li><a href="#background" class="toc-link">Background &amp; lineage</a></li>
      <li><a href="#source" class="toc-link">Source &amp; version</a></li>
    </ul>
  </aside>

  <main class="body-col">
    <div class="metabox">
      <div class="metabox-head">Reference</div>
      <div class="metabox-body">
        <div class="metabox-row"><span class="k">Instrument</span><span class="v">RBI/CEPD/2025-26/385</span></div>
        <div class="metabox-row"><span class="k">Issued</span><span class="v">14 Jan 2026</span></div>
        <div class="metabox-row"><span class="k">Effective</span><span class="v">Immediate · part by 30 Jun 2026</span></div>
        <div class="metabox-row"><span class="k">Power</span><span class="v">s. 18, PSS Act 2007</span></div>
        <div class="metabox-row"><span class="k">Applies to</span><span class="v">Non-bank PPI issuers, &gt;1 crore PPIs</span></div>
        <div class="metabox-row"><span class="k">Last reviewed</span><span class="v">Jun 2026</span></div>
      </div>
    </div>

    <section class="sec" id="summary">
      <div class="tldr">
        <div class="tldr-h"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>In one line</div>
        <p>If a covered wallet or prepaid-card issuer rejects a customer complaint, that rejection must be reviewed by an <strong>independent Internal Ombudsman inside the issuer</strong> before the customer is told to approach the RBI Ombudsman, and the issuer must be able to show the system, people and staff awareness to make that happen reliably.</p>
      </div>
      <p>On 14 January 2026 the RBI replaced its single 2023 Internal Ombudsman Master Direction with <strong>six entity-class-specific Directions</strong>. This one applies to non-bank PPI issuers, a class where complaint volume scales with instruments outstanding rather than branch count, which is exactly how its applicability threshold is written.</p>
    </section>

    <section class="sec" id="applies">
      <div class="sec-eyebrow"><span>Scope</span></div>
      <h2>Who it applies to</h2>
      <p>Unlike the bank directions, the threshold here is instruments outstanding, not banking outlets.</p>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Non-bank PPI issuers</b> with <b>more than 1 crore Prepaid Payment Instruments outstanding</b> as on 31 March 2025, <b>or thereafter</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>An issuer crossing the threshold <b>after 31 March 2025</b> must comply within <b>six months</b> of meeting it.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Bank</b> PPI issuers are not under this Direction, banks follow their own entity-class IO Directions.</span></li>
      </ul>
    </section>

    <section class="sec" id="obligations">
      <div class="sec-eyebrow"><span>The requirements</span></div>
      <h2>What it requires</h2>
      <p>Grouped by what each obligation is about. Described in plain terms; verify the exact clause text against the source before acting.</p>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div><h3>The office</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>An independent Internal Ombudsman</h4><p>An IO appointed for a fixed contractual term, independent of the issuer, sitting at the apex of the grievance-redress mechanism and reporting functionally to the Board. A Deputy IO may be appointed where complaint volume warrants.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></div><h3>How complaints reach the IO</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Board-approved SOP + automated escalation</h4><p>A Board-approved Standard Operating Procedure and an automated complaints-management system that auto-escalates every partly or wholly rejected complaint to the IO <b>within 20 days</b>, or, where an RBI/NPCI/card-network timeline applies, sufficiently in advance that the IO gets at least <b>10 days</b> to review. For a digital-first issuer this is squarely a systems obligation.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>30-day final decision</h4><p>The final decision must reach the complainant within <b>30 days</b> of the issuer first receiving the complaint.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Binding decisions &amp; the customer's next step</h4><p>The IO's decision binds the issuer unless the competent authority formally disagrees through a narrow Board-level route. Where a complaint is still rejected after IO review, the issuer must inform the customer of their right to approach the RBI Ombudsman.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div><h3>Governance, staff awareness &amp; reporting</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Disseminate across all offices &amp; train</h4><p>Widely disseminate the IO guidelines among staff across <b>all branches and administrative offices</b> when communicating the appointment, including support and grievance teams, and feed analysis of complaints handled by the IO into staff training.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Board oversight &amp; supervisory review</h4><p>Periodic reporting to the Board committee handling customer service; implementation forms part of RBI's supervisory review.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Reporting to RBI</h4><p>Notify any IO/Deputy IO appointment to RBI's Consumer Education and Protection Department within <b>5 working days</b>, and file the prescribed quarterly returns by the <b>15th of the month following the quarter</b>.</p></div></div>
        </div>
      </div>

      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Certain provisions, clauses <b>7(2), 14(2) and 14(4)</b>, must be complied with <b>by 30 June 2026</b>.</span>
      </div>
    </section>

    <section class="sec" id="changed">
      <div class="sec-eyebrow"><span>For 2023 adopters</span></div>
      <h2>What changed from the 2023 Direction</h2>
      <p>If your framework was built on the 2023 Master Direction, these are the moves that matter:</p>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>The single 2023 Master Direction was <b>repealed</b> and split into <b>six entity-class Directions</b>; non-bank PPI issuers now have <b>their own</b>. Existing IO appointments continue under it.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>The <b>1-crore-PPIs-outstanding</b> threshold is anchored to <b>31 March 2025 "or thereafter"</b>, an issuer that crosses it later is pulled in, with a six-month runway.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>The quarterly return due date moved from the 10th to the <b>15th</b> of the following month.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Certain provisions are given a transition runway to <b>30 June 2026</b>.</span></li>
      </ul>
    </section>

    <section class="sec" id="penalised">
      <div class="sec-eyebrow"><span>Enforcement</span></div>
      <h2>What RBI has penalised under the IO framework</h2>
      <?php $pen = pcc_render_penalised_for_rule('io-ppi-2026'); ?>
      <?php if ($pen) : ?>
      <p>Each entry states only the reason cited in the RBI press release; where a penalty covered several issues, the amount is the total and isn't attributable to any single reason.</p>
      <div class="pen-grid"><?php echo $pen; ?></div>
      <?php else : ?>
      <p>No FY25-26 action in our tracker cites a PPI issuer's Internal Ombudsman framework so far, the IO-related penalties this year landed on commercial banks and NBFCs. The obligation set is the same, which makes their cited failures the playbook of what supervisors check.</p>
      <?php endif; ?>
      <div style="margin-top:18px"><a href="<?php echo esc_url($track . '?theme=internal-ombudsman'); ?>" class="btn btn-secondary">See all in the enforcement tracker <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a></div>
    </section>

    <section class="sec" id="background">
      <div class="sec-eyebrow"><span>Context</span></div>
      <h2>Background &amp; lineage</h2>
      <p>For non-bank issuers the lineage runs through the 2019 scheme for non-bank system participants, worth knowing when older institutional documents reference the repealed names.</p>
      <ul class="lineage">
        <li><span class="yr">3 Sep 2018</span><b>Internal Ombudsman Scheme</b>, for banks.</li>
        <li><span class="yr">22 Oct 2019</span><b>IO Scheme for Non-Bank System Participants</b>, the first time PPI issuers were brought in.</li>
        <li><span class="yr">15 Nov 2021</span><b>Appointment of IO by NBFCs.</b></li>
        <li><span class="yr">6 Oct 2022</span><b>RBI (CIC - Internal Ombudsman) Direction, 2022.</b></li>
        <li><span class="yr">29 Dec 2023</span><b>RBI (Internal Ombudsman for Regulated Entities) Directions, 2023</b>, consolidated all of the above; <b>repealed 14 Jan 2026</b>.</li>
        <li class="now"><span class="yr">14 Jan 2026</span><b>Six entity-class Directions, 2026</b>, this PPI-issuer Direction is one of them.</li>
      </ul>
    </section>

    <div class="opcallout">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="opcallout-t"><h3>Knowing the rule is step one</h3><p>See how issuers distribute the IO SOP across every office and support team, and prove who acknowledged it.</p></div>
      <a href="<?php echo esc_url($hub_url . '#prevention'); ?>" class="btn btn-primary">How it stays audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>

    <section class="sec" id="source" style="margin-top:48px">
      <div class="srcbox">
        <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Source &amp; version</h3>
        <div class="src-row"><span class="k">Title</span><span class="v">RBI (Non-Bank Prepaid Payment Instruments Issuers - Internal Ombudsman) Directions, 2026</span></div>
        <div class="src-row"><span class="k">Reference no.</span><span class="v">RBI/CEPD/2025-26/385</span></div>
        <div class="src-row"><span class="k">Date of issue</span><span class="v">14 January 2026</span></div>
        <div class="src-row"><span class="k">Repeals</span><span class="v">IO (Regulated Entities) Directions, 2023</span></div>
        <div class="src-row"><span class="k">Official source</span><a class="v" href="<?php echo esc_url($rbi_url); ?>" target="_blank" rel="noopener">rbi.org.in →</a></div>
        <div class="src-row"><span class="k">This decode last reviewed</span><span class="v">June 2026</span></div>
        <div class="disc-line">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <span>This is a plain-language summary to aid understanding, not legal advice. RBI instruments are amended over time, always verify against the original on rbi.org.in and consult your compliance and legal teams before acting.</span>
        </div>
      </div>
    </section>
  </main>
</div>
</div>
