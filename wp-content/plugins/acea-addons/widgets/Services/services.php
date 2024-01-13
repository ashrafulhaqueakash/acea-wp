<?php

if (!defined('ABSPATH')) {
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
class Acea_Services extends \Elementor\Widget_Base
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
        return 'acea-service';
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
        return __('Acea Services', 'acea-addons');
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
        return 'eicon-settings';
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
            'section_query',
            [
                'label' => __('Query', 'acea-ts'),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label'   => __('Posts per page', 'acea-ts'),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'source',
            [
                'label'   => __('Source', 'acea-ts'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'service'          => 'service',
                    'manual_selection' => 'Manual Selection',
                    'related'          => 'Related',
                ],
                'default' => 'service',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'       => __('Manual Selection', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get specific template posts', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_slug_and_id('acea-service'),
                'default'     => [],
                'condition'   => [
                    'source' => 'manual_selection',
                ],
            ]
        );
        $this->start_controls_tabs(
            'include_exclude_tabs'
        );
        $this->start_controls_tab(
            'include_tabs',
            [
                'label'     => __('Include', 'acea-ts'),
                'condition' => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'       => __('Include by', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'tags'     => 'Tags',
                    'category' => 'Category',
                    'author'   => 'Author',
                ],
                'default'     => [],
                'condition'   => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'include_categories',
            [
                'label'       => __('Include categories', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get templates for specific category(s)', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name('service-category'),
                'default'     => [],
                'condition'   => [
                    'include_by' => 'category',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'       => __('Include Tags', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name('service-tag'),
                'default'     => [],
                'condition'   => [
                    'include_by' => 'tags',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'       => __('Include authors', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_author_slug_and_id('acea-service'),
                'default'     => [],
                'condition'   => [
                    'include_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'exclude_tabs',
            [
                'label'     => __('Exclude', 'acea-ts'),
                'condition' => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'       => __('Exclude by', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => [
                    'tags'         => 'tags',
                    'category'     => 'Category',
                    'author'       => 'Author',
                    'current_post' => 'Current Post',
                ],
                'default'     => [],
                'condition'   => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'       => __('Exclude categories', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get templates for specific category(s)', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name('service-category'),
                'default'     => [],
                'condition'   => [
                    'exclude_by' => 'category',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'       => __('Exclude Tags', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name('service-tag'),
                'default'     => [],
                'condition'   => [
                    'exclude_by' => 'tags',
                    'source!'    => 'related',
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'       => __('Exclude authors', 'acea-ts'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_author_slug_and_id('acea-service'),
                'default'     => [],
                'condition'   => [
                    'exclude_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'   => __('Order By', 'acea-ts'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'date'       => 'Date',
                    'title'      => 'title',
                    'menu_order' => 'Menu Order',
                    'rand'       => 'Random',
                ],
                'default' => 'date',
            ]
        );
        $this->add_control(
            'order',
            [
                'label'   => __('Order', 'acea-ts'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => 'ASC',
                    'DESC' => 'DESC',
                ],
                'default' => 'DESC',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Layout', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'services_mode',
            [
                'label' => esc_html__('Services Mode', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid', 'acea-addons'),
                    'slider' => esc_html__('Slider', 'acea-addons'),
                ],
            ]
        );
        $this->add_responsive_control(
            'services_grid_column',
            [
                'label' => esc_html__('Services Column', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '12' => esc_html__('Column 1', 'acea-addons'),
                    '6' => esc_html__('Column 2', 'acea-addons'),
                    '4' => esc_html__('Column 3', 'acea-addons'),
                    '3' => esc_html__('Column 4', 'acea-addons'),
                ],
                'condition' => [
                    'services_mode' => 'grid',
                ],
            ]
        );
        $this->add_control(
            'service_style',
            [
                'label'             => __('Service Style', 'acea-addons'),
                'type'              => \Elementor\Controls_Manager::SELECT,
                'default'           => 'style-one',
                'options'           => [
                    'style-one'    =>   __('Style one', 'acea-addons'),
                    'style-two'    =>   __('Style two', 'acea-addons'),
                    'style-three'    =>   __('Style three', 'acea-addons'),
                    'style-four'    =>   __('Style Four', 'acea-addons'),
                ],
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => __('Column Gap', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors'      => [
                    '{{WRAPPER}} .acea-service-widget-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-right: -{{SIZE}}{{UNIT}};margin-left: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => __('Row Gap', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .row' => 'margin-bottom: -{{SIZE}}{{UNIT}};',

                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_excerpt',
            [
                'label'        => __('Show Excerpt', 'acea-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'acea-addons'),
                'label_off'    => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'show_date',
            [
                'label'        => __('Show Date', 'acea-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'acea-addons'),
                'label_off'    => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default'      => 'no',
                'condition' => [
                    'service_style' => 'style-four',
                ],
            ]
        );
        $this->add_control(
            'excerpt_limit',
            [
                'label'    => __('Excerpt Word Limit', 'acea-addons'),
                'type'     => \Elementor\Controls_Manager::SLIDER,
                'range'    => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'title_limit',
            [
                'label' => __('Title Word Limit', 'acea-addons'),
                'type'  => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_btn',
            [
                'label' => __('Read More', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_readmore',
            [
                'label'        => __('Read More Button', 'acea-addons'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __('Show', 'acea-addons'),
                'label_off'    => __('Hide', 'acea-addons'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'readmore_text',
            [
                'label'    => __('Readmore text', 'acea-addons'),
                'type'     => \Elementor\Controls_Manager::TEXT,
                'default'  => __('READ MORE', 'acea-addons'),
                'condition' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'icon',
            [
                'label'    => __('Icon', 'acea-addons'),
                'type'     => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label'    => __('Icon Position', 'acea-addons'),
                'type'     => \Elementor\Controls_Manager::SELECT,
                'default'  => 'after',
                'options'  => [
                    'before' => __('Before', 'acea-addons'),
                    'after'  => __('After', 'acea-addons'),
                ],
                'condition' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_align',
            [
                'label'        => __('Align', 'acea-addons'),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'   => [
                        'title' => __('Left', 'acea-addons'),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'acea-addons'),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'acea-addons'),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'devices'      => ['desktop', 'tablet', 'mobile'],
                'prefix_class' => 'content-align%s-',
                'toggle'       => true,
            ]
        );
        $this->end_controls_section();
        //Slider Setting
        $this->start_controls_section(
            'slider_settings',
            [
                'label' => __('Slider Settings', 'acea-addons-hp'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'services_mode' => 'slider',
                ]
            ]
        );
        $this->add_responsive_control(
            'row_margin',
            [
                'label' => __('Row Gap', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-mode-slider .slick-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'column_margin',
            [
                'label' => __('Column Gap', 'upmedix'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-mode-slider .slick-slide' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __('Slider Items', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default'            => 4,
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
            'show_vertical',
            [
                'label' => __('Vertical Mode?', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'show_center_mode',
            [
                'label' => __('Center Mode?', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __('Show arrows?', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'dots',
            [
                'label' => __('Show Dots?', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'mousedrag',
            [
                'label' => __('Show MouseDrag', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'autoplay',
            [
                'label' => __('Auto Play?', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __('Infinite Loop', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'acea-addons-hp'),
                'label_off' => __('Hide', 'acea-addons-hp'),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __('Autoplay Timeout', 'acea-addons-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __('1 Second', 'acea-addons-hp'),
                    '2000'  => __('2 Second', 'acea-addons-hp'),
                    '3000'  => __('3 Second', 'acea-addons-hp'),
                    '4000'  => __('4 Second', 'acea-addons-hp'),
                    '5000'  => __('5 Second', 'acea-addons-hp'),
                    '6000'  => __('6 Second', 'acea-addons-hp'),
                    '7000'  => __('7 Second', 'acea-addons-hp'),
                    '8000'  => __('8 Second', 'acea-addons-hp'),
                    '9000'  => __('9 Second', 'acea-addons-hp'),
                    '10000' => __('10 Second', 'acea-addons-hp'),
                    '11000' => __('11 Second', 'acea-addons-hp'),
                    '12000' => __('12 Second', 'acea-addons-hp'),
                    '13000' => __('13 Second', 'acea-addons-hp'),
                    '14000' => __('14 Second', 'acea-addons-hp'),
                    '15000' => __('15 Second', 'acea-addons-hp'),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __('Previous Icon', 'acea-addons'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'arrow_next_icon',
            [
                'label' => __('Next Icon', 'acea-addons'),
                'label_block' => false,
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        $this->end_controls_section();
        //Slider setting end
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __('Image', 'acea-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'acea-addons-ts'),
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Image Width', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .services-img img'  => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .services-img-wrapper'  => 'flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Image Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .services-img img'  => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label' => __('Image Margin', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .services-img-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .services-img-wrapper' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => __('Image Padding', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .services-img-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .services-img-wrapper' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'acea-addons-ts'),
            ]
        );
        $this->add_control(
            'image_hover_style',
            [
                'label'             => __('Hover Style', 'acea-addons'),
                'type'              => \Elementor\Controls_Manager::SELECT,
                'default'           => 'hover-default',
                'options'           => [
                    'hover-default' =>   __('Default',    'acea-addons'),
                    'hover-one'     =>   __('Style 01',    'acea-addons'),
                ],
                'separator' => 'after',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __('Icon', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
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
                'label'     => __('Icon Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_background',
            [
                'label'     => __('Icon Background', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow',
                'label'    => __('Icon Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .service-icon',
            ]
        );
        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __('Icon Size', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .service-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_box_size',
            [
                'label'     => __('Icon Box Size', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .service-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_gap',
            [
                'label'      => __('Icon Gap', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .service-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                'label'     => __('Icon Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .service-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}}:hover .service-icon svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_background',
            [
                'label'     => __('Icon Background', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .service-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_shadow_hover',
                'label'    => __('Icon Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}}:hover .service-icon',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        $this->start_controls_section(
            'content_style',
            [
                'label' => __('Content', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'content_style_tabs'
        );
        $this->start_controls_tab(
            'content_style_normal_tab',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item .service-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label'     => __('Excerpt Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => __('Title Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-item .service-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typ',
                'label'    => __('Excerpt Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-item p',
            ]
        );
        $this->add_control(
            'title_br',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'title_gap',
            [
                'label'     => __('Title Gap', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item .service-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Title Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item .service-title'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-service-widget-item .service-title' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Content Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item .service-content p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-service-widget-item .service-content p' => 'margin:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => __('Content Box Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item .service-content'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-service-widget-item .service-content' => 'padding:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_style_hover_tab',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label'     => __('Title Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .service-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_hover_color',
            [
                'label'     => __('Excerpt Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // date
        $this->start_controls_section(
            'date_style',
            [
                'label' => __('Date', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_date' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'date_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} span.service-date' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} span.service-date',
            ]
        );
        $this->add_responsive_control(
            'date_gap',
            [
                'label'      => __('Gap', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} span.service-date'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} span.service-date' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // number
        $this->start_controls_section(
            'number_style',
            [
                'label' => __('Number', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'service_style' => 'style-four',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} .list_number span.service_number_list',
            ]
        );
        $this->start_controls_tabs(
            'number_style_tabs'
        );
        $this->start_controls_tab(
            'number_style_normal_tab',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'number_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list_number span.service_number_list' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'number_background',
            [
                'label'     => __('Background Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .list_number span.service_number_list' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'number_box_width',
            [
                'label' => esc_html__('Width', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .list_number span.service_number_list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'number_box_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .list_number span.service_number_list' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'number_shadow',
                'label'    => __('Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .list_number span.service_number_list',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'number_border',
                'label'    => __('Border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .list_number span.service_number_list',
            ]
        );

        $this->add_responsive_control(
            'number_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .list_number span.service_number_list'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .list_number span.service_number_list' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'number_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'number_padding',
            [
                'label'      => __('Number Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .list_number span.service_number_list'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .list_number span.service_number_list' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'number_style_hover_tab',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'number_hover_color',
            [
                'label'     => __('Button Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .list_number span.service_number_list' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'number_hover_background',
            [
                'label'     => __('Background Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .list_number span.service_number_list' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'number_hover_border',
                'label'    => __('Border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-item:hover .list_number span.service_number_list',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'number_hover_shadow',
                'label'    => __('Button Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-item:hover .list_number span.service_number_list',
            ]
        );
        $this->add_responsive_control(
            'number_hover_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .list_number span.service_number_list'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-service-widget-item:hover .list_number span.service_number_list' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        $this->start_controls_section(
            'button_style',
            [
                'label' => __('Button', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_readmore' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'label'    => __('Button Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}} .service-btn',
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'btn_icon_color',
            [
                'label'     => __('Icon Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn .btn-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .service-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'icon_fill_color',
            [
                'label'     => __('Icon Fill Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'icon[library]',
                            'operator' => '==',
                            'value' => 'svg',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_color',
            [
                'label'     => __('Button Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_box_width',
            [
                'label' => esc_html__('Width', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .service-btn' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'button_box_height',
            [
                'label' => esc_html__('Height', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .service-btn' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'boxed_btn_background',
            [
                'label'     => __('Background Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_shadow',
                'label'    => __('Button Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .service-btn',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'label'    => __('Border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .service-btn',
            ]
        );
        $this->add_control(
            'btn_icon_size',
            [
                'label'      => __('Icon Size', 'acea-addons'),
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
                    '{{WRAPPER}} .service-btn .btn-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-btn .btn-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_gap',
            [
                'label'      => __('Icon gap', 'acea-addons'),
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
                    '{{WRAPPER}} .service-btn .icon-before, body.rtl {{WRAPPER}} .service-btn .icon-after '  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .service-btn .icon-after , body.rtl  {{WRAPPER}} .service-btn .icon-before' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-btn'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-btn' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'buton_style_divider',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __('Button Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-btn'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-btn' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'btn_icon_hover_color',
            [
                'label'     => __('Icon Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .service-btn .btn-icon'      => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-service-widget-item:hover .service-btn .btn-icon path' => 'stroke: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_fill_color_hover',
            [
                'label'     => __('Icon Fill Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .service-btn .btn-icon path' => 'fill: {{VALUE}}',
                ],
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'icon[library]',
                            'operator' => '==',
                            'value' => 'svg',
                        ],
                    ],
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label'     => __('Button Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover .service-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_background',
            [
                'label'     => __('Background Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-btn:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'button_hover_border',
                'label'    => __('Border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .service-btn:hover',
            ]
        );
        $this->add_control(
            'btn_hover_animation',
            [
                'label' => __('Hover Animation', 'acea-addons'),
                'type'  => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_shadow',
                'label'    => __('Button Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .service-btn:hover',
            ]
        );
        $this->add_responsive_control(
            'button_hover_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .service-btn:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .service-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_hover_gap',
            [
                'label'      => __('Icon gap', 'acea-addons'),
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
                    '{{WRAPPER}} .service-btn:hover .icon-before'          => 'transform: translatex( -{{SIZE}}{{UNIT}} );',
                    '{{WRAPPER}} .service-btn:hover .icon-after '          => 'transform: translatex( {{SIZE}}{{UNIT}} );',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __('Box', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'box_style_tabs'
        );
        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'box_align',
            [
                'label' => esc_html__('Alignment', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item' => 'text-align: {{VALUE}};',
                ],
                'toggle' => true,
            ]
        );
        $this->add_control(
            'box_bg_color',
            [
                'label'     => __('Box Background Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __('Box Hover Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __('Box Border', ''),
                'selector' => '{{WRAPPER}} .acea-service-widget-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __('Box Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __('Box Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item '          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => __('Box Backgroound Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'defautl'   => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __('Box Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-item:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __('Box Hover Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __('Box Border', ''),
                'selector' => '{{WRAPPER}} .acea-service-widget-item:hover ',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        // wrapper

        $this->start_controls_section(
            'section_wrapper_style',
            [
                'label' => __('Wrapper', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'wrap_style_tabs'
        );
        $this->start_controls_tab(
            'wrap_style_normal_tab',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'wrap_bg_color',
            [
                'label'     => __('Backgroound Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-wrap' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrap_shadow',
                'label'    => __('Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-wrap',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'wrap_border',
                'label'    => __('Border', ''),
                'selector' => '{{WRAPPER}} .acea-service-widget-wrap',
            ]
        );
        $this->add_responsive_control(
            'wrap_radius',
            [
                'label'      => __('Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-wrap'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'wraper_box_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '',
                    'bottom' => '',

                ],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_item_margin',
            [
                'label'      => __('Wraper margin', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'wrap_style_hover_tab',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'warp_hover_bg_color',
            [
                'label'     => __('Backgroound Color', 'acea-addons'),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'defautl'   => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .acea-service-widget-wrap:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'wrap_hover_radius',
            [
                'label'      => __('Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-service-widget-wrap:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrap_hover_shadow',
                'label'    => __('Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-service-widget-wrap:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'wrap_hover_border',
                'label'    => __('Border', ''),
                'selector' => '{{WRAPPER}} .acea-service-widget-wrap:hover ',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
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
    protected function render()
    {
        $settings = $this->get_settings();
        $service_style = $settings['service_style'];
        $paged              = get_query_var('paged') ? get_query_var('paged') : 1;
        $include_categories = array();
        $exclude_tags       = array();
        $include_tags       = array();
        $include_authors    = array();
        $exclude_categories = array();
        $exclude_authors    = array();
        $is_include_cat    = in_array('category', $settings['include_by']);
        $is_include_tag    = in_array('tags', $settings['include_by']);
        $is_include_author = in_array('author', $settings['include_by']);
        $is_exclude_cat    = in_array('category', $settings['exclude_by']);
        $is_exclude_tag    = in_array('tags', $settings['exclude_by']);
        $is_exclude_author = in_array('author', $settings['exclude_by']);
        $current_post_id = '';
        //this code slider option
        $slider_extraSetting = array(
            'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
            'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
            'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
            'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
            'mousedrag' => (!empty($settings['mousedrag']) && 'yes' === $settings['mousedrag']) ? true : false,
            'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
            'show_center_mode' => (!empty($settings['show_center_mode']) && 'yes' === $settings['show_center_mode']) ? true : false,
            'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            // 'slider_center_padding' => !empty($settings['slider_center_padding']) ? $settings['slider_center_padding'] : '300',
            //this a responsive layout
            'per_coulmn' => (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );
        $jasondecode = wp_json_encode($slider_extraSetting);
        if (('slider' == $settings['services_mode'])) {
            $this->add_render_attribute('services_version', 'class', array('services-mode-slider', 't-style',));
            $this->add_render_attribute('services_version', 'data-settings', $jasondecode);
        } else {
            $this->add_render_attribute('services_version', 'class', array($service_style, 'row justify-content-center'));
            //gride class
            $grid_classes = [];
            $grid_classes[] = 'col-xl-' . $settings['per_line'];
            $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
            $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
            $grid_classes = implode(' ', $grid_classes);
            $this->add_render_attribute('services_grid_column', 'class', [$grid_classes, 'acea-service-widget-wrap co-lg-6', $image_hover_style]);
        }

        // Query
        if (0 != count($settings['include_categories'])) {
            $include_categories['tax_query'] = [
                'taxonomy' => 'service-category',
                'field'    => 'slug',
                'terms'    => $settings['include_categories'],
            ];
        }
        if (0 != count($settings['include_tags'])) {
            $include_tags = implode(',', $settings['include_tags']);
        }
        if (0 != count($settings['include_authors'])) {
            $include_authors = implode(',', $settings['include_authors']);
        }
        if (0 != count($settings['exclude_categories'])) {
            $exclude_categories['tax_query'] = [
                'taxonomy' => 'service-category',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_categories'],
            ];
        }
        if (0 != count($settings['exclude_tags'])) {
            $exclude_tags['tax_query'] = [
                'taxonomy' => 'service-tag',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_tags'],
            ];
        }
        if (0 != count($settings['exclude_authors'])) {
            $exclude_authors = implode(',', $settings['exclude_authors']);
        }
        if (in_array('current_post', $settings['exclude_by']) && is_single() && 'acea-service' == get_post_type()) {
            $current_post_id = get_the_ID();
        }
        if ('related' == $settings['source'] && is_single() && 'acea-service' == get_post_type()) {
            $related_categories = get_the_terms(get_the_ID(), 'service-category');
            $related_cats       = [];
            if ($related_categories) {
                foreach ($related_categories as $related_cat) {
                    $related_cats[] = $related_cat->slug;
                }
            }
            $the_query = new WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'acea-service',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'post__not_in'   => array($current_post_id),
                'paged'          => $paged,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'service-category',
                        'operator' => 'IN',
                        'field'    => 'slug',
                        'terms'    => $related_cats,
                    ),
                ),
            ));
        } elseif ('manual_selection' == $settings['source']) {
            $the_query = new WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'acea-service',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'paged'          => $paged,
                'post__in'       => (0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
            ));
        } else {
            $the_query = new WP_Query(array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'acea-service',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'paged'          => $paged,
                'service-tag'    => ($is_include_tag && 0 != count($settings['include_tags'])) ? $include_tags : '',
                'post__not_in'   => array($current_post_id),
                'author'         => ($is_include_author && 0 != count($settings['include_authors'])) ? $include_authors : '',
                'author__not_in' => ($is_exclude_author && 0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
                'tax_query'      => array(
                    'relation' => 'AND',
                    ($is_exclude_tag && 0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
                    ($is_exclude_cat && 0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
                    ($is_include_cat && 0 != count($settings['include_categories'])) ? $include_categories : '',
                ),
            ));
        }
?>
        <?php if ($the_query->have_posts()) : ?>
            <div class="acea-service-widget-main-wrap">
            <div <?php echo $this->get_render_attribute_string('services_version'); ?>>
                    <?php
                    $i = 1;
                    while ($the_query->have_posts()) : $the_query->the_post();
                    ?>
                        <?php if ($service_style) {
                            include('content/' . $service_style . '.php');
                        } ?>
                    <?php
                        $i++;
                    endwhile;
                    wp_reset_postdata(); ?>
                </div>
                <?php if ('slider' == $settings['services_mode'] && 'yes' == $settings['arrows']) : ?>
                <div class="services-slider-arrow">
                    <?php if (!empty($settings['arrow_prev_icon']['value'])) : ?>
                        <button type="button" class="slick-prev prev slick-arrow slick-active prev-<?php echo esc_attr($this->get_ID()); ?>">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['arrow_prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </button>
                    <?php endif; ?>
                    <?php if (!empty($settings['arrow_next_icon']['value'])) : ?>
                        <button type="button" class="slick-next next slick-arrow next-<?php echo esc_attr($this->get_ID()); ?>">
                            <?php \Elementor\Icons_Manager::render_icon($settings['arrow_next_icon'], ['aria-hidden' => 'true']); ?>
                        </button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            </div>
<?php
        endif;
    }
}
$widgets_manager->register_widget_type(new Acea_Services());
