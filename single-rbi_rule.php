<?php
/**
 * Single template, rbi_rule (Compliance Intelligence rule decode).
 *
 * Router: a per-decode content partial at includes/compliance/views/rules/{slug}.php
 * renders the rich decode body (full control, no wpautop). If none exists, a
 * generic fallback renders the post title + content. Header/footer + the TOC
 * scrollspy are handled here.
 */
defined('ABSPATH') || exit;

get_header();

while (have_posts()) : the_post();
    $slug    = get_post_field('post_name', get_the_ID());
    $partial = get_template_directory() . '/includes/compliance/views/rules/' . sanitize_file_name($slug) . '.php';

    if (file_exists($partial)) {
        include $partial;
    } else {
        ?>
        <section id="rule-head">
        <div class="rh-mesh"></div>
        <div class="container">
          <div class="rh-inner"><h1><?php the_title(); ?></h1>
          <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Rule Library', 'url' => home_url('/compliance/rules/')), array('label' => get_the_title()))); ?></div>
        </div>
        </section>
        <div class="container"><div class="doc"><main class="body-col" style="grid-column:1/-1"><?php the_content(); ?></main></div></div>
        <?php
    }
endwhile;
?>

<script>
/* Rule decode, TOC scrollspy (harmless if the page has no TOC) */
(function(){
  var secs  = document.querySelectorAll('.sec[id]');
  var links = document.querySelectorAll('.toc-link');
  if (!secs.length || !links.length) return;
  var spy = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
      if (e.isIntersecting) {
        links.forEach(function(l){ l.classList.toggle('on', l.getAttribute('href') === '#' + e.target.id); });
      }
    });
  }, { rootMargin: '-20% 0px -70% 0px' });
  secs.forEach(function(s){ spy.observe(s); });
})();
</script>

<?php pcc_disclaimer(); ?>
<?php get_footer(); ?>
