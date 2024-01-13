<?php
namespace Acea\Widgets\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Acea\Elementor\Traits\Button_Markup;
class Acea_Creative_Button extends Widget_Base {
	 use Button_Markup;
    /**
     * Get widget name.
     */
    public function get_name() {
		return 'acea-creative-button';
	}
    /**
     * Get widget title.
     */
    public function get_title() {
        return __( 'Acea Creative Button', 'acea-addons' );
    }
    /**
     * Get widget icon.
     */
    public function get_icon() {
		return 'eicon-button';
    }
    /**
     * Get widget category.
     */
    public function get_categories() {
		return [ 'acea-addons' ];
	}
    public function get_keywords() {
        return [ 'button', 'btn', 'advance', 'link', 'creative', 'creative-button', 'acea' ];
    }
	/**
     * Register widget content controls
     */
    protected function register_controls() {
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Creative Button', 'acea-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
		$this->add_control(
			'btn_style',
			[
				'label'   => __( 'Style', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hermosa',
				'options' => [
					'hermosa'   => __( 'Hermosa', 'acea-addons' ),
					'montino'   => __( 'Montino', 'acea-addons' ),
					'iconica'   => __( 'Iconica', 'acea-addons' ),
					'symbolab'   => __( 'Symbolab', 'acea-addons' ),
					'estilo'   => __( 'Estilo', 'acea-addons' ),
				],
			]
		);
		$this->add_control(
			'estilo_effect',
			[
				'label'   => __( 'Effects', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dissolve',
				'options' =>[
					'dissolve'   => __( 'Dissolve', 'acea-addons' ),
					'slide-down'   => __( 'Slide In Down', 'acea-addons' ),
					'slide-right'   => __( 'Slide In Right', 'acea-addons' ),
					'slide-x'   => __( 'Slide Out X', 'acea-addons' ),
					'cross-slider'   => __( 'Cross Slider', 'acea-addons' ),
					'slide-y'   => __( 'Slide Out Y', 'acea-addons' ),
				],
                'condition' => [
                    'btn_style' => 'estilo'
                ]
			]
		);
		$this->add_control(
			'symbolab_effect',
			[
				'label'   => __( 'Effects', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'back-in-right',
				'options' =>[
					'back-in-right'   => __( 'Back In Right', 'acea-addons' ),
					'back-in-left'   => __( 'Back In Left', 'acea-addons' ),
					'back-out-right'   => __( 'Back Out Right', 'acea-addons' ),
					'back-out-left'   => __( 'Back Out Left', 'acea-addons' ),
				],
                'condition' => [
                    'btn_style' => 'symbolab'
                ]
			]
		);
		$this->add_control(
			'iconica_effect',
			[
				'label'   => __( 'Effects', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide-in-down',
				'options' =>[
					'slide-in-down'   => __( 'Slide In Down', 'acea-addons' ),
					'slide-in-top'   => __( 'Slide In Top', 'acea-addons' ),
					'slide-in-right'   => __( 'Slide In Right', 'acea-addons' ),
					'slide-in-left'   => __( 'Slide In Left', 'acea-addons' ),
				],
                'condition' => [
                    'btn_style' => 'iconica'
                ]
			]
		);
		$this->add_control(
			'montino_effect',
			[
				'label'   => __( 'Effects', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'winona',
				'options' =>[
					'winona'   => __( 'Winona', 'acea-addons' ),
					'rayen'   => __( 'Rayen', 'acea-addons' ),
					'aylen'   => __( 'Aylen', 'acea-addons' ),
					'wapasha'   => __( 'Wapasha', 'acea-addons' ),
					'nina'   => __( 'Nina', 'acea-addons' ),
					'antiman'   => __( 'Antiman', 'acea-addons' ),
					'sacnite'   => __( 'Sacnite', 'acea-addons' ),
				],
                'condition' => [
                    'btn_style' => 'montino'
                ]
			]
		);
		$this->add_control(
			'hermosa_effect',
			[
				'label'   => __( 'Effects', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'exploit',
				'options' =>[
					'exploit'   => __( 'Exploit', 'acea-addons' ),
					'upward'   => __( 'Upward', 'acea-addons' ),
					'newbie'   => __( 'Newbie', 'acea-addons' ),
					'render'   => __( 'Render', 'acea-addons' ),
					'reshape'   => __( 'Reshape', 'acea-addons' ),
					'expandable'   => __( 'Expandable', 'acea-addons' ),
					'downhill'   => __( 'Downhill', 'acea-addons' ),
					'bloom'   => __( 'Bloom', 'acea-addons' ),
					'roundup'   => __( 'Roundup', 'acea-addons' ),
				],
                'condition' => [
                    'btn_style' => 'hermosa'
                ]
			]
		);
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'acea-addons' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );
		$this->add_control(
			'button_link',
			array(
				'label'         => __( 'Link', 'acea-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'acea-addons' ),
				'show_external' => true,
				'default'       => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => true,
				),
			)
		);
		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'acea-addons' ),
				'description' => __( 'Please set an icon for the button.', 'acea-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'exclude_inline_options' => [ 'svg' ],
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);
        $this->add_responsive_control(
            'align_x',
            [
                'label' => __( 'Alignment', 'acea-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'acea-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'magnetic_enable',
            [
                'label'        => __('Magnetic Effect', 'acea-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'label_block'  => false,
                'return_value' => 'yes',
				'separator' => 'before'
            ]
        );
		$this->add_control(
			'threshold',
			[
				'label' => __( 'Threshold', 'acea-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 30,
				'condition' => [
                    'magnetic_enable' => 'yes'
				],
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn' => 'margin: {{VALUE}}px;',
                ],
			]
		);
	$this->end_controls_section();
	/**
	 * Style section for Estilo, Symbolab, Iconica
	 *
	 * @return void
	 */
        $this->start_controls_section(
            '_estilo_symbolab_iconica_style_section',
            [
                'label' => __( 'Common', 'acea-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);
		$this->add_responsive_control(
			'button_width',
			[
				'label' => __('Button Width', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			],
		);
		$this->add_responsive_control(
			'button_height',
			[
				'label' => __('Button Height', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => ' min-height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
				]
		);
		$this->add_responsive_control(
			'button_item_width',
			[
				'label' => __('Size', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acea-creative-btn.acea-eft--downhill' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-creative-btn.acea-eft--roundup' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-creative-btn.acea-eft--roundup .progress' => 'width: calc({{SIZE}}{{UNIT}} - (({{SIZE}}{{UNIT}} / 100) * 20) ); height:auto;',
				],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'downhill',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);
		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => __('Icon Size', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors' => [
					'{{WRAPPER}} .acea-creative-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'symbolab',
								],
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'iconica',
								],
							],
						],
						[
							'relation' => 'and',
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'expandable',
								],
							],
						]
					]
				],
			]
		);
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => __( 'Typography', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-creative-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
				'exclude' => ['color'], //remove border color
                'selector' => '{{WRAPPER}} .acea-creative-btn, {{WRAPPER}} .acea-creative-btn.acea-eft--bloom div',
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );
        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'acea-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--hermosa.acea-eft--bloom div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'button_hermosa_roundup_stroke_width',
			[
				'label' => __('Stroke Width', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .acea-creative-btn.acea-eft--roundup' => '--ha-ctv-btn-stroke-width: {{SIZE}}{{UNIT}};',
				],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
			]
		);
		$this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'acea-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--iconica > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--montino.acea-eft--winona > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--montino.acea-eft--winona::after' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--montino.acea-eft--rayen > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--montino.acea-eft--rayen::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--montino.acea-eft--nina' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--montino.acea-eft--nina::before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-creative-btn.acea-stl--hermosa.acea-eft--bloom span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator' => 'before'
            ]
		);
		$conditions = [
			'terms' => [
				[
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'hermosa_effect',
							'operator' => '!=',
							'value' => 'roundup',
						],
					],
				],
				[
					'terms' => [
						[
							'name' => 'btn_style',
							'operator' => '!=',
							'value' => '',
						],
					],
				]
			]
		];
		$this->start_controls_tabs( '_tabs_button' );
        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'acea-addons' ),
            ]
		);
        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => '--ha-ctv-btn-txt-clr: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => '--ha-ctv-btn-bg-clr: {{VALUE}}',
                ],
				'conditions' => $conditions,
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg',
				'label' => __( 'Background Advacne', 'acea-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn',
			]
		);
        $this->add_control(
            'button_border_color',
            [
                'label' => __( 'Border Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => '--ha-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );
        $this->add_control(
            'button_roundup_circle_color',
            [
                'label' => __( 'Circle Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn.acea-eft--roundup' => '--ha-ctv-btn-border-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
            ]
        );
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .acea-creative-btn'
            ]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
            '_tabs_button_hover',
            [
                'label' => __( 'Hover', 'acea-addons' ),
            ]
		);
		$this->add_control(
            'button_hover_text_color',
            [
                'label' => __( 'Text Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => '--ha-ctv-btn-txt-hvr-clr: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => '--ha-ctv-btn-bg-hvr-clr: {{VALUE}}',
                ],
				'conditions' => $conditions,
            ]
        );
        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn' => '--ha-ctv-btn-border-hvr-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '!=',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '!=',
									'value' => '',
								],
								[
									'name' => 'button_border_border',
									'operator' => '!=',
									'value' => '',
								],
							],
						]
					]
				]
            ]
        );
        $this->add_control(
            'button_hover_roundup_circle_color',
            [
                'label' => __( 'Circle Color', 'acea-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-creative-btn-wrap .acea-creative-btn.acea-eft--roundup' => '--ha-ctv-btn-border-hvr-clr: {{VALUE}}',
                ],
                'conditions' => [
					'terms' => [
						[
							'relation' => 'or',
							'terms' => [
								[
									'name' => 'hermosa_effect',
									'operator' => '==',
									'value' => 'roundup',
								],
							],
						],
						[
							'terms' => [
								[
									'name' => 'btn_style',
									'operator' => '==',
									'value' => 'hermosa',
								],
							],
						]
					]
				]
            ]
        );
		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .acea-creative-btn:hover'
            ]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
    protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'wrap', 'data-magnetic', $settings['magnetic_enable'] ? $settings['magnetic_enable'] : 'no' );
		$this->{'render_' . $settings['btn_style'] . '_markup'}($settings);
	}
}
$widgets_manager->register_widget_type(new \Acea\Widgets\Elementor\Acea_Creative_Button());