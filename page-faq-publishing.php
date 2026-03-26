<?php
/**
 * Template Name: FAQ - Publishing
 */
get_header();
?>

<section class="faq-hero">
<div class="container">
  <div class="breadcrumb"><a href="<?php echo esc_url(home_url('/faqs/')); ?>">FAQs</a></div>
  <div class="faq-tag">Publishing &amp; Distribution FAQs</div>
  <h1>Creating, targeting, and managing <em>policies at scale</em></h1>
  <p>How to publish policies, target the right audience, manage versions, and operate a multi-department policy library without IT.</p>
</div>
</section>

<div class="faq-wrap">
  <aside class="sidebar">
    <div class="sidebar-label">Jump to section</div>
    <nav class="sidebar-nav">
      <a href="#creating">Creating Policies</a>
      <a href="#targeting">Targeting &amp; Segmentation</a>
      <a href="#library">Library Management</a>
    </nav>
    <div class="sidebar-sep"></div>
    <div class="sidebar-label">12 Questions total</div>
    <div class="sidebar-box"><p>Still have questions? Talk to our team.</p><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Us</a></div>
  </aside>

  <div class="faq-content">
    <div class="content-header"><div class="content-icon">📢</div><div><p>How to publish policies, target the right audience, manage versions, and operate a multi-department policy library without IT.</p></div></div>

    <div class="faq-section" data-sec="creating" id="creating">
      <h2 class="section-title"><span>✏️</span> Creating Policies</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Do we need IT support to create and publish policies?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">No. The content editor is Gmail-like, so any HR, compliance, or operations manager can use it without technical training. It supports: copy-paste from Word (formatting preserved), bulk PDF upload, rich text formatting (tables, font color, size, bold, links), and media embedding (images, GIFs, YouTube videos, audio). IT is only involved in initial setup (AD integration, HRMS sync, email gateway), not day-to-day policy operations.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can I just copy-paste from existing Word or PDF policies?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes, by design. Copy-paste from Word into the editor preserves formatting. PDFs can be bulk-uploaded and are immediately searchable. For organizations with 50–500+ existing policies, migration effort is measured in hours or days, not weeks. AI enhancement features (summaries, translations, audio) can then be applied to existing content without requiring any rewriting.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What is the Maker-Checker process and why does it matter for FSI?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Maker-Checker is a governance workflow where a policy created by one admin (Maker) must be reviewed and approved by designated approvers (Checkers) before going live. Recommended or mandated by RBI and other regulators for operational documents, it prevents unauthorized policy publications. The platform maintains a complete trail of who created, who approved, when, and any review comments. This audit trail is available for regulatory inspection.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What happens when a policy needs to be urgently retracted?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Any admin with appropriate access can <strong>Unpublish a policy instantly</strong>, removing it from the employee-facing library with a single click. The urgency of this capability matters most in FSI: when regulatory guidance changes and an existing policy is no longer compliant, the window between the change and the policy update is a risk window. Being able to retract and re-publish in minutes rather than days reduces that window materially.</div></div></div>
    </div>

    <div class="faq-section" data-sec="targeting" id="targeting">
      <h2 class="section-title"><span>🎯</span> Targeting &amp; Segmentation</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How granular can targeting be?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Targeting is multi-dimensional and combinable: <strong>Department</strong>, <strong>Designation</strong>, <strong>Grade</strong>, <strong>Location</strong> (state, city, or specific branch), <strong>Gender</strong>, or a <strong>specific list of individual employees</strong>. Filters combine, so you can publish to "all female employees at Grade 6 and above in Maharashtra branches." This precision makes policy libraries genuinely personalized, directly improving relevance and read rates.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can we publish policies for employees who haven't joined yet?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. The <strong>Future Employees</strong> feature publishes policies now with instructions to automatically distribute them to any employee who joins and matches the specified profile criteria. When a new joiner is added to HRMS and synced, they receive all relevant pending policies automatically, with no manual action required. Makes onboarding compliance systematic and scalable, particularly for campus hiring and branch expansion.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How does "Resend to Unread Only" help compliance managers?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">"Resend to Unread Only" filters for only those employees who haven't opened a specific policy and sends a fresh notification exclusively to them. Rather than a blanket re-notification to all employees (including those who already read and attested, creating noise and resentment), this targeted approach focuses administrative energy on the actual non-compliance problem and avoids the "cry wolf" effect where employees start ignoring notifications.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can we send policies to specific named individuals, not just segments?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. Beyond segment-level targeting, the platform supports individual employee targeting, useful for scenarios where a policy is relevant to a specific person (e.g., a confidentiality clause relevant only to employees with access to specific data systems), or for follow-up distributions to employees flagged as non-readers in the compliance dashboard.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What happens when an employee transfers departments or gets promoted?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Because the platform integrates with your HRMS, employee profile updates (department transfers, designation changes, location moves, grade promotions) sync automatically. When an employee's profile updates in HRMS, PolicyCentral.ai re-evaluates which policies are relevant. Policies for the new role are queued automatically; policies no longer relevant are removed. Transferred employees don't operate with a policy library from their previous role, a common compliance gap in static distribution systems.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">Can policies be highlighted or pinned so employees can't miss them?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Yes. The <strong>Top Deck</strong> feature allows admins to highlight critical policies. They appear at the top of every employee's dashboard in a visually distinct pinned section. The <strong>"Add Sender's Name"</strong> feature associates a named executive with a policy (e.g., "Published by the Chief Risk Officer"), adding authority and urgency. Combined, these tools signal priority without resorting to mass email blasts.</div></div></div>
    </div>

    <div class="faq-section" data-sec="library" id="library">
      <h2 class="section-title"><span>🗂️</span> Library Management</h2>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">How do we organize a large policy library?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">A <strong>department-based folder structure</strong> mirrors your organizational hierarchy: HR policies under HR, InfoSec under IT, product policies under Operations. Each employee sees only folders and policies relevant to their profile. Administrators with cross-department visibility see the full library with filters by department, date, version, and read status.</div></div></div>
      <div class="acc-item"><button class="acc-trigger"><span class="acc-q">What happens to old policy versions - are they deleted or archived?</span><span class="acc-icon">+</span></button><div class="acc-body"><div class="acc-answer">Archived, not deleted. All previous versions are maintained in a version history log accessible to admins but not surfaced to employees by default. Employees always see the current version; admins and auditors can retrieve any historical version with its original publish date, approver trail, and associated compliance data. Essential for regulatory audits where inspectors ask: "What was your AML policy in Q2 FY24, and do you have evidence employees were aware?"</div></div></div>
    </div>

    <div class="other-cats">
      <h2>Explore other FAQ categories</h2>
      <div class="other-grid">
        <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="other-link"><span class="oi">🏢</span>Company &amp; Platform</a>
        <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="other-link"><span class="oi">🤖</span>AI Capabilities</a>
        <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="other-link"><span class="oi">⚙️</span>Features &amp; Dashboard</a>
        <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="other-link"><span class="oi">✅</span>Compliance &amp; Tracking</a>
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
