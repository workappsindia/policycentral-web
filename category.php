<?php
/**
 * Category Archive
 *
 * URL: /blogs/{category-slug}/
 * Shows all posts in the category with pagination + sidebar.
 */
get_header();

$cat_slug = get_query_var('pcb_category');
if (!$cat_slug) $cat_slug = get_query_var('category_name');
$term = $cat_slug ? get_term_by('slug', $cat_slug, 'category') : null;
if (!$term) $term = get_queried_object();

// Split the category name so the last word renders inside <em>, matching
// the FAQ hero's "Frequently Asked <em>Questions</em>" pattern.
$cat_name  = $term ? $term->name : 'Category';
$name_bits = explode(' ', $cat_name);
$last_word = array_pop($name_bits);
$lead_part = implode(' ', $name_bits);
?>
<main id="content" class="pcb-page">

  <!-- CATEGORY HERO (mirrors FAQ hero design) -->
  <section class="faq-hero pcb-cat-hero">
    <div class="hero-mesh" aria-hidden="true"></div>
    <div class="container">
      <a href="<?php echo esc_url(home_url('/blogs/')); ?>" class="faq-tag pcb-cat-tag">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="11" height="11" style="margin-right:2px"><polyline points="15 18 9 12 15 6"/></svg>
        All Blogs
      </a>
      <h1>
        <?php if ($lead_part !== '') : ?>
          <?php echo esc_html($lead_part); ?> <em><?php echo esc_html($last_word); ?></em>
        <?php else : ?>
          <em><?php echo esc_html($last_word); ?></em>
        <?php endif; ?>
      </h1>
      <?php if ($term && $term->description) : ?>
        <p><?php echo esc_html($term->description); ?></p>
      <?php endif; ?>
    </div>
  </section>

  <div class="pcb-wrap container">
    <div class="pcb-layout">
      <div class="pcb-main">
        <?php if (have_posts()) : ?>
          <div class="pcb-grid">
            <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part('template-parts/blog-card'); ?>
            <?php endwhile; ?>
          </div>
          <nav class="pcb-pagination" aria-label="Pagination">
            <?php
            echo paginate_links(array(
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'type'      => 'list',
            ));
            ?>
          </nav>
        <?php else : ?>
          <div class="pcb-empty">
            <h2>No articles in this category yet</h2>
            <p>Check back soon, or <a href="<?php echo esc_url(home_url('/blogs/')); ?>">browse all articles</a>.</p>
          </div>
        <?php endif; ?>
      </div>
      <?php get_template_part('template-parts/blog-sidebar'); ?>
    </div>
  </div>

</main>
<?php get_footer();
