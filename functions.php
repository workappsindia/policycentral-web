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

// ═══════════════════════════════════════════════
// SCHEMA MARKUP (JSON-LD)
// ═══════════════════════════════════════════════

add_action('wp_head', 'pc_schema_markup');
function pc_schema_markup() {
    $home = esc_url(home_url('/'));
    $logo = esc_url(get_template_directory_uri() . '/android-chrome-512x512.png');

    // Organization schema — every page
    $org = array(
        '@type' => 'Organization',
        '@id' => $home . '#organization',
        'name' => 'PolicyCentral.ai',
        'alternateName' => 'WorkApps Product Solutions Pvt. Ltd.',
        'url' => $home,
        'logo' => array('@type' => 'ImageObject', 'url' => $logo, 'width' => 512, 'height' => 512),
        'description' => 'AI-driven policy management and access platform for large organizations.',
        'foundingDate' => '2017',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => '91 Springboard, Creaticity Mall, Yerwada',
            'addressLocality' => 'Pune',
            'addressRegion' => 'Maharashtra',
            'postalCode' => '411006',
            'addressCountry' => 'IN',
        ),
        'contactPoint' => array(
            '@type' => 'ContactPoint',
            'telephone' => '+91-9890988498',
            'contactType' => 'sales',
            'email' => 'marketing@policycentral.ai',
            'availableLanguage' => array('English', 'Hindi'),
        ),
        'sameAs' => array(),
    );

    // WebSite schema — every page
    $website = array(
        '@type' => 'WebSite',
        '@id' => $home . '#website',
        'url' => $home,
        'name' => 'PolicyCentral.ai',
        'publisher' => array('@id' => $home . '#organization'),
    );

    // BreadcrumbList
    $breadcrumb_items = array();
    $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home);

    if (is_front_page()) {
        // SoftwareApplication schema for home page
        $software = array(
            '@type' => 'SoftwareApplication',
            'name' => 'PolicyCentral.ai',
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Web, iOS, Android',
            'description' => 'AI-driven policy management and access platform for large organizations. Host, publish, target, and track policies with enterprise-grade security.',
            'url' => $home,
            'offers' => array(
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'INR',
                'description' => 'Contact for pricing. Per user per month model.',
            ),
            'aggregateRating' => array(
                '@type' => 'AggregateRating',
                'ratingValue' => '4.8',
                'ratingCount' => '45',
                'bestRating' => '5',
            ),
            'provider' => array('@id' => $home . '#organization'),
        );

        pc_output_schema(array(
            '@context' => 'https://schema.org',
            '@graph' => array($org, $website, $software),
        ));
        return;
    }

    // Get current page info
    $page_title = get_the_title();
    $page_url = get_permalink();
    $page_desc = get_post_meta(get_the_ID(), 'rank_math_description', true);
    $template = get_page_template_slug();

    // Build breadcrumbs based on page type
    if (strpos($template, 'page-feature-') === 0) {
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'Features', 'item' => esc_url(home_url('/features/')));
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 3, 'name' => $page_title);
    } elseif (strpos($template, 'page-faq-') === 0) {
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'FAQs', 'item' => esc_url(home_url('/faq/')));
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 3, 'name' => $page_title);
    } elseif ($template === 'page-features.php') {
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'Features');
    } elseif ($template === 'page-faq.php') {
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => 'FAQs');
    } else {
        $breadcrumb_items[] = array('@type' => 'ListItem', 'position' => 2, 'name' => $page_title);
    }

    $breadcrumb = array(
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumb_items,
    );

    // WebPage schema
    $webpage = array(
        '@type' => 'WebPage',
        '@id' => $page_url . '#webpage',
        'url' => $page_url,
        'name' => $page_title,
        'description' => $page_desc,
        'isPartOf' => array('@id' => $home . '#website'),
        'breadcrumb' => $breadcrumb,
    );

    $graph = array($org, $website, $breadcrumb, $webpage);

    // FAQPage schema for FAQ category pages
    if (strpos($template, 'page-faq-') === 0 && $template !== 'page-faq.php') {
        $faq_schema = pc_build_faq_schema();
        if ($faq_schema) {
            $graph[] = $faq_schema;
        }
    }

    // ContactPage schema
    if ($template === 'page-contact.php') {
        $webpage['@type'] = 'ContactPage';
    }

    // AboutPage schema
    if ($template === 'page-about.php') {
        $webpage['@type'] = 'AboutPage';
    }

    pc_output_schema(array(
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ));
}

function pc_build_faq_schema() {
    global $post;
    if (!$post) return null;

    // Extract Q&A from the template content
    $template_file = get_page_template();
    if (!$template_file || !file_exists($template_file)) return null;

    $content = file_get_contents($template_file);
    $questions = array();

    // Match acc-trigger (question) and acc-body (answer) pairs
    if (preg_match_all('/<button[^>]*class="acc-trigger"[^>]*>(.*?)<\/button>/s', $content, $q_matches) &&
        preg_match_all('/<div[^>]*class="acc-body"[^>]*>(.*?)<\/div>\s*<\/div>/s', $content, $a_matches)) {

        $count = min(count($q_matches[1]), count($a_matches[1]));
        for ($i = 0; $i < $count; $i++) {
            $question = trim(strip_tags($q_matches[1][$i]));
            $answer = trim(strip_tags($a_matches[1][$i]));
            if ($question && $answer) {
                $questions[] = array(
                    '@type' => 'Question',
                    'name' => $question,
                    'acceptedAnswer' => array(
                        '@type' => 'Answer',
                        'text' => mb_substr($answer, 0, 500),
                    ),
                );
            }
        }
    }

    if (empty($questions)) return null;

    return array(
        '@type' => 'FAQPage',
        'mainEntity' => $questions,
    );
}

function pc_output_schema($schema) {
    echo '<script type="application/ld+json">' . "\n";
    echo wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "\n" . '</script>' . "\n";
}

// ═══════════════════════════════════════════════
// OPEN GRAPH IMAGE — ensure og:image is always present
// Rank Math handles og:title, og:description, og:url
// We add the image tag directly as a safety net
// ═══════════════════════════════════════════════

add_action('wp_head', 'pc_ensure_og_image', 99);
function pc_ensure_og_image() {
    $image = esc_url(get_template_directory_uri() . '/images/home-hero-option3.png');
    echo '<meta property="og:image" content="' . $image . '">' . "\n";
    echo '<meta property="og:image:width" content="1200">' . "\n";
    echo '<meta property="og:image:height" content="630">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:image" content="' . $image . '">' . "\n";
}

// ═══════════════════════════════════════════════
// FLUENT FORMS: Tracking, Emails & Redirect
// ═══════════════════════════════════════════════

/**
 * 1. Capture HTTP headers, IP, OS, referrer on form submission
 *    Stores as meta with the Fluent Forms entry
 */
add_action('fluentform/submission_inserted', 'pc_capture_visitor_data', 10, 3);
function pc_capture_visitor_data($entryId, $formData, $form) {
    $tracking = array(
        'ip_address'     => pc_get_client_ip(),
        'user_agent'     => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : '',
        'referer'        => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : '',
        'page_url'       => isset($_POST['_wp_http_referer']) ? esc_url_raw($_POST['_wp_http_referer']) : (isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : ''),
        'accept_language' => isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? sanitize_text_field(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 50)) : '',
        'os'             => pc_detect_os(),
        'browser'        => pc_detect_browser(),
        'device_type'    => wp_is_mobile() ? 'Mobile' : 'Desktop',
        'screen_res'     => isset($_POST['_screen_res']) ? sanitize_text_field($_POST['_screen_res']) : '',
        'utm_source'     => isset($_COOKIE['pc_utm_source']) ? sanitize_text_field($_COOKIE['pc_utm_source']) : '',
        'utm_medium'     => isset($_COOKIE['pc_utm_medium']) ? sanitize_text_field($_COOKIE['pc_utm_medium']) : '',
        'utm_campaign'   => isset($_COOKIE['pc_utm_campaign']) ? sanitize_text_field($_COOKIE['pc_utm_campaign']) : '',
        'submitted_at'   => current_time('mysql'),
    );

    // Store as entry meta
    if (function_exists('wpFluent')) {
        wpFluent()->table('fluentform_entry_details')->insert(array(
            'form_id'    => $form->id,
            'submission_id' => $entryId,
            'field_name' => '_visitor_tracking',
            'field_value' => wp_json_encode($tracking),
            'sub_field_name' => '',
        ));
    }
}

function pc_get_client_ip() {
    $headers = array('HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_REAL_IP', 'REMOTE_ADDR');
    foreach ($headers as $header) {
        if (!empty($_SERVER[$header])) {
            $ip = explode(',', $_SERVER[$header]);
            return sanitize_text_field(trim($ip[0]));
        }
    }
    return 'Unknown';
}

function pc_detect_os() {
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $os_map = array(
        '/windows nt 10/i' => 'Windows 10/11', '/windows nt 6.3/i' => 'Windows 8.1',
        '/macintosh|mac os x/i' => 'macOS', '/linux/i' => 'Linux',
        '/iphone/i' => 'iOS (iPhone)', '/ipad/i' => 'iOS (iPad)',
        '/android/i' => 'Android', '/cros/i' => 'Chrome OS',
    );
    foreach ($os_map as $regex => $os) {
        if (preg_match($regex, $ua)) return $os;
    }
    return 'Unknown';
}

function pc_detect_browser() {
    $ua = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $browser_map = array(
        '/edg/i' => 'Edge', '/opr|opera/i' => 'Opera', '/chrome|crios/i' => 'Chrome',
        '/firefox|fxios/i' => 'Firefox', '/safari/i' => 'Safari', '/msie|trident/i' => 'IE',
    );
    foreach ($browser_map as $regex => $browser) {
        if (preg_match($regex, $ua)) return $browser;
    }
    return 'Unknown';
}

/**
 * 2. Store UTM parameters in cookies for tracking
 */
add_action('init', 'pc_capture_utm_params');
function pc_capture_utm_params() {
    $utm_params = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content');
    foreach ($utm_params as $param) {
        if (isset($_GET[$param])) {
            setcookie('pc_' . $param, sanitize_text_field($_GET[$param]), time() + (30 * DAY_IN_SECONDS), '/');
        }
    }
}

/**
 * 3. Redirect to Thank You page after submission
 */
add_filter('fluentform/submission_confirmation', 'pc_redirect_thank_you', 10, 4);
function pc_redirect_thank_you($returnData, $form, $confirmation) {
    $returnData['redirectUrl'] = home_url('/thank-you/');
    $returnData['message'] = '';
    return $returnData;
}

/**
 * 4. Send styled confirmation email to the user
 */
add_action('fluentform/submission_inserted', 'pc_send_user_confirmation', 20, 3);
function pc_send_user_confirmation($entryId, $formData, $form) {
    // Find the email field
    $email = '';
    if (isset($formData['email'])) {
        $email = sanitize_email($formData['email']);
    }
    if (empty($email)) return;

    $first_name = isset($formData['names']['first_name']) ? sanitize_text_field($formData['names']['first_name']) : 'there';

    $subject = "We've got your message! Our policy? Reply fast.";

    $body = pc_build_user_email($first_name);

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: PolicyCentral.ai <marketing@policycentral.ai>',
    );

    wp_mail($email, $subject, $body, $headers);
}

function pc_build_user_email($name) {
    $home = esc_url(home_url('/'));
    $features = esc_url(home_url('/features/'));

    return '<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f4f5f7;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f5f7;padding:40px 20px">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,.06)">

  <!-- Header -->
  <tr><td style="background:linear-gradient(135deg,#179D97,#05162A);padding:36px 40px;text-align:center">
    <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:800;letter-spacing:-0.5px">Policy<span style="color:#5fe6d8">Central</span>.ai</h1>
  </td></tr>

  <!-- Body -->
  <tr><td style="padding:44px 40px 20px">
    <h2 style="margin:0 0 8px;font-size:26px;font-weight:800;color:#111827;line-height:1.3">
      Hey ' . esc_html($name) . '! &#128075;
    </h2>
    <p style="margin:0 0 24px;font-size:16px;color:#6B7280;line-height:1.7">
      Your message just landed in our inbox. Consider it read, starred, and bookmarked.
    </p>

    <!-- Fun policy quote box -->
    <table width="100%" cellpadding="0" cellspacing="0">
    <tr><td style="background:linear-gradient(135deg,rgba(23,157,151,.06),rgba(67,56,202,.06));border-left:4px solid #179D97;border-radius:0 12px 12px 0;padding:20px 24px">
      <p style="margin:0;font-size:15px;color:#374151;line-height:1.7;font-style:italic">
        &#128220; It\'s our <strong style="color:#179D97">policy</strong> to get back as soon as possible. And unlike most policies, this one\'s actually fun to follow.
      </p>
    </td></tr>
    </table>
  </td></tr>

  <!-- What happens next -->
  <tr><td style="padding:24px 40px 20px">
    <h3 style="margin:0 0 16px;font-size:16px;font-weight:700;color:#111827">What happens next?</h3>
    <table width="100%" cellpadding="0" cellspacing="0">
      <tr>
        <td width="36" valign="top" style="padding:0 12px 16px 0">
          <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#179D97,#059669);color:#fff;font-size:13px;font-weight:800;text-align:center;line-height:28px">1</div>
        </td>
        <td style="padding-bottom:16px">
          <p style="margin:0;font-size:14px;color:#374151;line-height:1.6"><strong>We review your message</strong> &mdash; a real human, not a bot.</p>
        </td>
      </tr>
      <tr>
        <td width="36" valign="top" style="padding:0 12px 16px 0">
          <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#7C3AED,#6D28D9);color:#fff;font-size:13px;font-weight:800;text-align:center;line-height:28px">2</div>
        </td>
        <td style="padding-bottom:16px">
          <p style="margin:0;font-size:14px;color:#374151;line-height:1.6"><strong>Someone from the team reaches out</strong> &mdash; typically within a few hours.</p>
        </td>
      </tr>
      <tr>
        <td width="36" valign="top" style="padding:0 12px 0 0">
          <div style="width:28px;height:28px;border-radius:50%;background:linear-gradient(135deg,#D97706,#B45309);color:#fff;font-size:13px;font-weight:800;text-align:center;line-height:28px">3</div>
        </td>
        <td>
          <p style="margin:0;font-size:14px;color:#374151;line-height:1.6"><strong>We schedule a demo</strong> &mdash; and show you the magic. &#10024;</p>
        </td>
      </tr>
    </table>
  </td></tr>

  <!-- CTA -->
  <tr><td style="padding:24px 40px 20px;text-align:center">
    <a href="' . $features . '" style="display:inline-block;padding:14px 32px;background:linear-gradient(135deg,#179D97,#05162A);color:#ffffff;text-decoration:none;border-radius:50px;font-size:14px;font-weight:700">Explore Our Features &rarr;</a>
  </td></tr>

  <!-- Divider -->
  <tr><td style="padding:20px 40px 0"><hr style="border:none;border-top:1px solid #E5E7EB;margin:0"></td></tr>

  <!-- Footer -->
  <tr><td style="padding:24px 40px 36px;text-align:center">
    <p style="margin:0 0 4px;font-size:12px;color:#9CA3AF">PolicyCentral.ai &mdash; AI-driven policy management for large organizations</p>
    <p style="margin:0;font-size:12px;color:#9CA3AF">
      <a href="' . $home . '" style="color:#179D97;text-decoration:none">policycentral.ai</a>
    </p>
  </td></tr>

</table>
</td></tr>
</table>
</body>
</html>';
}

/**
 * 5. Send admin notification with all form data + tracking info
 */
add_action('fluentform/submission_inserted', 'pc_send_admin_notification', 30, 3);
function pc_send_admin_notification($entryId, $formData, $form) {
    $admin_email = 'punkaj@psdigital.io';
    $tracking = array(
        'IP Address'      => pc_get_client_ip(),
        'User Agent'      => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'N/A',
        'Referrer'        => isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'N/A',
        'OS'              => pc_detect_os(),
        'Browser'         => pc_detect_browser(),
        'Device'          => wp_is_mobile() ? 'Mobile' : 'Desktop',
        'Language'        => isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 50) : 'N/A',
        'UTM Source'      => isset($_COOKIE['pc_utm_source']) ? $_COOKIE['pc_utm_source'] : 'Direct',
        'UTM Medium'      => isset($_COOKIE['pc_utm_medium']) ? $_COOKIE['pc_utm_medium'] : '-',
        'UTM Campaign'    => isset($_COOKIE['pc_utm_campaign']) ? $_COOKIE['pc_utm_campaign'] : '-',
        'Submitted At'    => current_time('d M Y, h:i A'),
    );

    $first_name = isset($formData['names']['first_name']) ? sanitize_text_field($formData['names']['first_name']) : '';
    $last_name = isset($formData['names']['last_name']) ? sanitize_text_field($formData['names']['last_name']) : '';
    $company = isset($formData['company_name']) ? sanitize_text_field($formData['company_name']) : '';
    $email = isset($formData['email']) ? sanitize_email($formData['email']) : '';
    $phone = isset($formData['phone']) ? sanitize_text_field($formData['phone']) : 'Not provided';
    $message = isset($formData['message']) ? sanitize_textarea_field($formData['message']) : 'No message';

    $subject = "New Lead: {$first_name} {$last_name} from {$company}";

    // Build admin email
    $form_rows = '';
    $form_fields = array(
        'Name' => trim("{$first_name} {$last_name}"),
        'Company' => $company,
        'Email' => $email,
        'Phone' => $phone,
        'Message' => $message,
    );
    foreach ($form_fields as $label => $value) {
        $form_rows .= '<tr><td style="padding:10px 16px;font-size:13px;font-weight:700;color:#374151;border-bottom:1px solid #F3F4F6;width:120px">' . esc_html($label) . '</td><td style="padding:10px 16px;font-size:13px;color:#6B7280;border-bottom:1px solid #F3F4F6">' . esc_html($value) . '</td></tr>';
    }

    $tracking_rows = '';
    foreach ($tracking as $label => $value) {
        $tracking_rows .= '<tr><td style="padding:8px 16px;font-size:12px;font-weight:600;color:#6B7280;border-bottom:1px solid #F3F4F6;width:120px">' . esc_html($label) . '</td><td style="padding:8px 16px;font-size:12px;color:#9CA3AF;border-bottom:1px solid #F3F4F6;word-break:break-all">' . esc_html($value) . '</td></tr>';
    }

    $body = '<!DOCTYPE html>
<html><head><meta charset="UTF-8"></head>
<body style="margin:0;padding:0;background:#f4f5f7;font-family:-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,sans-serif">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f5f7;padding:32px 20px">
<tr><td align="center">
<table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.06)">
  <tr><td style="background:linear-gradient(135deg,#179D97,#05162A);padding:24px 32px">
    <h2 style="margin:0;color:#fff;font-size:18px;font-weight:700">New Lead from PolicyCentral.ai</h2>
    <p style="margin:6px 0 0;color:rgba(255,255,255,.7);font-size:13px">Entry #' . intval($entryId) . ' &bull; ' . esc_html(current_time('d M Y, h:i A')) . '</p>
  </td></tr>
  <tr><td style="padding:24px 32px">
    <h3 style="margin:0 0 12px;font-size:14px;font-weight:700;color:#111827;text-transform:uppercase;letter-spacing:.08em">Contact Details</h3>
    <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #E5E7EB;border-radius:8px;overflow:hidden">' . $form_rows . '</table>
  </td></tr>
  <tr><td style="padding:0 32px 24px">
    <h3 style="margin:0 0 12px;font-size:14px;font-weight:700;color:#111827;text-transform:uppercase;letter-spacing:.08em">Visitor Tracking</h3>
    <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #E5E7EB;border-radius:8px;overflow:hidden">' . $tracking_rows . '</table>
  </td></tr>
  <tr><td style="padding:0 32px 24px;text-align:center">
    <a href="' . esc_url(admin_url('admin.php?page=fluent_forms&route=entries&form_id=' . $form->id)) . '" style="display:inline-block;padding:10px 24px;background:#179D97;color:#fff;text-decoration:none;border-radius:8px;font-size:13px;font-weight:700">View in Dashboard</a>
  </td></tr>
</table>
</td></tr>
</table>
</body></html>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: PolicyCentral.ai <marketing@policycentral.ai>',
        'Reply-To: ' . $email,
    );

    wp_mail($admin_email, $subject, $body, $headers);
}
