<?php
/*
 * Plugin Name: Image Banner Widget 300x250
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */

class magazilla_Image_Banner_300_250 extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_image_banner_300_250', // Base ID
			__( 'Magzilla: Image Banner 300x250', 'magzilla' ), // Name
			array( 'description' => __( 'Add image banner 300x300 or 300x250', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {
				
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$banner_url = $instance['banner_url'];
		$banner_link = $instance['banner_link'];
		$hide_title = isset( $instance['hide_title'] ) ? $instance['hide_title'] : false;
		
		echo $before_widget;
			
			if ( ! $hide_title )
			if ( $title ) echo $before_title . $title . $after_title;
            ?>
            
            <div class="widget-image-banner-300x250">
				<div class="widget-body">
					<div class="module-body">
						<div class="image-banner">
							<a href="<?php echo esc_url( $instance['banner_link'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url'] ); ?>" width="300" height="250" alt="Ad" />
				            </a>
						</div>
					</div>
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
		$instance['banner_url'] = strip_tags( $new_instance['banner_url'] );
		$instance['banner_link'] = strip_tags( $new_instance['banner_link'] );
		$instance['hide_title'] = $new_instance['hide_title'];
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Image Ad',
			'banner_url' => 'http://',
			'banner_link' => '#',
			'hide_title' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url' ); ?>"><?php _e('Image Banner URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url' ); ?>" name="<?php echo $this->get_field_name( 'banner_url' ); ?>" value="<?php echo esc_url( $instance['banner_url'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link' ); ?>"><?php _e('Image Banner Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link' ); ?>" name="<?php echo $this->get_field_name( 'banner_link' ); ?>" value="<?php echo esc_url( $instance['banner_link'] ); ?>" class="widefat" />
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php if( $instance['hide_title'] == true ) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e( 'Do not display the title', 'magzilla' ); ?></label>
		</p>
	<?php
	}

}
if ( ! function_exists( 'magazilla_Image_Banner_300_250_loader' ) ) {
    function magazilla_Image_Banner_300_250_loader (){
     register_widget( 'magazilla_Image_Banner_300_250' );
    }
     add_action( 'widgets_init', 'magazilla_Image_Banner_300_250_loader' );
}
