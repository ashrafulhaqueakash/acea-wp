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
    <div class="acea-testimonial__meta-content">
        <div class="user-image">
            <?php
            if (!empty($item['acea_testimonial_user_img'])) : ?>
                <div class="acea-testimonial__img">
                    <img src="<?php echo $item['acea_testimonial_user_img']['url'] ?>" alt="">
                </div>
            <?php endif; ?>
        </div>
        <div class="testimonial-content">
            <?php
            if (!empty($item['acea_testimonial_content'])) {
                echo '<p class="acea-testimonial__decription">' . $item['acea_testimonial_content'] . '</p>';
            }
            ?>
            <div class="user-identity">
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
</div>