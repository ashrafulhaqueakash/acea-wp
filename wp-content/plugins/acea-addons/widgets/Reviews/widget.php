<?php

/**
 * Acea Reviews Normal Widget.
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
class Acea_Reviews_Loop extends \Elementor\Widget_Base
{
    public function get_name()
    {
        return 'acea-reviews-loop';
    }
    public function get_title()
    {
        return __('Acea Reviews', 'acea-addons');
    }
    public function get_icon()
    {
        return ('eicon-text-area acea-widget-icon');
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
        return ['reviews', 'card'];
    }
    protected function register_controls()
    {
        $this->start_controls_section(
            'acea_reviews_section',
            [
                'label' => __('General', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'reviews_content_options',
            [
                'label' => esc_html__('Category Option', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

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
            'acea_reviews_content',
            [
                'label' => esc_html__('Content', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('Lorem', 'acea-addons'),
                'show_label' => true,
            ]
        );
        // Reviews Card Bottom
        $repeater->add_control(
            'reviews_bottom_options',
            [
                'label' => esc_html__('Category Bottom Option', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_control(
            'acea_reviews_rate_text',
            [
                'label' => esc_html__('Reviews Rate', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('5', 'acea-addons'),
            ]
        );

        $repeater->add_control(
            'acea_reviews_right_text',
            [
                'label' => esc_html__('Reviews Rate Descriptions', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('from over 100 reviews', 'acea-addons'),
            ]
        );
        $this->add_control(
            'reviews_list',
            [
                'label' => esc_html__('Reviews List', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'acea_reviews_title' => esc_html__('Reviews Title', 'acea-addons'),
                        'acea_reviews_content' => esc_html__('Item content. Click the edit button to change this text.', 'acea-addons'),
                    ]
                ],
                'title_field' => '{{{ acea_reviews_title }}}',
            ]
        );
        $this->end_controls_section();
        //Column setting
        $this->start_controls_section(
            'query',
            [
                'label' => __('Column settings', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
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

        $this->start_popover();

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
                    '{{WRAPPER}} .col-xl-4,.col-md-6,.col-sm-12,.col-lg-6,.testimonil_item_gap' => 'padding-right: {{SIZE}}{{UNIT}};padding-left:{{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-6, .single-reviews' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-reviews' => 'margin-bottom: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();

        $this->add_control('per_line_desktop', [
            'label'              => __('Desktop Items', 'acea-addons'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '4',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);
        $this->add_control('per_line_tablet', [
            'label'              => __('Tablet Items', 'acea-addons'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '2',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);
        $this->add_control('per_line_mobile', [
            'label'              => __('Mobile Items', 'acea-addons'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '1',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->end_controls_section();
        //icon style
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Rating', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'icon_style_tabs'
        );
        // hover
        $this->start_controls_tab(
            'tab_icon_normal_color',
            [
                'label' => __('Normal', 'acea'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating_area .active_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rating_area svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rating_area svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_inactive_color',
            [
                'label'     => __('Inactive Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating_area .inactive_color' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rating_area svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rating_area svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'line_icon_color',
            [
                'label'     => __('Line Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rating_area i,
         {{WRAPPER}} .rating_area svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .rating_area svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'fd_addons_position_rating_type',
            [
                'label'       => __('Position Type', 'fd-addons'),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    ''         => __('Default', 'fd-addons'),
                    'static'   => __('Static', 'fd-addons'),
                    'relative' => __('Relative', 'fd-addons'),
                    'absolute' => __('Absolute', 'fd-addons'),
                ],
                'default'     => '',
                'selectors'   => [
                    '{{WRAPPER}} .rating_area' => 'position:{{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'fd_addons_position_rating_top',
            [
                'label'      => __('Top', 'fd-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .rating_area' => 'top:{{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'fd_addons_position_rating_type' => ['relative', 'absolute'],
                ],
            ]
        );
        $this->add_responsive_control(
            'fd_addons_position_rating__right',
            [
                'label'        => __('Right', 'fd-addons'),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => ['px', 'em', '%'],
                'range'        => [
                    'px' => [
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ],
                ],
                'selectors'    => [
                    '{{WRAPPER}} .rating_area' => 'right:{{SIZE}}{{UNIT}};',
                ],
                'condition'    => [
                    'fd_addons_position_rating_type' => ['relative', 'absolute'],
                ],
                'return_value' => '',
            ]
        );
        $this->add_responsive_control(
            'fd_addons_position_rating_bottom',
            array(
                'label'      => __('Bottom', 'fd-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .rating_area' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'fd_addons_position_rating_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'fd_addons_position_rating_left',
            array(
                'label'      => __('Left', 'fd-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .rating_area' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'fd_addons_position_rating_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'fd_addons_position_from_rating_center',
            array(
                'label'       => __('From Center', 'fd-addons'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'fd-addons'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => array('px', 'em', '%'),
                'range'       => array(
                    'px' => array(
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'   => array(
                    '{{WRAPPER}} .rating_area' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition'   => array(
                    'fd_addons_position_rating_type' => array('relative', 'absolute'),
                ),
            )
        );
        $this->add_responsive_control(
            'fd_addons_position_rating_zindex',
            array(
                'label'     => __('Z-Index', 'fd-addons'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .rating_area' => 'z-index:{{VALUE}};',
                ),
            ),
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tab_icon_hover_color',
            [
                'label' => __('Hover', 'acea'),
            ]
        );
        $this->add_control(
            'icon_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews:hover .rating_area i,
        {{WRAPPER}} .single-reviews:hover .rating_area svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .single-reviews:hover .rating_area svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color_line_hover',
            [
                'label'     => __('Hover Line Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews:hover .rating_area i,
        {{WRAPPER}} .single-reviews:hover .rating_area svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .single-reviews:hover .rating_area svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_responsive_control(
            'icon_size',
            [
                'label'          => __('Size', 'acea-addons'),
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
                    '{{WRAPPER}} .rating_area i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .rating_area svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_right_gap',
            [
                'label'          => __('Right Gap', 'acea-addons'),
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
                    '{{WRAPPER}} .rating_area i' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .rating_area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .rating_area' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'label' => esc_html__('Height', 'acea-addons'),
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
                    '{{WRAPPER}} .single-reviews__text' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews__text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dis_color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews:hover .single-reviews__text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .single-reviews__text',
            ]
        );
        $this->add_responsive_control(
            'dis_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'condition' => [
                    'reviews_style' => 'style-three',
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .single-reviews__text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .single-reviews__text' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single-reviews__text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews__text' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single-reviews__text' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    'body.rtl {{WRAPPER}} .single-reviews__text' => 'margin-bottom:{{SIZE}}{{UNIT}} !important;',
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
                    'reviews_style' => 'style-three',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews__text' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Bottom
        $this->start_controls_section(
            'reviews_bottom_section',
            [
                'label' => __('Rating Section', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'reviews_bottom__color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews__bottom .single-reviews__rated' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'reviews_bottom__color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews:hover .single-reviews__bottom .single-reviews__rated' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'reviews_bottom__typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .single-reviews__bottom .single-reviews__rated',
            ]
        );
        $this->add_responsive_control(
            'reviews_bottom__margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews__bottom .single-reviews__rated' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews__bottom .single-reviews__rated' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'reviews_bottom__padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews__bottom .single-reviews__rated' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews__bottom .single-reviews__rated' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Bottom
        $this->start_controls_section(
            'reviews_right_section',
            [
                'label' => __('Rating Descriptions', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'reviews_right__color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews__bottom .single-reviews__des' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'reviews_right__color_hover',
            [
                'label'     => __('Hover Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-reviews:hover .single-reviews__bottom .single-reviews__des' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'reviews_right__typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .single-reviews__bottom .single-reviews__des',
            ]
        );
        $this->add_responsive_control(
            'reviews_right__margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews__bottom .single-reviews__des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews__bottom .single-reviews__des' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'reviews_right__padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews__bottom .single-reviews__des' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews__bottom .single-reviews__des' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Content Box Style
        $this->start_controls_section(
            'content_box_style',
            [
                'label' => __('Content Box', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'content_style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'reviews_content_bg_color',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .single-reviews_box',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'content_reviews_border',
                'selector'  => '{{WRAPPER}} .single-reviews_box',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_reviews_shadow',
                'exclude'  => [
                    'box_shadow_category_',
                ],
                'selector' => '{{WRAPPER}} .single-reviews_box',
            ]
        );

        $this->add_responsive_control(
            'content_box_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews_box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-list' => 'margin: 0 -{{RIGHT}}{{UNIT}} 0 -{{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews_box' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews_box' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // hover
        $this->start_controls_tab(
            'content_bg_color_hover',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_bg_hover',
                'label' => __('Background', 'plugin-domain'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .single-reviews_box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'content_reviews_border_hover',
                'selector'  => '{{WRAPPER}} .single-reviews_box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_reviews_shadow_hover',
                'exclude'  => [
                    'box_shadow_category_',
                ],
                'selector' => '{{WRAPPER}} .single-reviews_box:hover',
            ]
        );
        $this->add_responsive_control(
            'content_border_radius_hover',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews_box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews_box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Box Style
        $this->start_controls_section(
            'box_style',
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
                    '{{WRAPPER}} .single-reviews' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'reviews_bg_color',
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
                'selector' => '{{WRAPPER}} .single-reviews',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'reviews_border',
                'selector'  => '{{WRAPPER}} .single-reviews',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'reviews_shadow',
                'exclude'  => [
                    'box_shadow_category_',
                ],
                'selector' => '{{WRAPPER}} .single-reviews',
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
                    '{{WRAPPER}} .single-reviews' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-list' => 'margin: 0 -{{RIGHT}}{{UNIT}} 0 -{{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single-reviews' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .single-reviews' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .single-reviews:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'reviews_border_hover',
                'selector'  => '{{WRAPPER}} .single-reviews:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'reviews_shadow_hover',
                'exclude'  => [
                    'box_shadow_category_',
                ],
                'selector' => '{{WRAPPER}} .single-reviews:hover',
            ]
        );
        $this->add_responsive_control(
            'border_radius_hover',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-reviews:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .single-reviews:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
            'wrapper_reviews_bg_color',
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
                'selector' => '{{WRAPPER}} .acea-reviews-list',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_reviews_border',
                'selector'  => '{{WRAPPER}} .acea-reviews-list',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_reviews_shadow',
                'exclude'  => [
                    'box_shadow_category_',
                ],
                'selector' => '{{WRAPPER}} .acea-reviews-list',
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
                    '{{WRAPPER}} .acea-reviews-list' => 'text-align: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrapper_box_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-reviews-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-list' => 'margin: 0 -{{RIGHT}}{{UNIT}} 0 -{{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .acea-reviews-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-reviews-list' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                    '{{WRAPPER}} .acea-reviews-list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-reviews-list' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .acea-reviews-list:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_reviews_border_hover',
                'selector'  => '{{WRAPPER}} .acea-reviews-list:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_reviews_shadow_hover',
                'exclude'  => [
                    'box_shadow_category_',
                ],
                'selector' => '{{WRAPPER}} .acea-reviews-list:hover',
            ]
        );
        $this->add_responsive_control(
            'wrapper_border_radius_hover',
            [
                'label'      => __('wrapper_Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-reviews-list:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-reviews-list:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
        $numabr_of_item = !empty($settings['item_per_page']) ? $settings['item_per_page'] : -1;

        //gride class
        $grid_classes_desktop = $settings['per_line_desktop'];
        $grid_classes_tablet = $settings['per_line_tablet'];
        $grid_classes_mobile = $settings['per_line_mobile'];
        $grids = sprintf('col-xl-%s col-md-%s col-%s ', $grid_classes_desktop, $grid_classes_tablet, $grid_classes_mobile);


        // Reviews Content Start
        if ($settings['reviews_list']) :
            echo '<div class="acea-reviews-list">';
            echo ' <div class="row g-0 justify-content-center">';
            foreach ($settings['reviews_list'] as $item) :
                $ratting = $item['rating'];
                // Single Reviews
?>
                <div class="<?php echo $grids; ?>">
                    <div class="single-reviews">
                        <div class="single-reviews_box">
                            <div class="reviews-rating">
                                <?php if (!empty($item['rating_icon'])) : ?>
                                    <div class="rating_area">
                                        <?php for ($i = 0; $i < 5; $i++) :
                                            $class = '';
                                        ?>
                                            <?php if ($ratting > $i) {
                                                $class = "active_color";
                                            } ?>
                                            <span class="inactive_color"><?php Icons_Manager::render_icon($item['rating_icon'], ['class' => $class, 'aria-hidden' => 'true']) ?></span>
                                        <?php endfor; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Content -->
                            <div class="single-reviews__text">
                                <?php echo $item['acea_reviews_content']; ?>
                            </div>
                            <!-- Bottom -->
                            <div class="single-reviews__bottom">
                                <?php
                                if (!empty($item['acea_reviews_rate_text'])) :
                                    echo '<span class="single-reviews__rated">' . 'Rated ' . $item['acea_reviews_rate_text'] . '/5' . ' - ' . '</span>';
                                endif;
                                if (!empty($item['acea_reviews_right_text'])) :
                                    echo '<span class="single-reviews__des">'. ' ' . $item['acea_reviews_right_text'] . '</span>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
<?php

            // End Single Reviews
            endforeach;
        endif;
        echo '</div>';
        echo '</div>';
        // Reviews Content End
    }
}
$widgets_manager->register_widget_type(new \Acea_Reviews_Loop());
