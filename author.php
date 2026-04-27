<?php
/**
 * Guest Author Archive
 *
 * URL: /blogs/author/{author-slug}/
 * Shows: author profile (photo, bio, socials) + all their posts.
 */
get_header();

$author_slug = get_query_var('pcb_author');
$author = $author_slug ? get_page_by_path($author_slug, OBJECT, 'pc_author') : null;

if (!$author) {
    // Shouldn't happen (rewrite class sets 404), but guard anyway
    global $wp_query;
    $wp_query->set_404();
    status_header(404);
    get_template_part('404');
    get_footer();
    exit;
}

$designation = pcb_author_meta($author->ID, 'designation');
$linkedin    = pcb_author_meta($author->ID, 'linkedin');
$twitter     = pcb_author_meta($author->ID, 'twitter');
$email       = pcb_author_meta($author->ID, 'email');
$bio         = $author->post_content;
$photo_html  = has_post_thumbnail($author->ID)
    ? get_the_post_thumbnail($author->ID, array(180, 180), array('loading' => 'eager', 'class' => 'pcb-author-page-photo-img'))
    : '';
?>
<main id="content" class="pcb-page">

  <section class="pcb-author-hero">
    <div class="container">
      <nav class="pcb-breadcrumb" aria-label="Breadcrumb">
        <a href="<?php echo esc_url(home_url('/blogs/')); ?>">Blogs</a>
        <span aria-hidden="true">/</span>
        <span>Authors</span>
        <span aria-hidden="true">/</span>
        <span><?php echo esc_html($author->post_title); ?></span>
      </nav>
      <div class="pcb-author-hero-inner">
        <div class="pcb-author-page-photo">
          <?php if ($photo_html) : ?>
            <?php echo $photo_html; ?>
          <?php else : ?>
            <span class="pcb-author-photo-initials">
              <?php
              $parts = preg_split('/\s+/', trim($author->post_title));
              echo esc_html(strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1)));
              ?>
            </span>
          <?php endif; ?>
        </div>
        <div class="pcb-author-hero-body">
          <h1 class="pcb-author-hero-name"><?php echo esc_html($author->post_title); ?></h1>
          <?php if ($designation) : ?>
            <div class="pcb-author-hero-role"><?php echo esc_html($designation); ?></div>
          <?php endif; ?>
          <?php if ($bio) : ?>
            <div class="pcb-author-hero-bio"><?php echo wp_kses_post(wpautop($bio)); ?></div>
          <?php endif; ?>
          <div class="pcb-author-socials">
            <?php if ($linkedin) : ?>
              <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener nofollow" aria-label="LinkedIn">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3A2 2 0 0 1 21 5V19A2 2 0 0 1 19 21H5A2 2 0 0 1 3 19V5A2 2 0 0 1 5 3H19M18.5 18.5V13.2A3.26 3.26 0 0 0 15.24 9.94C14.39 9.94 13.4 10.46 12.92 11.24V10.13H10.13V18.5H12.92V13.57C12.92 12.8 13.54 12.17 14.31 12.17A1.4 1.4 0 0 1 15.71 13.57V18.5H18.5M6.88 8.56A1.68 1.68 0 0 0 8.56 6.88C8.56 5.95 7.81 5.19 6.88 5.19A1.69 1.69 0 0 0 5.19 6.88C5.19 7.81 5.95 8.56 6.88 8.56M8.27 18.5V10.13H5.5V18.5H8.27Z"/></svg>
              </a>
            <?php endif; ?>
            <?php if ($twitter) : ?>
              <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener nofollow" aria-label="Twitter/X">
                <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
              </a>
            <?php endif; ?>
            <?php if ($email) : ?>
              <a href="mailto:<?php echo esc_attr($email); ?>" aria-label="Email">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="pcb-wrap container">
    <div class="pcb-layout">
      <div class="pcb-main">
        <h2 class="pcb-section-label">Articles by <?php echo esc_html($author->post_title); ?></h2>
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
            <p><?php echo esc_html($author->post_title); ?> hasn't published any articles yet. Check back soon.</p>
          </div>
        <?php endif; ?>
      </div>
      <?php get_template_part('template-parts/blog-sidebar'); ?>
    </div>
  </div>

</main>
<?php get_footer();
