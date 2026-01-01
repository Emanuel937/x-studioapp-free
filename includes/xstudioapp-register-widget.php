<?php


/**
 *  This class create element register, it is include on the main file 
 *  but is managed by XstudioInit class located in class/phpClass/XstudioInit
 * 
 */

use XStudioApp\Helpers\Template;
if (!defined('ABSPATH')) exit;

class XstudioAppRegisterWidget {

    /**
     * Adds a custom category to Elementor's category manager.
     *
     * @param \Elementor\Categories_Manager $categoryManager Elementor category manager instance
     * @param string $categoryName Human-readable name of the category
     * @param string $slug Unique slug identifier for the category
     */
    public static function setCategory($categoryManager, $categoryName, $slug) {
        $categoryManager->add_category(
            $slug,
            [
                'title' => $categoryName,
            ]
        );
    }
     


    /**
     *  Get all instance of widget at once 
     *  @param callable callback function 
     */
    private  static function getWidgetInstace(callable $callback){
        
        $arrayOfPath = glob(XSTUDIOAPP_PATH . '/widgets/*.php');

        $classesName = array_map(fn($abstPath) => pathinfo($abstPath, PATHINFO_FILENAME), $arrayOfPath);
         

        foreach($arrayOfPath as $path){
            require_once($path);
        }

        // make the instance of class

        $widgetNameSpace = "XstudioApp\\Widgets\\";
        
        foreach($classesName   as $class)
        {

            $instancePath         =  $widgetNameSpace . $class;
            $instance             = new $instancePath();

            $callback($instance);
        }


    }
    /**
     * Registers only the active widgets based on saved options.
     *
     * @param \Elementor\Widgets_Manager $widget_manager Elementor widget manager instance
     */
    public static function register($widget_manager) {

    
        $active_widgets = get_option('xstudioapp_active_widgets', []);

        if (!is_array($active_widgets)) {
            $active_widgets = [];
        }

     
        self::getWidgetInstace(
            function($instance) use($active_widgets, $widget_manager)
            {
                
                $instanceName = $instance->get_name();

                if(in_array($instanceName, $active_widgets, true)){

                    $widget_manager->register($instance);
                }

            }
        );


    
        
    }


    /**
     * Registers all widgets, regardless of active state.
     *
     * Useful for admin pages that list all widgets for enabling/disabling.
     * this registerAllWidgets is call on the XStudioAppMenu->enderSettingElements()
     * 
     * ******  you can find this class on includes/widget/class/phpClass/menu.php 
     * 
     * @param \Elementor\Widgets_Manager $widget_manager Elementor widget manager instance
     */

    public static function registerAllWidgets($widget_manager) {
        
         /**
          *  $widget_manager = Elementor/Plugins::$instance->manager
          */
         
          self::getWidgetInstace(
            function($instance) use($widget_manager)
            {
              
               $widget_manager->register($instance);
            }
        );
       
    }
}




 