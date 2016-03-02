<?php
/*
 * Plugin Name: Video Widget
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */

class magazilla_Video_Embed extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_video_embed', // Base ID
			__( 'Magzilla: Video', 'magzilla' ), // Name
			array( 'description' => __( 'Add video from Vimeo, YouTube or other video site.', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {

		global $before_widget, $after_widget, $before_title, $after_title;

		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$video_url = $instance['video_url'];
		$video_title = $instance['video_title'];
		
		echo $before_widget;
			
			
			if ( $title ) echo $before_title . $title . $after_title;
			
			
            $video_embed =  wp_oembed_get( $video_url );
            ?>

            <div class="widget-body">
                <div class="module-body">
                    <div class="magazilla_featured_video">
                        <?php echo '<figure class="magazilla_featured_video_wrapper">' .$video_embed. '</figure>'; ?>
                        
                    </div>
                    
                    <h4 class="heading"><?php echo $video_title; ?></h4>
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
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['video_url'] = strip_tags( $new_instance['video_url'] );
		$instance['video_title'] = strip_tags( $new_instance['video_title'] );
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Video',
			'video_url' => '',
			'video_title' => 'Video Title',
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'themeText'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video_url' ); ?>"><?php _e('Video page URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'video_url' ); ?>" name="<?php echo $this->get_field_name( 'video_url' ); ?>" value="<?php echo esc_url($instance['video_url']); ?>" class="widefat" />
		</p>
		<p>
		<p>
			<label for="<?php echo $this->get_field_id( 'video_title' ); ?>"><?php _e('Video Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'video_title' ); ?>" name="<?php echo $this->get_field_name( 'video_title' ); ?>" value="<?php echo $instance['video_title']; ?>" class="widefat" />
		</p>
	<?php
	}

}
if ( ! function_exists( 'magazilla_Video_Embed_loader' ) ) {
    function magazilla_Video_Embed_loader (){
     register_widget( 'magazilla_Video_Embed' );
    }
     add_action( 'widgets_init', 'magazilla_Video_Embed_loader' );
}