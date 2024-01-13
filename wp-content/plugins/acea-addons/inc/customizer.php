<?php
// Output custom CSS to live site
// add_action('wp_head', array('Acea_Customize', 'header_output'));
function acea_plugin_theme_customizer_options($wp_customize){
    $wp_customize->add_setting( 'acea_dark_logo', array(
        'default' => get_theme_file_uri('assets/image/logo.jpg'), // Add Default Image URL 
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'acea_dark_logo_control', array(
        'label' => 'Upload Logo',
        'priority' => 20,
        'section' => 'title_tagline',
        'settings' => 'acea_dark_logo',
        'button_labels' => array(// All These labels are optional
            'select' => __('Select Image'),
            'change' => __('Change Image'),
            'remove' => __('Remove'),
            'placeholder' => __('No image selected'),
            'frame_title' => __('Select Image'),
            'frame_button' => __('Choose Image'),
        )
    )));
}
add_action( 'customize_register', 'acea_plugin_theme_customizer_options' );
