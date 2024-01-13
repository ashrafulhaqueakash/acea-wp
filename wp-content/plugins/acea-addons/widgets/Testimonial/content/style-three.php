<?php

use Elementor\Icons_Manager;

$content = ($settings['t_word_limit']['size']) ? wp_trim_words(get_the_content(), $settings['t_word_limit']['size'], '  ') : get_the_content();
?>

<div class="acea--tn-single <?php echo esc_attr($testimonial_style); ?>">



    <div class="acea-tn-bottom">

        <div class="acea--tn-user-identity">
            <div class="acea--tn-qoute">
                <?php Icons_Manager::render_icon($settings['quate'], ['aria-hidden' => 'true']) ?>
            </div>
        </div>
        <div class="acea--tn--social-links">
            <?php if (function_exists('the_field')  && 'yes' == $settings['show_socail_links']) :
                $social_links = get_field('social_links');
            ?>
                <div class="social-icons">
                    <ul class="list-unstyled">
                        <?php foreach ($social_links as  $social_link) :  ?>
                            <li>
                                <a href="<?php echo esc_url($social_link['url']); ?>">
                                    <?php echo $social_link['icon'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="acea--tn-dis">
        <p><?php echo esc_html($content); ?></p>
    </div>
    <div class="testimonial-bottom-content">
        <div class="d-flex align-items-center">
            <div class="acea--tn-top">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="acea--t-thumb">
                        <?php the_post_thumbnail('medium') ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="acea--tn-name-title">
                <h4 class="acea--tn-name">
                    <?php the_title() ?>
                </h4>
                <?php if (function_exists('the_field')) : ?>
                    <span class="acea--tn-title">
                        <?php echo get_field('designation') ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>