<?php
/**
 * Default template fallback.
 * All pages use specific page templates via WordPress template assignment.
 */
get_header();
?>

<div class="section">
  <div class="container" style="text-align:center;padding:120px 20px;">
    <h2>Page Not Found</h2>
    <p style="color:var(--gray-500);margin-top:16px;">This page doesn't have a template assigned.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary" style="margin-top:24px;">Go Home</a>
  </div>
</div>

<?php get_footer(); ?>
