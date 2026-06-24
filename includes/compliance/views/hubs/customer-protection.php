<?php
/**
 * Hub content: Customer Protection & Responsible Business Conduct
 * (/compliance/customer-protection)
 * Included by theme-hub.php between get_header() and get_footer().
 *
 * Anchored on the 15 June 2026 package (effective 1 January 2027): the
 * Responsible Business Conduct Second Amendment (advertising, marketing, sale,
 * DSA/DMA, dark patterns, mis-selling) and the Undertaking of Financial Services
 * amendment (agency business & referral services). Sourced verbatim from the RBI
 * feed — see includes/compliance/views/rules/rbc-advertising-misselling-2026.php
 * and ufs-agency-referral-2026.php. Obligations described in plain terms.
 */
defined('ABSPATH') || exit;

// Enforcement cards for this theme, live view over the rbi_enforcement CPT.
// Facts only: we surface the cited reason from each record. Empty is fine —
// the package only takes effect 1 Jan 2027, so the section degrades gracefully.
$cp_records = array();
if (class_exists('PCC_Enforcement')) {
    foreach (PCC_Enforcement::get_all() as $rec) {
        if (in_array('customer-protection', (array) ($rec['themes'] ?? array()), true)) {
            $cp_records[] = $rec;
        }
    }
}
$cp_records  = array_slice($cp_records, 0, 3);
$tracker_url = home_url('/compliance/enforcement-tracker/');
$rbc_url     = home_url('/compliance/rules/rbc-advertising-misselling-2026/');
$ufs_url     = home_url('/compliance/rules/ufs-agency-referral-2026/');
?>

<!-- HERO -->
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-grid">
    <div class="hub-hero-l">
      <h1>Customer Protection &amp;<br><span class="g-text">Responsible Business Conduct</span></h1>
      <p>What RBI's 15 June 2026 conduct package requires of regulated entities when they advertise, market and sell financial products — their own and third-party — who it applies to, and the eleven dark patterns it bans. In plain language, linked to the source, live from 1 January 2027.</p>
      <div class="hub-hero-btns">
        <a href="#prevention" class="btn btn-primary">How institutions stay audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="#requires" class="btn btn-secondary">Read the requirements</a>
      </div>
      <div class="hub-meta">
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>RBC + UFS Amendments · 15 Jun 2026</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>Effective 1 Jan 2027</span>
        <span class="hub-tag"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>Banks · Co-ops · NBFCs · HFCs · AIFIs</span>
      </div>
      <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Customer Protection & Responsible Business Conduct'))); ?>
    </div>
    <div class="hub-hero-r reveal rd2">
      <div class="snap">
        <div class="snap-head">At a glance</div>
        <div class="snap-body">
          <div class="snap-row"><span class="snap-k">Package</span><span class="snap-v">RBC + UFS Amendments<small>two companion directions</small></span></div>
          <div class="snap-row"><span class="snap-k">Issued</span><span class="snap-v">15 Jun 2026</span></div>
          <div class="snap-row"><span class="snap-k">Effective</span><span class="snap-v">1 Jan 2027<small>a runway, not a switch</small></span></div>
          <div class="snap-row"><span class="snap-k">Entity classes</span><span class="snap-v">10 + 7<small>RBC across 10, UFS across 7</small></span></div>
          <div class="snap-row"><span class="snap-k">Dark patterns named</span><span class="snap-v">11<small>illustrative, Annex IIA</small></span></div>
          <div class="snap-row"><span class="snap-k">Consent default</span><span class="snap-v">"No"<small>opt-in, per product</small></span></div>
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
    <span class="eyebrow">What the package requires</span>
    <h2>Sell honestly, prove it, own the fallout</h2>
    <p>Two companion amendments issued together: one consolidates how you advertise, market and sell into the Responsible Business Conduct Directions; the other redraws how you partner with third-party providers under the Undertaking of Financial Services Directions.</p>
  </div>
  <div class="split2">
    <div class="panel reveal">
      <div class="panel-eyebrow"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div>What it is</div>
      <h3>A conduct rulebook for selling</h3>
      <p>From 1 January 2027, every covered entity needs a Board-approved policy for advertising, marketing and selling — own and third-party products alike. It hard-codes <b>explicit, per-product consent</b> defaulted to "No", upfront fee and risk disclosure, a <b>public list of selling agents</b>, a ban on <b>eleven named dark patterns</b>, and <b>full refund plus compensation</b> where mis-selling is established. The companion amendment keeps <b>agency</b> arrangements fee-only and risk-free, and <b>referral</b> arrangements introduce-only.</p>
    </div>
    <div class="panel reveal rd1">
      <div class="panel-eyebrow"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div>Does this apply to you?</div>
      <h3>Applicability, by entity class</h3>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>The <b>Responsible Business Conduct</b> amendment reaches <b>ten classes</b>: commercial, small finance, payments and local-area banks, RRBs, urban &amp; rural co-ops, AIFIs, NBFCs and HFCs.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>The <b>Undertaking of Financial Services</b> amendment reaches <b>seven classes</b>: commercial, small finance and payments banks, RRBs, urban &amp; rural co-ops, and NBFCs.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>For banks the rules sit at <b>Para 85A–85ZA</b>; for NBFCs and HFCs the identical set sits at <b>Para 101A–101ZA</b>. HFCs fold straight into the NBFC framework.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Excludes Core Investment Companies, NBFC-Account Aggregators, NOFHCs and NBFCs with no customer interface.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>All of it takes effect on <b>1 January 2027</b> — issued 15 June 2026 with a deliberate transition runway.</span>
      </div>
    </div>
  </div>

  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Core obligations</span>
    <div class="obl-grid">
      <div class="obl reveal"><div class="obl-num">Agents</div><h4>A public list of selling agents</h4><p>Maintain and display an up-to-date list of empanelled DSAs/DMAs on your website, updated within <b>seven calendar days</b> of any change; agents must be identifiable and bound by a published Code of Conduct.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Consent</div><h4>Explicit consent, defaulted to "No"</h4><p>Sell only with explicit, per-product consent; disclose fees, rates and risks upfront via KFS/MITC where prescribed; the default interface choice must be "No / I do not agree".</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Dark patterns</div><h4>None of the eleven</h4><p>Keep your app and website free of the eleven named dark patterns — false urgency, basket sneaking, drip pricing and the rest — subject to user testing and periodic internal audit.</p></div>
      <div class="obl reveal"><div class="obl-num">Mis-selling</div><h4>No incentives, no compulsory bundling</h4><p>No employee incentive from a third-party provider, no compulsory bundling, no funding a purchase without consent — and full <b>refund plus compensation</b> where mis-selling is established.</p></div>
      <div class="obl reveal rd1"><div class="obl-num">Agency</div><h4>Fee-only, no risk participation</h4><p>Act as a third party's agent on a fee basis with no risk participation, disclosed upfront, dealing only in regulated products you're permitted to.</p></div>
      <div class="obl reveal rd2"><div class="obl-num">Referral</div><h4>Introduce only, never sell</h4><p>Under referral you may market and refer but not sell; your brand stays off their documents and their journey stays off your platform — only a redirect link.</p></div>
    </div>
    <div class="note-row" style="margin-top:16px">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
      <span>Full obligation-by-obligation detail is in the two decodes below, each linked to its RBI source.</span>
    </div>
  </div>
</div>
</section>

<?php if ($cp_records) : ?>
<!-- ENFORCEMENT PATTERN -->
<section id="pattern" class="section">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">What RBI has penalised</span>
    <h2>The pattern so far</h2>
  </div>
  <p class="pat-note">Each entry states only the reason cited in the RBI press release. Where a penalty covered more than one issue, the amount shown is the total and is not attributable to any single reason.</p>
  <div class="enf-grid">
    <?php foreach ($cp_records as $i => $rec) :
        $rd      = $i === 1 ? 'rd1' : ($i === 2 ? 'rd2' : '');
        $is_nbfc = ($rec['re_group'] ?? '') === 'NBFC';
        $type    = str_replace('-', ' · ', $rec['re_type'] ?? ($rec['re_group'] ?? ''));
        $date    = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
        $multi   = !empty($rec['multi_reason']);
        $reason  = '';
        foreach ((array) ($rec['cited_reasons'] ?? array()) as $c) {
            if (($c['theme'] ?? '') === 'customer-protection') { $reason = $c['text']; break; }
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
          <div class="enf-label">Cited reason</div>
          <div class="enf-reason"><?php echo esc_html($reason); ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
</section>
<?php endif; ?>

<!-- PREVENTION / SCOPE SPLIT -->
<section id="prevention" class="section" style="background:var(--gray-50)">
<div class="container">
  <div class="section-header">
    <span class="eyebrow">Where the failures actually happen</span>
    <h2>Knowing the rule is step one.<br>Operationalising it across every seller is where it breaks.</h2>
    <p>A consent SOP, an agent Code of Conduct and a dark-patterns checklist only protect you if every branch, agent and sub-agent has received them, read them, and can be shown to have done so. Here's an honest split of what a policy distribution-and-attestation layer like PolicyCentral does and does not address.</p>
  </div>
  <div class="scope-grid">
    <div class="scope in reveal">
      <div class="scope-head"><span class="scope-pill">PolicyCentral helps here</span></div>
      <h3>Distribute · attest · prove</h3>
      <p>The "did everyone get it, read it, and can you show an auditor" layer around the conduct package.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Push the Board-approved sales policy, Code of Conduct and consent SOP to <b>every branch, employee, DSA/DMA and sub-agent</b>, with read receipts and digital acknowledgement.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Distribute the <b>dark-patterns and mis-selling guidance</b> as trackable training content for product, design and frontline teams.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Maintain a <b>tamper-evident audit trail</b> of who received, read and acknowledged each policy and update — the evidence a supervisory review asks for.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Version the policy and <b>re-push to unread staff</b> with one click ahead of the 1 January 2027 deadline.</span></li>
      </ul>
    </div>
    <div class="scope out reveal rd1">
      <div class="scope-head"><span class="scope-pill">A different system handles this</span></div>
      <h3>What PolicyCentral is not</h3>
      <p>We're explicit about scope — these are jobs for product, CRM and grievance tooling, not a policy platform.</p>
      <ul>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>consent-capture and disclosure UI</b> inside your app or onboarding journey.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>website list of empanelled agents</b> and the referral-product directory themselves.</span></li>
        <li><span class="mk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="2" y1="6" x2="10" y2="6"/></svg></span><span>The <b>mis-selling complaint, refund and compensation</b> workflow.</span></li>
      </ul>
      <p style="margin:18px 0 0;font-size:12.5px;color:var(--gray-400)">Being clear about this is the point — sophisticated compliance teams trust a vendor that names its boundaries.</p>
    </div>
  </div>

  <!-- GO DEEPER -->
  <div style="margin-top:48px">
    <span class="eyebrow" style="display:flex;margin-bottom:22px">Go deeper</span>
    <div class="deep-grid">
      <a href="<?php echo esc_url($rbc_url); ?>" class="deep reveal"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Full decode: Advertising, Marketing &amp; Mis-selling (RBC Amendment, 2026)</h4><span>Consent, DSA/DMA, the 11 dark patterns &amp; redress</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url($ufs_url); ?>" class="deep reveal rd1"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4>Full decode: Agency &amp; Referral Services (UFS Amendment, 2026)</h4><span>The agency/referral boundary, redrawn</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url(home_url('/compliance/rules/')); ?>" class="deep reveal"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/><line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/></svg></div><div class="deep-txt"><h4>The full rule library</h4><span>Every decoded RBI instrument in one place</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
      <a href="<?php echo esc_url($tracker_url); ?>" class="deep reveal rd1"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg></div><div class="deep-txt"><h4>Enforcement tracker</h4><span>Filter all FY25-26 actions by reason &amp; entity</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
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
      <h3>Get the conduct-package readiness checklist</h3>
      <p>A practical checklist for the 1 January 2027 deadline: what your sales policy, Code of Conduct and consent SOP must contain, who across your network and agents needs to acknowledge them, and the audit-trail evidence to keep ready.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn">Request the checklist <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
    <div class="cv-card buyer reveal rd1">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="cv-kicker">For CCOs, HR &amp; InfoSec leaders</div>
      <h3>See policy attestation tracked across every branch &amp; agent</h3>
      <p>PolicyCentral shows you, live and branch-by-branch, exactly who has read and acknowledged each policy and SOP, with a tamper-evident trail you can export for an RBI review. Walk through it on your own data.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Book a walkthrough <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>
</section>
