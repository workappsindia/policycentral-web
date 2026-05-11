<?php
/**
 * Migration 043: Swap the DPDP Act link to the direct MeitY PDF.
 *
 * Background: the meity.gov.in/content/digital-personal-data-protection-act-2023
 * landing page was reported as not opening on the dev environment review.
 * Replacing across all 4 posts that referenced it with the direct PDF
 * of the Act hosted by MeitY (uploaded June 2024).
 *
 * Affected posts:
 *   - gig-worker-policy-india-2026
 *   - hr-policies-india-2026
 *   - what-is-policy-management-software
 *   - why-companies-fail-policy-compliance
 *
 * Idempotent via marker: the PDF filename, present only after this fix.
 */

function pcgpt_migration_043_refresh_dpdp_act_link() {

    $marker = 'static/uploads/2024/06/2bf1f0e9f04e6fb4f8fef35e82c42aa5.pdf';

    $files = array(
        'gig-worker-policy-india-2026'           => 'gig-worker-policy-india-2026.html',
        'hr-policies-india-2026'                 => 'hr-policies-india-2026.html',
        'what-is-policy-management-software'     => 'what-is-policy-management-software.html',
        'why-companies-fail-policy-compliance'   => 'why-companies-fail-policy-compliance.html',
    );

    foreach ($files as $slug => $data_file) {
        $posts = get_posts(array(
            'name'        => $slug,
            'post_type'   => 'post',
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));
        if (empty($posts)) {
            error_log("PCGPT Migration 043: post '{$slug}' not found — skipping");
            continue;
        }
        $post = $posts[0];

        if (strpos($post->post_content, $marker) !== false) {
            continue; // Already refreshed
        }

        $path = __DIR__ . '/data/' . $data_file;
        if (!file_exists($path)) {
            error_log("PCGPT Migration 043: data file missing — {$path}");
            continue;
        }
        $new_content = file_get_contents($path);
        if ($new_content === false || trim($new_content) === '') {
            error_log("PCGPT Migration 043: empty data file — {$path}");
            continue;
        }

        $result = wp_update_post(array(
            'ID'           => (int) $post->ID,
            'post_content' => $new_content,
        ), true);

        if (is_wp_error($result)) {
            error_log("PCGPT Migration 043: wp_update_post failed for {$slug} — " . $result->get_error_message());
        }
    }
}
