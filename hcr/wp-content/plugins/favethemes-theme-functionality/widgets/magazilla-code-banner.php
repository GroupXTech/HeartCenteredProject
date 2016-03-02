<?php
/*
 * Plugin Name: Code or Google AdSense Banner Widget
 * Plugin URI: http://favethemes.com/
 * Description: A widget that shows latest posts slider or list
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */

class magazilla_Code_Banner extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_code_banner', // Base ID
			__( 'Magzilla: Code Banner', 'magzilla' ), // Name
			array( 'description' => __( 'Paste your banner JS or Google Adsense code', 'magzilla' ), ) // Args
		);
		
	}

	
	/**
	 * Front-end display of widget
	**/
	public function widget( $args, $instance ) {
				
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$banner_code = $instance['banner_code'];
		$hide_title = isset( $instance['hide_title'] ) ? $instance['hide_title'] : false;
		
		echo $before_widget;
			
			if ( ! $hide_title )
			if ( $title ) echo $before_title . $title . $after_title;
            
			echo '<div class="widget-body">';
				echo '<div class="module-body">';
					echo '<div class="magazilla_code_banner">';
        				
        				echo $instance['banner_code']; 

        			echo '</div>';
        		echo '</div>';
        	echo '</div>';
            
	    
		echo $after_widget;
		
	}
	
	
	/**
	 * Sanitize widget form values as they are saved
	**/
	public function update( $new_instance, $old_instance ) {
		
		$instance = array();

		/* Strip tags to remove HTML. For text inputs and textarea. */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['banner_code'] = $new_instance['banner_code'];
		$instance['hide_title'] = $new_instance['hide_title'];
		
		return $instance;
		
	}
	
	
	/**
	 * Back-end widget form
	**/
	public function form( $instance ) {
		
		/* Default widget settings. */
		$defaults = array(
			'title' => 'Ad Code',
			'banner_code' => 'Paste you code here...',
			'hide_title' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
		
	?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'banner_code' ); ?>"><?php _e('JS or Google AdSense Code', 'magzilla'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'banner_code' ); ?>" name="<?php echo $this->get_field_name( 'banner_code' ); ?>" class="widefat" style="height:70px;"><?php echo esc_textarea( $instance['banner_code'] ); ?></textarea>
		</p>
        <p>
			<input class="checkbox" type="checkbox" <?php if( $instance['hide_title'] == true ) echo 'checked'; ?> id="<?php echo $this->get_field_id( 'hide_title' ); ?>" name="<?php echo $this->get_field_name( 'hide_title' ); ?>" /> 
			<label for="<?php echo $this->get_field_id( 'hide_title' ); ?>"><?php _e( 'Do not display the title', 'magzilla' ); ?></label>
		</p>
	<?php
	}

}

if ( ! function_exists( 'magazilla_Code_Banner_loader' ) ) {
    function magazilla_Code_Banner_loader (){
     register_widget( 'magazilla_Code_Banner' );
    }
     add_action( 'widgets_init', 'magazilla_Code_Banner_loader' );
}