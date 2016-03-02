<?php
/*
 * Plugin Name: Post Tabs
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_tabs extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_tabs', // Base ID
			__( 'Magzilla: Widget Tabs', 'magzilla' ), // Name
			array( 'description' => __( 'Show latest posts, popular posts and latest reviews', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {

		global $before_widget, $after_widget;

		extract( $args );

		$items_num = $instance['items_num'];
		$default_active = $instance['default_active'];
		$post_meta = $instance['post_meta'];

		$popular = $instance['popular'];
		$latest = $instance['latest'];
		$review = $instance['review'];

		if ( $default_active == 'popular' ) {
			$popular_tab = "in active";
		} elseif( $default_active == 'letest' ) {
			$latest_tab = "in active";
		}
		elseif( $default_active == 'reviews' ) {
			$review_tab = "in active";
		} else {
			$popular_tab = "in active";
		}
		
		echo $before_widget;
			
			

			/** 
			 * Latest Posts
			**/
			//init the array
	        $wp_query_args = array(
	            'ignore_sticky_posts' => 1
	        );

	        $wp_query_args['meta_key'] = 'fave_final_score';
            $wp_query_args['orderby'] = 'meta_value_num';
            $wp_query_args['order'] = 'DESC';

            $wp_query_args['posts_per_page'] = $items_num;

			$qy_reviews = new WP_Query( $wp_query_args );

			// Latest Posts
			$qy_latest = new WP_Query(
				array(
					'post_type' => 'post',
					'posts_per_page' => $items_num
				)
			);

			// Popular 
			$wp_popular_args = array(
	            'ignore_sticky_posts' => 1
	        );

	        $wp_popular_args['meta_key'] = 'fave-post_views';
            $wp_popular_args['orderby'] = 'meta_value_num';
            $wp_popular_args['order'] = 'DESC';

            $wp_popular_args['posts_per_page'] = $items_num;

			$qy_popular = new WP_Query( $wp_popular_args );

			global $ft_option;
			?>
            
			<div class="widget-tabs">
			<div class="widget-body">

			
					<!-- tabpanel -->
					<div role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<?php if( $popular != 1 ) { ?>
							<li role="presentation" class="<?php echo $popular_tab; ?>"><a href="#fave_tab1" aria-controls="fave_tab1" role="tab" data-toggle="tab"><?php _e( 'Popular posts', 'magzilla' ); ?></a></li>
							<?php } ?>

							<?php if( $latest != 1 ) { ?>
							<li role="presentation" class="<?php echo $latest_tab; ?>"><a href="#fave_tab2" aria-controls="tab2" role="tab" data-toggle="tab"><?php _e( 'Latest posts', 'magzilla' ); ?></a></li>
							<?php } ?>

							<?php if( $review != 1 ) { ?>
							<li role="presentation" class="<?php echo $review_tab; ?>"><a href="#fave_tab3" aria-controls="tab3" role="tab" data-toggle="tab"><?php _e( 'Reviews', 'magzilla' ); ?></a></li>
							<?php } ?>

						</ul>
					</div><!-- tabpanel -->
					
					<!-- Tab panes -->
					<div class="tab-content">

						<?php if( $popular != 1 ) { ?>
						<div role="tabpanel" class="tab-pane fade <?php echo $popular_tab; ?>" id="fave_tab1">
							
							<?php if( $qy_popular->have_posts() ): while( $qy_popular->have_posts() ): $qy_popular->the_post(); ?>
							
							<div class="latest-post">
								<div class="row">
									<div class="col-xs-4 col-sm-12 col-md-4 col-lg-4">
										
										<?php if( has_post_thumbnail() ): ?>
										<div class="featured-image-wrap">

											<?php if( $ft_option['widget_category'] != 0 ): ?>
											<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
											<?php endif; ?>
											<a href="<?php echo esc_url( get_permalink() ); ?>">
												<img class="featured-image" width="175" height="175" src="<?php echo fave_featured_image( get_the_ID(), 175, 175 , true, true, true ); ?>"  alt="<?php the_title(); ?>">
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

						</div><!-- tab-pane fade -->
						<?php } ?>

						<?php if( $latest != 1 ) { ?>
						<div role="tabpanel" class="tab-pane fade <?php echo $latest_tab; ?>" id="fave_tab2">
							
							<?php if( $qy_latest->have_posts() ): while( $qy_latest->have_posts() ): $qy_latest->the_post(); ?>

							
							<div class="latest-post">
								<div class="row">
									<div class="col-xs-4 col-sm-12 col-md-4 col-lg-4">
										
										<?php if( has_post_thumbnail() ): ?>
										<div class="featured-image-wrap">
											<?php if( $ft_option['widget_category'] != 0 ): ?>
												<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
											<?php endif; ?>
											<a href="<?php echo esc_url( get_permalink() ); ?>">
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
						<?php } ?>


						<?php if( $review != 1 ) { ?>
						<div role="tabpanel" class="tab-pane fade <?php echo $review_tab; ?>" id="fave_tab3">
							
							<?php if( $qy_reviews->have_posts() ): while( $qy_reviews->have_posts() ): $qy_reviews->the_post(); 

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
						<?php } ?>
					</div><!-- tab-content -->
				
			</div>
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
		/*$instance['title'] = strip_tags( $new_instance['title'] );*/
		$instance['items_num'] = strip_tags( $new_instance['items_num'] );
		$instance['post_meta'] = strip_tags( $new_instance['post_meta'] );
		$instance['default_active'] = strip_tags( $new_instance['default_active'] );
		$instance['popular'] = strip_tags( $new_instance['popular'] );
		$instance['latest'] = strip_tags( $new_instance['latest'] );
		$instance['review'] = strip_tags( $new_instance['review'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			/*'title' => 'Latest Reviews',*/
			'items_num' => '3',
			'post_meta' => 'yes',
			'default_active' => '',
			'popular' => '',
			'latest' => '',
			'review' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<!-- <p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p> -->
		<p>
			<label for="<?php echo $this->get_field_id( 'items_num' ); ?>"><?php _e('Maximum posts to show:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'items_num' ); ?>" name="<?php echo $this->get_field_name( 'items_num' ); ?>" value="<?php echo $instance['items_num']; ?>" size="1" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'default_active' ); ?>"><?php _e( 'Default Active Tab', 'magzilla' ); ?>
				<select class="widefat" name="<?php echo $this->get_field_name( 'default_active' ); ?>">
					<option value="popular" <?php echo ($instance['default_active'] == 'popular') ? ' selected="selected"' : ''; ?>><?php _e( 'Popular Posts', 'magzilla' ); ?></option>
					<option value="letest" <?php echo ($instance['default_active'] == 'letest') ? ' selected="selected"' : ''; ?>><?php _e( 'Letest Posts', 'magzilla' ); ?></option>
					<option value="reviews" <?php echo ($instance['default_active'] == 'reviews') ? ' selected="selected"' : ''; ?>><?php _e( 'Review Posts', 'magzilla' ); ?></option>
				</select>
			</label>
		</p>
		<p>
			<?php _e('Hide Tabs:', 'magzilla'); ?><br>
			<label><input type="checkbox" id="<?php echo $this->get_field_id( 'popular' ); ?>" name="<?php echo $this->get_field_name( 'popular' ); ?>" value="1" <?php checked( 1, $instance['popular'] ); ?> /> <?php _e('Popular Posts', 'magzilla'); ?></label><br />
			<label><input type="checkbox" id="<?php echo $this->get_field_id( 'latest' ); ?>" name="<?php echo $this->get_field_name( 'latest' ); ?>" value="1" <?php checked( 1, $instance['latest'] ); ?> /> <?php _e('Latest Posts', 'magzilla'); ?></label><br />
			<label><input type="checkbox" id="<?php echo $this->get_field_id( 'review' ); ?>" name="<?php echo $this->get_field_name( 'review' ); ?>" value="1" <?php checked( 1, $instance['review'] ); ?> /> <?php _e('Review Posts', 'magzilla'); ?></label><br />

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

if ( ! function_exists( 'magazilla_tabs_loader' ) ) {
    function magazilla_tabs_loader (){
     register_widget( 'magazilla_tabs' );
    }
     add_action( 'widgets_init', 'magazilla_tabs_loader' );
}