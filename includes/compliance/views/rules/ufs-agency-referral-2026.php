<?php
/**
 * Decode: RBI (Undertaking of Financial Services) Amendment Directions, 2026
 *        Agency Business & Referral Services
 * /compliance/rules/ufs-agency-referral-2026   (rbi_rule single)
 *
 * Sourced verbatim from the RBI feed (notifications), 15 Jun 2026, effective
 * 1 Jan 2027. Worked reference = Commercial Banks notification id=13495
 * (RBI/DoR/2026-27/125, Third Amendment, s.35A Banking Regulation Act 1949),
 * paragraphs 4, 52, 58 and 62. The companion to the RBC advertising/mis-selling
 * amendment; conduct aspects move to the RBC Directions, this one redraws how
 * agency and referral arrangements with third-party providers may operate.
 * Issued to seven entity classes (commercial/SF/payments banks, RRBs, UCBs,
 * RCBs, NBFCs); for NBFCs the parallel sits in their UFS Directions (e.g. the
 * insurance-distribution conditions at paragraph 32 of id=13501). Raw bodies at
 * compliance-build/rbc-ufs-2026-source/ (pulled 2026-06-24). All clause numbers
 * cited are real (Commercial Banks numbering); nothing generalised or invented.
 */
defined('ABSPATH') || exit;

$rbi_url = 'https://rbi.org.in/scripts/BS_PressReleaseDisplay.aspx?prid=62938'; // umbrella press release
$cb_url  = 'https://rbi.org.in/Scripts/NotificationUser.aspx?Id=13495&Mode=0';  // worked reference: Commercial Banks UFS
$hub_url = home_url('/compliance/customer-protection/');
$track   = home_url('/compliance/enforcement-tracker/');
?>
<section id="rule-head">
<div class="rh-mesh"></div>
<div class="container">
  <div class="rh-inner">
    <h1>RBI <span class="g-text">(Undertaking of Financial Services)</span> Amendment Directions, 2026</h1>
    <p class="lede">RBI's companion amendment redrawing how a regulated entity may sell or point customers to a third party's financial products: the line between an <strong>agency arrangement</strong> (fee-based, no risk participation) and a <strong>referral arrangement</strong> (introduce only, never sell). Issued on 15 June 2026, effective 1 January 2027, alongside the Responsible Business Conduct amendment.</p>
    <div class="rh-actions">
      <a href="<?php echo esc_url($hub_url); ?>" class="btn btn-secondary">← Back to the hub</a>
      <a href="<?php echo esc_url($rbi_url); ?>" target="_blank" rel="noopener" class="btn btn-primary">Read on rbi.org.in <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></a>
    </div>
    <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Rule Library', 'url' => home_url('/compliance/rules/')), array('label' => 'Agency & Referral Amendment, 2026'))); ?>
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
      <li><a href="#changed" class="toc-link">What changed</a></li>
      <li><a href="#penalised" class="toc-link">What RBI penalised</a></li>
      <li><a href="#background" class="toc-link">Background &amp; lineage</a></li>
      <li><a href="#source" class="toc-link">Source &amp; version</a></li>
    </ul>
  </aside>

  <main class="body-col">
    <div class="metabox">
      <div class="metabox-head">Reference</div>
      <div class="metabox-body">
        <div class="metabox-row"><span class="k">Instrument</span><span class="v">UFS Amendment Directions, 2026</span></div>
        <div class="metabox-row"><span class="k">Issued</span><span class="v">15 Jun 2026</span></div>
        <div class="metabox-row"><span class="k">Effective</span><span class="v">1 Jan 2027</span></div>
        <div class="metabox-row"><span class="k">Power</span><span class="v">s. 35A, BR Act 1949 (+ entity-specific powers)</span></div>
        <div class="metabox-row"><span class="k">Applies to</span><span class="v">7 RE classes: banks, co-ops &amp; NBFCs</span></div>
        <div class="metabox-row"><span class="k">Last reviewed</span><span class="v">Jun 2026</span></div>
      </div>
    </div>

    <section class="sec" id="summary">
      <div class="tldr">
        <div class="tldr-h"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>In one line</div>
        <p>If you sell a third party's product as their agent, it must be on a <strong>fee basis with no risk participation</strong>, disclosed upfront, and limited to <strong>regulated</strong> products. If you only <strong>refer</strong> customers to one, you must not sell, must not put your brand on their documents, must not build their journey into your app. Just <strong>introduce and redirect</strong>. Effective <strong>1 January 2027</strong>.</p>
      </div>
      <p>This Third Amendment to the <strong>Undertaking of Financial Services (UFS) Directions, 2025</strong> reworks two definitions and the operative rules for <strong>agency business</strong> and <strong>referral services</strong>, while the customer-facing conduct rules move across to the <a href="<?php echo esc_url(home_url('/compliance/rules/rbc-advertising-misselling-2026/')); ?>">Responsible Business Conduct amendment</a>. This decode states the rules in plain terms and cites the <strong>Commercial Banks numbering (paragraphs 4, 52, 58, 62)</strong> as the worked reference.</p>
    </section>

    <section class="sec" id="applies">
      <div class="sec-eyebrow"><span>Scope</span></div>
      <h2>Who it applies to</h2>
      <p>The same amendment was issued, on 15 June 2026, to <b>seven regulated-entity classes</b>, each amending that class's own Undertaking of Financial Services Directions, 2025:</p>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial Banks</b>, <b>Small Finance Banks</b> and <b>Payments Banks</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Regional Rural Banks</b>, <b>Urban Co-operative Banks</b> and <b>Rural Co-operative Banks</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFCs</b>, where the same agency redraw applies, with insurance distribution conditions at paragraph 32 of the NBFC UFS Directions.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>This is the agency/referral half of the 15 June 2026 package; the advertising, mis-selling and dark-patterns half is the <a href="<?php echo esc_url(home_url('/compliance/rules/rbc-advertising-misselling-2026/')); ?>">Responsible Business Conduct amendment</a>.</span>
      </div>
    </section>

    <section class="sec" id="obligations">
      <div class="sec-eyebrow"><span>The requirements</span></div>
      <h2>What it requires</h2>
      <p>Grouped by what each obligation is about. Described in plain terms; verify the exact clause text against the source before acting.</p>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg></div><h3>Agency business (Para 4(1), 58)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Agent, not risk-taker</h4><p>Agency business means acting as agent of a third-party provider (TPPSP) <b>without risk participation</b>, to facilitate the sale of their financial products (insurance, mutual fund, pension and the like) to your own customers. It must be on a <b>fee basis with no risk participation, explicitly disclosed upfront</b> to customers.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Regulated products only, listed transparently</h4><p>You may deal only with <b>regulated financial products and services</b> you are permitted to deal in under Section 6(1) of the Banking Regulation Act; only products covered by the arrangement may be listed or displayed on your website, app or other digital channels.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>A written agreement + provider grievance redressal</h4><p>Enter an agreement with the TPPSP for the sale of only regulated products, ensure the provider has <b>robust customer-grievance-redressal</b> arrangements (the entity may facilitate redressal), and remain in full compliance with the Responsible Business Conduct Directions, 2025. A bank may also act as an <b>insurance broker departmentally</b> (Para 52), subject to these agency conditions.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="7" y1="17" x2="17" y2="7"/><polyline points="7 7 17 7 17 17"/></svg></div><h3>Referral services (Para 4(17), 62)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Introduce only, never sell</h4><p>Referral means making information about a TPPSP's products available to your customers. The role must be <b>purely referral</b>: you may market and refer, <b>but not sell</b>, under a referral arrangement, and you must make that explicitly clear upfront through a disclaimer. The route is open only where there is <b>no continued customer interaction</b> (distribution, grievance redressal, post-sale service).</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Your brand off their documents</h4><p>The entity's <b>name or brand must not feature</b> in any of the third party's product or service documents.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>No embedded journeys, just a redirect</h4><p>No third-party processes may be integrated into your platform, carried out on your premises (unless specifically permitted), or offered as a micro-site or micro-app: <b>only an access link that redirects</b> the customer to the TPPSP. The list of referral products must be <b>published on your digital channels</b> for transparency.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Diligence on who you refer</h4><p>Select the TPPSP with proper due diligence for the reputational risk you take on, and ensure the provider has <b>robust grievance-redressal</b> arrangements.</p></div></div>
        </div>
      </div>
    </section>

    <section class="sec" id="changed">
      <div class="sec-eyebrow"><span>For 2025 adopters</span></div>
      <h2>What changed from the 2025 Directions</h2>
      <p>If your framework was built on the Undertaking of Financial Services Directions, 2025, these are the moves that matter:</p>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Agency Business</b> and <b>Referral Services</b> are redefined (Para 4), and new definitions of <b>Regulated financial products and services</b>, <b>TPPS</b> and <b>TPPSP</b> are inserted.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Customer-service and conduct instructions move out of the UFS Directions and are <b>consolidated into the Responsible Business Conduct Directions, 2025</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Several paragraphs are <b>omitted</b> (for Commercial Banks: Para 7(1) and (2), 8, 59 to 61), and 52, 58 and 62 are substituted with the agency/referral rules above.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>The referral route is now <b>explicitly sale-free and brand-free</b>, with embedded micro-sites/micro-apps ruled out: a meaningful tightening for digital distribution partnerships.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Effective <b>1 January 2027</b>.</span></li>
      </ul>
    </section>

    <section class="sec" id="penalised">
      <div class="sec-eyebrow"><span>Enforcement</span></div>
      <h2>What RBI has penalised on third-party distribution</h2>
      <?php $pen = pcc_render_penalised_for_rule('ufs-agency-referral-2026'); ?>
      <?php if ($pen) : ?>
      <p>Each entry states only the reason cited in the RBI press release; where a penalty covered several issues, the amount is the total and isn't attributable to any single reason.</p>
      <div class="pen-grid"><?php echo $pen; ?></div>
      <?php else : ?>
      <p>This Amendment takes effect on <b>1 January 2027</b>, so there is no enforcement under it yet. RBI has historically acted where banks blurred the agency/referral line: selling third-party products as their own, or carrying risk they were not meant to. As the tracker fills with FY-relevant actions, the ones citing these failures will appear here.</p>
      <?php endif; ?>
      <div style="margin-top:18px"><a href="<?php echo esc_url($track . '?theme=customer-protection'); ?>" class="btn btn-secondary">See all in the enforcement tracker <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a></div>
    </section>

    <section class="sec" id="background">
      <div class="sec-eyebrow"><span>Context</span></div>
      <h2>Background &amp; lineage</h2>
      <p>Agency and referral arrangements are how regulated entities have long distributed insurance, mutual funds and pension products; this amendment sharpens the boundary.</p>
      <ul class="lineage">
        <li><span class="yr">2025</span><b>RBI (Undertaking of Financial Services) Directions, 2025</b>, issued entity-class-wise, with the original agency/referral framework.</li>
        <li class="now"><span class="yr">15 Jun 2026</span><b>UFS Amendment Directions, 2026</b>: agency business &amp; referral services redrawn across seven classes, issued with the RBC amendment; <b>effective 1 Jan 2027</b>.</li>
      </ul>
    </section>

    <div class="opcallout">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="opcallout-t"><h3>The boundary lives in your processes</h3><p>The agency/referral line is only as clean as the SOPs your branch and digital teams actually follow. Distribute the rule, prove it was acknowledged.</p></div>
      <a href="<?php echo esc_url($hub_url . '#prevention'); ?>" class="btn btn-primary">How it stays audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>

    <section class="sec" id="source" style="margin-top:48px">
      <div class="srcbox">
        <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Source &amp; version</h3>
        <div class="src-row"><span class="k">Worked reference</span><span class="v">RBI (Commercial Banks, Undertaking of Financial Services) Third Amendment Directions, 2026</span></div>
        <div class="src-row"><span class="k">Reference no.</span><span class="v">RBI/DoR/2026-27/125 · DOR.RAUG.AUT.REC.No.104/24.01.041/2026-27</span></div>
        <div class="src-row"><span class="k">Date of issue</span><span class="v">15 June 2026</span></div>
        <div class="src-row"><span class="k">Effective</span><span class="v">1 January 2027</span></div>
        <div class="src-row"><span class="k">Scope</span><span class="v">Issued as 7 entity-class notifications (commercial/SF/payments banks, RRBs, UCBs, RCBs, NBFCs)</span></div>
        <div class="src-row"><span class="k">Official source</span><a class="v" href="<?php echo esc_url($cb_url); ?>" target="_blank" rel="noopener">rbi.org.in, Commercial Banks notification →</a></div>
        <div class="src-row"><span class="k">All notifications</span><a class="v" href="<?php echo esc_url($rbi_url); ?>" target="_blank" rel="noopener">rbi.org.in, press release (links to all 17) →</a></div>
        <div class="src-row"><span class="k">This decode last reviewed</span><span class="v">June 2026</span></div>
        <div class="disc-line">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <span>This is a plain-language summary to aid understanding, not legal advice. Clause numbers cited are the Commercial Banks numbering; other classes carry equivalent provisions under their own UFS Directions. RBI instruments are amended over time, always verify against the original on rbi.org.in and consult your compliance and legal teams before acting.</span>
        </div>
      </div>
    </section>
  </main>
</div>
</div>
