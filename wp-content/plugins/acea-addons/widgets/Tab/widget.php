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
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\utils;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class AceaTab extends \Elementor\Widget_Base
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
    public function get_name()
    {
        return 'acea-tab';
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
    public function get_title()
    {
        return __('Acea Tab', 'acea-addons');
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
    public function get_icon()
    {
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
    public function get_categories()
    {
        return ['acea-addons'];
    }
    public function get_keywords()
    {
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
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Tabs', 'acea-addons'),
            ]
        );

        $this->add_control(
            'tab_style',
            [
                'label'     => __('Testimonial Style', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'style-one',
                'options'   => [
                    'style-one' => __('Style One', 'acea-addons'),
                    'style-two' => __('Style Two', 'acea-addons'),
                ],
                'separator' => 'after',
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
            ]
        );
        //content fields
        $repeater->add_control(
            'list_icon',
            [
                'label'       => __('Icon', 'acea-addons'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label'       => __('Button Text', 'acea-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'button_content',
            [
                'label'       => __('Button Content', 'acea-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        // tab style on
        $repeater->add_control(
			'content_image',
			[
				'label' => esc_html__( 'Choose Image', 'plugin-name' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
        //End Repeater Control field
        $this->add_control(
            'tab',
            [
                'label'        => __('Tab List', 'acea-addons'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater->get_controls(),
                'default'      => [
                    [

                        'button_text'      => __('Analytics', 'acea-addons'),
                        'active_tabs'       =>   'yes',
                        'list_icon'        => [
                            'value'   => 'fa fa-chart-pie',
                            'library' => 'fa-solid',
                        ],
                    ],

                    [

                        'button_text'      => __('Advertisement', 'acea-addons'),
                        'list_icon'        => [
                            'value'   => 'far fa-flag',
                            'library' => 'fa-solid',
                        ],
                    ],

                    [

                        'button_text'      => __('Sales Report', 'acea-addons'),
                        'list_icon'        => [
                            'value'   => 'fas fa-chart-line',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'button_title' => '{{{ button_text }}}',
                'condition' => [
                    'tab_style' => 'style-one',
                ]
            ]
        );
        //Start Repetare Content  tab Two
        $repeater_two = new Repeater();
        $repeater_two->add_control(
            'active_tabs',
            [
                'label'     => __('Active Item', 'acea-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => __('No', 'acea-addons'),
                'label_off' => __('yes', 'acea-addons'),
            ]
        );
        //content fields
        $repeater_two->add_control(
            'button_text_two',
            [
                'label'       => __('Button Text', 'acea-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater_two->add_control(
            'tab_imgae',
            [
                'label'     => __('Image', 'acea-addons'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        // tab style two
        $repeater_two->add_control(
            'big_headding',
            [
                'label'       => __('Big Heading', 'acea-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'headding_tab_bar_one',
            [
                'label'     => __('Icon Box One', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'separator' => 'after',
            ]
        );

        $repeater_two->add_control(
            'list_icon',
            [
                'label'       => __('Icon', 'acea-addons'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater_two->add_control(
            'tab_headding_one',
            [
                'label'       => __('Heading', 'acea-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'tab_content_one',
            [
                'label'       => __('Content', 'acea-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'headding_tab_bar',
            [
                'label'     => __('Icon Box Two', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                'separator' => 'after',
            ]
        );

        // box one
        $repeater_two->add_control(
            'list_icon_two',
            [
                'label'       => __('Icon Two', 'acea-addons'),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,
            ]
        );
        $repeater_two->add_control(
            'tab_headding_two',
            [
                'label'       => __('Heading', 'acea-addons'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater_two->add_control(
            'tab_content_two',
            [
                'label'       => __('Content', 'acea-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tab_two',
            [
                'label'        => __('Tab List Two', 'acea-addons'),
                'type'         => Controls_Manager::REPEATER,
                'fields'       => $repeater_two->get_controls(),
                'default'      => [
                    [
                        'tab_imgae' => ['url' => Utils::get_placeholder_image_src()],
                        'big_headding'     => __('Best features for your project management.', 'acea-addons'),
                        'button_text_two'      => __('Project  Management', 'acea-addons'),
                        'tab_headding_one' => __('Manage Smartly', 'acea-addons'),
                        'tab_content_one'  => __('Create custom landing pages with Acea', 'acea-addons'),
                        'list_icon'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                        'tab_headding_two' => __('Daily email reports', 'acea-addons'),
                        'tab_content_two'  => __('Create custom landing pages with Acea', 'acea-addons'),
                        'active_tabs'       =>   'yes',
                        'list_icon_two'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'tab_imgae' => ['url' => Utils::get_placeholder_image_src()],
                        'big_headding'     => __('Best features for your project management.', 'acea-addons'),
                        'button_text_two'      => __('Task Management', 'acea-addons'),
                        'tab_headding_one' => __('Manage Smartly', 'acea-addons'),
                        'tab_content_one'  => __('Create custom landing pages with Acea', 'acea-addons'),
                        'list_icon'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                        'tab_headding_two' => __('Daily email reports', 'acea-addons'),
                        'tab_content_two'  => __('Create custom landing pages with Acea', 'acea-addons'),
                        'list_icon_two'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'tab_imgae' => ['url' => Utils::get_placeholder_image_src()],
                        'big_headding'     => __('Best features for your project management.', 'acea-addons'),
                        'button_text_two'      => __('Dark Mode', 'acea-addons'),
                        'tab_headding_one' => __('Manage Smartly', 'acea-addons'),
                        'tab_content_one'  => __('Create custom landing pages with Acea', 'acea-addons'),
                        'list_icon'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                        'tab_headding_two' => __('Daily email reports', 'acea-addons'),
                        'tab_content_two'  => __('Create custom landing pages with Acea', 'acea-addons'),
                        'list_icon_two'        => [
                            'value'   => 'fa fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],

                ],
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );
        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'icon_style_tabs'
        );

        // normal
        $this->start_controls_tab(
            'tab_icon_normal_color',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-tab-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-tab-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_color_stock',
            [
                'label'     => __('Stroke Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-tab-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-tab-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __('Size', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-icon'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-tab-icon' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // active
        $this->start_controls_tab(
            'tab_icon_active_color',
            [
                'label' => __('Active', 'acea-addons'),
            ]
        );

        $this->add_control(
            'icon_color_active',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li.current .acea-tab-icon i,
                    {{WRAPPER}} .acea--tab-menu ul li:hover .acea-tab-icon i,
                    {{WRAPPER}} .acea--tab-menu ul li.current .acea-tab-icon svg path' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea--tab-menu ul li:hover .acea-tab-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_color_active_stroke',
            [
                'label'     => __('stroke Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li.current .acea-tab-icon i,
                     {{WRAPPER}} .acea--tab-menu ul li:hover .acea-tab-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea--tab-menu ul li.current .acea-tab-icon svg path,
                     {{WRAPPER}} .acea--tab-menu ul li:hover .acea-tab-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //Tab
        $this->start_controls_section(
            'menu_box_style',
            [
                'label' => __('Tab', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_text_typo',
                'label'    => __('Title Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea--tab-menu ul li',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_content_typo',
                'label'    => __('Content Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea--tab-menu ul li p',
            ]
        );
        $this->start_controls_tabs(
            'style_tabs'
        );
        // normal
        $this->start_controls_tab(
            'icon_',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Title Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_content_color',
            [
                'label'     => __('Content Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_bg',
            [
                'label'     => __('Backround Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'menu_border',
                'selector' => '{{WRAPPER}} .acea--tab-menu ul li',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'menu_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea--tab-menu ul li',
            ]
        );

        $this->add_responsive_control(
            'menu_content_margin',
            [
                'label'      => __('Content Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu ul li p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu ul li p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu ul li'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu ul li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_box_margin',
            [
                'label'      => __('Margin Item', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu ul li'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu ul li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_box_margin_box',
            [
                'label'      => __('Margin Full Box', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu.style-two '          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu.style-two ' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'menu_box_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu ul li'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu ul li' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        // hover
        $this->start_controls_tab(
            'tn_bg_color_active',
            [
                'label' => __('Active', 'shadepro-ts'),
            ]
        );

        $this->add_control(
            'button_text_active_color',
            [
                'label'     => __('Title Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li.current span, {{WRAPPER}} .acea--tab-menu ul li span:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_active',
            [
                'label'     => __('Backround Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-menu ul li.tab-link.current' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'advance_box_bg',
                'label' => __( 'Advance Background', 'acea-addons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .acea--tab-menu ul li.tab-link.current',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'menu_border_active',
                'selector' => '{{WRAPPER}} .acea--tab-menu ul li.tab-link.current',
                'condition' => [
                    'tab-style' => 'style-one',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'menu_shadow_active',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea--tab-menu ul li.tab-link.current',
            ]
        );

        $this->add_responsive_control(
            'menu_border_radius_active',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu ul li.tab-link.current'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu ul li.tab-link.current' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_item_active_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-menu ul li.tab-link.current'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-menu ul li.tab-link.current' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        //content and headding
        $this->start_controls_section(
            'discription_style',
            [
                'label' => __('Content', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // title
        $this->add_control(
            'title_headding',
            [
                'label'     => __('Title', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea--tab-content h3',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-content h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-content h3'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-content h3' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        // title
        $this->add_control(
            'content_heading',
            [
                'label'     => __('Content', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dis_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}  .acea--tab-content p',
            ]
        );
        $this->add_control(
            'dis_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea--tab-content p' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'dis_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-content p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-content p' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Headding
        $this->start_controls_section(
            'heading_style',
            [
                'label' => __('Heading', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-tab-big-heading h2',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-tab-big-heading h2' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-big-heading h2'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-tab-big-heading h2' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Image
        $this->start_controls_section(
            'contentbox_style',
            [
                'label' => __('Content Box', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_style' => 'style-one',
                ]
            ]
        );
        $this->add_responsive_control(
            'contentbox_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-content'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-content' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'contentbox_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .acea--tab-content'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea--tab-content' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Image
        $this->start_controls_section(
            'iamge_style',
            [
                'label' => __('Image', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'iamge_align',
            [
                'label' => __('Align', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selector'  => [
                    '{{WRAPPER}} .acea-tab-image img' => 'text-align: {{SIZE}}{{UNIT}};',
                ],
                'toggle' => true,
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label'      => __('Width', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'space',
            [
                'label'      => __('Max Width', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
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
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'height',
            [
                'label'      => __('Height', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                ],
                'size_units' => ['px', '%', 'vh'],
                'range'      => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-image img' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'acea-addons'),
                'type'      => Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'acea-addons'),
                    'fill'    => __('Fill', 'acea-addons'),
                    'cover'   => __('Cover', 'acea-addons'),
                    'contain' => __('Contain', 'acea-addons'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .acea-tab-image img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .acea-tab-image img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-image img'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-tab-image img' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-image img'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-tab-image img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-tab-image img',
            ]
        );
        $this->end_controls_section();

        //Tba Right
        $this->start_controls_section(
            'right_box',
            [
                'label' => __('Righit Content Box', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'tab_style' => 'style-two',
                ]
            ]
        );

        $this->add_responsive_control(
            'right_content_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-tab-content-iconbox'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-tab-content-iconbox' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
    protected function render()
    {
        $settings = $this->get_settings();

        $tab_list = $settings['tab'];
        $tab_two = $settings['tab_two'];
        $tab_id = rand(1000,100000)

?>
        <div class="acea--tab-wraper">
            <?php if ($settings['tab_style'] == 'style-one') : ?>
                <div class="row align-items-center justify-content-center">
                    <div class="col-xxl-5 col-xl-5 col-lg-10 col-md-12">
                        <div class="acea--tab-left">
                            <div class="acea--tab-menu">
                                <ul class="tabs">
                                    <?php foreach ($tab_list as $key => $value) :
                                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                                    ?>
                                        <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($key . $tab_id) ?>">

                                            <div class="tab-list-content-icon">
                                                <?php if ($value['list_icon']) : ?>
                                                    <div class="acea-tab-icon">
                                                        <?php \Elementor\Icons_Manager::render_icon($value['list_icon'], ['aria-hidden' => 'true']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="tab-list-content">
                                                <?php if ($value['button_text']) : ?>
                                                    <span><?php echo esc_html($value['button_text']); ?></span>
                                                <?php endif; ?>
                                                <?php if ($value['button_content']) : ?>
                                                    <div class="acea-tab-list-content">
                                                        <p><?php echo esc_html($value['button_content']); ?></p>
                                                    </div>
                                                <?php endif; ?>

                                            </div>

                                        <?php endforeach;
                                    $key++ ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7 col-xl-7 col-lg-10 col-md-12">
                        <div class="acea--tab-right">
                            <?php foreach ($tab_list as $key => $value) :
                                $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                            ?>
                                <div id="tab-<?php echo esc_attr($key . $tab_id) ?>" class="acea-tab-content-single animated fadeInUp  <?php echo esc_attr($active) ?>">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="acea--tab-content">
                                                <div class="tab-content-image acea-tab-image">
                                                <?php echo wp_get_attachment_image( $value['content_image']['id'], 'full' );?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                            $key++ ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- STYLE TWO -->
            <?php if ($settings['tab_style'] == 'style-two') : ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="acea--tab-left">
                            <div class="acea--tab-menu style-two">
                                <ul class="tabs">
                                    <?php foreach ($tab_two as $key => $value) :
                                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                                    ?>
                                        <li class="tab-link <?php echo esc_attr($active) ?>" data-tab="tab-<?php echo esc_attr($key . $tab_id) ?>">

                                            <?php if ($value['button_text_two']) : ?>
                                                <span><?php echo esc_html($value['button_text_two']); ?></span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach;
                                    $key++ ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="acea--tab-content-two-wrap <?php echo esc_html($settings['tab_style']) ?>">
                    <?php foreach ($tab_two as $key => $value) :
                        $active = $value['active_tabs'] == 'yes' ? 'current' : '';
                        $image = wp_get_attachment_image_url($value['tab_imgae']['id'], 'full');
                        if (!$image) {
                            $image = Utils::get_placeholder_image_src();
                        };
                    ?>
                        <div id="tab-<?php echo esc_attr($key . $tab_id) ?>" class="acea-tab-content-single animated fadeInUp  <?php echo esc_attr($active) ?>">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <div class="acea-tab-image">
                                        <img src="<?php echo esc_url($image) ?>" alt="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="acea-tab-content-iconbox">

                                        <div class="acea-tab-big-heading">
                                            <h2><?php echo esc_html($value['big_headding']); ?></h2>
                                        </div>
                                        <div class="acea--tab-content">
                                            <?php if ($value['list_icon']) : ?>
                                                <div class="acea-tab-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($value['list_icon'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="acea-icon-content">
                                                <h3><?php echo esc_html($value['tab_headding_one']) ?></h3>
                                                <?php echo acea_get_meta($value['tab_content_one']); ?>
                                            </div>

                                        </div>
                                        <div class="acea--tab-content">
                                            <?php if ($value['list_icon']) : ?>
                                                <div class="acea-tab-icon">
                                                    <?php \Elementor\Icons_Manager::render_icon($value['list_icon_two'], ['aria-hidden' => 'true']); ?>
                                                </div>
                                            <?php endif; ?>
                                            <div class="acea-icon-content">
                                                <h3><?php echo esc_html($value['tab_headding_two']) ?></h3>
                                                <?php echo acea_get_meta($value['tab_content_two']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    $key++ ?>
                </div>
            <?php endif; ?>
        </div>
<?php
    }
}
$widgets_manager->register_widget_type(new \AceaTab());
