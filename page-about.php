<?php
/* Template Name: About */
get_header();
?>

<!-- ABOUT HERO -->
<section class="faq-hero">
<div class="container">
  <h1>The team, culture, and company behind <em>PolicyCentral.ai</em></h1>
  <p>Built by WorkApps, a venture-backed product company serving regulated enterprises since 2017.</p>
</div>
</section>

<!-- ABOUT CARDS -->
<div class="cat-grid">
  <a href="<?php echo esc_url(home_url('/team/')); ?>" class="cat-card reveal rd1">
    <div class="cat-emoji">👥</div>
    <h2>Our Team</h2>
    <p>Meet the team building PolicyCentral.ai: second-time founders, 40 members strong, venture-backed, and based in Pune with a US subsidiary.</p>
    <div class="cat-footer">
      <span class="cat-count">Leadership &amp; Investors</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="<?php echo esc_url(home_url('/culture/')); ?>" class="cat-card reveal rd2">
    <div class="cat-emoji">💜</div>
    <h2>Our Culture</h2>
    <p>Five core values that drive how we work: good work gives meaning, innovate every day, no bullshit just work, enjoy what you do, and family first.</p>
    <div class="cat-footer">
      <span class="cat-count">Values &amp; Way of Work</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="https://workapps.com" target="_blank" class="cat-card reveal rd3">
    <div class="cat-emoji"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/workapps-logo.jpeg" alt="WorkApps" style="height:36px;width:auto;border-radius:6px" loading="lazy"></div>
    <h2>WorkApps</h2>
    <p>PolicyCentral.ai is built by WorkApps (est. 2017), the team behind VideoCX.io, serving 74 financial institutions with 3M+ monthly video calls. AWS Partner of the Year 2021.</p>
    <div class="cat-footer">
      <span class="cat-count">workapps.com ↗</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
  <a href="https://videocx.io" target="_blank" class="cat-card reveal rd4">
    <div class="cat-emoji"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/VideoCX-io-logo.svg" alt="VideoCX.io" style="height:14px;width:auto" loading="lazy"></div>
    <h2>VideoCX.io</h2>
    <p>Our flagship Video CX platform, powering Video KYC, Video Banking, and Video Insurance for 74+ financial institutions. Processing 3.1M+ video calls monthly with bank-grade security.</p>
    <div class="cat-footer">
      <span class="cat-count">videocx.io ↗</span>
      <span class="cat-arrow">&rarr;</span>
    </div>
  </a>
</div>

<!-- CTA -->
<div class="about-cta">
  <p>Want to see PolicyCentral.ai in action for your organization?</p>
  <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary">Contact Us <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:15px;height:15px"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
</div>

<?php get_footer(); ?>
