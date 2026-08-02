<?php
/**
 * Taxonomy template — pc_policy_category  →  /policies/category/{slug}/
 * Category hub: hero (category art) + grid of that category's policy templates.
 */
defined('ABSPATH') || exit;

get_header();

$term = get_queried_object();
$slug = $term ? $term->slug : '';
$meta = pcpl_category($slug);
$name = $meta ? $meta['name'] : ($term ? $term->name : 'Policy Templates');
$desc = $meta ? $meta['desc'] : ($term ? term_description($term) : '');
$hero = pcpl_category_hero($slug);
?>

<section class="pcb-post-hero has-gradient has-side-image">
  <div class="pcb-post-hero-gradient" aria-hidden="true">
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--1"></div>
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--2"></div>
    <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--3"></div>
  </div>
  <div class="container">
    <div class="pcb-post-hero-inner">
      <div class="pcb-post-hero-text">
        <nav class="pcb-breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url(home_url('/policies/')); ?>">Policy Templates</a>
          <span aria-hidden="true">/</span>
          <span aria-current="page"><?php echo esc_html($name); ?></span>
        </nav>
        <h1 class="pcb-post-title"><?php echo esc_html($name); ?> policy templates</h1>
        <?php if ($desc) : ?><p class="pt-hero-byline"><?php echo esc_html($desc); ?></p><?php endif; ?>
        <div class="hero-btns pt-hero-btns">
          <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
          <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
          <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
          <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
        </div>
      </div>
      <div class="pcb-post-hero-figure">
        <img src="<?php echo esc_url($hero); ?>" alt="<?php echo esc_attr($name); ?>" class="pt-hero-img" loading="eager">
      </div>
    </div>
  </div>
</section>

<div class="ptl-wrap">
  <div class="container">
    <?php if (have_posts()) : ?>
      <div class="ptl-pol-grid">
        <?php while (have_posts()) : the_post(); ?>
          <a class="ptl-pol-card" href="<?php the_permalink(); ?>">
            <div class="ptl-pol-k"><?php echo esc_html($name); ?></div>
            <h3 class="ptl-pol-t"><?php the_title(); ?></h3>
            <p class="ptl-pol-d"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22)); ?></p>
            <span class="ptl-pol-link">View template
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </span>
          </a>
        <?php endwhile; ?>
      </div>
    <?php else : ?>
      <p class="ptl-empty">Templates for this category are being added. In the meantime, <a href="<?php echo esc_url(home_url('/policygpt/')); ?>">ask PolicyGPT</a> a question it covers.</p>
    <?php endif; ?>
  </div>

  <div class="pt-band">
    <h2>Make these policies live in minutes</h2>
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
