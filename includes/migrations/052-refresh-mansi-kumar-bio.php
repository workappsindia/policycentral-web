<?php
/**
 * Migration 052: Refresh Mansi Kumar's author bio.
 *
 * Migration 045 seeded the initial bio with a third paragraph about VideoCX.io.
 * That paragraph has since been removed from the published bio. This migration
 * updates the existing pc_author post_content to the trimmed version.
 *
 * Idempotent: only writes if the current content differs from the target.
 */

function pcgpt_migration_052_refresh_mansi_kumar_bio() {
    if (!post_type_exists('pc_author')) return;

    $target_bio = "I'm passionate about revolutionising the way businesses broadcast communication and engage with their multiple stakeholders be it customers, employees, partners.\n\nWith PolicyCentral.ai I've ventured into a new realm of businesses broadcasting communication to their employees, agents.";

    $mansi = get_posts(array(
        'name'        => 'mansi-kumar',
        'post_type'   => 'pc_author',
        'post_status' => array('publish', 'draft'),
        'numberposts' => 1,
    ));
    if (empty($mansi)) return;

    $author = $mansi[0];
    if (trim($author->post_content) === trim($target_bio)) return;

    wp_update_post(array(
        'ID'           => (int) $author->ID,
        'post_content' => $target_bio,
    ));
}
