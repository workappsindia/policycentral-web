<?php
/**
 * Blog Admin Tweaks
 *
 * Adds two meta boxes to standard Posts in wp-admin:
 *   1. Primary Category — one category radio selector (enforces single category URL)
 *   2. Guest Author — dropdown of published pc_author entries
 *
 * Also disables comments by default for posts, since we're not doing comments on v1.
 */

if (!defined('ABSPATH')) exit;

class PCB_Admin {

    public static function register() {
        add_action('add_meta_boxes', array(__CLASS__, 'add_post_meta_boxes'));
        add_action('save_post_post',  array(__CLASS__, 'save_post_meta'), 10, 2);

        // Disable comments globally
        add_filter('comments_open',      '__return_false');
        add_filter('pings_open',         '__return_false');
        add_filter('comments_array',     '__return_empty_array');
    }

    public static function add_post_meta_boxes() {
        add_meta_box(
            'pcb_primary_category',
            'Primary Category (URL)',
            array(__CLASS__, 'render_primary_category'),
            'post',
            'side',
            'high'
        );
        add_meta_box(
            'pcb_guest_author',
            'Guest Author',
            array(__CLASS__, 'render_guest_author'),
            'post',
            'side',
            'high'
        );
    }

    public static function render_primary_category($post) {
        wp_nonce_field('pcb_post_meta', 'pcb_post_meta_nonce');

        $categories = get_categories(array(
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC',
        ));

        $selected = (int) get_post_meta($post->ID, '_pcb_primary_category', true);

        // If no primary set yet, default to first assigned category
        if (!$selected) {
            $assigned = wp_get_post_categories($post->ID);
            if (!empty($assigned)) $selected = (int) $assigned[0];
        }

        echo '<p class="description" style="margin-top:0">The post URL will be <code>/blogs/{primary-category}/{slug}/</code>. Pick exactly one.</p>';
        echo '<div style="max-height:260px;overflow:auto;border:1px solid #dcdcde;padding:10px;background:#fff">';
        foreach ($categories as $cat) {
            printf(
                '<label style="display:block;padding:4px 0"><input type="radio" name="pcb_primary_category" value="%d" %s> %s</label>',
                (int) $cat->term_id,
                checked($selected, $cat->term_id, false),
                esc_html($cat->name)
            );
        }
        echo '</div>';
    }

    public static function render_guest_author($post) {
        // Nonce is emitted by render_primary_category (same save handler)
        $selected = (int) get_post_meta($post->ID, '_pcb_guest_author', true);

        $authors = get_posts(array(
            'post_type'      => 'pc_author',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC',
        ));

        echo '<p class="description" style="margin-top:0">Choose the author shown in the byline. Leave blank to use the WP user author.</p>';
        echo '<select name="pcb_guest_author" style="width:100%">';
        echo '<option value="">— Use WP user author —</option>';
        foreach ($authors as $author) {
            printf(
                '<option value="%d" %s>%s</option>',
                (int) $author->ID,
                selected($selected, $author->ID, false),
                esc_html($author->post_title)
            );
        }
        echo '</select>';
        if (empty($authors)) {
            echo '<p style="color:#b32d2e;margin-top:8px"><em>No guest authors yet.</em> Add one under <strong>Blog Authors → Add Author</strong>.</p>';
        }
    }

    public static function save_post_meta($post_id, $post) {
        if (!isset($_POST['pcb_post_meta_nonce'])) return;
        if (!wp_verify_nonce($_POST['pcb_post_meta_nonce'], 'pcb_post_meta')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        // Primary category
        if (isset($_POST['pcb_primary_category'])) {
            $primary_id = (int) $_POST['pcb_primary_category'];
            $previous   = (int) get_post_meta($post_id, '_pcb_primary_category', true);

            if ($primary_id > 0) {
                update_post_meta($post_id, '_pcb_primary_category', $primary_id);

                // Ensure this category is actually assigned to the post
                $assigned = wp_get_post_categories($post_id);
                if (!in_array($primary_id, $assigned, true)) {
                    $assigned[] = $primary_id;
                    wp_set_post_categories($post_id, $assigned);
                }

                // If primary category CHANGED and this post was previously published,
                // register a 301 redirect from the old URL to the new one.
                if ($previous && $previous !== $primary_id && $post->post_status === 'publish') {
                    self::register_redirect($post_id, $previous, $primary_id);
                }
            }
        }

        // Guest author
        if (isset($_POST['pcb_guest_author'])) {
            $author_id = (int) $_POST['pcb_guest_author'];
            if ($author_id > 0) {
                update_post_meta($post_id, '_pcb_guest_author', $author_id);
            } else {
                delete_post_meta($post_id, '_pcb_guest_author');
            }
        }
    }

    /**
     * Register a 301 redirect when a post's primary category changes.
     * Stored in wp_options as a simple array. Served via template_redirect.
     */
    private static function register_redirect($post_id, $old_cat_id, $new_cat_id) {
        $post = get_post($post_id);
        if (!$post) return;

        $old_cat = get_term($old_cat_id, 'category');
        $new_cat = get_term($new_cat_id, 'category');
        if (!$old_cat || !$new_cat || is_wp_error($old_cat) || is_wp_error($new_cat)) return;

        $old_url = '/blogs/' . $old_cat->slug . '/' . $post->post_name . '/';
        $new_url = '/blogs/' . $new_cat->slug . '/' . $post->post_name . '/';

        $redirects = get_option('pcb_redirects', array());
        $redirects[$old_url] = $new_url;
        update_option('pcb_redirects', $redirects, false);
    }
}

/**
 * Template redirect: handle 301s for changed post URLs.
 */
add_action('template_redirect', function() {
    if (is_admin()) return;
    $redirects = get_option('pcb_redirects', array());
    if (empty($redirects)) return;

    $request = '/' . trim($_SERVER['REQUEST_URI'] ?? '', '/') . '/';
    $request = preg_replace('#/+#', '/', $request);
    $request = strtok($request, '?'); // strip query string

    if (isset($redirects[$request])) {
        wp_redirect(home_url($redirects[$request]), 301);
        exit;
    }
});
