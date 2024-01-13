<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Acea
 */
get_header();
?>
<div id="primary" class="<?php echo esc_attr(acea_content_class()); ?>">
	<main id="main" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<?php
					while (have_posts()) :
						the_post();
					?>

						<?php get_template_part('template-parts/content', get_post_type()); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if (comments_open() || get_comments_number()) :
							comments_template();
						endif;
					endwhile; // End of the loop.
					?>
				</div>
			</div><!-- #row -->
		</div>
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
