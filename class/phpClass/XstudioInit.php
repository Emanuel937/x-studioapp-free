<?php

if (!defined('ABSPATH')) exit;

class XStudioAppInit {

    /**
     * Constructor: triggers initialization.
     */
    public function __construct() {
        
        $this->start();
    }

    /**
     * Initialize the Box helper file after Elementor init.
     */
    private function initBox() {

            add_action('init', ['Template', 'registerTemplatePostType']);  
            add_action('elementor/widgets/register',                ['XstudioAppRegisterWidget', 'register']);
            add_action('elementor/elements/categories_registered',   function($manager) {
                XstudioAppRegisterWidget::setCategory($manager, 'XstudioApp leading', 'x_studioapp_leading');
            });
          
            
            add_action('elementor/init', function () {
               // add_post_type_support('x-studioapp_template', 'elementor');
                //add_action('admin_post_xsa_delete_template', ['Template', 'handleDelete']);

                $file = XSTUDIOAPP_PATH . 'helpers/Box.php';
                if (file_exists($file)) {
                    require_once $file;
                }
        });
    }

    /**
     * Register default stylesheet for blog widget.
     */
    private function setDefaultStyle() {
    add_action('wp_enqueue_scripts', function () {
        wp_enqueue_style(
            'xstudioapp-blog-widget',
            XSTUDIOAPP_URL . 'assets/css/xstudioapp-blog-widget.css',
            [],
            '1.0'
        );
    });
}


    /**
     * Start initialization process.
     */
    private function start() {
        $this->initBox();
        $this->setDefaultStyle();
    }
}

// Instantiate to kick things off
new XStudioAppInit();
