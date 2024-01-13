<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Acea
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function acea_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( !is_singular() ) {
        $classes[] = 'hfeed';
    }
    // Adds a class of no-sidebar when there is no sidebar present.
    if ( !is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }
    // add a classs when box layout selected.
    $page_layout = get_theme_mod( 'acea_site_layout', 'fullwidth_layout' );
    if ( 'boxed_layout' === $page_layout ) {
        $classes[] = 'box-layout-page';
    }
    return $classes;
}
add_filter( 'body_class', 'acea_body_classes' );
/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function acea_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'acea_pingback_header' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function acea_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar', 'acea' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'acea' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );

    if ( class_exists( 'WooCommerce' ) ):

        register_sidebar(
            array(
                'name'          => esc_html__( 'Products Sidebar', 'acea' ),
                'id'            => 'product-sidebar',
                'description'   => esc_html__( 'Add widgets here.', 'acea' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            )
        );

    endif;

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer Widget Area', 'acea' ),
            'id'            => 'footer-widget-area',
            'description'   => esc_html__( 'Add widgets here.', 'acea' ),
            'before_widget' => '<section id="%1$s" class="acea-footer-widget widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}
add_action( 'widgets_init', 'acea_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function acea_scripts() {
    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'acea-fonts', acea_fonts_url(), array(), null );
    // Add Themify icons, used in the main stylesheet.
    wp_enqueue_style( 'themify-icons', get_template_directory_uri() . '/assets/vendor/themify-icons/themify-icons.css', array(), wp_get_theme()->get( 'Version' ) );
    // Add Fontawesome icons, used in the main stylesheet.
    wp_enqueue_style( 'font-awesome', get_theme_file_uri( '/assets/css/all.min.css' ), array(), '4.7.0' );
    wp_enqueue_style( 'select2', get_theme_file_uri( '/assets/css/select2.min.css' ), array(), true );
    // Add Grid styles files.

    wp_enqueue_style( 'acea-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), wp_get_theme()->get( 'Version' ) );
    // Add Theme styles files.
    // Add Dashicons.
    wp_enqueue_style( 'dashicons' );
    // Add Acea main styles files.
    wp_enqueue_style( 'acea-main', get_template_directory_uri() . '/assets/css/acea-style.css', array(), wp_get_theme()->get( 'Version' ) );
    // Theme stylesheet.
    wp_enqueue_style( 'acea-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_style( 'acea-theme-style', get_template_directory_uri() . '/assets/css/theme-style.css', array(), wp_get_theme()->get( 'Version' ) );
    // Add Acea mairesponsiven styles files.
    wp_enqueue_style( 'acea-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), wp_get_theme()->get( 'Version' ) );

    wp_enqueue_style( 'acea-gutenberg', get_template_directory_uri() . '/assets/css/gutenberg.css', array(), wp_get_theme()->get( 'Version' ) );
    wp_enqueue_script( 'acea-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), wp_get_theme()->get( 'Version' ), true );
    wp_enqueue_script( 'jquery-masonry' );
    wp_enqueue_script( 'select2', get_theme_file_uri( '/assets/js/select2.min.js' ), array( 'jquery' ), null, true );
    wp_enqueue_script( 'acea-config', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    $acea_dynamic_css              = '';
    $acea_header_bg                = get_header_image();
    $acea_header_background        = get_theme_mod( 'header_background_color' );
    $acea_footer_background        = get_theme_mod( 'footer_background_color', '#22304A' );
    $acea_footer_text              = get_theme_mod( 'footer_text_color', '#FFFFFF' );
    $acea_footer_anchor            = get_theme_mod( 'footer_anchor_color', '#666666' );
    $acea_footer_bottom_background = get_theme_mod( 'footer_bottom_background_color', '#22304A' );
    $acea_footer_bottom_text       = get_theme_mod( 'footer_bottom_text_color', '#FFFFFF' );
    $acea_footer_bottom_anchor     = get_theme_mod( 'footer_bottom_anchor_color', '#fc414a' );
    if ( $acea_header_bg ) {
        $acea_dynamic_css .= '.blog-breadcrumb { background: url("' . esc_url( $acea_header_bg ) . '") no-repeat scroll left top rgba(0, 0, 0, 0); position: relative; background-size: cover; }';
        $acea_dynamic_css .= '.blog-breadcrumb::before {
			content: "";
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background: rgba(255,255,255,0.5);
		}';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_header_background ) {
        $acea_dynamic_css .= '.blog-breadcrumb { background-color: ' . esc_attr( $acea_header_background ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_footer_background ) {
        $acea_dynamic_css .= '#colophon { background-color: ' . esc_attr( $acea_footer_background ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_footer_text ) {
        $acea_dynamic_css .= '.acea-footer-widget, .acea-footer-widget li, .acea-footer-widget p, .acea-footer-widget h3, .acea-footer-widget h4 { color: ' . esc_attr( $acea_footer_text ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_footer_anchor ) {
        $acea_dynamic_css .= '.acea-footer-widget a { color: ' . esc_attr( $acea_footer_anchor ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_footer_bottom_background ) {
        $acea_dynamic_css .= '.acea-footer-bottom { background-color: ' . esc_attr( $acea_footer_bottom_background ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_footer_bottom_text ) {
        $acea_dynamic_css .= '.acea-footer-bottom p, .acea-copywright, .acea-copywright li { color: ' . esc_attr( $acea_footer_bottom_text ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    if ( $acea_footer_bottom_anchor ) {
        $acea_dynamic_css .= '.acea-footer-bottom a, .acea-copywright a, .acea-copywright li a { color: ' . esc_attr( $acea_footer_bottom_anchor ) . ' }';
        $acea_dynamic_css .= "\n";
    }
    $acea_dynamic_css = acea_css_strip_whitespace( $acea_dynamic_css );
    wp_add_inline_style( 'acea-style', $acea_dynamic_css );
}
add_action( 'wp_enqueue_scripts', 'acea_scripts', 5 );
//Admin custom css and js
add_action( 'admin_enqueue_scripts', 'cstm_css_and_js' );
function cstm_css_and_js() {
    wp_enqueue_style( 'admin-style', get_template_directory_uri() . '/assets/css/admin.css', array(), wp_get_theme()->get( 'Version' ) );
}
/**
 * Add an extra menu to our nav for our priority+ navigation to use
 *
 * @param object $nav_menu  Nav menu.
 * @param object $args      Nav menu args.
 * @return string More link for hidden menu items.
 */
function acea_add_ellipses_to_nav( $nav_menu, $args ) {
    if ( 'menu-1' === $args->theme_location ):
        $nav_menu .= '<div class="main-menu-more">';
        $nav_menu .= '<ul class="main-menu">';
        $nav_menu .= '<li class="menu-item menu-item-has-children">';
        $nav_menu .= '<button class="submenu-expand main-menu-more-toggle is-empty" tabindex="-1" aria-label="More" aria-haspopup="true" aria-expanded="false">';
        $nav_menu .= '<span class="screen-reader-text">' . esc_html__( 'More', 'acea' ) . '</span>';
        $nav_menu .= '</button>';
        $nav_menu .= '<ul class="sub-menu hidden-links">';
        $nav_menu .= '<li id="menu-item--1" class="mobile-parent-nav-menu-item menu-item--1">';
        $nav_menu .= '<button class="menu-item-link-return">';
        $nav_menu .= esc_html__( 'Back', 'acea' );
        $nav_menu .= '</button>';
        $nav_menu .= '</li>';
        $nav_menu .= '</ul>';
        $nav_menu .= '</li>';
        $nav_menu .= '</ul>';
        $nav_menu .= '</div>';
    endif;
    return $nav_menu;
}
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function acea_css_strip_whitespace( $css ) {
    $replace = array(
        '#/\*.*?\*/#s' => '', // Strip C style comments.
        '#\s\s+#' => ' ', // Strip excess whitespace.
    );
    $search  = array_keys( $replace );
    $css     = preg_replace( $search, $replace, $css );
    $replace = array(
        ': ' => ':',
        '; ' => ';',
        ' {' => '{',
        ' }' => '}',
        ', ' => ',',
        '{ ' => '{',
        ';}' => '}', // Strip optional semicolons.
        ",\n" => ',', // Don't wrap multiple selectors.
        "\n}" => '}', // Don't wrap closing braces.
        '} ' => "}\n", // Put each rule on it's own line.
    );
    $search = array_keys( $replace );
    $css    = str_replace( $search, $replace, $css );
    return trim( $css );
}
if ( !function_exists( 'acea_fonts_url' ) ):
    /**
     * Register Google fonts for Acea.
     *
     * @return string Google fonts URL for the theme.
     * @since 1.0.0
     */
    function acea_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        if ( 'off' !== _x( 'on', 'Inter font: on or off', 'acea' ) ) {
            $fonts[] = 'Inter:300,400,600';
        }

        $fonts = apply_filters( 'acea_google_fonts', $fonts );
        if ( $fonts ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( 'latin' ),
            );
            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }
        return $fonts_url;
    }
endif;
/**
 * Logo wrapper
 *
 * @since 1.0.0
 */
function acea_logo_wrap() {
    ?>
    <a class="acea_logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' );?>" itemprop="url">
        <?php echo acea_logo();
    ?>
    </a>
<?php
}
/**
 * Acea Logo.
 *
 * @return string
 * @since 1.0.0
 */
function acea_logo() {
    if ( get_theme_mod( 'custom_logo' ) ) {
        $logo          = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        $alt_attribute = get_post_meta( get_theme_mod( 'custom_logo' ), '_wp_attachment_image_alt', true );
        if ( empty( $alt_attribute ) ) {
            $alt_attribute = get_bloginfo( 'name' );
        }
        $logo = '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( $alt_attribute ) . '">';
    } else {
        $logo = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
    }
    return $logo;
}
/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function acea_custom_excerpt_length( $length ) {
    if ( is_admin() ) {
        return $length;
    }
    return 40;
}
add_filter( 'excerpt_length', 'acea_custom_excerpt_length', 999 );
/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function acea_excerpt_more( $more ) {
    if ( is_admin() ) {
        return $more;
    }
    return '';
}
add_filter( 'excerpt_more', 'acea_excerpt_more' );
if ( !function_exists( 'acea_related_posts' ) ) {
    /**
     * Single blog post related posts list
     */
    function acea_related_posts( $the_post_id ) {
        // Define shared post arguments.
        $related_args = array(
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'ignore_sticky_posts'    => 1,
            'orderby'                => 'rand',
            'post_type'              => 'post',
            'post__not_in'           => array( $the_post_id ),
            'posts_per_page'         => 3,
        );
        $related_post_type = get_theme_mod( 'acea_related_post_from', 'category' );
        // Related by tags.
        if ( $related_post_type == 'tag' ) {
            $tags = wp_get_post_tags( $the_post_id );
            if ( $tags ) {
                $first_tag               = $tags[0]->term_id;
                $related_args['tag__in'] = array( $first_tag );
            }
        } else {
            // Related by categories.
            $cats = wp_get_post_categories( $the_post_id );
            if ( $cats && isset( $cats[0] ) ) {
                $first_tag                    = ( isset( $cats[0]->term_id ) ) ? $cats[0]->term_id : $cats[0];
                $related_args['category__in'] = array( $first_tag );
            }
        }
        return $related_args;
    }
}
if ( !function_exists( 'acea_set_attributes' ) ) {
    /**
     * Set dynamic attributes
     */
    function acea_set_attributes( $attributes ) {
        if ( !$attributes ) {
            return;
        }
        $set_attr = array();
        foreach ( $attributes as $key => $attr ) {
            $attr       = (array) $attr;
            $attr       = implode( " ", $attr );
            $set_attr[] = "{$key}='{$attr}'";
        }
        return implode( " ", $set_attr );
    }
}
/**
 * wp_body_open callback for backword Compatibility
 */
if ( !function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * acea get archive post type
 *
 */
function acea_get_archive_post_type() {
    $postname = isset( get_queried_object()->name ) ? get_queried_object()->name : '';
    return is_archive() ? $postname : '';
}
function acea_is_edit_mode() {
    return isset( $_GET['elementor-preview'] );
}
function acea_header_settings() {
    if ( defined( 'ELEMENTOR_PRO_VERSION' ) && acea_is_edit_mode() ) {
        return;
    } else {
        $acea              = get_option( 'acea' );
        $check_header_post = get_posts( ['post_type' => 'acea_header'] );
        if ( 0 != count( $check_header_post ) ) {
            printf( '<header class="site-header acea-elementor-header">' );
            acea_header_footer_template_query( 'acea_header' );
            printf( '</header>' );
        } else {
            get_template_part( 'template-parts/headers/header' );
        }
    }
}
/**
 * acea Footer Settings
 *ACEA_VERSION
 */
function acea_footer_settings() {
    if ( defined( 'ELEMENTOR_PRO_VERSION' ) && acea_is_edit_mode() ) {
        return;
    } else {
        $check_footer_post = get_posts( ['post_type' => 'acea_footer'] );
        if ( 0 != count( $check_footer_post ) ) {
            acea_header_footer_template_query( 'acea_footer' );
        } else {
            acea_raw_footer();
        }
    }
}
/**
 * acea Raw Footer
 *
 */
function acea_raw_footer() {
    $date = 'Copyright ' . date( 'Y' ) . ', All Rights Reserved';
    $acea = get_option( 'acea' );
    if ( isset( $acea['footer_copyright'] ) ) {
        echo '<div class="acea-copyright text-center">' . $acea['footer_copyright'] . '</div>';
    } else {
        echo '<div class="acea-copyright text-center">' . esc_html( $date ) . '</div>';
    }
}
/**
 * Acea Footer Query
 *
 */
function acea_header_footer_template_query( $post_type, $post_id = '' ) {
    global $post;
    $current_page_id = isset( $post->ID ) ? $post->ID : false;
    // Query for blog posts
    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => -1,
    );
    if ( empty( $post_id ) ) {
        $argc['p'] = $post_id;
    }
    $footer_query = new WP_Query( $args );
    if ( $footer_query->have_posts() ):
        while ( $footer_query->have_posts() ):
            $footer_query->the_post();
            $include_on = get_post_meta( get_the_ID(), 'acea_include_on', true );
            $exclude_on = get_post_meta( get_the_ID(), 'acea_exclude_on', true );
            $excluded   = false;
            $output     = '';
          
            if ( $exclude_on ) {
                $specific_pages = get_post_meta( get_the_ID(), 'acea_exclude_pages', true ) ? get_post_meta( get_the_ID(), 'acea_exclude_pages', true ) : [];
                if ( 'entire_website' == $exclude_on || in_array( $current_page_id, $specific_pages ) ) {
                    $excluded = true;
                }
            }
            if ( !$excluded && $include_on ) {
                $specific_pages = get_post_meta( get_the_ID(), 'acea_include_pages', true ) ? get_post_meta( get_the_ID(), 'acea_include_pages', true ) : [];

                if ( 'entire_website' == $include_on || in_array( $current_page_id, $specific_pages ) ) {
                    ob_start();
                    the_content();
                    $content = ob_get_clean();
                    $output  = $content;
                }
            }
            
            printf( '%s', $output );
           
        endwhile;
        wp_reset_postdata();
    endif;
}
function acea_get_site_logo( $logo_type = 'dark' ) {
    if ( get_theme_mod( 'custom_logo' ) ) {
        $logo          = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
        $alt_attribute = get_post_meta( get_theme_mod( 'custom_logo' ), '_wp_attachment_image_alt', true );
        if ( empty( $alt_attribute ) ) {
            $alt_attribute = get_bloginfo( 'name' );
        }
        $logo = '<img src="' . esc_url( $logo[0] ) . '" alt="' . esc_attr( $alt_attribute ) . '">';
    } else {
        $logo = '<h2>' . get_bloginfo( 'name' ) . '</h2>';
    }
    return $logo;
}

/*  Reading time  */

function display_read_time() {
    global $post;
    $content     = get_post_field( 'post_content', $post->ID );
    $count_words = str_word_count( strip_tags( $content ) );

    $read_time = ceil( $count_words / 250 );

    $prefix = '<span class="rt-prefix">
    <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M7.16659 3.16667H2.99992C2.07944 3.16667 1.33325 3.91286 1.33325 4.83334V14C1.33325 14.9205 2.07944 15.6667 2.99992 15.6667H12.1666C13.0871 15.6667 13.8333 14.9205 13.8333 14V9.83334M12.6547 1.98816C13.3056 1.33728 14.3609 1.33728 15.0118 1.98816C15.6626 2.63903 15.6626 3.6943 15.0118 4.34518L7.85694 11.5H5.49992L5.49992 9.14298L12.6547 1.98816Z" stroke="#12141D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    </span>';

    if ( $read_time == 1 ) {
        $suffix = '<span class="rt-suffix"> minute read</span>';
    } else {
        $suffix = '<span class="rt-suffix"> minutes read</span>';
    }

    $read_time_output = $prefix . $read_time . $suffix;

    return $read_time_output;
}

/*-rearrange-fields-in-comment-form*/

add_filter( 'comment_form_fields', 'move_comment_field' );
function move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

/*  Preloader  */

function acea_preloader() {
    $preloader = '
    <div class="acea-preloader-wrap">
        <div class="acea-preloader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    ';

    $enabled_preloader = get_theme_mod( 'acea_show_preloader', 'show' );
    if ( 'show' == $enabled_preloader ) {
        printf( $preloader );
    }
}
