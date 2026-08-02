<?php
/**
 * Archive template — pc_policy  →  /resources/policies/  (Policy Templates landing)
 * Hero + the 6 category cards. Card counts come from the taxonomy.
 */
defined('ABSPATH') || exit;

get_header();

$cats  = pcpl_categories();
$total = wp_count_posts(PCPL_CPT::POST_TYPE);
$total_published = isset($total->publish) ? (int) $total->publish : 0;
?>

<section class="pcb-post-hero has-gradient">
  <div class="pcb-post-hero-gradient" aria-hidden="true">
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--1"></div>
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--2"></div>
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--3"></div>
  </div>
  <div class="container">
    <div class="ptl-hero">
      <h1 class="ptl-hero-h1">Free, ready-to-adapt <span class="g-text">policy templates</span> for Indian enterprises</h1>
      <p class="ptl-hero-sub">A growing library of HR, compliance, governance and information-security policies, written to Indian regulation and built to personalize in minutes. Adapt one to your organisation, or ask PolicyGPT anything it covers.</p>
      <div class="hero-btns" style="justify-content:center">
        <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
        <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
        <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
        <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
        <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
      </div>
    </div>
  </div>
</section>

<div class="ptl-wrap">
  <div class="container">
    <div class="ptl-grid">
      <?php foreach ($cats as $slug => $c) :
        $term = get_term_by('slug', $slug, PCPL_CPT::TAXONOMY);
        $count = $term ? (int) $term->count : 0;
        $url   = $term ? get_term_link($term) : '#';
        if (is_wp_error($url)) $url = '#';
      ?>
        <a class="ptl-card" href="<?php echo esc_url($url); ?>" style="--cat-accent:<?php echo esc_attr($c['accent']); ?>">
          <div class="ptl-card-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $c['icon']; ?></svg></div>
          <h3 class="ptl-card-title"><?php echo esc_html($c['name']); ?></h3>
          <p class="ptl-card-desc"><?php echo esc_html($c['desc']); ?></p>
          <span class="ptl-card-meta"><?php echo $count ? esc_html($count . ' ' . _n('template', 'templates', $count)) : 'Coming soon'; ?>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="pt-band">
    <h2>Need these policies live, not just downloaded?</h2>
    <p>PolicyCentral.ai turns templates like these into living policies, versioned, translated, acknowledged, and answerable by AI.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
      <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
    </div>
  </div>
</div>

<?php get_footer();
