<?php
/**
 * Migration 103: Remove the ("the Company") alias from FAQ answers.
 *
 * The "purpose" FAQ echoed each policy's opening line verbatim, restating the
 * [Company Name] ("the Company") alias that the body already defines once, so the
 * phrase appeared twice on the page. This strips the parenthetical alias (any
 * quote form) from every _pcpl_faqs answer, leaving the body's single definition.
 *
 * Idempotent: once removed, the pattern no longer matches. policies.json has been
 * cleaned to match so fresh re-seeds (097) produce the same result.
 */

function pcgpt_migration_103_strip_faq_company_alias() {
    if (!class_exists('PCPL_CPT')) return;

    $ids = get_posts(array(
        'post_type'   => PCPL_CPT::POST_TYPE,
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => -1,
        'fields'      => 'ids',
    ));

    // Matches  ("the Company") with straight, curly, or HTML-entity quotes.
    $re = '/\s*\((?:"|&quot;|\x{201C})the Company(?:"|&quot;|\x{201D})\)/u';

    foreach ($ids as $pid) {
        $faqs = function_exists('pcpl_meta_list') ? pcpl_meta_list($pid, '_pcpl_faqs') : array();
        if (!$faqs) continue;
        $changed = false;
        foreach ($faqs as &$f) {
            if (isset($f['a']) && is_string($f['a'])) {
                $new = preg_replace($re, '', $f['a']);
                if (is_string($new) && $new !== $f['a']) { $f['a'] = $new; $changed = true; }
            }
        }
        unset($f);
        if ($changed) {
            update_post_meta($pid, '_pcpl_faqs', wp_slash(json_encode($faqs)));
        }
    }

    if (class_exists('RankMath\Sitemap\Cache')
        && method_exists('RankMath\Sitemap\Cache', 'invalidate_storage')) {
        RankMath\Sitemap\Cache::invalidate_storage();
    }
    do_action('rank_math/sitemap/invalidate');
}
