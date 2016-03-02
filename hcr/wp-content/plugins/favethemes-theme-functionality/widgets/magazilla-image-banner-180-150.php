<?php
/*
 * Plugin Name: Image Banner Widget 180x150
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */

class magazilla_Image_Banner_180_150 extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_image_banner_180_150', // Base ID
			__( 'Magzilla: Image Banner 180x150', 'magzilla' ), // Name
			array( 'description' => __( 'Add image banner 180x150', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {
				
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$banner_url_1 = $instance['banner_url_1'];
		$banner_link_1 = $instance['banner_link_1'];

		$banner_url_2 = $instance['banner_url_2'];
		$banner_link_2 = $instance['banner_link_2'];

		$banner_url_3 = $instance['banner_url_3'];
		$banner_link_3 = $instance['banner_link_3'];

		$banner_url_4 = $instance['banner_url_4'];
		$banner_link_4 = $instance['banner_link_4'];

		$banner_url_5 = $instance['banner_url_5'];
		$banner_link_5 = $instance['banner_link_5'];

		$banner_url_6 = $instance['banner_url_6'];
		$banner_link_6 = $instance['banner_link_6'];

		$hide_title = isset( $instance['hide_title'] ) ? $instance['hide_title'] : false;
		
		echo $before_widget;
			
			if ( ! $hide_title )
			if ( $title ) echo $before_title . $title . $after_title;
            ?>
            
            <div class="widget-image-banner-180x150">
				<div class="widget-body">
					<div class="module-body">
						<div class="image-banner">
							
							<?php if( !empty( $instance['banner_url_1'] )) { ?>
							<a href="<?php echo esc_url( $instance['banner_link_1'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url_1'] ); ?>" width="180" height="150" alt="Ad" />
				            </a>
				            <?php } ?>

				            <?php if( !empty( $instance['banner_url_2'] )) { ?>
							<a href="<?php echo esc_url( $instance['banner_link_2'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url_2'] ); ?>" width="180" height="150" alt="Ad" />
				            </a>
				            <?php } ?>

				            <?php if( !empty( $instance['banner_url_3'] )) { ?>
							<a href="<?php echo esc_url( $instance['banner_link_3'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url_3'] ); ?>" width="180" height="150" alt="Ad" />
				            </a>
				            <?php } ?>

				            <?php if( !empty( $instance['banner_url_4'] )) { ?>
							<a href="<?php echo esc_url( $instance['banner_link_4'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url_4'] ); ?>" width="180" height="150" alt="Ad" />
				            </a>
				            <?php } ?>

				            <?php if( !empty( $instance['banner_url_5'] )) { ?>
							<a href="<?php echo esc_url( $instance['banner_link_5'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url_5'] ); ?>" width="180" height="150" alt="Ad" />
				            </a>
				            <?php } ?>

				            <?php if( !empty( $instance['banner_url_6'] )) { ?>
							<a href="<?php echo esc_url( $instance['banner_link_6'] ); ?>" rel="nofollow" target="_blank">
				            	<img src="<?php echo esc_url( $instance['banner_url_6'] ); ?>" width="180" height="150" alt="Ad" />
				            </a>
				            <?php } ?>

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
		$instance['banner_url_1'] = strip_tags( $new_instance['banner_url_1'] );
		$instance['banner_link_1'] = strip_tags( $new_instance['banner_link_1'] );

		$instance['banner_url_2'] = strip_tags( $new_instance['banner_url_2'] );
		$instance['banner_link_2'] = strip_tags( $new_instance['banner_link_2'] );

		$instance['banner_url_3'] = strip_tags( $new_instance['banner_url_3'] );
		$instance['banner_link_3'] = strip_tags( $new_instance['banner_link_3'] );

		$instance['banner_url_4'] = strip_tags( $new_instance['banner_url_4'] );
		$instance['banner_link_4'] = strip_tags( $new_instance['banner_link_4'] );

		$instance['banner_url_5'] = strip_tags( $new_instance['banner_url_5'] );
		$instance['banner_link_5'] = strip_tags( $new_instance['banner_link_5'] );

		$instance['banner_url_6'] = strip_tags( $new_instance['banner_url_6'] );
		$instance['banner_link_6'] = strip_tags( $new_instance['banner_link_6'] );

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
			'banner_url_1' => '',
			'banner_link_1' => '',

			'banner_url_2' => '',
			'banner_link_2' => '',

			'banner_url_3' => '',
			'banner_link_3' => '',

			'banner_url_4' => '',
			'banner_link_4' => '',

			'banner_url_5' => '',
			'banner_link_5' => '',

			'banner_url_6' => '',
			'banner_link_6' => '',

			'hide_title' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url_1' ); ?>"><?php _e('Image Banner 1 URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url_1' ); ?>" name="<?php echo $this->get_field_name( 'banner_url_1' ); ?>" value="<?php echo esc_url( $instance['banner_url_1'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link_1' ); ?>"><?php _e('Image Banner 1 Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link_1' ); ?>" name="<?php echo $this->get_field_name( 'banner_link_1' ); ?>" value="<?php echo esc_url( $instance['banner_link_1'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url_2' ); ?>"><?php _e('Image Banner 2 URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url_2' ); ?>" name="<?php echo $this->get_field_name( 'banner_url_2' ); ?>" value="<?php echo esc_url( $instance['banner_url_2'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link_2' ); ?>"><?php _e('Image Banner 2 Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link_2' ); ?>" name="<?php echo $this->get_field_name( 'banner_link_2' ); ?>" value="<?php echo esc_url( $instance['banner_link_2'] ); ?>" class="widefat" />
		</p>


		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url_3' ); ?>"><?php _e('Image Banner 3 URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url_3' ); ?>" name="<?php echo $this->get_field_name( 'banner_url_3' ); ?>" value="<?php echo esc_url( $instance['banner_url_3'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link_3' ); ?>"><?php _e('Image Banner 3 Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link_3' ); ?>" name="<?php echo $this->get_field_name( 'banner_link_3' ); ?>" value="<?php echo esc_url( $instance['banner_link_3'] ); ?>" class="widefat" />
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url_4' ); ?>"><?php _e('Image Banner 4 URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url_4' ); ?>" name="<?php echo $this->get_field_name( 'banner_url_4' ); ?>" value="<?php echo esc_url( $instance['banner_url_4'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link_4' ); ?>"><?php _e('Image Banner 4 Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link_4' ); ?>" name="<?php echo $this->get_field_name( 'banner_link_4' ); ?>" value="<?php echo esc_url( $instance['banner_link_4'] ); ?>" class="widefat" />
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url_5' ); ?>"><?php _e('Image Banner 5 URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url_5' ); ?>" name="<?php echo $this->get_field_name( 'banner_url_5' ); ?>" value="<?php echo esc_url( $instance['banner_url_5'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link_5' ); ?>"><?php _e('Image Banner 5 Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link_5' ); ?>" name="<?php echo $this->get_field_name( 'banner_link_5' ); ?>" value="<?php echo esc_url( $instance['banner_link_5'] ); ?>" class="widefat" />
		</p>
		

		<p>
			<label for="<?php echo $this->get_field_id( 'banner_url_6' ); ?>"><?php _e('Image Banner 6 URL:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_url_6' ); ?>" name="<?php echo $this->get_field_name( 'banner_url_6' ); ?>" value="<?php echo esc_url( $instance['banner_url_6'] ); ?>" class="widefat" />
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'banner_link_6' ); ?>"><?php _e('Image Banner 6 Link:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'banner_link_6' ); ?>" name="<?php echo $this->get_field_name( 'banner_link_6' ); ?>" value="<?php echo esc_url( $instance['banner_link_6'] ); ?>" class="widefat" />
		</p>
		

        <p>
			<input class="checkbox" type="checkbox" <?php if( $instance['hide_title'] == true ) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e( 'Do not display the title', 'magzilla' ); ?></label>
		</p>
	<?php
	}

}
if ( ! function_exists( 'magazilla_Image_Banner_180_150_loader' ) ) {
    function magazilla_Image_Banner_180_150_loader (){
     register_widget( 'magazilla_Image_Banner_180_150' );
    }
     add_action( 'widgets_init', 'magazilla_Image_Banner_180_150_loader' );
}
