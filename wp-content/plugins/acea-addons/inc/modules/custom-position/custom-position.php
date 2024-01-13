<?php
namespace MasterAddons\Modules;
use \Elementor\Controls_Manager;
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly.
class Acea_Addons_Positioning {
    /*
     * Instance of this class
     */
    private static $instance = null;
    public function __construct() {
        // Add new controls to advanced tab globally
        add_action("elementor/element/after_section_end", array($this, 'acea_addons_add_position_controls_section'), 10, 3);
    }
    public function acea_addons_add_position_controls_section($widget, $section_id, $args) {
        //Link to sections
        $target_sections = array('section_custom_css');
        if (!defined('ELEMENTOR_PRO_VERSION')) {
            $target_sections[] = 'section_custom_css_pro';
        }
        if (!in_array($section_id, $target_sections)) {
            return;
        }
        // Adds Positioning Options
        $widget->start_controls_section(
            'acea_addons_section_advanced_position',
            array(
                'label' => ACEA_ADDONS_BADGE . __('Positioning', 'acea-addons'),
                'tab'   => Controls_Manager::TAB_ADVANCED,
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_type',
            array(
                'label'       => __('Position Type', 'acea-addons'),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'options'     => array(
                    ''         => __('Default', 'acea-addons'),
                    'static'   => __('Static', 'acea-addons'),
                    'relative' => __('Relative', 'acea-addons'),
                    'absolute' => __('Absolute', 'acea-addons'),
                ),
                'default'     => '',
                'selectors'   => array(
                    '{{WRAPPER}}' => 'position:{{VALUE}};',
                ),
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_top',
            array(
                'label'      => __('Top', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}}' => 'top:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'acea_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_right',
            array(
                'label'        => __('Right', 'acea-addons'),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => array('px', 'em', '%'),
                'range'        => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'    => array(
                    '{{WRAPPER}}' => 'right:{{SIZE}}{{UNIT}};',
                ),
                'condition'    => array(
                    'acea_addons_position_type' => array('relative', 'absolute'),
                ),
                'return_value' => '',
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_bottom',
            array(
                'label'      => __('Bottom', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}}' => 'bottom:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'acea_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_left',
            array(
                'label'      => __('Left', 'acea-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array('px', 'em', '%'),
                'range'      => array(
                    'px' => array(
                        'min'  => -2000,
                        'max'  => 2000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}}' => 'left:{{SIZE}}{{UNIT}};',
                ),
                'condition'  => array(
                    'acea_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_from_center',
            array(
                'label'       => __('From Center', 'acea-addons'),
                'description' => __('Please avoid using "From Center" and "Left" options at the same time.', 'acea-addons'),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => array('px', 'em', '%'),
                'range'       => array(
                    'px' => array(
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ),
                    '%'  => array(
                        'min'  => -100,
                        'max'  => 100,
                        'step' => 1,
                    ),
                    'em' => array(
                        'min'  => -150,
                        'max'  => 150,
                        'step' => 1,
                    ),
                ),
                'selectors'   => array(
                    '{{WRAPPER}}' => 'left:calc( 50% + {{SIZE}}{{UNIT}} );',
                ),
                'condition'   => array(
                    'acea_addons_position_type' => array('relative', 'absolute'),
                ),
            )
        );
        $widget->add_responsive_control(
            'acea_addons_position_zindex',
            array(
                'label'     => __('Z-Index', 'acea-addons'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}}' => 'z-index:{{VALUE}};',
                ),
            )
        );
        $widget->end_controls_section();
    }
    public static function get_instance() {
        if (!self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
Acea_Addons_Positioning::get_instance();