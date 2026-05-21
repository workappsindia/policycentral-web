<?php
/**
 * Migration 053: Refresh post_content for the 4 Compliance & Audit blogs.
 *
 * The first-pass HTML extracted from the source DOCX files used <h3> for the
 * FAQ heading and split each question and answer into separate <p> tags. The
 * theme's FAQ accordion (PCB_Content::transform_faq_section) only matches an
 * <h2>Frequently Asked Questions</h2> heading followed by paragraphs that
 * start with <strong>, so the FAQs rendered as plain text instead of the
 * styled accordion.
 *
 * Migration 049's source post (policy-audit-checklist) had no FAQ section at
 * all and has had one added.
 *
 * This migration re-loads each blog's body from its updated data/*.html file
 * and updates post_content. Idempotent: only writes if the stored content
 * differs from the file.
 */

function pcgpt_migration_053_refresh_compliance_batch_faqs() {

    $blogs = array(
        'hr-policy-compliance-indian-banks-nbfcs'             => 'hr-policy-compliance-indian-banks-nbfcs.html',
        'multilingual-hr-policies-hindi-regional-languages'   => 'multilingual-hr-policies-hindi-regional-languages.html',
        'policy-audit-checklist-indian-hr-compliance'         => 'policy-audit-checklist-indian-hr-compliance.html',
        'policy-version-control-prevents-legal-risk'          => 'policy-version-control-prevents-legal-risk.html',
    );

    foreach ($blogs as $slug => $file) {
        $content_file = __DIR__ . '/data/' . $file;
        if (!file_exists($content_file)) {
            error_log("PCGPT Migration 053: content file missing for {$slug}");
            continue;
        }
        $content = file_get_contents($content_file);
        if ($content === false || trim($content) === '') continue;

        $posts = get_posts(array(
            'name'           => $slug,
            'post_type'      => 'post',
            'post_status'    => array('publish', 'draft', 'pending', 'private'),
            'posts_per_page' => 1,
        ));
        if (empty($posts)) continue;

        $post = $posts[0];
        if (trim($post->post_content) === trim($content)) continue;

        wp_update_post(array(
            'ID'           => (int) $post->ID,
            'post_content' => $content,
        ));
    }
}
