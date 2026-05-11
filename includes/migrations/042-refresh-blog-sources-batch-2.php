<?php
/**
 * Migration 042: Apply user-curated source URLs (batch 2).
 *
 * 2026-05-12 user-supplied changes:
 *
 * - work-from-home-policy-india-2026:
 *     "Shops and Establishments Act" link →
 *       https://www.indiacode.nic.in/bitstream/123456789/19710/1/shops_and_eastablishments.pdf
 *     "Occupational Safety, Health, and Working Conditions Code, 2020" link →
 *       https://dgfasli.gov.in/public/Admin/Cms/AllPdf/650059fbb8f1a9.98699174.pdf
 *
 * - india-new-labour-codes-hr-policy-rewrite:
 *     "Occupational Safety, Health and Working Conditions Code, 2020" link →
 *       https://www.indiacode.nic.in/handle/123456789/22041?view_type=browse
 *     (was previously prsindia.org/billtrack/the-occupational-safety-...)
 *
 * - policy-lifecycle-management:
 *     First Navex link → https://www.navex.com/en-us/northstar/global-risk-compliance-statistics/
 *       (was previously secureframe.com/blog/compliance-statistics)
 *     Second Navex sentence — rewritten to drop the Navex Global attribution
 *       and the unattributed 73% statistic. New copy preserves the spirit of
 *       "compliance teams are moving to purpose-built tooling".
 *
 * Idempotent via per-file markers below.
 */

function pcgpt_migration_042_refresh_blog_sources_batch_2() {

    $files = array(
        'work-from-home-policy-india-2026' => array(
            'data'   => 'work-from-home-policy-india-2026.html',
            'marker' => 'dgfasli.gov.in/public/Admin/Cms/AllPdf/650059fbb8f1a9', // unique to this fix
        ),
        'india-new-labour-codes-hr-policy-rewrite' => array(
            'data'   => 'india-new-labour-codes-hr-policy-rewrite.html',
            'marker' => 'indiacode.nic.in/handle/123456789/22041', // unique — replaced prsindia link
        ),
        'policy-lifecycle-management' => array(
            'data'   => 'policy-lifecycle-management.html',
            'marker' => 'navex.com/en-us/northstar/global-risk-compliance-statistics', // unique to this fix
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
            error_log("PCGPT Migration 042: post '{$slug}' not found — skipping");
            continue;
        }
        $post = $posts[0];

        if (strpos($post->post_content, $cfg['marker']) !== false) {
            continue;
        }

        $path = __DIR__ . '/data/' . $cfg['data'];
        if (!file_exists($path)) {
            error_log("PCGPT Migration 042: data file missing — {$path}");
            continue;
        }
        $new_content = file_get_contents($path);
        if ($new_content === false || trim($new_content) === '') {
            error_log("PCGPT Migration 042: empty data file — {$path}");
            continue;
        }

        $result = wp_update_post(array(
            'ID'           => (int) $post->ID,
            'post_content' => $new_content,
        ), true);

        if (is_wp_error($result)) {
            error_log("PCGPT Migration 042: wp_update_post failed for {$slug} — " . $result->get_error_message());
        }
    }
}
