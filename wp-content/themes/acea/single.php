<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acea
 */
get_header();
?>
<div id="primary" class="<?php echo esc_attr(acea_content_class()); ?>">
	<main id="main" class="site-main">
		<?php
		$single_style = get_theme_mod('acea_single_post_from', 'default');
		while (have_posts()) :
			the_post();
			if ('default' === $single_style) {
				get_template_part('template-parts/single/post');
			} else if ('style-one' === $single_style) {
				get_template_part('template-parts/single/style-one');
			} else if ('style-two' === $single_style) {
				get_template_part('template-parts/single/style-two');
			} else if ('style-three' === $single_style) {
				get_template_part('template-parts/single/style-three');
			} else {
				get_template_part('template-parts/single/post');
			}

			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous post:', 'acea') . '</span> <span class="nav-title">' . ' %title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__('Next post:', 'acea') . '</span> <span class="nav-title">%title ' . '</span>',
				)
			);
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;
		endwhile; // End of the loop.
		?>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
