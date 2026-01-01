<?php 
if (!defined('ABSPATH')) exit;
class ErrorMessage{
    
    static public function showError()
    {

        if (!did_action('elementor/loaded')) {
    
            add_action('admin_notices', function () {
                echo "<div class='notice notice-error'><p><strong>X-StudioApp Widget</strong> requires <a href='https://wordpress.org/plugins/elementor/' target='_blank'>Elementor</a> to be installed and activated.</p></div>";
        
            });

            exit;
        }
    }
   

    // verifiy it any theme is installed
   static public function isThemeInstalled() {

    $theme = wp_get_theme();

    if ( ! $theme->exists() ) {
        add_action('admin_notices', function() {
            echo "<div class='notice notice-error'>
                    <p>No theme is installed. A theme is required for WordPress to work correctly.</p>
                  </div>";
        });
    }
}

}

ErrorMessage::showError();
ErrorMessage::isThemeInstalled();