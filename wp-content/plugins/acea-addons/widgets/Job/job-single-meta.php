<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
/**
 * Shade heading widget.
 *
 * Shade widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Acea_Single_Job_Meta extends Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve heading widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'acea-single-job-meta';
    }
    /**
     * Get widget title.
     *
     * Retrieve heading widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Acea Single Job Meta', 'acea-hp');
    }
    /**
     * Get widget icon.
     *
     * Retrieve heading widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-t-letter';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the heading widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['acea-addons'];
    }
    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['meta', 'job', 'single'];
    }
    /**
     * Register heading widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'acea-hp'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'signle_meta_icon',
			[
				'label' => esc_html__( 'Icon', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'solid',
				],
			]
		);
        $repeater->add_control(
            'label',
            [
                'label'       => __('Label', 'acea-hp'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'acea-hp'),
                'default'     => __('Category Here', 'acea-hp'),
            ]
        );
        $repeater->add_control(
            'get_meta',
            [
                'label'   => __('Select Meta', 'acea-hp'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'category'        => 'Category',
                    'job_metalocation'    => 'Job Location',
                    'job_metajob-type'    => 'Job Type',
                    'job_metateam'    => 'Job Team',
                    'job_meta_salary'    => 'Salary scale',
                ],
                'default' => 'category',
            ]
        );
        $this->add_control(
            'job_meta_list',
            [
                'label'       => __('Meta List', 'acea-hp'),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ label }}}',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_lavel_style',
            [
                'label' => __('Meta Label', 'acea-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'label_color',
            [
                'label'     => __('Label Color', 'acea-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-meta-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'label'    => __('Label Typography', 'acea-hp'),
                'selector' => '{{WRAPPER}} .job-meta-label',
            ]
        );
        $this->add_control(
            'label_margin',
            [
                'label'      => __('Margin', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .job-meta-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-meta-label' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => __('Meta Content', 'acea-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'meta_color',
            [
                'label'     => __('MEta Color', 'acea-hp'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .job-meta-value' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'meta_typography',
                'label'    => __('Meta Typography', 'acea-hp'),
                'selector' => '{{WRAPPER}} .job-meta-value',
            ]
        );
        $this->add_control(
            'gap',
            [
                'label'      => __('List Gap', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .job-meta-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-meta-value' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // icon
        $this->start_controls_section(
            'icon_content_style',
            [
                'label' => __('Icon', 'acea-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'single_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-icon i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .single-icon svg' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .single-icon svg path' => 'fill: {{VALUE}}'
				],
			]
		);
        // bg color
        $this->add_control(
			'single_icon_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-icon' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'single_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .single-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .single-icon svg' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'icon_alignment',
			[
				'label' => esc_html__( 'Alignment', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'plugin-name' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'plugin-name' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Bottom', 'plugin-name' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .job-meta' => 'align-items: {{VALUE}};',
                ],
				'toggle' => true,
			]
        );
        // gap
        $this->add_control(
			'single_icon_gap',
			[
				'label' => esc_html__( 'Gap', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        // Border
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'signle_icon_border',
				'label' => esc_html__( 'Border', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .single-icon',
			]
		);

        $this->add_control(
			'single_icon_padding',
			[
				'label' => esc_html__( 'Padding', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        // radius
        $this->add_control(
			'single_icon_radius',
			[
				'label' => esc_html__( 'Border Radius', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .single-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .single-icon',
			]
		);

        $this->end_controls_section();

        // box
        $this->start_controls_section(
            'box_content_style',
            [
                'label' => __('Box', 'acea-hp'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'box_alignment',
			[
				'label' => esc_html__( 'Alignment', 'plugin-name' ),
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
				'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .job-meta' => 'justify-content: {{VALUE}};',
                ],
				'toggle' => true,
			]
        );
        $this->add_control(
			'box_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .job-meta' => 'background-color: {{VALUE}}',
				],
			]
		);
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => esc_html__( 'Border', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .job-meta',
			]
		);

        $this->add_control(
			'box_meta_radius',
			[
				'label' => esc_html__( 'Border Radius', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .job-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
       
        $this->add_control(
            'box_padding_gap',
            [
                'label'      => __('Padding', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .job-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-meta' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'box_margin_gap',
            [
                'label'      => __('Margin', 'acea-hp'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .job-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .job-meta' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'label' => __('Shadow', 'fd-addons'),
                'selector' => '{{WRAPPER}} .job-meta',
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        global $post;
        $idd = get_the_ID();
        $categories = get_the_terms(get_the_ID(), 'job-category');
      
        if (!empty($categories)) {
            $job_cat_name = join(' ', wp_list_pluck($categories, 'name'));
        }
        ?>
        <div class="acea-single-job-meta-widget"> 
			  <?php
            foreach ($settings['job_meta_list'] as $selected_meta): ?>
            <div class="job-meta">
            <?php
            if ('category' == $selected_meta['get_meta']) {
                $meta = (!empty($job_cat_name)) ? $job_cat_name : '';
            } 
            else {
                $meta = get_post_meta($idd, $selected_meta['get_meta'], true );
            }
            if (!empty($meta)) { ?>
                <div class="single-icon">
                <?php \Elementor\Icons_Manager::render_icon( $selected_meta['signle_meta_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </div>
                <div class = "single-job-meta-widget">
                    <div class="job-meta-label" >
                        <?php echo $selected_meta['label']; ?>
                    </div>
                    <div class="job-meta-value" >
                        <?php echo $meta; ?>
                    </div>
                </div>
            <?php }
            ?>
            </div>
			<?php endforeach; wp_reset_postdata();?>
		  
        </div>
        <?php
    }
}
$widgets_manager->register_widget_type(new \Acea_Single_Job_Meta());