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
