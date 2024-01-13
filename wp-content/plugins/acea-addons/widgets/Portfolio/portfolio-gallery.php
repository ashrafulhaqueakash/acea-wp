<?php
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Acea_Portfolio_Gallery extends \Elementor\Widget_Base
{
    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'acea-portfolio-gallery';
    }

    public function get_script_depends() {
        return ['isotope', 'acea-addon'];
    }
    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Acea Portfolio Gallery', 'acea-hp' );
    }
    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['acea-addons'];
    }
    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_gallery',
            [
                'label' => __( 'Gallery', 'acea-hp' ),
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label'   => __( 'Layout type', 'acea-hp' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'masonry' => 'Masonry',
                    'normal'  => 'Normal',
                    'slider'  => 'Slider',
                ),
                'default' => 'masonry',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Choose Image', 'acea-hp' ),
                'type'    => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'image_size',
            [
                'label'       => __( 'Image Dimension', 'acea-hp' ),
                'type'        => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'acea-hp' ),
                'default'     => [
                    'width'  => '',
                    'height' => '',
                ],
            ]
        );
        $repeater->add_responsive_control(
            'image_grid',
            [
                'label'   => __( 'Image grid', 'acea-hp' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    ''   => 'Default',
                    '12' => '1 Column',
                    '6'  => '2 Column',
                    '4'  => '3 Column',
                    '3'  => '4 Column',
                ),
                'default' => '',
            ]
        );

        $repeater->add_control(
            'image_title',
            [
                'label'       => __( 'Title', 'plugin-domain' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __( 'Type your title here', 'plugin-domain' ),
            ]
        );

        $this->add_control(
            'gallery_list',
            [
                'label'       => __( 'Repeater List', 'acea-hp' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ image_title }}}',
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_width_nd_height',
            [
                'label' => __( 'Width & Height', 'acea-hp' ),
            ]
        );

        $this->add_responsive_control(
            'post_grid',
            [
                'label'     => __( 'Post grid', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'options'   => array(
                    '12' => '1 Column',
                    '6'  => '2 Column',
                    '4'  => '3 Column',
                    '3'  => '4 Column',
                ),
                'default'   => 3,
                'condition' => [
                    'layout_type!' => 'slider',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_verti_gap',
            [
                'label'           => __( 'Column Vertical Gap', 'acea-hp' ),
                'type'            => \Elementor\Controls_Manager::SLIDER,
                'devices'         => ['desktop', 'tablet', 'mobile'],
                'size_units'      => ['px', '%'],
                'range'           => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'desktop_default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors'       => [
                    '{{WRAPPER}}  .acea-portfolio-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
                ],
            ]
        );

        $this->add_responsive_control(
            'column_hori_gap',
            [
                'label'           => __( 'Column Horizontal Gap', 'acea-hp' ),
                'type'            => \Elementor\Controls_Manager::SLIDER,
                'devices'         => ['desktop', 'tablet', 'mobile'],
                'size_units'      => ['px', '%'],
                'range'           => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'desktop_default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors'       => [
                    '{{WRAPPER}}  .acea-portfolio-item-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}} ;',
                ],
                'condition'       => [
                    'layout_type!' => 'slider',
                ],
            ]
        );
        $this->add_control(
            'use_custom_height',
            [
                'label'        => __( 'Use custom height?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'acea-hp' ),
                'label_off'    => __( 'No', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_responsive_control(
            'normal_image_height',
            [
                'label'      => __( 'Normal Image Height', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'devices'    => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'use_custom_height' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        //Slider Setting
        $this->start_controls_section( 'slider_settings',
            [
                'label'     => __( 'Slider Settings', 'acea-hp' ),
                'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'layout_type' => 'slider',
                ],
            ]
        );

        $this->add_responsive_control(
            'per_coulmn',
            [
                'label'              => __( 'Slider Items', 'acea-hp' ),
                'type'               => \Elementor\Controls_Manager::SELECT,
                'default'            => 3,
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
            'arrows',
            [
                'label'        => __( 'Show arrows?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-hp' ),
                'label_off'    => __( 'Hide', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'        => __( 'Show Dots?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-hp' ),
                'label_off'    => __( 'Hide', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label'        => __( 'Show MouseDrag', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-hp' ),
                'label_off'    => __( 'Hide', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => __( 'Auto Play?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-hp' ),
                'label_off'    => __( 'Hide', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label'        => __( 'Infinite Loop', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-hp' ),
                'label_off'    => __( 'Hide', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label'       => __( 'Autoplay Timeout', 'acea-hp' ),
                'type'        => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default'     => '5000',
                'options'     => [
                    '1000'  => __( '1 Second', 'acea-hp' ),
                    '2000'  => __( '2 Second', 'acea-hp' ),
                    '3000'  => __( '3 Second', 'acea-hp' ),
                    '4000'  => __( '4 Second', 'acea-hp' ),
                    '5000'  => __( '5 Second', 'acea-hp' ),
                    '6000'  => __( '6 Second', 'acea-hp' ),
                    '7000'  => __( '7 Second', 'acea-hp' ),
                    '8000'  => __( '8 Second', 'acea-hp' ),
                    '9000'  => __( '9 Second', 'acea-hp' ),
                    '10000' => __( '10 Second', 'acea-hp' ),
                    '11000' => __( '11 Second', 'acea-hp' ),
                    '12000' => __( '12 Second', 'acea-hp' ),
                    '13000' => __( '13 Second', 'acea-hp' ),
                    '14000' => __( '14 Second', 'acea-hp' ),
                    '15000' => __( '15 Second', 'acea-hp' ),
                ],
                'condition'   => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_icon',
            [
                'label'       => __( 'Previous Icon', 'acea' ),
                'label_block' => false,
                'type'        => \Elementor\Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [
                    'value'   => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'arrow_next_icon',
            [
                'label'       => __( 'Next Icon', 'acea' ),
                'label_block' => false,
                'type'        => \Elementor\Controls_Manager::ICONS,
                'skin'        => 'inline',
                'default'     => [
                    'value'   => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_image',
            [
                'label' => __( 'Image', 'acea-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label'      => __( 'Image Radius', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    ' {{WRAPPER}} .acea-portfolio-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_shadow',
                'label'    => __( 'Button Shadow', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .acea-portfolio-item img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'label'    => __( 'Border', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .acea-portfolio-item img',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_responsive_control(
            'image_hover_radius',
            [
                'label'      => __( 'Box Image Radius', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    ' {{WRAPPER}} .acea-portfolio-item:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_hover_shadow',
                'label'    => __( 'Button Shadow', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .acea-portfolio-item:hover img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'image_hover_border',
                'label'    => __( 'Border', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .acea-portfolio-item:hover img',
            ]
        );
        $this->add_control(
            'enable_hover_rotate',
            [
                'label'        => __( 'Rotate animation on hover?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'acea-hp' ),
                'label_off'    => __( 'No', 'acea-hp' ),
                'return_value' => 'acea-hover-rotate',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'image_hover_animation',
            [
                'label'     => __( 'Hover Animation', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::HOVER_ANIMATION,
                // 'prefix_class' => 'elementor-animation-',
                'condition' => [
                    'enable_hover_rotate!' => 'acea-hover-rotate',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title', 'acea-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label'    => __( 'Title Typography', 'acea-hp' ),
                'name'     => 'title_typo',
                'selector' => '{{WRAPPER}} .acea-portfolio-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label'     => __( 'Align', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [
                    'left'     => [
                        'flex-start' => __( 'Left', 'acea-hp' ),
                        'icon'       => 'fa fa-align-left',
                    ],
                    'center'   => [
                        'title' => __( 'top', 'acea-hp' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'acea-hp' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content h3' => 'justify-content: {{VALUE}};',
                ],
                'toggle'    => true,
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label'     => __( 'Title Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __( 'Content Box', 'acea-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_bg_color',
            [
                'label'     => __( 'Content Background Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_gap',
            [
                'label'      => __( 'Content gap', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-portfolio-content.content-postion-on-image' => 'left:{{SIZE}}{{UNIT}};right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_y_position',
            [
                'label'      => __( 'Content Y Position', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-portfolio-content.content-postion-on-image' => 'bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __( 'Content Padding', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_radius',
            [
                'label'      => __( 'Content Box Radius', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /*
         *
        Dots
         */
        $this->start_controls_section(
            'dots_navigation',
            [
                'label'     => __( 'Navigation - Dots', 'acea-hp' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'dots_align',
			[
				'label' => esc_html__( 'Dots Align', 'plugin-name' ),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider-dots' => 'justify-content: {{VALUE}};',
                ],
				'toggle' => true,
			]
		);

        $this->start_controls_tabs(
            'dots_style_tabs'
        );
        
        $this->start_controls_tab(
            'dots_style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'plugin-name' ),
            ]
        );

        $this->add_control(
			'dots_width',
			[
				'label' => esc_html__( 'Dots Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .acea-pf-gallery-slider-dots li' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'dots_height',
			[
				'label' => esc_html__( 'Dots Height', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .acea-pf-gallery-slider-dots li' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dots_background',
				'label' => esc_html__( 'Dots Background', 'plugin-name' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .acea-pf-gallery-slider-dots li',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'dots_border',
				'label' => esc_html__( 'Border', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .acea-pf-gallery-slider-dots li',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dots_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .acea-pf-gallery-slider-dots li'
			]
        );

        $this->add_control(
			'dots_borde_radius',
			[
				'label' => esc_html__( 'Border Radius', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acea-pf-gallery-slider-dots li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
			'dots_gap',
			[
				'label' => esc_html__( 'Dots Gap', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .acea-pf-gallery-slider-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'dots_separetor',
			[
				'label' => esc_html__( 'Margin', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .acea-pf-gallery-slider-dots li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();
        $this->start_controls_tab(
			'dots_style_active_tab',
			[
				'label' => esc_html__( 'Active', 'plugin-name' ),
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'dots_active_background',
				'label' => esc_html__( 'Dots Background', 'plugin-name' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .acea-pf-gallery-slider-dots li.slick-active',
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'active_dots_border',
				'label' => esc_html__( 'Border', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .acea-pf-gallery-slider-dots li.slick-active',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'dots_active_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .acea-pf-gallery-slider-dots li.slick-active'
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
                'label'     => __( 'Navigation - Arrow', 'acea-hp' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_arrow' );

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => __( 'Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow i'        => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_fill',
            [
                'label'     => __( 'Line Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow i:vefore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label'     => __( 'Background Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider button.slick-arrow' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'arrow_shadow',
                'label'    => __( 'Shadow', 'fd-addons' ),
                'selector' => '{{WRAPPER}} .acea-pf-gallery-slider button.slick-arrow',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label'     => __( 'Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow:hover i:vefore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow:hover svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label'     => __( 'Line Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow:hover i:vefore' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .acea-pf-gallery-slider .slick-arrow:hover svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label'     => __( 'Background Color Hover', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-gallery-slider .acea-slick-next:hover, .acea-pf-gallery-slider .acea-slick-prev:hover' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'arrow_hover_shadow',
                'label'    => __( 'Shadow Hover', 'fd-addons' ),
                'selector' => '{{WRAPPER}} .acea-pf-gallery-slider .acea-slick-next:hover, {{WRAPPER}} .acea-pf-gallery-slider .acea-slick-prev:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'hrthere',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label'        => __( 'Position', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => __( 'None', 'acea-hp' ),
                'label_on'     => __( 'Custom', 'acea-hp' ),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();

        /*
        Arrow Position
         */
        $this->add_responsive_control(
            'arrow_position_y',
            [
                'label'      => __( 'Vertical', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
                'range'      => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-pf-gallery-slider button.slick-arrow' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_prev_position',
            [
                'label'      => __( 'Prev icon Position', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
                'range'      => [
                    'px' => [
                        'min' => -2000,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .acea-pf-gallery-slider .slick-arrow.acea-slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'arrow_nextv_position',
            [
                'label'      => __( 'Next icon Position', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition'  => [
                    'arrow_position_toggle' => 'yes',
                ],
                'range'      => [
                    'px' => [
                        'min' => -2000,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .acea-pf-gallery-slider .slick-arrow.acea-slick-next' => 'right: {{SIZE}}{{UNIT}}; left:auto;',
                ],
            ]
        );

        // $this->add_responsive_control(
        //     'arrow_position_right_gap',
        //     [
        //         'label' => __('Prev Aarrow Gap', 'acea-hp'),
        //         'type' => \Elementor\Controls_Manager::SLIDER,
        //         'size_units' => ['px'],
        //         'condition' => [
        //             'arrow_position_toggle' => 'yes'
        //         ],
        //         'range' => [
        //             'px' => [
        //                 'min' => -1000,
        //                 'max' => 2000,
        //             ],
        //         ],
        //         'selectors' => [
        //             'body:not(.rtl) {{WRAPPER}} .acea-pf-gallery-slider .slick-arrow.acea-slick-next' => 'right: {{SIZE}}{{UNIT}};',
        //             'body.rtl {{WRAPPER}} .acea-pf-gallery-slider .slick-arrow  button.acea-slick-prev' => 'left: {{SIZE}}{{UNIT}};',
        //         ],
        //     ]
        // );
        $this->end_popover();

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label'      => __( 'Icon Size', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-pf-gallery-slider .slick-arrow i'   => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .acea-pf-gallery-slider .slick-arrow svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label'      => __( 'Size', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-pf-gallery-slider button.slick-arrow' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function get_render_icon( $icon ) {
        ob_start();
        \Elementor\Icons_Manager::render_icon( $icon, ['aria-hidden' => 'true'] );
        return ob_get_clean();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings                   = $this->get_settings();
        $paged                      = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $portfolio_data             = [];
        $portfolio_data['settings'] = $this->get_settings();
        $portfolio_data             = json_encode( $portfolio_data );
        $post_grid_desktop          = $settings['post_grid'];
        $post_grid_tablet           = isset( $settings['post_grid_tablet'] ) ? $settings['post_grid_tablet'] : '';
        $post_grid_mobile           = isset( $settings['post_grid_mobile'] ) ? $settings['post_grid_mobile'] : '';
        //this code slider option
        $slider_extraSetting = array(

            'next_icon'         => $this->get_render_icon( $settings['arrow_next_icon'] ),
            'prev_icon'         => $this->get_render_icon( $settings['arrow_prev_icon'] ),

            'loop'              => ( !empty( $settings['loop'] ) && 'yes' === $settings['loop'] ) ? true : false,
            'dots'              => ( !empty( $settings['dots'] ) && 'yes' === $settings['dots'] ) ? true : false,
            'autoplay'          => ( !empty( $settings['autoplay'] ) && 'yes' === $settings['autoplay'] ) ? true : false,
            'nav'               => ( !empty( $settings['arrows'] ) && 'yes' === $settings['arrows'] ) ? true : false,
            'mousedrag'         => ( !empty( $settings['mousedrag'] ) && 'yes' === $settings['mousedrag'] ) ? true : false,
            'autoplaytimeout'   => !empty( $settings['autoplaytimeout'] ) ? $settings['autoplaytimeout'] : '5000',

            //this a responsive layout
            'per_coulmn'        => ( !empty( $settings['per_coulmn'] ) ) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => ( !empty( $settings['per_coulmn_tablet'] ) ) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => ( !empty( $settings['per_coulmn_mobile'] ) ) ? $settings['per_coulmn_mobile'] : 1,
        );

        $jasondecode = wp_json_encode( $slider_extraSetting );
        if ( 'slider' == $settings['layout_type'] ) {
            $this->add_render_attribute( 'pf_gallery_slide', 'data-settings', $jasondecode );
        }

        ?>
        <?php if ( 'slider' == $settings['layout_type'] ): ?>
            <div class="acea-pf-gallery-slider" <?php echo $this->get_render_attribute_string( 'pf_gallery_slide' ); ?>>
                <?php
$i = 0;
        foreach ( $settings['gallery_list'] as $item ):
            $image_size = ( $item['image_size']['width'] || $item['image_size']['height'] ) ? [$item['image_size']['width'], $item['image_size']['height']] : 'full';
            ?>
		                        <div class="acea-portfolio-item" <?php //echo  $this->get_render_attribute_string( 'acea-gallery-lightbox-'.$i ) ; ?>>
		                            <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full' ) ?>" class="acea-portfolio-image d-block <?php echo esc_attr( 'elementor-animation-' . $settings['image_hover_animation'] ) ?>">
		                                <?php echo wp_get_attachment_image( $item['image']['id'], $image_size ); ?>
		                            </a>
		                            <?php if ( !empty( $item['image_title'] ) ): ?>
		                            <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full' ) ?>" class="acea-portfolio-content content-postion-on-image">
		                                <h3 class="acea-portfolio-title">
		                                    <?php echo esc_html( $item['image_title'] ) ?>
		                                </h3>
		                            </a>
		                            <?php endif;?>
                        </div>
                        <?php endforeach;?>
                </div>

            <?php else: ?>

            <div class="row justify-content-center acea-pf-gallery-wrap layout-mode-<?php echo esc_attr( $settings['layout_type'] . ' ' . $settings['enable_hover_rotate'] ) ?>">
                <?php
$i = 0;
        foreach ( $settings['gallery_list'] as $item ):
            $i++;
            $unique_id  = rand( 100, 10000 );
            $image_size = ( $item['image_size']['width'] || $item['image_size']['height'] ) ? [$item['image_size']['width'], $item['image_size']['height']] : 'full';
            if ( !empty( $item['image_grid'] ) ) {
                $image_grid_desktop = $item['image_grid'];
                $image_grid_tablet  = isset( $item['image_grid_tablet'] ) ? $item['image_grid_tablet'] : '';
                $image_grid_mobile  = isset( $item['image_grid_mobile'] ) ? $item['image_grid_mobile'] : '';
                $grid               = sprintf( 'col-lg-%s col-md-%s col-%s', esc_attr( $image_grid_desktop ), esc_attr( $image_grid_tablet ), esc_attr( $image_grid_mobile ) );
            } else {
                $grid = sprintf( 'col-lg-%s col-md-%s col-%s', esc_attr( $post_grid_desktop ), esc_attr( $post_grid_tablet ), esc_attr( $post_grid_mobile ) );
            }
            ?>
		                <div class="acea-portfolio-item-wrap <?php echo esc_attr( $grid ) ?>"  >

		                    <div class="acea-portfolio-item" <?php echo $this->get_render_attribute_string( 'acea-gallery-lightbox-' . $i ); ?>>
		                        <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full' ) ?>" class="acea-portfolio-image d-block <?php echo esc_attr( 'elementor-animation-' . $settings['image_hover_animation'] ) ?>">
		                            <?php echo wp_get_attachment_image( $item['image']['id'], $image_size ); ?>
		                        </a>
		                        <?php if ( !empty( $item['image_title'] ) ): ?>
		                        <a href="<?php echo wp_get_attachment_image_url( $item['image']['id'], 'full' ) ?>" class="acea-portfolio-content content-postion-on-image">
		                            <h3 class="acea-portfolio-title">
		                                <?php echo esc_html( $item['image_title'] ) ?>
		                            </h3>
		                        </a>
		                        <?php endif;?>
                    </div>
                </div>
                <?php endforeach;?>
            </div>

         <?php endif;?>
<?php

    }
}

$widgets_manager->register_widget_type( new \Acea_Portfolio_Gallery() );