<?php

use  Elementor\Widget_Base;
use  Elementor\Controls_Manager;
use  Elementor\utils;
use  Elementor\Group_Control_Typography;
use  Elementor\Group_Control_Box_Shadow;
use  Elementor\Group_Control_Background;
use  Elementor\Group_Control_Border;
use  Elementor\Repeater;
use  Elementor\Icons_Manager;

?>

<div class="acea-testimonial__single">
<?php
        if (!empty($item['acea_testimonial_user_img'])) : ?>
            <div class="acea-testimonial__img">
                <img src="<?php echo $item['acea_testimonial_user_img']['url'] ?>" alt="">
            </div>
        <?php endif; ?>
    <?php if (!empty($item['rating_icon'])) : ?>
        <div class="rating_area">
            <?php for ($i = 0; $i < 5; $i++) :
                $class = '';
            ?>
                <?php if ($ratting > $i) {
                    $class = "active_color";
                } ?>
                <span class="inactive_color"><?php Icons_Manager::render_icon($item['rating_icon'], ['class' => $class, 'aria-hidden' => 'true']) ?></span>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
    <?php
    if (!empty($settings['quotes_icon'])) {
    ?>
        <div class="acea-testimonial__quotes-icon">
            <?php Icons_Manager::render_icon($settings['quotes_icon'], ['aria-hidden' => 'true']); ?>
        </div>
    <?php
    }
    if (!empty($item['acea_qoute_text'])) {
        echo '<p class="acea-testimonial__qoute">' . $item['acea_qoute_text'] . '</p>';
    }

    if (!empty($item['acea_testimonial_content'])) {
        echo '<p class="acea-testimonial__decription">' . $item['acea_testimonial_content'] . '</p>';
    }
    ?>
    <div class="acea-testimonial__bottom-meta">

        <div class="acea-testimonial__meta-content">
            <div class="acea-testimonial__name">
                <?php
                if (!empty($item['acea_testimonial_name'])) {
                    echo '<h4">' . $item['acea_testimonial_name'] . '</h4>';
                }
                ?>
            </div>
            <div class="acea-testimonial__position">
                <?php
                if (!empty($item['acea_testimonial_position'])) {
                    echo '<p>' . $item['acea_testimonial_position'] . '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>