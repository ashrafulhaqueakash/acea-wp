<?php
namespace Acea_Addons\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Icons_Manager;
use \Elementor\Utils;
use \Elementor\Widget_Base;

class Acea_Modal_Popup extends Widget_Base {

	public function get_name() {
		return 'acea-modal-popup';
	}

	public function get_title() {
		return esc_html__( 'Acea Modal Popup', 'acea-addons' );
	}

	public function get_icon() {
		return 'eicon-video-playlist';
	}

	public function get_categories() {
		return [ 'acea-addons' ];
	}

	public function get_keywords() {
		return [ 'acea', 'lightbox', 'popup', 'quickview', 'video' ];
	}

	protected function register_controls() {

		/**
		 * Modal Popup Content section
		 */
		$this->start_controls_section(
			'acea_modal_content_section',
			[
				'label' => __( 'Contents', 'acea-addons' )
			]
		);

		$this->add_control(
			'acea_modal_content',
			[
				'label'   => __( 'Type of Modal', 'acea-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
					'image'          => __( 'Image', 'acea-addons' ),
					'image-gallery'  => __( 'Image Gallery', 'acea-addons' ),
					'html_content'   => __( 'HTML Content', 'acea-addons' ),
					'youtube'        => __( 'Youtube Video', 'acea-addons' ),
					'vimeo'          => __( 'Vimeo Video', 'acea-addons' ),
					'external-video' => __( 'Self Hosted Video', 'acea-addons' ),
					'external_page'  => __( 'External Page', 'acea-addons' ),
					'shortcode'      => __( 'ShortCode', 'acea-addons' )
				]
			]
		);

		/**
		 * Modal Popup image section
		 */
		$this->add_control(
			'acea_modal_image',
			[
				'label'      => __( 'Image', 'acea-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => [
					'url' 	 => Utils::get_placeholder_image_src()
				],
				'dynamic'    => [
					'active' => true
                ],
                'condition'  => [
                    'acea_modal_content' => 'image'
                ]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
				'condition' => [
                    'acea_modal_content' => 'image'
                ]
			]
		);

		/**
		 * Modal Popup image gallery
		 */

		$this->add_control(
			'acea_modal_image_gallery_column',
			[
				'label'   => __( 'Column', 'acea-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'column-three',
                'options' => [
					'column-one'   => __( 'Column 1', 'acea-addons' ),
					'column-two'   => __( 'Column 2', 'acea-addons' ),
					'column-three' => __( 'Column 3', 'acea-addons' ),
					'column-four'  => __( 'Column 4', 'acea-addons' ),
					'column-five'  => __( 'Column 5', 'acea-addons' ),
					'column-six'   => __( 'Column 6', 'acea-addons' )
				],
				'condition' => [
					'acea_modal_content' => 'image-gallery'
				]
			]
		);

		$image_repeater = new Repeater();

		$image_repeater->add_control(
			'acea_modal_image_gallery',
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

		$image_repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'thumbnail',
				'default'   => 'full',
			]
		);

		$image_repeater->add_control(
			'acea_modal_image_gallery_text',
			[
				'label' => __( 'Description', 'acea-addons' ),
				'type'  => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'acea_modal_image_gallery_repeater',
			[
				'label'   => esc_html__( 'Image Gallery', 'acea-addons' ),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $image_repeater->get_controls(),
				'default' => [
					[ 'acea_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'acea_modal_image_gallery' => Utils::get_placeholder_image_src() ],
					[ 'acea_modal_image_gallery' => Utils::get_placeholder_image_src() ]
				],
				'condition' => [
					'acea_modal_content' => 'image-gallery'
				]
			]
		);
		/**
		 * Modal Popup html content section
		 */
		$this->add_control(
			'acea_modal_html_content',
			[
				'label'     => __( 'Add your content here (HTML/Shortcode)', 'acea-addons' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your popup content here', 'acea-addons' ),
				'dynamic'   => [ 'active' => true ],
				'condition' => [
				  	'acea_modal_content' => 'html_content'
			  	]
			]
		);

		/**
		 * Modal Popup video section
		 */

		$this->add_control(
            'acea_modal_youtube_video_url',
            [
				'label'       => __( 'Provide Youtube Video URL', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://www.youtube.com/watch?v=b1lyIT1FvDo',
				'placeholder' => __( 'Place Youtube Video URL', 'acea-addons' ),
				'title'       => __( 'Place Youtube Video URL', 'acea-addons' ),
				'condition'   => [
                    'acea_modal_content' => 'youtube'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );


        $this->add_control(
            'acea_modal_vimeo_video_url',
            [
				'label'       => __( 'Provide Vimeo Video URL', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://vimeo.com/347565673',
				'placeholder' => __( 'Place Vimeo Video URL', 'acea-addons' ),
				'title'       => __( 'Place Vimeo Video URL', 'acea-addons' ),
				'condition'   => [
                    'acea_modal_content' => 'vimeo'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
		);

		/**
		 * Modal Popup external video section
		 */
		$this->add_control(
			'acea_modal_external_video',
			[
				'label'      => __( 'External Video', 'acea-addons' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
				'dynamic' => [
					'active' => true,
				],
				'condition'  => [
                    'acea_modal_content' => 'external-video'
                ]
			]
		);

		$this->add_control(
            'acea_modal_external_page_url',
            [
				'label'       => __( 'Provide External URL', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'https://acea.com',
				'placeholder' => __( 'Place External Page URL', 'acea-addons' ),
				'condition'   => [
                    'acea_modal_content' => 'external_page'
                ],
				'dynamic' => [
					'active' => true,
				]
            ]
        );

        $this->add_responsive_control(
            'acea_modal_video_width',
            [
				'label'        => __( 'Content Width', 'acea-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
                        'min'  => 0,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'unit'     => 'px',
                    'size'     => 720
                ],
                'selectors'    => [
					'{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element iframe,
					{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-video-hosted' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-modal-item' => 'width: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'acea_modal_content' => [ 'youtube', 'vimeo', 'external_page', 'external-video' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'acea_modal_video_height',
            [
				'label'        => __( 'Content Height', 'acea-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
                    'px'       => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5
                    ],
                    '%'        => [
						'min'  => 0,
						'max'  => 100
                    ]
                ],
                'default'      => [
					'unit'     => 'px',
					'size'     => 400
                ],
                'selectors'    => [
                    '{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element iframe' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-modal-item' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'acea_modal_content' => [ 'youtube', 'vimeo', 'external_page' ]
                ]
            ]
        );

        $this->add_control(
            'acea_modal_shortcode',
            [
				'label'       => __( 'Enter your shortcode', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __( '[gallery]', 'acea-addons' ),
				'condition'   => [
                    'acea_modal_content' => 'shortcode'
                ]
            ]
		);

		$this->add_responsive_control(
			'acea_modal_content_width',
			[
				'label' => __( 'Content Width', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acea-modal-item' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition'    => [
                    'acea_modal_content' => [ 'image', 'image-gallery', 'html_content', 'shortcode' ]
                ]
			]
		);

		$this->add_control(
			'acea_modal_btn_text',
			[
				'label'       => __( 'Button Text', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '', 'acea-addons' ),
				'dynamic'     => [
					'active'  => true
				]
			]
		);

		$this->add_control(
			'acea_modal_btn_icon',
			[
				'label'       => __( 'Button Icon', 'acea-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-play',
                    'library' => 'fa-brands'
                ]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup settings section
		 */
		$this->start_controls_section(
			'acea_modal_setting_section',
			[
				'label' => __( 'Settings', 'acea-addons' )
			]
		);

		$this->add_control(
			'acea_modal_overlay',
			[
				'label'        => __( 'Overlay', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'acea-addons' ),
				'label_off'    => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'acea_modal_overlay_click_close',
			[
				'label'     => __( 'Close While Clicked Outside', 'acea-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => __( 'ON', 'acea-addons' ),
				'label_off' => __( 'OFF', 'acea-addons' ),
				'default'   => 'yes',
				'condition' => [
					'acea_modal_overlay' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup button style
		 */

		$this->start_controls_section(
			'acea_modal_display_settings',
			[
				'label' => __( 'Button', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);


		/**
		 * display settings for button normal and hover
		 */
		$this->start_controls_tabs( 'acea_modal_btn_typhography_color', ['separator' => 'before' ] );

			$this->start_controls_tab( 'acea_modal_btn_typhography_color_normal_tab', [ 'label' => esc_html__( 'Normal', 'acea-addons' )] );

				$this->add_control(
					'acea_modal_btn_typhography_color_normal',
					[
						'label'     => __( 'Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#ffffff',
						'selectors' => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_modal_btn_background_normal',
					[
						'label'     => __( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#4243DC',
						'selectors' => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'background-color: {{VALUE}};'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name'      => 'acea_modal_btn_typhography',
						'label'     => __( 'Button Typography', 'acea-addons' ),
						'selector'  => '{{WRAPPER}} .acea-modal-button .acea-modal-image-action'
					]
				);

				$this->add_control(
					'acea_modal_btn_enable_fixed_width_height',
					[
						'label' => __( 'Enable Fixed Height & Width?', 'acea-addons' ),
						'type' => Controls_Manager::SWITCHER,
						'label_on' => __( 'Show', 'acea-addons' ),
						'label_off' => __( 'Hide', 'acea-addons' ),
						'return_value' => 'yes',
						'default' => 'no',
					]
				);

				$this->add_control(
					'acea_modal_btn_fixed_width_height',
					[
						'label' => __( 'Fixed Height & Width', 'acea-addons' ),
						'type' => Controls_Manager::POPOVER_TOGGLE,
						'label_off' => __( 'Default', 'acea-addons' ),
						'label_on' => __( 'Custom', 'acea-addons' ),
						'return_value' => 'yes',
						'default' => 'yes',
						'condition' => [
							'acea_modal_btn_enable_fixed_width_height' => 'yes'
						]
					]
				);

				$this->start_popover();

					$this->add_responsive_control(
						'acea_modal_btn_fixed_width',
						[
							'label'      => esc_html__( 'Width', 'acea-addons' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'

							],
							'condition' => [
								'acea_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

					$this->add_responsive_control(
						'acea_modal_btn_fixed_height',
						[
							'label'      => esc_html__( 'Height', 'acea-addons' ),
							'type'       => Controls_Manager::SLIDER,
							'size_units' => [ 'px', '%' ],
							'range'      => [
								'px'     => [
									'min'  => 0,
									'max'  => 500,
									'step' => 1
								],
								'%'        => [
									'min'  => 0,
									'max'  => 100
								]
							],
							'default'    => [
								'unit'   => 'px',
								'size'   => 70
							],
							'selectors'  => [
								'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'height: {{SIZE}}{{UNIT}};'
							],
							'condition' => [
								'acea_modal_btn_enable_fixed_width_height' => 'yes'
							]
						]
					);

				$this->end_popover();

				$this->add_responsive_control(
					'acea_modal_btn_width',
					[
						'label'        => esc_html__( 'Width', 'acea-addons' ),
						'type'         => Controls_Manager::SLIDER,
						'size_units'   => [ 'px', '%' ],
						'range'        => [
							'px'       => [
								'min'  => 0,
								'max'  => 500,
								'step' => 1
							],
							'%'        => [
								'min'  => 0,
								'max'  => 100
							]
						],
						'default'      => [
							'unit'     => 'px',
							'size'     => 70
						],
						'selectors'    => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'width: {{SIZE}}{{UNIT}};'
						],
						'condition' => [
							'acea_modal_btn_enable_fixed_width_height!' => 'yes'
						]
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'               => 'acea_modal_btn_border_normal',
						'selector'           => '{{WRAPPER}} .acea-modal-button .acea-modal-image-action'
					]
				);

				$this->add_responsive_control(
					'acea_modal_btn_radius',
					[
						'label'      => __( 'Border Radius', 'acea-addons' ),
						'type'       => Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%' ],
						'default'    => [
							'top'    => '50',
							'right'  => '50',
							'bottom' => '50',
							'left'   => '50',
							'unit'   => 'px'
						],
						'selectors'  => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

				$this->add_responsive_control(
					'acea_modal_btn_padding',
					[
						'label'        => __( 'Padding', 'acea-addons' ),
						'type'         => Controls_Manager::DIMENSIONS,
						'size_units'   => [ 'px', '%' ],
						'default'      => [
							'top'      => '20',
							'right'    => '0',
							'bottom'   => '20',
							'left'     => '0',
							'unit'     => 'px',
							'isLinked' => false
						],
						'selectors'    => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
						]
					]
				);

			$this->end_controls_tab();

			$this->start_controls_tab( 'acea_modal_btn_typhography_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'acea-addons' ) ] );

				$this->add_control(
					'acea_modal_btn_color_hover',
					[
						'label'     => __( 'Text Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#fff',
						'selectors' => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action:hover' => 'color: {{VALUE}};'
						]
					]
				);

				$this->add_control(
					'acea_modal_btn_background_hover',
					[
						'label'     => __( 'Background Color', 'acea-addons' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '#EF2469',
						'selectors' => [
							'{{WRAPPER}} .acea-modal-button .acea-modal-image-action:hover' => 'background-color: {{VALUE}};'
						]
					]
				);
				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name'     => 'acea_modal_btn_border_hover',
						'selector' => '{{WRAPPER}} .acea-modal-button .acea-modal-image-action:hover'
					]
				);

			$this->end_controls_tab();
			$this->end_controls_tabs();

        $this->end_controls_section();

		/**
		 * Modal Popup Icon section
		 */
		$this->start_controls_section(
			'acea_modal_icon_section',
			[
				'label' => __( 'Icon', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
				]
		);

		$this->add_control(
			'acea_modal_btn_icon_align',
			[
				'label'     => __( 'Icon Position', 'acea-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'acea-addons' ),
					'right' => __( 'After', 'acea-addons' )
				],
				'condition' => [
                    'acea_modal_btn_icon[value]!' => ''
                ]
			]
		);

		$this->add_responsive_control(
			'acea_modal_btn_icon_indent',
			[
				'label'       => __( 'Icon Spacing', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-modal-wrapper .acea-midal-btn-icon.modal-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-modal-wrapper .acea-midal-btn-icon.modal-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};'
				],
				'condition'   => [
                    'acea_modal_btn_icon[value]!' => ''
                ]
			]
		);
		$this->add_responsive_control(
			'acea_modal_btn_icon_size',
			[
				'label'       => __( 'Icon Size', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-modal-wrapper .acea-midal-btn-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-modal-wrapper .acea-midal-btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);

		$this->start_controls_tabs(
			'btn_icon_style_tabs'
		);
		

		$this->start_controls_tab( 'acea_modal_btn_icon_color_normal_tab', 
			[ 
				'label' => esc_html__( 'Normal', 'acea-addons' )
			] 
		);
		$this->add_control(
			'acea_modal_btn_icon_color_normal',
			[
				'label'     => __( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'acea_modal_btn_icon_background_normal',
			[
				'label'     => __( 'Background Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#4243DC',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'background-color: {{VALUE}};'
				]
			]
		);
		
		$this->add_control(
			'acea_modal_btn_icon_enable_fixed_width_height',
			[
				'label' => __( 'Enable Fixed Height & Width?', 'acea-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'acea-addons' ),
				'label_off' => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'acea_modal_btn_icon_fixed_width_height',
			[
				'label' => __( 'Fixed Height & Width', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'acea-addons' ),
				'label_on' => __( 'Custom', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'condition' => [
					'acea_modal_btn_icon_enable_fixed_width_height' => 'yes'
				]
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'acea_modal_btn_icon_fixed_width',
			[
				'label'      => esc_html__( 'Width', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 70
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'width: {{SIZE}}{{UNIT}};'

				],
				'condition' => [
					'acea_modal_btn_icon_enable_fixed_width_height' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'acea_modal_btn_icon_fixed_height',
			[
				'label'      => esc_html__( 'Height', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px'     => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'    => [
					'unit'   => 'px',
					'size'   => 70
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'height: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'acea_modal_btn_icon_enable_fixed_width_height' => 'yes'
				]
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'acea_modal_btn_icon_width',
			[
				'label'        => esc_html__( 'Width', 'acea-addons' ),
				'type'         => Controls_Manager::SLIDER,
				'size_units'   => [ 'px', '%' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'default'      => [
					'unit'     => 'px',
					'size'     => 70
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'width: {{SIZE}}{{UNIT}};'
				],
				'condition' => [
					'acea_modal_btn_icon_enable_fixed_width_height!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'               => 'acea_modal_btn_icon_border_normal',
				'selector'           => '{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon'
			]
		);

		$this->add_responsive_control(
			'acea_modal_btn_icon_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_responsive_control(
			'acea_modal_btn_icon_padding',
			[
				'label'        => __( 'Padding', 'acea-addons' ),
				'type'         => Controls_Manager::DIMENSIONS,
				'size_units'   => [ 'px', '%' ],
				'default'      => [
					'top'      => '20',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'unit'     => 'px',
					'isLinked' => false
				],
				'selectors'    => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

	$this->end_controls_tab();

	$this->start_controls_tab( 'acea_modal_btn_icon_color_hover_tab', [ 'label' => esc_html__( 'Hover', 'acea-addons' ) ] );

		$this->add_control(
			'acea_modal_btn_icon_color_hover',
			[
				'label'     => __( 'Text Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'acea_modal_btn_icon_background_hover',
			[
				'label'     => __( 'Background Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#EF2469',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon:hover' => 'background-color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acea_modal_btn_icon_border_hover',
				'selector' => '{{WRAPPER}} .acea-modal-wrapper span.acea-midal-btn-icon:hover'
			]
		);

	$this->end_controls_tab();
	$this->end_controls_tabs();

  $this->end_controls_section();


		/**
		 * Modal Popup Container section
		 */
		$this->start_controls_section(
			'acea_modal_container_section',
			[
				'label' => __( 'Container', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'acea_modal_content_align',
			[
				'label'     => __( 'Alignment', 'acea-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'default'   => 'center',
				'options'   => [
					'left'  => [
						'title' => __( 'Left', 'acea-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'acea-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'     => [
						'title' => __( 'Right', 'acea-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors' => [
					'{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element' => 'text-align: {{VALUE}};'
				],
				'condition' => [
					'acea_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_responsive_control(
			'acea_modal_content_height',
			[
				'label' => __( 'Contant Height for Tablet & Mobile', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'        => [
					'px'       => [
						'min'  => 0,
						'max'  => 500,
						'step' => 1
					],
					'%'        => [
						'min'  => 0,
						'max'  => 100
					]
				],
				'selectors' => [
					'{{WRAPPER}} .acea-modal-item.modal-vimeo' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'acea_modal_image_gallery_description_typography',
				'selector'  => '{{WRAPPER}} .acea-modal-content .acea-modal-element .acea-modal-element-card .acea-modal-element-card-body p',
				'condition' => [
					'acea_modal_content' => [ 'image-gallery' ]
				]
			]
		);

		$this->add_control(
			'acea_modal_image_gallery_description_color',
			[
				'label'     => __( 'Description Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-modal-content .acea-modal-element .acea-modal-element-card .acea-modal-element-card-body p'  => 'color: {{VALUE}};'
				],
				'condition' => [
					'acea_modal_content' => [ 'image-gallery' ]
				]
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acea_modal_content_border',
				'selector' => '{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element'
			]
		);

		$this->add_control(
			'acea_modal_image_gallery_bg',
			[
				'label'     => __( 'Background Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element'  => 'background: {{VALUE}};'
				],
				'condition' => [
					'acea_modal_content' => ['image-gallery', 'html_content']
				]
			]
		);

		$this->add_control(
			'acea_modal_image_gallery_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '10',
					'right'  => '10',
					'bottom' => '10',
					'left'   => '10',
					'unit'   => 'px'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element .acea-modal-element-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'acea_modal_content' => [ 'image-gallery', 'html_content' ]
				]
			]
		);

        $this->add_responsive_control(
            'acea_modal_image_gallery_description_margin',
            [
                'label'      => __('Margin(Description)', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-modal-item .acea-modal-content .acea-modal-element .acea-modal-element-card-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
				'condition'  => [
					'acea_modal_content' => [ 'image-gallery' ]
				]
            ]
        );

		$this->add_control(
			'acea_modal_overlay_overflow_x',
			[
				'label'        => __( 'Overflow X', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'acea-addons' ),
				'label_off'    => __( 'No', 'acea-addons' ),
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'acea_modal_overlay_overflow_y',
			[
				'label'        => __( 'Overflow Y', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'acea-addons' ),
				'label_off'    => __( 'No', 'acea-addons' ),
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'acea_modal_animation_tab',
			[
				'label' => __( 'Animation', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'acea_modal_transition',
			[
				'label'   => __( 'Style', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-to-middle',
				'options' => [
					'top-to-middle'    => __( 'Top To Middle', 'acea-addons' ),
					'bottom-to-middle' => __( 'Bottom To Middle', 'acea-addons' ),
					'right-to-middle'  => __( 'Right To Middle', 'acea-addons' ),
					'left-to-middle'   => __( 'Left To Middle', 'acea-addons' ),
					'zoom-in'          => __( 'Zoom In', 'acea-addons' ),
					'zoom-out'         => __( 'Zoom Out', 'acea-addons' ),
					'left-rotate'      => __( 'Rotation', 'acea-addons' )
				]
			]
		);

		$this->end_controls_section();

		/**
		 * Modal Popup overlay style
		 */

		$this->start_controls_section(
			'acea_modal_overlay_tab',
			[
				'label'     => __( 'Overlay', 'acea-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_modal_overlay' => 'yes'
				]
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'            => 'acea_modal_overlay_color',
                'types'           => [ 'classic' ],
                'selector'        => '{{WRAPPER}} .acea-modal-overlay',
                'fields_options'  => [
                    'background'  => [
                        'default' => 'classic'
                    ],
                    'color'       => [
                        'default' => 'rgba(0,0,0,.5)'
                    ]
                ]
            ]
        );

		$this->end_controls_section();

		/**
		 * Modal Popup Close button style
		 */

		$this->start_controls_section(
			'acea_modal_close_btn_style',
			[
				'label' => __( 'Close Button', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'acea_modal_close_btn_position',
			[
				'label' => __( 'Close Button Position', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'acea-addons' ),
				'label_on' => __( 'Custom', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
        );

        $this->start_popover();

            $this->add_responsive_control(
                'acea_modal_close_btn_position_x_offset',
                [
                    'label' => __( 'X Offset', 'acea-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'acea_modal_close_btn_position_y_offset',
                [
                    'label' => __( 'Y Offset', 'acea-addons' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => -4000,
                            'max' => 4000,
                        ],
                        '%' => [
                            'min' => -100,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_popover();

		$this->add_responsive_control(
            'acea_modal_close_btn_icon_size',
            [
				'label'      => __( 'Icon Size', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
                    'px'       => [
						'min'  => 0,
						'max'  => 30,
                    ],
                ],
                'default'   => [
                    'unit'  => 'px',
                    'size'  => 20
                ],
                'selectors' => [
					'{{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn span::before' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn span::after' => 'height: {{SIZE}}{{UNIT}}'
                ],
            ]
        );

        $this->add_control(
			'acea_modal_close_btn_color',
			[
				'label'     => __( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn span::before, {{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn span::after'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'acea_modal_close_btn_bg_color',
			[
				'label'    => __( 'Background Color', 'acea-addons' ),
				'type'     => Controls_Manager::COLOR,
				'default'  => 'transparent',
				'selectors' => [
					'{{WRAPPER}} .acea-modal-item.modal-vimeo .acea-modal-content .acea-close-btn'  => 'background: {{VALUE}};'
				]
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings            = $this->get_settings_for_display();

		if( 'youtube' === $settings['acea_modal_content'] ){
			$url = $settings['acea_modal_youtube_video_url'];

			preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);

			$youtube_id = $matches[1];
		}

		if( 'vimeo' === $settings['acea_modal_content'] ){
			$vimeo_url       = $settings['acea_modal_vimeo_video_url'];
			$vimeo_id_select = explode('/', $vimeo_url);
			$vidid           = explode( '&', str_replace('https://vimeo.com', '', end($vimeo_id_select) ) );
			$vimeo_id        = $vidid[0];
		}

		$this->add_render_attribute( 'acea_modal_action', [
			'class'             => 'acea-modal-image-action image-modal',
			'data-acea-modal'   => '#acea-modal-' . $this->get_id(),
			'data-acea-overlay' => esc_attr( $settings['acea_modal_overlay'] )
		] );

		$this->add_render_attribute( 'acea_modal_overlay', [
			'class'                         => 'acea-modal-overlay',
			'data-acea_overlay_click_close' => $settings['acea_modal_overlay_click_close']
		] );

		$this->add_render_attribute( 'acea_modal_item', 'class', 'acea-modal-item' );
		$this->add_render_attribute( 'acea_modal_item', 'class', 'modal-vimeo' );
		$this->add_render_attribute( 'acea_modal_item', 'class', $settings['acea_modal_transition'] );
		$this->add_render_attribute( 'acea_modal_item', 'class', $settings['acea_modal_content'] );
		$this->add_render_attribute( 'acea_modal_item', 'class', esc_attr('acea-content-overflow-x-' . $settings['acea_modal_overlay_overflow_x'] ) );
		$this->add_render_attribute( 'acea_modal_item', 'class', esc_attr('acea-content-overflow-y-' . $settings['acea_modal_overlay_overflow_y'] ) );
		?>

		<div class="acea-modal">
			<div class="acea-modal-wrapper">

				<div class="acea-modal-button acea-modal-btn-fixed-width-<?php echo esc_attr($settings['acea_modal_btn_enable_fixed_width_height']);?>">
					<a href="#" <?php echo $this->get_render_attribute_string('acea_modal_action');?> >
					<?php if( 'left' === $settings['acea_modal_btn_icon_align'] && !empty( $settings['acea_modal_btn_icon']['value'] ) ): ?>
						<span class="acea-midal-btn-icon modal-icon-<?php echo esc_attr($settings['acea_modal_btn_icon_align']);?>">
							<?php Icons_Manager::render_icon( $settings['acea_modal_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?> 
						</span>
						<?php endif; ?>
						<span> <?php	echo esc_html( $settings['acea_modal_btn_text'] ); ?></span>
						<?php if( 'right' === $settings['acea_modal_btn_icon_align'] && !empty( $settings['acea_modal_btn_icon']['value'] ) ): ?>
						<span class="acea-midal-btn-icon modal-icon-<?php echo esc_attr($settings['acea_modal_btn_icon_align']);?>" >
							<?php Icons_Manager::render_icon( $settings['acea_modal_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
						<?php endif; ?>
					</a>
				</div>

				<div id="acea-modal-<?php echo esc_attr( $this->get_id() );?>" <?php echo $this->get_render_attribute_string('acea_modal_item') ;?> >
					<div class="acea-modal-content">
						<div class="acea-modal-element <?php echo esc_attr( $settings['acea_modal_image_gallery_column'] );?>">
							<?php if ( 'image' === $settings['acea_modal_content'] ) {
								echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'acea_modal_image' );
							}

							if ( 'image-gallery' === $settings['acea_modal_content'] ) {
								foreach ( $settings['acea_modal_image_gallery_repeater'] as $gallery ) : ?>
									<div class="acea-modal-element-card">
										<div class="acea-modal-element-card-thumb">
											<?php echo Group_Control_Image_Size::get_attachment_image_html( $gallery, 'thumbnail', 'acea_modal_image_gallery' );?>
										</div>
										<?php if ( !empty( $gallery['acea_modal_image_gallery_text'] ) ) {?>
											<div class="acea-modal-element-card-body">
												<p><?php echo wp_kses_post( $gallery['acea_modal_image_gallery_text'] );?></p>
											</div>
										<?php } ;?>
									</div>
								<?php
								endforeach;
							}

							if ( 'html_content' === $settings['acea_modal_content'] ) { ?>
								<div class="acea-modal-element-body">
									<p><?php echo wp_kses_post( $settings['acea_modal_html_content'] );?></p>
								</div>
							<?php }

							if ( 'youtube' === $settings['acea_modal_content'] ) { ?>
								<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $youtube_id );?>" frameborder="0" allowfullscreen></iframe>
							<?php }

							if ( 'vimeo' === $settings['acea_modal_content'] ) { ?>
								<iframe id="vimeo-video" src="https://player.vimeo.com/video/<?php echo esc_attr( $vimeo_id );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'external-video' === $settings['acea_modal_content'] ) { ?>
								<video class="acea-video-hosted" src="<?php echo esc_url( $settings['acea_modal_external_video']['url'] );?>" controls="" controlslist="nodownload">
								</video>
							<?php }

							if ( 'external_page' === $settings['acea_modal_content'] ) { ?>
								<iframe src="<?php echo esc_url( $settings['acea_modal_external_page_url'] );?>" frameborder="0" allowfullscreen ></iframe>
							<?php }

							if ( 'shortcode' === $settings['acea_modal_content'] ) {
								echo do_shortcode( $settings['acea_modal_shortcode'] );
							} ;?>

							<div class="acea-close-btn">
								<span></span>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div <?php echo $this->get_render_attribute_string('acea_modal_overlay');?>></div>
		</div>
	<?php
	}
}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Modal_Popup() );