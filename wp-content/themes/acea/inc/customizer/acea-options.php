<?php

function acea_options_customize_register( $wp_customize ) {

    // Create our panels

        $wp_customize->add_panel( 'acea_options', array(
            'title' => __( 'Acea Options', 'acea' ),
        ) );

    // Create our sections

        $wp_customize->add_section( 'acea_custom_posts', array(
            'title' => __( 'Control Custom Posts', 'acea' ),
            'panel' => 'acea_options',
        ) );

    // Create our settings


        $wp_customize->add_setting( 'acea_service', array(
            'default'   => 'true',
            'type'      => 'option',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_attr',
        ) );
        $wp_customize->add_control( 'acea_service_control', array(
            'label'    => __( 'Service', 'acea' ),
            'section'  => 'acea_custom_posts',
            'settings' => 'acea_service',
            'type'     => 'checkbox',
        ) );

        $wp_customize->add_setting( 'acea_job', array(
            'default'   => 'true',
            'type'      => 'option',
            'transport' => 'refresh',
            'sanitize_callback' => 'esc_attr',
        ) );
        $wp_customize->add_control( 'acea_job_control', array(
            'label'    => __( 'Job', 'acea' ),
            'section'  => 'acea_custom_posts',
            'settings' => 'acea_job',
            'type'     => 'checkbox',
            'sanitize_callback' => 'esc_attr',
        ) );

        $wp_customize->add_section( 'acea_site_option', array(
            'title' => __( 'General Option', 'acea' ),
            'panel' => 'acea_options',
        ) );

        $wp_customize->add_setting(
            'acea_show_preloader',
            array(
                'default' => 'show',
                'transport'  => 'refresh',
                'sanitize_callback' => 'acea_sanitize_switch_option',
            )
        );

        $wp_customize->add_control(
            new acea_Customize_Switch_Control(
                $wp_customize,
                'acea_show_preloader',
                array(
                    'type'      => 'switch',
                    'label'     => esc_html__('Show Preloader', 'acea'),
                    'description'   => esc_html__('Show/Hide option for Preloader', 'acea'),
                    'section'   => 'acea_site_option',
                    'choices'   => array(
                        'show'  => esc_html__('Show', 'acea'),
                        'hide'  => esc_html__('Hide', 'acea')
                    ),
                    'priority'  => 10,
                )
            )
        );


    }
    add_action( 'customize_register', 'acea_options_customize_register' );


    delete_option( 'acea_testimonial' );

