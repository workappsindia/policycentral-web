<?php
/**
 * Template Part: Blog Post Card
 *
 * Reusable card for listing blog posts. Used in:
 *  - /blogs/ index
 *  - /blogs/{category}/ archive
 *  - /blogs/author/{name}/ archive
 *  - search results
 *  - related posts
 *  - homepage "Latest from our blog" section
 *
 * Expects $post to be set (in the loop or passed explicitly).
 *
 * Optional $args:
 *   $args['variant'] = 'default' | 'compact' | 'featured'
 */

if (!defined('ABSPATH')) exit;

$variant = isset($args['variant']) ? $args['variant'] : 'default';
$post_id = get_the_ID();
$permalink = get_permalink($post_id);
$category = pcb_get_primary_category($post_id);
$guest_author = pcb_get_guest_author($post_id);
$author_name = $guest_author ? $guest_author->post_title : get_the_author();
$author_url  = $guest_author ? pcb_author_url($guest_author) : '';
$reading = pcb_reading_time($post_id);
?>
<article class="pcb-card pcb-card--<?php echo esc_attr($variant); ?>">
  <a href="<?php echo esc_url($permalink); ?>" class="pcb-card-media" aria-label="<?php echo esc_attr(get_the_title()); ?>">
    <?php if (has_post_thumbnail($post_id)) : ?>
      <?php echo get_the_post_thumbnail($post_id, 'large', array('loading' => 'lazy')); ?>
    <?php else : ?>
      <div class="pcb-card-media-fallback">
        <?php echo PCB_Icons::cover($category ? $category->slug : 'default'); ?>
      </div>
    <?php endif; ?>
  </a>
  <div class="pcb-card-body">
    <?php if ($category) : ?>
      <a href="<?php echo esc_url(home_url('/blogs/' . $category->slug . '/')); ?>" class="pcb-card-cat"><?php echo esc_html($category->name); ?></a>
    <?php endif; ?>
    <h3 class="pcb-card-title"><a href="<?php echo esc_url($permalink); ?>"><?php the_title(); ?></a></h3>
    <?php if ($variant !== 'compact') : ?>
      <p class="pcb-card-excerpt"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22, '…')); ?></p>
    <?php endif; ?>
    <div class="pcb-card-meta">
      <?php if ($author_url) : ?>
        <a href="<?php echo esc_url($author_url); ?>" class="pcb-card-author"><?php echo esc_html($author_name); ?></a>
      <?php else : ?>
        <span class="pcb-card-author"><?php echo esc_html($author_name); ?></span>
      <?php endif; ?>
      <span class="pcb-card-dot" aria-hidden="true">•</span>
      <time class="pcb-card-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date('M j, Y')); ?></time>
      <span class="pcb-card-dot" aria-hidden="true">•</span>
      <span class="pcb-card-read"><?php echo (int) $reading; ?> min read</span>
    </div>
  </div>
</article>
