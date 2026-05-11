<?php
/**
 * Migration 040: Fix broken/wrong external links in three existing blog posts.
 *
 * Audit (2026-05-11) found:
 *
 * - work-from-home-policy-india-2026: "POSH Act" pointed to wcd.nic.in/
 *   (dead domain). Replaced with the IndiaCode POSH Act page.
 *
 * - hr-policies-india-2026: "Maternity Benefit Act 2017" pointed to
 *   indiacode handle/15294 (which actually resolves to the MTP Act, 1971).
 *   Replaced with the PRS India page for the Maternity Benefit Amendment Bill.
 *
 * - hr-policies-india-2026: "Payment of Gratuity Act 1972" pointed to
 *   indiacode handle/1357 ("Invalid URL"). Replaced with the EPFO-hosted
 *   PDF of the Act.
 *
 * - hr-policies-india-2026: "SEBI LODR Regulations" 404'd at the SEBI URL.
 *   Replaced with SEBI's LODR regulations listing page.
 *
 * - what-is-policy-management-software: "BRSR disclosures" PDF 404'd at the
 *   old SEBI URL. Replaced with SEBI's BRSR circular page.
 *
 * Idempotent via per-file markers (the new URLs themselves).
 */

function pcgpt_migration_040_refresh_existing_blog_outbound_links() {

    $files = array(
        'work-from-home-policy-india-2026' => array(
            'data'   => 'work-from-home-policy-india-2026.html',
            'marker' => 'indiacode.nic.in/handle/123456789/2104', // POSH Act URL — only present after this fix
        ),
        'hr-policies-india-2026' => array(
            'data'   => 'hr-policies-india-2026.html',
            'marker' => 'prsindia.org/billtrack/the-maternity-benefit-amendment-bill-2016', // unique to fix
        ),
        'what-is-policy-management-software' => array(
            'data'   => 'what-is-policy-management-software.html',
            'marker' => 'business-responsibility-and-sustainability-reporting-by-listed-entities_50096', // unique to fix
        ),
    );

    foreach ($files as $slug => $cfg) {
        $posts = get_posts(array(
            'name'        => $slug,
            'post_type'   => 'post',
            'post_status' => array('publish', 'draft', 'pending', 'private'),
            'numberposts' => 1,
        ));
        if (empty($posts)) {
            error_log("PCGPT Migration 040: post '{$slug}' not found — skipping");
            continue;
        }
        $post = $posts[0];

        if (strpos($post->post_content, $cfg['marker']) !== false) {
            continue; // Already refreshed
        }

        $path = __DIR__ . '/data/' . $cfg['data'];
        if (!file_exists($path)) {
            error_log("PCGPT Migration 040: data file missing — {$path}");
            continue;
        }
        $new_content = file_get_contents($path);
        if ($new_content === false || trim($new_content) === '') {
            error_log("PCGPT Migration 040: empty data file — {$path}");
            continue;
        }

        $result = wp_update_post(array(
            'ID'           => (int) $post->ID,
            'post_content' => $new_content,
        ), true);

        if (is_wp_error($result)) {
            error_log("PCGPT Migration 040: wp_update_post failed for {$slug} — " . $result->get_error_message());
        }
    }
}
