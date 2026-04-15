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
?>
<main id="content" class="pcb-page">

  <section class="pcb-hero pcb-hero--sm">
    <div class="container">
      <div class="pcb-hero-inner">
        <nav class="pcb-breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url(home_url('/blogs/')); ?>">Blogs</a>
          <span aria-hidden="true">/</span>
          <span><?php echo esc_html($term ? $term->name : 'Category'); ?></span>
        </nav>
        <h1 class="pcb-hero-title"><?php echo esc_html($term ? $term->name : 'Category'); ?></h1>
        <?php if ($term && $term->description) : ?>
          <p class="pcb-hero-sub"><?php echo esc_html($term->description); ?></p>
        <?php endif; ?>
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
