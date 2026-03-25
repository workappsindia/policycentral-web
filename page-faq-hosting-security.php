<?php
/**
 * Template Name: FAQ - Hosting & Security
 */
get_header(); ?>

<!-- FAQ HERO -->
<section class="faq-hero">
<div class="hero-mesh"></div>
<div class="container" style="position:relative;z-index:1">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faqs/')); ?>">FAQs</a></div>
  <div class="faq-tag">&#128274; Hosting &amp; Security FAQs</div>
  <h1>Data sovereignty, AWS architecture, <em>and certifications</em></h1>
  <p>Where your data lives, how it's protected, what security certifications the platform holds, and how it handles regulated industry requirements.</p>
</div>
</section>

<!-- FAQ CONTENT -->
<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#hosting">Hosting &amp; Deployment</a>
      <a href="#certifications">Security &amp; Certifications</a>
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
      <div class="content-icon">&#128274;</div>
      <div>
        <p>Where your data lives, how it's protected, what security certifications the platform holds, and how it handles regulated industry requirements.</p>
      </div>
    </div>

    <div class="faq-section" data-sec="hosting" id="hosting">
      <div class="section-title"><span>&#9729;&#65039;</span> Hosting &amp; Deployment</div>
      <div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Where does our policy data actually live?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">PolicyCentral.ai offers two deployment models: <strong>SaaS</strong>, where data lives on PolicyCentral.ai's managed AWS infrastructure, in an AWS region you select (India region available for data residency compliance). <strong>Private AWS Account</strong>, where data lives entirely within your organization's own AWS account. In this model, PolicyCentral.ai deploys the platform into your cloud environment; the vendor has no access to your data, and your organization retains full data sovereignty.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What is the difference between SaaS and private AWS account deployment?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer"><strong>SaaS</strong>: fully managed by PolicyCentral.ai on their AWS infrastructure. No infrastructure responsibility on your side, faster updates, lower IT overhead. <strong>Private AWS Account</strong>: platform runs in your AWS environment. You retain data sovereignty; the vendor has no access; your InfoSec team applies your own security policies. Trade-off is slightly higher IT involvement for initial setup. For most large RBI-regulated banks and SEBI-registered entities, private deployment is the standard choice.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Can we restrict access to office network IPs only?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Yes. The web portal can be configured to allow connections only from specified IP addresses or ranges, such as your office network, VPN endpoints, and trusted branches. PolicyCentral.ai is then inaccessible from outside your network perimeter regardless of valid login credentials. Supported out of the box without requiring additional network-level configuration from your side.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">How are mobile apps handled from a security perspective?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Mobile apps can be distributed via <strong>public app stores</strong> (Apple App Store, Google Play) for BYOD environments, or via <strong>private enterprise app stores</strong> (Microsoft Intune, VMware Workspace ONE, or similar MDM/EMM platforms) for organizations that require all employee apps to be enterprise-managed, consistent with how other enterprise mobile applications are handled.</div>
    </div>
  </div>
    </div>

    <div class="faq-section" data-sec="certifications" id="certifications">
      <div class="section-title"><span>&#128737;&#65039;</span> Security &amp; Certifications</div>
      <div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What security certifications does PolicyCentral.ai hold?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer"><span class="pill">ISO 27001</span> (information security management), <span class="pill">SOC 2 Type II</span> (independently audited security controls), <span class="pill">GDPR Compliant</span> (data privacy protection), <span class="pill">NIST Cybersecurity Framework</span> (cybersecurity risk management), <span class="pill">RBI BFSI Guidelines</span> (banking and financial services compliance). All data encrypted with <strong>AES-256 at rest and in transit</strong>. Platform runs on AWS infrastructure with a <strong>99.99% uptime SLA</strong> backed by AWS's own availability guarantees.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">How does authentication work - do employees need a separate login?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">No. The platform integrates with your Active Directory (AD) for employee login and enables <strong>Single Sign-On (SSO)</strong>. Employees log in using existing corporate credentials, the same username and password they use for email. No additional credential to manage, no password reset queue, no parallel identity system. Standard SAML-based SSO providers (Okta, Azure AD, PingFederate) are supported.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Who can access our policy content - does the vendor have access?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">In <strong>private AWS account deployment</strong>: PolicyCentral.ai has zero access to your data. The platform runs in your cloud environment governed by your IAM policies. In <strong>SaaS deployment</strong>: data access is governed by the SaaS agreement, limited to the operational minimum required (e.g., AI processing pipeline reads documents to generate summaries within the AWS service boundary, with no human access). Data access terms are detailed in the Data Processing Agreement available in the commercial contract.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What happens to our data if we leave the platform?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">All data is exportable: policy content, compliance records (read receipts, attestation data, e-sign logs), version histories, and analytics, in standard formats (CSV, Excel, JSON). No proprietary data format creates lock-in. For private AWS account deployments, your data already lives in your own S3 buckets and databases. Off-boarding includes a structured data export ensuring a complete historical compliance record, important for regulatory audit windows extending 3–7 years into the past.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Is the platform WCAG accessible?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">PolicyCentral.ai is <strong>WCAG 2.1 AA compliant</strong>: usable with screen readers, sufficient color contrast ratios, keyboard navigation supported, text alternatives for non-text content. The audio version feature (Amazon Polly) is specifically valuable for visually impaired employees, who can listen to policy content rather than relying on screen reader compatibility with dense PDF files.</div>
    </div>
  </div>
    </div>

    <div class="other-cats">
      <h3>Explore other FAQ categories</h3>
      <div class="other-grid">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="other-link"><span class="oi">&#127970;</span>Company &amp; Platform</a>
    <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="other-link"><span class="oi">&#129302;</span>AI Capabilities</a>
    <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="other-link"><span class="oi">&#9881;&#65039;</span>Features &amp; Dashboard</a>
    <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="other-link"><span class="oi">&#9989;</span>Compliance &amp; Tracking</a>
    <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="other-link"><span class="oi">&#128226;</span>Publishing &amp; Distribution</a>
    <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="other-link"><span class="oi">&#128640;</span>Implementation &amp; Integration</a>
    <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="other-link"><span class="oi">&#128200;</span>ROI &amp; Business Case</a>
    <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="other-link"><span class="oi">&#128737;&#65039;</span>IT &amp; CISO</a>
    <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="other-link"><span class="oi">&#128176;</span>Pricing &amp; Finance FAQs</a>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
