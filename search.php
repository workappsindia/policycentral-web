<?php
/**
 * Search Results — scoped to blog posts only
 *
 * URL: /?s=query&post_type=post (from the blog sidebar form)
 */
get_header();
$q = get_search_query();
?>
<main id="content" class="pcb-page">

  <section class="pcb-hero pcb-hero--sm">
    <div class="container">
      <div class="pcb-hero-inner">
        <nav class="pcb-breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url(home_url('/blogs/')); ?>">Blogs</a>
          <span aria-hidden="true">/</span>
          <span>Search</span>
        </nav>
        <h1 class="pcb-hero-title">Search results</h1>
        <p class="pcb-hero-sub">Results for <strong>“<?php echo esc_html($q); ?>”</strong></p>
      </div>
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
            <h2>No articles found</h2>
            <p>Try a different search term, or <a href="<?php echo esc_url(home_url('/blogs/')); ?>">browse all articles</a>.</p>
          </div>
        <?php endif; ?>
      </div>
      <?php get_template_part('template-parts/blog-sidebar'); ?>
    </div>
  </div>

</main>
<?php get_footer();
