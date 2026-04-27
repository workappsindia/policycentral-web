<?php
/**
 * Guest Authors CPT — pc_author
 *
 * Allows the client's team to create author profiles (both internal staff and
 * external influencers) without needing to give them WordPress login access.
 *
 * Each post in WordPress can be assigned to one guest author via a meta box
 * (handled in class-pcb-admin.php). The guest author is displayed in the
 * byline / author box / author archive in place of (or alongside) the WP user.
 *
 * Author profile fields (all stored as post meta):
 *  - _pcb_designation : Title / role (e.g., "Lead – PolicyCentral & VideoCX")
 *  - _pcb_linkedin    : LinkedIn profile URL
 *  - _pcb_twitter     : Twitter/X profile URL
 *  - _pcb_email       : Contact email
 *
 * Bio is stored in post_content; photo is the featured image.
 */

if (!defined('ABSPATH')) exit;

class PCB_Authors {

    const POST_TYPE = 'pc_author';

    public static function register() {
        self::register_cpt();
        add_action('add_meta_boxes', array(__CLASS__, 'add_meta_boxes'));
        add_action('save_post_' . self::POST_TYPE, array(__CLASS__, 'save_meta'), 10, 2);
        add_filter('manage_' . self::POST_TYPE . '_posts_columns', array(__CLASS__, 'admin_columns'));
        add_action('manage_' . self::POST_TYPE . '_posts_custom_column', array(__CLASS__, 'admin_column_content'), 10, 2);
    }

    private static function register_cpt() {
        register_post_type(self::POST_TYPE, array(
            'labels' => array(
                'name'               => 'Authors',
                'singular_name'      => 'Author',
                'menu_name'          => 'Blog Authors',
                'add_new'            => 'Add Author',
                'add_new_item'       => 'Add New Author',
                'edit_item'          => 'Edit Author',
                'new_item'           => 'New Author',
                'view_item'          => 'View Author',
                'search_items'       => 'Search Authors',
                'not_found'          => 'No authors found',
                'not_found_in_trash' => 'No authors in trash',
                'featured_image'     => 'Author Photo',
                'set_featured_image' => 'Set author photo',
                'remove_featured_image' => 'Remove photo',
                'use_featured_image' => 'Use as author photo',
            ),
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_admin_bar'   => false,
            'menu_position'       => 25,
            'menu_icon'           => 'dashicons-admin-users',
            'supports'            => array('title', 'editor', 'thumbnail'),
            'has_archive'         => false,          // We serve archives via custom rewrite
            'rewrite'             => false,          // Custom rewrites in PCB_Rewrite
            'publicly_queryable'  => false,          // Handled via custom query for /blogs/author/{slug}/
            'exclude_from_search' => true,
            'capability_type'     => 'post',
        ));
    }

    public static function add_meta_boxes() {
        add_meta_box(
            'pcb_author_profile',
            'Author Profile',
            array(__CLASS__, 'render_profile_meta'),
            self::POST_TYPE,
            'normal',
            'high'
        );
    }

    public static function render_profile_meta($post) {
        wp_nonce_field('pcb_author_meta', 'pcb_author_meta_nonce');

        $designation = get_post_meta($post->ID, '_pcb_designation', true);
        $linkedin    = get_post_meta($post->ID, '_pcb_linkedin', true);
        $twitter     = get_post_meta($post->ID, '_pcb_twitter', true);
        $email       = get_post_meta($post->ID, '_pcb_email', true);
        ?>
        <style>
            .pcb-author-field{margin:16px 0}
            .pcb-author-field label{display:block;font-weight:600;margin-bottom:6px;color:#1e1e1e}
            .pcb-author-field input[type="text"],
            .pcb-author-field input[type="url"],
            .pcb-author-field input[type="email"]{width:100%;padding:8px 10px;font-size:14px}
            .pcb-author-field .description{color:#646970;font-size:12px;margin-top:4px}
        </style>
        <div class="pcb-author-field">
            <label for="pcb_designation">Designation / Title</label>
            <input type="text" id="pcb_designation" name="pcb_designation" value="<?php echo esc_attr($designation); ?>" placeholder="e.g., Lead – PolicyCentral & VideoCX">
            <p class="description">Shown under the author's name on blog posts and their profile page.</p>
        </div>
        <div class="pcb-author-field">
            <label for="pcb_linkedin">LinkedIn URL</label>
            <input type="url" id="pcb_linkedin" name="pcb_linkedin" value="<?php echo esc_attr($linkedin); ?>" placeholder="https://www.linkedin.com/in/...">
        </div>
        <div class="pcb-author-field">
            <label for="pcb_twitter">Twitter / X URL</label>
            <input type="url" id="pcb_twitter" name="pcb_twitter" value="<?php echo esc_attr($twitter); ?>" placeholder="https://x.com/...">
        </div>
        <div class="pcb-author-field">
            <label for="pcb_email">Contact Email</label>
            <input type="email" id="pcb_email" name="pcb_email" value="<?php echo esc_attr($email); ?>" placeholder="name@example.com">
        </div>
        <p class="description" style="margin-top:20px;padding:12px;background:#f0f6fc;border-left:4px solid #2271b1;">
            <strong>Bio:</strong> Write the author's bio in the main editor above. It appears on blog posts and their author page.<br>
            <strong>Photo:</strong> Use the "Author Photo" box (featured image) in the sidebar.
        </p>
        <?php
    }

    public static function save_meta($post_id, $post) {
        if (!isset($_POST['pcb_author_meta_nonce'])) return;
        if (!wp_verify_nonce($_POST['pcb_author_meta_nonce'], 'pcb_author_meta')) return;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!current_user_can('edit_post', $post_id)) return;

        $fields = array(
            '_pcb_designation' => isset($_POST['pcb_designation']) ? sanitize_text_field($_POST['pcb_designation']) : '',
            '_pcb_linkedin'    => isset($_POST['pcb_linkedin'])    ? esc_url_raw($_POST['pcb_linkedin'])           : '',
            '_pcb_twitter'     => isset($_POST['pcb_twitter'])     ? esc_url_raw($_POST['pcb_twitter'])            : '',
            '_pcb_email'       => isset($_POST['pcb_email'])       ? sanitize_email($_POST['pcb_email'])           : '',
        );

        foreach ($fields as $key => $value) {
            update_post_meta($post_id, $key, $value);
        }
    }

    public static function admin_columns($columns) {
        $new = array();
        foreach ($columns as $key => $label) {
            $new[$key] = $label;
            if ($key === 'title') {
                $new['designation'] = 'Designation';
                $new['photo']       = 'Photo';
            }
        }
        return $new;
    }

    public static function admin_column_content($column, $post_id) {
        switch ($column) {
            case 'designation':
                echo esc_html(get_post_meta($post_id, '_pcb_designation', true));
                break;
            case 'photo':
                if (has_post_thumbnail($post_id)) {
                    echo get_the_post_thumbnail($post_id, array(40, 40), array('style' => 'border-radius:50%;object-fit:cover'));
                } else {
                    echo '<span style="color:#999">—</span>';
                }
                break;
        }
    }
}
