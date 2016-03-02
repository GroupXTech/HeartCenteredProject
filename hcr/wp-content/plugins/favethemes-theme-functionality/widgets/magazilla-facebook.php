<?php
class magzilla_facebook_like extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'magzilla_facebook', // Base ID
			__( 'Magzilla: Facebook', 'magzilla' ), // Name
			array( 'description' => __( 'Adds support for Facebook Like Box.', 'magzilla' ), ) // Args
		);

	}

	function widget($args, $instance)
	{

		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		$page_url = $instance['page_url'];
		$width = $instance['width'];
		$fb_height = $instance['fb_height'];
		$use_small_header = isset($instance['use_small_header']) ? 'true' : 'false';
		$show_faces = isset($instance['show_faces']) ? 'true' : 'false';
		$show_posts = isset($instance['show_posts']) ? 'true' : 'false';
		$adapt_width = isset($instance['adapt_width']) ? 'true' : 'false';
		$hide_title = isset($instance['hide_title']) ? 'true' : 'false';

		echo $before_widget;

		if ( ! empty( $title ) && $hide_title != "true" ) {
			echo $before_title . $title . $after_title;
		}

		if( $adapt_width =="true" ){
			$width = '';
			$fb_height = '';
		}

		if($page_url): ?>

		<div class="fb-page"
		     data-href="<?php echo esc_url($page_url); ?>"
		     data-width="<?php echo $width; ?>"
		     data-height="<?php echo $fb_height; ?>"
		     data-small-header="<?php echo $use_small_header; ?>"
		     data-adapt-container-width="<?php echo $adapt_width; ?>"
		     data-hide-cover="false"
		     data-show-facepile="<?php echo $show_faces; ?>"
		     data-show-posts="<?php echo $show_posts; ?>">
			<div class="fb-xfbml-parse-ignore">
			</div>
		</div>

		<?php endif;

		echo $after_widget;

	}


	function update($new_instance, $old_instance)
	{

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['page_url'] = $new_instance['page_url'];
		$instance['width'] = $new_instance['width'];
		$instance['fb_height'] = $new_instance['fb_height'];
		$instance['use_small_header'] = $new_instance['use_small_header'];
		$instance['show_faces'] = $new_instance['show_faces'];
		$instance['show_posts'] = $new_instance['show_posts'];
		$instance['adapt_width'] = $new_instance['adapt_width'];
		$instance['hide_title'] = $new_instance['hide_title'];

		return $instance;
	}


	function form($instance)
	{

		$defaults = array('title' => 'Find us on Facebook', 'page_url' => 'https://www.facebook.com/Favethemes/', 'width' => '', 'fb_height' => '', 'use_small_header' => false, 'show_faces' => 'on', 'show_posts' => false, 'adapt_width' => 'on', 'hide_title' => 'on' );
		$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('page_url'); ?>">Facebook Page URL:</label>
			<input class="widefat" id="<?php echo $this->get_field_id('page_url'); ?>" name="<?php echo $this->get_field_name('page_url'); ?>" value="<?php echo $instance['page_url']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>">Width:</label>
			<input class="small-text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('fb_height'); ?>">Height:</label>
			<input class="small-text" id="<?php echo $this->get_field_id('fb_height'); ?>" name="<?php echo $this->get_field_name('fb_height'); ?>" value="<?php echo $instance['fb_height']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['adapt_width'], 'on'); ?> id="<?php echo $this->get_field_id('adapt_width'); ?>" name="<?php echo $this->get_field_name('adapt_width'); ?>" />
			<label for="<?php echo $this->get_field_id('adapt_width'); ?>">Adapt to container width</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['use_small_header'], 'on'); ?> id="<?php echo $this->get_field_id('use_small_header'); ?>" name="<?php echo $this->get_field_name('use_small_header'); ?>" />
			<label for="<?php echo $this->get_field_id('use_small_header'); ?>">Use Small Header</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_faces'], 'on'); ?> id="<?php echo $this->get_field_id('show_faces'); ?>" name="<?php echo $this->get_field_name('show_faces'); ?>" />
			<label for="<?php echo $this->get_field_id('show_faces'); ?>">Show Friend's faces</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_posts'], 'on'); ?> id="<?php echo $this->get_field_id('show_posts'); ?>" name="<?php echo $this->get_field_name('show_posts'); ?>" />
			<label for="<?php echo $this->get_field_id('show_posts'); ?>">Show Page Posts</label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['hide_title'], 'on'); ?> id="<?php echo $this->get_field_id('hide_title'); ?>" name="<?php echo $this->get_field_name('hide_title'); ?>" />
			<label for="<?php echo $this->get_field_id('hide_title'); ?>">Hide Widget Title</label>
		</p>


	<?php
	}
}


if ( ! function_exists( 'magazilla_facebook_loader' ) ) {
	function magazilla_facebook_loader (){
		register_widget( 'magzilla_facebook_like' );
	}
	add_action( 'widgets_init', 'magazilla_facebook_loader' );
}

?>