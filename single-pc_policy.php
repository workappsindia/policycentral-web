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
      <?php $pcpl_langs = class_exists('PCPL_Interactive') ? PCPL_Interactive::languages() : array(); ?>
      <div class="pt-toolbar" data-slug="<?php echo esc_attr(get_post_field('post_name', $pid)); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce('pcpl_interactive')); ?>" data-ajax="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
        <div class="pt-tb-eyebrow"><span class="pt-tb-spark" aria-hidden="true">&#10024;</span> View this policy the way a PolicyCentral.ai user would on the platform</div>
        <div class="pt-tb-controls">
          <?php if ($pcpl_langs) : ?>
          <label class="pt-tb-lang">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            <span class="pt-tb-lang-txt">Translate</span>
            <select class="pt-tb-select" aria-label="Translate this policy into another language">
              <?php foreach ($pcpl_langs as $code => $l) :
                  $label = ($l['native'] !== $l['name']) ? $l['native'] . '  ' . $l['name'] : $l['name']; ?>
                <option value="<?php echo esc_attr($code); ?>"<?php echo $code === 'en' ? ' selected' : ''; ?>><?php echo esc_html($label); ?></option>
              <?php endforeach; ?>
            </select>
          </label>
          <?php endif; ?>
          <button type="button" class="pt-tb-btn" data-act="summary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 2l1.9 5.1L19 9l-5.1 1.9L12 16l-1.9-5.1L5 9z"/></svg>AI Summary</button>
          <button type="button" class="pt-tb-btn" data-act="listen"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M19 5a9 9 0 0 1 0 14"/></svg><span class="pt-listen-txt">Listen</span></button>
          <button type="button" class="pt-tb-btn" data-act="ask"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>Ask AI</button>
          <button type="button" class="pt-tb-btn" data-act="faq"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>FAQs</button>
          <button type="button" class="pt-tb-btn" data-act="infographic"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>Infographic</button>
        </div>
        <div class="pt-tb-status" role="status" aria-live="polite"></div>
      </div>

      <div class="pt-panel pt-summary" data-panel="summary" hidden>
        <button type="button" class="pt-panel-close" aria-label="Close summary">&times;</button>
        <div class="pt-panel-eyebrow">PolicyCentral AI &#183; Summary</div>
        <div class="pt-summary-body"></div>
      </div>

      <div class="pt-panel pt-ask" data-panel="ask" hidden>
        <button type="button" class="pt-panel-close" aria-label="Close">&times;</button>
        <div class="pt-panel-eyebrow">Ask PolicyGPT about this policy</div>
        <div class="pt-ask-log" aria-live="polite"></div>
        <form class="pt-ask-form">
          <input type="text" class="pt-ask-q" placeholder="e.g. What happens if the policy is breached?" maxlength="500" autocomplete="off">
          <button type="submit" class="btn btn-primary">Ask</button>
        </form>
        <div class="pt-ask-note">Answers are generated from this policy only. Not legal advice.</div>
      </div>

      <div class="pt-panel pt-faq-panel" data-panel="faq" hidden>
        <button type="button" class="pt-panel-close" aria-label="Close FAQs">&times;</button>
        <div class="pt-panel-eyebrow">Frequently asked questions</div>
        <div class="pt-faq-list"></div>
      </div>

      <div class="pt-panel pt-infographic" data-panel="infographic" hidden>
        <button type="button" class="pt-panel-close" aria-label="Close infographic">&times;</button>
        <div class="pt-panel-eyebrow">PolicyCentral AI &#183; Policy at a glance</div>
        <div class="pt-ig-card"></div>
      </div>

      <div class="pt-doc" id="pt-doc"><?php echo $body; // trusted seeded HTML ?></div>

      <?php
      // Related — same category first, then top up from other categories to 3
      // so a small category never shows a lonely single card.
      $need    = 3;
      $related = array();
      if ($category) {
          $rq = new WP_Query(array(
              'post_type'      => PCPL_CPT::POST_TYPE,
              'posts_per_page' => $need,
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
      if (count($related) < $need) {
          $exclude = array_merge(array($pid), wp_list_pluck($related, 'ID'));
          $fill = new WP_Query(array(
              'post_type'      => PCPL_CPT::POST_TYPE,
              'posts_per_page' => $need - count($related),
              'post__not_in'   => $exclude,
              'orderby'        => 'rand',
          ));
          $related = array_merge($related, $fill->posts);
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

      <?php
      // Browse all categories — quick jump to any other category hub.
      $all_cats     = function_exists('pcpl_categories') ? pcpl_categories() : array();
      $cur_cat_slug = $category ? $category->slug : '';
      if ($all_cats) : ?>
      <section class="pt-cats">
        <h2>Browse all policy categories</h2>
        <div class="pt-cats-grid">
          <?php foreach ($all_cats as $cslug => $c) :
              $cterm = get_term_by('slug', $cslug, PCPL_CPT::TAXONOMY);
              $curl  = $cterm ? get_term_link($cterm) : home_url('/policies/category/' . $cslug . '/');
              if (is_wp_error($curl)) $curl = home_url('/policies/category/' . $cslug . '/');
              $is_cur = ($cslug === $cur_cat_slug); ?>
            <a class="pt-cat-pill<?php echo $is_cur ? ' is-current' : ''; ?>" href="<?php echo esc_url($curl); ?>" style="--cat-accent:<?php echo esc_attr($c['accent']); ?>"<?php echo $is_cur ? ' aria-current="true"' : ''; ?>>
              <span class="pt-cat-ico" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><?php echo $c['icon']; ?></svg></span>
              <span class="pt-cat-name"><?php echo esc_html($c['name']); ?></span>
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
        <form class="pt-lead-form" data-policy="<?php echo esc_attr(get_post_field('post_name', $pid)); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce('pcpl_lead')); ?>" data-ajax="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
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
      <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>Book a walkthrough</a>
      <a href="<?php echo esc_url(home_url('/policies/')); ?>" class="btn btn-secondary">Explore other policies <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
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
  // Lead form — mail-me-PDF endpoint.
  var f=document.querySelector('.pt-lead-form');
  if(f){f.addEventListener('submit',function(e){
    e.preventDefault();
    var m=f.parentNode.querySelector('.pt-fc-msg'), btn=f.querySelector('button');
    m.className='pt-fc-msg show'; m.textContent='Generating your personalized PDF...';
    btn.disabled=true;
    var fd=new FormData(f);
    fd.append('action','pcpl_lead');
    fd.append('nonce',f.getAttribute('data-nonce'));
    fd.append('policy',f.getAttribute('data-policy'));
    fetch(f.getAttribute('data-ajax'),{method:'POST',body:fd,credentials:'same-origin'})
      .then(function(r){return r.json();})
      .then(function(res){
        btn.disabled=false;
        if(res && res.success){ m.className='pt-fc-msg show'; m.textContent=res.data.message; f.reset(); }
        else { m.className='pt-fc-msg show pt-fc-err'; m.textContent=(res&&res.data)?res.data:'Something went wrong. Please try again.'; }
      })
      .catch(function(){ btn.disabled=false; m.className='pt-fc-msg show pt-fc-err'; m.textContent='Network error. Please try again.'; });
  });}
})();
</script>

<?php
endwhile;
get_footer();
