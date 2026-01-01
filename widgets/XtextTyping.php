<?php 

namespace XStudioApp\Widgets;


use XStudioApp\WidgetBox\Box;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;


class XtextTyping extends Box{

    private $template;
    
    public function get_name(){

        return "x-studioApp-typing";
    }

    public function get_category(){
           return ['x_studioapp_leading'];
    }

    public function get_title(){
        return "Text Typing";
    }

    public function get_icon(){
            return 'eicon-post-list';
    }

    public function get_categories() {
      
        return ['x_studioapp_leading'];
    }




    public function _register_controls()
    {

    // section content 
    // first section content 

    $this->start_controls_section(
        'content_section_1',
        [
            'label' => __('Content', 'xstudio'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'text_to_type',
        [
            'label' => __('Typing Text', 'xstudio'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => 'XstudioApp.com visit our website',
        ]
    );

    $this->add_control(
        'html_tag',
        [
            'label' => __('HTML Tag', 'xstudio'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'p'  => 'Paragraph',
                'div' => 'DIV',
                'span' => 'SPAN',
            ],
        ]
    );

    $this->end_controls_section();

    // end the first content section 
    // Second content section

    $this->start_controls_section(
        'content_section_2',
        [
            'label' => __('Definition', 'studio'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );

    $this->add_control(
        'background_clip',
        [
            'label' => __('Background Clip', 'studio'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'studio'),
            'label_off' => __('No', 'studio'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );

    $this->add_control(
        'active_text_typing',
        [
            'label' => __('Typing Animation', 'studio'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Yes', 'studio'),
            'label_off' => __('No', 'studio'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]
    );

    $this->end_controls_section();

    // end second section 
    // start the style section 

    $this->start_controls_section(
        'style_section',
        [
            'label' => __('Style', 'xstudio'),
            'tab'   => Controls_Manager::TAB_STYLE,
        ]
    );


    $this->add_responsive_control(
        'text_color',
        [
            'label'        => __('Text Color', 'xstudio'),
            'type'         => Controls_Manager::COLOR,
            'default'      => '#0f0',
            'selectors'    => [
                '{{WRAPPER}} .typing-container' => 'color: {{VALUE}}',
            ],
            'condition'=> ['background_clip' => '']
        ]
    );

    // background color clip

    $this->add_responsive_control(
        'background_clip_color_1',
        [
            'label'     => __('first color', 'studio'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#00f0ff',
            'condition' =>['background_clip' => 'yes']
            
        ]
    );
    $this->add_responsive_control(
        'background_clip_color_2',
        [
            'label'     => __('second color', 'studio'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#00f0ff',
            'condition' => ['background_clip' => 'yes']
            
        ]
    );

    $this->add_responsive_control(
        'background_clip_color_3',
        [
            'label'     => __('third color', 'studio'),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#00f0ff',
            'condition' => ['background_clip' => 'yes']
            
        ]
    );


    $this->add_group_control(
        Group_Control_Typography::get_type(),
        [
            'name' => 'typography',
            'selector' => '{{WRAPPER}} .typing-typo',
        ]
    );

    $this->end_controls_section();
}



}