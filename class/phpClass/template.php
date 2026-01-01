
<?php

use xstudioapp\activetemplate\RenderActiveTemplate;
if (!defined('ABSPATH')) exit;

class Template {
  
    // Private properties to store internal state
    private $newId  = null;
    private $action = null;

    /**
     * Register a custom post type for X-StudioApp templates
     */
    public static function registerTemplatePostType() {

        register_post_type('x-studioapp_template', [
            'labels' => [
                'name'          => 'Templates X-StudioApp', // General name
                'singular_name' => 'X -Template',           // Singular name
            ],
            'public'        => true,         // Make it accessible publicly
            'show_in_rest'  => true,         // Enable REST API support
            'show_in_menu'  => false,      // Optional: remove from admin menu
            //'show_in_admin_bar' => true,   // Optional: show in top admin bar
            'show_ui'       => true,         // Show UI in admin panel
            //'has_archive'   => false,      // Optional: no archive page
            'supports'      => ['title', 'editor', 'elementor'], // Supported fields
            //'menu_position' => 21,         // Menu order (if menu shown)
            //'menu_icon'     => 'dashicons-layout', // Icon (if menu shown)
            'map_meta_cap' => true,          // Use meta capabilities for permission
            'capability_type' => 'post',     // Use same capabilities as 'post'
        ]);
    }

    /**
     * Check if the current HTTP request is a POST request
     */
    private static function checkServerMethod() {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    /**
     * Create a new template post
     *
     * @param templateName:string The title of the template
     * @param templateType:string Type of template: header, footer, or single
     * @return false|int Returns the new post ID or false on failure
     */
    public static function createTemplate($templateName, $templateType) {
        if (!self::checkServerMethod()) {
            return;
        }

        // Sanitize input
        $templateName = sanitize_text_field($templateName);
        $templateType = sanitize_text_field($templateType);

        // Insert a new custom post
        $newId = wp_insert_post([
            'post_type'   => 'x-studioapp_template',
            'post_title'  => $templateName,
            'post_status' => 'draft',
            'meta_input'  => [
                '_xsa_template_type' => $templateType, // Store template type in post meta
            ]
        ]);

        // Display admin alert
        if (is_wp_error($newId)) {
            self::alert(false);
        } else {
            self::alert(true);
        }

        return $newId;
    }

    /**
     * Display a success or error notice in the admin panel
     */
    static private function alert($status) {
        if ($status) {
            echo '<div class="notice notice-success is-dismissible"><p>Template saved successfully!</p></div>';
        } else {
            echo '<div class="notice notice-error is-dismissible"><p>Error: Could not create template.</p></div>';
        }
    }

    /**
     * Retrieve all template posts
     *
     * @return array|false List of templates or false if none found
     */
    static function allTemplateList() {
        $args = [
            "post_type"      => "x-studioapp_template",
            "posts_per_page" => -1,
            "post_status"    => ["publish", "draft"],
            "orderby"        => "date",
            "order"          => "DESC"
        ];

        $query = new WP_Query($args);
        $allPost = [];

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $allPost[] = [
                    'ID'     => get_the_ID(),
                    'title'  => get_the_title(),
                    'status' => get_post_status(),
                    'type'   => get_post_meta(get_the_ID(), '_xsa_template_type', true),
                    'date'   => get_the_date(),
                ];
            }
            wp_reset_postdata(); // Reset after loop
            return $allPost;
        } else {
            return false;
        }
    }

    /**
     * Generate a secure delete URL for a template
     */
    public static function getDeleteUrl($templateId) {
        return wp_nonce_url(
            admin_url('admin-post.php?action=xsa_delete_template&template_id=' . absint($templateId)),
            'xsa_delete_template_action'
        );
    }

    /**
     * Delete a template post by ID
     */
    public static function deleteTemplate($templateId) {
        $templateId = absint($templateId);
        return wp_delete_post($templateId, true);
    }
 
    /**
     * Handle deletion of template via admin-post.php
     */ 
    public static function handleDelete() {
  

    if (!isset($_GET['template_id']) || !isset($_GET['_wpnonce'])) {
        wp_die('Missing parameters.');
    }

    $templateId = absint($_GET['template_id']);

    if (!wp_verify_nonce($_GET['_wpnonce'], 'xsa_delete_template_action')) {
        wp_die('Invalid nonce.');
    }

    $deleted = wp_delete_post($templateId, true);

    $redirect_url = add_query_arg('xsa_status', $deleted ? 'deleted' : 'error', admin_url('admin.php?page=xstudioapp_templates'));
    wp_redirect($redirect_url);
    exit;
}

    /**
     * Activate or deactivate templates based on selected IDs
     *
     * @param array $activeIDs List of template IDs to activate
     */
    public static function handleActivationToggle($activeIDs = []) {
        // Get all templates
        $allTemplates = self::allTemplateList();

        // Group by type (header, footer, etc.)
        $groupedByType = [];

        foreach ($groupedByType as $type => $ids) {
            $activeId = in_array($ids[0], $activeIDs) ? $ids[0] : false;
            if ($activeId) {
                update_option("xsa_active_{$type}_template", $activeId);
            } else {
                delete_option("xsa_active_{$type}_template");
            }
}

        foreach ($allTemplates as $tpl) {
            $groupedByType[$tpl['type']][] = $tpl['ID'];
        }

        // Loop through each group and activate or deactivate
        foreach ($groupedByType as $type => $ids) {
            foreach ($ids as $id) {
                update_post_meta($id, '_xsa_is_active', in_array($id, $activeIDs) ? '1' : '0');
            }
        }
    }

    
}



new Template();

add_action('admin_post_xsa_delete_template', ['Template', 'handleDelete']);