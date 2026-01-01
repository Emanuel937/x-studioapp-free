<?php
namespace XStudioApp\Widgets;


use Elementor\Controls_Manager;
use Elementor\Repeater;
use XStudioApp\WidgetBox\Box;
use Elementor\Group_Control_Typography;


class XstudioappTestimonials extends Box {


    public function get_name() {
        return 'xstudioapp_testimonials';
    }

    public function get_title() {
        return 'Témoignages Stylés';
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];
    }

/*  public function get_style_depends() {
        return ['xstudioapp-testimonial-style'];
    }

*/
    

    private function setStyle()
{
    // === NAME STYLE ===
    $this->start_controls_section('xstudioapp_name_style', [
        'label' => __('Name Style', 'xstudioapp'),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]);

    $this->add_control('name_color', [
        'label' => __('Color', 'xstudioapp'),
        'type' => Controls_Manager::COLOR,
        'default'=> 'black',
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-name' => 'color: {{VALUE}};',
        ],
    ]);

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'name_typography',
            'label' => __('Typography', 'xstudioapp'),
            'selector' => '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-name',
            
        ]
    );

    $this->add_responsive_control('name_text_align', [
        'label' => __('Text Align', 'xstudioapp'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => [
                'title' => __('Left', 'xstudioapp'),
                'icon' => 'eicon-text-align-left',
            ],
            'center' => [
                'title' => __('Center', 'xstudioapp'),
                'icon' => 'eicon-text-align-center',
            ],
            'right' => [
                'title' => __('Right', 'xstudioapp'),
                'icon' => 'eicon-text-align-right',
            ],
        ],
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-name' => 'text-align: {{VALUE}};',
        ],
    ]);

    $this->add_responsive_control('name_padding', [
        'label' => __('Padding', 'xstudioapp'),
        'type' => Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->add_responsive_control('name_margin', [
        'label' => __('Margin', 'xstudioapp'),
        'type' => Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->end_controls_section();

    // === DESIGNATION STYLE ===
    $this->start_controls_section(
    
        'xstudioapp_testemonial_images',
    [
        'label' => 'Image',
        'tab'  => Controls_Manager::TAB_STYLE
    ] );

    $this->add_responsive_control('x_studioapp_testemonial_images_with',

        [
            'label' => 'width',
            'type'  => Controls_Manager::SLIDER,
            'size_units' =>['px', '%', 'em', 'rem'],
            'default' => "100%",
            'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-container .-xstudioapp-widget-image-container' => 'width: {{SIZE}}{{UNIT}};',
        ],
            'default' => [
            'unit' => '%',
            'size' => 100,
        ],
           
        ]
    
        );

    
    $this->add_responsive_control('x_studioapp_testemonial_images_height',

        [
            'label' => 'heigth',
            'type'  => Controls_Manager::SLIDER,
            'size_units' =>['px', '%', 'em', 'rem'],
            'default' => [
                    'unit' => 'rem',
                    'size' => 24,
                ],
              'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-container .-xstudioapp-widget-image-container' => 'height: {{SIZE}}{{UNIT}};',
        ],
           
        ]
    
        );

    $this->add_responsive_control('x_studioapp_testemonial_images_border_radius',

        [
            'label' => 'border radius',
            'type'  => Controls_Manager::DIMENSIONS,
            'size_units' =>['px', '%', 'em'],
            'selectors' => [
            '{{WRAPPER}} .your-image-class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
        ]
    
        );

    $this->end_controls_section();



    $this->start_controls_section('xstudioapp_designation_style', [
        'label' => __('Designation Style', 'xstudioapp'),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]);



    $this->add_responsive_control('designation_color', [
        'label' => __('Color', 'xstudioapp'),
        'type' => Controls_Manager::COLOR,
           'default'=> 'black',
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-designation' => 'color: {{VALUE}};',
        ],
    ]);

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'designation_typography',
            'label' => __('Typography', 'xstudioapp'),
            'selector' => '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-designation',
        ]
    );

    $this->add_responsive_control('designation_text_align', [
        'label' => __('Text Align', 'xstudioapp'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => ['title' => __('Left', 'xstudioapp'), 'icon' => 'eicon-text-align-left'],
            'center' => ['title' => __('Center', 'xstudioapp'), 'icon' => 'eicon-text-align-center'],
            'right' => ['title' => __('Right', 'xstudioapp'), 'icon' => 'eicon-text-align-right'],
        ],
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-designation' => 'text-align: {{VALUE}};',
        ],
    ]);

    $this->add_responsive_control('designation_padding', [
        'label' => __('Padding', 'xstudioapp'),
        'type' => Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->add_responsive_control('designation_margin', [
        'label' => __('Margin', 'xstudioapp'),
        'type' => Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->end_controls_section();

    // === QUOTE STYLE ===
    $this->start_controls_section('xstudioapp_quote_style', [
        'label' => __('Quote Style', 'xstudioapp'),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]);

    $this->add_control('quote_color', [
        'label' => __('Color', 'xstudioapp'),
        'type' => Controls_Manager::COLOR,
        'default'=> 'black',
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-quote' => 'color: {{VALUE}};',
        ],
    ]);

    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'quote_typography',
            'label' => __('Typography', 'xstudioapp'),
            'selector' => '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-quote',
        ]
    );

    $this->add_responsive_control('quote_text_align', [
        'label' => __('Text Align', 'xstudioapp'),
        'type' => Controls_Manager::CHOOSE,
        'options' => [
            'left' => ['title' => __('Left', 'xstudioapp'), 'icon' => 'eicon-text-align-left'],
            'center' => ['title' => __('Center', 'xstudioapp'), 'icon' => 'eicon-text-align-center'],
            'right' => ['title' => __('Right', 'xstudioapp'), 'icon' => 'eicon-text-align-right'],
        ],
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-quote' => 'text-align: {{VALUE}};',
        ],
    ]);

    $this->add_responsive_control('quote_padding', [
        'label' => __('Padding', 'xstudioapp'),
        'type' => Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-quote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->add_responsive_control('quote_margin', [
        'label' => __('Margin', 'xstudioapp'),
        'type' => Controls_Manager::DIMENSIONS,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-quote' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
    ]);

    $this->end_controls_section();

    // === BUTTON STYLE ===
    $this->start_controls_section('xstudioapp_button_style', [
        'label' => __('Arrow Buttons Style', 'xstudioapp'),
        'tab'   => Controls_Manager::TAB_STYLE,
    ]);

    $this->add_control('button_text_color', [
        'label' => __('Text Color', 'xstudioapp'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-arrow-button' => 'color: {{VALUE}};',
        ],
    ]);

    $this->add_control('button_bg_color', [
        'label' => __('Background Color', 'xstudioapp'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
            '{{WRAPPER}} .-xstudioapp-widget-testimonial-container .-xstudioapp-widget-arrow-button' => 'background-color: {{VALUE}};',
        ],
    ]);

    $this->add_control('prev_icon', [
        'label' => __('Previous Button Icon', 'xstudioapp'),
        'type' => Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-chevron-left',
            'library' => 'fa-solid',
        ],
    ]);

    $this->add_control('next_icon', [
        'label' => __('Next Button Icon', 'xstudioapp'),
        'type' => Controls_Manager::ICONS,
        'default' => [
            'value' => 'fas fa-chevron-right',
            'library' => 'fa-solid',
        ],
    ]);

    $this->end_controls_section();
}




    protected function register_controls() {
     

        $this->start_controls_section('section_testimonials', [
            'label' => 'Témoignages',
        ]);

        $repeater = new Repeater();

        $repeater->add_control('image', [
            'label' => 'Photo',
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => 'https://fr.x-studioapp.com/wp-content/uploads/2025/07/stunning-8166666_1280.jpg',
            ],
        ]);

        $repeater->add_control('name', [
            'label' => 'Nom',
            'type' => Controls_Manager::TEXT,
            'default' => 'John Doe',
        ]);

        $repeater->add_control('designation',[
            'label' => 'designation',
            'type'  => Controls_Manager::TEXT,
            'default' => 'CEO'
        ]);

        $repeater->add_control('text', [
            'label' => 'Témoignage',
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'X-studioApp est une agence qui fait grampir votre chiffre daffaire',
        ]);

        
            $repeater->add_control('notation', [
                'label' => 'Note (étoiles)',
                'type' => Controls_Manager::SLIDER,
                'size_units' => [], 
                'range' => [
                    'px' => [ // "px" key
                        'min' => 1,
                        'max' => 5,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 5,
                ],
            ]);

        $this->add_control('testimonials', [
            'label' => 'Liste des témoignages',
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'default' => [
                [
                    'name' => 'Peter Lee',
                    'text' => 'Their food is really healthy and it tastes great, which is why I recommend this company to all my friends!',
                    'image' => ['url' => 'https://fr.x-studioapp.com/wp-content/uploads/2025/07/stunning-8166666_1280.jpg'],
                ],
                [
                    'name' => 'Sarah Smith',
                    'text' => 'Fast delivery and great quality food. I love it!',
                    'image' => ['url' => 'https://fr.x-studioapp.com/wp-content/uploads/2025/07/stunning-8166666_1280.jpg'],
                ],
                [
                    'name' => 'Tom Wilson',
                    'text' => 'Excellent service and friendly staff!',
                    'image' => ['url' => 'https://fr.x-studioapp.com/wp-content/uploads/2025/07/stunning-8166666_1280.jpg'],
                ],
            ],
        ]);

        $this->end_controls_section();


        // adding style controls 

        $this->setStyle();
    }

}
