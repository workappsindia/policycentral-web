<?php
/**
 * Migration 095: Refresh Tony Thomas' author designation and bio to use full
 * brand domains (PolicyCentral.ai, VideoCX.io) wherever the brands are named.
 *
 * Migration 005 seeded "Lead – PolicyCentral & VideoCX" and a bio naming
 * "PolicyCentral & VideoCX". This updates the existing pc_author record to the
 * full-domain form. Idempotent: only writes when the current value differs.
 */

function pcgpt_migration_095_refresh_tony_thomas_full_domains() {
    if (!post_type_exists('pc_author')) return;

    $target_designation = 'Lead – PolicyCentral.ai & VideoCX.io';
    $target_bio         = 'My role is to oversee & drive growth for PolicyCentral.ai & VideoCX.io. Responsible for developing and implementing strategies to maximise the profitability and growth for both the products.';

    $tony = get_posts(array(
        'name'        => 'tony-thomas',
        'post_type'   => 'pc_author',
        'post_status' => array('publish', 'draft'),
        'numberposts' => 1,
    ));
    if (empty($tony)) return;

    $author = $tony[0];

    if (get_post_meta($author->ID, '_pcb_designation', true) !== $target_designation) {
        update_post_meta($author->ID, '_pcb_designation', $target_designation);
    }

    if (trim($author->post_content) !== trim($target_bio)) {
        wp_update_post(array(
            'ID'           => (int) $author->ID,
            'post_content' => $target_bio,
        ));
    }
}
