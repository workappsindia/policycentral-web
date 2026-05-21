<?php
/**
 * Migration 056: Enable the side-image hero variant on the Policy Audit
 * Checklist blog post.
 *
 * Sets the `_pcb_hero_show_image` post meta to '1' so single.php renders the
 * featured image alongside the title instead of using the gradient-only hero.
 *
 * This is a deliberate per-post opt-in (rather than site-wide) so the change
 * can be evaluated visually before rolling out to other posts whose featured
 * images may or may not work well in a side-by-side layout.
 *
 * Idempotent: update_post_meta only writes if the value differs.
 */

function pcgpt_migration_056_enable_side_image_hero_policy_audit() {

    $slug = 'policy-audit-checklist-indian-hr-compliance';

    $posts = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'posts_per_page' => 1,
    ));
    if (empty($posts)) return;

    update_post_meta((int) $posts[0]->ID, '_pcb_hero_show_image', '1');
}
