<?php
if ( !defined( 'ABSPATH' ) ) {
    exacea;
}
// Exacea if accessed directly
/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
use Elementor\Icons_Manager;
class Acea_Project extends \Elementor\Widget_Base {
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
        return 'acea-projects';
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
        return __( 'Acea Project', 'acea-addons' );
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
        return 'eicon-settings';
    }
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the edaceaor.
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

        $this->section_layout_controls();
        $this->section_content_controls();
        $this->section_query_controls();
        $this->slider_settings_controls();
        
        /** style control***/ 
        $this->section_img_style();
        $this->section_content_style();
        $this->section_date_style();
        $this->section_btn_style();
        $this->section_dots_navigation();
        $this->section_arrows_navigation();
        $this->section_content_box_style();
    }

    /**
     * section_layout_control
     **/

    protected function section_layout_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Layout', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
     
        $this->add_control(
            'show_slider_settings',
            [
                'label' => __('Slider Active', 'finisys'),
                'type' =>  \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'finisys'),
                'label_off' => __('No', 'finisys'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_responsive_control('per_line', [
            'label'              => __('Columns Per row', 'acea-addons'),
            'type'               => \Elementor\Controls_Manager::SELECT,
            'default'            => '4 Column',
            'tablet_default'     => '6 Column',
            'mobile_default'     => '12 Column',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);

        $this->add_responsive_control(
            'column_gap',
            [
                'label'     => __( 'Column Gap', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => __( 'Row Gap', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-wrap' => 'margin: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }

    /*
    * section_content_controls
     */
     protected function section_content_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __( 'Content', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_excerpt',
            [
                'label'        => __( 'Show Excerpt', 'acea-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-addons' ),
                'label_off'    => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'excerpt_limit',
            [
                'label'    => __( 'Excerpt Word Limit', 'acea-addons' ),
                'type'     => \Elementor\Controls_Manager::SLIDER,
                'range'    => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'condaceaon' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'show_date',
            [
                'label'        => __( 'Show Date', 'acea-addons' ),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label_on'     => __( 'Show', 'acea-addons' ),
                'label_off'    => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
      
        $this->add_control(
			'show_project_button',
			[
				'label' => esc_html__( 'Show Button', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'project_btn_icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
                'condition'   => [
                    'show_project_button' => 'yes',
                ]
			]
		);
        $this->add_control(
			'btn_icon_text',
			[
				'label' => esc_html__( 'Button Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn More', 'plugin-name' ),
                'condition'   => [
                    'show_project_button' => 'yes',
                ]
			]
		);
        $this->end_controls_section();
     }

    /*section_query*/  
     protected function section_query_controls() {

        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Query', 'acea-ts' ),
            ]
        );
        $this->add_control(
            'posts_per_page',
            [
                'label'   => __( 'Posts per page', 'acea-ts' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );
        $this->add_control(
            'source',
            [
                'label'   => __( 'Source', 'acea-ts' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'project'          => 'Service',
                    'manual_selection' => 'Manual Selection',
                    'related'          => 'Related',
                ],
                'default' => 'project',
            ]
        );
        $this->add_control(
            'manual_selection',
            [
                'label'       => __( 'Manual Selection', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get specific template posts', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_slug_and_id( 'project' ),
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
                'label'     => __( 'Include', 'acea-ts' ),
                'condition' => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'include_by',
            [
                'label'       => __( 'Include by', 'acea-ts' ),
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
                'label'       => __( 'Include categories', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific category(s)', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name( 'project-category' ),
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
                'label'       => __( 'Include Tags', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name( 'project-tag' ),
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
                'label'       => __( 'Include authors', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_author_slug_and_id( 'project' ),
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
                'label'     => __( 'Exclude', 'acea-ts' ),
                'condition' => [
                    'source!' => 'manual_selection',
                ],
            ]
        );
        $this->add_control(
            'exclude_by',
            [
                'label'       => __( 'Exclude by', 'acea-ts' ),
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
                'label'       => __( 'Exclude categories', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific category(s)', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name( 'project-category' ),
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
                'label'       => __( 'Exclude Tags', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_taxonomy_slug_and_name( 'project-tag' ),
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
                'label'       => __( 'Exclude authors', 'acea-ts' ),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'description' => __( 'Get templates for specific tag(s)', 'acea-ts' ),
                'label_block' => true,
                'multiple'    => true,
                'options'     => acea_cpt_author_slug_and_id( 'project' ),
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
                'label'   => __( 'Order By', 'acea-ts' ),
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
                'label'   => __( 'Order', 'acea-ts' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC'  => 'ASC',
                    'DESC' => 'DESC',
                ],
                'default' => 'DESC',
            ]
        );
        $this->end_controls_section();

     }

     /**
      *slider_settings_controls 
      */
    protected function slider_settings_controls(){
        $this->start_controls_section('slider_settings',
            [
                'label' => __('Slider Settings', 'acea-addons'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_slider_settings' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'per_coulmn',
            [
                'label' => __( 'Slider Items', 'acea-addons' ),
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
                    '5' => '5',
                ],
                'frontend_available' => true,
            ]
        );
        $this->add_control(
            'arrows',
            [
                'label' => __( 'Show arrows?', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'acea-addons' ),
                'label_off' => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label' => __( 'Show Dots?', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'acea-addons' ),
                'label_off' => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'mousedrag',
            [
                'label' => __( 'Show MouseDrag', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'acea-addons' ),
                'label_off' => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Auto Play?', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'acea-addons' ),
                'label_off' => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinaceae Loop', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'acea-addons' ),
                'label_off' => __( 'Hide', 'acea-addons' ),
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );
        $this->add_control(
            'autoplaytimeout',
            [
                'label' => __( 'Autoplay Timeout', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'label_block' => true,
                'default' => '5000',
                'options' => [
                    '1000'  => __( '1 Second', 'acea-addons' ),
                    '2000'  => __( '2 Second', 'acea-addons' ),
                    '3000'  => __( '3 Second', 'acea-addons' ),
                    '4000'  => __( '4 Second', 'acea-addons' ),
                    '5000'  => __( '5 Second', 'acea-addons' ),
                    '6000'  => __( '6 Second', 'acea-addons' ),
                    '7000'  => __( '7 Second', 'acea-addons' ),
                    '8000'  => __( '8 Second', 'acea-addons' ),
                    '9000'  => __( '9 Second', 'acea-addons' ),
                    '10000' => __( '10 Second', 'acea-addons' ),
                    '11000' => __( '11 Second', 'acea-addons' ),
                    '12000' => __( '12 Second', 'acea-addons' ),
                    '13000' => __( '13 Second', 'acea-addons' ),
                    '14000' => __( '14 Second', 'acea-addons' ),
                    '15000' => __( '15 Second', 'acea-addons' ),
                ],
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'arrow_prev_icon',
            [
                'label' => __( 'Previous Icon', 'acea' ),
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
                'label' => __( 'Next Icon', 'acea' ),
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
    }
     
 
    /*section_content_style**/
    protected function section_content_style() {
        $this->start_controls_section(
            'content_style',
            [
                'label' => __( 'Content', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'content_style_tabs'
        );
        $this->start_controls_tab(
            'content_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Title Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item a h3.project-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_color',
            [
                'label'     => __( 'Excerpt Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'label'    => __( 'Title Typography', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item a h3.project-title',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'excerpt_typ',
                'label'    => __( 'Excerpt Typography', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item p',
            ]
        );
        $this->add_control(
            'title_br',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER,
            ]
        );
       
        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Title Margin', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item a h3.project-title'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-project-widget-item a h3.project-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __( 'Content margin', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item .project-content p'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-project-widget-item .project-content p' => 'margin:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_box_padding',
            [
                'label'      => __( 'Content Box Padding', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .project-content-wrap'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .project-content-wrap' => 'padding:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'content_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label'     => __( 'Title Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item:hover a h3.project-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'excerpt_hover_color',
            [
                'label'     => __( 'Excerpt Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item:hover p' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    //section_date_style

    protected function section_date_style () {
        $this->start_controls_section(
            'date_style',
            [
                'label' => __( 'Date', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'date_color',
            [
                'label'     => __( 'Date Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .project-date' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'date_typography',
                'label'    => __( 'Typography', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .project-date',
            ]
        );

        $this->end_controls_section();
    }


    /**
     * section icon style
     */
    protected function section_img_style() {
        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Image', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%',],
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
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .project-icon-wrapper img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .project-icon-wrapper img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'object-fit',
            [
                'label'     => __('Object Fit', 'it-addons'),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'condition' => [
                    'height[size]!' => '',
                ],
                'options'   => [
                    ''        => __('Default', 'it-addons'),
                    'fill'    => __('Fill', 'it-addons'),
                    'cover'   => __('Cover', 'it-addons'),
                    'contain' => __('Contain', 'it-addons'),
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .project-icon-wrapper img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .project-icon-wrapper img',
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'image_box_radius',
            [
                'label'      => __('Border Radius', 'it-addons'),
                'type'       =>  \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .project-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .project-icon-wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .project-icon-wrapper img',
            ]
        );

        $this->add_responsive_control(
            'image_gap',
            [
                'label'      => __( 'Image Gap', 'it-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .project-icon-wrapper img ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       
        $this->end_controls_section();
    }

    /**
     * section_btn_style
     *
     * @return void
     */
    protected function section_btn_style() {
        $this->start_controls_section(
            'content_btn__style',
            [
                'label' => __( 'Button', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_project_button' => 'yes',
                ]
            ]
        );
        $this->start_controls_tabs(
            'btn_style_tabs'
        );
        $this->start_controls_tab(
            'btn_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'button_color',
            [
                'label'     => __( 'Button Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item .project-btn-area a' => 'color: {{VALUE}}',
                ],
            ]
        );
       
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'label'    => __( 'Button Typography', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item .project-btn-area a',
            ]
        );
        
        
        $this->add_responsive_control(
            'button_width',
            [
                'label'     => __( 'Button Width', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item .project-btn-area a' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_height',
            [
                'label'     => __( 'Button Height', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item .project-btn-area a' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'project_btn_padding',
            [
                'label'      => __( 'Button Padding', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item .project-btn-area a'          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-project-widget-item .project-btn-area a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'project_btn_margin',
            [
                'label'      => __( 'Margin', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item .project-btn-area a'          => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-project-widget-item .project-btn-area a' => 'margin:
                    {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'btn_icon_divided',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        $this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Icon Options', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'btn_icon_color',
            [
                'label'     => __( 'Icon Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item span.project_icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-project-widget-item span.project_icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_icon_size',
            [
                'label'     => __( 'Icon Size', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item span.project_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-project-widget-item span.project_icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_top_gap',
            [
                'label'     => __( 'Margin Top', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item span.project_icon svg' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'icon_right_gap',
            [
                'label'     => __( 'Margin Right', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices'   => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item span.project_icon svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'btn_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label'     => __( 'Button Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item:hover .project-btn-area a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_icon_hover_color',
            [
                'label'     => __( 'Icon Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item:hover span.project_icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-project-widget-item:hover span.project_icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }

    /**section_dots_navigation */
    protected function section_dots_navigation(){
        $this->start_controls_section(
            'dots_navigation',
            [
                'label' => __('Navigation - Dots', 'acea-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes'
                ],
            ]
        );
        $this->start_controls_tabs('_tabs_dots');
    
        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
    
        $this->add_control(
            'dots_color',
            [
                'label' => __('Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list li' => 'background-color: {{VALUE}}!important;',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'dots_align',
            [
                'label' => __( 'Alignment', 'acea-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'acea-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'dots_box_width',
            [
                'label' => __('Width', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list li' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'dots_box_height',
            [
                'label' => __('Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list li' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'popover-toggle',
            [
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label' => esc_html__( 'Dots Advance', 'plugin-name' ),
                'label_off' => esc_html__( 'Default', 'plugin-name' ),
                'label_on' => esc_html__( 'Custom', 'plugin-name' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            'dots_left',
            [
                'label'          => __('Left', 'acea-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .project-slider-dot-list li ' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_top',
            [
                'label'          => __('Top', 'acea-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .project-slider-dot-list li ' => ' top: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'dots_margin',
            [
                'label'          => __('Gap Right', 'acea-addons'),
                'type'           => \Elementor\Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => 'px',
                ],
                'range'          => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .project-slider-dot-list li ' => 'margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .project-slider-dot-list li ' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_min_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .project-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .project-slider-dot-list' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'dots_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .project-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .project-slider-dot-list li' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
    
        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __('Active', 'acea-addons'),
            ]
        );
        $this->add_control(
            'dots_color_active',
            [
                'label' => __('Active Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list li.slick-active' => 'background-color: {{VALUE}}  !important;',
                    '{{WRAPPER}} .project-slider-dot-list li.slick-active button' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'arrow_dots_box_active_width',
            [
                'label' => __('Width', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list li.slick-active' => 'width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'arrow_dots_box_active_height',
            [
                'label' => __('Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .project-slider-dot-list li.slick-active' => 'height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
    
        $this->end_controls_section();
    }

    /**section_arrows_navigation */
    protected function section_arrows_navigation() {
        $this->start_controls_section(
            'arrows_navigation',
            [
                'label' => __('Navigation - Arrow', 'acea-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'arrows' => 'yes',
                ],
            ]
        );
        
        $this->start_controls_tabs('_tabs_arrow');
        
        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        
        $this->add_control(
            'arrow_color',
            [
                'label' => __('Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .projects-slider-arrow button' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .projects-slider-arrow button svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'arrow_color_fill',
            [
                'label' => __('Line Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .projects-slider-arrow button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .projects-slider-arrow button svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __('Background Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                     '{{WRAPPER}} .projects-slider-arrow button' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'arrow_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .projects-slider-arrow button ',
            ]
        );
        
        $this->add_control(
            'arrow_posaceaion_toggle',
            [
                'label' => __('Posaceaion', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __('None', 'acea-addons'),
                'label_on' => __('Custom', 'acea-addons'),
                'return_value' => 'yes',
            ]
        );
        $this->start_popover();
        
        /*
        Arrow Posaceaion
        */
        
             /* tobol */
             $this->add_control(
                'offset_orientation_v',
                [
                    'label' => __( 'Vertical Orientation', 'elementor' ),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'toggle' => false,
                    'default' => 'start',
                    'options' => [
                        'top' => [
                            'title' => __( 'Top', 'elementor' ),
                            'icon' => 'eicon-v-align-top',
                        ],
                        'bottom' => [
                            'title' => __( 'Bottom', 'elementor' ),
                            'icon' => 'eicon-v-align-bottom',
                        ],
                    ],
                    'render_type' => 'ui',
                    'selectors' => [
                        '{{WRAPPER}} .projects-slider-arrow' => '{{VALUE}}: 0;',
                    ],
        
                ]
            );
        
            $this->add_responsive_control(
            'arrow_posaceaion_top',
            [
                'label' => __('Vertical', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%','px'],
                'condition' => [
                    'arrow_posaceaion_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-slider-arrow' => 'top: {{SIZE}}{{UNIT}} !important; bottom:auto',
                ],
                'condition' => [
                    'offset_orientation_v' => 'top',
                ],
            ]
        );
        
        $this->add_responsive_control(
        'arrow_posaceaion_bottom',
        [
            'label' => __('Vertical', 'acea-addons'),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['%','px'],
            'condition' => [
                'arrow_posaceaion_toggle' => 'yes'
            ],
            'range' => [
                'px' => [
                    'min' => -1000,
                    'max' => 1000,
                ],
                '%' => [
                    'min' => -100,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .projects-slider-arrow' => 'bottom: {{SIZE}}{{UNIT}} !important; top:auto',
            ],
            'condition' => [
                'offset_orientation_v' => 'bottom',
            ],
        ]
        );
        
        $this->add_control(
            'arrow_horizontal_posaceaion',
            [
                'label'             => __( 'Horizontal Posaceaion', 'acea-addons' ),
                'type'              => \Elementor\Controls_Manager::SELECT,
                'default'           => 'default',
                'options'           => [
                    'default'    =>   __('Default',    'acea-addons'),
                    'space_between'    =>   __('Space Between',    'acea-addons'),
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'arrow_posaceaion_x_prev',
            [
                'label' => __( 'Horizontal Prev', 'happy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'condition' => [
                    'arrow_posaceaion_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 2000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .projects-slider-arrow .prev' => 'left: {{SIZE}}{{UNIT}}; right: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_posaceaion' => 'space_between',
                ],
        
            ]
        );
        
        // default == arrow gap
        // space-between == left posaceaion, right posaceaion
        
        $this->add_responsive_control(
            'arrow_posaceaion_right',
            [
                'label' => __( 'Horizontal Next', 'happy-elementor-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -2000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-slider-arrow .next' => 'right: {{SIZE}}{{UNIT}} !important; left: auto !important;',
                ],
                'condition' => [
                    'arrow_horizontal_posaceaion' => 'space_between',
                ],
            ]
        );
        
        $this->end_popover();
        
        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .projects-slider-arrow button i' => 'font-size: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}}  .projects-slider-arrow button svg' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'arrow_size_box',
            [
                'label' => __('Size', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-slider-arrow button' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
            ]
        
        );
        
        $this->add_responsive_control(
            'arrow_size_line_height',
            [
                'label' => __('Line Height', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-slider-arrow button' => 'line-height: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        
        );
        
        $this->add_responsive_control(
            'arrows_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .projects-slider-arrow button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .projects-slider-arrow button ' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __('Active', 'acea-addons'),
            ]
        );
        
        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __('Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                     '{{WRAPPER}} .projects-slider-arrow .slick-active' => 'color: {{VALUE}};',
                     '{{WRAPPER}} .projects-slider-arrow button:hover ' => 'color: {{VALUE}};',
                     '{{WRAPPER}} .projects-slider-arrow .slick-active svg path' => 'stroke: {{VALUE}};',
                     '{{WRAPPER}} .projects-slider-arrow button:hover svg path ' => 'stroke: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'arrow_hover_fill_color',
            [
                'label' => __('Line Color', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                     '{{WRAPPER}} .projects-slider-arrow .slick-active' => 'color: {{VALUE}};',
                     '{{WRAPPER}} .projects-slider-arrow button:hover ' => 'color: {{VALUE}};',
                     '{{WRAPPER}} .projects-slider-arrow .slick-active path' => 'fill: {{VALUE}};',
                     '{{WRAPPER}} .projects-slider-arrow button:hover path' => 'fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'arrow_bg_hover_color',
            [
                'label' => __('Background Color Hover', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                     '{{WRAPPER}} .projects-slider-arrow button:hover ' => 'background-color: {{VALUE}}  !important;',
                     '{{WRAPPER}} .projects-slider-arrow .slick-active ' => 'background-color: {{VALUE}}  !important;',
                ],
            ]
        );
        
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }

    /**
     * section_content_box_style
     *
     * @return void
     */
    protected function section_content_box_style() {
        $this->start_controls_section(
            'section_content_box_style',
            [
                'label' => __( 'Box', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'box_alignment',
			[
				'label' => esc_html__( 'Alignment', 'plugin-name' ),
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
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item' => 'text-align: {{VALUE}};',
                ],
				'default' => 'center',
				'toggle' => true,
			]
		);
        $this->start_controls_tabs(
            'box_style_tabs'
        );
        $this->start_controls_tab(
            'box_style_normal_tab',
            [
                'label' => __( 'Normal', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'box_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => __( 'Box Hover Shadow', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item',
            ]
        );
        $this->add_responsive_control(
            'box_radius',
            [
                'label'      => __( 'Box Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_padding',
            [
                'label'      => __( 'Box Padding', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item '          => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'box_style_hover_tab',
            [
                'label' => __( 'Hover', 'acea-addons' ),
            ]
        );
        $this->add_control(
            'box_hover_bg_color',
            [
                'label'     => __( 'Box Backgroound Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'defautl'   => '#233aff',
                'selectors' => [
                    '{{WRAPPER}} .acea-project-widget-item:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_hover_radius',
            [
                'label'      => __( 'Box Radius', 'acea-addons' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-project-widget-item:hover'          => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_hover_shadow',
                'label'    => __( 'Box Hover Shadow', 'acea-addons' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item:hover',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_hover_border',
                'label'    => __( 'Box Border', '' ),
                'selector' => '{{WRAPPER}} .acea-project-widget-item:hover ',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
    }
    /**
     * Render the widget output on the frontend.
     *
     * Wraceaten in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();

        /* Gride Class */
        $grid_classes = [];
        $grid_classes[] = 'col-lg-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('project_gride_classes', 'class', [$grid_classes, 'acea-project-widget-wrap']);

        $custom_css        = '';
        $paged              = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
        $include_categories = array();
        $exclude_tags       = array();
        $include_tags       = array();
        $include_authors    = array();
        $exclude_categories = array();
        $exclude_authors    = array();
        $is_include_cat    = in_array( 'category', $settings['include_by'] );
        $is_include_tag    = in_array( 'tags', $settings['include_by'] );
        $is_include_author = in_array( 'author', $settings['include_by'] );
        $is_exclude_cat    = in_array( 'category', $settings['exclude_by'], );
        $is_exclude_tag    = in_array( 'tags', $settings['exclude_by'] );
        $is_exclude_author = in_array( 'author', $settings['exclude_by'] );
        $current_post_id = '';

        if ( 0 != count( $settings['include_categories'] ) ) {
            $include_categories['tax_query'] = [
                'taxonomy' => 'project-category',
                'field'    => 'slug',
                'terms'    => $settings['include_categories'],
            ];
        }
        if ( 0 != count( $settings['include_tags'] ) ) {
            $include_tags = implode( ',', $settings['include_tags'] );
        }
        if ( 0 != count( $settings['include_authors'] ) ) {
            $include_authors = implode( ',', $settings['include_authors'] );
        }
        if ( 0 != count( $settings['exclude_categories'] ) ) {
            $exclude_categories['tax_query'] = [
                'taxonomy' => 'project-category',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_categories'],
            ];
        }
        if ( 0 != count( $settings['exclude_tags'] ) ) {
            $exclude_tags['tax_query'] = [
                'taxonomy' => 'project-tag',
                'operator' => 'NOT IN',
                'field'    => 'slug',
                'terms'    => $settings['exclude_tags'],
            ];
        }
        if ( 0 != count( $settings['exclude_authors'] ) ) {
            $exclude_authors = implode( ',', $settings['exclude_authors'] );
        }
        if ( in_array( 'current_post', $settings['exclude_by'] ) && is_single() && 'portfolio' == get_post_type() ) {
            $current_post_id = get_the_ID();
        }
       // var_dump($settings['exclude_categories']);
        if ( 'related' == $settings['source'] && is_single() && 'portfolio' == get_post_type() ) {
            $related_categories = get_the_terms( get_the_ID(), 'project-category' );
            $related_cats       = [];
            if ( $related_categories ) {
                foreach ( $related_categories as $related_cat ) {
                    $related_cats[] = $related_cat->slug;
                }
            }
            $the_query = new WP_Query( array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'project',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'post__not_in'   => array( $current_post_id ),
                'paged'          => $paged,
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'project-category',
                        'operator' => 'IN',
                        'field'    => 'slug',
                        'terms'    => $related_cats,
                    ),
                ),
            ) );
        } elseif ( 'manual_selection' == $settings['source'] ) {
            $the_query = new WP_Query( array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'project',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'paged'          => $paged,
                'post__in'       => ( 0 != count( $settings['manual_selection'] ) ) ? $settings['manual_selection'] : array(),
            ) );
        } else {
            $the_query = new WP_Query( array(
                'posts_per_page' => $settings['posts_per_page'],
                'post_type'      => 'project',
                'orderby'        => $settings['orderby'],
                'order'          => $settings['order'],
                'paged'          => $paged,
                'project-tag'    => ( $is_include_tag && 0 != count( $settings['include_tags'] ) ) ? $include_tags : '',
                'post__not_in'   => array( $current_post_id ),
                'author'         => ( $is_include_author && 0 != count( $settings['include_authors'] ) ) ? $include_authors : '',
                'author__not_in' => ( $is_exclude_author && 0 != count( $settings['exclude_authors'] ) ) ? $exclude_authors : '',
                'tax_query'      => array(
                    'relation' => 'AND',
                    ( $is_exclude_tag && 0 != count( $settings['exclude_tags'] ) ) ? $exclude_tags : '',
                    ( $is_exclude_cat && 0 != count( $settings['exclude_categories'] ) ) ? $exclude_categories : '',
                    ( $is_include_cat && 0 != count( $settings['include_categories'] ) ) ? $include_categories : '',
                ),
            ) );
        }
          //this code slider option
		$slider_extraSetting = array(
	        'loop' => (!empty($settings['loop']) && 'yes' === $settings['loop']) ? true : false,
	        'dots' => (!empty($settings['dots']) && 'yes' === $settings['dots']) ? true : false,
	        'autoplay' => (!empty($settings['autoplay']) && 'yes' === $settings['autoplay']) ? true : false,
        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
        	'nav' => (!empty($settings['arrows']) && 'yes' === $settings['arrows']) ? true : false,
        	'show_vertical' => (!empty($settings['show_vertical']) && 'yes' === $settings['show_vertical']) ? true : false,
        	'autoplaytimeout' => !empty($settings['autoplaytimeout']) ? $settings['autoplaytimeout'] : '5000',
            //this a responsive layout
            'per_coulmn' =>        (!empty($settings['per_coulmn'])) ? $settings['per_coulmn'] : 3,
            'per_coulmn_tablet' => (!empty($settings['per_coulmn_tablet'])) ? $settings['per_coulmn_tablet'] : 2,
            'per_coulmn_mobile' => (!empty($settings['per_coulmn_mobile'])) ? $settings['per_coulmn_mobile'] : 1
        );

        $jasondecode = wp_json_encode($slider_extraSetting);

        if ( ( 'yes' == $settings['show_slider_settings'] ) ) {
            $this->add_render_attribute('projects_version', 'class', array('projects-slider' ));
            $this->add_render_attribute('projects_version', 'data-settings', $jasondecode);
        }
        else {
            $this->add_render_attribute('projects_version', 'class', array( 'row justify-content-center'));

        }
       
        ?>
<?php if ( $the_query->have_posts() ): ?>
    <div <?php echo $this->get_render_attribute_string('projects_version'); ?>>
        <?php while ( $the_query->have_posts() ): $the_query->the_post();?>
			        <?php
            $idd        = get_the_ID();
            $excerpt    = ( $settings['excerpt_limit']['size'] ) ? wp_trim_words( get_the_excerpt(), $settings['excerpt_limit']['size'], '...' ) : get_the_excerpt();
          

            ?>
            <div <?php echo $this->get_render_attribute_string('project_gride_classes'); ?>>
                <div class="acea-project-widget-item ">
                    <?php if ( has_post_thumbnail() ) : ?>
                    <div class="project-icon-wrapper">
                        <a href="<?php echo get_the_permalink(); ?>"> <?php the_post_thumbnail(); ?></a>
                    </div>
                    <?php endif; ?>
                    <div class="project-content-wrap">
                        <div class="project-content">
                            <div class="d-block">
                                <?php the_title( '<a href="'.get_the_permalink().'"><h3 class="project-title">','</h3></a>',); ?>
                            </div>
                            <div class = "project-content" >
                            <?php
                                echo ( 'yes' == $settings['show_excerpt'] ) ? sprintf( '<p> %s </p>', esc_html( $excerpt ) ) : '';
                            ?>
                            </div>
                            <?php if ( 'yes' == $settings['show_date'] ):?>
                            <div class="project-date" >
                                <?php echo get_the_date( 'F-d-Y', get_the_ID() ); ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if ( 'yes' == $settings['show_project_button'] ): ?>
                        <div class ="project-btn-area" >
                            <a href="<?php echo esc_url( get_the_permalink() ) ?>">
                            <?php echo esc_html( $settings['btn_icon_text']); ?>
                            <span class="project_icon" ><?php \Elementor\Icons_Manager::render_icon( $settings['project_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>   
                </div>
            </div>

        <?php
        endwhile;
        wp_reset_postdata();?>
        </div>
        <?php if ( 'yes' == $settings['show_slider_settings'] && 'yes' == $settings['arrows']): ?>
            <div class="projects-slider-arrow">
            <?php if ( ! empty( $settings['arrow_next_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-next next slick-arrow ">
                        <?php Icons_Manager::render_icon( $settings['arrow_next_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>

                <?php if ( ! empty( $settings['arrow_prev_icon']['value'] ) ) : ?>
                    <button type="button" class="slick-prev prev slick-arrow slick-active">
                        <?php Icons_Manager::render_icon( $settings['arrow_prev_icon'], ['aria-hidden' => 'true'] ); ?>
                    </button>
                <?php endif; ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>

<?php

    }
}
$widgets_manager->register_widget_type( new \Acea_Project() );