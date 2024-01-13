<?php



/**

 * Acea Page layout for archive/single/blog, page and single blog post

 *

 * @package Acea

 * @since 1.0.0

 */



add_action('customize_register', 'acea_design_settings_register');



function acea_design_settings_register($wp_customize)

{



    // Register the radio image control class as a JS control type.

    $wp_customize->register_control_type('Acea_Customize_Control_Radio_Image');



    /**

     * Add Layout Settings Panel

     *

     * @since 1.0.0

     */

    $wp_customize->add_panel(

        'acea_layout_settings_panel',

        array(

            'priority'       => 25,

            'capability'     => 'edit_theme_options',

            'theme_supports' => '',

            'title'          => esc_html__('Layout Settings', 'acea'),

        )

    );



    /**

     * Archive Settings

     *

     * @since 1.0.0

     */

    $wp_customize->add_section(

        'acea_archive_settings_section',

        array(

            'title'     => esc_html__('Archive/Blog Settings', 'acea'),

            'panel'     => 'acea_layout_settings_panel',

            'priority'  => 5,

        )

    );



    /**

     * Image Radio field for archive sidebar

     *

     * @since 1.0.0

     */

    $wp_customize->add_setting(

        'acea_archive_sidebar',

        array(

            'default'           => 'right_sidebar',

            'sanitize_callback' => 'acea_sanitize_select',

        )

    );

    $wp_customize->add_control(

        new Acea_Customize_Control_Radio_Image(

            $wp_customize,

            'acea_archive_sidebar',

            array(

                'label'    => esc_html__('Archive Sidebars', 'acea'),

                'description' => esc_html__('Choose sidebar from available layouts', 'acea'),

                'section'  => 'acea_archive_settings_section',

                'choices'  => array(

                    'left_sidebar' => array(

                        'label' => esc_html__('Left Sidebar', 'acea'),

                        'url'   => '%s/assets/images/left-sidebars.png'

                    ),

                    'right_sidebar' => array(

                        'label' => esc_html__('Right Sidebar', 'acea'),

                        'url'   => '%s/assets/images/right-sidebars.png'

                    ),

                    'no_sidebar' => array(

                        'label' => esc_html__('No Sidebar', 'acea'),

                        'url'   => '%s/assets/images/three-column.png'

                    )

                ),

                'priority' => 5

            )

        )

    );



    /**

     * Text field for archive read more

     *

     * @since 1.0.0

     */

    $wp_customize->add_setting(

        'acea_archive_read_more_text',

        array(

            'default'      => esc_html__('Read More', 'acea'),

            'transport'    => 'postMessage',

            'sanitize_callback' => 'sanitize_text_field'

        )

    );

    $wp_customize->add_control(

        'acea_archive_read_more_text',

        array(

            'type'          => 'text',

            'label'            => esc_html__('Read More Text', 'acea'),

            'description'      => esc_html__('Enter read more button text for archive page.', 'acea'),

            'section'       => 'acea_archive_settings_section',

            'priority'      => 15

        )

    );

    $wp_customize->selective_refresh->add_partial(

        'acea_archive_read_more_text',

        array(

            'selector' => '.entry-footer > a.acea-icon-btn',

            'render_callback' => 'acea_customize_partial_archive_more',

        )

    );



    /**

     * Page Settings

     *

     * @since 1.0.0

     */

    $wp_customize->add_section(

        'acea_page_settings_section',

        array(

            'title'     => esc_html__('Page Settings', 'acea'),

            'panel'     => 'acea_layout_settings_panel',

            'priority'  => 10,

        )

    );



    /**

     * Image Radio for page sidebar

     *

     * @since 1.0.0

     */

    $wp_customize->add_setting(

        'acea_default_page_sidebar',

        array(

            'default'           => 'right_sidebar',

            'sanitize_callback' => 'acea_sanitize_select',

        )

    );

    $wp_customize->add_control(

        new Acea_Customize_Control_Radio_Image(

            $wp_customize,

            'acea_default_page_sidebar',

            array(

                'label'    => esc_html__('Page Sidebars', 'acea'),

                'description' => esc_html__('Choose sidebar from available layouts', 'acea'),

                'section'  => 'acea_page_settings_section',

                'choices'  => array(

                    'left_sidebar' => array(

                        'label' => esc_html__('Left Sidebar', 'acea'),

                        'url'   => '%s/assets/images/page-left-sidebar.png'

                    ),

                    'right_sidebar' => array(

                        'label' => esc_html__('Right Sidebar', 'acea'),

                        'url'   => '%s/assets/images/page-right-sidebar.png'

                    ),

                    'no_sidebar' => array(

                        'label' => esc_html__('No Sidebar', 'acea'),

                        'url'   => '%s/assets/images/full-content.png'

                    )

                ),

                'priority' => 5

            )

        )

    );



    /**

     * Post Settings

     *

     * @since 1.0.0

     */

    $wp_customize->add_section(

        'acea_post_settings_section',

        array(

            'title'     => esc_html__('Single Post Settings', 'acea'),

            'panel'     => 'acea_layout_settings_panel',

            'priority'  => 15,

        )

    );



    $wp_customize->add_setting(

        'acea_single_post_from',

        array(

            'transport'  => 'refresh',

            'sanitize_callback' => 'acea_sanitize_select',

            'default' => 'default',

        )

    );



    $wp_customize->add_control(

        'acea_single_post_from',

        array(

            'type' => 'select',

            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.

            'section' => 'acea_post_settings_section', // Add a default or your own section

            'label'     => esc_html__('Select Single Post Style', 'acea'),

            'active_callback' => 'acea_is_related_shown',

            'description' => esc_html__('which style do you want to show the single post', 'acea'),

            'choices' => array(

                'style-one' => esc_html__('Style One', 'acea'),

                'style-two' => esc_html__('Style Two', 'acea'),

                'style-three' => esc_html__('Style Three', 'acea'),

                'default' => esc_html__('Default Style', 'acea'),

            ),

            'priority' => 5

        )

    );



    /**

     * Image Radio for post sidebar

     *

     * @since 1.0.0

     */

    $wp_customize->add_setting(

        'acea_default_post_sidebar',

        array(

            'default'           => 'right_sidebar',

            'sanitize_callback' => 'acea_sanitize_select',

        )

    );

    $wp_customize->add_control(

        new Acea_Customize_Control_Radio_Image(

            $wp_customize,

            'acea_default_post_sidebar',

            array(

                'label'    => esc_html__('Post Sidebars', 'acea'),

                'description' => esc_html__('Choose sidebar from available layouts', 'acea'),

                'section'  => 'acea_post_settings_section',

                'choices'  => array(

                    'left_sidebar' => array(

                        'label' => esc_html__('Left Sidebar', 'acea'),

                        'url'   => '%s/assets/images/page-left-sidebar.png'

                    ),

                    'right_sidebar' => array(

                        'label' => esc_html__('Right Sidebar', 'acea'),

                        'url'   => '%s/assets/images/page-right-sidebar.png'

                    ),

                    'no_sidebar' => array(

                        'label' => esc_html__('No Sidebar', 'acea'),

                        'url'   => '%s/assets/images/full-content.png'

                    )

                ),

                'priority' => 5

            )

        )

    );



    /**

     * Switch option for Related posts

     *

     * @since 1.0.0

     */

    $wp_customize->add_setting(

        'acea_related_posts_option',

        array(

            'default' => 'show',

            'transport'  => 'refresh',

            'sanitize_callback' => 'acea_sanitize_switch_option',

        )

    );

    $wp_customize->add_control(

        new acea_Customize_Switch_Control(

            $wp_customize,

            'acea_related_posts_option',

            array(

                'type'      => 'switch',

                'label'     => esc_html__('Related Post Option', 'acea'),

                'description'   => esc_html__('Show/Hide option for related posts section at single post page.', 'acea'),

                'section'   => 'acea_post_settings_section',

                'choices'   => array(

                    'show'  => esc_html__('Show', 'acea'),

                    'hide'  => esc_html__('Hide', 'acea')

                ),

                'priority'  => 10,

            )

        )

    );



    /**

     * Text field for related post section title

     *

     * @since 1.0.0

     */

    $wp_customize->add_setting(

        'acea_related_posts_title',

        array(

            'default'    => esc_html__('Related Posts', 'acea'),

            'transport'  => 'postMessage',

            'sanitize_callback' => 'sanitize_text_field'

        )

    );

    $wp_customize->add_control(

        'acea_related_posts_title',

        array(

            'type'      => 'text',

            'label'     => esc_html__('Related Post Section Title', 'acea'),

            'section'   => 'acea_post_settings_section',

            'active_callback' => 'acea_is_related_shown',

        )

    );

    $wp_customize->selective_refresh->add_partial(

        'acea_related_posts_title',

        array(

            'selector' => 'h2.acea-related-title',

            'render_callback' => 'acea_customize_partial_related_title',

        )

    );



    $wp_customize->add_setting(

        'acea_related_post_from',

        array(

            'transport'  => 'refresh',

            'sanitize_callback' => 'acea_sanitize_select',

            'default' => 'category',

        )

    );



    $wp_customize->add_control(

        'acea_related_post_from',

        array(

            'type' => 'select',

            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.

            'section' => 'acea_post_settings_section', // Add a default or your own section

            'label'     => esc_html__('Select Related Post Type', 'acea'),

            'active_callback' => 'acea_is_related_shown',

            'description' => esc_html__('Select whish taxonomy you want to fetch related post', 'acea'),

            'choices' => array(

                'category' => esc_html__('Category', 'acea'),

                'tag' => esc_html__('Tag', 'acea'),

            ),

        )

    );



    $wp_customize->add_setting(

        'acea_single_comment_from',

        array(

            'transport'  => 'refresh',

            'sanitize_callback' => 'acea_sanitize_select',

            'default' => 'style-one',

        )

    );



    $wp_customize->add_control(

        'acea_single_comment_from',

        array(

            'type' => 'select',

            'capability' => 'edit_theme_options', //Optional. Special permissions for accessing this setting.

            'section' => 'acea_post_settings_section', // Add a default or your own section

            'label'     => esc_html__('Select Comment Style', 'acea'),

            'active_callback' => 'acea_is_related_shown',

            'description' => esc_html__('which style do you want to show the single post', 'acea'),

            'choices' => array(

                'style-one' => esc_html__('Style One', 'acea'),

                'style-two' => esc_html__('Style Two', 'acea'),

            ),

            'priority' => 20

        )

    );


    if ( class_exists( 'WooCommerce' ) ) :

        /**
         * Product Settings
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'acea_product_settings_section',
            array(
                'title'     => esc_html__( 'Product Page Settings', 'acea' ),
                'panel'     => 'acea_layout_settings_panel',
                'priority'  => 20,
            )
        );

        /**
         * Image Radio for page sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'acea_product_page_sidebar',
            array(
                'default'           => 'right_sidebar',
                'sanitize_callback' => 'acea_sanitize_select',
            )
        );
        $wp_customize->add_control( new acea_Customize_Control_Radio_Image(
            $wp_customize,
            'acea_product_page_sidebar',
                array(
                    'label'    => esc_html__( 'Product Page Sidebars', 'acea' ),
                    'description' => esc_html__( 'Choose sidebar from available layouts', 'acea' ),
                    'section'  => 'acea_product_settings_section',
                    'choices'  => array(
                            'left_sidebar' => array(
                                'label' => esc_html__( 'Left Sidebar', 'acea' ),
                                'url'   => '%s/assets/images/left-sidebars.png'
                            ),
                            'right_sidebar' => array(
                                'label' => esc_html__( 'Right Sidebar', 'acea' ),
                                'url'   => '%s/assets/images/right-sidebars.png'
                            ),
                            'no_sidebar' => array(
                                'label' => esc_html__( 'No Sidebar', 'acea' ),
                                'url'   => '%s/assets/images/full-content.png'
                            )
                    ),
                    'priority' => 5
                )
            )
        );

        /**
         * Single Product Settings
         *
         * @since 1.0.0
         */
        $wp_customize->add_section(
            'acea_single_product_settings_section',
            array(
                'title'     => esc_html__( 'Single Product Settings', 'acea' ),
                'panel'     => 'acea_layout_settings_panel',
                'priority'  => 25,
            )
        );

        /**
         * Image Radio for post sidebar
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'acea_single_product_sidebar',
            array(
                'default'           => 'right_sidebar',
                'sanitize_callback' => 'acea_sanitize_select',
            )
        );
        $wp_customize->add_control( new acea_Customize_Control_Radio_Image(
            $wp_customize,
            'acea_single_product_sidebar',
                array(
                    'label'    => esc_html__( 'Single Product Sidebars', 'acea' ),
                    'description' => esc_html__( 'Choose sidebar from available layouts', 'acea' ),
                    'section'  => 'acea_single_product_settings_section',
                    'choices'  => array(
                            'left_sidebar' => array(
                                'label' => esc_html__( 'Left Sidebar', 'acea' ),
                                'url'   => '%s/assets/images/left-sidebars.png'
                            ),
                            'right_sidebar' => array(
                                'label' => esc_html__( 'Right Sidebar', 'acea' ),
                                'url'   => '%s/assets/images/right-sidebars.png'
                            ),
                            'no_sidebar' => array(
                                'label' => esc_html__( 'No Sidebar', 'acea' ),
                                'url'   => '%s/assets/images/full-content.png'
                            )
                    ),
                    'priority' => 5
                )
            )
        );

        /**
         * Switch option for Related posts
         *
         * @since 1.0.0
         */
        $wp_customize->add_setting(
            'acea_related_product_option',
            array(
                'default' => 'show',
                'transport'  => 'refresh',
                'sanitize_callback' => 'acea_sanitize_switch_option',
            )
        );
        $wp_customize->add_control( new acea_Customize_Switch_Control(
            $wp_customize,
                'acea_related_product_option',
                array(
                    'type'      => 'switch',
                    'label'     => esc_html__( 'Related Product Option', 'acea' ),
                    'description'   => esc_html__( 'Show/Hide option for related product section at single product page.', 'acea' ),
                    'section'   => 'acea_single_product_settings_section',
                    'choices'   => array(
                        'show'  => esc_html__( 'Show', 'acea' ),
                        'hide'  => esc_html__( 'Hide', 'acea' )
                    ),
                    'priority'  => 10,
                )
            )
        );


        endif; // if woocommerce available



} // Layout panel closed