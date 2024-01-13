<?php
namespace Acea_Addons\Widgets;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
use \Elementor\Repeater;
class Acea_Pricing_Box extends Widget_Base {
	//use ElementsCommonFunctions;
	public function get_name() {
		return 'acea-addons-pricing-box';
	}
	public function get_title() {
		return __( 'Pricing Table Box', 'acea-addons' );
	}
	public function get_icon() {
		return 'eicon-price-table';
	}
	public function get_categories() {
		return [ 'acea-addons' ];
	}
	public function get_keywords() {
        return ['price', 'package', 'product', 'plan', 'acea' ];
    }
	protected function register_controls() {
		/**
  		 * Pricing Table Feature
  		 */
  		$this->start_controls_section(
  			'acea_addons_section_pricing_table_feature',
  			[
  				'label' => esc_html__( 'Features', 'acea-addons' )
  			]
		);
		$this->add_control(
			'acea_addons_pricing_table_feature_heading_enable',
			[
				'label'        => esc_html__( 'Feature heading?', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		$this->add_control(
			'acea_addons_pricing_feature_heading',
			[
				'label'       => esc_html__( 'Feature Heading', 'acea-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'condition'   => [
					'acea_addons_pricing_table_feature_heading_enable' => 'yes'
				]
			]
		);
		$pricing_repeater = new Repeater();
		$pricing_repeater->add_control(
			'acea_addons_pricing_table_item',
			[
				'name'        => 'acea_addons_pricing_table_item',
				'label'       => esc_html__( 'List Item', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Pricing table list item', 'acea-addons' )
			]
		);
		$pricing_repeater->add_control(
			'acea_addons_pricing_table_list_icon',
			[
				'name'        => 'acea_addons_pricing_table_list_icon',
				'label'       => esc_html__( 'List Icon', 'acea-addons' ),
				'type'        => Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid'
				]
			]
		);
		$pricing_repeater->add_control(
			'acea_addons_pricing_table_icon_mood',
			[
				'name'         => 'acea_addons_pricing_table_icon_mood',
				'label'        => esc_html__( 'Item Active?', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes'
			]
        );
  		$this->add_control(
			'acea_addons_pricing_table_items',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'  => $pricing_repeater->get_controls(),
				'seperator'   => 'before',
				'default'     => [
					[ 'acea_addons_pricing_table_item' => esc_html__( 'Responsive Live', 'acea-addons' ) ],
					[ 'acea_addons_pricing_table_item' => esc_html__( 'Adaptive Bitrate', 'acea-addons' ) ],
					[ 'acea_addons_pricing_table_item' => esc_html__( 'Analytics', 'acea-addons' ) ],
					[
						'acea_addons_pricing_table_item'      => esc_html__( 'Creative Layouts', 'acea-addons' ),
						'acea_addons_pricing_table_icon_mood' => 'no'
					],
					[
						'acea_addons_pricing_table_item'      => esc_html__( 'Free Support', 'acea-addons' ),
						'acea_addons_pricing_table_icon_mood' => 'no'
					]
				],
				'title_field' => '{{acea_addons_pricing_table_item}}'
			]
		);
		$this->end_controls_section();
		/**
  		 * Pricing Table Promo label
  		 */
  		$this->start_controls_section(
			'acea_addons_section_pricing_table_promo_section',
			[
				'label' => esc_html__( 'Promo Label', 'acea-addons' )
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_promo_enable',
			[
				'label'        => esc_html__( 'Promo Label?', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_promo_title',
			[
				'label'       => esc_html__( 'Title', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'Recommended', 'acea-addons' ),
				'condition'   => [
					'acea_addons_pricing_table_promo_enable' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_promo_position',
			[
				'label'        => __( 'Position', 'acea-addons' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'promo_top',
				'options'      => [
					'promo_top'    => __( 'Top', 'acea-addons' ),
					'promo_bottom' => __( 'Bottom', 'acea-addons' ),
				],
				'condition'    => [
					'acea_addons_pricing_table_promo_enable' => 'yes'
				]
			]
		);
		$this->end_controls_section();
  		/**
  		 * Pricing Table Settings
  		 */
  		$this->start_controls_section(
  			'acea_addons_section_pricing_table_settings',
  			[
  				'label' => esc_html__( 'Header', 'acea-addons' )
  			]
  		);
		  $this->add_control(
			'acea_addons_header_image_show',
			[
				'label'        => esc_html__( 'Show Image', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		$this->add_control(
            'image',
            [
                'label'   => __( 'Choose Image', 'acea-addons' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
				'condition' => [
					'acea_addons_header_image_show' => 'yes'
				]
            ]
        );
  		$this->add_control(
			'acea_addons_pricing_table_title',
			[
				'label'       => esc_html__( 'Title', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'STANDARD', 'acea-addons' )
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_subtitle',
			[
				'label'       => esc_html__( 'Subtitle', 'acea-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_featured',
			[
				'label'        => esc_html__( 'Featured?', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_featured_type',
			[
				'label'     => esc_html__( 'Badge Type', 'acea-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'text-badge',
				'options'   => [
					'text-badge' => __( 'Text Badge', 'acea-addons' ),
					'icon-badge' => __( 'Icon Badge', 'acea-addons' )
				],
				'condition' => [
					'acea_addons_pricing_table_featured' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_featured_tag_text',
			[
				'label'       => esc_html__( 'Featured Text', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'FEATURED', 'acea-addons' ),
				'condition'   => [
					'acea_addons_pricing_table_featured'      => 'yes',
					'acea_addons_pricing_table_featured_type' => 'text-badge'
				]
			]
		);
  		$this->end_controls_section();
  		$this->start_controls_section(
  			'acea_addons_section_pricing_table_price',
  			[
  				'label' => esc_html__( 'Price', 'acea-addons' )
  			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price',
			[
				'label'       => esc_html__( 'Price', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', 'acea-addons' )
			]
		);
  		$this->add_control(
			'acea_addons_pricing_table_price_cur',
			[
				'label'       => esc_html__( 'Price Currency', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', 'acea-addons' )
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_cur_position',
			[
				'label'       => esc_html__( 'Currency Position', 'acea-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'	  => false,
				'label_block' => false,
				'default'     => 'acea-addons-pricing-cur-left',
				'options'     => [
					'acea-addons-pricing-cur-left' => [
						'title' => __( 'Left', 'acea-addons' ),
						'icon'  => 'eicon-angle-left'
					],
					'acea-addons-pricing-cur-right' => [
						'title' => __( 'Right', 'acea-addons' ),
						'icon'  => 'eicon-angle-right'
					]
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_by',
			[
				'label'       => esc_html__( 'Price By', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( 'mo', 'acea-addons' )
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_period_separator',
			[
				'label'       => esc_html__( 'Separated By', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '/', 'acea-addons' )
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_discount_price',
			[
				'label' => __( 'Show Discount Price', 'acea-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'acea-addons' ),
				'label_off' => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_regular_price',
			[
				'label'       => esc_html__( 'Ragular Price', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '50', 'acea-addons' ),
				'condition'   => [
					'acea_addons_pricing_table_discount_price' => 'yes'
				]
			]
		);
  		$this->add_control(
			'acea_addons_pricing_table_regular_price_cur',
			[
				'label'       => esc_html__( 'Regular Price Currency', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'default'     => esc_html__( '$', 'acea-addons' ),
				'condition'   => [
					'acea_addons_pricing_table_discount_price' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_subtitle',
			[
				'label'       => esc_html__( 'Price Subtitle', 'acea-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
  		$this->end_controls_section();
  		/**
  		 * Pricing Table Footer
  		 */
  		$this->start_controls_section(
  			'acea_addons_section_pricing_table_button',
  			[
  				'label' => esc_html__( 'Button', 'acea-addons' )
  			]
		);
		$this->add_control(
			'acea_pricing_table_button',
			[
				'label' => __( 'Show Button', 'acea-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'acea-addons' ),
				'label_off' => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_btn_position',
			[
				'label'   => esc_html__( 'Position', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'middle' => __( 'Middle', 'acea-addons' ),
					'bottom' => __( 'Bottom', 'acea-addons' ),
				],
				  'condition'   => [
					'acea_pricing_table_button' => 'yes'
				]
				]
		);
		$this->add_control(
			'acea_addons_pricing_table_btn',
			[
				'label'       => esc_html__( 'Text', 'acea-addons' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Choose Plan', 'acea-addons' ),
				'condition'   => [
					'acea_pricing_table_button' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_btn_link',
			[
				'label'       => esc_html__( 'Link', 'acea-addons' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,
				'default'     => [
					'url'         => '#',
					'is_external' => ''
     			],
     			'show_external' => true,
				 'condition'   => [
					'acea_pricing_table_button' => 'yes'
				]
			]
		);
		$this->end_controls_section();
		  /**
  		 * Pricing Table Note
  		 */
  		$this->start_controls_section(
			'acea_addons_section_pricing_table_note',
			[
				'label' => esc_html__( 'Note', 'acea-addons' )
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_note_text',
			[
				'label' => __( 'Text', 'acea-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 5,
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Style (Promo label)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_promo_style',
			[
				'label'     => esc_html__( 'Promo Label', 'acea-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_addons_pricing_table_promo_enable' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_promo_alignment',
			[
				'label'     => __( 'Alignment', 'acea-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'toggle'    => false,
				'options'   => [
					'left'      => [
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
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-promo-label' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'acea_addons_pricing_table_promo_background',
				'types'     => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector'  => '{{WRAPPER}} .acea-addons-pricing-table-promo-label',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_promo_typography',
				'label'    => __( 'Typography', 'acea-addons' ),
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-promo-label',
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_promo_text-color',
			[
				'label'     => esc_html__( 'Text Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-promo-label' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_promo_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'unit'     => 'px',
					'isLinked' => false,
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-promo-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_promo_radius',
			[
				'label'      => __( 'Border radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-promo-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Style (Header)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_title_header_settings',
			[
				'label' => esc_html__( 'Header', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_header_alignment',
			[
				'label'         => __( 'Alignment', 'acea-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
					'left'      => [
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
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-header' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_header_type',
			[
				'label'   => esc_html__( 'Header Type', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [
					'simple'        => __( 'Simple', 'acea-addons' ),
					'curved-header' => __( 'Curved Header', 'acea-addons' )
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'acea_addons_pricing_table_header_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .acea-addons-pricing-table-header',
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_header_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_header_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/*
        *Image
        */
        $this->start_controls_section('box_iamge',
            [
                'label' => __('Image', 'apptop-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .pricing-image img',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .pricing-image img',
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'apptop-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['%', 'px','vw'],
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
                    '{{WRAPPER}} .pricing-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'apptop-hp'),
                'type'           => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .pricing-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'apptop-hp'),
                'type'           => Controls_Manager::SLIDER,
                'size_units'     => ['px', 'vh'],
                'range'          => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .pricing-image img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'apptop-hp'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'apptop-hp'),
                    'fill'    => __('Fill', 'apptop-hp'),
                    'cover'   => __('Cover', 'apptop-hp'),
                    'contain' => __('Contain', 'apptop-hp'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .pricing-image img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
		$this->add_control(
            'popover-toggle',
            [
                'label'        => __( 'Image advanced option', 'acea-addons' ),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'Default', 'acea-addons' ),
                'label_on'     => __( 'Custom', 'acea-addons' ),
                'return_value' => 'yes',
            ]
        );
		$this->start_popover();
		$this->add_responsive_control(
			'price-header-image_position_type',
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
					'{{WRAPPER}} .pricing-image img' => 'position:{{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'price-header-image_position_top',
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
					'{{WRAPPER}} .pricing-image img' => 'top:{{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'price-header-image_position_type' => array('relative', 'absolute'),
				),
			)
		);
		$this->add_responsive_control(
			'price-header-image_position_right',
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
					'{{WRAPPER}} .pricing-image img' => 'right:{{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'price-header-image_position_type' => array('relative', 'absolute'),
				),
				'return_value' => '',
			)
		);
		$this->add_responsive_control(
			'price-header-image_position_bottom',
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
					'{{WRAPPER}} .pricing-image img' => 'bottom:{{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'price-header-image_position_type' => array('relative', 'absolute'),
				),
			)
		);
		$this->add_responsive_control(
			'price-header-image_position_left',
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
					'{{WRAPPER}} .pricing-image img' => 'left:{{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'price-header-image_position_type' => array('relative', 'absolute'),
				),
			)
		);
		$this->add_responsive_control(
			'price-header-image_position_from_center',
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
					'{{WRAPPER}} .pricing-image img' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
				),
				'condition' => array(
					'price-header-image_position_type' => array('relative', 'absolute'),
				),
			)
		);
		$this->end_popover();
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'apptop-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-image img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_box_',
            [
                'label'      => __('Border Radius', 'apptop-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .pricing-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .pricing-image img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Style (Title)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_title_style_settings',
			[
				'label' => esc_html__( 'Header Title', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'acea_addons_section_pricing_table_title_heading',
			[
				'label'     => esc_html__( 'Title', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#8a8d91',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-title' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_title_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-title',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 15
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '400'
		            ]
	            ]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '20',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		/**
		 * -------------------------------------------
		 * Style (Sub Title)
		 * -------------------------------------------
		 */
		$this->add_control(
			'acea_addons_section_pricing_table_subtitletitle_heading',
			[
				'label'     => esc_html__( 'Sub Title', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_subtitle_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_subtitle_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-subtitle'
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_subtitle_margin',
			[
				'label'   => esc_html__( 'Margin', 'acea-addons' ),
				'type'    => Controls_Manager::DIMENSIONS,
				'default' => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Style (Pricing)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_price_style_settings',
			[
				'label' => esc_html__( 'Pricing', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_box_separator',
			[
				'label'        => esc_html__( 'Enable Separator', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_price_box_separator_height',
			[
				'label'     => esc_html__( 'Separator Height', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '1',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-price-bottom-separator' => 'height: {{VALUE}}px;'
				],
				'condition' => [
					'acea_addons_pricing_table_price_box_separator' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'            => 'acea_separator_border',
				'selector'        => '{{WRAPPER}} .acea-addons-price-bottom-separator'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_box_separator_color',
			[
				'label'     => esc_html__( 'Separator Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-price-bottom-separator'  => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'acea_addons_pricing_table_price_box_separator' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_price_box_separator_spacing',
			[
				'label'       => esc_html__( 'Separator Spacing', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 30
				],
				'range'       => [
					'px'      => [
						'max' => 50
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-addons-price-bottom-separator' => 'margin: {{SIZE}}px 0;'
				],
				'condition'   => [
					'acea_addons_pricing_table_price_box_separator' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_box',
			[
				'label'        => esc_html__( 'Price Box', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'separator'	   => 'before',
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_price_box_height',
			[
				'label'     => __( 'Box Height', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'height: {{VALUE}}px'
				],
				'condition' => [
					'acea_addons_pricing_table_price_box' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_price_box_width',
			[
				'label'     => __( 'Box Width', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '100',
				'selectors' => [
					'{{WRAPPER}} .price-box' => 'width: {{VALUE}}px'
				],
				'condition' => [
					'acea_addons_pricing_table_price_box' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'acea_addons_pricing_table_price_box_background',
				'types'     => [ 'classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'acea_addons_pricing_table_price_box' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'acea_addons_pricing_table_price_box_border',
				'selector'  => '{{WRAPPER}} .price-box',
				'condition' => [
					'acea_addons_pricing_table_price_box' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_price_box_radius',
			[
				'label'      => __( 'Box Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '50',
					'right'  => '50',
					'bottom' => '50',
					'left'   => '50',
					'unit'   => '%'
				],
				'selectors'  => [
					'{{WRAPPER}} .price-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'condition'  => [
					'acea_addons_pricing_table_price_box' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_tag_heading',
			[
				'label'     => esc_html__( 'Original Price', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_pricing_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price p.acea-addons-pricing-table-new-price'  => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_price_tag_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price p.acea-addons-pricing-table-new-price',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 48
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => -3.2
		                ]
		            ]
	            ]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_regular_price_heading',
			[
				'label'     => esc_html__( 'Regular Price', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' =>  'before',
				'condition' => [
					'acea_addons_pricing_table_discount_price' => 'yes'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_regular_price_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-price.acea-addons-discount-price-yes p.acea-addons-pricing-table-regular-price',
				'condition' => [
					'acea_addons_pricing_table_discount_price' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_regular_price_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-price.acea-addons-discount-price-yes p.acea-addons-pricing-table-regular-price' => 'color: {{VALUE}};'
				],
				'condition' => [
					'acea_addons_pricing_table_discount_price' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_regular_price_right_spacing',
			[
				'label'       => esc_html__( 'Regular Price Right Spacing', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 10
				],
				'range'       => [
					'px'      => [
						'max' => 100
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-addons-pricing-table-price.acea-addons-discount-price-yes p.acea-addons-pricing-table-regular-price' => 'margin-right: {{SIZE}}px;'
				],
				'condition' => [
					'acea_addons_pricing_table_discount_price' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_pricing_curency_heading',
			[
				'label'     => esc_html__( 'Pricing Curency', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_pricing_curency_spacing',
			[
				'label' => __( 'Spacing', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'acea-addons' ),
				'label_on' => __( 'Custom', 'acea-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->start_popover();
			$this->add_responsive_control(
				'acea_addons_pricing_table_pricing_curency_bottom_spacing',
				[
					'label'      => esc_html__( 'Bottom Spacing', 'acea-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => -100,
							'max'  => 100,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price span.acea-addons-pricing-table-currency' => 'top: {{SIZE}}{{UNIT}};'
					],
				]
			);
            $this->add_responsive_control(
				'acea_addons_pricing_table_pricing_curency_right_spacing',
				[
					'label'      => esc_html__( 'Right Spacing', 'acea-addons' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range'      => [
						'px'     => [
							'min'  => 0,
							'max'  => 200,
							'step' => 1
						],
					],
					'selectors'  => [
						'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price span.acea-addons-pricing-table-currency' => 'margin-right: {{SIZE}}{{UNIT}};'
					],
				]
			);
        $this->end_popover();
		$this->add_control(
			'acea_addons_pricing_table_pricing_curency_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price span.acea-addons-pricing-table-currency' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_price_curency_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price span.acea-addons-pricing-table-currency',
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_pricing_period_heading',
			[
				'label'     => esc_html__( 'Pricing By', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_pricing_period_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price span.acea-addons-price-period' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_price_preiod_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-price-period',
				'fields_options'   => [
					'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 20
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ],
		              'letter_spacing' => [
		                'default'      => [
		                    'unit'     => 'px',
		                    'size'     => 0
		                ]
		            ]
	            ]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_subtitle_heading',
			[
				'label'     => esc_html__( 'Price Subtitle', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_price_subtitle_color',
			[
				'label'     => esc_html__( 'Text Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price-subtitle' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_price_subtitle_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price-subtitle',
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_price_subtitle_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '',
					'right'  => '',
					'bottom' => '',
					'left'   => '',
					'unit'   => 'px',
					'islinked' => true
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-price-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Style (Feature List)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_style_featured_list_settings',
			[
				'label' => esc_html__( 'Feature List', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_table_feature_heading_typography',
				'label' => __('Heading Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea_addons_pricing_feature_heading',
				'condition'   => [
					'acea_addons_pricing_table_feature_heading_enable' => 'yes'
				]
			]
		);
		$this->add_control(
			'pricing_table_feature_heading__color',
			[
				'label'     => esc_html__( 'Heading Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea_addons_pricing_feature_heading' => 'color: {{VALUE}};'
				],
				'condition'   => [
					'acea_addons_pricing_table_feature_heading_enable' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
            'heading_wrapper_margin',
            [
                'label' => __('Heading wrapper Margin', 'acea-addons'),
                'type' =>Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .acea_addons_pricing_feature_heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'condition'   => [
					'acea_addons_pricing_table_feature_heading_enable' => 'yes'
				]
            ]
        );
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_list_item_typography',
				'label' => __('Feature Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-features li'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li span.acea-addons-pricing-li-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acea-addons-pricing-table-features li span.acea-addons-pricing-li-icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_item_color',
			[
				'label'     => esc_html__( 'Item Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#132c47',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
            'feature_area_height',
            [
                'label' => __( 'Feature Area Height', 'acea-addons' ),
                'type' => Controls_Manager::SLIDER,
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
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
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-pricing-table-features' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'acea_addons_pricing_table_list_border_bottom',
			[
				'label'        => __( 'List Border Bottom', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'acea-addons' ),
				'label_off'    => __( 'Hide', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_border_bottom_style',
			[
				'label'     => __( 'List Border Bottom Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'defailt'   => '#e5e5e5',
				'selectors' => [
					'{{WRAPPER}} .list-border-bottom li:not(:last-child)' => 'border-bottom:1px solid {{VALUE}};'
				],
				'condition' => [
					'acea_addons_pricing_table_list_border_bottom' => 'yes'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_disable_item_styling',
			[
				'label'     => esc_html__( 'Disable Items', 'acea-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_disable_item_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li.acea-addons-pricing-table-features-disable span.acea-addons-pricing-li-icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .acea-addons-pricing-table-features li.acea-addons-pricing-table-features-disable span.acea-addons-pricing-li-icon svg path' => 'fill: {{VALUE}};'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_disable_item_color',
			[
				'label'     => esc_html__( 'Item color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#a6a9ad',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li.acea-addons-pricing-table-features-disable' => 'color: {{VALUE}};'
				]
			]
		);
        $this->add_responsive_control(
			'acea_addons_pricing_table_featured_list_icon_size',
			[
				'label'       => esc_html__( 'Icon Size', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-addons-pricing-li-icon' => 'font-size: {{SIZE}}px;'
				]
			]
		);
		$icon_gap = is_rtl() ? 'left' : 'right';
		$this->add_responsive_control(
			'acea_addons_pricing_table_featured_list_icon_space',
			[
				'label'       => esc_html__( 'Icon Space', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 7
				],
				'range'       => [
					'px'      => [
						'max' => 24
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li .acea-addons-pricing-li-icon' => 'margin-'.$icon_gap.': {{SIZE}}px;'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_list_alignment',
			[
				'label'         => __( 'Alignment', 'acea-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
					'flex-start'      => [
						'title' => __( 'Left', 'acea-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center'    => [
						'title' => __( 'Center', 'acea-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'flex-end'     => [
						'title' => __( 'Right', 'acea-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li' => 'justify-content: {{VALUE}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_list_margin',
			[
				'label'      => __( 'Margin All List', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-features' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_list_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '0',
					'bottom'   => '10',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-features li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Featured Tag Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_featured_tag_settings',
			[
				'label'     => esc_html__( 'Featured Badge', 'acea-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_addons_pricing_table_featured' => 'yes'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_featured_tag_font_size',
			[
				'label'       => esc_html__( 'Font Size', 'acea-addons' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => [
					'size'    => 12
				],
				'range'       => [
					'px'      => [
						'max' => 40
					]
				],
				'selectors'   => [
					'{{WRAPPER}} .text-badge'   => 'font-size: {{SIZE}}px;',
					'{{WRAPPER}} .icon-badge i' => 'font-size: {{SIZE}}px;'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_featured_tag_text_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .text-badge'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .icon-badge i' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'acea_addons_pricing_table_featured_text_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .text-badge',
				'condition' => [
					'acea_addons_pricing_table_featured_type' => 'text-badge'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'acea_addons_pricing_table_featured_icon_badge_background',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .icon-badge',
				'condition' => [
					'acea_addons_pricing_table_featured_type' => 'icon-badge'
				]
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Button Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_btn_style_settings',
			[
				'label' => esc_html__( 'Button', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_btn_typography',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action'
			]
		);
		$this->start_controls_tabs( 'acea_addons_pricing_table_button_tabs' );
			// Normal State Tab
			$this->start_controls_tab( 'acea_addons_pricing_table_btn_normal', [ 'label' => esc_html__( 'Normal', 'acea-addons' ) ] );
			$this->add_control(
				'acea_addons_pricing_table_btn_normal_text_color',
				[
					'label'     => esc_html__( 'Text Color', 'acea-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'acea_addons_pricing_table_btn_normal_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'acea-addons' ),
					'type'      => Controls_Manager::COLOR,
                    'default'   => '#F96331',
					'selectors' => [
						'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action' => 'background-color: {{VALUE}};'
					]
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'acea_addons_pricing_table_btn_normal_border',
					'selector'        => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action'
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'acea_addons_pricing_table_btn_box_shadow',
					'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action'
				]
			);
			$this->add_responsive_control(
				'price_btn_width',
				[
					'label' => __('Button Width', 'plugin-domain'),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px', '%'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 600,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .acea-addons-pricing-table-action' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'price_btn_height',
				[
					'label' => __('Button Height', 'plugin-domain'),
					'type' => Controls_Manager::SLIDER,
					'size_units' => ['px', '%'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 600,
						],
						'%' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .acea-addons-pricing-table-action' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
				);
			$this->end_controls_tab();
			// Hover State Tab
			$this->start_controls_tab( 'acea_addons_pricing_table_btn_hover', [ 'label' => esc_html__( 'Hover', 'acea-addons' ) ] );
			$this->add_control(
				'acea_addons_pricing_table_btn_hover_text_color',
				[
					'label'     => esc_html__( 'Text Color', 'acea-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action:hover' => 'color: {{VALUE}};'
					]
				]
			);
			$this->add_control(
				'show_normal_bg',
				[
					'label' => esc_html__( 'Normal Background', 'plugin-name' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'your-plugin' ),
					'label_off' => esc_html__( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);
			$this->add_control(
				'acea_addons_pricing_table_btn_hover_bg_color',
				[
					'label'     => esc_html__( 'Background Color', 'acea-addons' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#F96331',
					'selectors' => [
						'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action:hover' => 'background-color: {{VALUE}};'
					],
					'condition' => [
						'show_normal_bg' => 'yes'
					],
				]
			);
			$this->add_control(
				'show_normal_gradient',
				[
					'label' => esc_html__( 'Gradient Background', 'plugin-name' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'your-plugin' ),
					'label_off' => esc_html__( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default' => 'no',
				]
			);
			$this->add_group_control(
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'background',
					'label' => esc_html__( 'Background', 'plugin-name' ),
					'types' => [ 'classic', 'gradient', 'video' ],
					'condition' => [
						'show_normal_gradient' => 'yes'
					],
					'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action:hover',
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'            => 'acea_addons_pricing_table_btn_hover_border',
					'selector'        => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action:hover'
				]
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'     => 'acea_addons_pricing_table_btn_box_shadow_hover',
					'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action:hover'
				]
			);
			$this->end_controls_tab();
		$this->end_controls_tabs();
        $this->add_responsive_control(
			'acea_addons_pricing_table_button_border_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'    => '4',
					'right'  => '4',
					'bottom' => '4',
					'left'   => '4'
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_button_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '12',
					'right'    => '30',
					'bottom'   => '12',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_button_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/**
		 * -------------------------------------------
		 * Tab Style (Note Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_table_note_style',
			[
				'label' => esc_html__( 'Note', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_note_alignment',
			[
				'label'         => __( 'Alignment', 'acea-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'default'		=> 'center',
				'options'       => [
					'left'      => [
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
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note' => 'text-align: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'acea_addons_section_pricing_table_note_background',
				'label' => __( 'Background', 'acea-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note',
			]
		);
		$this->add_control(
			'acea_addons_section_pricing_table_note_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note' => 'color: {{VALUE}};'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_addons_section_pricing_table_note_text_typography',
				'label'    => __( 'Typography', 'acea-addons' ),
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acea_addons_section_pricing_table_note_border',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note'
			]
		);
		$this->add_responsive_control(
			'acea_addons_section_pricing_table_note_border_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
        $this->add_responsive_control(
			'acea_addons_section_pricing_table_note_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '10',
					'right'    => '10',
					'bottom'   => '10',
					'left'     => '10',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_section_pricing_table_note_margin',
			[
				'label'      => __( 'Margin', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-wrapper .acea-addons-pricing-table-note' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
        /**
		 * -------------------------------------------
		 * Tab Style (Pricing Table Style)
		 * -------------------------------------------
		 */
		$this->start_controls_section(
			'acea_addons_section_pricing_tables_styles_presets',
			[
				'label' => esc_html__( 'Box', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'acea_addons_pricing_table_bg_color_simple',
				'label' => __( 'Background', 'acea-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper',
				'condition' => [
					'acea_addons_pricing_table_header_type' => 'simple'
				]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'acea-addons' ),
				'seperator' => 'before',
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .acea-addons-pricing-table-header .acea-addons-pricing-table-header-curved svg path' => 'fill: {{VALUE}};'
				],
				'condition' => [
					'acea_addons_pricing_table_header_type' => 'curved-header'
				]
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_content_border',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper'
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_content_box_shadow',
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper',
				'fields_options'         => [
		            'box_shadow_type'    => [
		                'default'        =>'yes'
		            ],
		            'box_shadow'         => [
		                'default'        => [
		                    'horizontal' => 0,
		                    'vertical'   => 13,
		                    'blur'       => 33,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.08)'
		                ]
		            ]
	            ]
			]
		);
		$content_align = is_rtl() ? 'right' : 'left';
		$this->add_control(
			'acea_addons_pricing_table_content_alignment',
			[
				'label'         => __( 'Alignment', 'acea-addons' ),
				'type'          => Controls_Manager::CHOOSE,
				'toggle'        => false,
				'separator'     => 'after',
				'default'       => $content_align,
				'options'       => [
					'left'      => [
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
				]
			]
		);
		$this->add_responsive_control(
            'total_box_height',
            [
                'label' => __( 'Box Height', 'fd-addons' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
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
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'acea_addons_pricing_table_transition_shadow',
				'label'    => __( 'Hover Box Shadow', 'acea-addons' ),
				'selector' => '{{WRAPPER}} .acea-addons-pricing-table-wrapper:hover .acea-addons-pricing-table-badge-wrapper',
				'fields_options'      => [
		            'box_shadow_type' => [
		                'default'     =>'yes'
		            ],
		            'box_shadow'  => [
		                'default' => [
		                    'horizontal' => 0,
		                    'vertical'   => 20,
		                    'blur'       => 40,
		                    'spread'     => 0,
		                    'color'      => 'rgba(51,77,128,0.2)'
		                ]
		            ]
	            ]
			]
		);
		$this->add_control(
			'acea_addons_pricing_table_transition_type',
			[
				'label'   => __( 'Hover Style', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'              =>  __( 'None', 'acea-addons' ),
					'transition_top'    =>  __( 'Transition Top', 'acea-addons' ),
					'transition_bottom' => __( 'Transition Bottom', 'acea-addons' ),
					'transition_zoom'   => __( 'Transition Zoom', 'acea-addons' )
				],
				'default' => 'none'
			]
		);
        $this->add_responsive_control(
			'acea_addons_pricing_table_content_padding',
			[
				'label'      => __( 'Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
					'top'      => '45',
					'right'    => '30',
					'bottom'   => '45',
					'left'     => '30',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'acea_addons_pricing_table_content_border_radius',
			[
				'label'      => __( 'Border Radius', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'default'    => [
                    'top'      => '10',
                    'right'    => '10',
                    'bottom'   => '10',
                    'left'     => '10',
                    'unit'     => 'px'
                ],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-pricing-table-badge-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .acea-addons-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .acea-addons-pricing-table-header .acea-addons-pricing-table-header-svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;'
				]
			]
		);
		$this->end_controls_section();
	}
	private function pricing_table_currency( $currency ) {
		return $currency ? '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_price_cur' ).'>'.esc_html( $currency ).'</span>' : '';
	}
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$title         = $settings['acea_addons_pricing_table_title'];
		$sub_title     = $settings['acea_addons_pricing_table_subtitle'];
		$price         = $settings['acea_addons_pricing_table_price'];
		$separator     = $settings['acea_addons_pricing_table_period_separator'];
		$price_by      = $settings['acea_addons_pricing_table_price_by'];
		$featured_text = $settings['acea_addons_pricing_table_featured_tag_text'];
		$this->add_render_attribute(
			'acea_addons_pricing_table_wrapper',
			[
				'class' => [
					'acea-addons-pricing-table-wrapper',
					'acea-addons-pricing-table',
					esc_attr( $settings['acea_addons_pricing_table_content_alignment'] ),
					esc_attr( $settings['acea_addons_pricing_table_transition_type'] )
				]
			]
		);
		$this->add_render_attribute( 'acea_addons_pricing_table_featured_tag_text', 'class', 'acea-addons-pricing-featured-tag-text' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_featured_tag_text', 'none' );
		$this->add_render_attribute( 'acea_addons_pricing_table_promo_title', 'class', 'acea-addons-pricing-table-promo-label' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_promo_title', 'none' );
		$this->add_render_attribute( 'acea_addons_pricing_table_title', 'class', 'acea-addons-pricing-table-title' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_title', 'basic' );
		$this->add_render_attribute( 'acea_addons_pricing_table_subtitle', 'class', 'acea-addons-pricing-table-subtitle' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_subtitle', 'basic' );
		$this->add_render_attribute( 'acea_addons_pricing_table_box_value', 'class', [ 'acea-addons-pricing-table-price', 'acea-addons-discount-price-'.$settings['acea_addons_pricing_table_discount_price'] ] );
		if( 'yes' === $settings['acea_addons_pricing_table_price_box'] ){
			$this->add_render_attribute( 'acea_addons_pricing_table_box_value', 'class', 'price-box' );
		}
		$this->add_render_attribute( 'acea_addons_pricing_table_price_cur', 'class', 'acea-addons-pricing-table-currency' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_price_cur', 'none' );
		$this->add_render_attribute( 'acea_addons_pricing_table_period_separator', 'class', 'acea-addons-pricing-table-currency-separator' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_period_separator', 'none' );
		$this->add_render_attribute( 'acea_addons_pricing_table_price_by', 'class', 'acea-addons-pricing-table-price-by' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_price_by', 'none' );
		$this->add_render_attribute( 'acea_addons_pricing_table_price', 'class', 'acea-addons-pricing-table-price' );
		$this->add_inline_editing_attributes( 'acea_addons_pricing_table_price', 'none' );
		$this->add_render_attribute( 'acea_addons_pricing_table_features', 'class', 'acea-addons-pricing-table-features' );
		if( 'yes' === $settings['acea_addons_pricing_table_list_border_bottom'] ){
			$this->add_render_attribute( 'acea_addons_pricing_table_features', 'class', 'list-border-bottom' );
		}
        $this->add_render_attribute( 'acea_addons_pricing_table_btn_link', 'class', 'acea-addons-pricing-table-action' );
		if( $settings['acea_addons_pricing_table_btn_link']['url'] ) {
            $this->add_render_attribute( 'acea_addons_pricing_table_btn_link', 'href', esc_url( $settings['acea_addons_pricing_table_btn_link']['url'] ) );
	        if( $settings['acea_addons_pricing_table_btn_link']['is_external'] ) {
	            $this->add_render_attribute( 'acea_addons_pricing_table_btn_link', 'target', '_blank' );
	        }
	        if( $settings['acea_addons_pricing_table_btn_link']['nofollow'] ) {
	            $this->add_render_attribute( 'acea_addons_pricing_table_btn_link', 'rel', 'nofollow' );
	        }
        }
        $this->add_inline_editing_attributes( 'acea_addons_pricing_table_btn', 'none' );
		echo '<div '.$this->get_render_attribute_string( 'acea_addons_pricing_table_wrapper' ).'>';
			if( 'promo_top' === $settings['acea_addons_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['acea_addons_pricing_table_promo_enable'] ) {
					echo '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_promo_title' ).'>'.$settings['acea_addons_pricing_table_promo_title'].'</span>';
				}
			}
			echo '<div class="acea-addons-pricing-table-badge-wrapper">';
				if ( 'yes' === $settings['acea_addons_pricing_table_featured'] ) {
					echo '<span class="acea-addons-pricing-table-badge '.esc_attr( $settings['acea_addons_pricing_table_featured_type'] ).'">';
						if( 'text-badge' === $settings['acea_addons_pricing_table_featured_type'] && !empty( $featured_text ) ) {
							echo '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_featured_tag_text' ).'>';
								echo esc_html( $featured_text );
							echo '</span>';
						}
						if( 'icon-badge' === $settings['acea_addons_pricing_table_featured_type'] ) {
							echo '<i class="demo-icon eicon-star"></i>';
						}
					echo '</span>';
				}
				echo '<div class="acea-addons-pricing-table-header">';
					do_action( 'acea_addons_pricing_table_header_wrapper_before' );
					$title ? printf( '<h4 '.$this->get_render_attribute_string( 'acea_addons_pricing_table_title' ).'>%s</h4>', wp_kses_post( $title ) ) : '';
					/* image */
					if($settings['acea_addons_header_image_show'] == 'yes'):
					echo '<div class="pricing-image">';
						echo '<img src="' . $settings['image']['url'] . '">';
					echo '</div>';
					endif;
					$sub_title ? printf( '<div '.$this->get_render_attribute_string( 'acea_addons_pricing_table_subtitle' ).'>%s</div>', wp_kses_post( $sub_title ) ) : '';
					echo '<div '.$this->get_render_attribute_string( 'acea_addons_pricing_table_box_value' ).'>';
						if( 'yes' === $settings['acea_addons_pricing_table_discount_price'] ){
							echo '<p class="acea-addons-pricing-table-regular-price">';
								echo '<span class="acea-addons-pricing-table-regular-price-cur">'.$settings['acea_addons_pricing_table_regular_price_cur'].'</span>';
								echo '<span class="acea-addons-pricing-table-regular-price-text">'.$settings['acea_addons_pricing_table_regular_price'].'</span>';
							echo '</p>';
						}
						echo '<p class="acea-addons-pricing-table-new-price">';
							if( 'acea-addons-pricing-cur-left' === $settings['acea_addons_pricing_table_price_cur_position'] ) :
								echo $this->pricing_table_currency( $settings['acea_addons_pricing_table_price_cur'] );
							endif;
							$price ? printf( '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_price' ).'>%s</span>', esc_html( $price ) ) : '';
							if( 'acea-addons-pricing-cur-right' === $settings['acea_addons_pricing_table_price_cur_position'] ) :
								echo $this->pricing_table_currency( $settings['acea_addons_pricing_table_price_cur'] );
							endif;
							if( $separator || $price_by ) :
								echo '<span class="acea-addons-price-period">';
									$separator ? printf( '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_period_separator' ).'>%s</span>', esc_html( $separator ) ) : '';
									$price_by ? printf( '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_price_by' ).'>%s</span>', esc_html( $price_by ) ) : '';
								echo '</span>';
							endif;
						echo '</p>';
					echo '</div>';
					if( !empty( $settings['acea_addons_pricing_table_price_subtitle'] ) ){
						echo '<span class="acea-addons-pricing-table-price-subtitle">'. $settings['acea_addons_pricing_table_price_subtitle'] .'</span>';
					}
					if ( 'yes' === $settings['acea_addons_pricing_table_price_box_separator'] ) :
						echo '<div class="acea-addons-price-bottom-separator"></div>';
					endif;
					if( 'curved-header' === $settings['acea_addons_pricing_table_header_type'] ) {
						echo '<div class="acea-addons-pricing-table-header-curved">';
							echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 370 20">';
								echo '<path class="st0" d="M0 20h185C70 20 0 0 0 0v20zM185 20h185V0s-70 20-185 20z" />';
							echo '</svg>';
						echo '</div>';
					}
					do_action( 'acea_addons_pricing_table_header_wrapper_after' );
				echo '</div>';
				if( 'middle' === $settings['acea_addons_pricing_table_btn_position'] && !empty( $settings['acea_addons_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				}
				do_action( 'acea_addons_pricing_table_content_wrapper_before' );
				if( !empty( $settings['acea_addons_pricing_feature_heading'] ) ){
					echo '<h4 class="acea_addons_pricing_feature_heading">'. $settings['acea_addons_pricing_feature_heading'] .'</h4>';
				}
				if ( is_array( $settings['acea_addons_pricing_table_items'] ) ) :
					echo '<ul '.$this->get_render_attribute_string( 'acea_addons_pricing_table_features' ).'>';
						foreach( $settings['acea_addons_pricing_table_items'] as $index => $item ) :
							$each_pricing_item = 'link_' . $index;
							$icon_mod = 'yes' !== $item['acea_addons_pricing_table_icon_mood'] ? 'acea-addons-pricing-table-features-disable' : 'acea-addons-pricing-table-features-enable';
							$this->add_render_attribute( $each_pricing_item, 'class', [
								esc_attr( $icon_mod ),
								'elementor-repeater-item-'.esc_attr( $item['_id'] )
							] );
							$pricing_item = $this->get_repeater_setting_key( 'acea_addons_pricing_table_item', 'acea_addons_pricing_table_items', $index );
							$this->add_render_attribute( $pricing_item, 'class', 'acea-addons-pricing-item' );
							$this->add_inline_editing_attributes( $pricing_item, 'none' );
							$price = $item['acea_addons_pricing_table_item'];
							echo '<li '.$this->get_render_attribute_string( $each_pricing_item ).'>';
								if ( !empty( $item['acea_addons_pricing_table_list_icon']['value'] ) ) {
									echo '<span class="acea-addons-pricing-li-icon">';
										Icons_Manager::render_icon( $item['acea_addons_pricing_table_list_icon'] );
									echo '</span>									';
								}
								$price ? printf( '<span '.$this->get_render_attribute_string( $pricing_item ).'>%s</span>', esc_html( $price ) ) : '';
							echo '</li>';
						endforeach;
					echo '</ul>';
				endif;
				do_action( 'acea_addons_pricing_table_content_wrapper_after' );
				if( 'bottom' === $settings['acea_addons_pricing_table_btn_position'] && !empty( $settings['acea_addons_pricing_table_btn'] ) ) {
					$this->pricing_table_btn();
				}
				if( !empty( $settings['acea_addons_pricing_table_note_text'] ) ){
					echo '<div class="acea-addons-pricing-table-note">'.$settings['acea_addons_pricing_table_note_text'].'</div>';
				}
			echo '</div>';
			if( 'promo_bottom' === $settings['acea_addons_pricing_table_promo_position'] ) {
				if( 'yes' === $settings['acea_addons_pricing_table_promo_enable'] ) {
					echo '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_promo_title' ).'>'.$settings['acea_addons_pricing_table_promo_title'].'</span>';
				}
			}
		echo '</div>';
	}
    private function pricing_table_btn() {
		echo '<a '.$this->get_render_attribute_string( 'acea_addons_pricing_table_btn_link' ).'>';
			echo '<span '.$this->get_render_attribute_string( 'acea_addons_pricing_table_btn' ).'>';
				echo esc_html( $this->get_settings_for_display( 'acea_addons_pricing_table_btn' ) );
			echo '</span>';
		echo '</a>';
	}
}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Pricing_Box() );