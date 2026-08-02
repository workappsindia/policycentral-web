<?php
/**
 * Single template — pc_policy (Policy Template page).
 *
 * Data-driven version of the design prototype: hero (blog side-image shell) +
 * document body (post_content) + mid CTA + related (same category) + FAQs
 * (meta) + "mail me the personalized PDF" lead card + bottom CTA.
 */
defined('ABSPATH') || exit;

get_header();

while (have_posts()) : the_post();
    $pid      = get_the_ID();
    $category = pcpl_primary_category($pid);
    $cat_name = $category ? $category->name : 'Policy Templates';
    $cat_url  = $category ? get_term_link($category) : home_url('/policies/');
    $hero     = pcpl_policy_hero($pid);
    $byline   = get_the_excerpt();
    $covers   = pcpl_meta_list($pid, '_pcpl_covers');
    $faqs     = pcpl_meta_list($pid, '_pcpl_faqs');
    $body     = get_post_field('post_content', $pid); // trusted, seeded HTML

    // Build TOC from the body's <section class="pt-sec" id="..."><h2>Label</h2>
    preg_match_all('#<section[^>]*class="pt-sec"[^>]*id="([^"]+)"[^>]*>\s*<h2[^>]*>(.*?)</h2>#is', $body, $m);
    $toc = array();
    if (!empty($m[1])) {
        foreach ($m[1] as $i => $id) {
            $toc[$id] = wp_strip_all_tags($m[2][$i]);
        }
    }

    // Mid CTA (blog pcb-cta-mid component) injected after the 3rd section.
    $mid_cta = '
<div class="pcb-cta-mid" role="complementary">
  <div class="pcb-cta-mid-inner">
    <div class="pcb-cta-mid-icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"/></svg></div>
    <div class="pcb-cta-mid-body">
      <div class="pcb-cta-mid-eyebrow">See it in action</div>
      <h3 class="pcb-cta-mid-title">Turn this template into a <span class="g-text">living policy</span></h3>
      <p class="pcb-cta-mid-sub">Book a 20-minute demo to see how PolicyCentral.ai distributes, translates, and tracks acknowledgement of policies like this across your entire workforce.</p>
      <a href="' . esc_url(home_url('/contact/')) . '" class="btn btn-primary pcb-cta-mid-btn">Book a Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</div>';
    $parts = explode('</section>', $body);
    if (count($parts) > 4) {
        $body = implode('</section>', array_slice($parts, 0, 3)) . '</section>' . $mid_cta . implode('</section>', array_slice($parts, 3));
    }
?>

<!-- HERO -->
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
          <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
          <span aria-hidden="true">/</span>
          <span aria-current="page"><?php the_title(); ?></span>
        </nav>
        <h1 class="pcb-post-title"><?php the_title(); ?></h1>
        <?php if ($byline) : ?><p class="pt-hero-byline"><?php echo esc_html($byline); ?></p><?php endif; ?>
        <div class="hero-btns pt-hero-btns">
          <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
          <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
          <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
          <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
        </div>
      </div>
      <div class="pcb-post-hero-figure">
        <img src="<?php echo esc_url($hero); ?>" alt="<?php echo esc_attr($cat_name); ?>" class="pt-hero-img" loading="eager">
      </div>
    </div>
  </div>
</section>

<div class="pt-wrap">
  <div class="pt-body">
    <main class="pt-main">
      <div class="pt-doc"><?php echo $body; // trusted seeded HTML ?></div>

      <?php
      // Related — same category, exclude current.
      $related = array();
      if ($category) {
          $rq = new WP_Query(array(
              'post_type'      => PCPL_CPT::POST_TYPE,
              'posts_per_page' => 3,
              'post__not_in'   => array($pid),
              'orderby'        => 'rand',
              'tax_query'      => array(array(
                  'taxonomy' => PCPL_CPT::TAXONOMY,
                  'field'    => 'term_id',
                  'terms'    => $category->term_id,
              )),
          ));
          $related = $rq->posts;
          wp_reset_postdata();
      }
      if ($related) : ?>
      <section class="pt-related">
        <h2>Related policy templates</h2>
        <div class="pt-rel-grid">
          <?php foreach ($related as $r) :
              $rcat = pcpl_primary_category($r->ID); ?>
            <a class="pt-rel" href="<?php echo esc_url(get_permalink($r->ID)); ?>">
              <div class="k"><?php echo esc_html($rcat ? $rcat->name : 'Policy Template'); ?></div>
              <div class="t"><?php echo esc_html(get_the_title($r->ID)); ?></div>
              <div class="d"><?php echo esc_html(wp_trim_words(get_the_excerpt($r->ID), 18)); ?></div>
            </a>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

      <?php if ($faqs) : ?>
      <div class="pt-faqs">
        <h2>Frequently asked questions</h2>
        <?php foreach ($faqs as $f) :
            $q = isset($f['q']) ? $f['q'] : '';
            $a = isset($f['a']) ? $f['a'] : '';
            if (!$q) continue; ?>
          <details class="pt-faq"><summary><?php echo esc_html($q); ?></summary><div class="pt-faq-a"><p><?php echo esc_html($a); ?></p></div></details>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </main>

    <aside class="pt-side">
      <div class="pt-form-card">
        <div class="pt-fc-icon"><svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-10 5L2 7"/></svg></div>
        <h4>Get your personalized copy</h4>
        <p>Add your details and we'll insert your company name, then email you a ready-to-use PDF of this policy.</p>
        <form class="pt-lead-form" data-policy="<?php echo esc_attr(get_post_field('post_name', $pid)); ?>">
          <input type="text" name="name" placeholder="Full name" autocomplete="name" required>
          <input type="text" name="company" placeholder="Company name (optional)" autocomplete="organization">
          <input type="email" name="email" placeholder="Work email" autocomplete="email" required>
          <input type="tel" name="mobile" placeholder="Mobile number (optional)" autocomplete="tel">
          <button type="submit" class="btn btn-primary">Mail me the personalized PDF</button>
        </form>
        <span class="pt-fc-note">No spam, we'll only email you the document.</span>
        <div class="pt-fc-msg" role="status"></div>
      </div>

      <?php if ($toc) : ?>
      <nav class="pt-toc">
        <h4>In this template</h4>
        <?php foreach ($toc as $id => $label) : ?>
          <a href="#<?php echo esc_attr($id); ?>" class="toc-link"><?php echo esc_html($label); ?></a>
        <?php endforeach; ?>
      </nav>
      <?php endif; ?>
    </aside>
  </div>

  <!-- BOTTOM CTA -->
  <div class="pt-band">
    <h2>Stop emailing policy PDFs nobody reads</h2>
    <p>PolicyCentral.ai turns templates like this into living policies, versioned, translated, acknowledged, and answerable by AI.</p>
    <div class="hero-btns">
      <a href="<?php echo esc_url(home_url('/download/presentation/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>Download Presentation</a>
      <a href="<?php echo esc_url(home_url('/policygpt/')); ?>" target="_blank" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>PolicyGPT Demo</a>
      <div class="hero-btns-break" style="flex-basis:100%;height:0"></div>
      <a href="https://demo.policycentral.ai/" target="_blank" class="btn btn-secondary">Web Demo <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      <a href="https://demo.policycentral.ai/mobile.html" target="_blank" class="btn btn-ghost">Mobile Demo</a>
    </div>
  </div>
</div>

<script>
(function(){
  var secs=document.querySelectorAll('.pt-sec[id]'), links=document.querySelectorAll('.pt-toc .toc-link');
  if(secs.length&&links.length){
    var spy=new IntersectionObserver(function(es){es.forEach(function(e){if(e.isIntersecting){links.forEach(function(l){l.classList.toggle('on',l.getAttribute('href')==='#'+e.target.id);});}});},{rootMargin:'-15% 0px -75% 0px'});
    secs.forEach(function(s){spy.observe(s);});
  }
  // Lead form — personalized-PDF delivery is being finalised; graceful stub for now.
  var f=document.querySelector('.pt-lead-form');
  if(f){f.addEventListener('submit',function(e){
    e.preventDefault();
    var m=f.parentNode.querySelector('.pt-fc-msg');
    m.className='pt-fc-msg show';
    m.textContent='Thanks! Personalized PDF delivery is launching shortly, we will have this ready for you very soon.';
  });}
})();
</script>

<?php
endwhile;
get_footer();
