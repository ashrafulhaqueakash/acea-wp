<?php
namespace Acea\Widgets\Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;

class Acea_Job_Board extends Widget_Base {

	public function get_name() {
		return 'acea-job';
	}

	public function get_title() {
		return esc_html__( 'Acea Job', 'acea-addons' );
	}

	public function get_icon() {
		return 'eicon-page-transition';
	}

   	public function get_categories() {
		return [ 'acea-addons' ];
	}

	public function get_keywords() {
        return [ 'acea-addons', 'fancy', 'heading', 'job' ];
    }

 	
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Genarel', 'acea-ts'),
            ]
        );
        
        $this->add_control(
			'show_title',
			[
				'label' => esc_html__( 'Show Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
            'heading_text',
            [
                'label' => __('Heading', 'acea-ts'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Open Roles', 'acea-ts'),
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'show_type',
			[
				'label' => esc_html__( 'Show Type', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

        $this->add_control(
			'show_location',
			[
				'label' => esc_html__( 'Show Location', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'show_team',
			[
				'label' => esc_html__( 'Show Team', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'your-plugin' ),
				'label_off' => esc_html__( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'show_btn',
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
            'btn_text',
            [
                'label' => __('Button', 'acea-ts'),
                'type' => Controls_Manager::TEXT,
                'default' => __('View Details', 'acea-ts'),
                'condition' => [
                    'show_btn' => 'yes',
                ],
            ]
        );
        
        $this->end_controls_section();
        // meta area
        $this->start_controls_section(
            'meta_layout',
            [
                'label' => __('Meta LIst', 'acea-ts'),
            ]
        );
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'meta_title', [
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Position' , 'plugin-name' ),
				'label_block' => true,
			]
		);

        $repeater->add_responsive_control(
			'meta_width',
			[
				'label' => esc_html__( 'Width', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
				'default' => [
					'unit' => '%',
					'size' => 10,
				],
				
			]
		);

		$this->add_control(
			'meta_list',
			[
				'label' => esc_html__( 'Repeater List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'meta_title' => esc_html__( 'Position', 'plugin-name' ),
					],
					[
						'meta_title' => esc_html__( 'Team', 'plugin-name' ),
					],
				],
				'title_field' => '{{{ meta_title }}}',
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
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
            ]
        );

        $this->add_control(
            'source',
            [
                'label'         => __('Source', 'acea-ts'),
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'job' => 'job',
                    'manual_selection' => 'Manual Selection',
                    'related' => 'Related',
                ],
                'default' =>    'job',
            ]
        );

        $this->add_control(
            'manual_selection',
            [
                'label'         => __('Manual Selection', 'acea-ts'),
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get specific template posts', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_slug_and_id('job'),
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
                'type'          => Controls_Manager::SELECT2,
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
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('job-category'),
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
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('job-tag'),
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
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_author_slug_and_id('job'),
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
                'type'          => Controls_Manager::SELECT2,
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
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific category(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('job-category'),
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
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_taxonomy_slug_and_name('job-tag'),
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
                'type'          => Controls_Manager::SELECT2,
                'description'   => __('Get templates for specific tag(s)', 'acea-ts'),
                'label_block'   => true,
                'multiple'      => true,
                'options'       => acea_cpt_author_slug_and_id('job'),
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
                'type'          => Controls_Manager::SELECT,
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
                'type'          => Controls_Manager::SELECT,
                'options'       => [
                    'ASC'   => 'ASC',
                    'DESC'    => 'DESC',
                ],
                'default' =>    'DESC',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'filter_box_style',
            [
                'label' => __('Filter Box', 'acea-ts'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'filter_box_bg_color',
            [
                'label' => __('Background Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jobs-filter' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'filter_box_shadow',
                'exclude'  => [
                    'filter_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .jobs-filter',
                'separator' => 'after',
            ]
        );

        $this->add_responsive_control(
            'filter_box_radius',
            [
                'label'      => __('Border Radius', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jobs-filter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-filter' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_box_margin',
            [
                'label'      => __('Margin', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jobs-filter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-filter' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_box_padding',
            [
                'label'      => __('Padding', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jobs-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-filter' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_filter_style',
            [
                'label' => __('Filter', 'acea-ts'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filtering' => 'yes'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Filter Typography', 'acea-ts'),
                'name' => 'filter_typo',
                'selector' => '{{WRAPPER}} .jf-isotope-nav li',
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label' => __('Filter Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jf-isotope-nav li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'filter_hover_color',
            [
                'label' => __('Filter Hover Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .jf-isotope-nav li:hover,{{WRAPPER}} .jf-isotope-nav li.active' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'isotop_filter_margin',
            [
                'label'      => __('Margin', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .jobs-filter__menu ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .jobs-filter__menu ul li' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        Heading
        */
        $this->start_controls_section(
            'heading_top',
            [
                'label' => __('Table Heading', 'acea-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'acea-ts'),
                'name' => 'heading_typo',
                'selector' => '{{WRAPPER}} .job-wrapper table.job-table caption.table_heading',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table caption.table_heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => __('Margin', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .job-wrapper table.job-table caption.table_heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-wrapper table.job-table caption.table_heading' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        /*
        Table Top
        */
        $this->start_controls_section(
          'table_top',
          [
              'label' => __('Table Top', 'acea-hp'),
              'tab' => Controls_Manager::TAB_STYLE,
          ]
      );
      $this->add_group_control(
          Group_Control_Typography::get_type(),
          [
              'label' => __('Typography', 'acea-ts'),
              'name' => 'table_top_typo',
              'selector' => '{{WRAPPER}} .job-wrapper table.job-table th',
          ]
      );
      $this->add_control(
          'table_top_color',
          [
              'label' => __('Color', 'acea-ts'),
              'type' => Controls_Manager::COLOR,
              'selectors' => [
                  '{{WRAPPER}} .job-wrapper table.job-table th' => 'color: {{VALUE}};',
              ],
          ]
      );
      $this->add_responsive_control(
          'table_top_margin',
          [
              'label'      => __('Padding', 'acea-hp'),
              'type'       => Controls_Manager::DIMENSIONS,
              'size_units' => ['px'],
              'selectors'  => [
                  '{{WRAPPER}} .job-wrapper table.job-table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                  'body.rtl {{WRAPPER}} .job-wrapper table.job-table th' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
              ],
          ]
      );
      $this->end_controls_section();
      
        /*
        job table
        */
        $this->start_controls_section(
            'meta',
            [
                'label' => __('Job Board ', 'acea-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

      $this->add_control(
			'job_title',
        [
          'label' => __( 'Job Title', 'plugin-name' ),
          'type' => Controls_Manager::HEADING,
          'separator' => 'before',
        ]
		  );

      $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'acea-ts'),
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .job-wrapper table.job-table a.job-title',
            ]
        );

        $this->add_control(
            'title_text_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table a.job-title' => 'color: {{VALUE}};',
                ],
            ]
        );
       
        $this->add_control(
          'job_meta',
            [
              'label' => __( 'Job Meta', 'plugin-name' ),
              'type' => Controls_Manager::HEADING,
              'separator' => 'before',
            ]
          );
          $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __('Typography', 'acea-ts'),
                'name' => 'job_meta_typo',
                'selector' => '{{WRAPPER}} .job-wrapper table.job-table a.job-meta',
            ]
        );

        $this->add_control(
            'meta_text_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table a.job-meta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
          Group_Control_Border::get_type(),
          [
              'name'      => 'meta_border',
              'selector'  => '{{WRAPPER}} .job-wrapper table.job-table td',
          ]
      );

        $this->add_responsive_control(
          'meta_padding',
          [
              'label' => __('Padding', 'acea-ts'),
              'type' => Controls_Manager::DIMENSIONS,
              'size_units' => ['px', 'em', '%'],
              'selectors' => [
                  '{{WRAPPER}} .job-wrapper table.job-table td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                  'body.rtl {{WRAPPER}} .job-wrapper table.job-table td' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
              ],
          ]
      );

        $this->end_controls_section();

        /**
         * Button style
         */

        $this->start_controls_section(
            'section_btn_style',
            [
                'label' => __('Button', 'acea-ts'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'btn_typography',
				'selector' => '{{WRAPPER}} .job-wrapper table.job-table a.job-btn',
			]
		);

        $this->add_control(
            'btn_text_color',
            [
                'label' => __('Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table a.job-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_bg_color',
            [
                'label' => __('Background Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table a.job-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'btn_box_border',
                'selector'  => '{{WRAPPER}} .job-wrapper table.job-table a.job-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'btn_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .job-wrapper table.job-table a.job-btn',
            ]
        );
    
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => __('Padding', 'acea-ts'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table a.job-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-wrapper table.job-table a.job-btn' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'btn_content_radius',
            [
                'label' => __('Border Radius', 'acea-ts'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table a.job-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       
        $this->end_controls_section();

       /* Content Box */
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Table Box', 'acea-ts'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'table_box_border',
                'selector'  => '{{WRAPPER}} .job-wrapper table.job-table',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'table__box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .job-wrapper table.job-table',
            ]
        );
        
        $this->add_control(
            'table_bg_color',
            [
                'label' => __('Background Color', 'acea-ts'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_padding',
            [
                'label' => __('Padding', 'acea-ts'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-wrapper table.job-table' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'table_content_radius',
            [
                'label' => __('Content Box Radius', 'acea-ts'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .job-wrapper table.job-table' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
       
        $this->end_controls_section();
    }
	protected function render() {
    $settings = $this->get_settings();
    $heading_text = $settings['heading_text'];
    $btn_text = $settings['btn_text'];
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $include_categories = array();
    $exclude_tags = array();
    $include_tags = array();
    $include_authors = array();
    $exclude_categories = array();
    $exclude_authors = array();
    $current_post_id = '';

    if (0 != count($settings['include_categories'])) {
        $include_categories['tax_query'] = [
            'taxonomy' => 'job-category',
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
              'taxonomy' => 'job-category',
              'operator' => 'NOT IN',
              'field'    => 'slug',
              'terms'    => $settings['exclude_categories'],
          ];
      }
      if (0 != count($settings['exclude_tags'])) {
          $exclude_tags['tax_query'] = [
              'taxonomy' => 'job-tag',
              'operator' => 'NOT IN',
              'field'    => 'slug',
              'terms'    => $settings['exclude_tags'],
          ];
      }
      if (0 != count($settings['exclude_authors'])) {
          $exclude_authors = implode(',', $settings['exclude_authors']);
      }
      if (array_search('current_post', $settings['exclude_by'])  && is_single() && 'job' == get_post_type()) {
          $current_post_id = get_the_ID();
      }
      
      if ('related' == $settings['source'] && is_single() && 'job' == get_post_type()) {
          $related_categories = get_the_terms(get_the_ID(), 'job-category');
          $related_cats = [];
          if ($related_categories) {
              foreach ($related_categories as $related_cat) {
                  $related_cats[] = $related_cat->slug;
              }
          }
          $the_query = new \WP_Query(array(
              'posts_per_page' => $settings['posts_per_page'],
              'post_type' => 'job',
              'orderby' => $settings['orderby'],
              'order' => $settings['order'],
              'post__not_in' => array($current_post_id),
              'paged' => $paged,
              'tax_query' => array(
                  array(
                      'taxonomy' => 'job-category',
                      'operator' => 'IN',
                      'field'    => 'slug',
                      'terms'    => $related_cats,
                  ),
              ),
          ));
      } elseif ('meta' == $settings['source']) {
          $the_query = new \WP_Query(array(
              'posts_per_page' => $settings['posts_per_page'],
              'post_type' => 'job',
              'orderby' => $settings['orderby'],
              'order' => $settings['order'],
              'paged' => $paged,
              'post__in' => (0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
              'job-tag' => (0 != count($settings['include_tags'])) ? $include_tags : '',
              'post__not_in' => array($current_post_id),
              'author' => (0 != count($settings['include_authors'])) ? $include_authors : '',
              'author__not_in' => (0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
              'tax_query' => array(
                  'relation' => 'AND',
                  (0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
                  (0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
                  (0 != count($settings['include_categories'])) ? $include_categories : '',
              ),
              'meta_query' => array(
                  array(
                      'key' => 'job_type',
                      'value' => $settings['job_type']
                  )
              )
          ));
      } else {
          $the_query = new \WP_Query(array(
              'posts_per_page' => $settings['posts_per_page'],
              'post_type' => 'job',
              'orderby' => $settings['orderby'],
              'order' => $settings['order'],
              'paged' => $paged,
              'post__in' => (0 != count($settings['manual_selection'])) ? $settings['manual_selection'] : array(),
              'job-tag' => (0 != count($settings['include_tags'])) ? $include_tags : '',
              'post__not_in' => array($current_post_id),
              'author' => (0 != count($settings['include_authors'])) ? $include_authors : '',
              'author__not_in' => (0 != count($settings['exclude_authors'])) ? $exclude_authors : '',
              'tax_query' => array(
                  'relation' => 'AND',
                  (0 != count($settings['exclude_tags'])) ? $exclude_tags : '',
                  (0 != count($settings['exclude_categories'])) ? $exclude_categories : '',
                  (0 != count($settings['include_categories'])) ? $include_categories : '',
              ),
          ));
      }

    ?>
    <div class="job-wrapper" >
      <table class="job-table">
    <?php if ( 'yes' == $settings['show_title'] ): ?>
      <caption class="table_heading" ><?php echo esc_html( $heading_text ); ?></caption>
      <?php endif; ?>
      <thead>
      <?php if( $settings['meta_list'] ): ?>
        <tr>
        <?php foreach (  $settings['meta_list'] as $item ): ?>
          <th scope="col" width="<?php echo esc_attr( $item['meta_width']['size'] ); ?>%" ><?php echo esc_html( $item['meta_title'] ); ?></th>
          <?php endforeach; ?>
        </tr>
        <?php endif; ?>
      </thead>
      <tbody>
      <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); 
      
      $job_team = get_post_meta( get_the_ID(), 'job_metateam', true );
      $job_type = get_post_meta( get_the_ID(), 'job_metajob-type', true );
      $location = get_post_meta( get_the_ID(), 'job_metalocation', true );
      ?>
     
        <tr>
          <td class="job-position" data-label="Position"><a href="<?php the_permalink(); ?>" class="job-title" ><?php the_title(); ?></a></td>
          <?php if ( 'yes' == $settings['show_team'] ): ?>
          <td class="job-team" data-label="Team"><a href="<?php the_permalink(); ?>" class="job-meta" > <?php echo esc_html( $job_team); ?></a></td>
          <?php endif; ?>
          <?php if ( 'yes' == $settings['show_type'] ): ?>
          <td class="job-type" data-label="Type"><a href="<?php the_permalink(); ?>" class="job-meta" ><?php echo esc_html( $job_type); ?></a></td>
          <?php endif; ?>
          <?php if ( 'yes' == $settings['show_location'] ): ?>
          <td class="job-location" data-label="Location"><a href="<?php the_permalink(); ?>" class="job-meta" ><?php echo esc_html($location); ?></a></td>
          <?php endif; ?>
          <?php if ( 'yes' == $settings['show_btn'] ): ?>
          <td class="job-action"><a href="<?php the_permalink(); ?>" class="job-btn" ><?php echo esc_html($btn_text); ?></a></td>
          <?php endif; ?>
        </tr>
        <?php endwhile; endif; ?>
         
      </tbody>
    </table>
  </div>
	<?php }
}
$widgets_manager->register_widget_type(new \Acea\Widgets\Elementor\Acea_Job_Board());