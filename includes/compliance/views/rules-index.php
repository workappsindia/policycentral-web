<?php
/**
 * View: Compliance Intelligence, rule library index  (/compliance/rules)
 * Routed here by PCC_Rewrite (pcc_view=rules_index).
 *
 * A grid of decoded RBI instruments (the rbi_rule CPT). Links to each decode.
 */
defined('ABSPATH') || exit;

get_header();

$rules = get_posts(array(
    'post_type'      => 'rbi_rule',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
));
?>
<section id="hub-hero">
<div class="hub-mesh"></div>
<div class="container">
  <div class="hub-hero-l">
    <h1>RBI <span class="g-text">Rule Library</span></h1>
    <p>Plain-language decodes of the RBI instruments that matter, applicability, obligations, what RBI penalised, lineage and source. Linked to the original, honest about scope, not legal advice.</p>
    <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Rule Library'))); ?>
  </div>
</div>
</section>

<section class="section" style="padding-top:56px">
<div class="container">
  <?php if ($rules) : ?>
  <div class="trk-summary"><b><?php echo count($rules); ?></b> decode<?php echo count($rules) === 1 ? '' : 's'; ?> published &middot; more on the way as we work backwards from what RBI enforces</div>
  <div class="rule-grid">
    <?php foreach ($rules as $rule) :
        $cls    = wp_get_object_terms($rule->ID, 'entity_class', array('fields' => 'names'));
        $cls    = $cls && !is_wp_error($cls) ? $cls[0] : '';
        $status = get_post_meta($rule->ID, '_pcc_status', true);
        $blurb  = $rule->post_excerpt ?: wp_trim_words($rule->post_content, 32);
    ?>
    <a class="rule-card reveal" href="<?php echo esc_url(get_permalink($rule->ID)); ?>">
      <div class="rule-card-top">
        <?php if ($cls) : ?><span class="rule-badge cls"><?php echo esc_html($cls); ?></span><?php endif; ?>
        <?php if ($status === 'in-force') : ?><span class="rule-badge status">In force</span><?php endif; ?>
      </div>
      <h3><?php echo esc_html(get_the_title($rule->ID)); ?></h3>
      <p><?php echo esc_html($blurb); ?></p>
      <span class="rule-link">Read the decode <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span>
    </a>
    <?php endforeach; ?>
  </div>
  <?php else : ?>
  <div class="pcc-soon-note">The rule library is being populated. Check back shortly.</div>
  <?php endif; ?>
</div>
</section>

<?php pcc_disclaimer(); ?>
<?php get_footer(); ?>
