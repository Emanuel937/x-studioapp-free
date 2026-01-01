<?php
namespace XStudioApp\Widgets;

use XStudioApp\WidgetBox\Box;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

class Xstudioapp_Hexagons extends Box {

    public function get_name() {
        return 'xstudioapp_hexagon';
    }

    public function get_title() {
        return 'Hexagon';
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];
    }

    protected function register_controls() {

        $this->start_controls_section('section_content', [
            'label' => 'Contenu',
        ]);

        $this->add_control('hex_title', [
            'label' => 'Titre',
            'type' => Controls_Manager::TEXT,
            'default' => 'Titre ici',
        ]);

        $this->add_control('hex_link', [
            'label' => 'Lien',
            'type' => Controls_Manager::URL,
            'placeholder' => 'https://...',
            'show_external' => true,
            'default' => ['url' => '', 'is_external' => true, 'nofollow' => true],
        ]);

        $this->add_control('hex_image', [
            'label' => 'Image de fond',
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => '',
            ],
        ]);

        $this->add_control('hex_bg_color', [
            'label' => 'Couleur de fond (si pas d’image)',
            'type' => Controls_Manager::COLOR,
            'default' => 'rgba(255, 255, 255, 0.08)',
            'selectors' => [],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('section_style', [
            'label' => 'Style',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('hex_width', [
            'label' => 'Largeur',
            'type' => Controls_Manager::SLIDER,
            'default' => ['size' => 170],
            'range' => ['px' => ['min' => 100, 'max' => 500]],
            'selectors' => [],
        ]);

        $this->add_responsive_control('hex_height', [
            'label' => 'Hauteur',
            'type' => Controls_Manager::SLIDER,
            'default' => ['size' => 196],
            'range' => ['px' => ['min' => 100, 'max' => 600]],
            'selectors' => [],
        ]);

        $this->add_responsive_control('hex_padding', [
            'label' => 'Padding',
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'default' => ['top' => 0, 'right' => 0, 'bottom' => 0, 'left' => 0],
            'selectors' => [],
        ]);

        $this->add_control('hex_overlay_blur', [
            'label' => 'Blur overlay (px)',
            'type' => Controls_Manager::NUMBER,
            'default' => 6,
            'min' => 0,
            'max' => 20,
        ]);

        $this->add_control('hex_overlay_bg_opacity', [
            'label' => 'Opacité overlay',
            'type' => Controls_Manager::SLIDER,
            'default' => ['size' => 10],
            'range' => [
                'px' => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [],
            'description' => 'Opacité en % (0 = transparent, 100 = opaque)',
        ]);

        $this->end_controls_section();
    }


}
