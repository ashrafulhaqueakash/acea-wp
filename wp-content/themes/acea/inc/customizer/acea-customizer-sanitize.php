<?php
/**
 * File to sanitize customizer field
 *
 * @package Acea
 * @since 1.0.0
 */

/**
 * Sanitize checkbox value
 *
 * @since 1.0.1
 */
function acea_sanitize_checkbox( $input ) {
    //returns true if checkbox is checked
    return ( ( isset( $input ) && true == $input ) ? true : false );
}


/**
 * Sanitize site layout
 *
 * @since 1.0.0
 */
function acea_sanitize_site_layout( $input ) {
    $valid_keys = array(
        'fullwidth_layout' => esc_html__( 'Fullwidth Layout', 'acea' ),
        'boxed_layout'     => esc_html__( 'Boxed Layout', 'acea' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * switch option (show/hide)
 *
 * @since 1.0.0
 */
function acea_sanitize_switch_option( $input ) {
    $valid_keys = array(
        'show'  => esc_html__( 'Show', 'acea' ),
        'hide'  => esc_html__( 'Hide', 'acea' )
    );
    if ( array_key_exists( $input, $valid_keys ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since acea 1.0.0
 * @see acea_customize_register()
 *
 * @return void
 */
function acea_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since acea 1.0.0
 * @see acea_customize_register()
 *
 * @return void
 */
function acea_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since acea 1.0.0
 * @see acea_footer_settings_register()
 *
 * @return void
 */
function acea_customize_partial_copyright() {
    return get_theme_mod( 'acea_copyright_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since slicko 1.0.0
 * @see slicko_customize_partial_blog_heading()
 *
 * @return void
 */
function acea_customize_partial_blog_heading() {
    return get_theme_mod( 'acea_single_caption_text' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since acea 1.0.0
 * @see acea_design_settings_register()
 *
 * @return void
 */
function acea_customize_partial_related_title() {
    return get_theme_mod( 'acea_related_posts_title' );
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since acea 1.0.0
 * @see acea_design_settings_register()
 *
 * @return void
 */
function acea_customize_partial_archive_more() {
    return get_theme_mod( 'acea_archive_read_more_text' );
}

/**
 * Active callback function for featured post section at top header
 *
 * @since 1.0.0
 */
function acea_featured_posts_active_callback( $control ) {
    if ( $control->manager->get_setting( 'acea_top_featured_option' )->value() == 'show' ) {
        return true;
    } else {
        return false;
    }
}


/**
 * Sanitize select and radio fields
 *
 * @since 1.0.0
 */
function acea_sanitize_select( $input, $setting ) {

    // Ensure input is a slug.
    $input = sanitize_key( $input );
  
    // Get list of choices from the control associated with the setting.
    $choices = $setting->manager->get_control( $setting->id )->choices;
  
    // If the input is a valid key, return it; otherwise, return the default.
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


/**
 * check if related post options enable
 *
 * @since 1.0.0
 */
function acea_is_related_shown( $control ) {
    if ( $control->manager->get_setting('acea_related_posts_option')->value() == 'show' ) {
       return true;
    } else {
       return false;
    }
}
/**
 * check if related post options enable
 *
 * @since 1.0.0
 */
function acea_single_posts_option( $control ) {
    if ( $control->manager->get_setting('acea_single_posts_option')->value() == 'show' ) {
       return true;
    } else {
       return false;
    }
}

/**
 * check if footer widget area options enable
 *
 * @since 1.0.0
 */
function acea_is_footer_shown( $control ) {
    if ( $control->manager->get_setting('acea_footer_widget_option')->value() == 'show' ) {
       return true;
    } else {
       return false;
    }
}

/**
 * Minimal html textarea
 *
 * @since 1.0.0
 */
function acea_minimal_html_senitize( $input ) {

    $allowed_html = array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
    );
    
    return wp_kses($input, $allowed_html);
}

