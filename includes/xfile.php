<?php

/**
 * 
 * this class render the css and javascript 
 *  every xstudioapp widget has its own javascript and 
 *  css file , and the are all load by this class 
 *  each js and css file start with the name of class of widget 
 * 
 *
 */

if (!defined('ABSPATH')) exit;
class XFile {
     
    /**
     * 
     * @var name = name of the static method that  are called
     * @var args = arguments passe on the static method 
     * @return  path of css or path of js file 
     * 
     */
    

    public static function __callStatic($name, $args) {

        $class = $args[0] ?? 'Default'; 
        $class = new ReflectionClass($class)
        ->getShortName();

        $assets = [
            'js' =>  XSTUDIOAPP_URL . 'templates/js/' . $class . '.js',
            'css' => XSTUDIOAPP_URL . 'templates/css/' . $class . '.css'
        ];


        if (array_key_exists($name, $assets)) {
            return $assets[$name];
        }

        throw new Exception("Fichier '$name' inconnu.");
    }
}
