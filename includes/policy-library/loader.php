<?php
/**
 * Policy Library, Bootstrap Loader
 *
 * The /policies/ "Policy Templates" library: sanitized, genericized
 * sample policies presented as adaptable templates, grouped into categories,
 * each with a lead-capture "mail me the personalized PDF" flow.
 *
 * Data model (native CPT + taxonomy, no virtual routing):
 *   pc_policy.post_content  = document body HTML (genericized to [Company Name])
 *   pc_policy.post_excerpt  = one-line hero byline
 *   meta _pcpl_covers       = JSON list, "what this template covers"
 *   meta _pcpl_faqs         = JSON list of {q,a}
 *   pc_policy_category term  = the category hub it belongs to
 *
 * Included from functions.php: require_once '.../policy-library/loader.php';
 */
defined('ABSPATH') || exit;

define('PCPL_DIR', __DIR__);
define('PCPL_URL', get_template_directory_uri() . '/includes/policy-library');
define('PCPL_ASSETS', get_template_directory() . '/assets/policy-templates');

require_once PCPL_DIR . '/class-pcpl-cpt.php';

PCPL_CPT::register();

/**
 * Is the current request a Policy Library view (single / archive / category)?
 * Used to scope asset enqueues.
 */
function pcpl_is_policy_view() {
    return is_singular(PCPL_CPT::POST_TYPE)
        || is_post_type_archive(PCPL_CPT::POST_TYPE)
        || is_tax(PCPL_CPT::TAXONOMY);
}

/**
 * The 6 policy categories, in display order. Single source of truth for the
 * landing cards, hub heroes, and nav. `hero` is a filename under
 * assets/policy-templates/; `icon` is inner SVG (24x24, stroke). Seeded as
 * pc_policy_category terms by the content migration.
 */
function pcpl_categories() {
    return array(
        'people-hr' => array(
            'name'   => 'People & HR',
            'desc'   => 'Handbooks and HR policies your team actually reads, from leave and POSH to onboarding, performance and exits.',
            'accent' => '#179D97',
            'hero'   => 'hero-people-hr.svg',
            'icon'   => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
        ),
        'financial-crime' => array(
            'name'   => 'Financial Crime & KYC/AML',
            'desc'   => 'KYC, anti-money-laundering, sanctions and fraud policies aligned to RBI Master Directions and the PMLA.',
            'accent' => '#0F766E',
            'hero'   => 'hero-financial-crime.svg',
            'icon'   => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="M9 12l2 2 4-4"/>',
        ),
        'governance-ethics' => array(
            'name'   => 'Governance & Ethics',
            'desc'   => 'Code of conduct, anti-bribery, conflicts of interest, gifts and whistleblowing policies.',
            'accent' => '#4338CA',
            'hero'   => 'hero-governance-ethics.svg',
            'icon'   => '<path d="M12 3v18"/><path d="M5 7h14"/><path d="M5 7l-3 6a4 4 0 0 0 6 0z"/><path d="M19 7l-3 6a4 4 0 0 0 6 0z"/><path d="M8 21h8"/>',
        ),
        'infosec-data' => array(
            'name'   => 'Information Security & Data',
            'desc'   => 'Data privacy, information security, access control, passwords and acceptable-use policies.',
            'accent' => '#6D28D9',
            'hero'   => 'hero-infosec-data.svg',
            'icon'   => '<rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
        ),
        'finance-tax-reporting' => array(
            'name'   => 'Finance, Tax & Reporting',
            'desc'   => 'Tax compliance, FATCA/CRS, financial reporting, regulatory returns and business continuity.',
            'accent' => '#B45309',
            'hero'   => 'hero-finance-tax.svg',
            'icon'   => '<line x1="12" y1="20" x2="12" y2="10"/><line x1="18" y1="20" x2="18" y2="4"/><line x1="6" y1="20" x2="6" y2="16"/>',
        ),
        'esg-dei-customer' => array(
            'name'   => 'ESG, DEI & Customer',
            'desc'   => 'ESG, CSR, diversity, equity & inclusion, and customer grievance-handling policies.',
            'accent' => '#047857',
            'hero'   => 'hero-esg-dei.svg',
            'icon'   => '<path d="M12 2a10 10 0 1 0 10 10"/><path d="M12 2C8 6 8 12 12 16c4-4 4-10 0-14z"/><path d="M2.5 12h19"/>',
        ),
    );
}

/** Metadata for one category slug (or null). */
function pcpl_category($slug) {
    $all = pcpl_categories();
    return isset($all[$slug]) ? $all[$slug] : null;
}

/**
 * Per-policy hero illustration URL. Each policy gets a bespoke
 * assets/policy-templates/hero-{slug}.svg; falls back to its category art.
 */
function pcpl_policy_hero($post_id) {
    $slug = get_post_field('post_name', $post_id);
    $file = 'hero-' . $slug . '.svg';
    if ($slug && file_exists(PCPL_ASSETS . '/' . $file)) {
        return get_template_directory_uri() . '/assets/policy-templates/' . $file;
    }
    $cat = pcpl_primary_category($post_id);
    return pcpl_category_hero($cat ? $cat->slug : '');
}

/**
 * Hero illustration URL for a category slug. Falls back to the KYC art until a
 * per-category illustration exists on disk.
 */
function pcpl_category_hero($category_slug) {
    $cat  = pcpl_category($category_slug);
    $file = $cat ? $cat['hero'] : 'hero-kyc-cdd.svg';
    if (!file_exists(PCPL_ASSETS . '/' . $file)) {
        $file = 'hero-kyc-cdd.svg';
    }
    return get_template_directory_uri() . '/assets/policy-templates/' . $file;
}

/** The primary category term for a policy (first assigned), or null. */
function pcpl_primary_category($post_id) {
    $terms = get_the_terms($post_id, PCPL_CPT::TAXONOMY);
    return (!empty($terms) && !is_wp_error($terms)) ? $terms[0] : null;
}

/** Decode a JSON meta list ([] on empty/invalid). */
function pcpl_meta_list($post_id, $key) {
    $raw = get_post_meta($post_id, $key, true);
    if (is_array($raw)) return $raw;
    $decoded = json_decode((string) $raw, true);
    return is_array($decoded) ? $decoded : array();
}
