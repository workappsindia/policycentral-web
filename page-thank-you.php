<?php
/* Template Name: Thank You */
get_header();
?>

<section class="faq-hero" style="padding:calc(var(--nav-h) + 120px) 0 80px;min-height:70vh;display:flex;align-items:center">
  <div class="container" style="text-align:center;max-width:680px">

    <!-- Animated checkmark -->
    <div style="width:88px;height:88px;border-radius:50%;background:linear-gradient(135deg,#179D97,#059669);margin:0 auto 32px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 32px rgba(23,157,151,.3);animation:thanksPulse 2s ease-in-out infinite">
      <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:40px;height:40px"><polyline points="20 6 9 17 4 12"/></svg>
    </div>

    <h1 style="font-size:clamp(32px,4vw,48px);margin-bottom:16px;line-height:1.15">
      Message <span class="g-text">Received!</span>
    </h1>

    <p style="font-size:18px;color:var(--gray-500);line-height:1.75;margin-bottom:12px">
      It's our <strong style="color:var(--teal)">policy</strong> to get back as soon as possible.
    </p>
    <p style="font-size:15px;color:var(--gray-400);line-height:1.7;margin-bottom:40px">
      One of our team members will reach out to you shortly. In the meantime, feel free to explore our platform features.
    </p>

    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
      <a href="<?php echo esc_url(home_url('/features/')); ?>" class="btn btn-primary" style="padding:14px 28px">
        Explore Features
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
      <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-secondary" style="padding:14px 28px">
        Back to Home
      </a>
    </div>

  </div>
</section>

<style>
@keyframes thanksPulse {
  0%, 100% { box-shadow: 0 8px 32px rgba(23,157,151,.3); }
  50% { box-shadow: 0 8px 32px rgba(23,157,151,.3), 0 0 0 16px rgba(23,157,151,.08); }
}
</style>

<?php get_footer(); ?>
