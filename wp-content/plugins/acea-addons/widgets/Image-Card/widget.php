<?php
namespace Acea_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Background;
use \Elementor\Control_Media;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Acea_Image_Card extends Widget_Base {
	public function get_name() {
		return 'acea-image-card';
	}
	public function get_title() {
		return esc_html__( 'Acea Image Card', 'acea-addons' );
	}
	public function get_icon() {
		return 'eicon-image-before-after';
	}
	public function get_categories() {
		return [ 'acea-addons' ];
	}
	public function get_keywords() {
        return [ 'acea', 'employee', 'staff', 'image', 'card' ];
    }
	protected function register_controls() {
		/**
		* Team Member Content Section
		*/
		$this->start_controls_section(
			'acea_team_content',
			[
				'label' => esc_html__( 'Content', 'acea-addons' )
			]
		);

		$this->add_control(
			'acea_image_card_image',
			[
				'label'   => __( 'Image', 'acea-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src()
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image_card_image_size',
				'default'   => 'medium_large',
				'condition' => [
					'acea_image_card_image[url]!' => ''
				]
			]
		);

		$this->add_control(
			'acea_image_card_mask_shape_position',
			[
				'label'       => __( 'Position', 'acea-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center',
				'label_block' => true,
				'options'     => [
					'top'     => __( 'Top', 'acea-addons' ),
					'center'  => __( 'Center', 'acea-addons' ),
					'left'    => __( 'Left', 'acea-addons' ),
					'right'   => __( 'Right', 'acea-addons' ),
					'bottom'  => __( 'Bottom', 'acea-addons' ),
					'custom'  => __( 'Custom', 'acea-addons' )
                ],
                'selectors'   => [
					'{{WRAPPER}} .acea-image-card-thumb img' => '-webkit-mask-position: {{VALUE}};'
				],
				'condition' 		   => [
					'acea_image_card_enable_image_mask' => 'yes'
				]
			]
		);

		$this->add_control(
			'acea_image_card_mask_shape_position_x_offset',
			[
				'label'       => __( 'X Offset', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-image-card-thumb img' => '-webkit-mask-position-y: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'acea_image_card_enable_image_mask' => 'yes',
                    'acea_image_card_mask_shape_position' => 'custom'
				]
			]
		);

		$this->add_control(
			'acea_image_card_mask_shape_position_y_offset',
			[
				'label'       => __( 'Y Offset', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 500
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-image-card-thumb img' => '-webkit-mask-position-x: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'acea_image_card_enable_image_mask' => 'yes',
                    'acea_image_card_mask_shape_position' => 'custom'
				]
			]
		);

        $this->add_control(
			'acea_image_card_mask_shape_size',
			[
				'label'       => __( 'Size', 'acea-addons' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'auto',
				'label_block' => true,
				'options'     => [
					'auto'    => __( 'Auto', 'acea-addons' ),
					'contain' => __( 'Contain', 'acea-addons' ),
					'cover'   => __( 'Cover', 'acea-addons' ),
					'custom'  => __( 'Custom', 'acea-addons' )
                ],
                'selectors'   => [
					'{{WRAPPER}} .acea-image-card-thumb img' => '-webkit-mask-size: {{VALUE}};'
				],
				'condition' 		   => [
					'acea_image_card_enable_image_mask' => 'yes'
				]
			]
        );

        $this->add_control(
			'acea_image_card_mask_shape_custome_size',
			[
				'label'       => __( 'Mask Size', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%' ],
				'range'       => [
					'px'      => [
						'min' => 0,
						'max' => 600
					],
					'%'       => [
						'min' => 0,
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-image-card-thumb img' => '-webkit-mask-size: {{SIZE}}{{UNIT}};'
                ],
                'condition'   => [
					'acea_image_card_enable_image_mask' => 'yes',
                    'acea_image_card_mask_shape_size' => 'custom'
				]
			]
		);

        $this->add_control(
			'acea_image_card_mask_shape_repeat',
			[
				'label'         => __( 'Repeat', 'acea-addons' ),
				'type'          => Controls_Manager::SELECT,
				'default'       => 'no-repeat',
				'label_block'   => true,
				'options'       => [
					'no-repeat' => __( 'No repeat', 'acea-addons' ),
					'repeat'    => __( 'Repeat', 'acea-addons' )
                ],
                'selectors'     => [
					'{{WRAPPER}} .acea-image-card-thumb img' => '-webkit-mask-repeat: {{VALUE}};'
				],
				'condition' 	=> [
					'acea_image_card_enable_image_mask' => 'yes'
				]
			]
		);

		$this->add_control(
			'acea_image_card_name',
			[
				'label'       => esc_html__( 'Name', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'John Doe', 'acea-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_rating_number',
			[
				'label'       => esc_html__( 'Designation', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Designation', 'acea-addons' ),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_section_image_cards_cta_btn',
			[
				'label'        => __( 'Call To Action', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_control(
			'acea_image_cards_cta_btn_text',
			[
				'label'       => esc_html__( 'Text', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Read More', 'acea-addons' ),
				'condition'   => [
					'acea_section_image_cards_cta_btn' => 'yes'
				],
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_image_cards_cta_btn_link',
			[
				'label'       => esc_html__( 'Link', 'acea-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
				'show_external' => true,
				'condition' => [
					'acea_section_image_cards_cta_btn' => 'yes'
				]
			]
		);
		$this->end_controls_section();
	

		/*
		* Team Members Container Style
		*/
		$this->start_controls_section(
			'acea_section_image_cards_styles_preset',
			[
				'label' => esc_html__( 'Container', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acea_image_cards_bg',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .acea-image-card'
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acea_image_cards_border',
				'selector' => '{{WRAPPER}} .acea-image-card'
			]
		);

		$this->add_responsive_control(
			'acea_image_cards_radius',
			[
				'label'      => __( 'Border radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_image_cards_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_image_cards_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'acea_image_cards_box_shadow',
				'selector' => '{{WRAPPER}} .acea-image-card',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 49,
		                    'spread'     => 0,
		                    'color'      => 'rgba(24, 27, 33, 0.1)'
		                ]
		            ]
	            ]
			]
		);

		$this->end_controls_section();

		/**
		 * For Thumbnail style
		 */

		$this->start_controls_section(
			'acea_section_image_cards_image_style',
			[
				'label' => esc_html__( 'Image', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
            'acea_team_membe_image_position',
            [
                'label'         => esc_html__( 'Image Position', 'acea-addons' ),
                'type'          => Controls_Manager::CHOOSE,
                'toggle'        => false,
                'default'       => 'acea-position-top',
                'options'       => [
                    'acea-position-left'  => [
                        'title' => esc_html__( 'Left', 'acea-addons' ),
                        'icon'  => 'eicon-arrow-left'
                    ],
                    'acea-position-top'   => [
                        'title' => esc_html__( 'Top', 'acea-addons' ),
                        'icon'  => 'eicon-arrow-up'
                    ],
                    'acea-position-right' => [
                        'title' => esc_html__( 'Right', 'acea-addons' ),
                        'icon'  => 'eicon-arrow-right'
                    ]
                ]
            ]
        );

		$this->add_control(
			'acea_section_image_cards_thumbnail_box',
			[
				'label'        => __( 'Image Box', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'acea-addons' ),
				'label_off'    => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

		$this->add_responsive_control(
            'acea_section_image_cards_thumbnail_box_height',
            [
                'label'      => __( 'Height', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 100
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-image-card-thumb'=> 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'acea_section_image_cards_thumbnail_box' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'acea_section_image_cards_thumbnail_box_width',
            [
                'label'      => __( 'Width', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'unit'   => 'px',
                    'size'   => 100
                ],
                'range'        => [
                    'px'       => [
                        'min'  => 50,
                        'max'  => 500,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => 1,
                        'max'  => 100,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-image-card-thumb'=> 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'  => [
                    'acea_section_image_cards_thumbnail_box' => 'yes'
                ]
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'acea_section_image_cards_thumbnail_box_border',
				'selector'  => '{{WRAPPER}} .acea-image-card-thumb',
				'condition' => [
					'acea_section_image_cards_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_image_cards_thumbnail_box_radius',
			[
				'label'      => __( 'Border radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'after',
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acea-image-card-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_image_cards_thumbnail_box_margin_top',
			[
				'label'      => __( 'Top Spacing', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'range'        => [
                    'px'       => [
                        'min'  => -300,
                        'max'  => 300,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => -50,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-thumb' => 'margin-top: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'acea_section_image_cards_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_image_cards_thumbnail_box_margin_bottom',
			[
				'label'      => __( 'Bottom Spacing', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'unit'   => 'px',
					'size'   => 0
				],
				'range'        => [
                    'px'       => [
                        'min'  => -300,
                        'max'  => 300,
                        'step' => 5
                    ],
                    '%'        => [
                        'min'  => -50,
                        'max'  => 50,
                        'step' => 2
                    ]
                ],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};'
				],
				'condition'  => [
					'acea_section_image_cards_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'acea_section_image_cards_thumbnail_box_shadow',
				'selector'  => '{{WRAPPER}} .acea-image-card-thumb',
				'condition' => [
					'acea_section_image_cards_thumbnail_box' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'acea_section_image_cards_thumbnail_css_filter',
				'selector' => '{{WRAPPER}} .acea-image-card-thumb img',
			]
		);

		$this->end_controls_section();

		/*
		* Team Members Content Style
		*/
		$this->start_controls_section(
			'acea_section_image_cards_content_style',
			[
				'label' => esc_html__( 'Content', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => esc_html__( 'Width', 'plugin-name' ),
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
				'default' => [
					'unit' => '%',
					'size' => 60,
				],
				'selectors' => [
					'{{WRAPPER}} .acea-position-left .acea-image-card-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'acea_image_card_content_alignment',
			[
				'label'   => __( 'Alignment', 'acea-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'options' => [
					'acea-left'   => [
						'title'   => __( 'Left', 'acea-addons' ),
						'icon'    => 'eicon-text-align-left'
					],
					'acea-center' => [
						'title'   => __( 'Center', 'acea-addons' ),
						'icon'    => 'eicon-text-align-center'
					],
					'acea-right'  => [
						'title'   => __( 'Right', 'acea-addons' ),
						'icon'    => 'eicon-text-align-right'
					]
				],
				'default' => 'acea-center'
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'acea_image_cards_content_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .acea-image-card-content'
			]
		);

		$this->add_responsive_control(
			'acea_section_image_cards_content_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '30',
					'right'  => '30',
					'bottom' => '30',
					'left'   => '30'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_section_image_cards_content_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_image_card_content_border_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'acea_section_image_cards_content_box_shadow',
				'selector' => '{{WRAPPER}} .acea-image-card-content'
			]
		);

		$this->end_controls_section();

		/*
		* Name style
		*/
		$this->start_controls_section(
            'section_team_carousel_name',
            [
				'label' => __('Name', 'acea-addons'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'acea_team_name_color',
            [
				'label'     => __('Color', 'acea-addons'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
                    '{{WRAPPER}} .acea-image-card-name' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'acea_team_name_typography',
				'selector' => '{{WRAPPER}} .acea-image-card-name'
            ]
		);

		$this->add_responsive_control(
			'acea_image_cards_name_margin',
			[
				'label'        => __( 'Margin', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-image-card-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Designation Style
		 */
        $this->start_controls_section(
            'section_image_card_designation',
            [
				'label' => __('Designation', 'acea-addons'),
				'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'acea_team_designation_color',
            [
				'label'     => __('Color', 'acea-addons'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
                    '{{WRAPPER}} .acea_image_rating_number' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
				'name'     => 'acea_team_designation_typography',
				'selector' => '{{WRAPPER}} .acea_image_rating_number'
            ]
		);

		$this->add_responsive_control(
			'acea_image_cards_designation_margin',
			[
				'label'        => __( 'Margin', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea_image_rating_number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Call to action Style
		 */
        $this->start_controls_section(
            'acea_image_card_cta_btn_style',
            [
				'label'     => __('Call To Action', 'acea-addons'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_section_image_cards_cta_btn' => 'yes'
				]
            ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_image_card_cta_btn_typography',
				'selector' => '{{WRAPPER}} .acea-image-card-cta'
			]
		);

		$this->add_responsive_control(
			'acea_image_card_cta_btn_margin',
			[
				'label'        => __( 'Margin', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-image-card-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_image_card_cta_btn_padding',
			[
				'label'        => __( 'Padding', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%', 'em' ],
				'default'      => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-image-card-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_image_card_cta_btn_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '0',
					'right'  => '0',
					'bottom' => '0',
					'left'   => '0'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-image-card-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->start_controls_tabs( 'acea_image_card_cta_btn_tabs' );

			$this->start_controls_tab( 'acea_image_card_cta_btn_tab_normal', [ 'label' => esc_html__( 'Normal', 'acea-addons' ) ] );

				$this->add_control(
					'acea_image_card_cta_btn_text_color_normal',
					[
						'label'     => esc_html__( 'Text Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .acea-image-card-cta' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_image_card_cta_btn_background_normal',
					[
						'label'     => esc_html__( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .acea-image-card-cta' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_image_card_cta_btn_border_normal',
						'selector' => '{{WRAPPER}} .acea-image-card-cta'
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'acea_image_card_cta_btn_tab_hover', [ 'label' => esc_html__( 'Hover', 'acea-addons' ) ] );

				$this->add_control(
					'acea_image_card_cta_btn_text_color_hover',
					[
						'label'     => esc_html__( 'Text Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#d6d6d6',
						'selectors' => [
							'{{WRAPPER}} .acea-image-card-cta:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_image_card_cta_btn_background_hover',
					[
						'label'     => esc_html__( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#222222',
						'selectors' => [
							'{{WRAPPER}} .acea-image-card-cta:hover' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_image_card_cta_btn_border_hover',
						'selector' => '{{WRAPPER}} .acea-image-card-cta:hover'
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


	}
	private function image_card_cta() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'acea_image_cards_cta_btn_text', 'class', 'acea-team-cta-button-text' );
		$this->add_inline_editing_attributes( 'acea_image_cards_cta_btn_text', 'none' );
		?>
		<span <?php echo $this->get_render_attribute_string( 'acea_image_cards_cta_btn_text' ); ?>>
			<?php echo esc_html( $settings['acea_image_cards_cta_btn_text'] );	?>
		</span>
		<?php
	}
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'acea_image_card_name', 'class', 'acea-image-card-name' );
		$this->add_inline_editing_attributes( 'acea_image_card_name', 'basic' );
		$this->add_render_attribute( 'acea_rating_number', 'class', 'acea_image_rating_number' );
		$this->add_inline_editing_attributes( 'acea_rating_number', 'basic' );
		$this->add_render_attribute( 'acea_image_card_item', [
            'class' => [
                'acea-image-card',
                esc_attr( $settings['acea_image_card_content_alignment'] ),
                esc_attr( $settings['acea_team_membe_image_position'] )
            ]
        ]);
		$this->add_render_attribute( 'acea_image_cards_cta_btn_link', 'class', 'acea-image-card-cta' );
		if( isset( $settings['acea_image_cards_cta_btn_link']['url'] ) ) {
            $this->add_render_attribute( 'acea_image_cards_cta_btn_link', 'href', esc_url( $settings['acea_image_cards_cta_btn_link']['url'] ) );
	        if( $settings['acea_image_cards_cta_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'acea_image_cards_cta_btn_link', 'target', '_blank' );
	        }
	        if( $settings['acea_image_cards_cta_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'acea_image_cards_cta_btn_link', 'rel', 'nofollow' );
	        }
        }

		?>

		<div class="acea-team-item">
			<div <?php echo $this->get_render_attribute_string( 'acea_image_card_item' ); ?>>
				<?php do_action('acea_image_card_wrapper_before'); ?>
				<?php
					if ( $settings['acea_image_card_image']['url'] || $settings['acea_image_card_image']['id'] ) { ?>
						<div class="acea-image-card-thumb">
							<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image_card_image_size', 'acea_image_card_image' ); ?>
						</div>
					<?php
					}
				?>

				<div class="acea-image-card-content">
					<?php do_action('acea_image_card_content_area_before'); ?>
					<div class="image-name-rating-number">
						<?php if ( !empty( $settings['acea_image_card_name'] ) ) : ?>
							<h2 <?php echo $this->get_render_attribute_string( 'acea_image_card_name' ); ?>><?php echo wp_kses_post( $settings['acea_image_card_name'] ); ?></h2>
						<?php endif; ?>

						<?php if ( !empty( $settings['acea_rating_number'] ) ) : ?>
							<span <?php echo $this->get_render_attribute_string( 'acea_rating_number' ); ?>><?php echo wp_kses_post ( $settings['acea_rating_number'] ); ?></span>
						<?php endif; ?>
					</div>
					<?php if ( 'yes' === $settings['acea_section_image_cards_cta_btn'] && !empty( $settings['acea_image_cards_cta_btn_text'] ) ) : ?>
						<a <?php echo $this->get_render_attribute_string( 'acea_image_cards_cta_btn_link' ); ?>>
							<?php echo $this->image_card_cta(); ?>
						</a>
					<?php
					endif;

					do_action('acea_image_card_area_after'); ?>

				</div>
				<?php do_action('acea_image_card_wrapper_after'); ?>
			</div>
		</div>
		<?php
	}
}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Image_Card() );