<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package fastland
 */
get_header();
?>
<div class="archive-service-wrapper">
    <div class="container">
        <div class="row blog-content-row">

            <?php
                while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/content/content-service');
                        ?>
                <?php
            endwhile; // End of the loop.
            ?>
            </div>
        </div>
    </div>
<?php
get_footer(); ?>


