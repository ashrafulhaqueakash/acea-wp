<?php
if (!defined('ABSPATH')) {
    exit;
}
while ($the_query->have_posts()) : $the_query->the_post(); ?>
    <?php
     $idd = get_the_ID();
     $categories = get_the_terms($idd, 'portfolio-category');
     $firstcat = $categories[0];
     $grid = '';
     $image_height = ' height-' . get_post_meta($idd, 'acea_image_height', true);
     $pf_cat_slug = '';
     $pf_cat_name = '';
     if (!empty($categories)) {
         $pf_cat_name = join(' ', wp_list_pluck($categories[0], 'name'));
         $pf_cat_slug = join(' ', wp_list_pluck($categories, 'slug'));
     }
     if ('yes' == $settings['use_meta_grid']) {
         $grid =  'col-md-' . get_post_meta($idd, 'column_grid', true);
     } else {
         $grid = $column_class;
     }
    
    ?>
    <div id="post-<?php the_ID(); ?>" class="<?php printf('acea-portfolio-item-wrap %s %s %s' , $grid  , $pf_cat_slug , $image_height); ?>">
        <div class="acea-portfolio-item">
            <div class="acea-portfolio-thumbnail" >
               <a href="<?php echo get_the_permalink() ?>" class="acea-portfolio-image d-block <?php echo esc_attr( 'elementor-animation-'.$settings['image_hover_animation'] ) ?>">
                  <?php the_post_thumbnail() ?>
               </a>
            </div>
            <div class="acea-portfolio-content <?php echo esc_attr( ( $layout_style ) ); ?>" >
               <div class="cat-title" >
                  <a href="<?php echo get_the_permalink() ?>" class="content-postion-<?php echo $settings['content_position'], $layout_style . " text-" . $settings['content_align'] ?>">
                     <h3 class="acea-portfolio-title">
                           <?php echo get_the_title() ?>
                           <?php if( 'yes' == $settings['show_title_icon'] && $settings['title_icon'] ): ?>
                                 <div class="title-icon">
                                 <?php  Elementor\Icons_Manager::render_icon($settings['title_icon'], ['aria-hidden' => 'true']); ?>
                                 </div>
                           <?php endif; ?>
                     </h3>
                  </a>
               </div>
                  <?php if ( has_excerpt()  && 'yes' == $settings['show_excerpt'] ):  ?>
                  <div class="portfolio-content" >
                     <?php the_excerpt(); ?>
                  </div>
               <?php endif; ?>
             
               
               
            </div>
            
                
            
        </div>
    </div><!-- #post-<?php the_ID(); ?> -->
<?php
endwhile;
?>