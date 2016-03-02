<?php
class magzilla_social extends WP_Widget {

	public $social_fields = array (
		'rss',
		'facebook',
		'twitter',
		'google-plus',
		'linkedin',
		'instagram',
		'flickr',
		'foursquare',
		'vimeo-square',
		'youtube',
		'dribbble',
		'tumblr',
		'pinterest',
		'github',
		/*'envato',*/
		'soundcloud',
		'behance',
		'delicious',
		'vk',
		'vine',
		'steam',
		'spotify',
		'twitch',
		'mixcloud'
	);

	public function __construct() {
		parent::__construct(
			'magzilla_social', // base ID
			__( 'Magzilla: Social Icons', 'magzilla' ),
			array('description' => '' )
		);
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$icons_type = $instance['icons_type'];
		$icons_style = $instance['icons_style'];
		$icons_size = $instance['icons_size'];
		$new_tab = $instance['new_tab'];
		$width = $instance['width'];
		$height = $instance['height'];
		$margin_right = $instance['margin_right'];
		$margin_bottom = $instance['margin_bottom'];

		$social_profile = array();
		foreach ( $this->social_fields as $sf ) {
			$social_profile[$sf] = $instance[$sf];
		}

		echo $before_widget;

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		magzilla_get_social( $social_profile, $icons_type, $icons_style, $icons_size, $width, $height, $margin_right, $margin_bottom, $new_tab );

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['icons_type'] = strip_tags( $new_instance['icons_type'] );
		$instance['icons_style'] = strip_tags( $new_instance['icons_style'] );
		$instance['new_tab'] = strip_tags( $new_instance['new_tab'] );
		$instance['icons_size'] = strip_tags( $new_instance['icons_size'] );
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['margin_right'] = $new_instance['margin_right'];
		$instance['margin_bottom'] = $new_instance['margin_bottom'];

		foreach ( $this->social_fields as $sf ) {
			$instance[$sf] = $new_instance[$sf];
		}
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__('Social' , 'magzilla') , 'icons_style' => '', 'icon_size' =>'20', 'width' => '49', 'height' => '49', 'margin_right' => '2', 'margin_bottom' => '2' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'icons_type' ); ?>">Icons Type : </label>
			<select id="<?php echo $this->get_field_id( 'icons_type' ); ?>" name="<?php echo $this->get_field_name( 'icons_type' ); ?>" >
				<option value="ft-social-outer-frame" <?php if( $instance['icons_type'] == 'ft-social-outer-frame' ) echo "selected=\"selected\""; else echo ""; ?>>Outer Frame</option>
				<option value="ft-social-filled" <?php if( $instance['icons_type'] == 'ft-social-filled' ) echo "selected=\"selected\""; else echo ""; ?>>Filled</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'icons_style' ); ?>">Icons Style : </label>
			<select id="<?php echo $this->get_field_id( 'icons_style' ); ?>" name="<?php echo $this->get_field_name( 'icons_style' ); ?>" >
				<option value="ft-social-circle" <?php if( $instance['icons_style'] == 'ft-social-circle' ) echo "selected=\"selected\""; else echo ""; ?>>Circle Icons</option>
				<option value="ft-social-flat" <?php if( $instance['icons_style'] == 'ft-social-flat' ) echo "selected=\"selected\""; else echo ""; ?>>Flat Icons</option>
				<option value="ft-social-leaf-1" <?php if( $instance['icons_style'] == 'ft-social-leaf-1' ) echo "selected=\"selected\""; else echo ""; ?>>Leaf Icons 1</option>
				<option value="ft-social-leaf-2" <?php if( $instance['icons_style'] == 'ft-social-leaf-2' ) echo "selected=\"selected\""; else echo ""; ?>>Leaf Icons 2</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'icons_size' ); ?>">Icons Size : </label>
			<select id="<?php echo $this->get_field_id( 'icons_size' ); ?>" name="<?php echo $this->get_field_name( 'icons_size' ); ?>" >
				<?php $i = ''; ?>

				<?php for( $i = 16; $i <= 50; $i++ ) { ?>
					<option value="<?php echo $i; ?>" <?php if( $instance['icons_size'] == $i ) echo "selected=\"selected\""; else echo ""; ?>><?php echo $i; ?>px</option>
				<?php } ?>

			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>">Width:</label>
			<input class="small-text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('height'); ?>">Height:</label>
			<input class="small-text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('margin_right'); ?>">Width:</label>
			<input class="small-text" id="<?php echo $this->get_field_id('margin_right'); ?>" name="<?php echo $this->get_field_name('margin_right'); ?>" value="<?php echo $instance['margin_right']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('margin_bottom'); ?>">Height:</label>
			<input class="small-text" id="<?php echo $this->get_field_id('margin_bottom'); ?>" name="<?php echo $this->get_field_name('margin_bottom'); ?>" value="<?php echo $instance['margin_bottom']; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'newtap' ); ?>">Open links in a new tab :</label>
			<input id="<?php echo $this->get_field_id( 'newtap' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" value="yes" <?php if( $instance['new_tab'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>

		<?php foreach ( $this->social_fields as $sf ) {
				$sf_title = explode( '-', $sf );
			?>
			<p>
				<label style="text-transform: capitalize; " for="<?php echo $this->get_field_id( $sf ); ?>"><?php echo $sf_title[0]." profile link"; ?>: </label>
				<input id="<?php echo $this->get_field_id( $sf ); ?>" name="<?php echo $this->get_field_name( $sf ); ?>" value="<?php echo $instance[$sf]; ?>" class="widefat" type="text" />
			</p>
		<?php } ?>

		


	<?php
	}
}
if ( ! function_exists( 'magzilla_social_loader' ) ) {
	function magzilla_social_loader (){
		register_widget( 'magzilla_social' );
	}
	add_action( 'widgets_init', 'magzilla_social_loader' );
}

function magzilla_get_social( $social_profile, $icons_type, $icons_style, $icon_size = '32',  $width, $height, $m_r, $m_b, $newtab = 'yes' ){
	global $ft_option;
	$newtab = '';
	if ($newtab == 'yes') { $newtab = "target=\"_blank\""; }

	$final_width = '';
	if( !empty($width) ) {
		$final_width = 'width: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $width ) ? $width : $width . 'px' ).';';
	}

	$final_height = '';
	$line_height = '';
	if( !empty($height) ) {
		$final_height = 'height: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $height ) ? $height : $height . 'px' ).';';
		$line_height = 'line-height: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $height ) ? $height : $height . 'px' ).';';
	}

	$margin_right = '';
	$margin_bottom = '';
	if( !empty($m_r) ) {
		$margin_right = 'margin-right: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $m_r ) ? $m_r : $m_r . 'px' ).';';
	}
	if( !empty($m_b) ) {
		$margin_bottom = 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $m_b ) ? $m_b : $m_b . 'px' ).';';
	}

	$unique_key = fave_unique_key();
	?>

	<style type="text/css">
		.social-<?php echo $unique_key; ?> li a i {
			text-align: center;
			float: left;
			font-size: <?php echo $icon_size; ?>px;
			margin: 0 auto;
			<?php echo $margin_right; ?>
			<?php echo $margin_bottom; ?>
			<?php echo $final_width; ?>
			<?php echo $final_height; ?>
			<?php echo $line_height; ?>
		}
	</style>

	<div class="social-<?php echo $unique_key; ?> magzilla-social-icons <?php echo $icons_type.' '.$icons_style; ?>">
		<?php
		// Loop through array and output the item only if the field is not empty
		foreach ( $social_profile as $key => $val ) {
			if ( !empty ( $val )) {
				echo '<li class="ft-'.esc_attr( $key ).'">';
				echo '<a href="' . esc_url( $val ) . '" target="_blank">
					<i class="fa fa-'.esc_attr( $key ).'"></i></a>';
				echo '</li>';
			}
		}
?>
	</div>
<div class="clearfix"></div>
	<?php
}
?>