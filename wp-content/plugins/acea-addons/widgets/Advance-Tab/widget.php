<?php
/**
 * Tab
 *
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\DIVIDER;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\utils;
use Elementor\Widget_Base;
if (!defined('ABSPATH')) {
    exit;
}
class Acea_Advanced_Tabs extends \Elementor\Widget_Base {
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
        return 'acea-advance-tab';
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
        return __('Acea Advance Tabs', 'acea-addons');
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
        return 'eicon-tabs';
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
    public function get_keywords() {
        return ['tabs', 'tab', 'acea-addons', 'acc'];
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
            'section_content',
            [
                'label' => __('Tabs', 'acea-addons'),
            ]
        );
        //Start Repetare Content  tab one
        $repeater = new Repeater();
        $repeater->add_control(
            'active_tabs',
            [
                'label'     => __('Active Item', 'acea-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('No', 'acea-addons'),
                'label_off' => __('yes', 'acea-addons'),
                'default' => 'no',
            ]
        );
        $repeater->add_control(
            'tab_icon', [
                'label'       => __('Tab Icon', 'acea-addons'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'tab_title', [
                'label'       => __('Tab Title', 'acea-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
			'selected_template',
			[
				'label' => __( 'Select Template', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => acea_addons_cpt_slug_and_id('elementor_library'),
			]
		);
        //End Repeater Control field
        $this->add_control(
            'tabs',
            [
                'label'        => __('Tab List', 'acea-addons'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );
        $this->end_controls_section();
          /**
         * Style tab
         */
        $this->start_controls_section(
            'tab_icon_style',
            [
                'label' => __( 'Tab Icon', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
					'tab_icon[value]!' => '',
				],
            ]
        );
        $this->start_controls_tabs(
            'icon_style_tabs'
        );
        $this->start_controls_tab(
            'icon_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __( 'Icon Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_fill_color',
            [
                'label'     => __( 'Icon Fill Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_bg_color',
            [
                'label'     => __( 'Icon Background', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_gap',
            [
                'label'      => __( 'Icon gap', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon'          => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label'      => __( 'Icon Size', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_box_size',
            [
                'label'      => __( 'Icon Box Size', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon' => 'width: {{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}; display:inline-flex; align-items:center;justify-content:center',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_box_radius',
            [
                'label'      => __( 'Border Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .tabs .acea-addons-tab-icon'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'icon_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .acea-addons-tab-icon,{{WRAPPER}} .tabs li.current .acea-addons-tab-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tabs li:hover .acea-addons-tab-icon path,{{WRAPPER}} .tabs li.current .acea-addons-tab-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_fill_color_hover',
            [
                'label'     => __( 'Icon Fill Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .acea-addons-tab-icon path,{{WRAPPER}} .tabs li.current .acea-addons-tab-icon path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_bg_color_hover',
            [
                'label'     => __( 'Icon Background', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tabs li:hover .acea-addons-tab-icon, {{WRAPPER}} .tabs li.current .acea-addons-tab-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'tab_link_style',
            [
                'label' => __( 'Tab Links', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'tabs_style_tabs'
        );
        $this->start_controls_tab(
            'tabs_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-addons' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'tabs_typography',
                'label'    => __( 'Typography', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li',
            ]
        );
        $this->add_control(
            'tabs_color',
            [
                'label'     => __( 'Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_background',
            [
                'label'     => __( 'Background Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_border',
                'label'    => __( 'Border', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_shadow',
                'label'    => __( 'Shadow', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li',
            ]
        );
        $this->add_responsive_control(
            'tabs_width',
            [
                'label'      => __( 'Min Width', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li'          => 'min-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_height',
            [
                'label'      => __( 'Min Height', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li'          => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_radius',
            [
                'label'      => __( 'Border Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_padding',
            [
                'label'      => __( 'Padding', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons--tab-menu ul.tabs>li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_margin',
            [
                'label'      => __( 'Margin', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'tabs_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'tabs_hover_color',
            [
                'label'     => __( 'Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li.current' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'tabs_hover_background',
            [
                'label'     => __( 'Background Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_hover_border',
                'label'    => __( 'Border', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li.current',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_hover_shadow',
                'label'    => __( 'Tabs Shadow', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li.current',
            ]
        );
        $this->add_responsive_control(
            'tabs_hover_radius',
            [
                'label'      => __( 'Border Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li:hover,{{WRAPPER}} .acea-addons--tab-menu ul.tabs>li.current'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons--tab-menu ul.tabs>li:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'tabs_wrap_style',
            [
                'label' => __( 'Tabs', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'tabs_align',
            [
                'label'        => __( 'Box Align', 'acea-addons' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'top', 'acea-addons' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                    'justify'  => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon'  => 'fa fa-align-justify',
                    ],
                ],
                'devices'      => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu' => 'text-align: {{VALUE}}',
                ],                
                'toggle'       => true,
            ]
        );
        $this->add_responsive_control(
			'tabs_justify_content',
			[
				'label' => __( 'Horizontal Align', 'acea-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
                    '' => __('Default', 'acea-addons'),
                    'flex-start' => __( 'Start', 'acea-addons' ),
                    'center' => __( 'Center', 'acea-addons' ),
                    'flex-end' => __( 'End', 'acea-addons' ),
                    'space-between' => __( 'Space Between', 'acea-addons' ),
                    'space-around' => __( 'Space Around', 'acea-addons' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs' => 'justify-content: {{VALUE}}',
                ], 
			]
		);
        $this->add_control(
            'tabs_ul_background',
            [
                'label'     => __( 'Background Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_ul_shadow',
                'label'    => __( 'Shadow', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_ul_border',
                'label'    => __( 'Border', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-menu ul.tabs',
            ]
        );
        $this->add_responsive_control(
            'tab_ul_width',
            [
                'label'      => __( 'Width', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_radius',
            [
                'label'      => __( 'Border Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_padding',
            [
                'label'      => __( 'Padding', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons--tab-menu ul.tabs' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_ul_margin',
            [
                'label'      => __( 'Margin', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-menu ul.tabs' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'tabs_content_style',
            [
                'label' => __( 'Content Box', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tabs_content_background',
            [
                'label'     => __( 'Background Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons--tab-content-wrap' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'tabs_content_shadow',
                'label'    => __( 'Shadow', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-content-wrap',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'tabs_content_border',
                'label'    => __( 'Border', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-addons--tab-content-wrap',
            ]
        );
        $this->add_responsive_control(
            'tab_content_width',
            [
                'label'      => __( 'Width', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-content-wrap'          => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_radius',
            [
                'label'      => __( 'Border Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-content-wrap'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_padding',
            [
                'label'      => __( 'Padding', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-content-wrap'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'tabs_content_margin',
            [
                'label'      => __( 'Margin', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons--tab-content-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    //End Repetare Content
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
        $settings = $this->get_settings();
        ?>
            <div class="acea-addons-tabs-wrapper">
                <div class="acea-addons--tab-menu-wrap">
                    <div class="acea-addons--tab-menu">
                        <ul class="tabs">
                            <?php foreach ($settings['tabs'] as $value):
                                    $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                                    ?>
	                                <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($value['_id']) ?>">
	                                    <?php if ($value['tab_icon']['value']): ?>
	                                        <div class="acea-addons-tab-icon">
	                                            <?php \Elementor\Icons_Manager::render_icon($value['tab_icon'], ['aria-hidden' => 'true']);?>
	                                        </div>
	                                    <?php endif;?>
                                    <?php if ($value['tab_title']): ?>
                                        <span><?php echo esc_html($value['tab_title']); ?></span>
                                    <?php endif;?>
                                </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <div class="acea-addons--tab-content-wrap">
                <?php foreach ($settings['tabs'] as $value):
                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                        ?>
	                    <div id="tab-<?php echo esc_attr($value['_id']) ?>" class="acea-addons-tab-content-single animated fadeInUp  
                        <?php echo esc_attr($active) ?>">
                            <?php
                            if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
                                echo '<div class="acea-addons-elm-edit-wrap"><a href="'.\Elementor\Plugin::$instance->documents->get( $value['selected_template'] )->get_edit_url().'" class="acea-addons-elm-edit">'.esc_html__('Edit Template', 'acea-addons').'</a></div>';
                            }
                            ?>
	                        <?php echo acea_addons_layout_content($value['selected_template']) ?>
	                    </div>
	                <?php endforeach;?>
                </div>
            </div>
	<?php
}
}
$widgets_manager->register_widget_type(new \Acea_Advanced_Tabs());
