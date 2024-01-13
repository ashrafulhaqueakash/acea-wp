<?php 
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
add_filter( 'manage_acea_header_posts_columns', 'acea_include_exclude_columns' );
add_filter( 'manage_acea_footer_posts_columns', 'acea_include_exclude_columns' );
function acea_include_exclude_columns( $columns ){
    $columns['included_on'] = __( 'Included On' , 'acea-addons');
    $columns['excluded_on'] = __( 'Excluded On', 'acea-addons' );
    return $columns;
}
add_action( 'manage_acea_header_posts_custom_column', 'manage_realestate_posts_custom_colum_meta', 10, 2 );
add_action( 'manage_acea_footer_posts_custom_column', 'manage_realestate_posts_custom_colum_meta', 10, 2 );
function manage_realestate_posts_custom_colum_meta( $column, $post_id ){
    if('included_on' == $column){
        $included_on = get_post_meta( $post_id, 'acea_include_on', true ) ? get_post_meta( $post_id, 'acea_include_on', true ) : '';
        $include_pages = get_post_meta( $post_id, 'acea_include_pages', true ) ? get_post_meta( $post_id, 'acea_include_pages', true ) : [];
        if( $include_pages ) {
                if('entire_website' == $included_on){
                    esc_html_e( 'Entire Website', 'acea-addons' );
                }elseif('archive' == $included_on){
                    esc_html_e( 'Archive', 'acea-addons' );
                }else{
                    $pages = [];
                    foreach($include_pages as $page){
                        $pages[] = get_the_title( $page );
                    }
                    echo implode(', ', $pages);
                }
        }
    }
    if('excluded_on' == $column){
        $excluded_on = get_post_meta( $post_id, 'acea_exclude_on', true ) ? get_post_meta( $post_id, 'acea_exclude_on', true ) : '';
        $exclude_pages = get_post_meta( $post_id, 'acea_exclude_pages', true ) ? get_post_meta( $post_id, 'acea_exclude_pages', true ) : [];
        if('entire_website' == $excluded_on){
            esc_html_e( 'Entire Website', 'acea-addons' );
        }elseif('archive' == $excluded_on){
            esc_html_e( 'Archive', 'acea-addons' );
        }else{
            $pages = [];
            foreach($exclude_pages as $page){
                $pages[] = get_the_title( $page );
            }
            echo implode(', ', $pages);
        }
    }
}