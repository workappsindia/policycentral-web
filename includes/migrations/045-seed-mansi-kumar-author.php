<?php
/**
 * Migration 045: Seed the "Mansi Kumar" guest author.
 *
 * Idempotent. Photo at assets/authors/mansi-kumar.png. Linked from the
 * Compliance & Audit blog batch (migrations 047–050).
 */

function pcgpt_migration_045_seed_mansi_kumar_author() {
    if (!post_type_exists('pc_author')) {
        error_log('PCGPT Migration 045: pc_author CPT not registered');
        return;
    }

    $slug = 'mansi-kumar';

    $existing = get_posts(array(
        'name'        => $slug,
        'post_type'   => 'pc_author',
        'post_status' => array('publish', 'draft'),
        'numberposts' => 1,
    ));
    if (!empty($existing)) return;

    $bio = "I'm passionate about revolutionising the way businesses broadcast communication and engage with their multiple stakeholders be it customers, employees, partners.\n\nWith PolicyCentral.ai I've ventured into a new realm of businesses broadcasting communication to their employees, agents.";

    $author_id = wp_insert_post(array(
        'post_title'   => 'Mansi Kumar',
        'post_name'    => $slug,
        'post_status'  => 'publish',
        'post_type'    => 'pc_author',
        'post_content' => $bio,
        'post_author'  => 1,
    ), true);

    if (is_wp_error($author_id) || !$author_id) {
        error_log('PCGPT Migration 045: insert failed');
        return;
    }

    update_post_meta($author_id, '_pcb_designation', 'Global Partnerships Lead');
    update_post_meta($author_id, '_pcb_linkedin',    'https://www.linkedin.com/in/mansi-kumar-12668b21/');
    update_post_meta($author_id, '_pcb_twitter',     '');
    update_post_meta($author_id, '_pcb_email',       '');

    $photo_path = get_template_directory() . '/assets/authors/mansi-kumar.png';
    if (file_exists($photo_path) && function_exists('pcgpt_attach_author_photo')) {
        pcgpt_attach_author_photo($author_id, $photo_path, 'mansi-kumar.png');
    }
}
