<?php
/* Template Name: Contact */
get_header();
?>

<!-- HERO -->
<section id="hero">
<div class="hero-mesh"></div>
<div class="container" style="position:relative;z-index:1">
  <div class="section-header reveal">
    <span class="eyebrow">Contact Us</span>
    <h1 style="margin-top:18px;font-size:clamp(32px,4.2vw,54px)">We are always going to be<br><span class="g-text">super excited</span> to hear from you.</h1>
  </div>
</div>
</section>

<!-- CONTACT CONTENT -->
<section class="section" style="padding-top:0">
<div class="container">
  <div class="contact-grid">

    <!-- LEFT: Form -->
    <div class="contact-form-wrap reveal rd1">
      <h3>For inquiries or support, please fill out the form below, and we will get back to you as soon as possible.</h3>
      <form onsubmit="return false;" autocomplete="off">
        <div class="form-row">
          <div class="form-group">
            <label>Your name <span class="req">*</span></label>
            <input type="text" class="form-input" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label>Company name <span class="req">*</span></label>
            <input type="text" class="form-input" placeholder="Enter your company name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>Your email <span class="req">*</span></label>
            <input type="email" class="form-input" placeholder="you@company.com" required>
          </div>
          <div class="form-group">
            <label>Contact number</label>
            <input type="tel" class="form-input" placeholder="Enter phone number with country code">
          </div>
        </div>
        <div class="form-group">
          <label>Your message</label>
          <textarea class="form-input" placeholder="Tell us how we can help you..."></textarea>
        </div>
        <button type="submit" class="btn-submit">
          Send Message
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </button>
      </form>
    </div>

    <!-- RIGHT: Offices -->
    <div class="offices-wrap reveal rd2">
      <h3 class="g-text" style="margin-bottom:24px">Our Offices</h3>

      <!-- Pune - Registered -->
      <div class="office-cards">
        <div class="office-card registered reveal rd1">
          <div class="office-badge">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Registered Office
          </div>
          <div class="office-header">
            <div class="office-pin">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <span class="office-city">Pune</span>
          </div>
          <p class="office-address">
            WorkApps Product Solutions Pvt. Ltd,<br>
            91 Springboard, Creaticity Mall,<br>
            Yerwada, Pune &ndash; 411006, India.
          </p>
          <div class="office-contact">
            <a href="tel:+919890988498">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
              +91 9890988498
            </a>
            <a href="mailto:contact@policycentral.ai">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              contact@policycentral.ai
            </a>
          </div>
        </div>

        <!-- Mumbai -->
        <div class="office-card reveal rd2">
          <div class="office-header">
            <div class="office-pin">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
            </div>
            <span class="office-city">Mumbai</span>
          </div>
          <p class="office-address">
            WorkApps Product Solutions Pvt. Ltd,<br>
            C/o Idea Square, 2nd floor, B-42, Off New Link Rd,<br>
            Opposite Citi Mall, Above Kalyan Jewellers showroom,<br>
            Veera Desai Industrial Estate, Andheri West,<br>
            Mumbai, Maharashtra &ndash; 400053, India.
          </p>
        </div>

      </div>
    </div>

  </div>
</div>
</section>

<?php get_footer(); ?>
