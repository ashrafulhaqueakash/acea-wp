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
class acea_portfolio_loop extends \Elementor\Widget_Base
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
        return 'acea-portfolio';
    }

    public function get_script_depends()
    {
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
    public function get_title()
    {
        return __('Acea Portfolio', 'acea-ts');
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
            'section_layout',
            [
                'label' => __('Layout', 'acea-ts'),
            ]
        );
        $this->add_control(
            'layout_style_type',
            [
                'label' => __('Select Style', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'style-one' => 'Style One',
                    'style-two' => 'Style Two',
                    'style-three' => 'Style Three'
                ),
                'default' => 'style-one',
            ]
        );
        $this->add_control(
            'layout_type',
            [
                'label' => __('Layout type', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'masonry' => 'Masonry',
                    'normal' => 'Normal',
                ),
                'default' => 'masonry',
            ]
        );
        $this->add_control(
            'content_position',
            [
                'label' => __('Content Position', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'on-image' => 'On Image',
                    'below-image' => 'Below Image',
                    'disabled' => 'Hidden',
                ),
                'default' => 'on-image',
            ]
        );
        $this->add_control(
            'enable_filtering',
            [
                'label' => __('Enable Filtering??', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'enable_loadmore',
            [
                'label' => __('Enable Loadmore?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'loadmore_text',
            [
                'label' => __('Loadmore Text', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => true,
                'default' => __('Load more works', 'acea-ts'),
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'loadmore_align',
            [
                'label' => __('Loadmore Align', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-ts'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'acea-ts'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-ts'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'loadmore_gap',
            [
                'label' => __('Loadmore Top Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-loadmore-wrap' => 'margin-top:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_width_nd_height',
            [
                'label' => __('Width & Height', 'acea-ts'),
            ]
        );
        $this->add_control(
            'all_text',
            [
                'label' => __('Filter first item text', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('All WOrks', 'acea-ts'),
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_control(
            'use_meta_grid',
            [
                'label' => __('Use grid from meta?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'post_grid',
            [
                'label' => __('Post Column', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'options' => array(
                    'col-md-12' => '1 Column',
                    'col-md-6' => '2 Column',
                    'col-md-4' => '3 Column',
                    'col-md-3' => '4 Column',
                ),
                'default' => 'col-md-4',
                'condition' => [
                    'use_meta_grid!' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'column_verti_gap',
            [
                'label' => __('Column Vertical Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'desktop_default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-portfolio-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}} 0;',
                ]
            ]
        );
        $this->add_responsive_control(
            'column_hori_gap',
            [
                'label' => __('Column Horizontal Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'desktop_default' => [
                    'size' => 30,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-portfolio-item-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}} ;',
                ]
            ]
        );
        $this->add_control(
            'use_custom_height',
            [
                'label' => __('Use custom height?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_responsive_control(
            'normal_image_height',
            [
                'label' => __('Normal Image Height', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-portfolio-item-wrap.height-normal .acea-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'big_image_height',
            [
                'label' => __('Big Image Height', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'devices' => ['desktop', 'tablet', 'mobile'],
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-portfolio-item-wrap.height-big .acea-portfolio-item img' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'use_custom_height' => 'yes'
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query', 'acea-ts'),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts per page', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'source',
            [
                'label'         => __('Source', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'portfolio' => 'Portfolio',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                ],
                'default' =>    'portfolio',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'         => __('Manual Selection', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get specific template posts', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_slug_and_id('portfolio'),
                'default' =>    [],
                'condition' => [
                    'source' => 'manual_selection'
                ],
            ]
        );
        $this->start_controls_tabs(
            'include_exclude_tabs'
        );
        $this->start_controls_tab(
            'include_tabs',
            [
                'label' => __('Include', 'acea-ts'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'         => __('Include by', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'label_block'   => true,
                'multiple'      => true,
                'options'       => [
                    'tags'  => 'Tags',
                    'category'  => 'Category',
                    'author' => 'Author',
                ],
                'default' =>    [],
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'include_categories',
            [
                'label'         => __('Include categories', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('portfolio-category'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'category',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'include_tags',
            [
                'label'         => __('Include Tags', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('portfolio-tag'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'tags',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'include_authors',
            [
                'label'         => __('Include authors', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_author_slug_and_id('portfolio'),
                'default' =>    [],
                'condition' => [
                    'include_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'exclude_tabs',
            [
                'label' => __('Exclude', 'acea-ts'),
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'         => __('Exclude by', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'label_block'   => true,
                'multiple'      => true,
                'options'       => [
                    'tags'  => 'tags',
                    'category'  => 'Category',
                    'author' => 'Author',
                    'current_post' => 'Current Post',
                ],
                'default' =>    [],
                'condition' => [
                    'source!' => 'manual_selection'
                ],
            ]
        );
        $this->add_control(
            'exclude_categories',
            [
                'label'         => __('Exclude categories', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('portfolio-category'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'category',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'exclude_tags',
            [
                'label'         => __('Exclude Tags', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('portfolio-tag'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'tags',
                    'source!' => 'related'
                ],
            ]
        );
        $this->add_control(
            'exclude_authors',
            [
                'label'         => __('Exclude authors', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_author_slug_and_id('portfolio'),
                'default' =>    [],
                'condition' => [
                    'exclude_by' => 'author',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'orderby',
            [
                'label'         => __('Order By', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'date'   => 'Date',
                    'title'    => 'title',
                    'menu_order'    => 'Menu Order',
                    'rand'    => 'Random',
                ],
                'default' =>    'date',
            ]
        );
        $this->add_control(
            'order',
            [
                'label'         => __('Order', 'acea-ts'),
                'type'          => \Elementor\Controls_Manager::SELECT,
                'options'       => [
                    'ASC'   => 'ASC',
                    'DESC'    => 'DESC',
                ],
                'default' =>    'DESC',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_filter_style',
            [
                'label' => __('Filter', 'acea-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
   
        $this->add_responsive_control(
            'filter_category_gap',
            [
                'label' => __('Filter Category Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    ' {{WRAPPER}} ul.pf-isotope-nav li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_horizontal_gap',
            [
                'label' => __('Filter Horizontal Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ul.pf-isotope-nav' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_align',
            [
                'label' => __('Filter Align', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-ts'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'acea-ts'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-ts'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav' => 'text-align: {{VALUE}};',
                ],
                'toggle' => true,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Filter Typography', 'acea-ts'),
                'name' => 'filter_typo',
                'selector' => '{{WRAPPER}} .pf-isotope-nav li',
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label' => __('Filter Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_color',
            [
                'label' => __('Filter Hover Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .pf-isotope-nav li:hover,{{WRAPPER}} .pf-isotope-nav li.active' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'acea-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_category',
            [
                'label' => __('Show category?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'show_title_icon',
            [
                'label' => __('Show Icon?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'title_icon',
            [
                'label' => __('Choose Title Icon', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );

        $this->add_control(
            'show_excerpt',
            [
                'label' => __('Show Excerpt?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'layout_style_type' => 'style-two',
                    'layout_style_type' => 'style-three',
                 ]
            ]
        );
        $this->add_control(
            'port_show_btn',
            [
                'label' => __('Show Button?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'layout_style_type' => 'style-two',
                    'layout_style_type' => 'style-three'
                 ]
            ]
        );
        $this->add_control(
			'port_btn_text',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Button Text', 'plugin-name' ),
				'default' => esc_html__( 'Go To Details', 'plugin-name' ),
                'condition' => [
                    'port_show_btn' => 'yes',
                    'layout_style_type' => 'style-two',
                    'layout_style_type' => 'style-three'
                 ]
			]
		);
        $this->add_control(
            'port_btn_icon',
            [
                'label' => __('Button Icon', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'port_show_btn' => 'yes',
                    'layout_style_type' => 'style-two',
                    'layout_style_type' => 'style-three'
                 ]
            ]
        );


        $this->end_controls_section();
        $this->start_controls_section(
            'section_image',
            [
                'label' => __('Image', 'acea-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'image_hover_tabs'
        );
        $this->start_controls_tab(
            'image_normal_tab',
            [
                'label' => __('Normal', 'acea-ts'),
            ]
        );
        $this->add_responsive_control(
            'image_width',
            [
                'label' => __('Width', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-item img' => 'width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_max_width',
            [
                'label' => __('max Width', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-item img' => 'max-width:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __('Height', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-item img' => 'height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .acea-portfolio-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_shadow',
                'label' => __('Button Shadow', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-portfolio-item img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __('Border', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-portfolio-item img',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'image_hover_tab',
            [
                'label' => __('Hover', 'acea-ts'),
            ]
        );
        $this->add_responsive_control(
            'image_hover_radius',
            [
                'label' => __('Box Image Radius', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .acea-portfolio-item:hover img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_hover_shadow',
                'label' => __('Button Shadow', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-portfolio-item:hover img',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_hover_border',
                'label' => __('Border', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-portfolio-item:hover img',
            ]
        );
        $this->add_control(
            'enable_hover_rotate',
            [
                'label' => __('Rotate animation on hover?', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'acea-ts'),
                'label_off' => __('No', 'acea-ts'),
                'return_value' => 'acea-hover-rotate',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'image_hover_animation',
            [
                'label' => __('Hover Animation', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                // 'prefix_class' => 'elementor-animation-',
                'condition' => [
                    'enable_hover_rotate!' => 'acea-hover-rotate'
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_category_style',
            [
                'label' => __('Category', 'acea-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_category' => 'yes',
                 ]
            ]
        );
        $this->start_controls_tabs(
            'category_style_tabs'
        );
        $this->start_controls_tab(
            'category_style_normal_tab',
            [
                'label' => __('Normal', 'acea-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Category Typography', 'acea-ts'),
                'name' => 'category_typo',
                'selector' => '{{WRAPPER}} .acea-pf-category',
            ]
        );
        $this->add_control(
            'category_color',
            [
                'label' => __('Category Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-category' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'category_gap',
            [
                'label' => __('Category Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .acea-pf-category' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'category_style_hover_tab',
            [
                'label' => __('Hover', 'acea-hp'),
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => __('Category Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-category:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'acea-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'title_style_tabs'
        );
        $this->start_controls_tab(
            'title_style_normal_tab',
            [
                'label' => __('Normal', 'acea-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Title Typography', 'acea-ts'),
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .acea-portfolio-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Content Padding', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_icon_line_color',
            [
                'label' => __('Title Icon Line Color', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-icon svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .title-icon i' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_control(
            'title_icon_fill_color',
            [
                'label' => __('SVG Fill Color', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title-icon svg path' => 'fill: {{VALUE}}',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_responsive_control(
            'title_icon_rotate',
            [
                'label' => __('Rotate icon', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .title-icon svg, {{WRAPPER}} .title-icon i' => 'transform: rotate( {{SIZE}}deg );',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_responsive_control(
            'title_icon_size',
            [
                'label' => __('icon Size', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -360,
                        'max' => 360,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .title-icon  svg' => 'width: {{SIZE}}{{UNIT}} ;',
                    '{{WRAPPER}} .title-icon  i' => 'font-size: {{SIZE}}{{UNIT}} ;',
                ],
                'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'title_style_hover_tab',
            [
                'label' => __('Hover', 'acea-hp'),
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_icon_line_color_hover',
            [
                'label' => __('Title Icon Line Color', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title:hover .title-icon svg path' => 'stroke: {{VALUE}}',
                    '{{WRAPPER}} .acea-portfolio-title:hover .title-icon i' => 'color: {{VALUE}}',
                ],
                 'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->add_control(
            'title_icon_fill_color_hover',
            [
                'label' => __('SVG Fill Color', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-title:hover .title-icon svg path' => 'fill: {{VALUE}}',
                ],
                 'condition' => [
                    'show_title_icon' => 'yes',
                 ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        // excerpt

        $this->start_controls_section(
            'section_excerpt_style',
            [
                'label' => __('Excerpt', 'acea-hp'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                 ]
            ]
        );
        $this->start_controls_tabs(
            'excerpt_style_tabs'
        );
        $this->start_controls_tab(
            'excerpt_style_normal_tab',
            [
                'label' => __('Normal', 'acea-hp'),
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Excerpt Typography', 'acea-ts'),
                'name' => 'excerpt_typo',
                'selector' => '{{WRAPPER}} .portfolio-content p',
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Excerpt Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'excerpt_gap',
            [
                'label' => __('Excerpt Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content p' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'excerpt_style_hover_tab',
            [
                'label' => __('Hover', 'acea-hp'),
            ]
        );
        $this->add_control(
            'excerpt_color_hover',
            [
                'label' => __('Excerpt Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-content p:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();



        // Button 

        
        
        $this->start_controls_section(
            'section_btn_detalis',
            [
                'label' => __('Buttn Details', 'acea-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'port_show_btn' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'acea-ts'),
                'name' => 'btn_detalis_typo',
                'selector' => '{{WRAPPER}} .portfolio-btn a',
            ]
        );
        $this->start_controls_tabs(
            'btn_detalis_hover_tabs'
        );
        $this->start_controls_tab(
            'btn_detalis_normal_tab',
            [
                'label' => __('Normal', 'acea-ts'),
            ]
        );
        $this->add_responsive_control(
            'btn_detalis_width',
            [
                'label' => __('Width', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a' => 'width:{{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'btn_detalis_height',
            [
                'label' => __('Height', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a' => 'height:{{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'btn_detalis_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_detalis_background_color',
            [
                'label' => __('background Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_detalis_border',
                'label' => __('Border', 'acea-ts'),
                'selector' => '{{WRAPPER}} .portfolio-btn a',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'btn_detalis_hover_tab',
            [
                'label' => __('Hover', 'acea-ts'),
            ]
        );
        $this->add_control(
            'btn_detalis_hover_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_detalis_hover_bg_color',
            [
                'label' => __('background Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_detalis_hover_border',
                'label' => __('Border', 'acea-ts'),
                'selector' => '{{WRAPPER}} .portfolio-btn a:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'btn_details_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'btn_detalis_padding',
            [
                'label' => __('Padding', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '22',
                    'right' => '38',
                    'bottom' => '21',
                    'left' => '38',
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_detalis_radius',
            [
                'label' => __('Border Radius', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '33',
                    'right' => '33',
                    'bottom' => '33',
                    'left' => '33',
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_detalis_shadow',
                'label' => __('Button Shadow', 'acea-ts'),
                'selector' => '{{WRAPPER}} .portfolio-btn a',
                'fields_options' =>
                [
                    'box_shadow_type' =>
                    [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' =>
                        [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 0,
                            'spread' => 0,
                            'color' => 'rgba(3, 3, 3, 0.14)',
                        ],
                    ],
                ],
            ]
        );


        $this->add_control(
            'btn_icon_details_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn i' => 'font-size:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-btn svg' => 'width:{{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_control(
            'btn_detalis_icon_color',
            [
                'label' => __('Icon Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-btn svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_gp',
            [
                'label' => __('Icon Gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-btn i' => 'margin-left:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-btn svg' => 'margin-left:{{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Content Box', 'acea-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

      $this->add_responsive_control(
            'content_align',
            [
                'label' => __('Align', 'acea-hp'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'acea-hp'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'acea-hp'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'acea-hp'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'prefix_class' => 'content-align%s-',
                'toggle' => true,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'acea_portfolio_wrap_bg',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .acea-portfolio-wrap',
			]
		);

        $this->add_control(
            'content_bg_color',
            [
                'label' => __('Content Background Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'label' => __('Content Width', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'default' => [
					'unit' => '%',
					'size' => 58,
				],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content.style-three' => 'width:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'layout_style_type' => 'style-three',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_gap',
            [
                'label' => __('Content gap', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'left:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_position' => 'on-image',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_y_position',
            [
                'label' => __('Content Y Position', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'bottom:{{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'content_position' => 'on-image',
                ]
            ]
        );
        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Content Padding', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_radius',
            [
                'label' => __('Content Box Radius', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .acea-portfolio-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label' => __('Box Radius', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    ' {{WRAPPER}} .acea-portfolio-item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        $this->start_controls_section(
            'section_loadmore',
            [
                'label' => __('Loadmore', 'acea-ts'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_loadmore' => 'yes'
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'acea-ts'),
                'name' => 'loadmore_typo',
                'selector' => '{{WRAPPER}} .acea-pf-loadmore-btn',
            ]
        );
        $this->start_controls_tabs(
            'loadmore_hover_tabs'
        );
        $this->start_controls_tab(
            'loadmore_normal_tab',
            [
                'label' => __('Normal', 'acea-ts'),
            ]
        );
        $this->add_responsive_control(
            'load_more_width',
            [
                'label' => __('Width', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn' => 'width:{{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_responsive_control(
            'load_more_height',
            [
                'label' => __('Height', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn' => 'height:{{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'loadore_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'loadmore_background_color',
            [
                'label' => __('Filter background Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'loadmore_border',
                'label' => __('Border', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-pf-loadmore-btn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'loadmore_hover_tab',
            [
                'label' => __('Hover', 'acea-ts'),
            ]
        );
        $this->add_control(
            'loadore_hover_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'loadmore_hover_bg_color',
            [
                'label' => __('Filter background Color', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'loadmore_hover_border',
                'label' => __('Border', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-pf-loadmore-btn:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control(
            'hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __('Button Padding', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '22',
                    'right' => '38',
                    'bottom' => '21',
                    'left' => '38',
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_radius',
            [
                'label' => __('Border Radius', 'acea-ts'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default' => [
                    'top' => '33',
                    'right' => '33',
                    'bottom' => '33',
                    'left' => '33',
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-pf-loadmore-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_shadow',
                'label' => __('Button Shadow', 'acea-ts'),
                'selector' => '{{WRAPPER}} .acea-pf-loadmore-btn',
                'fields_options' =>
                [
                    'box_shadow_type' =>
                    [
                        'default' => 'yes',
                    ],
                    'box_shadow' => [
                        'default' =>
                        [
                            'horizontal' => 0,
                            'vertical' => 0,
                            'blur' => 0,
                            'spread' => 0,
                            'color' => 'rgba(3, 3, 3, 0.14)',
                        ],
                    ],
                ],
            ]
        );
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
        $layout_style = $settings['layout_style_type'];
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $portfolio_data = [];
        $portfolio_data['settings'] = $this->get_settings();
        $portfolio_data = json_encode($portfolio_data);

        // Including the query 
        include('queries/portfolio-query.php');
        if ($the_query->have_posts()) :
            if ($settings['enable_filtering']) :
    ?>
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <ul class="pf-isotope-nav text-<?php echo esc_attr($settings['filter_align']); ?>">
                                <li data-filter="<?php echo esc_attr('*') ?>" class="active"><?php echo esc_html($settings['all_text'])  ?></li>
                                <?php
                                if (0 != count($settings['include_categories'])) :
                                    foreach ($settings['include_categories'] as $cat) :
                                        $pf_term = get_term_by('slug', $cat, 'portfolio-category');
                                ?>
                                        <li data-filter=".<?php echo esc_attr($pf_term->slug) ?>"><?php echo esc_html($pf_term->name) ?>(<?php echo $pf_term->count; ?>)</li>
                                        <?php
                                    endforeach;
                                else :
                                    $pf_terms = get_terms('portfolio-category');
                                    if (!empty($pf_terms)) :
                                        foreach ($pf_terms as $pf_term) : ?>
                                            <li data-filter=".<?php echo esc_attr($pf_term->slug) ?>"><?php echo esc_html($pf_term->name) ?>(<?php echo esc_html( $pf_term->count ); ?>)</li>
                                <?php
                                        endforeach;
                                    endif;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="container-fluid">
                <div class="row acea-portfolio-wrap layout-mode-<?php echo esc_attr($settings['layout_type'] . ' ' . $settings['enable_hover_rotate']) .' enable-filter-'.$settings['enable_filtering']  ?>">
                    <?php
                    // including the item
                    include('contents/'.$layout_style.'.php');
                    ?>
                </div>
            </div>
            <?php
            $total_posts = $the_query->found_posts;
            if ('yes' == $settings['enable_loadmore'] && '-1' != $settings['posts_per_page'] && $total_posts >= $settings['posts_per_page']) :
                $posts_per_page = $settings['posts_per_page'];
                $page_amount = ceil($total_posts / $posts_per_page);
                $ajaxurl = admin_url('admin-ajax.php');
                $nonce = wp_create_nonce('acea_loadmore_callback');
            ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="acea-loadmore-wrap text-<?php echo $settings['loadmore_align']; ?>">
                                <span id="load-next-portfolios-message"></span>
                                <span class="acea-pf-loadmore-btn" data-url="<?php echo esc_url($ajaxurl) ?>" data-referrar="<?php echo $nonce; ?>" data-total-page="<?php echo $page_amount; ?>" data-paged="<?php echo $paged; ?>" data-portfolio-settings='<?php echo $portfolio_data ?>'><?php echo $settings['loadmore_text'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif;
        wp_reset_postdata();
    }
}

$widgets_manager->register_widget_type(new \acea_portfolio_loop());