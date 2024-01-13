<?php

namespace Acea_Addons\Widgets;

if (!defined('ABSPATH')) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Widget_Base;

class Acea_Feature_Box extends Widget_Base
{
	public function get_name()
	{
		return 'acea-feature-box';
	}
	public function get_title()
	{
		return esc_html__('Acea Feature Box', 'acea-addons');
	}
	public function get_icon()
	{
		return 'eicon-info-box';
	}
	public function get_categories()
	{
		return ['acea-addons'];
	}
	public function get_keywords()
	{
		return ['info', 'box', 'icon'];
	}
	protected function register_controls()
	{
		/**
		 * Content tab
		 */
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'acea-addons'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_icon_box',
			[
				'label' => esc_html__('Show Icon', 'acea-addons'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'acea-addons'),
				'label_off' => esc_html__('Hide', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'icon_type',
			[
				'label' => __('Icon type', 'acea-addons'),
				'type' => Controls_Manager::SELECT,
				'default' => 'icon',
				'options' => [
					'text'  => __('Text', 'acea-addons'),
					'icon' => __('Icon', 'acea-addons'),
					'image' => __('Image', 'acea-addons'),
				],
				'condition' => [
					'show_icon_box' => 'yes'
				]
			]
		);
		$this->add_control(
			'icon',
			[
				'label' => __('Icon', 'acea-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => 'icon',
					'show_icon_box' => 'yes'
				]
			]
		);
		$this->add_control(
			'box_number',
			[
				'label' => __('Box Number', 'acea-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => [
					'icon_type' => 'text',
					'show_icon_box' => 'yes'
				]
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __('Choose Image', 'acea-addons'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'icon_type' => 'image',
					'show_icon_box' => 'yes'
				]
			]
		);
		$this->add_control(
			'position',
			[
				'label' => __('Icon Position', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'left' => [
						'title' => __('Left', 'elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => __('Top', 'elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __('Title', 'acea-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Easy Intragition', 'acea-addons')
			]
		);
		$this->add_control(
			'enable_designation',
			[
				'label' => __('Show Designation', 'acea-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'acea-addons'),
				'label_off' => __('Hide', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'icon_box_designation',
			[
				'label' => __('Designation', 'acea-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('June 2018-Present', 'acea-addons'),
				'condition' => [
					'enable_designation' => 'yes'
				]
			]
		);
		$this->add_control(
			'description',
			[
				'label' => __('Description', 'acea-addons'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __('Lorem ipsum dolor sit amet, consetetur sadipscing elitr love it', 'acea-addons')
			]
		);
		$this->add_control(
			'enable_bottom_title',
			[
				'label' => __('Show Bottom Title', 'acea-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'acea-addons'),
				'label_off' => __('Hide', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'bottom_title',
			[
				'label' => __('Title Bottom', 'acea-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Jonathan Taylor', 'acea-addons'),
				'condition' => ['enable_bottom_title' => 'yes']
			]
		);
		$this->add_control(
			'enable_button',
			[
				'label' => __('Show Button', 'acea-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'acea-addons'),
				'label_off' => __('Hide', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_control(
			'btn_icon',
			[
				'label' => __('Button Icon', 'acea-addons'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' => __('Button Text', 'acea-addons'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __('Learn more', 'acea-addons'),
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' => __('URL', 'acea-addons'),
				'type' =>  Controls_Manager::URL,
				// 'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'content_align',
			[
				'label' => __('Align', 'acea-addons'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'acea-addons'),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __('top', 'acea-addons'),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __('Right', 'acea-addons'),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
			]
		);
		$this->end_controls_section();
		/**
		 * Style tab
		 */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => __('Icon', 'acea-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		$this->add_control(
			'enable_icon_box',
			[
				'label' => __('Enable Icon Box', 'acea-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'acea-addons'),
				'label_off' => __('Hide', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->start_controls_tabs(
			'icon_hover_tabs'
		);
		$this->start_controls_tab(
			'icon_normal_tab',
			[
				'label' => __('Normal', 'acea-addons'),
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __('Icon Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .acea-addons-feature-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}} .acea-addons-feature-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .acea-addons-feature-icon.icon-type-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_background',
			[
				'label' => __('Icon Background', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#416ff4',
				'selectors' => [
					'{{WRAPPER}} .icon-background-yes .acea-addons-feature-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'enable_icon_box' => 'yes',
					'enable_gradient!' => 'yes'
				],
			]
		);
		$this->add_control(
			'enable_gradient',
			[
				'label' => __('Enable Gradient', 'acea-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'acea-addons'),
				'label_off' => __('No', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'icon_background_gradient',
				'types'     => ['classic', 'gradient'],
				'fields_options'  => [
					'background'  => [
						'default' => 'classic'
					],
					'color'       => [
						'default' => '#ffffff'
					]
				],
				'condition' => ['enable_gradient' => 'yes'],
				'selector'  => '{{WRAPPER}} .icon-background-yes .acea-addons-feature-icon',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'label' => __('Icon Shadow', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-icon',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => __('Hover', 'acea-addons'),
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label' => __('Icon Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .acea-addons-feature-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .acea-addons-feature-icon svg' => 'color: {{VALUE}}',
					'{{WRAPPER}}:hover .acea-addons-feature-icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}}:hover .acea-addons-feature-icon.icon-type-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_hover_background',
			[
				'label' => __('Icon Background', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .icon-background-yes .acea-addons-feature-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow_hover',
				'label' => __('Icon Shadow', 'acea-addons'),
				'selector' => '{{WRAPPER}}:hover .acea-addons-feature-icon',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'icon_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'icon_text_typo',
				'label' => __('Icon Text Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-icon',
				'condition' => ['icon_type' => 'text']
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __('Icon Size', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => '',
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-icon svg' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'icon',
				]
			]
		);
		$this->add_responsive_control(
			'image_width',
			[
				'label' => __('Image Width', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-image img' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);
		$this->add_responsive_control(
			'image_height',
			[
				'label' => __('Image Height', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-image img' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-image' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);
		$this->add_responsive_control(
			'icon_box_size',
			[
				'label' => __('Icon Box Size', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 70,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-box-item .icon-background-yes .acea-addons-feature-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label' => __('Icon Border Radius', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10'
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .icon-background-yes .acea-addons-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-box-item .icon-background-yes .acea-addons-feature-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_icon_box' => 'yes']
			]
		);
		$this->add_responsive_control(
			'space_between_icon',
			[
				'label' => __('Gap', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10'
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-icon-wrap' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'space_between_title_border',
			[
				'label' => __('Icon Gap', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-icon.icon-type-icon svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['position' => 'left']
			]
		);
		$this->add_control(
			'icon_align',
			[
				'label' => __('Icon Align', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'top',
				'options' => [
					'start' => [
						'title' => __('Top', 'elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __('Center', 'elementor'),
						'icon' => 'fa fa-align-center',
					],
					'end' => [
						'title' => __('Right', 'elementor'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'toggle' => false,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'icon[value]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'image[url]',
							'operator' => '!=',
							'value' => '',
						],
						[
							'name' => 'box_number',
							'operator' => '!=',
							'value' => '',
						],
					],
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __('Icon Border', 'acea-addons'),
				'selector' => '{{WRAPPER}}  .acea-addons-feature-icon',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'content_style',
			[
				'label' => __('Content', 'acea-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->start_controls_tabs(
			'content_tabs'
		);
		$this->start_controls_tab(
			'content_normal_tab',
			[
				'label' => __('Normal', 'acea-addons'),
			]
		);
		$this->add_control(
			'title_br',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => ['enable_box_number' => 'yes']
			]
		);
		$this->add_responsive_control(
			'title_gap',
			[
				'label' => __('Title Gap', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __('Title Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'bottom_title_color',
			[
				'label' => __('Bottom Title Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-bottom-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'bottom_heading_typography',
				'label' => __('Bottom Title Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-bottom-title',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'heading_typography',
				'label' => __('Title Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-title',
			]
		);
		$this->add_control(
			'heading_bg',
			[
				'label' => __('Heading Background Color', 'acea-addons'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-title' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'title_border',
				'label'    => __('Title Border', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-title',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'title_box_shadow',
				'label' => __('Title Box Shadow', 'massmix-ts'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-title',
			]
		);
		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'      => __('Title Border Radius', 'acea-addons'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default'    => [
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => false
				],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-feature-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'upmedix'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'bottom_title_padding',
			[
				'label' => __('Bottom Title Padding', 'upmedix'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-bottom-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'desc_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'desc_gap',
			[
				'label' => __('Description Gap', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'desktop_default' => [
					'size' => 30,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 20,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'desscription_color',
			[
				'label' => __('Description Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'default' => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'label' => __('Description Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-content',
			]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __('Content Padding', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-content p' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'main_content_align',
			[
				'label'     => __('Content Alignment', 'acea-addons'),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'    => [
						'title' => __('Start', 'acea-addons'),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __('Center', 'acea-addons'),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __('Right', 'acea-addons'),
						'icon'  => 'eicon-text-align-right',
					],
					'baseline' => [
						'title' => __('Baseline', 'acea-addons'),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item'  => 'align-items: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'content_hover_tab',
			[
				'label' => __('Hover', 'acea-addons'),
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'label' => __('Title Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .acea-addons-feature-title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'desscription_color_hover',
			[
				'label' => __('Description Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}:hover .acea-addons-feature-content' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// designation

		$this->start_controls_section(
			'designation_style',
			[
				'label' => __('Designation', 'acea-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'enable_designation' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'designation_typography',
				'label' => __('Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}}.acea-addons-feature-content span.designation',

			]
		);

		$this->add_control(
			'designation_color',
			[
				'label' => __('Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-content span.designation ' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_responsive_control(
			'designation_gap',
			[
				'label' => __('Gap', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-content span.designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-content span.designation ' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				]

			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'button_style',
			[
				'label' => __('Button', 'acea-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->start_controls_tabs(
			'btn_style_tabs'
		);
		$this->start_controls_tab(
			'btn_style_normal_tab',
			[
				'label' => __('Normal', 'acea-addons'),
			]
		);

		$this->add_control(
			'icon_box_visibility',
			[
				'label' => esc_html__( 'Visibility', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'visible',
				'options' => [
					'visible'  => esc_html__( 'Visibility', 'acea-addons' ),
					'hidden' => esc_html__( 'Hidden', 'acea-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'visibility:{{VALUE}};',
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-icon-position-top:hover span.btn-icon' => 'visibility:{{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_box_opasity',
			[
				'label' => esc_html__( 'Opasity', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0'  => esc_html__( '0', 'acea-addons' ),
					'1' => esc_html__( '1', 'acea-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-feature-btn' => 'opacity: {{VALUE}};',
					'{{WRAPPER}}  .acea-addons-feature-box-item .acea-addons-icon-position-top:hover span.btn-icon' => 'opacity: {{VALUE}};',
				],
				'condition' => [
					'icon_box_visibility' => 'hidden'
				]
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'label' => __('Button Typography', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn',
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => __('Button Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'button_background',
			[
				'label' => __('Button Background Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'btn_icon_color',
			[
				'label' => __('Icon Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-btn .btn-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .acea-addons-feature-btn .btn-icon path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_icon_fill_color',
			[
				'label' => __('SVG Fill Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-btn .btn-icon path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => __('Button width', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-btn' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_responsive_control(
			'btn_icon_size',
			[
				'label' => __('Button Icon Size', 'acea-addons'),
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
					'{{WRAPPER}}  .acea-addons-feature-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}  .acea-addons-feature-btn svg' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_responsive_control(
			'space_between_btn',
			[
				'label' => __('Button Icon Gap', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-btn .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}}  .acea-addons-feature-btn .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_responsive_control(
			'space_between_btn_svg',
			[
				'label' => __('Icon svg Gap', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-btn .btn-icon svg' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border',
				'label' => __('Border', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn',
			]
		);
		$this->add_control(
			'btn_hover_br',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);
		$this->add_responsive_control(
			'button_padding',
			[
				'label' => __('Button Padding', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '20',
					'right' => '45',
					'bottom' => '20',
					'left' => '45'
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' => __('Button Border Radius', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'btn_style_hover_tab',
			[
				'label' => __('Hover', 'acea-addons'),
			]
		);
		$this->add_control(
			'icon_hover_box_visibility',
			[
				'label' => esc_html__( 'Visibility', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'visible',
				'options' => [
					'visible'  => esc_html__( 'Visibility', 'acea-addons' ),
					'hidden' => esc_html__( 'Hidden', 'acea-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item:hover .acea-addons-feature-btn' => 'visibility:{{VALUE}};',
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-icon-position-top:hover span.btn-icon' => 'visibility:{{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_box_opasity',
			[
				'label' => esc_html__( 'Opasity', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '0',
				'options' => [
					'0'  => esc_html__( '0', 'acea-addons' ),
					'1' => esc_html__( '1', 'acea-addons' ),
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item:hover .acea-addons-feature-btn' => 'opacity: {{VALUE}};',
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-icon-position-top:hover span.btn-icon' => 'opacity: {{VALUE}};',

				],
				'condition' => [
					'icon_hover_box_visibility' => 'visible'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_border_hover',
				'label' => __('Border', 'acea-addons'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item:hover .acea-addons-feature-btn',
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => __('Button Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn:hover' => 'color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'button_hover_background',
			[
				'label' => __('Button Background Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item .acea-addons-feature-btn:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_control(
			'btn_icon_color_hover',
			[
				'label' => __('Icon Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-btn:hover .btn-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .acea-addons-feature-btn:hover .btn-icon path' => 'stroke: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'btn_icon_fill_color_hover',
			[
				'label' => __('SVG Fill Color', 'acea-addons'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-btn:hover .btn-icon path' => 'fill: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'disable_hover_effect',
			[
				'label' => __('Disable Deafault Hover Effect', 'acea-addons'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'acea-addons'),
				'label_off' => __('No', 'acea-addons'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
		$this->add_responsive_control(
			'space_between_btn_hover',
			[
				'label' => __('Button Icon Gap', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'devices' => ['desktop', 'tablet', 'mobile'],
				'selectors' => [
					'{{WRAPPER}}  .acea-addons-feature-btn:hover .btn-icon' => 'transform: translatex( {{SIZE}}{{UNIT}} );',
					'body.rtl {{WRAPPER}}  .acea-addons-feature-btn:hover .btn-icon' => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->add_responsive_control(
			'button_hover_padding',
			[
				'label' => __('Button Padding', 'acea-addons'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default'	=>	[
					'top' => '20',
					'right' => '45',
					'bottom' => '20',
					'left' => '45'
				],
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item:hover .acea-addons-feature-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .acea-addons-feature-box-item:hover .acea-addons-feature-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
				],
				'condition' => ['enable_button' => 'yes']
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
		$this->start_controls_section(
			'section_content_box_style',
			[
				'label' => __('Box', 'fastland-hp'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'wrapper_content_align',
			[
				'label'     => __('Content Alignment', 'acea-addons'),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start'    => [
						'title' => __('Start', 'acea-addons'),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => __('Center', 'acea-addons'),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [
						'title' => __('Right', 'acea-addons'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item'  => 'justify-content: {{VALUE}};',
				],
			]
		);
		$this->start_controls_tabs(
			'box_style_tabs'
		);
		$this->start_controls_tab(
			'box_style_normal_tab',
			[
				'label' => __('Normal', 'fastland-hp'),
			]
		);
		$this->add_control(
			'box_bg_color',
			[
				'label'     => __('Box Backgroound Color', 'fastland-hp'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __('Box Hover Shadow', 'fastland-hp'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_border',
				'label'    => __('Box Border', ''),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item',
			]
		);
		$this->add_responsive_control(
			'box-width',
			[
				'label' => __('Width', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
					'{{WRAPPER}} .acea-addons-feature-box-item' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box-height',
			[
				'label' => __('Height', 'acea-addons'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
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
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_radius',
			[
				'label'      => __('Box Radius', 'fastland-hp'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-feature-box-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => __('Box Padding', 'fastland-hp'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-feature-box-item ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'box_style_hover_tab',
			[
				'label' => __('Hover', 'fastland-hp'),
			]
		);
		$this->add_control(
			'box_hover_bg_color',
			[
				'label'     => __('Box Backgroound Color', 'fastland-hp'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'defautl'   => '#233aff',
				'selectors' => [
					'{{WRAPPER}} .acea-addons-feature-box-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_responsive_control(
			'box_hover_radius',
			[
				'label'      => __('Box Radius', 'fastland-hp'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .acea-addons-feature-box-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_hover_shadow',
				'label'    => __('Box Hover Shadow', 'fastland-hp'),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item:hover',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box_hover_border',
				'label'    => __('Box Border', ''),
				'selector' => '{{WRAPPER}} .acea-addons-feature-box-item:hover ',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$target = ($settings['button_url']['is_external']) ? ' target="_blank"' : '';
		$nofollow = ($settings['button_url']['nofollow']) ? ' rel="nofollow"' : '';
		$this->add_inline_editing_attributes('title', 'none');
		$this->add_inline_editing_attributes('description', 'basic');
		$enable_iconb_box = ($settings['enable_icon_box']) ? 'yes' : 'no';
?>
		<!-- box link  -->
		<?php if ('yes' != $settings['enable_button'] && !empty($settings['button_url']['url'])) {
			echo '<a class="d-block" href="' . $settings['button_url']['url'] . '" ' . $nofollow, $target . '>';
		} ?>
		<!-- box link  -->
		<div class="acea-addons-feature-box-item <?php printf("acea-addons-feature-icon-%s acea-addons-icon-position-%s",  esc_attr($settings['content_align']), esc_attr($settings['position'])) ?>">
			<?php
			if ('yes' === $settings['show_icon_box']) {
				if (!empty($settings["icon"]['value']) || !empty($settings['image']) || !empty($settings['box_number'])) { ?>
					<div class="acea-addons-feature-icon-wrap <?php printf("icon-background-%s align-items-%s", esc_attr($enable_iconb_box), esc_attr($settings['icon_align'])) ?>">
						<span class="acea-addons-feature-icon icon-type-<?php echo $settings['icon_type'] ?>">
							<?php
							if ('text' == $settings['icon_type']) {
								echo esc_html($settings['box_number']);
							} elseif ('image' == $settings['icon_type']) {
								echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings);
							} else {
								\Elementor\Icons_Manager::render_icon($settings["icon"], ['aria-hidden' => 'true']);
							}
							?>
						</span>
					</div>
			<?php }
			} ?>
			<div class="acea-addons-feature-content-wrap">
				<div class="acea-addons-feature-content">
					<?php if (!empty($settings['title'])) : ?>
						<h4 class="acea-addons-feature-title"><?php echo $settings['title'] ?></h4>
					<?php endif; ?>
					<?php if( 'yes' == $settings['enable_designation'] ): ?>
					<span class="designation" ><?php echo esc_html( $settings['icon_box_designation'] ); ?></span>
					<?php endif; ?>
					<?php if (!empty($settings['description'])) : ?>
						<p><?php echo $settings['description'] ?></p>
					<?php endif; ?>
					<?php if (!empty($settings['bottom_title'])) : ?>
						<h4 class="acea-addons-feature-bottom-title"><?php echo $settings['bottom_title'] ?></h4>
					<?php endif; ?>
				</div>
				<?php if ('yes' == $settings['enable_button']) { ?>
					<a <?php printf('href="%s" %s %s', $settings['button_url']['url'], $nofollow, $target) ?> class="acea-addons-feature-btn acea-addons-btn btn-type-boxed d-inline-block <?php printf('disable-default-hover-%s', $settings['disable_hover_effect']); ?>">
						<?php echo $settings['button_text']; ?>
						<span class="btn-icon">
							<?php \Elementor\Icons_Manager::render_icon($settings["btn_icon"], ['aria-hidden' => 'true']); ?>
						</span>
					</a>
				<?php } ?>
			</div>
		</div>
		<!-- box link  -->
		<?php if ('yes' != $settings['enable_button'] && !empty($settings['button_url']['url'])) {
			echo "</a>";
		}
		?>
		<!-- box link  -->
<?php
	}
	protected function content_template()
	{
	}
}
$widgets_manager->register_widget_type(new \Acea_Addons\Widgets\Acea_Feature_Box());
