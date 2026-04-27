<?php
/**
 * Template Part: Author Box
 *
 * Shown on single blog posts. Displays:
 *  - Photo
 *  - Name + designation
 *  - Bio
 *  - LinkedIn / Twitter / Email links
 *  - Link to author archive
 *
 * Prefers guest author (pc_author CPT). Falls back to WP user if no guest author.
 *
 * Optional $args:
 *   $args['variant'] = 'full' (default) | 'inline' (smaller, post header use)
 */

if (!defined('ABSPATH')) exit;

$variant = isset($args['variant']) ? $args['variant'] : 'full';
$guest = pcb_get_guest_author();

if ($guest) {
    $name        = $guest->post_title;
    $designation = pcb_author_meta($guest->ID, 'designation');
    $bio         = $guest->post_content;
    $linkedin    = pcb_author_meta($guest->ID, 'linkedin');
    $twitter     = pcb_author_meta($guest->ID, 'twitter');
    $email       = pcb_author_meta($guest->ID, 'email');
    $archive_url = pcb_author_url($guest);
    $photo_html  = has_post_thumbnail($guest->ID)
        ? get_the_post_thumbnail($guest->ID, array(120, 120), array('loading' => 'lazy', 'class' => 'pcb-author-photo-img'))
        : '';
} else {
    $user = get_userdata(get_the_author_meta('ID'));
    if (!$user) return;
    $name        = $user->display_name;
    $designation = '';
    $bio         = get_the_author_meta('description');
    $linkedin    = '';
    $twitter     = '';
    $email       = '';
    $archive_url = '';
    $photo_html  = get_avatar($user->ID, 120, '', '', array('class' => 'pcb-author-photo-img'));
}

$initials = '';
if (empty($photo_html)) {
    $parts = preg_split('/\s+/', trim($name));
    $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . substr($parts[1] ?? '', 0, 1));
}
?>
<div class="pcb-author-box pcb-author-box--<?php echo esc_attr($variant); ?>">
  <div class="pcb-author-photo">
    <?php if ($photo_html) : ?>
      <?php echo $photo_html; ?>
    <?php else : ?>
      <span class="pcb-author-photo-initials" aria-hidden="true"><?php echo esc_html($initials); ?></span>
    <?php endif; ?>
  </div>
  <div class="pcb-author-info">
    <div class="pcb-author-name">
      <?php if ($archive_url && $variant === 'inline') : ?>
        <a href="<?php echo esc_url($archive_url); ?>"><?php echo esc_html($name); ?></a>
      <?php else : ?>
        <?php echo esc_html($name); ?>
      <?php endif; ?>
    </div>
    <?php if ($designation) : ?>
      <div class="pcb-author-role"><?php echo esc_html($designation); ?></div>
    <?php endif; ?>
    <?php if ($variant === 'full' && $bio) : ?>
      <div class="pcb-author-bio"><?php echo wp_kses_post(wpautop($bio)); ?></div>
    <?php endif; ?>
    <?php if ($variant === 'full') : ?>
      <div class="pcb-author-socials">
        <?php if ($linkedin) : ?>
          <a href="<?php echo esc_url($linkedin); ?>" target="_blank" rel="noopener nofollow" aria-label="LinkedIn profile">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M19 3A2 2 0 0 1 21 5V19A2 2 0 0 1 19 21H5A2 2 0 0 1 3 19V5A2 2 0 0 1 5 3H19M18.5 18.5V13.2A3.26 3.26 0 0 0 15.24 9.94C14.39 9.94 13.4 10.46 12.92 11.24V10.13H10.13V18.5H12.92V13.57C12.92 12.8 13.54 12.17 14.31 12.17A1.4 1.4 0 0 1 15.71 13.57V18.5H18.5M6.88 8.56A1.68 1.68 0 0 0 8.56 6.88C8.56 5.95 7.81 5.19 6.88 5.19A1.69 1.69 0 0 0 5.19 6.88C5.19 7.81 5.95 8.56 6.88 8.56M8.27 18.5V10.13H5.5V18.5H8.27Z"/></svg>
          </a>
        <?php endif; ?>
        <?php if ($twitter) : ?>
          <a href="<?php echo esc_url($twitter); ?>" target="_blank" rel="noopener nofollow" aria-label="Twitter/X profile">
            <svg viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
        <?php endif; ?>
        <?php if ($email) : ?>
          <a href="mailto:<?php echo esc_attr($email); ?>" aria-label="Email">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </a>
        <?php endif; ?>
        <?php if ($archive_url) : ?>
          <a href="<?php echo esc_url($archive_url); ?>" class="pcb-author-archive-link">View all articles →</a>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</div>
