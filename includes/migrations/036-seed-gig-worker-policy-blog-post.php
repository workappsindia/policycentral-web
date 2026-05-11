<?php
/**
 * Migration 036: Seed the "Gig Worker Policy 2026" blog post.
 *
 * Idempotent. Body in data/gig-worker-policy-india-2026.html.
 * Image at /assets/blog-images/gig-worker-policy.jpg.
 * Category: indian-labour-codes. Author: tony-thomas.
 */

function pcgpt_migration_036_seed_gig_worker_policy_blog_post() {

    $slug = 'gig-worker-policy-india-2026';

    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) return;

    $content_file = __DIR__ . '/data/gig-worker-policy-india-2026.html';
    if (!file_exists($content_file)) { error_log('PCGPT Migration 036: content file missing'); return; }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') return;

    $cat = get_term_by('slug', 'indian-labour-codes', 'category');
    if (!$cat || is_wp_error($cat)) { error_log('PCGPT Migration 036: category missing'); return; }

    $tony_id = 0;
    if (post_type_exists('pc_author')) {
        $tony = get_posts(array('name'=>'tony-thomas','post_type'=>'pc_author','post_status'=>array('publish','draft'),'numberposts'=>1));
        if (!empty($tony)) $tony_id = (int) $tony[0]->ID;
    }

    $post_id = wp_insert_post(array(
        'post_title'    => 'Gig Worker Policy: What Indian Companies Using Freelancers and Platform Workers Must Know in 2026',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => "India's gig and platform workers are now covered by statutory definitions, social security funds, and grievance rights under the Code on Social Security 2020. The five policies every Indian company engaging freelancers or platform workers must put in place in 2026.",
        'post_category' => array((int) $cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) { error_log('PCGPT Migration 036: insert failed'); return; }

    update_post_meta($post_id, '_pcb_primary_category', (int) $cat->term_id);
    if ($tony_id > 0) update_post_meta($post_id, '_pcb_guest_author', $tony_id);

    wp_set_post_terms($post_id, array(
        'indian-labour-codes', 'gig-workers', 'platform-workers', 'code-on-social-security',
        'dpdp-act', 'contractor-management', 'compliance', 'indian-enterprise',
    ), 'post_tag', false);

    $image_path = get_template_directory() . '/assets/blog-images/gig-worker-policy.jpg';
    if (file_exists($image_path) && function_exists('pcgpt_attach_post_featured_image')) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'gig-worker-policy.jpg', 'Gig Worker Policy India 2026');
    }
}
