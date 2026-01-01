<?php

namespace XStudioApp\Widgets;
use Elementor\Controls_Manager;
use XStudioApp\WidgetBox\Box;


class XstudioappWhatssap extends Box{

    public function get_name(){
        return "whatssap";

    }

    public function get_icon(){
        return 'fab fa-whatsapp'; // Font Awesome icon
    }


    public function get_categories() {
        return ['x_studioapp_leading'];
    }

    public function get_title(){
        return "whatssap";
    }

    
    public function _register_controls() {

        $this->start_controls_section(  
            'what_section',
            [
                'label' => __('Whatsapp', 'xstudio'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control( 
            'whatsapp_number', 
            [
                'label'       => __('Whatsapp Number', 'xstudio'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('e.g. +33612345678', 'xstudio'),
                'label_block' => true,
            ]
        );

         $this->add_control( 
            'whatsapp_text', 
            [
                'label'       => __('Whatsapp text', 'xstudio'),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __('Hello ', 'xstudio'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // adding style responsive
        $this->start_controls_section(
            'whatssap_style',
            [
                'label'=> 'whatssap ',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'whatssap_icon_size',
            [
                'label'      => __('Whatssap icon ', 'xstudio'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 27,
                ],
                'selectors' => [
                    '{{WRAPPER}}  button.xstudioapp_whatssap_button img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );









        $this->add_responsive_control(
            'whatssap_button_size',
            [
                'label' => __('Button size', 'xstudio'),
                'type' => Controls_Manager::SLIDER, 
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 52,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} button.xstudioapp_whatssap_button' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}', 
                    ' {{WRAPPER}} .xstudioapp_whatssap_pulse '      => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}',
                ],
            ]
        );
         



        $this->end_controls_section();
    }


 

}