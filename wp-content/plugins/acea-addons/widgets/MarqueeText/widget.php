<?php

namespace Acea_Addons\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use Elementor\Widget_Base;

/**
 * Coderlift marquee text widget.
 *
 * Coderlift widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class MarqueeText extends Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve marquee text widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'acea-addons-marquee-text';
    }
    /**
     * Get widget text.
     *
     * Retrieve marquee text widget text.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget text.
     */
    public function get_title()
    {
        return __('Marquee Text', 'acea-addons');
    }
    /**
     * Get widget icon.
     *
     * Retrieve marquee text widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-t-letter';
    }
    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the marquee text widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @since 2.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
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
    public function get_keywords()
    {
        return ['marquee text', 'text', 'text'];
    }
    /**
     * Register marquee text widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_text',
            [
                'label' => __('Set Option', 'acea-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'sep_icon',
            [
                'label' => __('Separator Icons', 'acea-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'text',
            [
                'label'       => __('Text', 'acea-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your text', 'acea-addons'),
                'default'     => __('Add Your Marquee Text Here', 'acea-addons'),
            ]
        );
        $this->add_control(
            'marquee_list',
            [
                'label' => esc_html__('Marquee List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => esc_html__('Item content. Click the edit button to change this text.', 'plugin-name'),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );
        $this->end_controls_section();
        /**
         * Style tab
         */
        $this->start_controls_section(
            'icon_style',
            [
                'label' => __('Icon', 'acea-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
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
        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __('Icon Size', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
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
                'desktop_default' => [
                    'size' => '',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon svg' => 'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'acea-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => __('Icon Gap', 'acea-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon svg' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-marquee span.marquee-icon i' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-marquee span.marquee-icon svg' => 'margin: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
                
            ]
        );

        $this->add_responsive_control(
            'width',
            [
                'label' => __('Width', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon' => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
                
            ]
        );
        $this->add_responsive_control(
            'icon_height',
            [
                'label' => __('Height', 'acea-addons'),
                'type' => Controls_Manager::SLIDER,
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
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
                
            ]
        );
        $this->add_control(
            'icon_background',
            [
                'label' => __('Box Background', 'acea-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => ' ',
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon' => 'background-color: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => __('Border', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-addons-marquee span.marquee-icon',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow',
                'label' => __('Shadow', 'acea-addons'),
                'selector' => '{{WRAPPER}} .acea-addons-marquee span.marquee-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'acea-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px','%'],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee span.marquee-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .acea-addons-marquee span.marquee-icon' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
                
            ]
        );
       
        $this->end_controls_tab();
        
        $this->start_controls_tab(
            'icon_style_hover_tab',
            [
                'label' => __('Hover', 'acea-addons'),
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => __('Icon Color', 'acea-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .marquee-single:hover .acea-addons-marquee span.marquee-icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .marquee-single:hover .acea-addons-marquee span.marquee-icon svg' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .marquee-single:hover .acea-addons-marquee span.marquee-icon svg path' => 'fill: {{VALUE}}',
                    
                ],
            ]
        );
        $this->add_control(
            'icon_hover_background',
            [
                'label' => __('Box Background', 'acea-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .marquee-single:hover .acea-addons-marquee span.marquee-icon' => 'background-color: {{VALUE}}'
                ],
                
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_shadow_hover',
                'label' => __('Shadow', 'acea-addons'),
                'selector' => ('{{WRAPPER}} .marquee-single:hover .acea-addons-marquee span.marquee-icon'),
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => __('Title', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label'     => __('Text Color', 'acea-addons'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .acea-addons-marquee',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .acea-addons-marquee',
            ]
        );
        $this->add_control(
            'blend_mode',
            [
                'label'     => __('Blend Mode', 'acea-addons'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => __('Normal', 'acea-addons'),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'difference'  => 'Difference',
                    'exclusion'   => 'Exclusion',
                    'hue'         => 'Hue',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Margin', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .acea-addons-marquee' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    /**
     * Render marquee text widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        if ($settings['marquee_list']) :
            echo '<marquee class="acea-addons-marquee">';
            foreach ($settings['marquee_list'] as $item) {
?>

                <p class="marquee-single">
                    <?php echo  $item['text']; ?>
                    <span class="marquee-icon"><?php \Elementor\Icons_Manager::render_icon($settings['sep_icon'], ['aria-hidden' => 'true']); ?></span>
                </p>
<?php
            }
        endif;
        echo '</marquee>';
    }
}

$widgets_manager->register_widget_type(new \Acea_Addons\Widgets\MarqueeText());
