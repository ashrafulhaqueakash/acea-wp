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
class Acea_Testimonail_v3_Loop extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'acea-testimonial-v3-loop';
    }
    public function get_title()
    {
        return __('Acea Testimonial V3', 'acea-addons');
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
                    'style-two'    =>   __('Style 02',     'acea-addons'),
                    'style-three'    =>   __('Style 03',     'acea-addons'),
                    'style-four'    =>   __('Style 04',     'acea-addons'),

                ],
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'layout_gap',
            [
                'label' => __('Item Gap', 'acea-addons'),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('Default', 'acea-addons'),
                'label_on' => __('Custom', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );


        $this->add_responsive_control(
            'item_gap_right',
            [
                'label'          => __('Gap Right', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__single' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-testimonial' => 'margin-right: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_gap_bottom',
            [
                'label'          => __('Gap Bottom', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px'],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-6, .acea-testimonial__single' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-testimonial' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'acea-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-addons'),
                'label_off' => __('No', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'show_quotes',
            [
                'label' => __('Show Quotes', 'acea-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-addons'),
                'label_off' => __('No', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'quotes_icon',
            [
                'label' => __('Quotes Icon', 'acea-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-quote-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'show_quotes' => 'yes',
                ],
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'enable_rating_icon',
            [
                'label' => __('Enable Rating Icon', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );


        $repeater->add_control(
            'rating_icon',
            [
                'label' => __('Rating Icon', 'acea-addons'),
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ],
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],

            ]
        );
        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Testimonial Rating', 'rating_icon'),
                'type' => Controls_Manager::SELECT,
                'default' => '5',
                'options'   => [
                    '5'     => esc_html__('5', 'rating_icon'),
                    '4'     => esc_html__('4', 'rating_icon'),
                    '3'     => esc_html__('3', 'rating_icon'),
                    '2'     => esc_html__('2', 'rating_icon'),
                    '1'     => esc_html__('1', 'rating_icon'),
                ],
                'label_block' => true,
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ]

            ]
        );
        $repeater->add_control(
            'rating_text',
            [
                'label' => esc_html__('Testimonial Text Rating', 'elementor'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.5,
                    ],
                ],
                'condition' => [
                    'enable_rating_icon' => 'yes'
                ]
            ]
        );
        $repeater->add_control(
            'enable_qoute_text',
            [
                'label' => __('Show Qoute', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'acea_qoute_text',
            [
                'label' => esc_html__('Qoute Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lorem', 'plugin-name'),
                'show_label' => true,
                'condition' => [
                    'enable_qoute_text' => 'yes'
                ]

            ]
        );

        $repeater->add_control(
            'acea_testimonial_name',
            [
                'label' => esc_html__('Name', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lorem', 'plugin-name'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'acea_testimonial_position',
            [
                'label' => esc_html__('Positions', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Lorem', 'plugin-name'),
                'show_label' => true,
            ]
        );

        $repeater->add_control(
            'acea_testimonial_content',
            [
                'label' => esc_html__('Content', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem', 'plugin-name'),
                'show_label' => true,
            ]
        );
        $repeater->add_control(
            'enable_image_test',
            [
                'label' => __('Enable Image', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $repeater->add_control(
            'acea_testimonial_user_img',
            [
                'label' => esc_html__('Add User Images', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [],
                'condition' => [
                    'enable_image_test' => 'yes',
                ]

            ]
        );
        $this->add_control(
            'testimonial_list',
            [
                'label' => esc_html__('Testimonial List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'acea_testimonial_name' => esc_html__('Name', 'plugin-name'),
                        'acea_testimonial_content' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
                    ]
                ],
                'title_field' => '{{{ acea_testimonial_name }}}',
            ]
        );
        $this->end_controls_section();
        //Column settings
        $this->start_controls_section(
            'query',
            [
                'label' => __('Column Settings', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'acea-addons'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '4',
            'tablet_default'     => '6',
            'tablet_extra'     => '6',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->end_controls_section();

        //Slider Setting
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Settings', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_slider_settings' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'acea-addons'),
                'type' => Controls_Manager::SELECT,
                'default'            => 4,
                'tablet_default'     => 2,
                'mobile_default'     => 1,
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons'),
                'label_off' => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'acea-addons'),
                    '2000'  => __('2 Second', 'acea-addons'),
                    '3000'  => __('3 Second', 'acea-addons'),
                    '4000'  => __('4 Second', 'acea-addons'),
                    '5000'  => __('5 Second', 'acea-addons'),
                    '6000'  => __('6 Second', 'acea-addons'),
                    '7000'  => __('7 Second', 'acea-addons'),
                    '8000'  => __('8 Second', 'acea-addons'),
                    '9000'  => __('9 Second', 'acea-addons'),
                    '10000' => __('10 Second', 'acea-addons'),
                    '11000' => __('11 Second', 'acea-addons'),
                    '12000' => __('12 Second', 'acea-addons'),
                    '13000' => __('13 Second', 'acea-addons'),
                    '14000' => __('14 Second', 'acea-addons'),
                    '15000' => __('15 Second', 'acea-addons'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'acea'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __('Next Icon', 'acea'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();

        //Image
        $this->start_controls_section(
            'image_style',
            [
                'label' => __('Image', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__img img' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', '%', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__img img' => 'max-width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'unit' => 'px',
                ],
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__img img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'acea-addons'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'acea-addons'),
                    'fill'    => __('Fill', 'acea-addons'),
                    'cover'   => __('Cover', 'acea-addons'),
                    'contain' => __('Contain', 'acea-addons'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__img img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .acea-testimonial__img img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .acea-testimonial__img img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}} !important;;',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testimonial__img img',
            ]
        );
        $this->end_controls_section();


        // Name
        $this->start_controls_section(
            'tn_name',
            [
                'label' => __('Name', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'name_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'name_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__single:hover .acea-testimonial__name' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea-testimonial__name',
            ]
        );
        $this->add_responsive_control(
            'name_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__name' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Title
        $this->start_controls_section(
            'tn_position',
            [
                'label' => __('Designation', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tn_position_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__position' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tn_position_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__single:hover .acea-testimonial__position' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'tn_position_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea-testimonial__position',
            ]
        );
        $this->add_responsive_control(
            'tn_position_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__position' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__position' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tn_position_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__position' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__position' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        
        $this->start_controls_section(
            ' user_identity',
            [
                'label' => __('User Identity', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-two',
                ],
            ]
        );
        $this->add_control(
			'alignment_user_identity',
			[
				'label' => esc_html__( 'Alignment', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'plugin-name' ),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'plugin-name' ),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'plugin-name' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__meta-content' => 'justify-content: {{VALUE}};',
                ],
				'toggle' => true,
			]
		);
        $this->add_control(
			'textalign_user_identity',
			[
				'label' => esc_html__( 'Text Align', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'plugin-name' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'plugin-name' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'plugin-name' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__meta-content' => ' text-align: {{VALUE}};',
                ],
				'toggle' => true,
			]
		);
        $this->add_responsive_control(
            'user_gap',
            [
                'label'      => __('Gap', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px','%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__meta-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->end_controls_section();
        // Discription
        $this->start_controls_section(
            'discription',
            [
                'label' => __('Discription', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'description_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__decription' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__decription' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dis_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tn-single:hover .acea-testimonial__decription' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea-testimonial__decription',
            ]
        );
        $this->add_responsive_control(
            'dis_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'testimonial_style' => 'style-three',
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-testimonial__decription' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .acea-testimonial__decription' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__decription' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__decription' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_bottom_gap',
            [
                'label'      => __('Bottom Gap', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__decription' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .acea-testimonial__decription' => 'margin-bottom:{{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'dis_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'condition' => [
                    'testimonial_style' => 'style-three',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__decription' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__decription' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Quotes Text
        $this->start_controls_section(
            'acea_quotes_text',
            [
                'label' => __('Quotes Text', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quotes_text' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'acea_quotes_text_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tn-quotes-text p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'acea_quotes_text_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tn-single:hover .acea--tn-quotes-text p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'acea_quotes_text_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea--tn-quotes-text p',
            ]
        );
        $this->add_responsive_control(
            'acea_quotes_text_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .acea--tn-quotes-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .acea--tn-quotes-text' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_quotes_text_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tn-quotes-text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tn-quotes-text p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_quotes_text_bottom_gap',
            [
                'label'      => __('Bottom Gap', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tn-quotes-text' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .acea--tn-quotes-text' => 'margin-bottom:{{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_quotes_text_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tn-quotes-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tn-quotes-text' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //qoute
        $this->start_controls_section(
            'qoute_style',
            [
                'label' => __('Quote Icon', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quotes' => 'yes',
                ]
            ]
        );
        $this->start_controls_tabs(
            'qoute_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'tab_qoute_normal_color',
            [
                'label' => __('Normal', 'acea'),
            ]
        );
        $this->add_control(
            'qoute_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__quotes-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-testimonial__quotes-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-testimonial__quotes-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'line_qoute_color',
            [
                'label'     => __('Line Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__quotes-icon i,
                 {{WRAPPER}} .acea-testimonial__quotes-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-testimonial__quotes-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'qoute_bg_color',
            [
                'label'     => __('Background Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .acea-testimonial__quotes-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'qoute_hover_color',
            [
                'label' => __('Hover', 'acea'),
            ]
        );
        $this->add_control(
            'qoute_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tn-single:hover .acea-testimonial__quotes-icon i,
                {{WRAPPER}} .acea--tn-single:hover .acea-testimonial__quotes-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea--tn-single:hover .acea-testimonial__quotes-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'qoute_bg_color_hover',
            [
                'label'     => __('Background Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .acea-testimonial__qoute' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'qoute_color_line_hover',
            [
                'label'     => __('Hover Line Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .acea--tn-single:hover .acea-testimonial__quotes-icon i,
                {{WRAPPER}} .acea--tn-single:hover .acea-testimonial__quotes-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea--tn-single:hover .acea-testimonial__quotes-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'qoute_size',
            [
                'label'          => __('Font Size', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__quotes-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-testimonial__quotes-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'qoute_box_size',
            [
                'label'          => __('Quote Box Size', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__qoute' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'qoute_border',
                'selector'  => '{{WRAPPER}} .acea-testimonial__qoute',
            ]
        );
        $this->add_responsive_control(
            'qoute_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__qoute' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__qoute' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'qoute_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__qoute' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__qoute' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'popover-toggle-qoute',
            [
                'label'        => __('Qoute Positions', 'acea-addons'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __('Default', 'acea-addons'),
                'label_on'     => __('Custom', 'acea-addons'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        $this->add_responsive_control(
            'qoute_icon_position_type',
            array(
                'label' => __('Position Type', 'acea-addons'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    '' => __('Default', 'acea-addons'),
                    'static' => __('Static', 'acea-addons'),
                    'relative' => __('Relative', 'acea-addons'),
                    'absolute' => __('Absolute', 'acea-addons'),
                ),
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} .acea-testimonial__quotes-icon' => 'position:{{VALUE}};',
                ),
            )
        );
        $this->add_responsive_control(
            'qoute_icon_position_top',
            array(
                'label' => __('Top', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .acea-testimonial__quotes-icon' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'qoute_icon_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'qoute_icon_position_right',
            array(
                'label' => __('Right', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .acea-testimonial__quotes-icon' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'qoute_icon_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $this->add_responsive_control(
            'qoute_icon_position_bottom',
            array(
                'label' => __('Bottom', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .acea-testimonial__quotes-icon' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'qoute_icon_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'qoute_icon_position_left',
            array(
                'label' => __('Left', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -2000,
                        'max' => 2000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .acea-testimonial__quotes-icon' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'qoute_icon_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'qoute_icon_position_from_center',
            array(
                'label' => __('From Center', 'acea-addons'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range' => array(
                    'px' => array(
                        'min' => -1000,
                        'max' => 1000,
                        'step' => 1,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min' => -150,
                        'max' => 150,
                        'step' => 1,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .acea-testimonial__quotes-icon' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition' => array(
                    'qoute_icon_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->end_popover();
        $this->end_controls_section();

        // Rating star

        $this->start_controls_section(
            'rating_style',
            [
                'label' => __('Rating Icon', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rating_text_size',
                'selector' => '{{WRAPPER}} .acea-testimonial__rating-text',
                'condition' => [
                    'testimonial_style' => 'style-four',
                ],
            ]
        );

        $this->add_control(
            'rating_text_color',
            [
                'label'     => __('Rating Text Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'testimonial_style' => 'style-four',
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__rating-text' => 'color: {{VALUE}}'
                ],
            ]
        );
        $this->add_control(
            'rating_active_color',
            [
                'label'     => __('Active Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__single i.active_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-testimonial__single svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'rating_inactive_color',
            [
                'label'     => __('Inactive Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__single span.inactive_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-testimonial__single span.inactive_color svg' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'star_rating_size',
            [
                'label'          => __('Rating Size', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial__single span i' => 'font-size: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-testimonial__single span svg' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
        //Box Style
        $this->start_controls_section(
            'ts_style',
            [
                'label' => __('Box', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'box_height',
            [
                'label' => esc_html__('Box Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__single' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'tn_bg_color',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .acea-testimonial__single',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border',
                'selector'  => '{{WRAPPER}} .acea-testimonial__single',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testimonial__single',
            ]
        );
        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'acea-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'acea-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__single' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_align',
            [
                'label' => __('Content Box Alignment', 'acea-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'acea-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'acea-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'acea-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial__bottom-meta' => 'justify-content: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__single' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__single' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__single' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'bg_color_hover',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .acea-testimonial__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'tn_border_hover',
                'selector'  => '{{WRAPPER}} .acea-testimonial__single:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testimonial__single:hover',
            ]
        );
        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial__single:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
   *
    Dots
   */
        $this->start_controls_section(
            'dots_navigation',
            [
                'label' => __('Navigation - Dots', 'acea-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_dots');

        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_align',
            [
                'label' => __('Alignment', 'acea-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __('Left', 'acea-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'acea-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'acea-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'dots_box_width',
            [
                'label' => __('Width', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_box_height',
            [
                'label' => __('Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'          => __('Gap Right', 'acea-addons'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_min_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .testimonial-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __('Active', 'acea-addons'),
            ]
        );
        $this->add_control(
            'dots_color_active',
            [
                'label' => __('Active Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_width',
            [
                'label' => __('Width', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_dots_box_active_height',
            [
                'label' => __('Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        /*
   *
    Arrows
   */
        $this->start_controls_section(
            'arrows_navigation',
            [
                'label' => __('Navigation - Arrow', 'acea-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('_tabs_arrow');

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __('Arrow Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_fill',
            [
                'label' => __('Arrow Line Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .acea-testimonial-slider-arrow button ',
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => __('Position', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'acea-addons'),
                'label_on' => __('Custom', 'acea-addons'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        /*
Arrow Position
*/
        $start = is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');
        $end = !is_rtl() ? __('Right', 'elementor') : __('Left', 'elementor');

        /* tobol */
        $this->add_control(
            'offset_orientation_v',
            [
                'label' => __('Vertical Orientation', 'elementor'),
                'type' => Controls_Manager::CHOOSE,
                'toggle' => false,
                'default' => 'start',
                'options' => [
                    'top' => [
                        'title' => __('Top', 'elementor'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'elementor'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'render_type' => 'ui',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow' => '{{VALUE}}: 0;',
                ],

            ]
        );

        $this->add_responsive_control(
            'arrow_position_top',
            [
                'label' => __('Vertical', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'top',
                ],
            ]
        );


        $this->add_responsive_control(
            'arrow_position_bottom',
            [
                'label' => __('Vertical', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'bottom',
                ],
            ]
        );


        $this->add_control(
            'arrow_horizontal_position',
            [
                'label'             => __('Horizontal Position', 'acea-addons'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'    =>   __('Default',    'acea-addons'),
                    'space_between'    =>   __('Space Between',    'acea-addons'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'arrow_position_x_prev',
            [
                'label' => __('Horizontal Prev', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-testimonial-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],

            ]
        );



        // default == arrow gap
        // space-between == left position, right position

        $this->add_responsive_control(
            'arrow_position_right',
            [
                'label' => __('Horizontal Next', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'space_between',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_gap_',
            [
                'label' => __('Arrow Gap', 'happy-elementor-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'max' => 1000,
                    ],
                    '%' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .prev' => 'margin-right: {{SIZE}}{{UNIT}} !important; position: relative !important',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .next ' => 'margin-right: 0 !important; position: relative !important',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->add_responsive_control(
            'align_arrow',
            [
                'label' => __('Alignment', 'acea-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'acea-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'arrow_horizontal_position' => 'default',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-testimonial-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .acea-testimonial-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Size', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]

        );

        $this->add_responsive_control(
            'arrow_size_line_height',
            [
                'label' => __('Line Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]

        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_border',
                'label'    => __('Button border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-testimonial-slider-arrow button',
            ]
        );

        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover ' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover path' => 'fill: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_hover_border',
                'label'    => __('Button border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover',
            ]
        );

        $this->add_responsive_control(
            'arrows_hover_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial-slider-arrow button:hover ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_active',
            [
                'label' => __('Active', 'acea-addons'),
            ]
        );

        $this->add_control(
            'arrow_active_color',
            [
                'label' => __('Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_active_fill_color',
            [
                'label' => __('Line Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active' => 'color: {{VALUE}} !important;;',
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active path' => 'fill: {{VALUE}} !important;;',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_active_color',
            [
                'label' => __('Background Color Hover', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'btn_active_border',
                'label'    => __('Button border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active button',
            ]
        );

        $this->add_responsive_control(
            'arrows_active_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial-slider-arrow .slick-active button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial-slider-arrow .slick-active button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();


        $this->end_controls_tabs();

        $this->end_controls_section();




        //Wrapper Style
        $this->start_controls_section(
            'bottom_ts_style',
            [
                'label' => __('Box Bottom', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => 'style-four',
                ],
            ]
        );
        $this->start_controls_tabs(
            'bottom_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'bottom_tn_bg_color',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .acea-testmonial-bottom',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'bottom_tn_border',
                'selector'  => '{{WRAPPER}} .acea-testmonial-bottom',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'bottom_tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testmonial-bottom',
            ]
        );
        $this->add_responsive_control(
            'bottom_align',
            [
                'label' => __('Alignment', 'acea-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'acea-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testmonial-bottom' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'bottom_box_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testmonial-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testmonial-bottom' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'bottom_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testmonial-bottom' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testmonial-bottom' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'bottom_bg_color_hover',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bottom_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .acea-testmonial-bottom:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'bottom_tn_border_hover',
                'selector'  => '{{WRAPPER}} .acea-testmonial-bottom:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'bottom_tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testmonial-bottom:hover',
            ]
        );
        $this->add_responsive_control(
            'bottom_border_radius_hover',
            [
                'label'      => __('bottom_Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testmonial-bottom:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testmonial-bottom:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();








        //Wrapper Style
        $this->start_controls_section(
            'wrapper_ts_style',
            [
                'label' => __('Wrapper', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'wrapper_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'wrapper_tn_bg_color',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .acea-testimonial',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_tn_border',
                'selector'  => '{{WRAPPER}} .acea-testimonial',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_tn_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testimonial',
            ]
        );
        $this->add_responsive_control(
            'wrapper_align',
            [
                'label' => __('Alignment', 'acea-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'acea-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-testimonial' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_box_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'wrapper_bg_color_hover',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wrapper_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .acea-testimonial:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_tn_border_hover',
                'selector'  => '{{WRAPPER}} .acea-testimonial:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_tn_shadow_hover',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-testimonial:hover',
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius_hover',
            [
                'label'      => __('wrapper_Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-testimonial:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $testimonial_style = $settings['testimonial_style'];

        $slider_extraSetting = array(
            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);
        if (('yes' == $settings['show_slider_settings'])) {
            $this->add_render_attribute('testimonail_version', 'class', array('acea-testimonial-v3-slider', 't-style'));
            $this->add_render_attribute('testimonail_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('testimonail_version', 'class', array($testimonial_style, 'row g-0 justify-content-center'));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('tn_classes', 'class', [$grid_classes, 'col-lg-6']);
        }

?>


        <?php
        if ($settings['testimonial_list']) {

        ?>
            <div class="acea-testimonial">
                <div <?php echo $this->get_render_attribute_string('testimonail_version'); ?>>
                    <?php
                    foreach ($settings['testimonial_list'] as $item) {
                        $ratting = $item['rating'];
                    ?>
                        <!-- Single Slider -->

                        <div <?php echo $this->get_render_attribute_string('tn_classes'); ?>>

                            <?php if ($testimonial_style) {
                                include('content/' . $testimonial_style . '.php');
                            } ?>
                        </div>

                <?php
                    }
                }
                echo '</div>';
                echo '</div>';
                ?>
                <?php if ('yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']) : ?>
                    <div class="acea-testimonial-slider-arrow">
                        <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                            <button type="button" class="slick-prev prev slick-arrow slick-active">
                                <?php Icons_Manager::render_icon($settings['arrow_prev_icon'], ['aria-hidden' => 'true']); ?>
                            </button>
                        <?php endif; ?>
                        <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                            <button type="button" class="slick-next next slick-arrow ">
                                <?php Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                            </button>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
        <?php
    }
}
$widgets_manager->register_widget_type(new \Acea_Testimonail_v3_Loop());
