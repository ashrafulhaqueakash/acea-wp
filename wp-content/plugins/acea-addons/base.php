<?php

if ( !defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
define( 'ACEA_ADDONS__FILE__', __FILE__ );
define( 'ACEA_ADDONS_DIR_PATH', plugin_dir_path( ACEA_ADDONS__FILE__ ) );
define( 'ACEA_ADDONS_ASSETS', plugins_url( 'assets/', __FILE__ ) );
final class Acea_Extension {
    const VERSION                   = '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '2.6.0';
    const MINIMUM_PHP_VERSION       = '5.6';
    private static $_instance       = null;
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct() {
        add_action( 'init', [$this, 'i18n'] );
        add_action( 'plugins_loaded', [$this, 'init'] );
        //Defined Constants
        if ( !defined( 'ACEA_ADDONS_BADGE' ) ) {
            define( 'ACEA_ADDONS_BADGE', '<span class="acea-addons-badge"></span>' );
        }
    }
    public function i18n() {
        load_plugin_textdomain( 'acea-addons' );
    }
    public function init() {
        // Check if Elementor installed and activated
        if ( !did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_missing_main_plugin'] );
            return;
        }
        // Check for required Elementor version
        if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_elementor_version'] );
            return;
        }
        // Check for required PHP version
        if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
            add_action( 'admin_notices', [$this, 'admin_notice_minimum_php_version'] );
            return;
        }
        add_action( 'elementor/widgets/widgets_registered', [$this, 'init_widgets'] );
        add_action( 'elementor/elements/categories_registered', [$this, 'register_new_category'] );
        add_action( 'elementor/editor/after_enqueue_scripts', [$this, 'acea_editor_scripts_js'], 100 );
        add_action( 'elementor/frontend/before_register_scripts', [$this, 'acea_register_frontend_scripts'] );
        new AceaAddons\Includes\Acea_Addons_Cross_CP();
    }
    /**
     * Load Frontend Script
     *
     */
    public function acea_register_frontend_scripts() {
        wp_enqueue_style(
            'acea-xdlocalstorage-style',
            ACEA_ASSETS_PUBLIC . '/css/editor-style.css',
            null,
            ACEA_VERSION
        );
        // css enqueue
        // wp_enqueue_style(
        //     'acea-nice-select',
        //     ACEA_ASSETS_PUBLIC . '/css/nice-select.min.css',
        //     null,
        //     ACEA_VERSION
        // );
        wp_enqueue_style(
            'acea-addons-elementor-animations',
            ACEA_ASSETS_PUBLIC . '/css/animate.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'acea-addons-style',
            ACEA_ASSETS_PUBLIC . '/css/widget-style.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'acea-core-style',
            ACEA_ASSETS_PUBLIC . '/css/core.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'acea-creative-button-style',
            ACEA_ASSETS_PUBLIC . '/css/creative-button.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'acea-inline-button-style',
            ACEA_ASSETS_PUBLIC . '/css/inline-button.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'slick-slider-style',
            ACEA_ASSETS_PUBLIC . '/css/slick.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'swiper-slider-style',
            ACEA_ASSETS_PUBLIC . '/css/swiper-bundle.min.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_style(
            'acea-custom-fonts-style',
            ACEA_ASSETS_PUBLIC . '/css/custom-fonts.css',
            null,
            ACEA_VERSION
        );
        // Js enqueue
        // wp_enqueue_script(
        //     'acea-nice-select',
        //     ACEA_ASSETS_PUBLIC . '/js/jquery.nice-select.min.js',
        //     ['jquery'],
        //     ACEA_VERSION,
        //     true
        // );
        wp_enqueue_script(
            'slick-slider',
            ACEA_ASSETS_PUBLIC . '/js/slick.min.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'swiper-slider',
            ACEA_ASSETS_PUBLIC . '/js/swiper-bundle.min.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'isotope',
            ACEA_ASSETS_PUBLIC . '/js/isotope.pkgd.min.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'packery',
            ACEA_ASSETS_PUBLIC . '/js/packery-mode.pkgd.min.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'imagesloaded',
            ACEA_ASSETS_PUBLIC . '/js/imagesloaded.pkgd.min.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'acea-unfold',
            ACEA_ASSETS_PUBLIC . '/js/unfold.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'typed',
            ACEA_ASSETS_PUBLIC . '/js/typed.min.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'acea-xdlocalstorage-js',
            ACEA_ASSETS_PUBLIC . '/js/xdlocalstorage.js',
            null,
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'acea-cross-cp',
            ACEA_ASSETS_PUBLIC . '/js/acea-cross-cp.js',
            array( 'jquery', 'elementor-editor', 'acea-xdlocalstorage-js' ),
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'acea-widget',
            ACEA_ASSETS_PUBLIC . '/js/widget.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        global $post;
        wp_localize_script(
            'acea-copy-front-end',
            'aceacopy',
            [
                'storagekey' => md5( 'LICENSE KEY' ),
                'ajax_url'   => admin_url( 'admin-ajax.php' ),
                'nonce'      => wp_create_nonce( 'get_section_data' ),
                'post_id'    => $post->ID,
            ]
        );
    }
    public function acea_editor_scripts_js() {
        wp_enqueue_style(
            'acea-addons-styles-editor',
            ACEA_ASSETS_PUBLIC . '/css/editor.css',
            null,
            ACEA_VERSION
        );
        wp_enqueue_script(
            'acea-addons-editor',
            ACEA_ASSETS_PUBLIC . '/js/editor.js',
            ['jquery'],
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'acea-xdlocalstorage-js',
            ACEA_ASSETS_PUBLIC . '/js/xdlocalstorage.js',
            null,
            ACEA_VERSION,
            true
        );
        wp_enqueue_script(
            'acea-cross-cp',
            ACEA_ASSETS_PUBLIC . '/js/acea-cross-cp.js',
            array( 'jquery', 'elementor-editor', 'acea-xdlocalstorage-js' ),
            ACEA_VERSION,
            true
        );
        wp_localize_script(
            'jquery',
            'acea_cross_cp',
            array(
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'acea_cross_cp_import' ),
            )
        );
    }
    /**
     * Widgets Catgory
     *
     */
    public function register_new_category( $manager ) {
        $manager->add_category(
            'acea-addons',
            [
                'title' => __( 'Acea Theme Helper Addons', 'acea' ),
            ]
        );
    }
    public function admin_notice_minimum_php_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'acea' ),
            '<strong>' . esc_html__( 'Elementor Pawelements Extension', 'acea' ) . '</strong>',
            '<strong>' . esc_html__( 'PHP', 'acea' ) . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
    public function admin_notice_missing_main_plugin() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'acea' ),
            '<strong>' . esc_html__( 'Elementor Acea Extension', 'acea' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'acea' ) . '</strong>'
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
    public function admin_notice_minimum_elementor_version() {
        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }

        $message = sprintf(
            /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
            esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'acea' ),
            '<strong>' . esc_html__( 'Elementor Acea Extension', 'acea' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'acea' ) . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
    public function init_widgets() {
        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
        /*
         * Widget Include
         */
        require_once ACEA_WIDGET_DIR . 'Count-Down/count-down.php';
        require_once ACEA_WIDGET_DIR . 'Menu/widget.php';
        require_once ACEA_WIDGET_DIR . 'Breadcrumbs/widget.php';
        require_once ACEA_WIDGET_DIR . 'Course/widget.php';
        require_once ACEA_WIDGET_DIR . 'DualHeading/widget.php';
        require_once ACEA_WIDGET_DIR . 'DualButton/widget.php';
        require_once ACEA_WIDGET_DIR . 'CreativeButton/widget.php';
        require_once ACEA_WIDGET_DIR . 'Icon-Box/widget.php';
        require_once ACEA_WIDGET_DIR . 'Feature-Box/widget.php';
        require_once ACEA_WIDGET_DIR . 'InlineButton/widget.php';
        require_once ACEA_WIDGET_DIR . 'Videos/widget.php';
        require_once ACEA_WIDGET_DIR . 'Testimonial/widget.php';
        require_once ACEA_WIDGET_DIR . 'Testimonial-v2/widget.php';
        // require_once ACEA_WIDGET_DIR . 'TestimonialV2/widget.php';
        require_once ACEA_WIDGET_DIR . 'PricingBox/widget.php';
        require_once ACEA_WIDGET_DIR . 'Contact Form 7/widget.php';
        require_once ACEA_WIDGET_DIR . 'ModalPopup/widget.php';
        require_once ACEA_WIDGET_DIR . 'Site-logo/widget.php';
        require_once ACEA_WIDGET_DIR . 'Category/widget.php';
        require_once ACEA_WIDGET_DIR . 'Blog Post/widget.php';
        require_once ACEA_WIDGET_DIR . 'TeamMember/widget.php';
        require_once ACEA_WIDGET_DIR . 'Tab/widget.php';
        require_once ACEA_WIDGET_DIR . 'Services/services.php';
        require_once ACEA_WIDGET_DIR . 'AniamteText/widget.php';
        require_once ACEA_WIDGET_DIR . 'MarqueeText/widget.php';
        require_once ACEA_WIDGET_DIR . 'PriceTable/widget.php';
        require_once ACEA_WIDGET_DIR . 'PriceTableV2/widget.php';
        require_once ACEA_WIDGET_DIR . 'Reviews/widget.php';
        require_once ACEA_WIDGET_DIR . 'Advance-Tab/widget.php';
        require_once ACEA_WIDGET_DIR . 'Card/widget.php';
        require_once ACEA_WIDGET_DIR . 'Job/job.php';
        require_once ACEA_WIDGET_DIR . 'Job/job-single-meta.php';
        require_once ACEA_WIDGET_DIR . 'Post-Title/widget.php';
        require_once ACEA_WIDGET_DIR . 'Feature-image/widget.php';
        require_once ACEA_WIDGET_DIR . 'Image-Card/widget.php';
        require_once ACEA_WIDGET_DIR . 'SignIn/widget.php';
        require_once ACEA_WIDGET_DIR . 'SignUp/widget.php';
        require_once ACEA_WIDGET_DIR . 'Portfolio/portfolio.php';
        require_once ACEA_WIDGET_DIR . 'Portfolio/single-portfolio-meta.php';
        require_once ACEA_WIDGET_DIR . 'Portfolio/portfolio-gallery.php';
        require_once ACEA_WIDGET_DIR . 'ResetPassword/widget.php';
        require_once ACEA_WIDGET_DIR . 'Project/widget.php';
        require_once ACEA_WIDGET_DIR . 'Star-Ratting/widget.php';
        require_once ACEA_WIDGET_DIR . 'woocommerce/top-right-meta.php';
        require_once __DIR__ . '/inc/modules/custom-css/custom-css.php';
        require_once __DIR__ . '/inc/modules/extras/extras.php';
        require_once __DIR__ . '/inc/modules/custom-position/custom-position.php';
        require_once __DIR__ . '/inc/modules/css-transform/css-transform.php';
        require_once __DIR__ . '/inc/modules/floting-effect/floting-effect.php';
    }
}
Acea_Extension::instance();
/**
 * Add Font Group
 */
add_filter( 'elementor/fonts/groups', function ( $font_groups ) {
    $font_groups['acea_fonts'] = __( 'Acea Custom Fonts' );
    return $font_groups;
} );
add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
    $additional_fonts['Function'] = 'acea_fonts';
    return $additional_fonts;
} );
