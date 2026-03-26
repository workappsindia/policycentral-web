<?php
/* Template Name: FAQ Hub */
get_header();
?>

<!-- FAQ HERO -->
<section class="faq-hero">
<div class="container">
  <div class="faq-tag">Help Centre</div>
  <h1>Frequently Asked <em>Questions</em></h1>
  <p>Everything your team needs to evaluate, implement, and champion PolicyCentral.ai, organized by who's asking and what they need to know.</p>
</div>
</section>

<!-- CATEGORY GRID -->
<div class="cat-grid">
  <a href="<?php echo esc_url(home_url('/faq/company-platform/')); ?>" class="cat-card reveal rd1">
    <div class="cat-emoji">🏢</div>
    <h2>Company &amp; Platform FAQs</h2>
    <p>Who built this, what it is, who uses it, and why it was purpose-built for FSI compliance.</p>
    <div class="cat-footer">
      <span class="cat-count">12 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/ai-capabilities/')); ?>" class="cat-card reveal rd2">
    <div class="cat-emoji">🤖</div>
    <h2>AI Capabilities FAQs</h2>
    <p>Is the AI real? What exactly does it do? How is it powered, and can you control its output?</p>
    <div class="cat-footer">
      <span class="cat-count">13 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/features-dashboard/')); ?>" class="cat-card reveal rd3">
    <div class="cat-emoji">⚙️</div>
    <h2>Features &amp; Dashboard FAQs</h2>
    <p>Deep-dive into what the platform actually does: search, tracking, content formats, and more.</p>
    <div class="cat-footer">
      <span class="cat-count">14 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/compliance-tracking/')); ?>" class="cat-card reveal rd4">
    <div class="cat-emoji">✅</div>
    <h2>Compliance &amp; Tracking FAQs</h2>
    <p>How attestation, read receipts, e-signatures, and audit trails work in practice.</p>
    <div class="cat-footer">
      <span class="cat-count">13 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/publishing/')); ?>" class="cat-card reveal rd1">
    <div class="cat-emoji">📢</div>
    <h2>Publishing &amp; Distribution FAQs</h2>
    <p>Creating, targeting, versioning, and managing policies across departments and employee segments.</p>
    <div class="cat-footer">
      <span class="cat-count">13 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/hosting-security/')); ?>" class="cat-card reveal rd2">
    <div class="cat-emoji">🔒</div>
    <h2>Hosting &amp; Security FAQs</h2>
    <p>Deployment options, data sovereignty, AWS architecture, and security certifications.</p>
    <div class="cat-footer">
      <span class="cat-count">12 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/implementation/')); ?>" class="cat-card reveal rd3">
    <div class="cat-emoji">🚀</div>
    <h2>Implementation &amp; Integration FAQs</h2>
    <p>Setup timelines, HRMS/AD integration, data migration, and what IT actually needs to do.</p>
    <div class="cat-footer">
      <span class="cat-count">13 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/roi-business/')); ?>" class="cat-card reveal rd4">
    <div class="cat-emoji">📈</div>
    <h2>ROI &amp; Business Case FAQs</h2>
    <p>Concrete numbers, time savings, cost comparisons, and how to build the internal business case.</p>
    <div class="cat-footer">
      <span class="cat-count">12 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/it-ciso/')); ?>" class="cat-card reveal rd1">
    <div class="cat-emoji">🛡️</div>
    <h2>IT &amp; CISO FAQs</h2>
    <p>Data residency, access control, vendor security, portability, and maintenance burden.</p>
    <div class="cat-footer">
      <span class="cat-count">13 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/faq/pricing-finance/')); ?>" class="cat-card reveal rd2">
    <div class="cat-emoji">💰</div>
    <h2>Pricing &amp; Finance FAQs</h2>
    <p>Total cost of ownership, pricing model, contract terms, implementation cost, and financial ROI.</p>
    <div class="cat-footer">
      <span class="cat-count">12 questions</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
</div>

<?php get_footer(); ?>
