<?php
/**
 * Migration 041: Refresh hr-policies-india-2026 with user-curated source URLs
 * for three statutory references.
 *
 * Migration 040 had landed working but non-preferred URLs:
 *   - Maternity Benefit Act → PRS India bill page
 *   - Payment of Gratuity Act → EPFO-hosted PDF
 *   - SEBI LODR Regulations → SEBI homepage listing page
 *
 * User-supplied authoritative sources (2026-05-11):
 *   - Maternity Benefit Act → labour.gov.in PDF (June 2025 upload)
 *   - Payment of Gratuity Act → clc.gov.in (Chief Labour Commissioner) PDF
 *   - SEBI LODR Regulations → SEBI's January 2026 consolidated regulations page
 *
 * Idempotent via marker: the SEBI 2026 URL slug, present only after this fix.
 */

function pcgpt_migration_041_refresh_hr_policies_blog_source_urls() {

    $slug   = 'hr-policies-india-2026';
    $marker = 'jan-2026/securities-and-exchange-board-of-india-listing-obligations-and-disclosure-requirements-regulations-2015-last-amended-on-january-22-2026-_99375';

    $posts = get_posts(array(
        'name'        => $slug,
        'post_type'   => 'post',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => 1,
    ));
    if (empty($posts)) {
        error_log("PCGPT Migration 041: post '{$slug}' not found — skipping");
        return;
    }
    $post = $posts[0];

    if (strpos($post->post_content, $marker) !== false) {
        return; // Already refreshed
    }

    $path = __DIR__ . '/data/' . $slug . '.html';
    if (!file_exists($path)) {
        error_log("PCGPT Migration 041: data file missing — {$path}");
        return;
    }
    $new_content = file_get_contents($path);
    if ($new_content === false || trim($new_content) === '') {
        error_log("PCGPT Migration 041: empty data file");
        return;
    }

    $result = wp_update_post(array(
        'ID'           => (int) $post->ID,
        'post_content' => $new_content,
    ), true);

    if (is_wp_error($result)) {
        error_log("PCGPT Migration 041: wp_update_post failed — " . $result->get_error_message());
    }
}
