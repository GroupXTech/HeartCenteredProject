<?php
/*
 * Plugin Name: Latest Posts
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_latest_posts extends WP_Widget {
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_latest_posts', // Base ID
			__( 'Magzilla: Latest Posts', 'magzilla' ), // Name
			array( 'description' => __( 'Show latest posts by category', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {

		global $before_widget, $after_widget, $before_title, $after_title, $ft_option;
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$items_num = $instance['items_num'];
		$category = $instance['category'];
		$first_big = $instance['first_post'];
		$post_meta = $instance['post_meta'];
		
		echo $before_widget;
			
			
			if ( $title ) echo $before_title . $title . $after_title;
            ?>
            
            <?php
			$qy_latest = new WP_Query(
				array(
					'post_type' => 'post',
					'cat'		=> $category,
					'posts_per_page' => $items_num,
					'ignore_sticky_posts' => 1
				)
			);
			?>
            

			<div class="widget-body">

				<?php $i = 0; ?>
				<?php if( $qy_latest->have_posts() ): while( $qy_latest->have_posts() ): $qy_latest->the_post(); $i++; ?>


					<?php if( $i == 1 && $first_big == 'yes' ): ?>

							<div class="latest-post">
								
								<?php if( has_post_thumbnail() ): ?>
								<div class="featured-image-wrap">
									<?php get_template_part( 'inc/article', 'icon' ); ?>
									<?php if( $ft_option['widget_category'] != 0 ): ?>
										<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
									<?php endif; ?>
									
									<a href="<?php echo esc_url( get_permalink() ); ?>">
										<img alt="<?php the_title(); ?>" width="370" height="277" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 370, 277 , true, true, true ); ?>">
									</a>
								</div><!-- featured-image-wrap -->
								<?php endif; ?>

								<article class="post">
									<h2 class="post-title module-big-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
									<?php if( $post_meta != 'no' ) { ?>
										<ul class="list-inline post-meta">
											<?php get_template_part('inc/widgets', 'meta'); ?>
										</ul><!-- .post-meta -->
									<?php } ?>
									<div class="post-content post-small-content">
										<p><?php echo fave_clean_excerpt( '130', true ); ?></p>
									</div><!-- post-content -->
								</article><!-- .post -->
							</div>

					<?php else: ?>

							<div class="latest-post">
								<div class="row">
									<div class="col-xs-4 col-sm-12 col-md-4 col-lg-4">
										<?php if( has_post_thumbnail() ): ?>
										<div class="featured-image-wrap">
											<?php if( $ft_option['widget_category'] != 0 ): ?>
												<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
											<?php endif; ?>
											<a href="<?php echo esc_url( get_permalink() ); ?>">
												<img alt="<?php the_title(); ?>" width="200" height="200" class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 200, 200 , true, true, true ); ?>">
											</a>
										</div>
										<?php endif; ?>
									</div>
									<div class="col-xs-8 col-sm-12 col-md-8 col-lg-8 no-padding-left">
										<h2 class="post-title module-small-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
										<?php if( $post_meta != 'no' ) { ?>
											<ul class="list-inline post-meta">
												<?php get_template_part('inc/widgets', 'meta'); ?>
											</ul><!-- .post-meta -->
										<?php } ?>
									</div>
								</div>
							</div>


					<?php endif; ?>


				<?php endwhile; endif; ?>

				<?php wp_reset_postdata(); ?>
				
			</div>


	    <?php 
		echo $after_widget;
		
	}
	
	
	/**
	 * Sanitize widget form values as they are saved
	**/
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();

		/* Strip tags to remove HTML. For text inputs and textarea. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['items_num'] = strip_tags( $new_instance['items_num'] );
		$instance['category'] = strip_tags( $new_instance['category'] );
		$instance['first_post'] = strip_tags( $new_instance['first_post'] );
		$instance['post_meta'] = strip_tags( $new_instance['post_meta'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Latest Posts',
			'items_num' => '5',
			'category'  => '',
			'first_post' => 'yes',
			'post_meta' => 'yes'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'items_num' ); ?>"><?php _e('Maximum posts to show:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'items_num' ); ?>" name="<?php echo $this->get_field_name( 'items_num' ); ?>" value="<?php echo $instance['items_num']; ?>" size="1" />
		</p>
		<?php
		$blog_cats = get_terms('category', array('hide_empty' => false));
		$cats_array = array();
		?>
		<p>
          <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e('Category:', 'magzilla'); ?></label>
          <select class="widefat" name="<?php echo $this->get_field_name( 'category' ); ?>">
          
          <option value=""><?php _e( 'All', 'magzilla' ); ?></option>
          <?php foreach($blog_cats as $blog_cat) { ?>
				
		  		<option <?php echo ($instance['category'] == $blog_cat->term_id ) ? ' selected="selected"' : ''; ?> value="<?php echo $blog_cat->term_id; ?>"><?php echo $blog_cat->name; ?></option>

		  <?php } ?>
          
          </select>
       </p>

		<p>
			<label for="<?php echo $this->get_field_id( 'first_post' ); ?>"><?php _e( 'First Post Big', 'magzilla' ); ?>
				<select class="widefat" name="<?php echo $this->get_field_name( 'first_post' ); ?>">
					<option value="yes" <?php echo ($instance['first_post'] == 'yes') ? ' selected="selected"' : ''; ?>><?php _e( 'Yes', 'magzilla' ); ?></option>
					<option value="no" <?php echo ($instance['first_post'] == 'no') ? ' selected="selected"' : ''; ?>><?php _e( 'No', 'magzilla' ); ?></option>
				</select>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'post_meta' ); ?>"><?php _e( 'Posts Meta', 'magzilla' ); ?>
				<select class="widefat" name="<?php echo $this->get_field_name( 'post_meta' ); ?>">
					<option value="yes" <?php echo ($instance['post_meta'] == 'yes') ? ' selected="selected"' : ''; ?>><?php _e( 'Yes', 'magzilla' ); ?></option>
					<option value="no" <?php echo ($instance['post_meta'] == 'no') ? ' selected="selected"' : ''; ?>><?php _e( 'No', 'magzilla' ); ?></option>
				</select>
			</label>
		</p>
		
	<?php
	}

}

if ( ! function_exists( 'magazilla_latest_posts_loader' ) ) {
    function magazilla_latest_posts_loader (){
     register_widget( 'magazilla_latest_posts' );
    }
     add_action( 'widgets_init', 'magazilla_latest_posts_loader' );
}