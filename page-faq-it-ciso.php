<?php
/**
 * Template Name: FAQ - IT & CISO
 */
get_header();
?>

<!-- FAQ HERO -->
<section class="faq-hero">
<div class="hero-mesh"></div>
<div class="container" style="position:relative;z-index:1">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faqs/')); ?>">FAQs</a></div>
  <div class="faq-tag">&#128737;&#65039; IT &amp; CISO FAQs</div>
  <h1>Everything your security team <em>will ask about</em></h1>
  <p>Data residency, access control, vendor security posture, third-party risk assessment, portability, and ongoing maintenance burden.</p>
</div>
</section>

<!-- FAQ CONTENT -->
<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#data-security">Data Security &amp; Residency</a>
      <a href="#access-control">Access Control &amp; Identity</a>
      <a href="#portability">Portability &amp; Vendor Risk</a>
    </nav>
    <div class="sidebar-sep"></div>
    <div class="sidebar-label">10 Questions total</div>
    <div class="sidebar-box">
      <p>Still have questions? Talk to our team.</p>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a>
    </div>
  </aside>

  <div class="faq-content">
    <div class="content-header">
      <div class="content-icon">&#128737;&#65039;</div>
      <div>
        <p>Data residency, access control, vendor security posture, third-party risk assessment, portability, and ongoing maintenance burden.</p>
      </div>
    </div>

    <div class="faq-section" data-sec="data-security" id="data-security">
      <div class="section-title"><span>&#128272;</span> Data Security &amp; Residency</div>
      <div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Our CISO's first question: where does the data live, and can we verify it?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">In <strong>private AWS account deployment</strong>, data lives in your own AWS account in your chosen region (ap-south-1 for India). PolicyCentral.ai has zero access. The platform is deployed as infrastructure code into your environment. Your AWS team can verify at any time through CloudTrail logs, IAM role inspection, and S3 bucket policy review. In <strong>SaaS deployment</strong>, a Data Processing Agreement (DPA) and sub-processor list are available as part of the commercial agreement for third-party risk assessment.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What documentation is available for a vendor security assessment?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Available under NDA: <strong>SOC 2 Type II report</strong>, <strong>Data Processing Agreement (DPA)</strong>, <strong>Sub-processor list</strong> (AWS services used), <strong>Penetration test reports</strong>, and <strong>security questionnaire responses</strong> (CAIQ/SIG or your organization's own format). As an AWS Global ISV Partner, the company meets AWS security review requirements. Documentation is structured to meet standard FSI vendor onboarding and RBI TPRM framework requirements.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">How is data encrypted?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Data at rest: <strong>AES-256 encryption</strong> using AWS KMS. In private account deployments, your organization controls the KMS keys. Data in transit: <strong>TLS 1.2 / TLS 1.3</strong> for all client-server communications. Document storage uses Amazon S3 with server-side encryption. AI processing (Bedrock, Polly, Translate) happens within the AWS service boundary, and documents are not sent to external APIs outside the AWS ecosystem.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Our CISO requires that no vendor personnel can access our policy content.</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Yes, and this is precisely what private AWS account deployment is designed for. The platform's infrastructure runs in your AWS account, governed by your IAM policies. No PolicyCentral.ai employee has AWS console access to your account. Support for application-level issues is provided through logs you choose to share (typically anonymized error logs), not through direct data access. This meets the "zero vendor data access" requirement increasingly standard in FSI InfoSec policies.</div>
    </div>
  </div>
    </div>

    <div class="faq-section" data-sec="access-control" id="access-control">
      <div class="section-title"><span>&#128273;</span> Access Control &amp; Identity</div>
      <div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">How is role-based access control implemented?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Two levels: <strong>Employee level:</strong> each employee sees only policies targeted to their profile (department, designation, grade, location). They cannot navigate to policies outside their designated scope. <strong>Admin level:</strong> admins are assigned department-specific publishing rights (HR admin can only publish HR policies; they cannot modify Legal or IT policies). All admin actions are logged with timestamps, and the Maker-Checker audit trail captures every publishing action, approval, and modification.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What happens when an employee leaves the organization?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">When marked as terminated in HRMS and the sync runs, access is automatically deprovisioned. In SSO/AD-integrated deployments, disabling the employee's AD account (standard IT offboarding) simultaneously revokes PolicyCentral.ai access, so no separate deprovisioning step is required. Historical compliance data (read receipts, attestations, e-sign records) is preserved, not deleted, as regulatory audit windows may require access to historical records for ex-employees.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What is the ongoing IT maintenance burden after go-live?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Minimal: <strong>No patching</strong>, as security patches and updates are applied by the vendor with no action required from your IT team. <strong>No version upgrades</strong>, as new features deploy continuously and appear automatically in your instance. <strong>No infrastructure scaling</strong>, as the platform auto-scales on AWS. Routine IT involvement post-go-live: employee data sync monitoring (automated), occasional firewall rule updates, user deprovisioning (automated via AD). Estimated ongoing IT overhead: <strong>1–2 hours per month</strong>.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">Does the platform undergo regular penetration testing?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">Yes. PolicyCentral.ai undergoes periodic penetration testing by third-party security firms. The most recent report is available under NDA as part of the vendor security assessment process. As an AWS Global ISV Partner, the platform also benefits from AWS's own security review process, which includes security architecture review requirements.</div>
    </div>
  </div>
    </div>

    <div class="faq-section" data-sec="portability" id="portability">
      <div class="section-title"><span>&#128228;</span> Portability &amp; Vendor Risk</div>
      <div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">What is our exit strategy - can we get our data back if we move to another platform?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">All data is exportable: policy content, compliance records (read receipts, attestation data, e-sign logs, timestamps, employee profiles), version histories, analytics, in standard formats (CSV, Excel, JSON), not proprietary formats. For private AWS account deployments, the data already lives in your own S3 buckets and databases, so vendor lock-in at the data layer doesn't exist. Off-boarding includes a supported data export process.</div>
    </div>
  </div>
<div class="acc-item">
    <button class="acc-trigger">
      <span class="acc-q">How do we assess the vendor's own business continuity risk?</span>
      <span class="acc-icon">+</span>
    </button>
    <div class="acc-body">
      <div class="acc-answer">WorkApps has been operational since 2017 (8 years), is venture-funded, and serves 70+ FSI institutions including Kotak Mahindra Bank (83,700 employees). The AWS infrastructure underpinning the platform has a 99.99% uptime SLA. A vendor business continuity event would not immediately affect a private AWS account deployment, as your instance runs independently. Business continuity documentation and customer references for TPRM purposes are available on request.</div>
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
    <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="other-link"><span class="oi">&#128274;</span>Hosting &amp; Security</a>
    <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="other-link"><span class="oi">&#128640;</span>Implementation &amp; Integration</a>
    <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="other-link"><span class="oi">&#128200;</span>ROI &amp; Business Case</a>
    <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="other-link"><span class="oi">&#128176;</span>Pricing &amp; Finance FAQs</a>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>
