<?php
/**
 * Single template, rbi_enforcement (one RBI enforcement action).
 * /compliance/enforcement/{id}
 *
 * Facts only (content governance): we state only what the RBI release says:
 * cited reasons, amount, dates, entity type. PolicyCentral's analytical lenses
 * (scope_fit, root_cause) live on the theme hubs, not on entity pages.
 */
defined('ABSPATH') || exit;

get_header();

$theme_labels = array(
    'internal-ombudsman'    => 'Internal Ombudsman',
    'kyc-ckycr'             => 'KYC & CKYCR',
    'customer-protection'   => 'Customer Protection',
    'prudential-governance' => 'Prudential & Governance',
    'fair-practices'        => 'Fair Practices (NBFC)',
    'change-of-control'     => 'Change of Control',
    'credit-reporting'      => 'Credit Reporting',
    'outsourcing'           => 'Outsourcing',
);

while (have_posts()) : the_post();
    $rec = PCC_Enforcement::get_by_slug(get_post_field('post_name', get_the_ID()));
    if (!$rec) { the_content(); continue; }

    $date   = !empty($rec['action_date']) ? date('d M Y', strtotime($rec['action_date'])) : '';
    $nonmon = !isset($rec['penalty_amount_lakhs']) || $rec['penalty_amount_lakhs'] === null;
    $themes = (array) ($rec['themes'] ?? array());
    $cited  = (array) ($rec['cited_reasons'] ?? array());
    $multi  = !empty($rec['multi_reason']);
    $rbiurl = $rec['rbi_press_release_url'] ?? '';

    // Related decodes that actually resolve to a published rbi_rule.
    $related = array();
    foreach ((array) ($rec['related_rules'] ?? array()) as $rs) {
        $rp = get_page_by_path($rs, OBJECT, 'rbi_rule');
        if ($rp && $rp->post_status === 'publish') {
            $related[] = $rp;
        }
    }
    ?>
    <section id="rule-head">
    <div class="rh-mesh"></div>
    <div class="container">
      <div class="rh-inner">
        <span class="eyebrow left">RBI enforcement action</span>
        <h1><?php echo esc_html($rec['entity_name'] ?? ''); ?></h1>
        <p class="lede"><?php echo esc_html(trim(($rec['re_type'] ?? '') . ' · ' . ($rec['action_type'] ?? '') . ($date ? ' · ' . $date : ''), ' ·')); ?></p>
        <div class="rh-actions">
          <a href="<?php echo esc_url(home_url('/compliance/enforcement-tracker/')); ?>" class="btn btn-secondary">← All actions</a>
          <?php if ($rbiurl) : ?><a href="<?php echo esc_url($rbiurl); ?>" target="_blank" rel="noopener" class="btn btn-primary">RBI press release <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg></a><?php endif; ?>
        </div>
        <?php pcc_breadcrumb(array(array('label' => 'Compliance Intelligence', 'url' => home_url('/compliance/')), array('label' => 'Enforcement Tracker', 'url' => home_url('/compliance/enforcement-tracker/')), array('label' => $rec['entity_name'] ?? ''))); ?>
      </div>
    </div>
    </section>

    <div class="container">
    <div style="max-width:860px;margin:0 auto;padding:48px 0 72px">

      <!-- Amount + reference -->
      <div class="metabox">
        <div class="metabox-head">The action</div>
        <div class="metabox-body">
          <div class="metabox-row"><span class="k">Penalty / action</span><span class="v"><?php echo esc_html($rec['penalty_amount_display'] ?? ''); ?><?php echo $multi ? ' (total)' : ''; ?></span></div>
          <div class="metabox-row"><span class="k">Entity type</span><span class="v"><?php echo esc_html($rec['re_type'] ?? ''); ?></span></div>
          <div class="metabox-row"><span class="k">Action date</span><span class="v"><?php echo esc_html($date); ?></span></div>
          <div class="metabox-row"><span class="k">Fiscal year</span><span class="v"><?php echo esc_html($rec['fiscal_year'] ?? ''); ?></span></div>
          <div class="metabox-row"><span class="k">Action type</span><span class="v"><?php echo esc_html($rec['action_type'] ?? ''); ?></span></div>
          <div class="metabox-row"><span class="k">Source</span><span class="v"><?php echo esc_html($rec['source'] ?? 'RBI press release'); ?></span></div>
        </div>
      </div>

      <!-- Cited reasons -->
      <section class="sec" id="reasons" style="margin-top:40px">
        <div class="sec-eyebrow"><span>What RBI cited</span></div>
        <h2>Reasons cited in the RBI release</h2>
        <?php if ($multi) : ?>
        <p style="font-size:13px;color:var(--gray-400)">This action cited more than one reason; the amount above is the <b>total penalty</b> and is not attributable to any single reason below.</p>
        <?php endif; ?>
        <div class="pen-grid" style="margin-top:8px">
          <?php foreach ($cited as $c) :
              $th = $c['theme'] ?? ''; ?>
          <div class="pen" style="cursor:default">
            <span class="pen-mid"><span class="r" style="font-size:13.5px;color:var(--gray-700)"><?php echo esc_html($c['text'] ?? ''); ?></span></span>
            <?php if ($th) : ?><a href="<?php echo esc_url(home_url('/compliance/' . $th . '/')); ?>" class="trk-theme" style="flex-shrink:0"><?php echo esc_html($theme_labels[$th] ?? $th); ?></a><?php endif; ?>
          </div>
          <?php endforeach; ?>
        </div>
      </section>

      <!-- Related -->
      <?php if ($related || $themes) : ?>
      <section class="sec" id="related" style="margin-top:40px">
        <div class="sec-eyebrow"><span>Connected</span></div>
        <h2>Rules &amp; themes this touches</h2>
        <div class="deep-grid">
          <?php foreach ($related as $rp) : ?>
          <a href="<?php echo esc_url(get_permalink($rp->ID)); ?>" class="deep"><div class="ib ib-teal"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div><div class="deep-txt"><h4><?php echo esc_html(get_the_title($rp->ID)); ?></h4><span>Read the rule decode</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
          <?php endforeach; ?>
          <?php foreach ($themes as $th) : ?>
          <a href="<?php echo esc_url(home_url('/compliance/' . $th . '/')); ?>" class="deep"><div class="ib ib-violet"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11"/></svg></div><div class="deep-txt"><h4><?php echo esc_html($theme_labels[$th] ?? $th); ?></h4><span>Theme hub</span></div><span class="deep-arrow"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></span></a>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endif; ?>

    </div>
    </div>
    <?php
endwhile;

pcc_disclaimer();
get_footer();
