<?php
/**
 * Migration 112: Sitemap cache bust shipping WITH the Prudential, Governance
 * & Reporting hub (views/hubs/prudential-governance.php).
 *
 * The hub URL /compliance/prudential-governance/ joins PCC_Sitemap automatically
 * once its partial exists, but the cached compliance-sitemap.xml on the servers
 * would keep omitting it until something busts the cache. Per the convention
 * from migration 067, the bust ships in the SAME commit as the content.
 */

function pcgpt_migration_112_prudential_hub_sitemap_bust() {
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
