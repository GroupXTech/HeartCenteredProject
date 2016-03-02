<?php
class magzilla_youtube extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'magzilla-youtube', // base id
			__( 'Magzilla: Youtube', 'magzilla' ),
			array( 'description' => __('Youtube Channel', 'magzilla' ) )
		);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		echo $after_title; ?>

		<div class="youtube-box-main">
			<iframe id="fr" src="http://www.youtube.com/subscribe_widget?p=<?php echo $page_url ?>" style="overflow: hidden; height: 115px; border: 0; width: 100%;" scrolling="no" frameBorder="0"></iframe>
		</div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Subscribe to our Channel' , 'magzilla'), 'page_url' => '' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Channel Name : </label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}

if( !function_exists( 'magzilla_youtube_loader' ) ) {
	function magzilla_youtube_loader() {
		register_widget('magzilla_youtube');
	}
	add_action( 'widgets_init', 'magzilla_youtube_loader' );
}
?>