<?php

class magzilla_feedburner extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'magzilla-feedburner', //base id
			__( 'Magzilla: Feedburner' ),
			array('description' => __( 'Subscribe to feedburner via email' ) )
		);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$text_code = $instance['text_code'];
		$feedburner = $instance['feedburner'];
		
		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		echo '<div class="widget-feedburner-counter">
		<p>'.do_shortcode( $text_code ).'</p>' ; ?>
		<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo $feedburner ; ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input class="feedburner-email" type="text" name="email" value="<?php _e( 'Enter your e-mail address' , 'magzilla') ; ?>" onfocus="if (this.value == '<?php _e( 'Enter your e-mail address' , 'magzilla') ; ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Enter your e-mail address' , 'magzilla') ; ?>';}">
			<input type="hidden" value="<?php echo $feedburner ; ?>" name="uri">
			<input type="hidden" name="loc" value="en_US">			
			<input class="feedburner-subscribe" type="submit" name="submit" value="<?php _e( 'Subscribe' , 'magzilla') ; ?>">
		</form>
		</div>
		<?php
		echo $after_widget;			
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text_code'] = $new_instance['text_code'] ;
		$instance['feedburner'] = strip_tags( $new_instance['feedburner'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'FeedBurner Widget' , 'tie') , 'text_code' => __( 'Subscribe to our email newsletter.' , 'magzilla') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'text_code' ); ?>">Text above Email Input Field : <small>( support : Html & Shortcodes )</small> </label>
			<textarea rows="5" id="<?php echo $this->get_field_id( 'text_code' ); ?>" name="<?php echo $this->get_field_name( 'text_code' ); ?>" class="widefat" ><?php echo $instance['text_code']; ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'feedburner' ); ?>">Feedburner ID : </label>
			<input id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $instance['feedburner']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}

if( !function_exists( 'magzilla_feedburner_loader' ) ) {
	function magzilla_feedburner_loader () {
		register_widget('magzilla_feedburner');
	}
	add_action( 'widgets_init', 'magzilla_feedburner_loader' );
}

?>