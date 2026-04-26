<?php
/**
 * Template Part: Blog Sidebar
 *
 * Appears on /blogs/, category, author, search, and single post pages.
 * Contains:
 *  - Blog search (scoped to posts)
 *  - Table of contents (ONLY on single posts, sticky while scrolling)
 *  - Categories list
 *  - Recent posts
 *
 * Optional $args:
 *   $args['show_toc'] = bool (default: false)
 */

if (!defined('ABSPATH')) exit;

$show_toc = !empty($args['show_toc']);
$toc_items = $show_toc ? pcb_build_toc() : array();

$categories = get_categories(array(
    // hide_empty=true: categories with zero posts (e.g. Corporate Updates,
    // SOPs, Branch Circulars, etc.) stay hidden in the sidebar until a
    // post is published in them. The category terms still exist in the DB.
    'hide_empty' => true,
    'orderby'    => 'count',
    'order'      => 'DESC',
    'exclude'    => array_filter(array(
        // Defensive: hide the default "Uncategorized" term if it ever
        // reappears (e.g. from WP core recreating it). We already
        // deleted it and moved default_category, but this guards
        // against it showing up in the sidebar.
        (int) get_cat_ID('Uncategorized'),
    )),
));

$recent = get_posts(array(
    'numberposts' => 5,
    'post_status' => 'publish',
    'post__not_in' => array(get_the_ID()),
));
?>
<aside class="pcb-sidebar" role="complementary">

  <!-- TOC (single-post only) -->
  <?php if ($show_toc && !empty($toc_items)) : ?>
    <div class="pcb-side-block pcb-side-toc" data-pcb-toc>
      <h4 class="pcb-side-title">On this page</h4>
      <nav class="pcb-toc-nav" aria-label="Table of contents">
        <ol class="pcb-toc-list">
          <?php foreach ($toc_items as $item) : ?>
            <li><a href="#<?php echo esc_attr($item['id']); ?>" class="pcb-toc-link" data-target="<?php echo esc_attr($item['id']); ?>"><?php echo esc_html($item['text']); ?></a></li>
          <?php endforeach; ?>
        </ol>
      </nav>
    </div>
  <?php endif; ?>

  <!-- Search -->
  <div class="pcb-side-block">
    <h4 class="pcb-side-title">Search</h4>
    <form class="pcb-side-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input type="search" id="pcb-search" name="s" aria-label="Search articles" placeholder="Search articles…" value="<?php echo esc_attr(get_search_query()); ?>">
      <input type="hidden" name="post_type" value="post">
      <button type="submit" aria-label="Search">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      </button>
    </form>
  </div>

  <!-- Categories -->
  <div class="pcb-side-block">
    <h4 class="pcb-side-title">Categories</h4>
    <ul class="pcb-side-cats">
      <?php foreach ($categories as $cat) : ?>
        <li>
          <a href="<?php echo esc_url(home_url('/blogs/' . $cat->slug . '/')); ?>">
            <span class="pcb-cat-name"><?php echo esc_html($cat->name); ?></span>
            <span class="pcb-cat-count"><?php echo (int) $cat->count; ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <!-- Recent Posts -->
  <?php if (!empty($recent)) : ?>
    <div class="pcb-side-block">
      <h4 class="pcb-side-title">Recent Posts</h4>
      <ul class="pcb-side-recent">
        <?php foreach ($recent as $post) : setup_postdata($post); ?>
          <li>
            <a href="<?php echo esc_url(get_permalink($post)); ?>">
              <?php if (has_post_thumbnail($post)) : ?>
                <span class="pcb-recent-thumb"><?php echo get_the_post_thumbnail($post, array(72, 72), array('loading' => 'lazy')); ?></span>
              <?php else :
                $recent_cat = pcb_get_primary_category($post->ID);
                $recent_slug = $recent_cat ? $recent_cat->slug : 'default';
              ?>
                <span class="pcb-recent-thumb pcb-recent-thumb--icon pcb-recent-thumb--<?php echo esc_attr($recent_slug); ?>" aria-hidden="true">
                  <?php echo PCB_Icons::icon($recent_slug); ?>
                </span>
              <?php endif; ?>
              <span class="pcb-recent-body">
                <span class="pcb-recent-title"><?php echo esc_html(wp_trim_words(get_the_title($post), 10, '…')); ?></span>
                <span class="pcb-recent-date"><?php echo esc_html(get_the_date('M j, Y', $post)); ?></span>
              </span>
            </a>
          </li>
        <?php endforeach; wp_reset_postdata(); ?>
      </ul>
    </div>
  <?php endif; ?>

</aside>
