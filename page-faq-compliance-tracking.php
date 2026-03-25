<?php
/**
 * Template Name: FAQ - Compliance & Tracking
 */
get_header(); ?>

<section class="faq-hero">
<div class="container">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faq/')); ?>">FAQs</a></div>
  <div class="faq-tag">Compliance &amp; Tracking FAQs</div>
  <h1>How attestation, read receipts, and <em>audit trails</em> work</h1>
  <p>Practical answers about tracking who has read what, how attestation is enforced, and what documentation regulators will see.</p>
</div>
</section>

<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#receipts">Read Receipts &amp; Attestation</a>
      <a href="#esign">E-Signatures &amp; Legal Validity</a>
    </nav>
    <div class="sidebar-sep"></div>
    <div class="sidebar-label">9 Questions total</div>
    <div class="sidebar-box"><p>Still have questions? Talk to our team.</p><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></div>
  </aside>

  <div class="faq-content">
    <div class="content-header"><div class="content-icon">✅</div><div><p>Practical answers about tracking who has read what, how attestation is enforced, and what documentation regulators will see.</p></div></div>

    <div class="faq-section" data-sec="receipts" id="receipts">
      <div class="section-title"><span>📋</span> Read Receipts &amp; Attestation</div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does read receipt tracking work technically?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">When an employee opens a policy, a read receipt is automatically captured, including timestamp, device type, and employee profile details. This happens passively without any employee action. The read event is recorded the moment policy content loads. Acknowledgment actions (Understood, Accept, Not Clear, e-sign) are additional, layered on top. Two-layer approach: <strong>exposure</strong> (did they see it?) and <strong>acceptance</strong> (did they confirm it?) are tracked separately.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What is the difference between a Read Receipt and an Attestation?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">A <strong>Read Receipt</strong> records that an employee opened the policy, passive, automatic, no employee action needed. An <strong>Attestation</strong> is an active confirmation: "Understood" (simple acknowledgment), "Accept" (formal agreement to comply), "Not Clear" (flags a comprehension issue), Aadhaar-based e-sign (biometric-linked signature), or AD password signature. For most HR policies, read receipt + "Understood" is sufficient. For AML, code of conduct, and InfoSec policies, Aadhaar e-sign creates a legally defensible record.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How do we handle employees who consistently don't read policies?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Layered escalation workflow: <strong>Step 1:</strong> automated email notification on publish. <strong>Step 2:</strong> mobile push notification for non-openers within a set timeframe. <strong>Step 3:</strong> admin filters "Unread Only" and resends with a single click to that specific cohort. <strong>Step 4:</strong> for critical policies, minimum scroll percentage required before action buttons appear. <strong>Step 5:</strong> compliance dashboard flags non-readers by department and designation, enabling line managers to be looped in.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can attestation data be exported for regulatory audits?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. All read receipt and attestation data is exportable as reports: by policy, by employee, by department, by time period. Reports include: employee name, department, designation, policy title, publish date, read date, time taken, action taken, e-sign record. For RBI, SEBI, IRDAI, internal audit, or external auditor reviews, this provides a complete, timestamped, tamper-evident record of organizational policy awareness.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What happens when a policy is updated - do employees need to re-attest?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Admin-controlled. When publishing a new version, admins choose: require re-attestation from all employees, only from those who attested the previous version, or only from those who didn't. Previous version's attestation records are preserved separately, and the audit trail shows distinct compliance records per version. Critical for regulatory contexts where a policy change (e.g., revised AML procedure) requires documented re-acknowledgment.</div></div></div>
    </div>

    <div class="faq-section" data-sec="esign" id="esign">
      <div class="section-title"><span>✍️</span> E-Signatures &amp; Legal Validity</div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does Aadhaar-based e-sign work, and is it legally valid?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">The platform integrates with Aadhaar-based e-sign APIs compliant with the IT Act 2000 and MeitY's eSign framework. When an employee e-signs, they authenticate using their Aadhaar OTP, linking the signature to their biometric-verified national identity. The resulting signature is <strong>legally valid under Indian law</strong>. For RBI-regulated banks, insurance, and capital market organizations, this creates a level of attestation defensibility that a checkbox or "I Agree" button cannot provide.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What is AD Password Signature?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">An alternative to Aadhaar e-sign: employees re-enter their Active Directory (corporate login) password to confirm policy acceptance. Leverages existing corporate identity infrastructure without requiring Aadhaar enrollment, suitable for organizations where not all employees have linked Aadhaar to their professional profile, or for international contexts. The AD password step creates an enterprise-identity-linked authentication record.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What are the Action Buttons and what compliance record do they create?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">"Action Buttons" is the admin-configurable employee response layer: <strong>Understood</strong> (simple acknowledgment), <strong>Accept</strong> (active agreement to comply), <strong>Not Clear</strong> (employee flags a comprehension issue, which triggers a question collation for admin). When clicked, the timestamp, button chosen, and employee profile are recorded. A high rate of "Not Clear" responses on a specific policy is a leading indicator of a comprehension problem or genuine policy ambiguity.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does the platform handle new joiner compliance automatically?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">PolicyCentral.ai supports <strong>future employee targeting</strong>: when publishing a policy, admins flag it to be automatically distributed to employees who join in the future and match specified profile criteria. When a new joiner is added to HRMS and synced to PolicyCentral.ai, they automatically receive all relevant pending policies for their role, without any manual admin action. Onboarding compliance becomes systematic rather than checklist-dependent.</div></div></div>
    </div>

    <div class="other-cats">
      <h3>Explore other FAQ categories</h3>
      <div class="other-grid">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="other-link"><span class="oi">🏢</span>Company &amp; Platform</a>
        <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="other-link"><span class="oi">🤖</span>AI Capabilities</a>
        <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="other-link"><span class="oi">⚙️</span>Features &amp; Dashboard</a>
        <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="other-link"><span class="oi">📢</span>Publishing &amp; Distribution</a>
        <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="other-link"><span class="oi">🔒</span>Hosting &amp; Security</a>
        <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="other-link"><span class="oi">🚀</span>Implementation &amp; Integration</a>
        <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="other-link"><span class="oi">📈</span>ROI &amp; Business Case</a>
        <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="other-link"><span class="oi">🛡️</span>IT &amp; CISO</a>
        <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="other-link"><span class="oi">💰</span>Pricing &amp; Finance FAQs</a>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
