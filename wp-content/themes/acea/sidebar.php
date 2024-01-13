<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Acea
 */
if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
$acea_archive_sidebar      = get_theme_mod( 'acea_archive_sidebar', 'right_sidebar' );
$acea_post_default_sidebar = get_theme_mod( 'acea_default_post_sidebar', 'right_sidebar' );
$acea_page_default_sidebar = get_theme_mod( 'acea_default_page_sidebar', 'right_sidebar' );

if (class_exists('WooCommerce')  && is_product()) {
	if ('no_sidebar' === $product_singlet_sidebar) {
		return;
	}
}elseif ( is_single() ) {
	if ( 'no_sidebar' === $acea_post_default_sidebar ) {
		return;
	}
} elseif ( is_page() ) {
	if ( 'no_sidebar' === $acea_page_default_sidebar ) {
		return;
	}
} elseif (class_exists('WooCommerce')  && is_shop()) {
	if ('no_sidebar' === $acea_product_default_sidebar) {
		return;
	}
} else {
	if ( 'no_sidebar' === $acea_archive_sidebar ) {
		return;
	}
}
?>
<aside id="secondary" class="<?php echo esc_attr( acea_sidebar_class() ); ?>">
<div class="acea-sidebar-wrap">
		<?php
		if (class_exists('WooCommerce')  && (is_shop() || is_product()))
			dynamic_sidebar('product-sidebar');
		else
			dynamic_sidebar('sidebar-1');
		?>
	</div>
</aside><!-- #secondary -->

