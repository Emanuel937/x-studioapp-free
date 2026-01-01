<?php
/**
 * Plugin Name: X-StudioApp Widget for Elementor
 * Description: X-StudioApp widget holds all Elementor Pro widgets and more.
 * Version: 1.0
 * Author: X-StudioApp
 * Text Domain: x-studioapp-widget
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */
 
if (!defined('ABSPATH')) exit;

define('XSTUDIOAPP_PATH', plugin_dir_path(__FILE__));
define('XSTUDIOAPP_URL',  plugin_dir_url(__FILE__));    

require_once XSTUDIOAPP_PATH . 'class/phpClass/error.php';                   // check if elementor is installed
require_once XSTUDIOAPP_PATH . 'includes/xstudioapp-register-widget.php';   // register class to add widget it is used on XstudioInit Class
require_once XSTUDIOAPP_PATH . 'includes/xfile.php';                 

require_once XSTUDIOAPP_PATH . 'utils/utils.php';
require_once XSTUDIOAPP_PATH . 'class/phpClass/menu.php';                   // create menu and submenu
require_once XSTUDIOAPP_PATH . 'class/phpClass/template.php';
require_once XSTUDIOAPP_PATH . 'class/phpClass/XstudioInit.php';            // register class is handle on this file
require_once XSTUDIOAPP_PATH . 'themes_hooks/astra.php';
require_once XSTUDIOAPP_PATH . 'themes_hooks/init.php';

function xstudioapp_enqueue_admin_icons($hook) {
    wp_enqueue_style(
        'elementor-icons-fa-admin',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        null
    );
}
add_action('admin_enqueue_scripts', 'xstudioapp_enqueue_admin_icons');
add_action('elementor/frontend/after_register_styles', function() {

    wp_enqueue_style(
        'xstudioapp-fa',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        null
    );
});

