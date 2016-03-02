<?php
/*
 * Plugin Name: Latest Reviews
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_latest_reviews extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_latest_reviews', // Base ID
			__( 'Magzilla: Latest Reviews', 'magzilla' ), // Name
			array( 'description' => __( 'Show latest reviews by category', 'magzilla' ), ) // Args
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
		$post_meta = $instance['post_meta'];
		
		echo $before_widget;
			
			
			if ( $title ) echo $before_title . $title . $after_title;
            ?>
            
            <?php
			/** 
			 * Latest Posts
			**/
			global $post;
			//init the array
	        $wp_query_args = array(
	            'ignore_sticky_posts' => 1
	        );

	        if (!empty($category)) {
	            $wp_query_args['cat'] = $category;
	        }

	        $wp_query_args['meta_key'] = 'fave_final_score';
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['order'] = 'DESC';

            $wp_query_args['posts_per_page'] = $items_num;

			$qy_latest = new WP_Query( $wp_query_args );
			?>
            

			<div class="widget-body">

				<?php $i = 0; ?>
				<?php if( $qy_latest->have_posts() ): while( $qy_latest->have_posts() ): $qy_latest->the_post(); 

				$fave_score_display_type = get_post_meta( get_the_ID(), 'fave_score_display_type', true );
				$fave_final_score = get_post_meta( get_the_ID(), 'fave_final_score', true );
				$fave_final_score_override = get_post_meta( get_the_ID(), 'fave_final_score_override', true );

				/*if( !empty( $fave_final_score_override ) ) {
					$fave_final_score = $fave_final_score_override;
				}*/

				$fave_review_final_score = intval($fave_final_score);

				if ( $fave_score_display_type == 'percentage' ) {
					$fave_score_output = $fave_review_final_score . '%';
				}

				if ( $fave_score_display_type == 'points' ) {
					$fave_score_output = $fave_review_final_score /10;
				}

				?>


					<div class="latest-review">
						<div class="row">
							<div class="col-xs-4 col-sm-12 col-md-4 col-lg-4">
								<?php if( has_post_thumbnail() ): ?>
								<div class="featured-image-wrap">
									<a href="<?php the_permalink(); ?>">
										<div class="score-label"><?php echo $fave_score_output; ?></div>
										<img alt="<?php the_title(); ?>" class="featured-image" width="175" height="175" src="<?php echo fave_featured_image( get_the_ID(), 175, 175 , true, true, true ); ?>">
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
		$instance['post_meta'] = strip_tags( $new_instance['post_meta'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Latest Reviews',
			'items_num' => '5',
			'category'  => '',
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
if ( ! function_exists( 'magazilla_latest_reviews_loader' ) ) {
    function magazilla_latest_reviews_loader (){
     register_widget( 'magazilla_latest_reviews' );
    }
     add_action( 'widgets_init', 'magazilla_latest_reviews_loader' );
}