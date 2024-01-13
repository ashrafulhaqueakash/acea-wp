<?php
namespace Acea_Addons\Widgets;

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

/**
 * Elementor star rating widget.
 *
 * Elementor widget that displays star rating.
 *
 * @since 2.3.0
 */
class Acea_Star_Rating extends \Elementor\Widget_Base{

    /**
     * Get widget name.
     *
     * Retrieve star rating widget name.
     *
     * @since 2.3.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'acea-star-rating';
    }

    /**
     * Get widget title.
     *
     * Retrieve star rating widget title.
     *
     * @since 2.3.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Acea Star Rating', 'acea-addons' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve star rating widget icon.
     *
     * @since 2.3.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-rating';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.3.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['star', 'rating', 'rate', 'review'];
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
    public function get_categories() {
        return ['acea-addons'];
    }

    /**
     * Register star rating widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_rating',
            [
                'label' => esc_html__( 'Rating', 'acea-addons' ),
            ]
        );

        $this->add_control(
            'rating_scale',
            [
                'label'   => esc_html__( 'Rating Scale', 'acea-addons' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '5'  => '0-5',
                    '10' => '0-10',
                ],
                'default' => '5',
            ]
        );

        $this->add_control(
            'rating',
            [
                'label'   => esc_html__( 'Rating', 'acea-addons' ),
                'type'    => \Elementor\Controls_Manager::NUMBER,
                'min'     => 0,
                'max'     => 10,
                'step'    => 0.1,
                'default' => 5,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        // $this->add_control(
        //     'star_style',
        //     [
        //         'label'        => esc_html__( 'Icon', 'acea-addons' ),
        //         'type'         =>  \Elementor\Controls_Manager::SELECT,
        //         'options'      => [
        //             'star_fontawesome' => 'Font Awesome',
        //             'star_unicode'     => 'Unicode',
        //         ],
        //         'default'      => 'star_fontawesome',
        //         'render_type'  => 'template',
        //         'prefix_class' => 'acea--star-style-',
        //         'separator'    => 'before',
        //     ]
        // );

        $this->add_control(
            'unmarked_star_style',
            [
                'label'   => esc_html__( 'Unmarked Style', 'acea-addons' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'solid'   => [
                        'title' => esc_html__( 'Solid', 'acea-addons' ),
                        'icon'  => 'eicon-star',
                    ],
                    'outline' => [
                        'title' => esc_html__( 'Outline', 'acea-addons' ),
                        'icon'  => 'eicon-star-o',
                    ],
                ],
                'default' => 'solid',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'     => esc_html__( 'Title', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'separator' => 'before',
                'dynamic'   => [
                    'active' => true,
                ],
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'        => esc_html__( 'Alignment', 'acea-addons' ),
                'type'         => \Elementor\Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__( 'Center', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__( 'Right', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'acea-addons' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => 'acea-star-rating%s--align-',
                'selectors'    => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label'     => esc_html__( 'Title', 'acea-addons' ),
                'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Text Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-star-rating__title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .acea-star-rating__title',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_shadow',
                'selector' => '{{WRAPPER}} .acea-star-rating__title',
            ]
        );

        $this->add_responsive_control(
            'title_gap',
            [
                'label'     => esc_html__( 'Gap', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}}:not(.acea-star-rating--align-justify) .acea-star-rating__title' => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}}:not(.acea-star-rating--align-justify) .acea-star-rating__title'       => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_stars_style',
            [
                'label' => esc_html__( 'Stars', 'acea-addons' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__( 'Size', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .acea-star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => esc_html__( 'Spacing', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .acea-star-rating i:not(:last-of-type)' => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .acea-star-rating i:not(:last-of-type)'       => 'margin-left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'stars_color',
            [
                'label'     => esc_html__( 'Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-star-rating i:before' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'stars_unmarked_color',
            [
                'label'     => esc_html__( 'Unmarked Color', 'acea-addons' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .acea-star-rating i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * @since 2.3.0
     * @access protected
     */
    protected function get_rating() {
        $settings     = $this->get_settings_for_display();
        $rating_scale = (int) $settings['rating_scale'];
        $rating       = (float) $settings['rating'] > $rating_scale ? $rating_scale : $settings['rating'];

        return [$rating, $rating_scale];
    }

    /**
     * Print the actual stars and calculate their filling.
     *
     * Rating type is float to allow stars-count to be a fraction.
     * Floored-rating type is int, to represent the rounded-down stars count.
     * In the `for` loop, the index type is float to allow comparing with the rating value.
     *
     * @since 2.3.0
     * @access protected
     */
    protected function render_stars( $icon ) {
        $rating_data    = $this->get_rating();
        $rating         = (float) $rating_data[0];
        $floored_rating = floor( $rating );
        $stars_html     = '';

        for ( $stars = 1.0; $stars <= $rating_data[1]; $stars++ ) {
            if ( $stars <= $floored_rating ) {
                $stars_html .= '<i class="acea-star-full">' . $icon . '</i>';
            } elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
                $stars_html .= '<i class="acea-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
            } else {
                $stars_html .= '<i class="acea-star-empty">' . $icon . '</i>';
            }
        }

        return $stars_html;
    }


    /**
     * @since 2.3.0
     * @access protected
     */
    protected function render() {
        $settings       = $this->get_settings_for_display();
        $rating_data    = $this->get_rating();
        $textual_rating = $rating_data[0] . '/' . $rating_data[1];
        $icon           = '&#xE934;';

        if ( 'outline' === $settings['unmarked_star_style'] ) {
            $icon = '&#xE933;';
        }

        $this->add_render_attribute( 'icon_wrapper', [
            'class'     => 'acea-star-rating',
            'title'     => $textual_rating,
            'itemtype'  => 'http://schema.org/Rating',
            'itemscope' => '',
            'itemprop'  => 'reviewRating',
        ] );

    


        $schema_rating = '<span itemprop="ratingValue" class="acea-screen-only">' . $textual_rating . '</span>';
        $schema_rating = '';
        $stars_element = '<div ' . $this->get_render_attribute_string( 'icon_wrapper' ) . '>' . $this->render_stars( $icon ) . ' ' . $schema_rating . '</div>';
        ?>
<style>
    .acea-star-rating{color:#ccd6df;font-family:eicons;display:inline-block}.acea-star-rating i{display:inline-block;position:relative;font-style:normal;cursor:default}.acea-star-rating i:before{content:"\e934";display:block;font-size:inherit;font-family:inherit;position:absolute;overflow:hidden;color:#f0ad4e;top:0;left:0}.acea-star-rating .acea-star-empty:before{content:none}.acea-star-rating .acea-star-1:before{width:10%}.acea-star-rating .acea-star-2:before{width:20%}.acea-star-rating .acea-star-3:before{width:30%}.acea-star-rating .acea-star-4:before{width:40%}.acea-star-rating .acea-star-5:before{width:50%}.acea-star-rating .acea-star-6:before{width:60%}.acea-star-rating .acea-star-7:before{width:70%}.acea-star-rating .acea-star-8:before{width:80%}.acea-star-rating .acea-star-9:before{width:90%}.acea-star-rating__wrapper{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center}.acea-star-rating__title{margin-right:10px}.acea-star-rating--align-right .acea-star-rating__wrapper{text-align:right;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.acea-star-rating--align-left .acea-star-rating__wrapper{text-align:left;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.acea-star-rating--align-center .acea-star-rating__wrapper{text-align:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.acea-star-rating--align-justify .acea-star-rating__title{margin-right:auto}@media (max-width:1024px){.acea-star-rating-tablet--align-right .acea-star-rating__wrapper{text-align:right;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.acea-star-rating-tablet--align-left .acea-star-rating__wrapper{text-align:left;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.acea-star-rating-tablet--align-center .acea-star-rating__wrapper{text-align:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.acea-star-rating-tablet--align-justify .acea-star-rating__title{margin-right:auto}}@media (max-width:767px){.acea-star-rating-mobile--align-right .acea-star-rating__wrapper{text-align:right;-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.acea-star-rating-mobile--align-left .acea-star-rating__wrapper{text-align:left;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.acea-star-rating-mobile--align-center .acea-star-rating__wrapper{text-align:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.acea-star-rating-mobile--align-justify .acea-star-rating__title{margin-right:auto}}.last-star{letter-spacing:0}.acea--star-style-star_unicode .acea-star-rating{font-family:Arial,Helvetica,sans-serif}.acea--star-style-star_unicode .acea-star-rating i:not(.acea-star-empty):before{content:'\\002605'}</style>

</style>
		<div class="acea-star-rating__wrapper">
			<?php if ( !\Elementor\Utils::is_empty( $settings['title'] ) ): ?>
				<div class="acea-star-rating__title"><?php echo esc_html( $settings['title'] ); ?></div>
			<?php endif;
        // PHPCS - $stars_element contains an HTML string that cannot be escaped. ?>
			<?php echo $stars_element; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    ?>
		</div>
		<?php
}

}
$widgets_manager->register_widget_type( new \Acea_Addons\Widgets\Acea_Star_Rating() );
