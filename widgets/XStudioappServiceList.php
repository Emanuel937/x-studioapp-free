<?php
namespace XStudioApp\Widgets;

use XStudioApp\WidgetBox\Box;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class XStudioappServiceList extends Box {

    public function get_name() {
        return 'Service list';
    }

    public function get_title() {
        return 'Service list';
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
      
        return ['x_studioapp_leading'];
    }


    protected function register_controls() {
        // Section: Content
        $this->start_controls_section(
            'content_section',
            [
                'label' => 'Contenu ',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();
       

        $repeater->add_control(
            'list_text',
            [
                'label' => __('Texte', 'xsa'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Élément de liste', 'text-domain'),
            ]
        );
        $repeater->add_control(
            'list_url',
            [
                'label' =>  __('url', 'xsa'),
                'type'  => Controls_Manager::TEXT,
                'default' => 'https://fr.x-studioapp.com/'
            
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label' => __('Icon', 'xsa'),
                'type'  => Controls_Manager::ICONS,
                'default'=> [
                    'value' => 'fas fa-chevron-right',
                         'value' => 'fas fa-check',
                         'library' => 'fa-solid',
                ]
                
            ]
        );
        
          $repeater->add_control(
            'list_description',
            [
                'label'     => __('Description', 'xsa'),
                'type'      => Controls_Manager::TEXTAREA,
                'default'   => 'description done',
                
            ]
        );

        $this->add_control(
            'custom_list',
            [
                'label' => __('Liste', 'xsa'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_text' => __('Élément 1', 'text-domain'),
                        'list_icon' => [
                            'value' => 'fas fa-chevron-right',
                            'library' => 'fa-solid',
                    
                        ],
                        'list-description' => 'description',
                        'list_url' => 'https://fr.x-studioapp.com/'
                    ]
                ],
                'title_field' => '{{{ list_text }}}',
            ]
        );

      $this->end_controls_section();

      // adding style to title and description and border 

      $this->start_controls_section(
        'xstudioapp_service_list_style',
        [
            'label' => __('title', 'xsa'),
            'tab'  => Controls_Manager::TAB_STYLE
        ]
        );

       $this->add_control(
            'xstudioapp_title_color',
            [
                'label' => __('Couleur du titre', 'xsa'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xstduiaoapp_service_title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'xstudioapp_title_typography',
                'label' => __('Typographie du titre', 'xsa'),
                'selector' => '{{WRAPPER}} .xstduiaoapp_service_title',
                'responsive' => true,
            ]
        );


        $this->add_responsive_control(
                'xstudioapp_title_padding',
                [
                    'label' => __('padding', 'xsa'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .xstduiaoapp_service_title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
                    

       $this->end_controls_section();

       // description title 

        $this->start_controls_section(
        'xstudioapp_service_list_style_description',
            [
                'label' => __('description', 'xsa'),
                'tab'  => Controls_Manager::TAB_STYLE
            ]
        );

       $this->add_control(
            'xstudioapp_service_list_description_color',
            [
                'label' => __('Couleur du titre', 'xsa'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xstduiaoapp_service_list_description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'xstudioapp_service_list_description_typography',
                'label' => __('Typographie du titre', 'xsa'),
                'selector' => '{{WRAPPER}} .xstduiaoapp_service_list_description',
                'responsive' => true,
            ]
        );


        $this->add_responsive_control(
                'xstudioapp_description_padding',
                [
                    'label' => __('padding', 'xsa'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .xstduiaoapp_service_list_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
                    

       $this->end_controls_section();


       //active square 


       $this->start_controls_section(
        'square',
            [
                'label' => 'square',
                'tab'   =>Controls_Manager::TAB_STYLE
            
            ]
        );


        $this->add_control(
            'xstudioapp_servce_list_square',
            [
                'label' => __('background', 'xsa'),
                'type' => Controls_Manager::COLOR,
                'default' => 'red',
                 'selectors' => [

                    '{{WRAPPED}} .xstudioapp_service_list_square' => 'background-color:{{value}}'
                 
                 
                 ]
            ]
                 );


        // adding controls style 


      $this->end_controls_section();


      $this->start_controls_section(
    'xstudioapp_service_style',
    [
        'label' => __('Style du lien', 'xsa'),
        'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
    ]
);

        // Couleur du texte
        $this->add_control(
            'xstudioapp_link_color',
            [
                'label' => __('Couleur du texte', 'xsa'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp_service_list_url a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Couleur de fond
        $this->add_control(
            'xstudioapp_link_bg_color',
            [
                'label' => __('Couleur de fond', 'xsa'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp_service_list_url' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Bordure
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'xstudioapp_link_border',
                'selector' => '{{WRAPPER}} .xstudioapp_service_list_url',
            ]
        );

        // Border-radius
        $this->add_control(
            'xstudioapp_link_border_radius',
            [
                'label' => __('Rayon des bordures', 'xsa'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp_service_list_url' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Width responsive
        $this->add_responsive_control(
            'xstudioapp_link_width',
            [
                'label' => __('Largeur', 'xsa'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 300],
                    '%'  => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp_service_list_url' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Height responsive
        $this->add_responsive_control(
            'xstudioapp_link_height',
            [
                'label' => __('Hauteur', 'xsa'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 300],
                    '%'  => ['min' => 0, 'max' => 100],
                ],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp_service_list_url' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


    }
}