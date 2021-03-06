<?php
/*
 * Plugin Name: Latest Videos
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_latest_videos extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_latest_videos', // Base ID
			__( 'Magzilla: Latest Videos', 'magzilla' ), // Name
			array( 'description' => __( 'Show latest video from video custom post type by category', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {

		global $before_widget, $after_widget, $before_title, $after_title;

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
			/** 
			 * Latest Posts
			**/
			global $post;
			
			if( !empty($category) ):

				$qy_videos = new WP_Query(
					array(
						'post_type' => 'video',
						'tax_query' => array(
							array(
								'taxonomy' => 'video-categories',
								'field'    => 'term_id',
								'terms'    => $category,
							),
						),
						'posts_per_page' => $items_num
					)
				);
			else:

				$qy_videos = new WP_Query(
					array(
						'post_type' => 'video',
						'posts_per_page' => $items_num
					)
				);

			endif;
			?>
            

			<div class="widget-body">

				<?php $i = 0; ?>
				<?php if( $qy_videos->have_posts() ): while( $qy_videos->have_posts() ): $qy_videos->the_post(); $i++; ?>

					<?php if( $i == 1 && $first_big == 'yes' ): ?>

							<div class="latest-video">

								<div class="thumb big-thumb">
									<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
									<?php if( has_post_thumbnail() ): ?>
									<div class="thumb-content">
										<h2 class="gallery-title-small"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
										<!-- <ul class="list-inline post-meta hidden-xs hidden-sm hidden-md">
											<?php // get_template_part( 'inc/video', 'meta' ); ?>
										</ul>	 -->
									</div>
									<div class="slide-image-wrap">
										<img alt="<?php the_title(); ?>" class="featured-image" width="370" height="277" src="<?php echo fave_featured_image( get_the_ID(), 370, 277, true, true, true ); ?>">
									</div><!-- slide-image-wrap -->
									<?php endif; ?>
								</div>
							</div>

					<?php else: ?>

							<div class="latest-video">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-4">
										<?php if( has_post_thumbnail() ): ?>
										<div class="thumb">
											<div class="slide-image-wrap">
												<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
												<img alt="<?php the_title(); ?>" class="featured-image" width="170" height="79" src="<?php echo fave_featured_image( get_the_ID(), 170, 79 , true, true, true ); ?>">
											
											</div><!-- slide-image-wrap -->
										</div>
										<?php endif; ?>
									</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-4 col-lg-push-3 col-md-push-3 -->
									<div class="col-lg-6 col-md-6 col-sm-12 col-xs-8 no-padding-left">
										<article class="post">	
											<h2 class="post-title module-small-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											<?php if( $post_meta != 'no' ) { ?>
												<ul class="list-inline post-meta">
													<?php get_template_part('inc/widgets', 'meta'); ?>
												</ul><!-- .post-meta -->
											<?php } ?>
										</article><!-- .module-3-post -->
									</div><!-- col-lg-5 col-md-5 col-sm-8 col-xs-8 col-lg-push-3 col-md-push-3 -->
								</div><!-- .row -->
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
			'title' => 'Latest Videos',
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
		$blog_cats = get_terms('video-categories', array('hide_empty' => false));
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
if ( ! function_exists( 'magazilla_latest_videos_loader' ) ) {
    function magazilla_latest_videos_loader (){
     register_widget( 'magazilla_latest_videos' );
    }
     add_action( 'widgets_init', 'magazilla_latest_videos_loader' );
}