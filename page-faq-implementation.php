<?php
/**
 * Template Name: FAQ - Implementation
 */
get_header();
?>

<!-- FAQ HERO -->
<section class="faq-hero">
<div class="hero-mesh"></div>
<div class="container" style="position:relative;z-index:1">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faqs/')); ?>">FAQs</a></div>
  <div class="faq-tag">&#128640; Implementation &amp; Integration FAQs</div>
  <h1>Setup timelines, integrations, and <em>what IT actually needs to do</em></h1>
  <p>How long implementation takes, what your IT team needs to do, how HRMS and AD integration works, and how to migrate legacy policy libraries.</p>
</div>
</section>

<!-- FAQ CONTENT -->
<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#setup">Setup &amp; Timeline</a>
      <a href="#integrations">Integrations</a>
    </nav>
    <div class="sidebar-sep"></div>
    <div class="sidebar-label">9 Questions total</div>
    <div class="sidebar-box">
      <p>Still have questions? Talk to our team.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
    </div>
  </aside>

  <div class="faq-content">
    <div class="content-header">
      <div class="content-icon">&#128640;</div>
      <div>
        <p>How long implementation takes, what your IT team needs to do, how HRMS and AD integration works, and how to migrate legacy policy libraries.</p>
      </div>
    </div>

    <div class="faq-section" data-sec="setup" id="setup">
      <h2 class="section-title"><span>&#9201;&#65039;</span> Setup &amp; Timeline</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How long does implementation actually take?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Standard SaaS deployment goes live in <strong>under 24 hours</strong>. This is not marketing language; the platform is off-the-shelf with no custom development required. For deployments requiring AD integration, HRMS sync, or private AWS account setup: 3–7 days. For complex configurations with multiple subsidiaries, custom email gateway, and private app store distribution: 2–4 weeks. The 14-day free trial is structured to match the evaluation and basic implementation timeline.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does IT actually need to do?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">For standard SaaS + AD integration: <strong>~4–8 hours of IT time over 3–5 days</strong>. Tasks: provide AD credentials for SSO configuration (30-minute task), configure email gateway for notification emails from your corporate domain (standard SMTP/relay), whitelist the PolicyCentral.ai domain on firewall if required, configure HRMS API integration for employee data sync. No custom development, no server provisioning, no code deployments on your side.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">How complex is migrating existing policies?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Migration is consistently the most over-estimated aspect. The workflow: upload existing PDFs in bulk (30 minutes for 200 policies), organize into department folders (2–4 hours depending on library size), apply AI enhancements (summaries, audio, translations) (1–2 clicks per policy or batch-processed), configure targeting (1–2 hours). A library of 100 policies is typically fully migrated and live within 2–3 working days without IT involvement.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">What does the 14-day free trial include?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Full feature access, not a limited sandbox. All 8 AI capabilities, admin dashboard with real compliance reporting, mobile app access for employees, AD integration setup, and the ability to publish real policies to real employees. By the time you make a commercial decision, you have actual data on employee engagement and attestation rates in your own organizational context, not simulated demo data.</div></div></div>
    </div>

    <div class="faq-section" data-sec="integrations" id="integrations">
      <h2 class="section-title"><span>&#128279;</span> Integrations</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does HRMS integration work and which platforms are supported?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">HRMS integration works via API. PolicyCentral.ai connects to your HR system to sync employee data (name, department, designation, grade, location, gender, employment status). Enables automatic policy targeting and lifecycle automation (new joiners receive relevant policies automatically; terminated employees are deprovisioned). Supported platforms include: Darwinbox, SAP SuccessFactors, Oracle HCM, Workday, Keka, greytHR, and others.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does AD integration and SSO work technically?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">The AD integration uses SAML 2.0 or LDAP depending on your AD configuration. From the employee's perspective: they open PolicyCentral.ai → redirected to your corporate login page → authenticate with AD credentials → returned to PolicyCentral.ai with a validated session token. Invisible to the employee, PolicyCentral.ai behaves like any other SSO-enabled enterprise application. Session management, password policies, and MFA requirements are governed by your AD configuration.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can PolicyCentral.ai be embedded into our existing HRMS or intranet?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. The platform can be linked from your existing HRMS or intranet, so employees access PolicyCentral.ai from within tools they already use daily (Darwinbox, SAP, SharePoint intranet) without navigating to a separate URL. This "embedded" access model significantly improves adoption: it removes the friction of remembering another URL. Integration is typically a simple link or iframe embed, requiring minimal IT effort.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does the email notification system work?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">The platform integrates with your corporate email gateway (SMTP relay). When a policy is published, employees receive a notification from <strong>your corporate domain</strong>, not a PolicyCentral.ai domain, maintaining brand consistency and avoiding spam filter issues. Admins configure the notification template, sender name, and email domain. Action buttons (Understood, Accept) require authentication, ensuring compliance records are linked to verified identities.</div></div></div>
<div class="acc-item"><button class="acc-trigger"><span class="acc-q">Is there a white-labelling option?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. The platform can be white-labelled: your logo throughout portal and mobile app, hosted on your domain (e.g., policies.yourcompany.com), color scheme aligned with your brand guidelines. From an employee perspective, they interact with a branded company portal with no visible indication that PolicyCentral.ai is the underlying technology. Employees trust and engage more with a platform that looks like it's part of the company's own digital ecosystem.</div></div></div>
    </div>

    <div class="other-cats">
      <h2>Explore other FAQ categories</h2>
      <div class="other-grid">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="other-link"><span class="oi">&#127970;</span>Company &amp; Platform</a>
    <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="other-link"><span class="oi">&#129302;</span>AI Capabilities</a>
    <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="other-link"><span class="oi">&#9881;&#65039;</span>Features &amp; Dashboard</a>
    <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="other-link"><span class="oi">&#9989;</span>Compliance &amp; Tracking</a>
    <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="other-link"><span class="oi">&#128226;</span>Publishing &amp; Distribution</a>
    <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="other-link"><span class="oi">&#128274;</span>Hosting &amp; Security</a>
    <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="other-link"><span class="oi">&#128200;</span>ROI &amp; Business Case</a>
    <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="other-link"><span class="oi">&#128737;&#65039;</span>IT &amp; CISO</a>
    <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="other-link"><span class="oi">&#128176;</span>Pricing &amp; Finance FAQs</a>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
