<?php
/**
 * Floating Effects extension class.
 *
 * @package Coderlift_Addons
 */
namespace Coderlift_Addons\Widgets;
if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
use Elementor\Element_Base;
use Elementor\Controls_Manager;
class Fd_addons_Floating_Effects {
	static $should_script_enqueue = false;
	public static function init() {
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'register' ], 1 );
		add_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'should_script_enqueue' ] );
		add_action( 'elementor/preview/enqueue_scripts', [ __CLASS__, 'enqueue_scripts' ], 50 );
	}
	public static function enqueue_scripts() {
		wp_enqueue_script(
			'anime',
			ACEA_ADDONS_ASSETS . 'frontend/js/anime.min.js',
			null,
			'1.0.1',
			true
		);
		$extension_js = ACEA_ADDONS_DIR_PATH . 'assets/frontend/js/floting.js' ;
		wp_add_inline_script(
			'elementor-frontend', file_get_contents($extension_js)
		);
	}
	/**
	 * Set should_script_enqueue based extension settings
	 *
	 * @param Element_Base $section
	 * @return void
	 */
	public static function should_script_enqueue( Element_Base $section ) {
		if ( self::$should_script_enqueue ) {
			return;
		}
		if ( 'yes' == $section->get_settings_for_display( 'acea_addon_floating_fx' ) ) {
			self::enqueue_scripts();
			self::$should_script_enqueue = true;
			remove_action( 'elementor/frontend/widget/before_render', [ __CLASS__, 'should_script_enqueue' ] );
		}
	}
	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'acea_section_floating_effects',
			[
				'label' => __( 'Floating Effects', 'acea-addons' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx',
			[
				'label' => __( 'Enable', 'acea-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_translate_toggle',
			[
				'label' => __( 'Translate', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'acea_addon_floating_fx' => 'yes',
				]
			]
		);
		$element->start_popover();
		$element->add_control(
			'acea_addon_floating_fx_translate_x',
			[
				'label' => __( 'Translate X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 5,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_translate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_translate_y',
			[
				'label' => __( 'Translate Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 5,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_translate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_translate_duration',
			[
				'label' => __( 'Duration', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'acea_addon_floating_fx_translate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_translate_delay',
			[
				'label' => __( 'Delay', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 100
					]
				],
				'condition' => [
					'acea_addon_floating_fx_translate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->end_popover();
		$element->add_control(
			'acea_addon_floating_fx_rotate_toggle',
			[
				'label' => __( 'Rotate', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'acea_addon_floating_fx' => 'yes',
				]
			]
		);
		$element->start_popover();
		$element->add_control(
			'acea_addon_floating_fx_rotate_x',
			[
				'label' => __( 'Rotate X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 45,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_rotate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_rotate_y',
			[
				'label' => __( 'Rotate Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 45,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_rotate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_rotate_z',
			[
				'label' => __( 'Rotate Z', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 0,
						'to' => 45,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_rotate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_rotate_duration',
			[
				'label' => __( 'Duration', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'acea_addon_floating_fx_rotate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_rotate_delay',
			[
				'label' => __( 'Delay', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 100
					]
				],
				'condition' => [
					'acea_addon_floating_fx_rotate_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->end_popover();
		$element->add_control(
			'acea_addon_floating_fx_scale_toggle',
			[
				'label' => __( 'Scale', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'frontend_available' => true,
				'condition' => [
					'acea_addon_floating_fx' => 'yes',
				]
			]
		);
		$element->start_popover();
		$element->add_control(
			'acea_addon_floating_fx_scale_x',
			[
				'label' => __( 'Scale X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 1,
						'to' => 1.2,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_scale_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_scale_y',
			[
				'label' => __( 'Scale Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'sizes' => [
						'from' => 1,
						'to' => 1.2,
					],
					'unit' => 'px',
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'labels' => [
					__( 'From', 'acea-addons' ),
					__( 'To', 'acea-addons' ),
				],
				'scales' => 1,
				'handles' => 'range',
				'condition' => [
					'acea_addon_floating_fx_scale_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_scale_duration',
			[
				'label' => __( 'Duration', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 10000,
						'step' => 100
					]
				],
				'default' => [
					'size' => 1000,
				],
				'condition' => [
					'acea_addon_floating_fx_scale_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->add_control(
			'acea_addon_floating_fx_scale_delay',
			[
				'label' => __( 'Delay', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5000,
						'step' => 100
					]
				],
				'condition' => [
					'acea_addon_floating_fx_scale_toggle' => 'yes',
					'acea_addon_floating_fx' => 'yes',
				],
				'render_type' => 'none',
				'frontend_available' => true,
			]
		);
		$element->end_popover();
		$element->end_controls_section();
	}
}
Fd_addons_Floating_Effects::init();
