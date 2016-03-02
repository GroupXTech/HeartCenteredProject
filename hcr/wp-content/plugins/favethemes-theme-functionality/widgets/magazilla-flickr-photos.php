<?php
/*
 * Plugin Name: Flickr Feeds
 * Plugin URI: http://favethemes.com/
 * Description: A widget to get photos from flickr
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_Flickr_Feeds extends WP_Widget {

	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_flickr_feeds', // Base ID
			__( 'Magzilla: Flickr', 'magzilla' ), // Name
			array( 'description' => __( 'Show photos from Flickr.', 'magzilla' ), ) // Args
		);
		
	}
	

	function widget($args, $instance) {

		$instance = wp_parse_args( (array) $instance );

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}

		$photos = $this->get_photos( $instance['userid'], $instance['count'] );

		if ( !empty( $photos ) ) {
			$style = 'style="width: '.$instance['t_width'].'px; height: '.$instance['t_height'].'px;"';

			echo '<div class="widget-flickr-thumbs">';
				echo '<div class="widget-body">';
					echo '<div class="module-body">';
						echo '<div class="flickr-thumbs clearfix">';
							
							foreach ( $photos as $photo ) {
								echo '<a href="'.$photo['img_url'].'" title="'.$photo['title'].'" target="_blank"><img src="'.$photo['img_src'].'" alt="'.$photo['title'].'" '.$style.'/></a>';
							}

						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}

		echo $after_widget;
	}

	function get_photos( $id, $count = 8 ) {
		if ( empty( $id ) )
			return false;

		$transient_key = md5( 'favethemes_flickr_cache_' . $id . $count );
		$cached = get_transient( $transient_key );
		if ( !empty( $cached ) ) {
			return $cached;
		}

		$output = array();
		$rss = 'http://api.flickr.com/services/feeds/photos_public.gne?id='.$id.'&lang=en-us&format=rss_200';
		$rss = fetch_feed( $rss );

		if ( is_wp_error( $rss ) ) {
			//check for group feed
			$rss = 'http://api.flickr.com/services/feeds/groups_pool.gne?id='.$id.'&lang=en-us&format=rss_200';
			$rss = fetch_feed( $rss );

		}
		if ( !is_wp_error( $rss ) ) {
			$maxitems = $rss->get_item_quantity( $count );
			$rss_items = $rss->get_items( 0, $maxitems );

			foreach ( $rss_items as $item ) {
				$temp = array();
				$temp['img_url'] = esc_url( $item->get_permalink() );
				$temp['title'] = esc_html( $item->get_title() );
				$content =  $item->get_content();
				preg_match_all( "/<IMG.+?SRC=[\"']([^\"']+)/si", $content, $sub, PREG_SET_ORDER );
				$photo_url = str_replace( "_m.jpg", "_t.jpg", $sub[0][1] );
				$temp['img_src'] = esc_url( $photo_url );
				$output[] = $temp;
			}

			set_transient( $transient_key, $output, 60 * 60 * 24 );
		}


		return $output;
	}

	

	function update($new_instance, $old_instance)
	{

		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['userid'] = strip_tags( $new_instance['userid'] );
		$instance['count'] = absint( $new_instance['count'] );
		$instance['t_width'] = absint( $new_instance['t_width'] );
		$instance['t_height'] = absint( $new_instance['t_height'] );
		return $new_instance;

	}



	function form($instance)
	{

		$defaults = array(
		 'title' 	 => __('Flickr Photos', 'magzilla'),
		 'userid' 	 => '',
		 't_height'  => '90',
		 't_width' 	 => '120',
		 'count' 	 => 6
	 );
	 $instance = wp_parse_args( (array) $instance, $defaults );
	 ?>

		

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'magzilla' ); ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'userid' ); ?>"><?php _e( 'Flickr ID', 'magzilla' ); ?>:</label> <small><a href="http://idgettr.com/" target="_blank"><?php _e( 'What\'s my Flickr ID?', 'magzilla' ); ?></a></small>
			<input class="widefat" id="<?php echo $this->get_field_id( 'userid' ); ?>" name="<?php echo $this->get_field_name( 'userid' ); ?>" type="text" value="<?php echo esc_attr( $instance['userid'] ); ?>" />
			<small class="howto"><?php _e( 'Example ID: 23100287@N07', 'magzilla' ); ?></small>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of photos', 'magzilla' ); ?>:</label>
			<input class="small-text" type="text" value="<?php echo absint( $instance['count'] ); ?>" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 't_width' ); ?>"><?php _e( 'Thumbnail width', 'magzilla' ); ?>:</label>
			<input class="small-text" type="text" value="<?php echo absint( $instance['t_width'] ); ?>" id="<?php echo $this->get_field_id( 't_width' ); ?>" name="<?php echo $this->get_field_name( 't_width' ); ?>" /> px
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 't_height' ); ?>"><?php _e( 'Thumbnail height', 'magzilla' ); ?>:</label>
			<input class="small-text" type="text" value="<?php echo absint( $instance['t_height'] ); ?>" id="<?php echo $this->get_field_id( 't_height' ); ?>" name="<?php echo $this->get_field_name( 't_height' ); ?>" /> px
		</p>

		

	<?php

	}

}

if ( ! function_exists( 'magazilla_Flickr_Feeds_loader' ) ) {
    function magazilla_Flickr_Feeds_loader (){
     register_widget( 'magazilla_Flickr_Feeds' );
    }
     add_action( 'widgets_init', 'magazilla_Flickr_Feeds_loader' );
}
?>