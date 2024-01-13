<?php
// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/* Theme demo data setup */
function acea_import_files() {

    if ( !fdth_tala_check() ) {
        return [];
    }
    $demo_files = get_option( 'fdth_demo_files', [] );

    return $demo_files;
    // return array_merge( acea_import_files_list()['initial'], acea_import_files_list()['landing'], acea_import_files_list()['inner-pages'] );
}
add_filter( 'pt-ocdi/import_files', 'acea_import_files' );

function ocdi_after_import( $selected_import ) {
    // all pages
    $all_pages = get_option( 'fdth_demo_files', [] );

    // if file name equal landing name then set it as front page
    if ( $all_pages ) {

        foreach ( $all_pages as $page ) {
            if ( $page['import_file_name'] == $selected_import['import_file_name'] ) {
                $front_page_id = get_page_by_title( $page['import_file_name'] );

            } elseif ( 'Initial Setup' == $selected_import['import_file_name'] ) {
                $front_page_id = get_page_by_title( 'Point of Sales-POS v2' );

                $blog_page_id = get_page_by_title( 'Blog' );
                update_option( 'page_for_posts', $blog_page_id->ID );

                //Disabling theme setup when it's success..
                update_option( 'coderlift_disable_demo_setup', true );
            }

            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $front_page_id->ID );
        }

    }

    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
    set_theme_mod( 'nav_menu_locations', [
        'main-menu' => $main_menu->term_id, // replace 'main-menu' here with the menu location identifier from register_nav_menu() function
    ] );

    acea_create_demo_menu();
    acea_elementor_settings();

    $elem_clear_cache = new \Elementor\Core\Files\Manager();
    $elem_clear_cache->clear_cache();
}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import' );

function acea_create_demo_menu() {
    $menuname       = 'Main Menu';
    $bpmenulocation = 'main-menu';
    // Does the menu exist already?
    $menu_exists = wp_get_nav_menu_object( $menuname );

    // If it doesn't exist, let's create it.
    if ( !$menu_exists ) {
        $menu_id = wp_create_nav_menu( $menuname );

        // Set up default BuddyPress links and add them to the menu.
        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'   => __( 'Home' ),
            'menu-item-classes' => 'home',
            'menu-item-url'     => home_url( '/' ),
            'menu-item-status'  => 'publish' ) );

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'   => __( 'Blog' ),
            'menu-item-classes' => 'blog',
            'menu-item-url'     => home_url( '/blog/' ),
            'menu-item-status'  => 'publish' ) );

        wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title'   => __( 'Contact Us' ),
            'menu-item-classes' => 'blog',
            'menu-item-url'     => home_url( '/Contact-01/' ),
            'menu-item-status'  => 'publish' ) );

        // Grab the theme locations and assign our newly-created menu
        // to the BuddyPress menu location.
        if ( !has_nav_menu( $bpmenulocation ) ) {
            $locations                  = get_theme_mod( 'nav_menu_locations' );
            $locations[$bpmenulocation] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
        }
    }
}

function ocdi_plugin_page_setup( $default_settings ) {

    $default_settings['parent_slug'] = 'themes.php';
    $default_settings['page_title']  = esc_html__( 'Acea Demo', 'acea' );
    $default_settings['menu_title']  = esc_html__( 'Acea Demo', 'acea' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'acea-demo';

    return $default_settings;
}
// add_filter( 'ocdi/plugin_page_setup', 'ocdi_plugin_page_setup' );

//  coderlift_system_check();
function acea_elementor_settings() {
    $kit_id = get_option( 'elementor_active_kit' );
    // $meta_old = get_post_meta( $kit_id, '_elementor_page_settings' );

    /**
     * To get this json.
     * use this code
     *
     *   var_dump(json_encode($meta_old))
     */

    $settings = json_decode( '[{"system_colors":[{"_id":"primary","title":"Primary","color":"#6EC1E4"},{"_id":"secondary","title":"Secondary","color":"#54595F"},{"_id":"text","title":"Text","color":"#7A7A7A"},{"_id":"accent","title":"Accent","color":"#61CE70"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Roboto","typography_font_weight":"600"},{"_id":"secondary","title":"Secondary","typography_typography":"custom","typography_font_family":"Roboto Slab","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Roboto","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Roboto","typography_font_weight":"500"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Acea","site_description":"Multipurpose Elementor WordPress Theme","space_between_widgets":{"unit":"px","size":0,"sizes":[]},"page_title_selector":"h1.entry-title","viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1320,"sizes":[]},"container_width_tablet":{"unit":"px","size":"","sizes":[]},"container_width_mobile":{"unit":"px","size":"","sizes":[]}},{"system_colors":[{"_id":"primary","title":"Primary","color":"#6EC1E4"},{"_id":"secondary","title":"Secondary","color":"#54595F"},{"_id":"text","title":"Text","color":"#7A7A7A"},{"_id":"accent","title":"Accent","color":"#61CE70"}],"custom_colors":[],"system_typography":[{"_id":"primary","title":"Primary","typography_typography":"custom","typography_font_family":"Roboto","typography_font_weight":"600"},{"_id":"secondary","title":"Secondary","typography_typography":"custom","typography_font_family":"Roboto Slab","typography_font_weight":"400"},{"_id":"text","title":"Text","typography_typography":"custom","typography_font_family":"Roboto","typography_font_weight":"400"},{"_id":"accent","title":"Accent","typography_typography":"custom","typography_font_family":"Roboto","typography_font_weight":"500"}],"custom_typography":[],"default_generic_fonts":"Sans-serif","site_name":"Acea","site_description":"Multipurpose Elementor WordPress Theme","space_between_widgets":{"unit":"px","size":0,"sizes":[]},"page_title_selector":"h1.entry-title","viewport_md":768,"viewport_lg":1025,"container_width":{"unit":"px","size":1320,"sizes":[]},"container_width_tablet":{"unit":"px","size":"","sizes":[]},"container_width_mobile":{"unit":"px","size":"","sizes":[]}}]', true );

    return update_post_meta( $kit_id, '_elementor_page_settings', $settings[0] );
}
