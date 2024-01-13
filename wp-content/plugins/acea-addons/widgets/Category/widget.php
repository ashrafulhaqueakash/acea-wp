<?php
namespace Acea_Addons\Widgets;
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;
/**
 * heading widget.
 *
 * widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class Acea_Blog_Category extends Widget_Base {
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
        return 'acea-category';
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
        return __('Acea Blog Category', 'acea-addons');
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
        return 'eicon-product-categories';
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
        return ['blog', 'meta', 'category'];
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
                'label' => __('Content', 'acea-addons'),
            ]
        );
        $this->add_control(
            'category_count',
            [
                'label'       => __('Category Limit', 'acea-addons'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'description' => 'user emty value show all posts',
                'default' => 6,
            ]
        );
        $this->add_responsive_control('per_line', [
            'label'              => __('Columns per row', 'acea-addons'),
            'type'               => Controls_Manager::SELECT,
            'default'            => '3',
            'tablet_default'     => '4',
            'mobile_default'     => '12',
            'options'            => [
                '12' => '1',
                '6'  => '2',
                '4'  => '3',
                '3'  => '4',
            ],
            'frontend_available' => true,
        ]);
        $this->end_controls_section();
        /*
        *Title
        */
        $this->start_controls_section('cate_box_title',
            [
                'label' => __('Category', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_ta_bbutton'
        );
        // normal
        $this->start_controls_tab(
            'cate_normal',
            [
                'label' => __('Normal', 'acea-addons'),
            ]
        );
        $this->add_control(
            'acea_title_color',
            [
                'label'     => __('Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .acea-addons-cat-title' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'acea_title_typo',
                'label'    => __('Typography', 'acea-addons'),
                'selector' => '{{WRAPPER}}   .acea-addons-cat-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'title_border',
                'selector'  => '{{WRAPPER}} .acea-addons-cat-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_box_shadow',
                'exclude'  => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .acea-addons-cat-title',
            ]
        );
        $this->add_responsive_control(
            'title_border_radius',
            [
                'label'      => __('Border Radius', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .acea-addons-cat-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-cat-title' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_title_padding',
            [
                'label'      => __('Padding', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-addons-cat-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .acea-addons-cat-title' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'acea_title_margin',
            [
                'label'      => __('Margin', 'acea-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}}  .acea-addons-cat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .acea-addons-cat-title' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();
        // Hover
        $this->start_controls_tab(
            'cate_hover',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'acea_title_bg_color_hover',
            [
                'label'     => __('Background Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .acea-addons-cat:hover .acea-addons-cat-title' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
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
        $this->add_render_attribute('cat_version', 'class', array('job-categories-wrap row justify-content-center' ));
        //grid class
        $grid_classes = [];
        $grid_classes[] = 'col-lg-' . $settings['per_line'];
        $grid_classes[] = 'col-md-' . $settings['per_line_tablet'];
        $grid_classes[] = 'col-sm-' . $settings['per_line_mobile'];
        $grid_classes = implode(' ', $grid_classes);
        $this->add_render_attribute('cat_grid_classes', 'class', [$grid_classes]);
        $term = get_queried_object();
        $numabr_of_cat = !empty($settings['category_count']) ? $settings['category_count'] : -1;
        $taxonomy     = 'category';
        $orderby      = 'date';
        $show_count   = 1;
        $pad_counts   = 0;
        $hierarchical = 0;
        $title        = '';
        $empty        = 0;
        $args = array(
            'taxonomy'     => $taxonomy,
            'order'        => 'DESC',
            'orderby'      => 'date',
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty,
            'number'       => $numabr_of_cat + 1,
        );
        $all_categories = get_categories($args);
        ?>
        <div <?php echo $this->get_render_attribute_string('cat_version'); ?>>
            <?php
            foreach ($all_categories as $cat) {
                $category_id = $cat->term_id;
                $list = '';
                ?>
                <div <?php echo $this->get_render_attribute_string('cat_grid_classes'); ?>>
                    <a class="acea-addons-cat" href="<?php echo get_term_link($cat->slug, 'category') ?>">
                        <div class="acea-cat-contnt">
                            <h4 class="acea-addons-cat-title"><?php echo $cat->name ?></h4>
                        </div>
                    </a>
                </div>
            <?php
            } ?>
        </div>
        <?php
    }
}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Blog_Category() );