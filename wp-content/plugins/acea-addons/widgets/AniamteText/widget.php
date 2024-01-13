<?php
namespace Acea\Widgets\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
class Acea_Animated_Text extends Widget_Base {
	public function get_name() {
		return 'acea-animated';
	}
	public function get_title() {
		return esc_html__( 'Animated Text', 'acea-addons' );
	}
	public function get_icon() {
		return 'eicon-animated-headline';
	}
   	public function get_categories() {
		return [ 'acea-addons' ];
	}
	public function get_keywords() {
        return [ 'acea-addons', 'fancy', 'heading', 'animate', 'animation' ];
    }
 	public function get_script_depends() {
		return [ 'acea-animated-text' ];
	}
	protected function register_controls() {
	    /*
	    * Animated Text Content
	    */
	    $this->start_controls_section(
	        'acea_section_animated_text_content',
	        [
	            'label' => esc_html__( 'Content', 'acea-addons' )
	        ]
		);
		$this->add_control(
	        'acea_animated_text_before_text',
	        [
				'label'   => esc_html__( 'Before Text', 'acea-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'This is', 'acea-addons' ),
				'dynamic'     => [ 'active' => true ],
	        ]
		);
		$this->add_control(
			'acea_animated_text_animated_heading',
			[
				'label'       => esc_html__( 'Animated Text', 'acea-addons' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter your animated text with comma separated.', 'acea-addons' ),
				'description' => __( '<b>Write animated heading with comma separated. Example: Exclusive, Addons, Elementor</b>', 'acea-addons' ),
				'default'     => esc_html__( 'Acea, Addons, Elementor', 'acea-addons' ),
				'dynamic'     => [ 'active' => true ]
			]
		);
		$this->add_control(
	        'acea_animated_text_after_text',
	        [
				'label'   => esc_html__( 'After Text', 'acea-addons' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'For You.', 'acea-addons' ),
				'dynamic'     => [ 'active' => true ],
	        ]
		);
		$this->add_control(
			'acea_animated_text_animated_heading_tag',
			[
				'label'   => esc_html__( 'HTML Tag', 'acea-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'h3',
				'toggle'  => false,
				'options' => [
					'h1'  => [
						'title' => __( 'H1', 'acea-addons' ),
						'icon'  => 'eicon-editor-h1'
					],
					'h2'  => [
						'title' => __( 'H2', 'acea-addons' ),
						'icon'  => 'eicon-editor-h2'
					],
					'h3'  => [
						'title' => __( 'H3', 'acea-addons' ),
						'icon'  => 'eicon-editor-h3'
					],
					'h4'  => [
						'title' => __( 'H4', 'acea-addons' ),
						'icon'  => 'eicon-editor-h4'
					],
					'h5'  => [
						'title' => __( 'H5', 'acea-addons' ),
						'icon'  => 'eicon-editor-h5'
					],
					'h6'  => [
						'title' => __( 'H6', 'acea-addons' ),
						'icon'  => 'eicon-editor-h6'
					]
				]
			]
		);
		$this->add_control(
			'acea_animated_text_animated_heading_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'acea-addons' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => true,
				'options' => [
					'left'   => [
						'title' => __( 'Left', 'acea-addons' ),
						'icon'  => 'eicon-text-align-left'
					],
					'center' => [
						'title' => __( 'Center', 'acea-addons' ),
						'icon'  => 'eicon-text-align-center'
					],
					'right'  => [
						'title' => __( 'Right', 'acea-addons' ),
						'icon'  => 'eicon-text-align-right'
					]
				],
				'default' => 'left',
				'selectors'     => [
                    '{{WRAPPER}} .acea-animated-text-align' => 'text-align: {{VALUE}};'
                ]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Container Style
	    */
	    $this->start_controls_section(
	        'acea_section_animated_text_animation_tyle',
	        [
				'label' => esc_html__( 'Animation', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_control(
			'acea_animated_text_animated_heading_animated_type',
			[
				'label'   => esc_html__( 'Animation Type', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'acea-typed-animation',
				'options' => [
					'acea-typed-animation'   => __( 'Typed', 'acea-addons' ),
					'acea-morphed-animation' => __( 'Animate', 'acea-addons' )
				]
			]
		);
		$this->add_control(
			'acea_animated_text_animated_heading_animation_style',
			[
				'label'   => esc_html__( 'Animation Style', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fadeIn',
				'options' => [
					'fadeIn'            => __( 'Fade In', 'acea-addons' ),
					'fadeInUp'          => __( 'Fade In Up', 'acea-addons' ),
					'fadeInDown'        => __( 'Fade In Down', 'acea-addons' ),
					'fadeInLeft'        => __( 'Fade In Left', 'acea-addons' ),
					'fadeInRight'       => __( 'Fade In Right', 'acea-addons' ),
					'zoomIn'            => __( 'Zoom In', 'acea-addons' ),
					'zoomInUp'          => __( 'Zoom In Up', 'acea-addons' ),
					'zoomInDown'        => __( 'Zoom In Down', 'acea-addons' ),
					'zoomInLeft'        => __( 'Zoom In Left', 'acea-addons' ),
					'zoomInRight'       => __( 'Zoom In Right', 'acea-addons' ),
					'slideInDown'       => __( 'Slide In Down', 'acea-addons' ),
					'slideInUp'         => __( 'Slide In Up', 'acea-addons' ),
					'slideInLeft'       => __( 'Slide In Left', 'acea-addons' ),
					'slideInRight'      => __( 'Slide In Right', 'acea-addons' ),
					'bounce'            => __( 'Bounce', 'acea-addons' ),
					'bounceIn'          => __( 'Bounce In', 'acea-addons' ),
					'bounceInUp'        => __( 'Bounce In Up', 'acea-addons' ),
					'bounceInDown'      => __( 'Bounce In Down', 'acea-addons' ),
					'bounceInLeft'      => __( 'Bounce In Left', 'acea-addons' ),
					'bounceInRight'     => __( 'Bounce In Right', 'acea-addons' ),
					'flash'             => __( 'Flash', 'acea-addons' ),
					'pulse'             => __( 'Pulse', 'acea-addons' ),
					'rotateIn'          => __( 'Rotate In', 'acea-addons' ),
					'rotateInDownLeft'  => __( 'Rotate In Down Left', 'acea-addons' ),
					'rotateInDownRight' => __( 'Rotate In Down Right', 'acea-addons' ),
					'rotateInUpRight'   => __( 'rotate In Up Right', 'acea-addons' ),
					'rotateIn'          => __( 'Rotate In', 'acea-addons' ),
					'rollIn'            => __( 'Roll In', 'acea-addons' ),
					'lightSpeedIn'      => __( 'Light Speed In', 'acea-addons' )
				],
				'condition' => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-morphed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text Settings
	    */
	    $this->start_controls_section(
	        'acea_section_animated_text_settings',
	        [
				'label' => esc_html__( 'Settings', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_control(
			'acea_animated_text_animation_speed',
			[
				'label'     => __( 'Animation Speed', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 100,
				'max'       => 10000,
				'condition' => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-morphed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_type_speed',
			[
				'label'   => __( 'Type Speed', 'acea-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 60,
				'min'     => 10,
				'max'     => 200,
				'step'    => 10,
				'condition' => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_start_delay',
			[
				'label'     => __( 'Start Delay', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_back_type_speed',
			[
				'label'     => __( 'Back Type Speed', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 60,
				'min'       => 10,
				'max'       => 200,
				'step'      => 10,
				'condition' => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_back_delay',
			[
				'label'     => __( 'Back Delay', 'acea-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1000,
				'min'       => 1000,
				'max'       => 10000,
				'condition' => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_loop',
			[
				'label'        => __( 'Loop', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_show_cursor',
			[
				'label'        => __( 'Show Cursor', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_fade_out',
			[
				'label'        => __( 'Fade Out', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_smart_backspace',
			[
				'label'        => __( 'Smart Backspace', 'acea-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'ON', 'acea-addons' ),
				'label_off'    => __( 'OFF', 'acea-addons' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'acea_animated_text_animated_heading_animated_type' => 'acea-typed-animation'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text pre animated Text Style
		*/
	    $this->start_controls_section(
	        'acea_pre_animated_text_style',
	        [
				'label'     => esc_html__( 'Pre Animated text', 'acea-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_animated_text_before_text!' => ''
				]
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_pre_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .acea-animated-text-pre-heading',
			]
		);
		$this->add_control(
			'acea_pre_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .acea-animated-text-pre-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text animated Text Style
	    */
	    $this->start_controls_section(
	        'acea_animated_text_style',
	        [
				'label' => esc_html__( 'Animated text', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .acea-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor'
			]
		);
		$this->add_control(
			'acea_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
					'{{WRAPPER}} .acea-animated-text-animated-heading, {{WRAPPER}} span.typed-cursor' => 'color: {{VALUE}}'
				]
			]
		);
		$this->add_control(
			'acea_animated_text_spacing',
			[
				'label'      => __( 'Spacing', 'acea-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'default'    => [
                    'unit'   => 'px',
                    'size'   => 8
                ],
				'range'      => [
					'px'     => [
						'min' => 0,
						'max' => 50
					]
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-animated-text-animated-heading' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};'
				]
			]
		);
		$this->end_controls_section();
		/*
	    * Animated Text post animated Text Style
	    */
	    $this->start_controls_section(
	        'acea_post_animated_text_style',
	        [
				'label'     => esc_html__( 'Post Animated text', 'acea-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'acea_animated_text_after_text!' => ''
				]
	        ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'acea_post_animated_text_typography',
				'fields_options'   => [
		            'font_size'    => [
		                'default'  => [
		                    'unit' => 'px',
		                    'size' => 30
		                ]
		            ],
		            'font_weight'  => [
		                'default'  => '600'
		            ]
	            ],
				'selector' => '{{WRAPPER}} .acea-animated-text-post-heading'
			]
		);
		$this->add_control(
			'acea_post_animated_text_color',
			[
				'label'     => esc_html__( 'Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#222222',
				'selectors' => [
					'{{WRAPPER}} .acea-animated-text-post-heading' => 'color: {{VALUE}}'
				]
			]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings      = $this->get_settings_for_display();
		$id            = substr( $this->get_id_int(), 0, 3 );
		$type_heading  = explode( ',', $settings['acea_animated_text_animated_heading'] );
		$before_text   = $settings['acea_animated_text_before_text'];
		$heading_text  = $settings['acea_animated_text_animated_heading'];
		$after_text    = $settings['acea_animated_text_after_text'];
		$heading_tag   = $settings['acea_animated_text_animated_heading_tag'];
		$heading_align = $settings['acea_animated_text_animated_heading_alignment'];
		$this->add_render_attribute( 'acea_typed_animated_string', 'class', 'acea-typed-strings' );
		$this->add_render_attribute( 'acea_typed_animated_string',
			[
				'data-type_string'       => esc_attr(json_encode($type_heading)),
				'data-heading_animation' => esc_attr( $settings['acea_animated_text_animated_heading_animated_type'] )
			]
		);
		if($settings['acea_animated_text_animated_heading_animated_type'] === 'acea-typed-animation'){
			$this->add_render_attribute( 'acea_typed_animated_string',
				[
					'data-type_speed'      => esc_attr( $settings['acea_animated_text_type_speed'] ),
					'data-back_type_speed' => esc_attr( $settings['acea_animated_text_back_type_speed'] ),
					'data-loop'            => esc_attr( $settings['acea_animated_text_loop'] ),
					'data-show_cursor'     => esc_attr( $settings['acea_animated_text_show_cursor'] ),
					'data-fade_out'        => esc_attr( $settings['acea_animated_text_fade_out'] ),
					'data-smart_backspace' => esc_attr( $settings['acea_animated_text_smart_backspace'] ),
					'data-start_delay'     => esc_attr( $settings['acea_animated_text_start_delay'] ),
					'data-back_delay'      => esc_attr( $settings['acea_animated_text_back_delay'] )
				]
			);
		}
		if($settings['acea_animated_text_animated_heading_animated_type'] === 'acea-morphed-animation'){
			$this->add_render_attribute( 'acea_typed_animated_string',
				[
					'data-animation_style' => esc_attr( $settings['acea_animated_text_animated_heading_animation_style'] ),
					'data-animation_speed' => esc_attr( $settings['acea_animated_text_animation_speed'] )
				]
			);
		}
		$this->add_render_attribute( 'acea_animated_text_animated_heading',
			[
				'id'    => 'acea-animated-text-'.$id,
				'class' => 'acea-animated-text-animated-heading'
			]
		);
		$this->add_render_attribute( 'acea_animated_text_before_text', 'class', 'acea-animated-text-pre-heading' );
        $this->add_inline_editing_attributes( 'acea_animated_text_before_text' );
		$this->add_render_attribute( 'acea_animated_text_after_text', 'class', 'acea-animated-text-post-heading' );
        $this->add_inline_editing_attributes( 'acea_animated_text_after_text' );
		echo '<div class="acea-animated-text-align">';
			do_action( 'acea_animated_text_wrapper_before' );
			echo '<'.esc_attr($heading_tag).' '.$this->get_render_attribute_string( 'acea_typed_animated_string' ).'>';
				do_action( 'acea_animated_text_content_before' );
				$before_text ? printf( '<span '.$this->get_render_attribute_string( 'acea_animated_text_before_text' ).'>%s</span>', wp_kses_post($before_text) ) : '';
				if( 'acea-typed-animation' === $settings['acea_animated_text_animated_heading_animated_type'] ) {
					echo '<span id="acea-animated-text-'.esc_attr($id).'" class="acea-animated-text-animated-heading"></span>';
				}
				if( 'acea-morphed-animation' === $settings['acea_animated_text_animated_heading_animated_type'] ) {
					echo '<span '.$this->get_render_attribute_string( 'acea_animated_text_animated_heading' ).'>'.wp_kses_post($heading_text).'</span>';
				}
				$after_text ? printf( '<span '.$this->get_render_attribute_string( 'acea_animated_text_after_text' ).'>%s</span>', wp_kses_post($after_text) ) : '';
				do_action( 'acea_animated_text_content_after' );
			echo '</'.esc_attr($heading_tag).'>';
			do_action( 'acea_animated_text_wrapper_after' );
		echo '</div>';
	}
}
$widgets_manager->register_widget_type(new \Acea\Widgets\Elementor\Acea_Animated_Text());