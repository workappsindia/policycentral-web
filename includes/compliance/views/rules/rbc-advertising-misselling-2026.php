<?php
/**
 * Decode: RBI (Responsible Business Conduct) Second Amendment Directions, 2026
 *         — Advertising, Marketing & Sale of Financial Products / Services
 * /compliance/rules/rbc-advertising-misselling-2026   (rbi_rule single)
 *
 * Sourced verbatim from the RBI feed (notifications), 15 Jun 2026, effective
 * 1 Jan 2027. Worked reference = Commercial Banks notification id=13485
 * (RBI/2026-27/115, s.35A Banking Regulation Act 1949), paragraphs 85A–85ZA
 * and Annex IIA. The SAME framework is issued to all ten regulated-entity
 * classes (banks, SFBs, PBs, LABs, RRBs, UCBs, RCBs, AIFIs, NBFCs, HFCs);
 * for NBFCs/HFCs the identical obligations sit at paragraphs 101A–101ZA of the
 * NBFC RBC Directions, 2025. Raw notification bodies captured at
 * compliance-build/rbc-ufs-2026-source/ (pulled 2026-06-24). All clause numbers
 * cited are real (Commercial Banks numbering); nothing generalised or invented.
 */
defined('ABSPATH') || exit;

$rbi_url = 'https://rbi.org.in/scripts/BS_PressReleaseDisplay.aspx?prid=62938'; // umbrella press release (all 17 notifications)
$cb_url  = 'https://rbi.org.in/Scripts/NotificationUser.aspx?Id=13485&Mode=0';  // worked reference: Commercial Banks
$hub_url = home_url('/compliance/customer-protection/');
$track   = home_url('/compliance/enforcement-tracker/');
?>
<section id="rule-head">
<div class="rh-mesh"></div>
<div class="container">
  <div class="rh-inner">
    <h1>RBI <span class="g-text">(Responsible Business Conduct)</span> Second Amendment Directions, 2026</h1>
    <p class="lede">RBI's new rulebook on how regulated entities may advertise, market and sell financial products — their own and third-party — issued on 15 June 2026 and effective 1 January 2027. It codifies a Direct Selling / Marketing Agent regime, hard-codes consent and disclosure, bans eleven named "dark patterns", and lays down what counts as mis-selling and what a customer is owed when it happens. One framework, issued to all ten regulated-entity classes.</p>
    <div class="rh-actions">
      <a href="<?php echo esc_url($hub_url); ?>" class="btn btn-secondary">← Back to the hub</a>
      <a href="<?php echo esc_url($rbi_url); ?>" target="_blank" rel="noopener" class="btn btn-primary">Read on rbi.org.in <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></a>
    </div>
    <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Rule Library', 'url' => home_url('/compliance/rules/')), array('label' => 'Responsible Business Conduct Amendment, 2026'))); ?>
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
      <li><a href="#darkpatterns" class="toc-link">The 11 dark patterns</a></li>
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
        <div class="metabox-row"><span class="k">Instrument</span><span class="v">RBC Second Amendment Directions, 2026</span></div>
        <div class="metabox-row"><span class="k">Issued</span><span class="v">15 Jun 2026</span></div>
        <div class="metabox-row"><span class="k">Effective</span><span class="v">1 Jan 2027</span></div>
        <div class="metabox-row"><span class="k">Power</span><span class="v">s. 35A, BR Act 1949 (+ entity-specific powers)</span></div>
        <div class="metabox-row"><span class="k">Applies to</span><span class="v">10 RE classes — banks to NBFCs &amp; HFCs</span></div>
        <div class="metabox-row"><span class="k">Last reviewed</span><span class="v">Jun 2026</span></div>
      </div>
    </div>

    <section class="sec" id="summary">
      <div class="tldr">
        <div class="tldr-h"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>In one line</div>
        <p>From <strong>1 January 2027</strong>, any regulated entity that advertises, markets or sells a financial product — its own or a third party's — must do it under a Board-approved policy, take <strong>explicit, defaulted-to-"No" consent</strong>, disclose fees and risks upfront, keep a <strong>public list of its selling agents</strong>, keep its app and website free of <strong>eleven named "dark patterns"</strong>, and <strong>refund and compensate in full</strong> where mis-selling is established.</p>
      </div>
      <p>On 15 June 2026 RBI consolidated its advertising, marketing and sale rules into the <strong>Responsible Business Conduct (RBC) Directions, 2025</strong> via a Second Amendment, and issued the <em>same</em> framework as separate notifications to all ten regulated-entity classes. The substance is identical across them; only the paragraph numbering differs by class. This decode states the obligations in plain terms and cites the <strong>Commercial Banks numbering (paragraphs 85A–85ZA, Annex IIA)</strong> as the worked reference.</p>
    </section>

    <section class="sec" id="applies">
      <div class="sec-eyebrow"><span>Scope</span></div>
      <h2>Who it applies to</h2>
      <p>The same Second Amendment was issued, on 15 June 2026, to <b>ten regulated-entity classes</b> — each amending that class's own Responsible Business Conduct Directions, 2025:</p>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Commercial Banks</b> (other than SFBs, Payments Banks, RRBs and Local Area Banks), and separately <b>Small Finance Banks</b>, <b>Payments Banks</b>, <b>Local Area Banks</b> and <b>Regional Rural Banks</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Urban Co-operative Banks</b> and <b>Rural Co-operative Banks</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>All India Financial Institutions</b> (EXIM Bank, NABARD, NHB, SIDBI, NaBFID).</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>NBFCs</b> — excluding Core Investment Companies, NBFC-Account Aggregators, NOFHCs and NBFCs with no customer interface; the rules additionally extend to <b>NBFC-P2P</b>, <b>Mortgage Guarantee Companies</b> and <b>Standalone Primary Dealers</b>.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span><b>Housing Finance Companies</b> — which RBI folds straight into the NBFC framework: an HFC must comply with paragraphs 101A–101ZA of the NBFC RBC Directions, 2025.</span></li>
      </ul>
      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span>For banks the rules land at paragraphs <b>85A–85ZA</b>; for NBFCs and HFCs the identical set sits at paragraphs <b>101A–101ZA</b>. The obligations below are common to all.</span>
      </div>
    </section>

    <section class="sec" id="obligations">
      <div class="sec-eyebrow"><span>The requirements</span></div>
      <h2>What it requires</h2>
      <p>Grouped by what each obligation is about. Described in plain terms; verify the exact clause text against the source before acting.</p>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><h3>A Board-approved policy (Para 85A–85B)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>One policy covering own and third-party products</h4><p>A comprehensive policy for advertising, marketing and sale of both own and third-party products — covering how suitability and appropriateness are judged, the customer-feedback mechanism, and compensation where mis-selling occurs.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Cover the selling-agent lifecycle</h4><p>If the entity uses Direct Selling / Marketing Agents, the policy must also set their eligibility criteria, pre- and post-engagement due diligence, sub-agent training, what activities they may be assigned, performance standards, inspection/audit, controls and the penal action for non-compliance.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div><h3>Direct Selling / Marketing Agents (Para 85C–85F, 85O)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>A public, current list of agents</h4><p>Maintain and <b>display on the website</b> an up-to-date list of empanelled DSAs/DMAs — name, type (corporate/individual), address, period of engagement and products handled — and <b>update it within seven calendar days</b> of any change. The definition deliberately catches BCs, Loan Service Providers and the like, whatever they are called.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Identifiable, qualified, bound by a Code of Conduct</h4><p>Any agent, sub-agent or third-party-provider representative present in the entity's premises must be <b>clearly distinguishable from staff</b>, with 'on person' identification, and must hold any qualification the relevant regulator prescribes. A Code of Conduct binds staff, agents, sub-agents and provider representatives; the entity must take a signed undertaking to abide by it and publish the Code on its website.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>No impersonation</h4><p>Agents must not mislead customers about who they are, and sub-agents or provider representatives must not pass themselves off as the entity's own employees.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div><h3>Consent &amp; disclosure (Para 85G–85I)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Explicit consent, per product</h4><p>Sell only with the customer's <b>explicit consent</b> — a signed declaration, OTP approval, digitally recorded confirmation or a clearly demarcated consent block in the agreement. Where one form covers several products, each must be listed separately and the customer able to pick only what they want. Consent records must be kept for <b>one year after the contract ends</b>.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Key features, drawn to attention</h4><p>Before consent, prominently disclose fees/charges/interest, risks, the financial commitment, lock-in, and exit terms including penalties. Where RBI or another regulator prescribes a format — a <b>Key Facts Statement (KFS)</b> or <b>Most Important Terms &amp; Conditions (MITC)</b> — that format must be used.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Default to "No"</h4><p>A consent interface must not let the user proceed without passing through the applicable terms, and the <b>default choice must be 'No' / 'I do not agree'</b>.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 11l18-5v12L3 14v-3z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg></div><h3>Advertising, marketing &amp; agent conduct (Para 85J–85N)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Never pass a third-party product off as your own</h4><p>An entity must not advertise or market a third-party product/service (TPPS) as its own, and must clarify its role when giving a provider's details to a customer.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Clear, factual promotional material</h4><p>All pamphlets, brochures and digital creatives must be clear and factual and disclose the interest rate and associated fees/charges; terms and conditions must be prominent at every point of sale and digital channel. Promotional alerts may go only to customers who have <b>opted in</b>, and unsubscribing must be <b>easy and simple</b>.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>A conduct code for anyone who sells</h4><p>Staff, agents, sub-agents and provider representatives must disclose fees/rates upfront, share full terms, contact customers <b>only between 09:00 and 19:00</b> (unless the customer asked otherwise), honour "Do Not Disturb", respect privacy, not visit homes without consent, and <b>not mislead, coerce or make false commitments</b>.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div><h3>Suitability &amp; documentation (Para 85P–85T)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Assess suitability before selling</h4><p>Except for products the policy treats as suitable for everyone, suitability and appropriateness must be assessed — product features, risk-return, horizon, complexity and fees against the customer's age, income, financial literacy and risk tolerance — using any regulator-prescribed assessment.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Product-specific forms, regional language, acknowledgement</h4><p>Use a specific application form per product that names its nature (loan, deposit, insurance, mutual fund, pension, hybrid) and features; in a multi-product digital form, separate each product and take consent for each. Documents must be available in the customer's language; an acknowledgement with a contact number must follow each application; and the signed terms must be handed to the customer on completion.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-em"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg></div><h3>Preventing mis-selling (Para 85U–85X)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>No incentives that drive mis-selling</h4><p>Policies and practices must not create incentives to mis-sell, and <b>no employee may receive any incentive, direct or indirect, from a third-party provider</b> for selling its product.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>No compulsory bundling, no funding without consent</h4><p>An entity must not compulsorily bundle a third-party product with its own. Where a third-party product is genuinely needed as a risk mitigant, the customer must be free to buy it from <b>any</b> provider. And it must not fund a purchase out of a sanctioned loan <b>without the customer's explicit consent</b>.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>No dark patterns in any interface</h4><p>The entity and its agents must ensure their user interfaces deploy <b>no dark patterns</b>, subject to user testing and periodic internal audit, and must follow the CCPA's <b>Guidelines for Prevention and Regulation of Dark Patterns, 2023</b>. RBI's illustrative list of eleven is below.</p></div></div>
        </div>
      </div>

      <div class="obgroup">
        <div class="obgroup-head"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div><h3>Feedback &amp; redress (Para 85Y–85Z)</h3></div>
        <div class="obgroup-body">
          <div class="obrow"><div class="otxt"><h4>Feedback within 30 days, reviewed half-yearly</h4><p>Seek customer feedback within <b>30 days</b> of a sale — via call-backs or surveys run by a team not involved in selling — to confirm the customer understood the product and its risks, and prepare a <b>half-yearly report</b> that feeds back into policy.</p></div></div>
          <div class="obrow"><div class="otxt"><h4>Full refund and compensation on mis-selling</h4><p>A customer may complain within the regulator-specified window, or within <b>30 days</b> of receiving the signed terms if none is specified. Where mis-selling is established, the entity must <b>refund the entire amount paid</b>, cancel the sale where applicable, and <b>compensate the customer for any loss</b> per its approved policy.</p></div></div>
        </div>
      </div>

      <div class="note-row">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>Entities must also comply with TRAI/DoT rules on commercial communication (e.g. <b>TCCCPR 2018</b>) and with SEBI, IRDAI and PFRDA rules for products in their domains (Para 85ZA).</span>
      </div>
    </section>

    <section class="sec" id="darkpatterns">
      <div class="sec-eyebrow"><span>Annex IIA</span></div>
      <h2>The 11 dark patterns RBI named</h2>
      <p>RBI's illustrative list of deceptive interface designs a bank or its agents must not deploy. Plain-language summaries of each — see Annex IIA of the notification for the full text and illustrations.</p>
      <div class="obl-grid">
        <div class="obl reveal"><div class="obl-num">01</div><h4>False Urgency</h4><p>Faking scarcity or a deadline — countdown timers, "rate rises if you don't act now" — to push an immediate decision.</p></div>
        <div class="obl reveal rd1"><div class="obl-num">02</div><h4>Basket Sneaking</h4><p>Slipping extra items into checkout without consent, e.g. defaulting loan-protection insurance into a loan application.</p></div>
        <div class="obl reveal rd2"><div class="obl-num">03</div><h4>Confirm Shaming</h4><p>Guilt-tripping the user out of declining — "No, I don't want extra security for my account" — to subvert their choice.</p></div>
        <div class="obl reveal"><div class="obl-num">04</div><h4>Forced Action</h4><p>Forcing an unrelated purchase, sign-up or data-sharing to get the thing actually wanted, e.g. unclosable pop-ups that redirect to a loan page.</p></div>
        <div class="obl reveal rd1"><div class="obl-num">05</div><h4>Subscription Trap</h4><p>Easy to sign up, hard to cancel — hidden or multi-step cancellation, or demanding card details for a "free" subscription.</p></div>
        <div class="obl reveal rd2"><div class="obl-num">06</div><h4>Interface Interference</h4><p>Highlighting the entity's preferred option and burying the rest — bold "Yes", defaulted consent, account-closure buried deep.</p></div>
        <div class="obl reveal"><div class="obl-num">07</div><h4>Bait and Switch</h4><p>Advertising one outcome and delivering another — a low headline rate that climbs at application, undisclosed processing fees.</p></div>
        <div class="obl reveal rd1"><div class="obl-num">08</div><h4>Drip Pricing</h4><p>Revealing charges late or post-purchase, or advertising "free" when continued use needs payment.</p></div>
        <div class="obl reveal rd2"><div class="obl-num">09</div><h4>Disguised Advertisement</h4><p>Ads dressed as alerts, updates or content — a "push notification" that is really a promotion, or self-serving search ranking.</p></div>
        <div class="obl reveal"><div class="obl-num">10</div><h4>Nagging</h4><p>Repeated, persistent prompts after a refusal — re-asking for cookie consent, blocking exit until an option is chosen.</p></div>
        <div class="obl reveal rd1"><div class="obl-num">11</div><h4>Trick Wording</h4><p>Confusing language or double negatives that misdirect — "Uncheck this box if you do not want to receive offers".</p></div>
      </div>
    </section>

    <section class="sec" id="changed">
      <div class="sec-eyebrow"><span>For 2025 adopters</span></div>
      <h2>What changed from the 2025 Directions</h2>
      <p>If your framework was built on the Responsible Business Conduct Directions, 2025, these are the moves that matter:</p>
      <ul class="applies">
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Advertising, marketing and sale rules — previously sitting under the <b>Undertaking of Financial Services Directions, 2025</b> — are now <b>consolidated into the RBC Directions</b> as a new section (Para 85A–85ZA for banks).</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>New definitions of <b>Dark pattern</b>, <b>Compulsory bundling</b>, <b>Mis-selling</b>, <b>Explicit consent</b>, <b>DSA/DMA &amp; sub-agent</b> and <b>Third-party Product or Service</b> are inserted into the definitions paragraph.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>A brand-new <b>Annex IIA</b> sets out the eleven illustrative dark patterns relevant to banks.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>A companion amendment to the Undertaking of Financial Services Directions redraws <b>agency business and referral services</b> (decoded separately) — the two were issued together on 15 June 2026.</span></li>
        <li><span class="chk"><svg viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="2 6 5 9 10 3"/></svg></span><span>Everything takes effect on <b>1 January 2027</b> — a runway, not an immediate switch.</span></li>
      </ul>
    </section>

    <section class="sec" id="penalised">
      <div class="sec-eyebrow"><span>Enforcement</span></div>
      <h2>What RBI has penalised on conduct &amp; mis-selling</h2>
      <?php $pen = pcc_render_penalised_for_rule('rbc-advertising-misselling-2026'); ?>
      <?php if ($pen) : ?>
      <p>Each entry states only the reason cited in the RBI press release; where a penalty covered several issues, the amount is the total and isn't attributable to any single reason.</p>
      <div class="pen-grid"><?php echo $pen; ?></div>
      <?php else : ?>
      <p>This Amendment takes effect on <b>1 January 2027</b>, so there is no enforcement under it yet. RBI has, however, long penalised regulated entities under the broader fair-practices and customer-conduct umbrella — mis-selling of third-party products, opaque charges and conduct of recovery/marketing agents. As the tracker fills with FY-relevant actions, the ones citing these failures will appear here.</p>
      <?php endif; ?>
      <div style="margin-top:18px"><a href="<?php echo esc_url($track . '?theme=customer-protection'); ?>" class="btn btn-secondary">See all in the enforcement tracker <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a></div>
    </section>

    <section class="sec" id="background">
      <div class="sec-eyebrow"><span>Context</span></div>
      <h2>Background &amp; lineage</h2>
      <p>RBI has been consolidating entity-wise rulebooks; the Responsible Business Conduct framework is where customer-facing conduct now lives.</p>
      <ul class="lineage">
        <li><span class="yr">2023</span><b>CCPA Guidelines for Prevention and Regulation of Dark Patterns</b> — the consumer-protection baseline RBI now points banks to.</li>
        <li><span class="yr">2025</span><b>RBI (Responsible Business Conduct) Directions, 2025</b> and the companion <b>Undertaking of Financial Services Directions, 2025</b>, issued entity-class-wise.</li>
        <li class="now"><span class="yr">15 Jun 2026</span><b>RBC Second Amendment Directions, 2026</b> — advertising, marketing, sale, DSA/DMA, dark patterns and mis-selling, across all ten classes; <b>effective 1 Jan 2027</b>.</li>
      </ul>
    </section>

    <div class="opcallout">
      <div class="ib"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg></div>
      <div class="opcallout-t"><h3>Knowing the rule is step one</h3><p>A Code of Conduct, a consent SOP and an agent-handling policy only work if every branch, agent and sub-agent has actually received and acknowledged them.</p></div>
      <a href="<?php echo esc_url($hub_url . '#prevention'); ?>" class="btn btn-primary">How it stays audit-ready <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>

    <section class="sec" id="source" style="margin-top:48px">
      <div class="srcbox">
        <h3><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>Source &amp; version</h3>
        <div class="src-row"><span class="k">Worked reference</span><span class="v">RBI (Commercial Banks - Responsible Business Conduct) Second Amendment Directions, 2026</span></div>
        <div class="src-row"><span class="k">Reference no.</span><span class="v">RBI/2026-27/115 · DOR.MCS.REC.No.94/01-01-032/2026-27</span></div>
        <div class="src-row"><span class="k">Date of issue</span><span class="v">15 June 2026</span></div>
        <div class="src-row"><span class="k">Effective</span><span class="v">1 January 2027</span></div>
        <div class="src-row"><span class="k">Scope</span><span class="v">Issued as 10 entity-class notifications (commercial/SF/payments/local-area banks, RRBs, UCBs, RCBs, AIFIs, NBFCs, HFCs)</span></div>
        <div class="src-row"><span class="k">Official source</span><a class="v" href="<?php echo esc_url($cb_url); ?>" target="_blank" rel="noopener">rbi.org.in — Commercial Banks notification →</a></div>
        <div class="src-row"><span class="k">All notifications</span><a class="v" href="<?php echo esc_url($rbi_url); ?>" target="_blank" rel="noopener">rbi.org.in — press release (links to all 17) →</a></div>
        <div class="src-row"><span class="k">This decode last reviewed</span><span class="v">June 2026</span></div>
        <div class="disc-line">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          <span>This is a plain-language summary to aid understanding, not legal advice. Clause numbers cited are the Commercial Banks numbering; NBFCs/HFCs carry the same obligations at paragraphs 101A–101ZA. RBI instruments are amended over time — always verify against the original on rbi.org.in and consult your compliance and legal teams before acting.</span>
        </div>
      </div>
    </section>
  </main>
</div>
</div>
