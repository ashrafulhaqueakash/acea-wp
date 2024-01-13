<?php
/**
 * CSS Transform extension class.
 *
 * @package fsdppy_Addons
 */
namespace Coderlifts\Elementor\Modulis;
use Elementor\Element_Base;
use Elementor\Controls_Manager;
// defined( 'ABSPATH' ) || die();
class Coderlift_CSS_Transform {
	public static function init() {
		add_action( 'elementor/element/common/_section_style/after_section_end', [ __CLASS__, 'register' ], 1 );
	}
	public static function register( Element_Base $element ) {
		$element->start_controls_section(
			'acea_addons_section_css_transform',
			[
				'label' => ACEA_ADDONS_BADGE . __( 'CSS Transform', 'acea-addons' ),
				'tab' => Controls_Manager::TAB_ADVANCED,
			]
		);
		$element->add_control(
			'fsd_transform_fx',
			[
				'label' => __( 'Enable', 'acea-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'prefix_class' => 'fsd-css-transform-',
			]
		);
		$element->start_controls_tabs(
			'_tabs_fsd_transform',
			[
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_controls_tab(
			'_tabs_fsd_transform_normal',
			[
				'label' => __( 'Normal', 'acea-addons' ),
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->add_control(
			'fsd_transform_fx_translate_toggle',
			[
				'label' => __( 'Translate', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_responsive_control(
			'fsd_transform_fx_translate_x',
			[
				'label' => __( 'Translate X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fsd_transform_fx_translate_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-translate-x: {{SIZE}}px;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_translate_y',
			[
				'label' => __( 'Translate Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fsd_transform_fx_translate_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-translate-y: {{SIZE}}px;'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_rotate_toggle',
			[
				'label' => __( 'Rotate', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_control(
			'fsd_transform_fx_rotate_mode',
			[
				'label' => __( 'Mode', 'acea-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'acea-addons' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'acea-addons' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);
		$element->add_control(
			'fsd_transform_fx_rotate_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_rotate_x',
			[
				'label' => __( 'Rotate X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_rotate_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
					'fsd_transform_fx_rotate_mode' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-rotate-x: {{SIZE}}deg;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_rotate_y',
			[
				'label' => __( 'Rotate Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_rotate_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
					'fsd_transform_fx_rotate_mode' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-rotate-y: {{SIZE}}deg;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_rotate_z',
			[
				'label' => __( 'Rotate (Z)', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_rotate_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-rotate-z: {{SIZE}}deg;'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_scale_toggle',
			[
				'label' => __( 'Scale', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_control(
			'fsd_transform_fx_scale_mode',
			[
				'label' => __( 'Mode', 'acea-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'acea-addons' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'acea-addons' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);
		$element->add_control(
			'fsd_transform_fx_scale_hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_scale_x',
			[
				'label' => __( 'Scale (X)', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fsd_transform_fx_scale_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-scale-x: {{SIZE}}; --fsd-tfx-scale-y: {{SIZE}};'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_scale_y',
			[
				'label' => __( 'Scale Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fsd_transform_fx_scale_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
					'fsd_transform_fx_scale_mode' => 'loose',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-scale-y: {{SIZE}};'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_skew_toggle',
			[
				'label' => __( 'Skew', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_responsive_control(
			'fsd_transform_fx_skew_x',
			[
				'label' => __( 'Skew X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_skew_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-skew-x: {{SIZE}}deg;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_skew_y',
			[
				'label' => __( 'Skew Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_skew_toggle' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-skew-y: {{SIZE}}deg;'
				],
			]
		);
		$element->end_popover();
		$element->end_controls_tab();
		$element->start_controls_tab(
            '_tabs_fsd_transform_hover',
            [
				'label' => __( 'Hover', 'acea-addons' ),
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
            ]
		);
		$element->add_control(
			'fsd_transform_fx_translate_toggle_hover',
			[
				'label' => __( 'Translate', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_responsive_control(
			'fsd_transform_fx_translate_x_hover',
			[
				'label' => __( 'Translate X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fsd_transform_fx_translate_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-translate-x-hover: {{SIZE}}px;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_translate_y_hover',
			[
				'label' => __( 'Translate Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					]
				],
				'condition' => [
					'fsd_transform_fx_translate_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-translate-y-hover: {{SIZE}}px;'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_rotate_toggle_hover',
			[
				'label' => __( 'Rotate', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_control(
			'fsd_transform_fx_rotate_mode_hover',
			[
				'label' => __( 'Mode', 'acea-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'acea-addons' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'acea-addons' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);
		$element->add_control(
			'fsd_transform_fx_rotate_hr_hover',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_rotate_x_hover',
			[
				'label' => __( 'Rotate X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_rotate_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
					'fsd_transform_fx_rotate_mode_hover' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-rotate-x-hover: {{SIZE}}deg;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_rotate_y_hover',
			[
				'label' => __( 'Rotate Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_rotate_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
					'fsd_transform_fx_rotate_mode_hover' => 'loose'
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-rotate-y-hover: {{SIZE}}deg;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_rotate_z_hover',
			[
				'label' => __( 'Rotate (Z)', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_rotate_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-rotate-z-hover: {{SIZE}}deg;'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_scale_toggle_hover',
			[
				'label' => __( 'Scale', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_control(
			'fsd_transform_fx_scale_mode_hover',
			[
				'label' => __( 'Mode', 'acea-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'compact' => [
						'title' => __( 'Compact', 'acea-addons' ),
						'icon' => 'eicon-plus-circle',
					],
					'loose' => [
						'title' => __( 'Loose', 'acea-addons' ),
						'icon' => 'eicon-minus-circle',
					],
				],
				'default' => 'loose',
				'toggle' => false
			]
		);
		$element->add_control(
			'fsd_transform_fx_scale_hr_hover',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_scale_x_hover',
			[
				'label' => __( 'Scale (X)', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fsd_transform_fx_scale_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-scale-x-hover: {{SIZE}}; --fsd-tfx-scale-y-hover: {{SIZE}};'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_scale_y_hover',
			[
				'label' => __( 'Scale Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'default' => [
					'size' => 1
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step' => .1
					]
				],
				'condition' => [
					'fsd_transform_fx_scale_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
					'fsd_transform_fx_scale_mode_hover' => 'loose',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-scale-y-hover: {{SIZE}};'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_skew_toggle_hover',
			[
				'label' => __( 'Skew', 'acea-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'return_value' => 'yes',
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
			]
		);
		$element->start_popover();
		$element->add_responsive_control(
			'fsd_transform_fx_skew_x_hover',
			[
				'label' => __( 'Skew X', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_skew_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-skew-x-hover: {{SIZE}}deg;'
				],
			]
		);
		$element->add_responsive_control(
			'fsd_transform_fx_skew_y_hover',
			[
				'label' => __( 'Skew Y', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'px' => [
						'min' => -180,
						'max' => 180,
					]
				],
				'condition' => [
					'fsd_transform_fx_skew_toggle_hover' => 'yes',
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-skew-y-hover: {{SIZE}}deg;'
				],
			]
		);
		$element->end_popover();
		$element->add_control(
			'fsd_transform_fx_transition_duration',
			[
				'label' => __( 'Transition Duration', 'acea-addons' ),
				'type' => Controls_Manager::SLIDER,
				'separator' => 'before',
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 3,
						'step' => .1,
					]
				],
				'condition' => [
					'fsd_transform_fx' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--fsd-tfx-transition-duration: {{SIZE}}s;'
				],
			]
		);
		$element->end_controls_tab();
		$element->end_controls_tabs();
		$element->end_controls_section();
	}
}
Coderlift_CSS_Transform::init();
