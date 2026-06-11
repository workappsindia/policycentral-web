<?php
/**
 * Migration 065: Invalidate Rank Math sitemap cache after the KYC hub launch.
 *
 * The KYC & CKYCR theme hub (views/hubs/kyc-ckycr.php) is a pure file add —
 * no DB change — so nothing else busts the cached compliance-sitemap.xml,
 * which would keep omitting the new /compliance/kyc-ckycr/ URL on production.
 * (Convention: every content batch invalidates the sitemap cache — see
 * migrations 044, 051, 064.)
 *
 * Idempotent: cache invalidation is safe to run any number of times.
 */

function pcgpt_migration_065_invalidate_sitemap_cache_kyc_hub() {

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }

    do_action('rank_math/sitemap/invalidate');
}
