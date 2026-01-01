<?php

/**
 *   Box class is used each widget class to automacaly 
 *   render the  template of widget 
 */

namespace XStudioApp\WidgetBox;

use Elementor\Widget_Base;

if (!defined('ABSPATH')) exit;

abstract class Box extends Widget_Base {
    
    private $className;

    public function __construct($data = [], $args = null) {

        parent::__construct($data, $args);
        $this->className = strtolower(basename(str_replace('\\', '/', get_class($this))));
        add_action('wp_footer', [$this, 'register_script']);
   }


    public function register_script() {

        $jsFilePath = XSTUDIOAPP_PATH . 'templates/js/' . $this->className . '.js';
        $jsFileUrl  = XSTUDIOAPP_URL  . 'templates/js/' . $this->className . '.js';

        if (!file_exists($jsFilePath)) {

            $handle = fopen($jsFilePath, 'w');

            if (is_resource($handle)) {
                chmod($jsFilePath, 0777);
                fclose($handle);
            } else {
                error_log('Failed to create JS file: ' . $jsFilePath);
                return false;
            }
        }

        wp_register_script(
            $this->className,
            $jsFileUrl,
            ['jquery', 'elementor-frontend'],
            '1.0.0',
            true
        );

        wp_enqueue_script($this->className); // Always enqueue for both frontend and editor

        
    }


    public function get_name() 
    {
        return 'abstract_box'; // ou une valeur par défaut
    }

    public function get_title() {
        return 'Abstract Box';
    }

    public function get_icon() {
        return 'eicon-box';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];
    }

    public function loadFile(string $folder, string $extension) {
    
        return XSTUDIOAPP_PATH . 'templates/' . $folder . '/' . $this->className . $extension;
    }


    public function get_script_depends() {
      return [$this->className];
    }

    public function render() {

        $this->className = basename(str_replace('\\', '/', get_class($this)));

        $templateFile = $this->loadFile('widget', 'HTML.php');
        

        if (file_exists($templateFile)) {
         
            include $templateFile;
        } else {

            try {
                // Création du fichier s’il n’existe pas
                $templateHandle = fopen($templateFile, 'w');

                if ($templateHandle === false) {
                    return false;
                }

                fclose($templateHandle);

                // chmod sur le fichier créé
                chmod($templateFile, 0777);

            } catch (\Exception $error) {
                var_dump($error->getMessage());
            }
        }
    }

}
