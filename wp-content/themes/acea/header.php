<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acea
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> style="scroll-behavior: smooth;">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- preloader  -->
<?php
$preload = get_theme_mod( 'acea_show_preloader', 'show' );

if ('show' == $preload ) {
	acea_preloader();
}
?>
<?php
/**
 * acea_before_page hook
 *
 * @since 1.0.0
 */
do_action( 'acea_before_page' );
/**
 * acea_header_top_bar hook
 *
 * @since 1.0.0
 */
do_action( 'acea_header_top_bar' );
/**
 * acea_header_section hook
 *
 * @hooked - acea_header_start - 10
 * @hooked - acea_header_wrap - 20
 * @hooked - acea_header_end - 30
 *
 * @since 1.0.0
 */
do_action( 'acea_header_section' );
/**
 * acea_banner_section hook
 *
 * @hooked - acea_banner_section_start - 10
 * @hooked - acea_banner_title - 20
 * @hooked - acea_banner_section_end - 30
 *
 * @since 1.0.0
 */
do_action( 'acea_banner_section' );
/**
 * acea_content_start hook
 *
 *
 * @since 1.0.0
 */
do_action( 'acea_content_start' );
