<?php
namespace XStudioApp\Widgets;

use Elementor\Controls_Manager;
use XStudioApp\WidgetBox\Box;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;


class Xstudioapp_Advanced_Container extends Box {

    public function get_name() {
        return 'xstudioapp_advanced_container';
    }

    public function get_title() {
        return 'Advanced Container';
    }

    public function get_icon() {
        return 'eicon-section';
    }

    public function get_categories() {
        return ['x_studioapp_leading'];

    }
 protected function register_controls() {
        $this->start_controls_section(
            'xstudioapp_container_section',
            [
                'label' => 'Container Settings',
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'xstudioapp_min_height',
            [
                'label' => 'Min Height',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => ['min' => 0, 'max' => 2000] ],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'xstudioapp_padding',
            [
                'label' => 'Padding',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'xstudioapp_margin',
            [
                'label' => 'Margin',
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_opacity',
            [
                'label' => 'Opacity',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => ['min' => 0, 'max' => 1, 'step' => 0.01] ],
                'default' => [ 'size' => 1 ],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_blur',
            [
                'label' => 'Backdrop Blur',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => ['min' => 0, 'max' => 50] ],
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'backdrop-filter: blur({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_filter_blur',
            [
                'label' => 'Blur',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => ['min' => 0, 'max' => 30] ],
            ]
        );

        $this->add_control(
            'xstudioapp_filter_brightness',
            [
                'label' => 'Brightness',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 0, 'max' => 2, 'step' => 0.01 ] ],
                'default' => [ 'size' => 1 ],
            ]
        );

        $this->add_control(
            'xstudioapp_filter_contrast',
            [
                'label' => 'Contrast',
                'type' => Controls_Manager::SLIDER,
                'range' => [ 'px' => [ 'min' => 0, 'max' => 3, 'step' => 0.01 ] ],
                'default' => [ 'size' => 1 ],
            ]
        );

        $this->add_control(
            'xstudioapp_z_index',
            [
                'label' => 'Z-Index',
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'z-index: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_pointer_events',
            [
                'label' => 'Pointer Events',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'auto' => 'Auto',
                    'none' => 'None',
                ],
                'default' => 'auto',
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'pointer-events: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'xstudioapp_mix_blend_mode',
            [
                'label' => 'Mix Blend Mode',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'normal' => 'Normal',
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'color-burn' => 'Color Burn',
                    'hard-light' => 'Hard Light',
                    'soft-light' => 'Soft Light',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                ],
                'default' => 'normal',
                'selectors' => [
                    '{{WRAPPER}} .xstudioapp-container' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'xstudioapp_background_border_section',
            [
                'label' => 'Background & Border',
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'xstudioapp_background',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .xstudioapp-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'xstudioapp_border',
                'selector' => '{{WRAPPER}} .xstudioapp-container',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'xstudioapp_box_shadow',
                'selector' => '{{WRAPPER}} .xstudioapp-container',
            ]
        );

        $this->end_controls_section();
    }



}
