<?php

/**
 * Acea Testimonial Normal Widget.
 *
 *
 * @since 1.0.0
 */

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit;
}
// If this file is called directly, abort.
class Acea_Testimonail_v2_Loop extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'acea-testimonial-v2-loop';
    }
    public function get_title()
    {
        return __('Acea Testimonial Loop', 'acea-addons');
    }
    public function get_icon()
    {
        return ('eicon-testimonial acea-widget-icon');
    }
    public function get_categories()
    {
        return ['acea-addons'];
    }
    public function get_script_depends()
    {
        return ['acea-addon'];
    }
    public function get_style_depends()
    {
        return ['owl-carousel', 'acea-addons'];
    }
    public function get_keywords()
    {
        return ['team', 'card', 'testimonial', 'membar', 'reviw', 'rating'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'acea_testimonial_section',
            [
                'label' => __('General', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'testimonial_style',
            [
                'label'             => __('Testimonial Style', 'acea-addons'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'style-one',
                'options'           => [
                    'style-one'    =>   __('Style 01',     'acea-addons'),

                ],
                // 'separator' => 'after',
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        ?>

      

        <?php
       
    }
}
$widgets_manager->register_widget_type(new \Acea_Testimonail_v2_Loop());
