<?php
/**
* Add custom fields to menu item
*
* This will allow us to play nicely with any other plugin that is adding the same hook
*
* @param  int $item_id 
* @params obj $item - the menu item
* @params array $args
*/
function kia_custom_fields( $item_id, $item ) {
    wp_nonce_field( 'acea_menu_meta_nonce', 'acea_menu_meta_nonce_name' );
    $acea_menu_meta = get_post_meta( $item_id, 'acea_select_megamenu', true );
    $dropdown_args = [
        'post_type'         => 'acea_megamenu',
        'echo'              => 1,
        'show_option_none' => __('Select megamenu', 'acea'),
        'name'              => 'acea_select_megamenu['.$item_id.']',
        'selected'         => $acea_menu_meta,
    ];
    // if ( isset( $_GET['search_in_doc'] ) && 'all' != $_GET['search_in_doc'] ) {
    //     $dropdown_args['selected'] = (int) $_GET['search_in_doc'];
    // }
    ?>
    <div class="field-acea_menu_meta description-wide" style="margin: 5px 0;">
        <span class="description"><?php _e( "Select Megamenu", 'acea' ); ?></span>
        <br />
        <input type="hidden" class="nav-menu-id" value="<?php echo $item_id ;?>" />
        <div class="logged-input-holder">
            <!-- <input type="text" name="acea_menu_meta[<?php echo $item_id ;?>]" id="acea-for-<?php echo $item_id ;?>" value="<?php echo esc_attr( $acea_menu_meta ); ?>" /> -->
            <?php wp_dropdown_pages( $dropdown_args  )  ?>
        </div>
    </div>
    <?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'kia_custom_fields', 10, 2 );
/**
* Save the menu item meta
* 
* @param int $menu_id
* @param int $menu_item_db_id   
*/
function kia_nav_update( $menu_id, $menu_item_db_id ) {
    // Verify this came from our screen and with proper authorization.
    if ( ! isset( $_POST['acea_menu_meta_nonce_name'] ) || ! wp_verify_nonce( $_POST['acea_menu_meta_nonce_name'], 'acea_menu_meta_nonce' ) ) {
        return $menu_id;
    }
    if ( isset( $_POST['acea_select_megamenu'][$menu_item_db_id]  ) ) {
        $sanitized_data = sanitize_text_field( $_POST['acea_select_megamenu'][$menu_item_db_id] );
        update_post_meta( $menu_item_db_id, 'acea_select_megamenu', $sanitized_data );
    } else {
        delete_post_meta( $menu_item_db_id, 'acea_select_megamenu' );
    }
}
add_action( 'wp_update_nav_menu_item', 'kia_nav_update', 10, 2 );
/**
* Displays text on the front-end.
*
* @param string   $title The menu item's title.
* @param WP_Post  $item  The current menu item.
* @return string      
*/
function kia_custom_menu_title( $title, $item ) {
    if( is_object( $item ) && isset( $item->ID ) ) {
        $acea_menu_meta = get_post_meta( $item->ID, '_acea_menu_meta', true );
        if ( ! empty( $acea_menu_meta ) ) {
            $title .= ' - ' . $acea_menu_meta;
        }
    }
    return $title;
}
add_filter( 'nav_menu_item_title', 'kia_custom_menu_title', 10, 2 );