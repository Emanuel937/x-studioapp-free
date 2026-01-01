<?php 

namespace XStudioApp\Widgets;


use Elementor\Controls_Manager;
use Elementor\Repeater;
use XStudioApp\WidgetBox\Box;
use Elementor\Group_Control_Typography;



class XstudioDrawerMenu extends Box{


    public function get_menu(){

        $menus =  wp_get_nav_menus();
        $options = [];

        foreach($menus as $menu){
            $options[$menu->slug] = $menu->name;
        }

        return $options;

    }

    public function get_name() {
        return 'xstudioapp_drawer_menu';
    }

    public function get_title() {
        return 'Off-canvas';
    }

    public function get_icon() {
        return 'eicon-menu-bar';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];
    }

}