<?php
/**
 * Migration 067: Sitemap cache bust shipping WITH the KYC hub file.
 *
 * Migration 065 was written for this purpose but deployed ahead of the hub
 * (it rode the enforcement-singles removal commit), so it invalidated the
 * cache while /compliance/kyc-ckycr/ still rendered the stub — the cached
 * compliance-sitemap.xml on the servers omits the hub URL. This bust ships
 * in the same commit as views/hubs/kyc-ckycr.php, so PCC_Sitemap sees the
 * partial when the sitemap regenerates.
 *
 * Lesson encoded: a sitemap cache-bust migration must ship in the SAME
 * commit as the content it surfaces.
 *
 * Idempotent: cache invalidation is safe to run any number of times.
 */

function pcgpt_migration_067_invalidate_sitemap_cache_kyc_hub_ship() {

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }

    do_action('rank_math/sitemap/invalidate');
}
