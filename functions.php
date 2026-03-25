<?php
/**
 * PolicyCentral Theme Functions
 */

// Theme setup
function policycentral_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
}
add_action('after_setup_theme', 'policycentral_setup');

// Enqueue styles and scripts
function policycentral_scripts() {
    // Google Fonts
    wp_enqueue_style('policycentral-fonts',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Manrope:wght@400;500;600;700&display=swap',
        array(), null
    );

    // Main stylesheet
    wp_enqueue_style('policycentral-style', get_stylesheet_uri(), array('policycentral-fonts'), '1.0.0');

    // Shared JS (all pages)
    wp_enqueue_script('policycentral-main',
        get_template_directory_uri() . '/js/main.js',
        array(), '1.0.0', true
    );

    // Home page JS (only on front page)
    if (is_front_page()) {
        wp_enqueue_script('policycentral-home',
            get_template_directory_uri() . '/js/home.js',
            array(), '1.0.0', true
        );
    }

    // FAQ JS (only on FAQ category pages)
    if (is_page_template(array(
        'page-faq-ai-capabilities.php',
        'page-faq-company-platform.php',
        'page-faq-compliance-tracking.php',
        'page-faq-features-dashboard.php',
        'page-faq-hosting-security.php',
        'page-faq-implementation.php',
        'page-faq-it-ciso.php',
        'page-faq-pricing-finance.php',
        'page-faq-publishing.php',
        'page-faq-roi-business.php',
    ))) {
        wp_enqueue_script('policycentral-faq',
            get_template_directory_uri() . '/js/faq.js',
            array(), '1.0.0', true
        );
    }
}
add_action('wp_enqueue_scripts', 'policycentral_scripts');

// Remove WordPress emoji scripts (performance)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove block library CSS (not using Gutenberg blocks)
function policycentral_remove_block_css() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'policycentral_remove_block_css', 100);

// Add preconnect for Google Fonts
function policycentral_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'policycentral_preconnect', 1);
