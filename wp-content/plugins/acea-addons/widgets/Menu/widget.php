<?php
namespace Acea\Widgets;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Main_Menu extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'acea-main-menu';
    }
    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Primary Menu', 'acea-hp' );
    }
    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-nav-menu';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['acea-addons'];
    }
    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.3.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus() {
        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) {
            $options[$menu->slug] = $menu->name;
        }
        return $options;
    }
    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        /**
         * Style tab
         */
        $this->start_controls_section(
            'general',
            [
                'label' => __( 'Content', 'acea-hp' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'use_main_menu',
            [
                'label'        => __( 'Use Main Menu', 'acea-hp' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'acea-hp' ),
                'label_off'    => __( 'No', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $menus = $this->get_available_menus();
        if ( !empty( $menus ) ) {
            $this->add_control(
                'primary_menu',
                [
                    'label'        => __( 'Menu', 'header-footer-elementor' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    /* translators: %s Nav menu URL */
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'header-footer-elementor' ), admin_url( 'nav-menus.php' ) ),
                    'condition'    => [
                        'use_main_menu!' => 'yes',
                    ],
                ]
            );
        } else {
            $this->add_control(
                'menu',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    /* translators: %s Nav menu URL */
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'header-footer-elementor' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                ]
            );
        }
        $this->add_control(
            'menu_style',
            [
                'label'   => __( 'Border Style', 'acea-hp' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'inline',
                'options' => [
                    'inline' => __( 'Inline', 'acea-hp' ),
                    'flyout' => __( 'Flyout', 'acea-hp' ),
                ],
            ]
        );
        $this->add_control(
            'trigger_label',
            [
                'label' => __( 'Trigger Label', 'acea-hp' ),
                'type'  => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'trigger_open_icon',
            [
                'label'   => __( 'Trigger Icon', 'acea-hp' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'fa fa-align-justify',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'trigger_close_icon',
            [
                'label'   => __( 'Trigger Close Icon', 'acea-hp' ),
                'type'    => Controls_Manager::ICONS,
                'default' => [
                    'value'   => 'far fa-window-close',
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_align',
            [
                'label'     => __( 'Align', 'acea-hp' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'flex-start' => [
                        'title' => __( 'Left', 'acea-hp' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center'     => [
                        'title' => __( 'top', 'acea-hp' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'flex-end'   => [
                        'title' => __( 'Right', 'acea-hp' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'default'   => 'flex-end',
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .navbar-nav' => 'justify-content: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'button1',
            [
                'label' => __( 'Header Buttons', 'acea-hp' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
			'button_align',
			[
				'label' => esc_html__( 'Dual Button Align', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'plugin-name' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'plugin-name' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'plugin-name' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'flex-end',
				'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .acea-main-menu-wrap .acea-header-buttons' => 'justify-content: {{VALUE}}',

                ],
			]
		);

        $this->start_controls_tabs( 'acea_dual_button_content_tabs' );
        $this->start_controls_tab( 'acea_dual_button_primary_button_content', [
            'label' => esc_html__( 'Primary', 'acea-addons' ),
        ]
        );
        $this->add_control(
            'enable_primary_btn',
            [
                'label'        => __( 'Enable Primary Button?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'acea-hp' ),
                'label_off'    => __( 'No', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );
        $this->add_control(
            'acea_dual_button_primary_button_text',
            [
                'label'       => esc_html__( 'Text', 'acea-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'VIEW DEMO', 'acea-addons' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_primary_button_url',
            [
                'label'         => esc_html__( 'Link', 'acea-addons' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => __( 'https://your-link.com', 'acea-addons' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true,
                ],
                'condition'     => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_primary_button_icon',
            [
                'label'     => esc_html__( 'Icon', 'acea-addons' ),
                'type'      => Controls_Manager::ICONS,
                'condition' => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_primary_button_icon_position',
            [
                'label'     => __( 'Icon Position', 'acea-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'options'   => [
                    'acea-icon-pos-left'  => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon'  => 'eicon-angle-left',
                    ],
                    'acea-icon-pos-right' => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon'  => 'eicon-angle-right',
                    ],
                ],
                'default'   => 'acea-icon-pos-left',
                'condition' => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab( 'acea_dual_button_secondary_button_content', [
            'label' => esc_html__( 'Secondary', 'acea-addons' ),

        ]
        );

        $this->add_control(
            'enable_secondary_btn',
            [
                'label'        => __( 'Enable Secondary Button?', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Yes', 'acea-hp' ),
                'label_off'    => __( 'No', 'acea-hp' ),
                'return_value' => 'yes',
                'default'      => 'no',
            ]
        );

        $this->add_control(
            'acea_dual_button_secondary_button_text',
            [
                'label'       => esc_html__( 'Text', 'acea-addons' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( 'ORDER NOW', 'acea-addons' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_secondary_button_url',
            [
                'label'         => esc_html__( 'Link', 'acea-addons' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
                'placeholder'   => __( 'https://your-link.com', 'acea-addons' ),
                'show_external' => true,
                'default'       => [
                    'url'         => '#',
                    'is_external' => true,
                ],
                'condition'     => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_secondary_button_icon',
            [
                'label' => esc_html__( 'Icon', 'acea-addons' ),
                'type'  => Controls_Manager::ICONS,
            ]
        );
        $this->add_control(
            'acea_dual_button_secondary_button_icon_position',
            [
                'label'     => __( 'Icon Position', 'acea-addons' ),
                'type'      => Controls_Manager::CHOOSE,
                'toggle'    => false,
                'options'   => [
                    'acea-icon-pos-left'  => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon'  => 'eicon-angle-left',
                    ],
                    'acea-icon-pos-right' => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon'  => 'eicon-angle-right',
                    ],
                ],
                'default'   => 'acea-icon-pos-left',
                'condition' => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_style',
            [
                'label'     => __( 'Menu Style', 'acea-hp' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ],
            ]
        );
        $this->start_controls_tabs(
            'menu_items_tabs'
        );
        $this->start_controls_tab(
            'menu_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'label'    => __( 'Menu Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a',
            ]
        );
        $this->add_control(
            'menu_color',
            [
                'label'     => __( 'Item Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle'                    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_color',
            [
                'label'     => __( 'Item Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => __( 'Menu Gap', 'acea-hp' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'       => 'margin-right: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __( 'Item Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'                      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'                            => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],
            ]
        );
        $this->add_responsive_control(
            'item_readius',
            [
                'label'      => __( 'Item Radius', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a'       => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'menu_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_control(
            'menu_hover_color',
            [
                'label'     => __( 'Menu Hover Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a:hover,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav li.current-menu-item>a'                                 => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .sub-menu:not(.acea-megamenu-builder-content-wrap) a .menu-item-text:after' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'menu_bg_hover_color',
            [
                'label'     => __( 'Item Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li:hover>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'dropdown_style',
            [
                'label'     => __( 'Dropdown Style', 'acea-hp' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ],
            ]
        );
        $this->start_controls_tabs(
            'dropdown_items_tabs'
        );
        $this->start_controls_tab(
            'dropdown_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dripdown_typography',
                'label'    => __( 'Menu Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li .sub-menu:not(.acea-megamenu-builder-content-wrap) a',
            ]
        );
        $this->add_control(
            'dropdown_item_color',
            [
                'label'     => __( 'Item Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a,
                        {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_color',
            [
                'label'     => __( 'Item Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ddown_menu_border_color',
            [
                'label'     => __( 'Menu Border Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu,
                    {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:before' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_radius',
            [
                'label'      => __( 'Menu radius', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu'      => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_item_padding',
            [
                'label'      => __( 'Item Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dropdown_padding',
            [
                'label'      => __( 'Menu Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children:not(.acea-mega-menu) .sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'dropdown_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_control(
            'dropdown_item_hover_color',
            [
                'label'     => __( 'Item Hover Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a:hover, {{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) li.current-menu-item> a,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'dropdown_item_bg_hover_color',
            [
                'label'     => __( 'Item Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a:hover, {{WRAPPER}} .main-navigation ul.navbar-nav .sub-menu li.current-menu-item>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_flyout_style',
            [
                'label' => __( 'Flyout/Mobile Menu Style', 'acea-hp' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'flyout_items_tabs'
        );
        $this->start_controls_tab(
            'flyout_menu_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'flyout_menu_typography',
                'label'    => __( 'Item Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a',
            ]
        );
        $this->add_control(
            'flyout_menu_color',
            [
                'label'     => __( 'Item Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle'                    => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_item_padding',
            [
                'label'      => __( 'Item Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a'                      => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a'                            => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_menu_padding',
            [
                'label'      => __( 'Menu Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flyout_menu_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_control(
            'flyout_menu_hover_color',
            [
                'label'     => __( 'Menu Hover Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav>li>a:hover,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav li.current-menu-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'flyout_dropdown_style',
            [
                'label' => __( 'Flyout/Mobile Dropdown Style', 'acea-hp' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'flyout_dropdown_items_tabs'
        );
        $this->start_controls_tab(
            'flyout_dropdown_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'flyout_dripdown_typography',
                'label'    => __( 'Dropdown Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu:not(.acea-megamenu-builder-content-wrap) a',
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_color',
            [
                'label'     => __( 'Item Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a,
                        {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_bg_color',
            [
                'label'     => __( 'Item Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_dropdown_item_padding',
            [
                'label'      => __( 'Item Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a'       => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'flyout_dropdown_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_hover_color',
            [
                'label'     => __( 'Item Hover Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a:hover,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'flyout_dropdown_item_bg_hover_color',
            [
                'label'     => __( 'Item Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) a:hover,
                    {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu:not(.acea-megamenu-builder-content-wrap) .sub-menu li.current-menu-item>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'trigger_style',
            [
                'label' => __( 'Trigger Style', 'acea-hp' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'trigger_style_tabs'
        );
        $this->start_controls_tab(
            'trigger_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-hp' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'trigger_typography',
                'label'    => __( 'Trigger Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );
        $this->add_control(
            'trigger_color',
            [
                'label'     => __( 'Trigger Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu,{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon'         => 'color: {{VALUE}}',
                    '{{WRAPPER}} .navbar-toggler.open-menu svg,{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_background',
            [
                'label'     => __( 'Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trigger_border',
                'label'    => __( 'Border', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );
        $this->add_control(
            'trigger_icon_size',
            [
                'label'      => __( 'Icon size', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'trigger_icon_gap',
            [
                'label'      => __( 'Icon Gap', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'trigger_radius',
            [
                'label'      => __( 'Border Radius', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->add_responsive_control(
            'trigger_padding',
            [
                'label'      => __( 'Button Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'trigger_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-hp' ),
            ]
        );
        $this->add_control(
            'trigger_hover_color',
            [
                'label'     => __( 'Trigger Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_hover_background',
            [
                'label'     => __( 'Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'trigger_hover_border',
                'label'    => __( 'Border', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu:hover',
            ]
        );
        $this->add_control(
            'trigger_hover_animation',
            [
                'label' => __( 'Hover Animation', 'acea-hp' ),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_responsive_control(
            'trigger_hover_radius',
            [
                'label'      => __( 'Border Radius', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'panel_style',
            [
                'label' => __( 'Panel Style', 'acea-hp' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'panel_label_typography',
                'label'    => __( 'Label Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler',
            ]
        );
        $this->add_control(
            'panel_label_color',
            [
                'label'     => __( 'Label Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_trigger_color',
            [
                'label'     => __( 'Close Trigger Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler i'        => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_trigger_fill_color',
            [
                'label'     => __( 'Close Trigger Fill Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'close_label_background',
            [
                'label'     => __( 'Label Background Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.close-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'panel_background',
            [
                'label'     => __( 'Panel Color', 'acea-hp' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'trigger_cloxe_icon_size',
            [
                'label'      => __( 'Close Icon size', 'plugin-domain' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'panel_shadow',
                'label'    => __( 'Panel Shadow', 'acea-hp' ),
                'selector' => '{{WRAPPER}}  .navbar-inner',
            ]
        );
        $this->add_responsive_control(
            'close_label_padding',
            [
                'label'      => __( 'Label Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}}  .menu-style-flyout .navbar-toggler.close-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .navbar-toggler.close-menu'           => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'panel_padding',
            [
                'label'      => __( 'Panel Padding', 'acea-hp' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner'           => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout  .navbar-inner' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'megamenu_style',
            [
                'label' => __( 'Megamenu Settings', 'acea-hp' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'megamenu_items_tabs'
        );
        $this->start_controls_tab(
            'megamenu_normal_tab',
            [
                'label' => __( 'Normal', 'plugin-name' ),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'megamenu_title_typography',
                'label'    => __( 'Heading Typography', 'acea-hp' ),
                'selector' => '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu>li.megamenu-heading>a',
            ]
        );
        $this->add_control(
            'megamenu_title_color',
            [
                'label'     => __( 'Heading Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu>li.megamenu-heading>a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'mega_menu_bg_color',
            [
                'label'     => __( 'Menu Background Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'megamenu_parent',
            [
                'label'        => __( 'Menu Parent', 'acea-hp' ),
                'type'         => \Elementor\Controls_Manager::SELECT,
                'default'      => 'container',
                'options'      => [
                    'container' => __( 'Container', 'acea-hp' ),
                    'current'   => __( 'Current', 'acea-hp' ),
                ],
                'prefix_class' => 'acea-megamenu-position-',
            ]
        );
        $this->add_control(
            'megamenu_panel_width',
            [
                'label'      => __( 'Menu Width', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'megamenu_builder_margin',
            [
                'label'      => __( 'Megamenu Builder Margin', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.acea-megamenu-builder-parent>ul.acea-megamenu-builder-content-wrap.sub-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->add_responsive_control(
            'megamenu_padding',
            [
                'label'      => __( 'Menu Padding', 'acea-hp' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'megamenu_hover_tab',
            [
                'label' => __( 'Hover', 'plugin-name' ),
            ]
        );
        $this->add_control(
            'megamenu_title_color_hover',
            [
                'label'     => __( 'Heading Color', 'acea-hp' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar:not(.active) .main-navigation ul.navbar-nav>li.acea-mega-menu>.sub-menu>li.megamenu-heading>a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
         * Acea Dual Button Container Style
         */
        $this->start_controls_section(
            'acea_container_style_section',
            [
                'label' => esc_html__( 'Container', 'acea-addons' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_container_alignment',
            [
                'label'   => __( 'Alignment', 'acea-addons' ),
                'type'    => Controls_Manager::CHOOSE,
                'toggle'  => false,
                'options' => [
                    'acea-dual-button-align-left'   => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'acea-dual-button-align-center' => [
                        'title' => __( 'Center', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'acea-dual-button-align-right'  => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'acea-dual-button-align-center',
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_container_button_margin',
            [
                'label'      => __( 'Space Between Buttons', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => -3,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-primary'   => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-dual-button-secondary' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_padding',
            [
                'label'      => __( 'Padding', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '12',
                    'right'    => '45',
                    'bottom'   => '12',
                    'left'     => '45',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        /*
         * Acea Dual Button Primary Button Style
         */
        $this->start_controls_section(
            'acea_container_primary_button_style',
            [
                'label'     => esc_html__( 'Primary Button', 'acea-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_primary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs( 'acea_dual_button_primary_button_tabs' );
        $this->start_controls_tab( 'acea_dual_button_primary_button_noemal', ['label' => esc_html__( 'Normal', 'acea-addons' )] );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'acea_container_primary_button_typography',
                'selector' => '{{WRAPPER}} .acea-dual-button-primary span',
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_primary_button_icon_margin',
            [
                'label'      => __( 'Icon Space', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-primary .acea-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-dual-button-primary .acea-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'acea_dual_button_primary_button_icon[value]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_container_primary_button_padding',
            [
                'label'      => __( 'Padding', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_container_primary_button_margin',
            [
                'label'      => __( 'Margin', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-primary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_primary_button_radius',
            [
                'label'      => __( 'Border radius', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-primary,
                            {{WRAPPER}} .acea-dual-button-primary.effect-1::before,
                            {{WRAPPER}} .acea-dual-button-primary.effect-2::before,
                            {{WRAPPER}} .acea-dual-button-primary.effect-3::before,
                            {{WRAPPER}} .acea-dual-button-primary.effect-4::before,
                            {{WRAPPER}} .acea-dual-button-primary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_primary_button_normal_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-primary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_primary_button_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#4243DC',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-primary.effect-1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-2' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-3' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-4' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-5' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-6' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'acea_dual_button_primary_button_normal_border',
                'selector' => '{{WRAPPER}} .acea-dual-button-primary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'acea_dual_button_primary_button_normal_box_shadow',
                'selector' => '{{WRAPPER}} .acea-dual-button-primary',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'acea_dual_button_primary_button_hover', ['label' => esc_html__( 'Hover', 'acea-addons' )] );
        $this->add_control(
            'acea_dual_button_primary_button_animation',
            [
                'label'   => esc_html__( 'Hover Effect', 'acea-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __( 'Effect 1', 'acea-addons' ),
                    'effect-2' => __( 'Effect 2', 'acea-addons' ),
                    'effect-3' => __( 'Effect 3', 'acea-addons' ),
                    'effect-4' => __( 'Effect 4', 'acea-addons' ),
                    'effect-5' => __( 'Effect 5', 'acea-addons' ),
                    'effect-6' => __( 'Effect 6', 'acea-addons' ),
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_primary_button_hover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-primary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_primary_button_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5543dc',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-primary.effect-1::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-2::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-3::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-4::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-5:hover'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-primary.effect-6::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'acea_dual_button_primary_button_hover_border',
                'selector' => '{{WRAPPER}} .acea-dual-button-primary:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'acea_dual_button_primary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .acea-dual-button-primary:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        /*
         * Acea Dual Button secondary Button Style
         */
        $this->start_controls_section(
            'acea_container_secondary_button_style',
            [
                'label'     => esc_html__( 'Secondary Button', 'acea-addons' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_secondary_btn[value]' => 'yes',
                ],
            ]
        );
        $this->start_controls_tabs( 'acea_dual_button_secondary_button_tabs' );
        $this->start_controls_tab( 'acea_dual_button_secondary_button_noemal', ['label' => esc_html__( 'Normal', 'acea-addons' )] );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'acea_container_secondary_button_typography',
                'selector' => '{{WRAPPER}} .acea-dual-button-secondary span',
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_secondary_button_icon_margin',
            [
                'label'      => __( 'Icon Space', 'acea-addons' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 3,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-secondary .acea-icon-pos-left i'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-dual-button-secondary .acea-icon-pos-right i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'acea_dual_button_secondary_button_icon[value]!' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_secondary_button_normal_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-secondary' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_secondary_button_normal_bg',
            [
                'label'     => esc_html__( 'Background Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-1' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-2' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-3' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-4' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-5' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-6' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'acea_dual_button_secondary_button_normal_border',
                'selector' => '{{WRAPPER}} .acea-dual-button-secondary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'acea_dual_button_secondary_button_normal_box_shadow',
                'selector' => '{{WRAPPER}} .acea-dual-button-secondary',
            ]
        );
        $this->add_responsive_control(
            'acea_container_secondary_button_padding',
            [
                'label'      => __( 'Padding', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_container_secondary_button_margin',
            [
                'label'      => __( 'Margin', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'default'    => [
                    'top'      => '',
                    'right'    => '',
                    'bottom'   => '',
                    'left'     => '',
                    'unit'     => 'px',
                    'isLinked' => false,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-secondary' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_dual_button_secondary_button_radius',
            [
                'label'      => __( 'Border radius', 'acea-addons' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'default'    => [
                    'top'    => '3',
                    'right'  => '3',
                    'bottom' => '3',
                    'left'   => '3',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-dual-button-secondary, {{WRAPPER}} .acea-dual-button-secondary.effect-1::before, {{WRAPPER}} .acea-dual-button-secondary.effect-2::before, {{WRAPPER}} .acea-dual-button-secondary.effect-3::before, {{WRAPPER}} .acea-dual-button-secondary.effect-4::before, {{WRAPPER}} .acea-dual-button-secondary.effect-6::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'acea_dual_button_secondary_button_hover', ['label' => esc_html__( 'Hover', 'acea-addons' )] );
        $this->add_control(
            'acea_dual_button_secondary_button_animation',
            [
                'label'   => esc_html__( 'Hover Effect', 'acea-addons' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'effect-5',
                'options' => [
                    'effect-1' => __( 'Effect 1', 'acea-addons' ),
                    'effect-2' => __( 'Effect 2', 'acea-addons' ),
                    'effect-3' => __( 'Effect 3', 'acea-addons' ),
                    'effect-4' => __( 'Effect 4', 'acea-addons' ),
                    'effect-5' => __( 'Effect 5', 'acea-addons' ),
                    'effect-6' => __( 'Effect 6', 'acea-addons' ),
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_secondary_button_hover_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-secondary:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'acea_dual_button_secondary_button_hover_bg',
            [
                'label'     => esc_html__( 'Background Color', 'acea-addons' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#EF2469',
                'selectors' => [
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-1::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-2::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-3::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-4::before' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-5:hover'   => 'background: {{VALUE}};',
                    '{{WRAPPER}} .acea-dual-button-secondary.effect-6::before' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'acea_dual_button_secondary_button_hover_border',
                'selector' => '{{WRAPPER}} .acea-dual-button-secondary:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'acea_dual_button_secondary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .acea-dual-button-secondary:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $popular_post_key       = array();
        $popular_meta_value_num = array();
        $settings               = $this->get_settings_for_display();
        // $target1                 = $settings['button1_url']['is_external'] ? ' target="_blank"' : '';
        // $nofollow1               = $settings['button1_url']['nofollow'] ? ' rel="nofollow"' : '';
        // $target2                 = $settings['button2_url']['is_external'] ? ' target="_blank"' : '';
        // $nofollow2               = $settings['button2_url']['nofollow'] ? ' rel="nofollow"' : '';
        if ( 'yes' == $settings['use_main_menu'] ) {
            $args = [
                'theme_location'  => 'main-menu',
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'navbar-nav',
                'container_class' => 'acea-menu-container',
            ];
        } else {
            $args = [
                // 'theme_location'        => 'main-menu',
                'menu'            => $settings['primary_menu'],
                'menu_class'      => 'navbar-nav',
                'menu_id'         => 'navbar-nav',
                'container_class' => 'acea-menu-container',
            ];
        }
        ?>
        <div class="acea-main-menu-wrap navbar <?php printf( 'menu-style-%s', esc_attr( $settings['menu_style'] ) )?>">
        <button class="navbar-toggler open-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <?php Icons_Manager::render_icon( $settings['trigger_open_icon'], ['aria-hidden' => 'true'] );?>
                </span>
                <?php if ( !empty( $settings['trigger_label'] ) ) {
            // printf( '<span class="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '' );
        }?>
            </button>
            <!-- end of Nav toggler -->
            <div class="navbar-inner">
                <div class="acea-mobile-menu"></div>
                <div class="mobile-menu-logo">
                <span><?php echo esc_html( 'menu' ) ?></span>
                </div>
                <button class="navbar-toggler close-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">

                    <span class="navbar-toggler-icon close">

                    <?php Icons_Manager::render_icon( $settings['trigger_close_icon'], ['aria-hidden' => 'true'] );?>
                    </span>
                </button>
                <nav id="site-navigation" class="main-navigation ">
                    <?php wp_nav_menu( $args );?>
                </nav><!-- #site-navigation -->
                <?php if ( 'yes' == $settings['enable_primary_btn'] || 'yes' == $settings['enable_secondary_btn'] ) :?>
                <div class="acea-header-buttons">
                <?php $this->acea_dual_buttons()?>
                </div>
                <?php endif; ?>
            </div>
        </div>
<?php
}
    public function acea_dual_buttons() {
        $settings               = $this->get_settings_for_display();
        $secondary_btn_icon_pos = $settings['acea_dual_button_secondary_button_icon_position'];
        $primary_btn_icon_pos   = $settings['acea_dual_button_primary_button_icon_position'];
        $this->add_render_attribute(
            'acea_dual_button',
            [
                'class' => [
                    'acea-dual-button',
                    esc_attr( $settings['acea_dual_button_container_alignment'] ),
                ],
            ]
        );
        $this->add_render_attribute(
            'acea_dual_button_primary_button_url',
            [
                'class' => [
                    'acea-dual-button-primary acea-dual-button-action',
                    esc_attr( $settings['acea_dual_button_primary_button_animation'] ),
                ],
            ]
        );
        $this->add_render_attribute(
            'acea_dual_button_secondary_button_url',
            [
                'class' => [
                    'acea-dual-button-secondary acea-dual-button-action',
                    esc_attr( $settings['acea_dual_button_secondary_button_animation'] ),
                ],
            ]
        );
        if ( isset( $settings['acea_dual_button_primary_button_url']['url'] ) ) {
            $this->add_render_attribute( 'acea_dual_button_primary_button_url', 'href', esc_url( $settings['acea_dual_button_primary_button_url']['url'] ) );
            if ( isset( $settings['acea_dual_button_primary_button_url']['is_external'] ) ) {
                $this->add_render_attribute( 'acea_dual_button_primary_button_url', 'target', '_blank' );
            }
            if ( isset( $settings['acea_dual_button_primary_button_url']['nofollow'] ) ) {
                $this->add_render_attribute( 'acea_dual_button_primary_button_url', 'rel', 'nofollow' );
            }
        }
        if ( isset( $settings['acea_dual_button_secondary_button_url']['url'] ) ) {
            $this->add_render_attribute( 'acea_dual_button_secondary_button_url', 'href', esc_url( $settings['acea_dual_button_secondary_button_url']['url'] ) );
            if ( isset( $settings['acea_dual_button_secondary_button_url']['is_external'] ) ) {
                $this->add_render_attribute( 'acea_dual_button_secondary_button_url', 'target', '_blank' );
            }
            if ( isset( $settings['acea_dual_button_secondary_button_url']['nofollow'] ) ) {
                $this->add_render_attribute( 'acea_dual_button_secondary_button_url', 'rel', 'nofollow' );
            }
        }
        $this->add_inline_editing_attributes( 'acea_dual_button_primary_button_text', 'none' );
        $this->add_inline_editing_attributes( 'acea_dual_button_secondary_button_text', 'none' );
        ?>
    <div <?php echo $this->get_render_attribute_string( 'acea_dual_button' ); ?>>
        <div class="acea-dual-button-wrapper">
            <a <?php echo $this->get_render_attribute_string( 'acea_dual_button_primary_button_url' ); ?>>
                <span class="<?php echo esc_attr( $primary_btn_icon_pos ); ?>">
                                    <?php
                    if ( 'acea-icon-pos-left' === $primary_btn_icon_pos && !empty( $settings['acea_dual_button_primary_button_icon']['value'] ) ) {
                                Icons_Manager::render_icon( $settings['acea_dual_button_primary_button_icon'] );
                            }
                            ?>
                    <span <?php echo $this->get_render_attribute_string( 'acea_dual_button_primary_button_text' ); ?>>
                        <?php echo esc_html( $settings['acea_dual_button_primary_button_text'] ); ?>
                    </span>
                    <?php
                    if ( 'acea-icon-pos-right' === $primary_btn_icon_pos && !empty( $settings['acea_dual_button_primary_button_icon']['value'] ) ) {
                                Icons_Manager::render_icon( $settings['acea_dual_button_primary_button_icon'] );
                            }
                            ?>
                </span>
            </a>
            <a <?php echo $this->get_render_attribute_string( 'acea_dual_button_secondary_button_url' ); ?>>
                <span class="<?php echo esc_attr( $secondary_btn_icon_pos ); ?>">
                <?php
                    if ( 'acea-icon-pos-left' === $secondary_btn_icon_pos && !empty( $settings['acea_dual_button_secondary_button_icon']['value'] ) ) {
                                Icons_Manager::render_icon( $settings['acea_dual_button_secondary_button_icon'] );
                            }
                            ?>
                    <span <?php echo $this->get_render_attribute_string( 'acea_dual_button_secondary_button_text' ); ?>>
                        <?php echo esc_html( $settings['acea_dual_button_secondary_button_text'] ); ?>
                    </span>
                    <?php
                    if ( 'acea-icon-pos-right' === $secondary_btn_icon_pos && !empty( $settings['acea_dual_button_secondary_button_icon']['value'] ) ) {
                                Icons_Manager::render_icon( $settings['acea_dual_button_secondary_button_icon'] );
                            }
                            ?>
                </span>
            </a>
        </div>
    </div>
    <?php
}
}
$widgets_manager->register_widget_type( new \Acea\Widgets\Main_Menu() );