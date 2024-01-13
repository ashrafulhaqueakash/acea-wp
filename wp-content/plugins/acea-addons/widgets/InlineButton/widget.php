<?php
namespace Acea\Widgets\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Widget_Base;
use Acea\Elementor\Traits\Acea_Inline_Button_Markup;
class Acea_Inline_Button extends Widget_Base {
	use Acea_Inline_Button_Markup;
    /**
     * Get widget name.
     */
    public function get_name() {
		return 'acea-inline-button';
	}
	/**
	 * Get widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Inline Button', 'acea-addons' );
	}
	/**
     * Get widget icon.
     */
    public function get_icon() {
        return 'eicon-button';
    }
    /**
     * Get widget category.
     */
    public function get_categories() {
		return [ 'acea-addons' ];
	}
	public function get_keywords() {
		return ['link', 'hover', 'animation', 'acea', 'inline'];
	}
	/**
     * Register widget content controls
     */
	protected function register_controls() {
		$this->start_controls_section(
			'_section_title',
			[
				'label' => __( 'Button Content', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
            ]
		);
		$this->add_control(
			'animation_style',
			[
				'label'   => __( 'Animation Style', 'acea-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carpo',
				'options' => [
					'carpo'   => __( 'Carpo', 'acea-addons' ),
					'carme'   => __( 'Carme', 'acea-addons' ),
					'dia'     => __( 'Dia', 'acea-addons' ),
					'eirene'  => __( 'Eirene', 'acea-addons' ),
					'elara'   => __( 'Elara', 'acea-addons' ),
					'ersa'    => __( 'Ersa', 'acea-addons' ),
					'helike'  => __( 'Helike', 'acea-addons' ),
					'herse'   => __( 'Herse', 'acea-addons' ),
					'io'      => __( 'Io', 'acea-addons' ),
					'iocaste' => __( 'Iocaste', 'acea-addons' ),
					'kale'    => __( 'Kale', 'acea-addons' ),
					'leda'    => __( 'Leda', 'acea-addons' ),
					'metis'   => __( 'Metis', 'acea-addons' ),
					'mneme'   => __( 'Mneme', 'acea-addons' ),
					'thebe'   => __( 'Thebe', 'acea-addons' ),
                ],
            ]
		);
		$this->add_control(
			'link_text',
			[
				'label'       => __( 'Title', 'acea-addons' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Inline Button', 'acea-addons' ),
				'placeholder' => __( 'Type Link Title', 'acea-addons' ),
				'dynamic'     => [
					'active' => true,
                ],
            ]
		);
		$this->add_responsive_control(
            'link_align',
            [
                'label' => __( 'Alignment', 'acea-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'acea-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'acea-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'acea-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors_dictionary' => [
                    'left' => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right' => 'justify-content: flex-end',
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea_content__item' => '{{VALUE}}'
                ]
            ]
        );
		$this->add_control(
			'link_url',
			[
				'label'         => __( 'Link', 'acea-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'acea-addons' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => false,
					'nofollow'    => true,
                ],
            ]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'_section_media_style',
			[
				'label' => __( 'Button Content', 'acea-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
            ]
		);
		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => __( 'Content Box Padding', 'acea-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .acea_content__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
		);
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Link Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-link' => 'color: {{VALUE}};',
                ],
            ]
		);
        $this->add_control(
			'title_hover_color',
			[
				'label'     => __( 'Link Hover Color', 'acea-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .acea-link:hover' => 'color: {{VALUE}};',
                ],
            ]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'acea-addons' ),
				'selector' => '{{WRAPPER}} .acea-link',
				'scheme'   => Typography::TYPOGRAPHY_2,
            ]
		);
		$this->end_controls_section();
	}
	protected function render() {
		$settings = $this->get_settings_for_display();
		self::{'render_' . $settings['animation_style'] . '_markup'}( $settings );
	}
}
$widgets_manager->register_widget_type(new \Acea\Widgets\Elementor\Acea_Inline_Button());