<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Acea
 */
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<section class="error-404 not-found">
			<div class="error-content">
				<h1>404</h1>
				<h2>Page not found</h2>
				<p>We’re sorry, the page you have looked for does not exist in our database! Please go to our home page.</p>
				<a class="btn btn-primary go-home-btn" href="<?php echo get_home_url(); ?>">Go Back Home</a>
			</div>
		</section><!-- .error-404 -->
	</main><!-- #main -->
</div><!-- #primary -->
<?php
get_footer();
