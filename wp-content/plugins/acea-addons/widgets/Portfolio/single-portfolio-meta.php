<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Shade heading widget.
 *
 * Shade widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Acea_Portfolio_Meta extends Widget_Base {

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
		return 'acea-single-pf-meta';
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
		return __( 'Acea Single Portfolio Meta', 'acea-hp' );
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
		return [ 'acea-addons' ];
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
		return [ 'heading', 'title', 'text' ];
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
				'label' => __( 'Content', 'acea-hp' ),
			]
		);


		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label',
			[
				'label' => __( 'Label', 'acea-hp' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'acea-hp' ),
				'default' => __( 'Category Here', 'acea-hp' ),
			]
		);
        $repeater->add_control(
			'get_meta',
			[
				'label' => __( 'Select Meta', 'acea-hp' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'category' => 'Category',
					'client_name' => 'Client Name',
               'duration' => 'Duration',
                    
				],
				'default' => 'category',
			]
		);

		$this->add_control(
			'pf_meta_list',
			[
				'label' => __( 'Meta List', 'acea-hp' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ label }}}',
			]
        );

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'acea-hp' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'acea-hp' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'acea-hp' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'acea-hp' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'acea-hp' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Content', 'acea-hp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => __( 'Label Color', 'acea-hp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pf-meta-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'label' => __('Label Typography', 'acea-hp'),
				'selector' => '{{WRAPPER}} .pf-meta-label',
			]
		);

		$this->add_control(
			'meta_style',
			[
				'label' => __( 'MEta Style', 'acea-hp' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label' => __( 'MEta Color', 'acea-hp' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pf-meta-value' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'meta_typography',
				'label' => __('Meta Typography', 'acea-hp'),
				'selector' => '{{WRAPPER}} .pf-meta-value',
			]
		);

		$this->add_control(
			'gap',
			[
				'label' => __( 'Meta Gap', 'acea-hp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .pf-meta-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_gap',
			[
				'label' => __( 'List Gap', 'acea-hp' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ul.pf-meta li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
        
        $categories = get_the_terms(get_the_ID(), 'portfolio-category');

        if (!empty($categories)) {
              $pf_cat_name = join(',', wp_list_pluck($categories, 'name'));
          }
		
		?>
        <div class="acea-single-pf-meta-widget">
          <ul class="pf-meta">
			  <?php 
			  foreach($settings['pf_meta_list'] as $selected_meta): 
				if (  'category' ==  $selected_meta['get_meta'] ) {
					$meta = (!empty($pf_cat_name)) ? strtok( $pf_cat_name,",") : '';
				}else{
					$meta = get_post_meta( get_the_ID() , $selected_meta['get_meta'], true);

				}

					if(!empty($meta)){
						printf('<li><span class="pf-meta-label">%2$s</span> <span class="pf-meta-value">%1$s</span></li>', $meta, $selected_meta['label']);
					}
				?>
			<?php endforeach; ?>
		  </ul>
        </div>
        <?php
	}
}
$widgets_manager->register_widget_type(new \Acea_Portfolio_Meta());