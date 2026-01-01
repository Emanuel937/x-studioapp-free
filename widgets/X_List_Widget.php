<?php
namespace XStudioApp\Widgets;

use XStudioApp\WidgetBox\Box;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class X_List_Widget extends Box {

    public function get_name() {
        return 'x_list_widget';
    }

    public function get_title() {
        return 'X List Widget';
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
                'label' => 'ContenuTest',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => 'Image',
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => 'https://via.placeholder.com/80',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => 'Titre',
                'type' => Controls_Manager::TEXT,
                'default' => 'Titre du contenu',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => 'Description',
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'La description du contenu vient ici.',
            ]
        );

        $this->end_controls_section();


    

  
        // Section: Container Style
        $this->start_controls_section(
            'style_section',
            [
                'label' => 'Style du Conteneur',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'background_color',
            [
                'label' => 'Couleur de fond',
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .x-list-type' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'padding',
            [
                'label' => 'Padding',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'default' => [ 'size' => 16 ],
                'selectors' => [
                    '{{WRAPPER}} .x-list-type' => 'padding: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => 'Bordure arrondie',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
                'default' => [ 'size' => 12 ],
                'selectors' => [
                    '{{WRAPPER}} .x-list-type' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Section: Title Style
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => 'Style du Titre',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => 'Couleur du titre',
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .x-list-type h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .x-list-type h3',
            ]
        );

        $this->end_controls_section();

        // Section: Description Style
        $this->start_controls_section(
            'description_style_section',
            [
                'label' => 'Style de la Description',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => 'Couleur de la description',
                'type' => Controls_Manager::COLOR,
                'default' => '#555555',
                'selectors' => [
                    '{{WRAPPER}} .x-list-type p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .x-list-type p',
            ]
        );

        $this->end_controls_section();
    }
/*
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="x-list-type" style="display:flex; gap:16px; align-items:flex-start;">
            <div>
                <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="" style="width:80px; height:80px; object-fit:cover; border-radius:8px;">
            </div>
            <div>
                <h3><?php echo esc_html($settings['title']); ?></h3>
                <p><?php echo esc_html($settings['description']); ?></p>
            </div>
        </div>
        <?php
    }*/
}
