<?php
/**
 * Migration 032: Create the "Indian Labour Codes" blog category.
 *
 * Idempotent: skips if the term already exists. Updates name/description if
 * they have drifted.
 *
 * The visual treatment for this category (sidebar icon, blog-card cover art,
 * accent palette) lives in includes/blog/class-pcb-icons.php under the
 * `indian-labour-codes` registry key. The category page hero on category.php
 * uses the term description directly, so the description below is the
 * subtitle copy that renders on /blogs/indian-labour-codes/.
 */

function pcgpt_migration_032_create_indian_labour_codes_category() {

    $cat = array(
        'name'        => 'Indian Labour Codes',
        'slug'        => 'indian-labour-codes',
        'description' => '4 codes. 29 laws replaced. November 21, 2025.',
    );

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
        $term_id = is_array($existing_term) ? (int) $existing_term['term_id'] : (int) $existing_term;
        wp_update_term($term_id, 'category', array(
            'name'        => $cat['name'],
            'description' => $cat['description'],
        ));
    }
}
