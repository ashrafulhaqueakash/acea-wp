<?php

/**
 * Acea class-acea-resent-posts.php widget class file
 *
 * @package Acea
 */
/**
 * AceaRecentPost widget.
 */
class AceaRecentPost extends WP_Widget
{
	/**
	 * Register widget with WordPress.
	 */
	function __construct()
	{
		parent::__construct(
			'acea_recent_post', // Base ID
			esc_html__('Acea Posts', 'acea'), // Name
			array('description' => esc_html__('Display Recent Posts', 'acea')) // Args
		);
	}
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance)
	{
		echo wp_kses_post($args['before_widget']);
		$ppp = isset($instance['ppp']) ? esc_attr((int) $instance['ppp']) : 10;
?>
		<?php
		if (!empty($instance['title'])) {
			$widget_title = $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
			echo wp_kses_post($widget_title);
		}
		$argument     = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $ppp,
		);
		$recent_query = new WP_Query($argument);
		if ($recent_query->have_posts()) :
		?>
			<div class="acea-popular-post">
				<?php
				while ($recent_query->have_posts()) :
					$recent_query->the_post();
				?>
					<div class="acea-popular-post-item">
						<div class="acea-popular-content">
							<div class="acea-popular-content-img">
								<?php echo the_post_thumbnail('medium') ?>
							</div>
							<div class="acea-popular-content-bottom">
								<div class="acea-blog-meta m-b-10">
									<div class="entry-meta">
										<?php
										acea_posted_on();
										acea_posted_by();
										?>
									</div><!-- .entry-meta -->
								</div>
								<div class="acea-blog-title acea-border-bottom">
									<a href="<?php the_permalink(); ?>">
										<h4><?php the_title(); ?></h4>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php
				endwhile;
				wp_reset_postdata();
				?>
			</div>
		<?php else : ?>
			<p><?php esc_html_e('Sorry, no posts found.', 'acea'); ?></p>
		<?php endif; ?>
	<?php
		echo wp_kses_post($args['after_widget']);
	}
	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
		$instance['ppp']   = (!empty($new_instance['ppp'])) ? sanitize_text_field($new_instance['ppp']) : '';
		return $instance;
	}
	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance)
	{
		$title = isset($instance['title']) ? $instance['title'] : esc_html__('Recent Posts', 'acea');
		$ppp   = isset($instance['ppp']) ? $instance['ppp'] : '5';
	?>
		<p>
			<label id=for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'acea'); ?></label>
			<input class="widefat acea_special-wfield" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label id=for="<?php echo esc_attr($this->get_field_id('ppp')); ?>"><?php esc_html_e('Post Per Page:', 'acea'); ?></label>
			<input class="widefat acea_special-wfield" id="<?php echo esc_attr($this->get_field_id('ppp')); ?>" name="<?php echo esc_attr($this->get_field_name('ppp')); ?>" type="text" value="<?php echo esc_attr($ppp); ?>" />
		</p>
<?php
	}
} // class AceaRecentPost
// if (!function_exists('acea_recent_post_widget_init')) {
function acea_recent_post_widget_init()
{
	register_widget('AceaRecentPost');
}
// }
add_action('widgets_init', 'acea_recent_post_widget_init');
