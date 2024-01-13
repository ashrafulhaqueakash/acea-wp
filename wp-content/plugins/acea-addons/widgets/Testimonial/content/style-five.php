<?php

use Elementor\Icons_Manager;
$content = ($settings['t_word_limit']['size']) ? wp_trim_words(get_the_content(), $settings['t_word_limit']['size'], '  ') : get_the_content();
?>

<div class="acea--tn-single <?php echo esc_attr( $testimonial_style ); ?>">
<?php if(has_post_thumbnail() ): ?>
            <div class="acea--t-thumb">
                <?php the_post_thumbnail( 'medium' ) ?>  
            </div>
        <?php endif; ?>
<?php if(function_exists('the_field') ):    
            $ratting = get_field('review_rating');
        ?>
        <div class="acea--tn-icon">
            <?php for($i=0;$i<5;$i++): 
                	$class = '';
                ?>
                <?php if ($ratting > $i) {
                    $class = "active_color";
                } ?>
                <span class="inactive_color" ><?php Icons_Manager::render_icon($settings['icon'], [ 'class' => $class,'aria-hidden' => 'true']) ?></span>
            <?php endfor; ?>
        </div>
    <?php endif; ?>

    <div class="acea--tn-dis">
    <p><?php echo esc_html( $content ); ?></p>
    </div>

    <div class="acea--tn-top">
        <div class="acea--tn-name-title">
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
    <!-- style one -->

</div>