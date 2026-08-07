<?php
/**
 * Migration 107: Clear cached policy translations.
 *
 * The translation prompt changed: the organization is now rendered in the target
 * language as "the Company" (no [Company Name] marker, no parenthetical alias),
 * matching the on-screen cleanup applied to the English body and AI panels.
 * Delete the cached translations (_pcpl_tr_{lang} meta) so each regenerates with
 * the new prompt the next time it is requested.
 *
 * Idempotent: deleting absent meta is a no-op.
 */

function pcgpt_migration_107_clear_cached_translations() {
    if (!class_exists('PCPL_CPT')) return;
    $langs = class_exists('PCPL_Interactive') ? array_keys(PCPL_Interactive::languages()) : array();
    if (!$langs) return;

    $ids = get_posts(array(
        'post_type'   => PCPL_CPT::POST_TYPE,
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => -1,
        'fields'      => 'ids',
    ));

    foreach ($ids as $pid) {
        foreach ($langs as $code) {
            delete_post_meta($pid, '_pcpl_tr_' . $code);
        }
    }
}
