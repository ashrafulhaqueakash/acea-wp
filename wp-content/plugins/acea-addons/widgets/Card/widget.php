<?php
namespace Acea_Addons\Widgets;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Group_Control_Background;
use \Elementor\Widget_Base;
/**
 * Elementor icon widget.
 *
 * Elementor widget that displays an icon from over 600+ icons.
 *
 * @since 1.0.0
 */
class Acea_Addons_Card extends Widget_Base {
	/**
	 * Get widget name.
	 *
	 * Retrieve icon widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'acea-card';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve icon widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Card', 'acea-addons' );
	}
	/**
	 * Get widget icon.
	 *
	 * Retrieve icon widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-hotspot';
	}
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the icon widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'acea-addons' ];
	}
	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'Card', 'image box', 'acea-addons' ];
	}
	/**
	 * Register icon widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'card_section',
			[
				'label' => __( 'Content', 'acea-addons' ),
			]
		);
        $this->add_control(
			'card_link',
			[
				'label' => esc_html__( 'Card Link', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://example.com', 'plugin-name' ),
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
        $this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'acea-addons'),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
        $this->add_control(
            'heading',
            [
                'label'       => __( 'Heading', 'acea-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Commarcial Affairs', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'content',
            [
                'label'       => __( 'Content', 'acea-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Consectetur adipiscing elit', 'acea-addons' ),
            ]
        );
        $this->add_control(
			'content_footer',
			[
				'label' => esc_html__( 'Contetnt Footer', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_control(
			'user_icon',
			[
				'label' => __('User Icon', 'acea-addons'),
				'type' =>  \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
            'user_content',
            [
                'label'       => __( 'User', 'acea-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Basic', 'acea-addons' ),
            ]
        );
        $this->add_control(
			'clock_icon',
			[
				'label' => __('Clock Icon', 'acea-addons'),
				'type' =>  \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $this->add_control(
            'clock_content',
            [
                'label'       => __( 'Hour Content', 'acea-addons' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( '3.4 hours', 'acea-addons' ),
            ]
        );
		$this->end_controls_section();
		/* 
        *Image
        */
        $this->start_controls_section('box_iamge',
            [
                'label' => __('Image', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'advis-ts'),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .acea-addons-card-images img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'width',
            [
                'label'          => __('Width', 'advis-hp'),
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
                    '{{WRAPPER}} .acea-addons-card-images img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'          => __('Max Width', 'advis-hp'),
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
                    '{{WRAPPER}} .acea-addons-card-images img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'          => __('Height', 'advis-hp'),
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
                    '{{WRAPPER}} .acea-addons-card-images img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'advis-hp'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'advis-hp'),
                    'fill'    => __('Fill', 'advis-hp'),
                    'cover'   => __('Cover', 'advis-hp'),
                    'contain' => __('Contain', 'advis-hp'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-card-images img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_box_',
            [
                'label'      => __('Border Radius', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-images img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-images img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_box_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-images img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-images img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'advis-ts'),
            ]
        );
        $this->add_control(
            'image_hover_style',
            [
                'label'             => __('Hover Style', 'advis-hp'),
                'type'              => Controls_Manager::SELECT,
                'default'           => 'hover-default',
                'options'           => [
                    'hover-default' =>   __('Default',    'advis-hp'),
                    'hover-one'     =>   __('Style 01',    'advis-hp'),
                ],
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
		/* 	
        *Title
        */
        $this->start_controls_section('card_title',
            [
                'label' => __('Title', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'advis-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-card-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'advis-hp'),
                'selector' => '{{WRAPPER}}  .acea-addons-card-title',
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
		/* 
        *Discription
        */
        $this->start_controls_section('card_dis',
            [
                'label' => __('Discription', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'advis-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-card-discription' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'advis-hp'),
                'selector' => '{{WRAPPER}}  .acea-addons-card-discription',
            ]
        );
        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-discription' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-discription' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /*
        * content footer
        */ 
        $this->start_controls_section('card_content_footer',
            [
                'label' => __('Content Footer', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
		);
        $this->add_control(
            'content_icon_color',
            [
                'label' => __('Icon Color', 'acea-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-card-wraper span.content-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-addons-card-wraper span.content-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
			'btn_icon_size',
			[
				'label' => __('Icon Size', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-card-wraper span.content-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .acea-addons-card-wraper span.content-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'btn_icon_gap',
			[
				'label' => __('Icon Gap', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-card-wraper span.content-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'btn_icon_margin',
			[
				'label' => __('Icon Gap Top', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-card-wraper span.content-icon svg' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'text_style',
			[
				'label' => esc_html__( 'Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
			]
        );
        $this->add_control(
                'content_footer_color',
                [
                    'label'     => __('Color', 'advis-hp'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .acea-addons-card-wraper span.content-text' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'contetn_footer_typo',
                    'label'    => __('Typography', 'advis-hp'),
                    'selector' => '{{WRAPPER}} .acea-addons-card-wraper span.content-text',
                ]
            );
            $this->add_responsive_control(
                'icon_text_gab',
                [
                    'label' => __('Item Gap', 'acea-addons'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                        ],
                    ],
                    'devices' => ['desktop', 'tablet', 'mobile'],
                    'selectors' => [
                        '{{WRAPPER}} .acea-addons-card-wraper .content-footer-left' => 'padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
        $this->end_controls_section();
		/* 
        *Content Box
        */
        $this->start_controls_section('card_content',
            [
                'label' => __('Content Box', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'content_bg',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .acea-addons-card-content',
			]
		);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'content_wrapper_border',
                'selector'  => '{{WRAPPER}} .acea-addons-card-content',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'content_border_radius',
            [
                'label'      => __('Border Radius', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-content' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
            'content_margin',
            [
                'label'      => __('Margin', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /* 
        * Box wraper
        */
        $this->start_controls_section('box_wrapper',
            [
                'label' => __('Box Wraper', 'advis-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'box_hover_tabs'
        );
        $this->start_controls_tab(
            'box_normal_tab',
            [
                'label' => __('Normal', 'advis-ts'),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_wrapper_border',
                'selector'  => '{{WRAPPER}} .acea-addons-card-wraper',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_wrapper_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-addons-card-wraper',
            ]
        );
        $this->add_responsive_control(
            'box_wrapper_radius',
            [
                'label'      => __('Border Radius', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-wraper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-wraper' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_wrapper_margin',
            [
                'label'      => __('Padding', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-wraper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-wraper' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_wrapper_hover_tab',
            [
                'label' => __('Hover', 'advis-ts'),
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'box_hover_wrapper_border',
                'selector'  => '{{WRAPPER}} .acea-addons-card-wraper:hover',
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_wrapper_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-addons-card-wraper:hover',
            ]
        );
        $this->add_responsive_control(
            'box_wrapper_hover',
            [
                'label'      => __('Border Radius', 'advis-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-card-wraper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-card-wraper:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
	}
	/**
	 * Render icon widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        $image = $settings['image'];
        $heading    = $settings['heading'];
        $content    = $settings['content'];
        $user_content    = $settings['user_content'];
        $clock_content    = $settings['clock_content'];
        $image_hover_style = $settings['image_hover_style'];
        // $card_link = $settings['card_link'];
        if ( ! empty( $settings['card_link']['url'] ) ) { ?>
        <a href="<?php echo esc_url( $settings['card_link']['url'] ); ?>">
        <div class="acea-addons-card-wraper">
            <div class="acea-addons-single-card <?php echo esc_attr( $image_hover_style  ) ?>">
                <div class="acea-addons-card-images">
                 <img src="<?php echo esc_url($image['url']) ?>" alt="">
                </div>
                <div class="acea-addons-card-content">
                    <h3 class="acea-addons-card-title"><?php echo esc_html($heading); ?></h3>
                    <span class="acea-addons-card-discription">
                        <?php echo esc_html($content) ?>
                    </span>
                    <div class="content-footer" >
                        <div class="content-footer-left" >
                            <span class="content-icon" ><?php \Elementor\Icons_Manager::render_icon($settings["user_icon"], ['aria-hidden' => 'true']); ?></span>
                            <span class="content-text" ><?php echo esc_html($user_content) ?></span>
                        </div>
                        <div class="content-footer-right" >
                            <span class="content-icon" ><?php \Elementor\Icons_Manager::render_icon($settings["clock_icon"], ['aria-hidden' => 'true']); ?></span>
                            <span class="content-text" ><?php echo esc_html($clock_content) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
        <?php
        } 
	}
}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Addons_Card() );