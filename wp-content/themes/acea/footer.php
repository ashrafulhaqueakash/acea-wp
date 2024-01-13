<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acea
 */
?>
<?php
/**
 * acea_content_end hook
 *
 * @since 1.0.0
 */
do_action( 'acea_content_end' );
/**
 * acea_footer_before hook
 *
 * @since 1.0.0
 */
do_action( 'acea_footer_before' );
$acea_footer_layout = get_theme_mod( 'acea_footer_widget_option', 'show' );
if ( 'show' === $acea_footer_layout ) :
	/**
	 * acea_footer_section hook
	 *
	 * @since 1.0.0
	 */
	do_action( 'acea_footer_section' );
endif;
/**
 * acea_footer_bottom hook
 *
 * @since 1.0.0
 */
do_action( 'acea_footer_bottom' );
/**
 * acea_footer_after hook
 *
 * @since 1.0.0
 */
do_action( 'acea_footer_after' );
/**
 * acea_after_page
 * 
 * @since 1.0.0
 */
do_action( 'acea_after_page' );
wp_footer(); ?>
</body>
</html>
