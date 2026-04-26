<?php
/**
 * Migration 006: Seed the first blog post + finalize blog setup
 *
 * Idempotent steps:
 * 1. Set default_category to HR Policy Management so new posts created
 *    without a category pick don't land in "Uncategorized".
 * 2. Delete the WP-default "Uncategorized" term IF it exists and is empty.
 * 3. Create the first blog post ("Gratuity Rules in India") with its full
 *    content, excerpt, slug, category, guest author (Tony Thomas), tags,
 *    and featured image — only if the slug doesn't already exist.
 *
 * The post body HTML lives in data/gratuity-rules-india.html. The featured
 * image file lives in /assets/blog-images/gratuity-rules-india.png.
 *
 * NOTE: Every item here is idempotent. Running this on a machine where the
 * post already exists (e.g. local, where it was created via WP-CLI) is safe
 * — it'll simply skip steps that are already done.
 */

function pcgpt_migration_006_seed_first_blog_post() {

    /* ═══════════════════════════════════════════════════════════
       1. DEFAULT CATEGORY → HR Policy Management
       ═══════════════════════════════════════════════════════════ */
    $hr_term = get_term_by('slug', 'hr-policy-management', 'category');
    if ($hr_term && !is_wp_error($hr_term)) {
        $current = (int) get_option('default_category');
        if ($current !== (int) $hr_term->term_id) {
            update_option('default_category', (int) $hr_term->term_id);
        }
    }

    /* ═══════════════════════════════════════════════════════════
       2. DELETE "Uncategorized" TERM (if empty)
       ═══════════════════════════════════════════════════════════ */
    $uncat = get_term_by('slug', 'uncategorized', 'category');
    if ($uncat && !is_wp_error($uncat)) {
        // Only delete if no posts are in it (wp_delete_term would reassign
        // to default_category automatically, but we're extra cautious)
        if ((int) $uncat->count === 0) {
            wp_delete_term((int) $uncat->term_id, 'category');
        }
    }

    /* ═══════════════════════════════════════════════════════════
       3. CREATE FIRST POST: Gratuity Rules in India
       ═══════════════════════════════════════════════════════════ */
    $slug = 'gratuity-rules-india';

    // Idempotency: skip if slug already exists in ANY status (even trashed)
    $existing = get_posts(array(
        'name'           => $slug,
        'post_type'      => 'post',
        'post_status'    => array('publish', 'draft', 'pending', 'private', 'trash'),
        'posts_per_page' => 1,
    ));
    if (!empty($existing)) {
        return; // Post already exists, nothing to do
    }

    // Read the post body from the data file
    $content_file = __DIR__ . '/data/gratuity-rules-india.html';
    if (!file_exists($content_file)) {
        error_log('PCGPT Migration 006: content file missing at ' . $content_file);
        return;
    }
    $content = file_get_contents($content_file);
    if ($content === false || trim($content) === '') {
        error_log('PCGPT Migration 006: content file empty');
        return;
    }

    // Find the HR Policy Management category
    $hr_cat = get_term_by('slug', 'hr-policy-management', 'category');
    if (!$hr_cat || is_wp_error($hr_cat)) {
        error_log('PCGPT Migration 006: HR Policy Management category missing — migration 005 must run first');
        return;
    }

    // Find the Tony Thomas guest author (created by migration 005)
    $tony = get_posts(array(
        'name'        => 'tony-thomas',
        'post_type'   => 'pc_author',
        'post_status' => 'publish',
        'numberposts' => 1,
    ));
    $tony_id = !empty($tony) ? (int) $tony[0]->ID : 0;

    // Insert the post
    $post_id = wp_insert_post(array(
        'post_title'    => 'Gratuity Rules in India: Eligibility, Calculation, and Policy Requirements',
        'post_name'     => $slug,
        'post_status'   => 'publish',
        'post_type'     => 'post',
        'post_author'   => 1,
        'post_content'  => $content,
        'post_excerpt'  => 'A complete guide to gratuity in India — who qualifies, how to calculate it using the correct formula, what employers must do by law, and how tax treatment works.',
        'post_category' => array((int) $hr_cat->term_id),
    ), true);

    if (is_wp_error($post_id) || !$post_id) {
        error_log('PCGPT Migration 006: wp_insert_post failed — ' .
            (is_wp_error($post_id) ? $post_id->get_error_message() : 'unknown'));
        return;
    }

    // Meta: primary category (for URL rewrite) + guest author
    update_post_meta($post_id, '_pcb_primary_category', (int) $hr_cat->term_id);
    if ($tony_id > 0) {
        update_post_meta($post_id, '_pcb_guest_author', $tony_id);
    }

    // Tags
    wp_set_post_terms($post_id, array(
        'gratuity',
        'hr-compliance',
        'payment-of-gratuity-act',
        'indian-labor-law',
        'employee-benefits',
    ), 'post_tag', false);

    // Featured image — attach from theme assets/blog-images/
    $image_path = get_template_directory() . '/assets/blog-images/gratuity-rules.jpg';
    if (file_exists($image_path)) {
        pcgpt_attach_post_featured_image($post_id, $image_path, 'gratuity-rules.jpg', 'Gratuity Rules in India');
    }
}

/**
 * Helper: import a local image as a media attachment and set as featured
 * image of a given post. Idempotent (skips if featured image already set).
 */
function pcgpt_attach_post_featured_image($post_id, $source_path, $filename, $title = '') {
    if (has_post_thumbnail($post_id)) return;
    if (!file_exists($source_path)) return;

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($filename, null, file_get_contents($source_path));
    if (!empty($upload['error'])) {
        error_log('PCGPT Migration 006: wp_upload_bits failed — ' . $upload['error']);
        return;
    }

    $wp_filetype = wp_check_filetype($upload['file'], null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => $title ?: sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
    );

    $attach_id = wp_insert_attachment($attachment, $upload['file'], $post_id);
    if (is_wp_error($attach_id) || !$attach_id) return;

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($post_id, $attach_id);
}
