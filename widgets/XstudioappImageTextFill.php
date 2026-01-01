<?php
namespace XStudioApp\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use XStudioApp\WidgetBox\Box;


class XstudioappImageTextFill extends Box {

    public function get_name() {
        return 'image_text_fill';
    }

    public function get_title() {
        return 'Image Text Fill';
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];
    }

    protected function register_controls() {

        // Section contenu
        $this->start_controls_section(
            'xstudioapp_content_section',
            [
                'label' => 'Contenu',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'xstudioapp_text',
            [
                'label' => 'Texte',
                'type' => Controls_Manager::TEXT,
                'default' => 'Texte Rempli',
                'placeholder' => 'Entrez le texte ici',
            ]
        );

        $this->add_control(
            'xstudioapp_image_fill',
            [
                'label' => 'Image de remplissage',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://fr.x-studioapp.com/wp-content/uploads/2025/07/stunning-8166666_1280.jpg',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_background_position',
            [
                'label' => 'Position de l’image',
                'type' => Controls_Manager::SELECT,
                'default' => 'center center',
                'options' => [
                    'left top' => 'Gauche Haut',
                    'left center' => 'Gauche Centre',
                    'left bottom' => 'Gauche Bas',
                    'center top' => 'Centre Haut',
                    'center center' => 'Centre Centre',
                    'center bottom' => 'Centre Bas',
                    'right top' => 'Droite Haut',
                    'right center' => 'Droite Centre',
                    'right bottom' => 'Droite Bas',
                ],
            ]
        );

        $this->end_controls_section();

        // Section style texte
        $this->start_controls_section(
            'xstudioapp_style_section',
            [
                'label' => 'Style du texte',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'xstudioapp_typography',
                'selector' => '{{WRAPPER}} .image-text-fill',
            ]
        );

        $this->add_control(
            'xstudioapp_text_align',
            [
                'label' => 'Alignement du texte',
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => 'Gauche',
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => 'Centre',
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => 'Droite',
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .image-text-fill' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_text_size',
            [
                'label' => 'Taille du texte (px)',
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'unit' => 'px',
                    'size' => 60,
                ],
                'range' => [
                    'px' => ['min' => 10, 'max' => 200],
                    'em' => ['min' => 0.5, 'max' => 10],
                    '%' => ['min' => 10, 'max' => 300],
                ],
                'selectors' => [
                    '{{WRAPPER}} .image-text-fill' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

   
}
