<?php

if (!defined('ABSPATH')) exit; 
class XStudioAppMenu {

    public function __construct() {
        // Register admin menu when the 'admin_menu' hook is fired
        add_action('admin_menu', [ $this, 'start' ]);
        add_action('admin_head', [ $this, 'remove_duplicate_submenu' ]);
    }

    /**
     * Render the main dashboard menu page.
     */
    public function renderMainMenu() {
        require_once XSTUDIOAPP_PATH . 'templates/dashboardMenu.php';
    }

    /**
     * Render the Elements Manager page and register custom Elementor widgets.
     */
    
    public function renderSettingElements() {
        
        if ( class_exists('XstudioAppRegisterWidget') && method_exists('XstudioAppRegisterWidget', 'registerAllWidgets') ) {
            XstudioAppRegisterWidget::registerAllWidgets(\Elementor\Plugin::$instance->widgets_manager);
        }
        require_once XSTUDIOAPP_PATH . 'templates/settingElements.php';
    }

    /**
     *  render the theme builder page
     */

    public function themeBuilder(){
        require_once   XSTUDIOAPP_PATH . 'templates/menu/header.php';


    }    


    /**
     * Remove duplicate submenu (the top-level item that gets repeated as first submenu).
     */
    public function remove_duplicate_submenu() {
        remove_submenu_page('xstudioapp_leading', 'xstudioapp_leading');
    }

    /**
     * Register the admin menu and all submenus.
     */
    public function start() {
        // Top-level menu
        add_menu_page(
            'XstudioApp Leading',           // Page title
            'X-studioApp',                  // Menu label
            'manage_options',               // Capability
            'xstudioapp_leading',           // Menu slug
            [ $this, 'renderMainMenu' ],    // Callback function
            'dashicons-admin-generic',      // Icon
            90                              // Position
        );
        
        // Dashboard submenu
      /* add_submenu_page(
            'xstudioapp_leading',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'xstudioapp_dashboard',
            [ $this, 'renderMainMenu' ]
        );*/

        // Elements Manager submenu
        add_submenu_page(
            'xstudioapp_leading',
            'Elements Manager',
            'Elements Manager',
            'manage_options',
            'xstudioapp_setting_elements',
            [ $this, 'renderSettingElements' ]
        );


        // theme builder submenu
        /*
        add_submenu_page(
            'xstudioapp_leading',
            'Theme builder',
            'Theme builder',
            'manage_options',
            'xstudioapp-theme-builder',
            [$this, 'themeBuilder']
        );*/
    }
}

// Instantiate the menu class
new XStudioAppMenu();
