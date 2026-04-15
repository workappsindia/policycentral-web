<?php
/**
 * Migration 005: Blogs section setup
 *
 * Idempotent setup for the blog system:
 * 1. Creates the /blogs/ WordPress page using page-blogs.php template
 * 2. Seeds the 7 primary blog categories
 * 3. Creates the first Guest Author (Tony Thomas)
 *
 * Note: The Guest Authors CPT itself is registered in includes/blog/loader.php
 * (CPTs cannot be created purely through migrations — they must be registered
 * on every init). This migration only seeds the DATA for a CPT that's been
 * registered elsewhere.
 */

function pcgpt_migration_005_blogs_setup() {

    /* ═══════════════════════════════════════════════════════════
       1. CREATE /blogs/ PAGE
       ═══════════════════════════════════════════════════════════ */
    $page_slug     = 'blogs';
    $page_title    = 'Blogs';
    $page_template = 'page-blogs.php';

    $existing = get_posts(array(
        'name'        => $page_slug,
        'post_type'   => 'page',
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => 1,
    ));

    if (!empty($existing)) {
        $page_id = $existing[0]->ID;
        if (get_post_meta($page_id, '_wp_page_template', true) !== $page_template) {
            update_post_meta($page_id, '_wp_page_template', $page_template);
        }
    } else {
        $page_id = wp_insert_post(array(
            'post_title'   => $page_title,
            'post_name'    => $page_slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => 1,
        ));
        if (!is_wp_error($page_id) && $page_id > 0) {
            update_post_meta($page_id, '_wp_page_template', $page_template);
        }
    }

    /* ═══════════════════════════════════════════════════════════
       2. SEED 7 BLOG CATEGORIES
       ═══════════════════════════════════════════════════════════ */
    $categories = array(
        array('name' => 'Policy Management Software', 'slug' => 'policy-management-software', 'description' => 'Guides, comparisons, and best practices for enterprise policy management software.'),
        array('name' => 'HR Policy Management',       'slug' => 'hr-policy-management',       'description' => 'HR compliance, employee policies, labor laws, and workplace governance.'),
        array('name' => 'Corporate Updates',          'slug' => 'corporate-updates',          'description' => 'Leadership communications, board updates, and corporate announcements.'),
        array('name' => 'Product Information',        'slug' => 'product-information',        'description' => 'Product documentation, release notes, and guidelines.'),
        array('name' => 'SOPs',                       'slug' => 'sops',                       'description' => 'Standard operating procedures and operational best practices.'),
        array('name' => 'Branch Circulars',           'slug' => 'branch-circulars',           'description' => 'Regional and branch-level circulars, notices, and directives.'),
        array('name' => 'Business Req. Docs',         'slug' => 'business-req-docs',          'description' => 'Business requirement documents, technical specifications, and project docs.'),
    );

    foreach ($categories as $cat) {
        $existing_term = term_exists($cat['slug'], 'category');
        if (!$existing_term) {
            wp_insert_term(
                $cat['name'],
                'category',
                array(
                    'slug'        => $cat['slug'],
                    'description' => $cat['description'],
                )
            );
        } else {
            // Update name/description if they've drifted
            $term_id = is_array($existing_term) ? $existing_term['term_id'] : $existing_term;
            wp_update_term($term_id, 'category', array(
                'name'        => $cat['name'],
                'description' => $cat['description'],
            ));
        }
    }

    /* ═══════════════════════════════════════════════════════════
       3. SEED GUEST AUTHOR: TONY THOMAS
       ═══════════════════════════════════════════════════════════ */
    // Only create if the pc_author CPT is registered (it's registered on init
    // via includes/blog/loader.php — migration runs on admin_init which fires
    // after init, so the CPT should be available).
    if (post_type_exists('pc_author')) {
        $tony_slug = 'tony-thomas';

        $existing_author = get_posts(array(
            'name'        => $tony_slug,
            'post_type'   => 'pc_author',
            'post_status' => array('publish', 'draft'),
            'numberposts' => 1,
        ));

        if (empty($existing_author)) {
            $author_id = wp_insert_post(array(
                'post_title'   => 'Tony Thomas',
                'post_name'    => $tony_slug,
                'post_status'  => 'publish',
                'post_type'    => 'pc_author',
                'post_content' => 'My role is to oversee & drive growth for PolicyCentral & VideoCX. Responsible for developing and implementing strategies to maximise the profitability and growth for both the products.',
                'post_author'  => 1,
            ));

            if (!is_wp_error($author_id) && $author_id > 0) {
                update_post_meta($author_id, '_pcb_designation', 'Lead – PolicyCentral & VideoCX');
                update_post_meta($author_id, '_pcb_linkedin',    'https://www.linkedin.com/in/tonythomasn/');
                update_post_meta($author_id, '_pcb_twitter',     '');
                update_post_meta($author_id, '_pcb_email',       '');

                // Attach the photo (copied to theme/assets/authors/tony-thomas.jpeg
                // by the build process — we'll set it as featured image here if available)
                $photo_path = get_template_directory() . '/assets/authors/tony-thomas.jpeg';
                if (file_exists($photo_path)) {
                    pcgpt_attach_author_photo($author_id, $photo_path, 'tony-thomas.jpeg');
                }
            }
        }
    }
}

/**
 * Helper: attach an author photo as the featured image of a pc_author post.
 * Copies the file into uploads, creates an attachment, sets as thumbnail.
 * Idempotent — skips if thumbnail already set.
 */
function pcgpt_attach_author_photo($author_id, $source_path, $filename) {
    if (has_post_thumbnail($author_id)) return;
    if (!file_exists($source_path)) return;

    require_once ABSPATH . 'wp-admin/includes/image.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/media.php';

    $upload = wp_upload_bits($filename, null, file_get_contents($source_path));
    if (!empty($upload['error'])) return;

    $wp_filetype = wp_check_filetype($upload['file'], null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title'     => sanitize_file_name($filename),
        'post_content'   => '',
        'post_status'    => 'inherit',
    );

    $attach_id = wp_insert_attachment($attachment, $upload['file'], $author_id);
    if (is_wp_error($attach_id) || !$attach_id) return;

    $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
    wp_update_attachment_metadata($attach_id, $attach_data);
    set_post_thumbnail($author_id, $attach_id);
}
