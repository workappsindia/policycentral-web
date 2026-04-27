<?php
/**
 * Template Name: Blogs Index
 *
 * URL: /blogs/
 * Renders the main blog landing page — hero, featured post, grid, sidebar.
 */
get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));

// Fetch all published posts, paginated
$posts_query = new WP_Query(array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 9,
    'paged'          => $paged,
    'orderby'        => 'date',
    'order'          => 'DESC',
));
?>
<main id="content" class="pcb-page pcb-page--index">

  <!-- Hero -->
  <section class="pcb-hero">
    <div class="container">
      <div class="pcb-hero-inner">
        <h1 class="pcb-hero-title">Practical guides, industry insights, and product thinking from the <span class="g-text">PolicyCentral.ai</span> team.</h1>
      </div>
    </div>
  </section>

  <div class="pcb-wrap container">
    <div class="pcb-layout">

      <!-- Main column -->
      <div class="pcb-main">
        <?php if ($posts_query->have_posts()) : ?>
          <div class="pcb-grid">
            <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>
              <?php get_template_part('template-parts/blog-card'); ?>
            <?php endwhile; ?>
          </div>

          <!-- Pagination -->
          <nav class="pcb-pagination" aria-label="Blog pagination">
            <?php
            echo paginate_links(array(
                'total'     => $posts_query->max_num_pages,
                'current'   => $paged,
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'type'      => 'list',
            ));
            ?>
          </nav>
        <?php else : ?>
          <div class="pcb-empty">
            <h2>No articles yet</h2>
            <p>Check back soon — the first article is on its way.</p>
          </div>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
      </div>

      <!-- Sidebar -->
      <?php get_template_part('template-parts/blog-sidebar'); ?>
    </div>
  </div>

</main>
<?php get_footer();
