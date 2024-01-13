<?php

use Elementor\Icons_Manager;
$content = ($settings['t_word_limit']['size']) ? wp_trim_words(get_the_content(), $settings['t_word_limit']['size'], '  ') : get_the_content();
?>
<div class="acea--tn-single <?php echo esc_attr( $testimonial_style ); ?>">
    <div class="acea-testimonial-wrapper">
    <div class="acea--tn-dis">
    <p><?php echo esc_html( $content ); ?></p>
    </div>
        <div class="acea-media">
            <?php if(has_post_thumbnail() ): ?>
                <div class="acea--t-thumb">
                    <?php the_post_thumbnail( 'medium' ) ?>  
                </div>
            <?php endif; ?>
            <div class="acea-media-body">
                <div class="acea-overview">
                    <h4 class="acea--tn-name">
                        <?php the_title() ?>
                    </h4>
                    <?php if(function_exists('the_field') ):?>
                    <span class="acea--tn-title">
                        <?php echo get_field('designation') ?>
                    </span>
                    <?php endif; ?>
                </div>										
            </div>
        </div>
    </div>								
</div>