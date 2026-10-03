<?php
/**
 * Migration 111: Load the FY26-27 RBI enforcement records into the tracker
 *
 * 47 records read directly from RBI press releases (1 April to 18 September
 * 2026): 46 monetary penalties on banks, NBFCs, HFCs, payment firms, credit
 * bureaus and one ARC, plus the Paytm Payments Bank licence cancellation.
 * Co-operative banks and bulk NBFC CoR cancellations are out of scope.
 *
 * Data: includes/compliance/data/enforcement-fy26-27.json (same shape as the
 * FY25-26 seed). Loader: PCC_Enforcement::insert_record(), idempotent on id.
 */

function pcgpt_migration_111_load_enforcement_fy26_27() {
    if (!post_type_exists('rbi_enforcement') || !class_exists('PCC_Enforcement')) {
        return;
    }
    $records = PCC_Enforcement::records_from_file(PCC_DIR . '/data/enforcement-fy26-27.json');
    foreach ($records as $rec) {
        PCC_Enforcement::insert_record($rec);
    }
    // No new URLs (enforcement records are data-only, tracker URL unchanged),
    // so no sitemap bust is needed.
}
