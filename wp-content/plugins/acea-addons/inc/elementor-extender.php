<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
// Add Alignment Feature on counter
add_action('elementor/element/counter/section_title/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Acea Extra', 'acea-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'counter_align',
        [
            'label' => __('Counter Alignment', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
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
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper ' => 'text-align: {{VALUE}}; display: block;',
            ],
        ]
    );
    $element->add_responsive_control(
        'title_align',
        [
            'label' => __('Title Alignment', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'justify' => [
                    'title' => __('Justified', 'acea-addons'),
                    'icon' => 'eicon-text-align-justify',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-title ' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'counter_gap',
        [
            'label' => __('Counter Gap', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-counter .elementor-counter-number-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add select dropdown control to button widget
add_action('elementor/element/image-box/section_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Acea Extra', 'acea-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'img_hover_scale',
        [
            'label' => __('Image Hover Scale', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'min' => 0,
            'max' => 100,
            'step' => 0.1,
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-img:hover' => 'transform: scale({{VALUE}});',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'image_hover_shadow',
            'label' => __('Image Hover Shadow', 'acea-addons'),
            'selector' => '{{WRAPPER}}:hover .elementor-image-box-img',
        ]
    );

    $element->add_responsive_control(
        'title_padding',
        [
            'label' => __('Content Padding', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'image_box_border',
            'label' => __('Image Border', 'acea-addons'),
            'selector' => '{{WRAPPER}} .elementor-image-box-img img',
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add select dropdown control to button widget
add_action('elementor/element/video/section_lightbox_style/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Acea Extra', 'acea-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_control(
        'play_icon_bg',
        [
            'label' => __('Icon Box Background Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );
    $element->add_control(
        'iamge_overly_color',
        [
            'label' => __('Image Overlay Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'background-color: {{VALUE}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );
    $element->add_responsive_control(
        'iamge_overly_opacity',
        [
            'label' => __('Opacity', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'default' => [
                'size' => 0,
            ],
            'range' => [
                'px' => [
                    'max' => 1,
                    'step' => 0.01,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'opacity: {{SIZE}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->add_responsive_control(
        'play_icon_box_size',
        [
            'label' => __('Icon Box Size', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-play' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
                'show_play_icon' => 'yes',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'video_border',
            'label' => __('Item Border', 'acea-addons'),
            'selector' => '{{WRAPPER}}  .elementor-custom-embed-play',
        ]
    );
    $element->add_responsive_control(
        'overlay_radius',
        [
            'label' => __('Image Overlay Radius', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-custom-embed-image-overlay, {{WRAPPER}} .elementor-wrapper.elementor-open-lightbox:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'show_image_overlay' => 'yes',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// icon box
add_action('elementor/element/icon-box/section_style_icon/after_section_start', function ($element, $args) {
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'icon_box_border',
            'label' => __('Item Border', 'acea-addons'),
            'selector' => '{{WRAPPER}} .elementor-icon-box-icon .elementor-icon',
        ]
    );
},10, 2);
// button
add_action('elementor/element/button/section_style/after_section_start', function ($element, $args) {
    $element->add_control(
        'button_width',
        [
            'label' => esc_html__( 'Width', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'min-width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'button_height',
        [
            'label' => esc_html__( 'Height', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'button_icon',
        [
            'label' => esc_html__( 'Icon', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $element->add_control(
        'btn_icon_color',
        [
            'label' => __('Icon Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .elementor-button-icon svg path' => 'stroke: {{VALUE}}',
            ],
        ]
    );
    $element->add_control(
        'btn_icon_hover_color',
        [
            'label' => __('Icon Hover Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon i' => 'color: {{VALUE}}',
                '{{WRAPPER}} .elementor-button:hover .elementor-button-icon svg path' => 'stroke: {{VALUE}}',
            ],
        ]
    );

    $element->add_control(
        'btn_icon_bg_color',
        [
            'label' => __('Icon Background Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon' => 'background-color: {{VALUE}}',
            ],
        ]
    );



    $element->add_control(
        'btn_icon_size',
        [
            'label' => esc_html__( 'Icon Size', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_control(
        'btn_icon_top_gap',
        [
            'label' => esc_html__( 'Icon Gap', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon' => 'margin-top: {{SIZE}}{{UNIT}};'
            ],
        ]
    );
    $element->add_control(
        'btn_icon_gap',
        [
            'label' => esc_html__( 'Icon Gap', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};'
            ],
        ]
    );
    $element->add_responsive_control(
        'btn_icon_padding',
        [
            'label' => __('Padding', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-button-icon' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_border_radius',
        [
            'label' => __('Border Radius', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                'body.rtl {{WRAPPER}} .elementor-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
            ],
        ]
    );
},10, 2);
add_action('elementor/element/before_section_end', function ($element, $section_id, $args) {
    /** @var \Elementor\Element_Base $element */
    if ('section_background' === $section_id) {
        $element->add_control(
            'custom_bg_css',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom CSS', 'acea-addons'),
                'selectors' => [
                    '{{WRAPPER}} ' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
			'rtl_css_on',
			[
				'label' => __( 'RTL CSS', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'acea-addons' ),
				'label_off' => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        $element->add_control(
            'custom_bg_css_rtl',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom RTl CSS', 'acea-addons'),
                'selectors' => [
                    'body.rtl {{WRAPPER}} ' => '{{VALUE}}',
                ],
                'condition' => [
                    'rtl_css_on' => 'yes',
                ]
            ]
        );
    }
    //overly Slider Control
    if ('section_background_overlay' === $section_id) {
        $element->add_responsive_control(
            'custom_bg_overlay_css_slider',
            [
                'type' => \Elementor\Controls_Manager::SLIDER,
                'label' => __('Width', 'acea-addons'),
                'size_units' => [ '%', 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
						'min' => 0,
						'max' => 100,
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 0,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    }
    if ('section_background_overlay' === $section_id) {
        $element->add_responsive_control(
            'bc_padding',
            [
                'label' => __('Padding', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-background-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .elementor-background-overlay' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
    }
    if ('section_background_overlay' === $section_id) {
        $element->add_control(
            'custom_bg_overlay_css',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom CSS', 'acea-addons'),
                'selectors' => [
                    '{{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
            ]
        );
        $element->add_control(
			'overlaY_rtl_css_on',
			[
				'label' => __( 'RTL CSS', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'acea-addons' ),
				'label_off' => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
        );
        $element->add_control(
            'overlay_bg_css_rtl',
            [
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'label' => __('Custom RTl CSS', 'acea-addons'),
                'selectors' => [
                    'body.rtl {{WRAPPER}} > .elementor-background-overlay' => '{{VALUE}}',
                ],
                'condition' => [
                    'overlaY_rtl_css_on' => 'yes',
                ]
            ]
            );
    }
}, 10, 3);
// Add Alignment Feature on counter
add_action('elementor/element/testimonial/section_style_testimonial_job/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Acea Extra', 'acea-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->add_responsive_control(
        'counter_gap',
        [
            'label' => __('Content Gap', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-content ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'name_gap',
        [
            'label' => __('Name Gap', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-testimonial-name ' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_section();
}, 10, 2);
// Add Alignment Feature on counter
add_action('elementor/element/accordion/section_toggle_style_content/after_section_end', function ($element, $args) {
    // add a control
    $element->start_controls_section(
        'section_extra',
        [
            'label' => __('Acea Extra', 'acea-addons'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    $element->start_controls_tabs(
        'style_tabs'
    );
    $element->start_controls_tab(
        'accor_normal_tab',
        [
            'label' => esc_html__( 'Normal', 'plugin-name' ),
        ]
    );
    $element->add_control(
        'acc_item_icon_size',
        [
            'label' => __( 'Icon', 'plugin-name' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );

    $element->add_responsive_control(
        'acc_icon_size_width',
        [
            'type' => \Elementor\Controls_Manager::SLIDER,
            'label' => __('Icon Size', 'acea-addons'),
            'size_units' => [ '%', 'px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_icon_size_height',
        [
            'type' => \Elementor\Controls_Manager::SLIDER,
            'label' => __('Icon height', 'acea-addons'),
            'size_units' => [ '%', 'px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'acc_icon_top_gap',
        [
            'type' => \Elementor\Controls_Manager::SLIDER,
            'label' => __('Svg Top gap', 'acea-addons'),
            'size_units' => [ '%', 'px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 0,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-tab-title .elementor-accordion-icon svg' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->add_control(
        'acc_item_border_hading',
        [
            'label' => __( 'Content border', 'plugin-name' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'acc_content_border',
            'label' => __('Item Border', 'acea-addons'),
            'selector' => '{{WRAPPER}}  .elementor-tab-content',
        ]
    );
    $element->add_responsive_control(
        'acc_content_width',
        [
            'type' => \Elementor\Controls_Manager::SLIDER,
            'label' => __('Content Width', 'acea-addons'),
            'size_units' => [ '%', 'px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 90,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion .elementor-accordion-title' => 'width: {{SIZE}}{{UNIT}};'
            ],
        ]
    );
    $element->add_control(
        'more_options',
        [
            'label' => __( 'Box border', 'plugin-name' ),
            'type' => \Elementor\Controls_Manager::HEADING,
            'separator' => 'before',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'acc_border',
            'label' => __('Item Border', 'acea-addons'),
            'selector' => '{{WRAPPER}}  .elementor-accordion-item',
        ]
    );
    $element->add_control(
        'acc_bg',
        [
            'label' => __('Accordion Item Background Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item ' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_radius',
        [
            'label' => __('Item Border Radius', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_content_margin',
        [
            'label' => __('Content Margin', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_paddingn',
        [
            'label' => __('Item Padding', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_margin',
        [
            'label' => __('Item Margin', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_tab();

    $element->start_controls_tab(
        'acc_style_hover_tab',
        [
            'label' => esc_html__( 'Hover', 'plugin-name' ),
        ]
    );
    $element->add_control(
        'acc_active_bg',
        [
            'label' => __('Accordion Active Background Color', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item.active' => 'background-color: {{VALUE}}',
            ],
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'acc_active_border',
            'label' => esc_html__( 'Border', 'plugin-name' ),
            'selector' => '{{WRAPPER}} .elementor-accordion-item.active',
        ]
    );
    $element->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'active_box_shadow',
            'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
            'selector' => '{{WRAPPER}} .elementor-accordion-item.active',
        ]
    );
    $element->add_responsive_control(
        'active_acc_padding',
        [
            'label' => __('Padding', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item.active' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'acc_active_border_radius',
        [
            'label' => __('Border Radius', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-accordion-item.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->end_controls_tab();
	$element->end_controls_tabs();
    $element->end_controls_section();
}, 10, 2);
// / Add select dropdown control to button widget
add_action('elementor/element/icon-list/section_icon_style/after_section_start', function ($element, $args) {
    $element->add_control(
        'icon_line_color',
        [
            'label' => __( 'Line Color', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon svg path' => 'stroke: {{VALUE}};',
            ],
        ]
    );
    $element->add_control(
        'icon_bg_color',
        [
            'label' => __( 'Background Color', 'acea-addons' ),
            'type' => \Elementor\Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'background-color: {{VALUE}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_width',
        [
            'label' => __('Width', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_height',
        [
            'label' => __('Height', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_border_radius',
        [
            'label' => __('Border Radius', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 500,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_self_align_position',
        [
            'label' => esc_html__( 'Icon Position', 'elementor' ),
            'type' => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Top', 'elementor' ),
                    'icon' => 'eicon-align-start-v',
                ],
                'center' => [
                    'title' => esc_html__( 'Center', 'elementor' ),
                    'icon' => 'eicon-align-center-v',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'End', 'elementor' ),
                    'icon' => 'eicon-align-end-v',
                ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item' => 'align-items:{{VALUE}}',
            ],
        ]
    );
    $element->add_responsive_control(
        'iconlist_Icon_gap',
        [
            'label' => __('Icon gap', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon ' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);

add_action('elementor/element/icon-list/section_text_style/after_section_start', function ($element, $args) {
    $element->add_responsive_control(
        'icon_list_margin',
        [
            'label' => __('Margin', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'icon_list_text_width',
        [
            'label' => __('Width', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 80,
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-text' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
}, 10, 2);

// social icon
add_action('elementor/element/social-icons/section_social_style/after_section_start', function ($element, $args) {
     $element->add_responsive_control(
        'icon_font_size',
        [
            'label' => esc_html__( 'Icon Size', 'elementor' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 6,
                    'max' => 300,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon i' => 'font-size: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .elementor-icon svg' => 'width: {{SIZE}}{{UNIT}}',
            ],
        ]
    );
 }, 10, 2);
function acea_stickyregister_controls( $element, $args )
{
    $element->add_control(
        'acea_sticky',
        [
           'label' => __('Sticky', 'acea-addons'),
           'type' => \Elementor\Controls_Manager::SELECT,
           'options' => [
               'yes' => __('Yes', 'acea-addons'),
               'no' => __('No', 'acea-addons'),
           ],
           'default' => 'no',
           'separator' => 'before',
           'prefix_class' => 'acea-addons-sticky-',
           'frontend_available' => true,
           'render_type'    => 'template'
       ]
    );
    $element->add_control(
       'acea_sticky_bg',
       [
           'label' => __('Background Color', 'acea-addons'),
           'type' => \Elementor\Controls_Manager::COLOR,
           'selectors' => [
               '{{WRAPPER}}.reveal-sticky' => 'background-color: {{VALUE}}',
           ],
           'condition' => [
               'acea_sticky' => 'yes',
           ],
           ]
       );
       $element->add_group_control(
           \Elementor\Group_Control_Box_Shadow::get_type(),
           [
               'name' => 'acea_sticky_shadow',
               'label' => __('Shadow', 'acea-addons-ts'),
               'selector' => '{{WRAPPER}}.reveal-sticky',
               'condition' => [
                   'acea_sticky' => 'yes',
               ],
           ]
       );
   $element->add_group_control(
       \Elementor\Group_Control_Border::get_type(),
       [
           'name' => 'acea_sticky_border',
           'label' => __('Border', 'acea-addons-ts'),
           'selector' => '{{WRAPPER}}.reveal-sticky',
           'condition' => [
               'acea_sticky' => 'yes',
           ],
       ]
   );
}
add_action('elementor/element/section/section_effects/after_section_start', 'acea_stickyregister_controls' ,10, 2 );
add_action('elementor/element/common/section_effects/after_section_start', 'acea_stickyregister_controls' ,10, 2 );
add_action('elementor/element/before_section_end', function ($element, $section_id, $args) {
    /** @var \Elementor\Element_Base $element */
    if ('section_shape_divider' === $section_id) {
        $element->add_control(
            'animation_on',
            [
               'label' => __('Animation', 'acea-addons'),
               'type' => \Elementor\Controls_Manager::SELECT,
               'options' => [
                   'no' => __('None', 'acea-addons'),
                   'animation-one' => __('Animation-one', 'acea-addons'),
                   'animation-two' => __('Animation-two', 'acea-addons'),
                   'animation-three' => __('Animation-three', 'acea-addons'),
               ],
               'default' => 'no',
               'separator' => 'before',
               'prefix_class' => 'acea-custom-animation-',
               'frontend_available' => true,
               'render_type'    => 'template'
           ]
        );
    }
}, 10, 3);
