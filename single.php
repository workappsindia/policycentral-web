<?php
/**
 * Single Blog Post Template
 *
 * URL: /blogs/{category-slug}/{post-slug}/
 * Shows: hero, author + meta, social share, content (with middle CTA auto-injected),
 * end CTA, social share again, related posts, sidebar.
 */
get_header();

if (have_posts()) : while (have_posts()) : the_post();

    $post_id      = get_the_ID();
    $category     = pcb_get_primary_category($post_id);
    $guest_author = pcb_get_guest_author($post_id);
    $author_name  = $guest_author ? $guest_author->post_title : get_the_author();
    $author_photo = $guest_author && has_post_thumbnail($guest_author->ID)
        ? get_the_post_thumbnail($guest_author->ID, array(48, 48), array('loading' => 'lazy', 'class' => 'pcb-byline-photo'))
        : ($guest_author ? '' : get_avatar(get_the_author_meta('ID'), 48, '', '', array('class' => 'pcb-byline-photo')));
    $author_url   = $guest_author ? pcb_author_url($guest_author) : '';
    $reading      = pcb_reading_time($post_id);
    // Intentional: single-post hero always uses the gradient — not the
    // featured image. Featured images contain their own text/composition
    // which competes with the post title for readability. The image
    // still appears everywhere else (card grid, homepage, OG tags).
?>
<main id="content" class="pcb-single">

  <!-- Hero -->
  <section class="pcb-post-hero has-gradient">
    <div class="pcb-post-hero-gradient" aria-hidden="true">
      <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--1"></div>
      <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--2"></div>
      <div class="pcb-post-hero-gradient-orb pcb-post-hero-gradient-orb--3"></div>
    </div>
    <div class="container">
      <div class="pcb-post-hero-inner">
        <nav class="pcb-breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url(home_url('/blogs/')); ?>">Blogs</a>
          <?php if ($category) : ?>
            <span aria-hidden="true">/</span>
            <a href="<?php echo esc_url(home_url('/blogs/' . $category->slug . '/')); ?>"><?php echo esc_html($category->name); ?></a>
          <?php endif; ?>
        </nav>
        <h1 class="pcb-post-title"><?php the_title(); ?></h1>
        <div class="pcb-post-meta">
          <div class="pcb-byline">
            <?php if ($author_photo) : ?>
              <?php if ($author_url) : ?>
                <a href="<?php echo esc_url($author_url); ?>"><?php echo $author_photo; ?></a>
              <?php else : ?>
                <?php echo $author_photo; ?>
              <?php endif; ?>
            <?php endif; ?>
            <div class="pcb-byline-info">
              <div class="pcb-byline-name">
                <?php if ($author_url) : ?>
                  <a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($author_name); ?></a>
                <?php else : ?>
                  <?php echo esc_html($author_name); ?>
                <?php endif; ?>
              </div>
              <div class="pcb-byline-meta">
                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('M j, Y')); ?></time>
                <span aria-hidden="true">•</span>
                <span><?php echo (int) $reading; ?> min read</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="pcb-wrap container">
    <div class="pcb-layout pcb-layout--single">

      <!-- Article column -->
      <article class="pcb-article" itemscope itemtype="https://schema.org/BlogPosting">
        <meta itemprop="headline" content="<?php echo esc_attr(get_the_title()); ?>">
        <meta itemprop="datePublished" content="<?php echo esc_attr(get_the_date('c')); ?>">
        <meta itemprop="author" content="<?php echo esc_attr($author_name); ?>">

        <!-- Share (top) -->
        <?php get_template_part('template-parts/blog-social-share'); ?>

        <!-- Content (middle CTA auto-injected by PCB_Content) -->
        <div class="pcb-article-body" itemprop="articleBody">
          <?php the_content(); ?>
        </div>

        <!-- Tags -->
        <?php
        $tags = get_the_tags();
        if ($tags && !is_wp_error($tags)) : ?>
          <div class="pcb-tags">
            <span class="pcb-tags-label">Tags:</span>
            <?php foreach ($tags as $tag) : ?>
              <a href="<?php echo esc_url(get_tag_link($tag)); ?>" class="pcb-tag">#<?php echo esc_html($tag->name); ?></a>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <!-- End CTA -->
        <?php echo pcb_end_cta(); ?>

        <!-- Share (bottom) -->
        <?php get_template_part('template-parts/blog-social-share'); ?>

        <!-- Author box -->
        <?php get_template_part('template-parts/author-box', null, array('variant' => 'full')); ?>

        <!-- Related posts -->
        <?php
        if ($category) {
            $related = new WP_Query(array(
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 3,
                'post__not_in'   => array($post_id),
                'category__in'   => array($category->term_id),
                'orderby'        => 'date',
                'order'          => 'DESC',
            ));
            if ($related->have_posts()) : ?>
              <section class="pcb-related" aria-labelledby="related-heading">
                <h3 id="related-heading" class="pcb-related-title">More in <?php echo esc_html($category->name); ?></h3>
                <div class="pcb-grid pcb-grid--3">
                  <?php while ($related->have_posts()) : $related->the_post(); ?>
                    <?php get_template_part('template-parts/blog-card', null, array('variant' => 'compact')); ?>
                  <?php endwhile; ?>
                </div>
              </section>
            <?php endif;
            wp_reset_postdata();
        }
        ?>

      </article>

      <!-- Sidebar with TOC -->
      <?php get_template_part('template-parts/blog-sidebar', null, array('show_toc' => true)); ?>

    </div>
  </div>

</main>
<?php endwhile; endif;
get_footer();
