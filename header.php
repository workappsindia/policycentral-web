<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- NAV -->
<nav id="nav">
<div class="nav-inner">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-logo">
    <div class="nav-logo-mark">
      <svg viewBox="0 2 25 31" fill="none"><path d="M0.979492 20.7623V4.52147C0.979492 3.82771 1.5419 3.2653 2.23565 3.2653H16.9556C17.2832 3.2653 17.5979 3.39332 17.8325 3.62205L23.3682 9.01934C23.6107 9.25576 23.7474 9.58008 23.7474 9.91875V20.8516C23.5953 26.6316 15.8794 31.0856 12.7322 31.9296C12.5425 31.9805 12.3401 31.9741 12.1508 31.9216C4.28629 29.7409 1.44897 23.8644 0.992375 20.9377C0.983212 20.879 0.979492 20.8217 0.979492 20.7623Z" fill="#179D97" stroke="#179D97" stroke-width="1.96"/><path d="M6.72754 17.6674H18.1561" stroke="white" stroke-width="2.51" stroke-linecap="round"/><path d="M6.72754 23.545H18.1561" stroke="white" stroke-width="2.51" stroke-linecap="round"/><path d="M0.979492 20.7623V4.52147C0.979492 3.82771 1.5419 3.2653 2.23565 3.2653H17.4666L23.7474 9.38909V20.8516C23.5953 26.6316 15.8794 31.0856 12.7322 31.9296C12.5425 31.9805 12.3401 31.9741 12.1508 31.9216C4.28629 29.7409 1.44897 23.8644 0.992375 20.9377C0.983212 20.879 0.979492 20.8217 0.979492 20.7623Z" stroke="#179D97" stroke-width="1.96"/><path d="M16.1602 3.59184L23.4206 10.6952H17.4663C16.7449 10.6952 16.1602 10.1104 16.1602 9.38909V3.59184Z" fill="white"/></svg>
    </div>
    <span class="nav-logo-name">Policy<em>Central</em>.ai</span>
  </a>
  <ul class="nav-links">
    <li class="nav-item" style="display:none"><!-- HIDDEN: Re-enable when content ready -->
      <span class="nav-link">Platform<svg class="nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg></span>
      <div class="dropdown">
        <a href="#" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div><div><div class="di-title">Technology Stack</div><div class="di-sub">Infrastructure & architecture</div></div></a>
        <a href="#aws" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17.5 19H9a7 7 0 1 1 6.71-9h1.79a4.5 4.5 0 1 1 0 9z"/></svg></div><div><div class="di-title">Powered by AWS</div><div class="di-sub">Polly, Bedrock, Translate, Lex</div></div></a>
        <a href="#hosting" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div><div><div class="di-title">Hosting & Pricing</div><div class="di-sub">SaaS, cloud & on-premise</div></div></a>
      </div>
    </li>
    <li class="nav-item">
      <a href="<?php echo esc_url(home_url('/features/')); ?>" class="nav-link">Features<svg class="nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg></a>
      <div class="dropdown dw">
        <a href="<?php echo esc_url(home_url('/features/ai-intelligence/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div><div><div class="di-title">AI-Powered Policy Intelligence</div><div class="di-sub">Smart search, summaries, chatbot</div></div></a>
        <a href="<?php echo esc_url(home_url('/features/content-management/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg></div><div><div class="di-title">Policy Creation &amp; Content Management</div><div class="di-sub">Author, version, organize policies</div></div></a>
        <a href="<?php echo esc_url(home_url('/features/publisher-controls/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div><div><div class="di-title">Publisher Controls &amp; Workflow Management</div><div class="di-sub">Approvals, publishing, workflows</div></div></a>
        <div class="drop-hr"></div>
        <a href="<?php echo esc_url(home_url('/features/distribution-targeting/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div><div><div class="di-title">Policy Distribution &amp; Targeting</div><div class="di-sub">Target audiences, push notifications</div></div></a>
        <a href="<?php echo esc_url(home_url('/features/employee-portal/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18" stroke-width="2.5"/></svg></div><div><div class="di-title">Employee Portal &amp; Mobile Experience</div><div class="di-sub">Mobile app, multi-language access</div></div></a>
        <a href="<?php echo esc_url(home_url('/features/employee-interaction/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><div><div class="di-title">Employee Interaction &amp; Acknowledgement</div><div class="di-sub">Read receipts, e-sign, quizzes</div></div></a>
        <div class="drop-hr"></div>
        <a href="<?php echo esc_url(home_url('/features/tracking-reporting/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg></div><div><div class="di-title">Tracking, Analytics &amp; Reporting</div><div class="di-sub">Dashboards, compliance reports</div></div></a>
        <a href="<?php echo esc_url(home_url('/features/enterprise/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div><div><div class="di-title">Enterprise Features</div><div class="di-sub">AD, SSO, white-label, multi-entity</div></div></a>
        <a href="<?php echo esc_url(home_url('/features/security-compliance/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div><div class="di-title">Banking-Grade Security &amp; Compliance</div><div class="di-sub">Encryption, RBAC, audit logs</div></div></a>
      </div>
    </li>
    <li class="nav-item" style="display:none"><!-- HIDDEN: Re-enable when content ready -->
      <span class="nav-link">Use Cases<svg class="nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg></span>
      <div class="dropdown dw">
        <a href="#usecases" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div><div class="di-title">Policy Management</div><div class="di-sub">Host, version &amp; distribute policies</div></div></a>
        <a href="#usecases" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div><div><div class="di-title">Corporate Updates</div><div class="di-sub">Leadership &amp; board communications</div></div></a>
        <a href="#usecases" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg></div><div><div class="di-title">Product Information</div><div class="di-sub">Product docs &amp; guidelines</div></div></a>
        <div class="drop-hr"></div>
        <a href="#usecases" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 11 12 14 22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg></div><div><div class="di-title">SOPs</div><div class="di-sub">Standardised operating procedures</div></div></a>
        <a href="#usecases" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div><div><div class="di-title">Branch Circulars</div><div class="di-sub">Region &amp; branch-level notices</div></div></a>
        <a href="#usecases" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div><div><div class="di-title">Business Req. Docs</div><div class="di-sub">BRDs, specs &amp; project docs</div></div></a>
      </div>
    </li>
    <li class="nav-item">
      <a href="<?php echo esc_url(home_url('/faq/')); ?>" class="nav-link">FAQs<svg class="nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg></a>
      <div class="dropdown dw">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg></div><div><div class="di-title">Company &amp; Platform</div><div class="di-sub">About PolicyCentral.ai</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg></div><div><div class="di-title">AI Capabilities</div><div class="di-sub">AI search, summaries &amp; chatbot</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg></div><div><div class="di-title">Features &amp; Dashboard</div><div class="di-sub">Platform capabilities deep-dive</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg></div><div><div class="di-title">Compliance &amp; Tracking</div><div class="di-sub">Attestation, audit trails</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 2L11 13"/><path d="M22 2L15 22 11 13 2 9l20-7z"/></svg></div><div><div class="di-title">Publishing &amp; Distribution</div><div class="di-sub">Targeting, versioning policies</div></div></a>
        <div class="drop-hr"></div>
        <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg></div><div><div class="di-title">Hosting &amp; Security</div><div class="di-sub">Deployment, data, certifications</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div><div><div class="di-title">Implementation &amp; Integration</div><div class="di-sub">Setup, HRMS, data migration</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div><div><div class="di-title">ROI &amp; Business Case</div><div class="di-sub">Cost savings, business value</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="8" rx="2"/><rect x="2" y="14" width="20" height="8" rx="2"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg></div><div><div class="di-title">IT &amp; CISO</div><div class="di-sub">Security, access, vendor risk</div></div></a>
        <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div><div><div class="di-title">Pricing &amp; Finance</div><div class="di-sub">TCO, pricing, contract terms</div></div></a>
      </div>
    </li>
    <li class="nav-item">
      <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link">About<svg class="nav-chevron" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><polyline points="4 6 8 10 12 6"/></svg></a>
      <div class="dropdown">
        <a href="<?php echo esc_url(home_url('/team/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/></svg></div><div><div class="di-title">Team</div><div class="di-sub">The people behind PolicyCentral</div></div></a>
        <a href="<?php echo esc_url(home_url('/culture/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg></div><div><div class="di-title">Our Culture</div><div class="di-sub">How we work &amp; what we value</div></div></a>
        <div class="drop-hr"></div>
        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="di"><div class="di-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg></div><div><div class="di-title">Contact Us</div><div class="di-sub">Talk to us about a demo or pilot</div></div></a>
      </div>
    </li>
    <li class="mob-nav-cta">
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary" style="width:100%;justify-content:center">Contact Us</a>
    </li>
  </ul>
  <div class="nav-right">
    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary" style="padding:10px 22px;font-size:13px;">Contact Us <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    <button class="hamburger" aria-label="Menu"><span></span></button>
  </div>
</div>
</nav>
