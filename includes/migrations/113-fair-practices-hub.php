<?php
/**
 * Migration 113: Fair Practices Code hub goes live
 *
 *  - Retitles the 'fair-practices' theme term from "Fair Practices Code (NBFC)"
 *    to "Fair Practices Code": the hub covers NBFCs, HFCs, microfinance lenders
 *    and banks, since the Code now sits inside each entity class's 2025
 *    Responsible Business Conduct Directions.
 *  - Busts the sitemap cache so /compliance/fair-practices/ is picked up
 *    (ships in the SAME commit as views/hubs/fair-practices.php, per the
 *    migration 067 convention).
 *
 * Idempotent.
 */

function pcgpt_migration_113_fair_practices_hub() {
    $term = get_term_by('slug', 'fair-practices', 'theme');
    if ($term && $term->name !== 'Fair Practices Code') {
        wp_update_term($term->term_id, 'theme', array('name' => 'Fair Practices Code'));
    }
    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
