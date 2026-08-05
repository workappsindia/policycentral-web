<?php
/**
 * Migration 101: Strip literal **markdown bold** from Policy Library content.
 *
 * Several policy bodies (and their FAQ meta) were seeded with raw **markdown**
 * markers that rendered as literal asterisks on the live pages. This normalises
 * them across every pc_policy in the DB:
 *   - post_content (raw HTML body):  **x**  ->  <strong>x</strong>
 *   - _pcpl_faqs meta (escaped with esc_html in the template): markers stripped,
 *     since a <strong> tag would render as visible text there.
 *
 * Self-contained (does not read policies.json) and idempotent: once converted,
 * no ** remain, so a re-run is a no-op. policies.json has been cleaned to match
 * so fresh re-seeds (097) produce the same result.
 */

function pcgpt_migration_101_strip_markdown_bold_policy_content() {
    if (!class_exists('PCPL_CPT')) return;
    $pt = PCPL_CPT::POST_TYPE;

    $ids = get_posts(array(
        'post_type'   => $pt,
        'post_status' => array('publish', 'draft', 'pending', 'private'),
        'numberposts' => -1,
        'fields'      => 'ids',
    ));

    foreach ($ids as $pid) {
        // Body -> real bold.
        $body = get_post_field('post_content', $pid);
        if (is_string($body) && strpos($body, '**') !== false) {
            $new = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $body);
            if (is_string($new) && $new !== $body) {
                wp_update_post(array('ID' => $pid, 'post_content' => $new));
            }
        }

        // FAQ meta -> strip markers (template escapes HTML).
        $faqs = function_exists('pcpl_meta_list') ? pcpl_meta_list($pid, '_pcpl_faqs') : array();
        $changed = false;
        foreach ($faqs as &$f) {
            foreach (array('q', 'a') as $k) {
                if (isset($f[$k]) && strpos($f[$k], '**') !== false) {
                    $stripped = preg_replace('/\*\*(.+?)\*\*/s', '$1', $f[$k]);
                    if (is_string($stripped)) { $f[$k] = $stripped; $changed = true; }
                }
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
