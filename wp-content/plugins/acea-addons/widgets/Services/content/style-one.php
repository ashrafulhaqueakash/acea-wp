<?php
$excerpt    = ($settings['excerpt_limit']['size']) ? wp_trim_words(get_the_excerpt(), $settings['excerpt_limit']['size'], '...') : get_the_excerpt();
$title      = ($settings['title_limit']['size']) ? wp_trim_words(get_the_title(), $settings['title_limit']['size'], '...') : get_the_title();
?>
<div <?php echo $this->get_render_attribute_string('grid_classes'); ?>>
    <div class="acea-service-widget-item <?php echo esc_attr($service_style); ?>">
        <div class="services-img-wrapper">
        <div class="services-img">
            <?php echo the_post_thumbnail(); ?>
        </div>
        </div>
        <div class="service-content">
            <div class="service-content-title">
                <?php printf('<a href="%s" class="service-title-link d-block"><h3 class="service-title">%s</h3></a>', get_the_permalink(), $title); ?>
            </div>
            <div class="service-desc">
                <?php echo ('yes' == $settings['show_excerpt']) ? sprintf('<p> %s </p>', esc_html($excerpt)) : ''; ?>
            </div>
            <?php if('yes' == $settings['show_readmore']): ?>
            <div class="service-btn-wrap">
                <a class="service-btn <?php echo esc_attr('elementor-animation-' . $settings['btn_hover_animation']) ?>" href="<?php the_permalink() ?>">
                    <?php if ('before' == $settings['icon_position'] && !empty($settings['icon']['value'])) : ?>
                        <span class="icon-before btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?></span>
                    <?php endif; ?>
                    <?php echo esc_html($settings['readmore_text']); ?>
                    <?php if ('after' == $settings['icon_position'] && !empty($settings['icon']['value'])) : ?>
                        <span class="icon-after btn-icon"><?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']) ?></span>
                    <?php endif; ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>