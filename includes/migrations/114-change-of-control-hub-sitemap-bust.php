<?php
/**
 * Migration 114: Sitemap cache bust shipping WITH the Prior Approval for
 * Change of Control hub (views/hubs/change-of-control.php), per the
 * migration 067 convention (bust ships in the SAME commit as the content).
 */

function pcgpt_migration_114_change_of_control_hub_sitemap_bust() {
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
