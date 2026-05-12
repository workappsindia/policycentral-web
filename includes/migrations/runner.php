<?php
/**
 * PolicyGPT Migrations Runner
 *
 * HOW IT WORKS:
 * - On every admin_init, check the stored migration version
 * - Run any migrations newer than the stored version, in order
 * - Update the stored version after each successful migration
 *
 * HOW TO ADD A NEW MIGRATION:
 * 1. Create a new file in this folder: NNN-short-description.php (e.g., 003-add-new-category.php)
 * 2. Define a function inside it: pcgpt_migration_NNN_short_description()
 * 3. Register it in the $migrations array below with the next version number
 * 4. The migration runs automatically on the next admin_init
 *
 * RULES FOR WRITING MIGRATIONS:
 * - Must be idempotent (safe to run multiple times, even if state already exists)
 * - Forward-only (no rollback — write a new migration to reverse if needed)
 * - Should handle its own error cases gracefully
 */

// Load all migration files
$pcgpt_migrations_dir = __DIR__;
foreach (glob($pcgpt_migrations_dir . '/[0-9]*.php') as $migration_file) {
    require_once $migration_file;
}

/**
 * Registry of all migrations. Key = version number, Value = function name.
 * When adding a new migration, append it here with the next sequential version.
 */
function pcgpt_get_migrations() {
    return array(
        1 => 'pcgpt_migration_001_initial_tables',
        2 => 'pcgpt_migration_002_create_pages',
        3 => 'pcgpt_migration_003_lead_intelligence',
        4 => 'pcgpt_migration_004_widen_intel_columns',
        5 => 'pcgpt_migration_005_blogs_setup',
        6 => 'pcgpt_migration_006_seed_first_blog_post',
        7 => 'pcgpt_migration_007_create_use_case_pages',
        8 => 'pcgpt_migration_008_seed_wfh_blog_post',
        9 => 'pcgpt_migration_009_refresh_wfh_blog_content',
        10 => 'pcgpt_migration_010_remove_wfh_laws_map_image',
        11 => 'pcgpt_migration_011_seed_hr_policies_blog_post',
        12 => 'pcgpt_migration_012_swap_hr_blog_thumbnail',
        13 => 'pcgpt_migration_013_refresh_hr_blog_images',
        14 => 'pcgpt_migration_014_swap_gratuity_blog_thumbnail',
        15 => 'pcgpt_migration_015_refresh_wfh_blog_title_and_content',
        16 => 'pcgpt_migration_016_swap_wfh_blog_thumbnail',
        17 => 'pcgpt_migration_017_seed_pms_blog_post',
        18 => 'pcgpt_migration_018_attach_pms_blog_thumbnail',
        19 => 'pcgpt_migration_019_seed_compliance_fail_blog_post',
        20 => 'pcgpt_migration_020_seed_policy_lifecycle_blog_post',
        21 => 'pcgpt_migration_021_refresh_policy_lifecycle_blog',
        22 => 'pcgpt_migration_022_tighten_policy_lifecycle_blog',
        23 => 'pcgpt_migration_023_trim_policy_lifecycle_blog',
        24 => 'pcgpt_migration_024_swap_policy_lifecycle_thumbnail',
        25 => 'pcgpt_migration_025_swap_compliance_fail_thumbnail',
        26 => 'pcgpt_migration_026_refresh_compliance_fail_thumbnail_v2',
        27 => 'pcgpt_migration_027_refresh_policy_lifecycle_thumbnail_v2',
        28 => 'pcgpt_migration_028_set_use_case_page_excerpts',
        29 => 'pcgpt_migration_029_cleanup_wp_defaults',
        30 => 'pcgpt_migration_030_create_explore1_page',
        31 => 'pcgpt_migration_031_noindex_explore_pages',
        32 => 'pcgpt_migration_032_create_indian_labour_codes_category',
        33 => 'pcgpt_migration_033_seed_labour_codes_overview_blog_post',
        34 => 'pcgpt_migration_034_seed_50_percent_basic_salary_blog_post',
        35 => 'pcgpt_migration_035_seed_fixed_term_employee_blog_post',
        36 => 'pcgpt_migration_036_seed_gig_worker_policy_blog_post',
        37 => 'pcgpt_migration_037_seed_new_joiner_onboarding_blog_post',
        38 => 'pcgpt_migration_038_seed_posh_policy_blog_post',
        39 => 'pcgpt_migration_039_refresh_labour_codes_blog_links',
        40 => 'pcgpt_migration_040_refresh_existing_blog_outbound_links',
        41 => 'pcgpt_migration_041_refresh_hr_policies_blog_source_urls',
        42 => 'pcgpt_migration_042_refresh_blog_sources_batch_2',
        43 => 'pcgpt_migration_043_refresh_dpdp_act_link',
        44 => 'pcgpt_migration_044_invalidate_sitemap_cache',
        // Add new migrations here. Never remove or reorder existing ones.
    );
}

/**
 * Run all pending migrations.
 * Hooked to admin_init so migrations run when an admin logs in after a deploy.
 */
function pcgpt_run_migrations() {
    // Backfill: if the old pcgpt_db_version exists (from pre-migration system),
    // treat migration 001 as already applied to avoid re-seeding.
    if (get_option('pcgpt_migration_version', null) === null) {
        $old_version = get_option('pcgpt_db_version', null);
        if ($old_version === '1.0') {
            update_option('pcgpt_migration_version', 1);
        } else {
            update_option('pcgpt_migration_version', 0);
        }
    }

    $current_version = (int) get_option('pcgpt_migration_version', 0);
    $migrations = pcgpt_get_migrations();

    // Sort by version number to ensure correct order
    ksort($migrations);

    foreach ($migrations as $version => $function) {
        if ($version <= $current_version) continue;
        if (!function_exists($function)) {
            error_log("PCGPT Migration {$version}: function {$function} not found");
            continue;
        }

        try {
            call_user_func($function);
            update_option('pcgpt_migration_version', $version);
        } catch (Exception $e) {
            error_log("PCGPT Migration {$version} failed: " . $e->getMessage());
            // Stop running further migrations if one fails
            break;
        }
    }
}
add_action('admin_init', 'pcgpt_run_migrations');
