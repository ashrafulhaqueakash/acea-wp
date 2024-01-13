<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Acea
 */
get_header();
?>
<div id="primary" class="<?php echo esc_attr( acea_content_class() ); ?>">
	<main id="main" class="site-main">
	<?php
	if ( have_posts() ) :
		if ( is_home() && ! is_front_page() ) :
			?>
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>
			<?php
		endif;
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			/*
			* Include the Post-Type-specific template for the content.
			* If you want to override this in a child theme, then include a file
			* called content-___.php (where ___ is the Post Type name) and that will be used instead.
			*/
			get_template_part( 'template-parts/content');
		endwhile;
		echo get_the_posts_pagination();

		// the_post_navigation(
		// 	array(
		// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous post:', 'acea') . '</span> <span class="nav-title">' . ' %title</span>',
		// 		'next_text' => '<span class="nav-subtitle">' . esc_html__('Next post:', 'acea') . '</span> <span class="nav-title">%title ' . '</span>',
		// 	)
		// );
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
