<?php
/**
 * View: Compliance Intelligence, theme hub  (/compliance/{theme})
 * Routed here by PCC_Rewrite (pcc_view=hub, pcc_theme={slug}).
 *
 * Router: if a per-theme content partial exists at views/hubs/{slug}.php it is
 * rendered (the live hub); otherwise the interim "being built" shell shows.
 * The partial outputs only the page sections, header/footer are handled here.
 */
defined('ABSPATH') || exit;

$theme_slug = get_query_var('pcc_theme');
$term       = get_term_by('slug', $theme_slug, 'theme');
$theme_name = $term ? $term->name : ucwords(str_replace('-', ' ', $theme_slug));
$partial    = PCC_DIR . '/views/hubs/' . sanitize_file_name($theme_slug) . '.php';

get_header();

if (file_exists($partial)) {
    include $partial;
} else {
    ?>
    <section id="hub-hero">
    <div class="hub-mesh"></div>
    <div class="container">
      <div class="hub-hero-l">
        <h1><span class="g-text"><?php echo esc_html($theme_name); ?></span></h1>
        <p>This theme hub is being built. It will set out what the rules require, who they apply to, and what RBI has penalised, linked to the source and honest about scope.</p>
        <div class="pcc-soon-note">
          Hub content is in progress. In the meantime, explore the enforcement tracker or the rule library.
        </div>
        <div class="hub-hero-btns" style="margin-top:24px">
          <a href="<?php echo esc_url(home_url('/compliance/enforcement-tracker/')); ?>" class="btn btn-primary">Enforcement tracker <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
          <a href="<?php echo esc_url(home_url('/compliance/')); ?>" class="btn btn-secondary">All themes</a>
        </div>
        <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => $theme_name))); ?>
      </div>
    </div>
    </section>
    <?php
}

pcc_disclaimer();
get_footer();
