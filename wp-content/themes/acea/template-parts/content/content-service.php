<?php
    
     $icon = get_post_meta( get_the_ID(), 'service_iconicon', true );
    ?>
      <div class="col-md-4">
         <div class="single-service">
            <?php if( !empty($icon) ): ?>
            <div class="service-icon">
               <img src="<?php echo esc_url($icon); ?>" alt="<?php echo get_the_title(  ) ?>">
            </div>
            <?php endif; ?>
            <div class="single-service-content-wrapper">
               <div class="service-title">
               <?php
                  the_title(
                  sprintf( '<h2 class="title-service"><a href="%s" rel="bookmark">', esc_attr( esc_url( get_permalink() ) ) ),
                  '</a></h2>'
                  );
               ?>
               </div>
               <div class="service-content">
                  <?php the_excerpt(); ?>
               </div>
               <div class="service-btn" >
                  <a href="<?php the_permalink(); ?>">Discover More</a>
               </div>
               
            </div>

         </div>
   </div>

<?php

