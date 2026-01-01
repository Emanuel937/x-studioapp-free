<?php

if (!defined('ABSPATH')) exit;

class Activator {
    
    private static $instance = null;

    private $templates = [];
    private $header_template = null;
    private $footer_template = null;
    private $single_template = null;
    private $archive_template = null;
    private $shop_archive_template = null;
    private $shop_single_template = null;

    private $current_theme;
    private $current_template;

    private $post_type = 'x-studioapp_template'; // custom post type

    public function __construct() {
        add_action('wp', [$this, 'init_hooks']);
    }

    public function init_hooks() {
        $template_slug = get_page_template_slug();
        $this->current_template = $template_slug ? basename($template_slug) : '';

        if ($this->current_template === 'elementor_canvas') {
            return;
        }

        $this->current_theme = get_template();
        $template_ids = self::template_ids();

        // Load theme-specific hook handler
        $theme_map = [
            'astra'                => 'Astra',
            'neve'                 => 'Neve',
            'generatepress'        => 'Generatepress',
            'generatepress-child'  => 'Generatepress',
            'oceanwp'              => 'Oceanwp',
            'oceanwp-child'        => 'Oceanwp',
            'bb-theme'             => 'Bbtheme',
            'bb-theme-child'       => 'Bbtheme',
            'genesis'              => 'Genesis',
            'genesis-child'        => 'Genesis',
            'twentynineteen'       => 'TwentyNineteen',
            'my-listing'           => 'MyListing',
            'my-listing-child'     => 'MyListing',
        ];

        $class_name = $theme_map[$this->current_theme] ?? 'Theme_Support';
        $class_path = "XstudioApp\\ThemeHook\\{$class_name}";

        if (class_exists($class_path)) {
            
            new $class_path($template_ids);
        }
    }

    public static function template_ids() {

        $instance = self::instance();
        $instance->load_templates();
        $instance->get_header_footer();

        $ids = [
            $instance->header_template,
            $instance->footer_template,
            $instance->single_template,
            $instance->archive_template,
            $instance->shop_single_template,
            $instance->shop_archive_template,
      
        ];


        /*
        foreach (['header_template', 'footer_template'] as $type) {
            $id = $instance->$type;
            if ($id) {
                \ElementsKit_Lite\Utils::render_elementor_content_css($id);
            }
        }

        wp_cache_set('xstudioapp_template_ids', $ids);
        */

        return $ids;
    }

   protected function load_templates(): void
    {
        $template_ids = array_filter([
            (int) get_option('xsa_active_header_template'),
            (int) get_option('xsa_active_footer_template'),
            (int) get_option('xsa_active_single_template'),
            (int) get_option('xsa_active_archive_template'),
            (int) get_option('xsa_active_single_product_template'),
            (int) get_option('xsa_active_catalogue_template'),
        ]);



        $this->templates = !empty($template_ids)
            ? get_posts([
                'post_type' => $this->post_type,
                'include'   => $template_ids,
            ])
            : [];
    }

    protected function get_header_footer() {
        if (empty($this->templates)) {
            return;
        }

        foreach ($this->templates as $template) {
            $template = $this->get_full_data($template);


            if (defined('ICL_LANGUAGE_CODE')) {
                $lang_details = apply_filters('wpml_post_language_details', null, $template['ID']);
                if (!empty($lang_details) && $lang_details['language_code'] !== ICL_LANGUAGE_CODE) {
                    continue;
                }
            }

            if ($template['type'] === 'header') {
            
                $this->header_template = $template['ID'];
            }

            if ($template['type'] === 'footer') {
                $this->footer_template = $template['ID'];
            }
            
            if ($template['type'] === 'single') {
            
                $this->single_template  = $template['ID'];
            }
            
            if ($template['type'] === 'archive') {
            
                $this->archive_template  = $template['ID'];
            }

             if ($template['type'] === 'shop_single') {
            
                $this->shop_single_template  = $template['ID'];
            }


             if ($template['type'] === 'shop_archive') {
            
                $this->shop_archive_template  = $template['ID'];
            }
        }
    }

  protected function get_full_data($post) {
    if ($post instanceof WP_Post) {

        return [
            'ID'   => $post->ID,
            'type' => get_post_meta($post->ID, '_xsa_template_type')[0]
        ];
    }
    return null;
}




    public static function instance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

// Initialize
new Activator();
