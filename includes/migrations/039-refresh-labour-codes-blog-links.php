<?php
/**
 * Migration 039: Refresh the Labour Codes blog post bodies after the
 * indiacode.nic.in handle URLs were corrected.
 *
 * Background: when migrations 033-036 were first written, the
 * indiacode.nic.in handle numbers used for the 4 Labour Codes were
 * fabricated and happened to resolve to entirely unrelated acts (Indian
 * Penal Code, Lotteries Act, NDPS Act, MTP Act, etc.). The data HTML
 * files were corrected to point at PRS India and PIB factsheets, but
 * the seeded post bodies still contained the wrong URLs because the
 * seeders are idempotent ("skip if exists").
 *
 * This migration re-reads the corrected data files and updates post
 * content. The idempotency marker is `prsindia.org/billtrack/the-code-on-wages-2019`
 * — present only in the corrected content, never in the original.
 *
 * Affected slugs:
 *   - india-new-labour-codes-hr-policy-rewrite  (Code on Wages, Social Sec, IR, OSHWC)
 *   - 50-percent-basic-salary-rule-compensation-policy  (Code on Wages)
 *   - fixed-term-employee-policy-india-labour-codes  (IR Code, Social Security Code)
 *   - gig-worker-policy-india-2026  (Code on Social Security)
 *
 * The 50% Basic Salary and Gig Worker posts each share at least one of the
 * four corrected URLs with the overview, so a single marker covers all four.
 */

function pcgpt_migration_039_refresh_labour_codes_blog_links() {

    $marker = 'prsindia.org/billtrack/the-code-on-wages-2019';

    $files = array(
        'india-new-labour-codes-hr-policy-rewrite'              => 'india-new-labour-codes-hr-policy-rewrite.html',
        '50-percent-basic-salary-rule-compensation-policy'      => '50-percent-basic-salary-rule-compensation-policy.html',
        'fixed-term-employee-policy-india-labour-codes'         => 'fixed-term-employee-policy-india-labour-codes.html',
        'gig-worker-policy-india-2026'                          => 'gig-worker-policy-india-2026.html',
    );

    foreach ($files as $slug => $data_file) {
        $posts = get_posts(array(
            'name'        => $slug,
            'post_type'   => 'post',
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));
        if (empty($posts)) {
            error_log("PCGPT Migration 039: post '{$slug}' not found — skipping");
            continue;
        }
        $post = $posts[0];

        $path = __DIR__ . '/data/' . $data_file;
        if (!file_exists($path)) {
            error_log("PCGPT Migration 039: data file missing — {$path}");
            continue;
        }
        $new_content = file_get_contents($path);
        if ($new_content === false || trim($new_content) === '') {
            error_log("PCGPT Migration 039: empty data file — {$path}");
            continue;
        }

        // Per-file idempotency: skip if the corrected marker for THIS file is already present.
        // For files that don't contain the Code-on-Wages link, use a different per-file marker.
        $per_file_marker = $marker;
        if ($slug === 'fixed-term-employee-policy-india-labour-codes' || $slug === 'gig-worker-policy-india-2026') {
            // These don't reference the Wage Code. Use the PIB Social Security URL as marker.
            $per_file_marker = 'pib.gov.in/FactsheetDetails.aspx?Id=150473';
        }

        if (strpos($post->post_content, $per_file_marker) !== false) {
            continue; // Already refreshed
        }

        $result = wp_update_post(array(
            'ID'           => (int) $post->ID,
            'post_content' => $new_content,
        ), true);

        if (is_wp_error($result)) {
            error_log("PCGPT Migration 039: wp_update_post failed for {$slug} — " . $result->get_error_message());
        }
    }
}
