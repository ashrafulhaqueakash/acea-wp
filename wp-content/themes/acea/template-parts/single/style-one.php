<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Acea
 */
?>
<article id="post-<?php the_ID(); ?> <?php echo esc_attr(acea_content_class()); ?>">
	<div class="blog-details-page blog-details-style-01">
		<div class="post-thumbnail-section">
			<?php acea_post_thumbnail(); ?>
			<div class="post-top-meta post-category">
				<?php
				$category = get_the_category();
				if ($category[0]) {
					echo '<span><a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a></span>';
				}
				?>
			</div>
		</div>
		<div class="single-post-content-wrap">
			<div class="post-date">
				<?php echo the_date(); ?>
			</div>
			<div class="entry-content clearfix">
				<?php
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'acea'),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						esc_html(get_the_title())
					)
				); ?>
				<?php
				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__('Pages:', 'acea'),
						'after'  => '</div>',
					)
				);
				?>
			</div>
			<footer class="entry-footer">
				<?php acea_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->