<?php
/*
 * Plugin Name: Authors
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_authors extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_authors', // Base ID
			__( 'Magzilla: Authors', 'magzilla' ), // Name
			array( 'description' => __( 'Show list of authors', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {
				
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$items_num = $instance['items_num'];
		$user_role = $instance['user_role'];
		
		echo $before_widget;
			
			
			if ( $title ) echo $before_title . $title . $after_title;


			if( !empty( $user_role ) ) { 
				$wp_query_args['role'] = $user_role;
			}
            $wp_query_args['orderby'] = 'post_count';
            $wp_query_args['order'] = 'DESC';
            $wp_query_args['number'] = $items_num;
            
			$authors = get_users( $wp_query_args );
			?>
           
            <div class="widget-body">
		
				<!-- ADMIN -->
				<?php
                foreach ( $authors as $author ):
                    
                // Get the author ID
                $author_id = $author->ID;
            	$author_role = $author->roles[0];

            	if( $author_role == 'administrator' ) { $author_role = 'admin'; }
				?>

				<div class="author-holder text-center">
					<div class="post-author-for-archive">
						<div class="media">
							<div class="media-top-author">
								<a href="<?php echo get_author_posts_url( $author_id ); ?>">
									<img width="70" height="70" alt="<?php echo get_the_author_meta( 'display_name', $author_id ); ?>" class="media-object img-circle post-author-avatar" src="<?php echo fave_get_avatar_url(get_avatar( $author_id, 70 )); ?>">
									<span class="role-<?php echo $author_role; ?> role-icon">
										<i class="fa fa-user"></i>
									</span>
								</a>
							</div>
							<div class="media-body-author">
								<h2 class="post-author"><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></a></h2>
								<ul class="list-inline post-meta">
									<li class="role-<?php echo $author_role; ?>"><?php echo $author_role; ?></li>
									<!-- <li>|</li> -->
									
									<li class="post-label">
										<a href="<?php echo get_author_posts_url( $author_id ); ?>">
											<i class="fa fa-bookmark"></i> <?php echo count_user_posts( $author_id ); ?> <?php _e( 'Posts', 'magzilla' ); ?>
										</a>
									</li>
									<!-- <li>|</li> -->
									
									<li class="post-total-comments"><i class="fa fa-comment-o"></i> <?php echo fave_user_comment_count( $author_id ); ?> <?php _e( 'Comments', 'magzilla' ); ?></li>

									<li class="post-author-social-links display-block">
										<?php if( get_the_author_meta('fave_author_flickr', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_flickr', $author_id ) ); ?>" class="flickr-icon flickr"><i class="fa fa-flickr"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_pinterest', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_pinterest', $author_id ) ); ?>" class="pinterest-icon"><i class="fa fa-pinterest-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_youtube', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_youtube', $author_id ) ); ?>" class="youtube-icon"><i class="fa fa-youtube-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_foursquare', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_foursquare', $author_id ) ); ?>" class="foursquare-icon"><i class="fa fa-foursquare"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_instagram', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_instagram', $author_id ) ); ?>" class="instagram-icon"><i class="fa fa-instagram"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_twitter', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_twitter', $author_id ) ); ?>" class="twitter-icon"><i class="fa fa-twitter-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_vimeo', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_vimeo', $author_id ) ); ?>" class="vimeo-icon"><i class="fa fa-vimeo-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_facebook', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_facebook', $author_id ) ); ?>" class="facebook-icon"><i class="fa fa-facebook-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_google_plus', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_google_plus', $author_id ) ); ?>" class="google-plus-icon"><i class="fa fa-google-plus-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_linkedin', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_linkedin', $author_id ) ); ?>" class="linkedin-icon"><i class="fa fa-linkedin-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_tumblr', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_tumblr', $author_id ) ); ?>" class="tumblr-icon"><i class="fa fa-tumblr-square"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('fave_author_dribbble', $author_id ) ) { ?>
										<a href="<?php echo esc_url( get_the_author_meta('fave_author_dribbble', $author_id ) ); ?>" class="dribbble-icon"><i class="fa fa-dribbble"></i></a>
										<?php } ?>

										<?php if( get_the_author_meta('user_email', $author_id ) ) { ?>
										<a href="mailto:<?php echo get_the_author_meta('user_email' , $author_id ); ?>" class="envelope-icon"><i class="fa fa-envelope"></i></a>
										<?php } ?>
									</li>

								</ul><!-- post-meta -->
								<p><?php echo wp_trim_words( get_the_author_meta( 'description', $author_id ), 10, '...' ); ?> <a class="continue-reading" href="<?php echo get_author_posts_url( $author_id ); ?>"> <?php _e( 'View Profile', 'magzilla' ); ?><i class="fa fa-angle-double-right"></i></a>
								</p>
							</div><!-- media-body -->
						</div><!-- media -->
					</div><!-- post-author -->
				</div><!-- author-holder -->

			<?php endforeach; ?>

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
		$instance['user_role'] = strip_tags( $new_instance['user_role'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'AUTHORS AND CONTRIBUTORS',
			'user_role' => '',
			'items_num' => '5'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'user_role' ); ?>"><?php _e('Role:', 'magzilla'); ?></label>
			<select name="<?php echo $this->get_field_name( 'user_role' ); ?>">
				<option value=''><?php _e( 'All', 'magzilla' ); ?></option>
				<option <?php echo ($instance['user_role'] == 'administrator' ) ? ' selected="selected"' : ''; ?> value="administrator"><?php _e( 'Administrator', 'magzilla' ); ?></option>
				<option <?php echo ($instance['user_role'] == 'author' ) ? ' selected="selected"' : ''; ?> value="author"><?php _e( 'Author', 'magzilla' ); ?></option>
				<option <?php echo ($instance['user_role'] == 'editor' ) ? ' selected="selected"' : ''; ?> value="editor"><?php _e( 'Editor', 'magzilla' ); ?></option>
				<option <?php echo ($instance['user_role'] == 'contributor' ) ? ' selected="selected"' : ''; ?> value="contributor"><?php _e( 'Contributor', 'magzilla' ); ?></option>
				<option <?php echo ($instance['user_role'] == 'subscriber' ) ? ' selected="selected"' : ''; ?> value="subscriber"><?php _e( 'Subscriber', 'magzilla' ); ?></option>
			</select>
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'items_num' ); ?>"><?php _e('Maximum authors to show:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'items_num' ); ?>" name="<?php echo $this->get_field_name( 'items_num' ); ?>" value="<?php echo $instance['items_num']; ?>" size="1" />
		</p>
		
	<?php
	}

}

if ( ! function_exists( 'magazilla_authors_loader' ) ) {
    function magazilla_authors_loader (){
     register_widget( 'magazilla_authors' );
    }
     add_action( 'widgets_init', 'magazilla_authors_loader' );
}