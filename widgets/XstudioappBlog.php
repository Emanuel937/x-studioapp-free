<?php
namespace XStudioApp\Widgets;

use XStudioApp\WidgetBox\Box;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class XstudioappBlog extends Box {

    public function get_name() {
        return 'xstudioapp_blog_widget';
    }

    public function get_title() {
        return 'Blog';
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];
    }

    public function _register_controls() {
               
    }



    public function get_style_depends() {
        return ['xstudioapp-blog-widget'];
    }
}
