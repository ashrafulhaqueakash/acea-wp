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
	<div class="blog-details-page blog-details-varient blog-details-style-02">
		<div class="post-thumbnail-section">
			<?php acea_post_thumbnail(); ?>
			<div class="post-top-meta post-category">
				<?php
				$category = get_the_category();
				if ( isset ( $category[0] ) ) {
					echo '<span><a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a></span>';
				}
				?>
			</div>
		</div>
		<div class="single-post-content-wrap">
			<div class="post-meta-top">
				<ul>
					<li class="post-date">

						<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M9 5.66667V9L11.5 11.5M16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 4.85786 4.85786 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9Z" stroke="#12141D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
						<?php echo the_date(); ?>
					</li>
					<li class="post-read-time">
						<?php echo display_read_time(); ?>
					</li>
				</ul>
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