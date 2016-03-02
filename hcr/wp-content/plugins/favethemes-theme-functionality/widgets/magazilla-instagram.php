<?php
/*
 * Plugin Name: Instagram widget
 * Plugin URI: http://favethemes.com/
 * Description: A widget that displays a slider with instagram images
 * Version: 1.0
 * Author: Waqas Riaz
 * Author URI: http://favethemes.com/
 */
 
class magazilla_instagram extends WP_Widget {
	
	
	/**
	 * Register widget
	**/
	public function __construct() {
		
		parent::__construct(
	 		'magazilla_instagram', // Base ID
			__( 'Magzilla: Instagram Slider',  'magzilla'  ), // Name
			array( 'description' => __( 'A widget that displays a slider/thumbs with instagram images',  'magzilla'  ), ) // Args
		);
		
	}

	
	/** @see WP_Widget::widget */
  function widget($args, $instance) {	
    extract( $args );

	$title        = apply_filters('widget_title', $instance['title'] );
	$userid = apply_filters('userid', $instance['userid']);
    $accessToken = apply_filters('accessToken', $instance['accessToken']);
	$link_to	  = isset( $instance['images_link'] ) ? $instance['images_link'] : 'image_url';
	$amount    = isset( $instance['images_number'] ) ? $instance['images_number'] : 5;
	$template	  = isset( $instance['template'] ) ? $instance['template'] : 'slider';
	
	
?>
<?php echo $before_widget; 
if ( $title )
echo $before_title . $title . $after_title; ?>
                 

<?php
	

		// Pulls and parses data.
		$result = $this->fetchData('https://api.instagram.com/v1/users/'.$userid.'/media/recent/?access_token='.$accessToken.'&count='.$amount);
		$result = json_decode($result);

		$unique_key = fave_unique_key();
	    if ( is_rtl() ) { $magzilla_rtl = 'true'; } else { $magzilla_rtl = 'false'; }
		?>
			
			<script type="text/javascript">
			jQuery(document).ready(function($) { 
				
				$("#owl-carousel-instagram-<?php echo $unique_key; ?>").owlCarousel({
					rtl: <?php echo $magzilla_rtl; ?>,
					loop: true,
					touchDrag: true,
					items : 1,

				    //Autoplay
				    autoplay : true,
					autoplayHoverPause : true,

				    // Navigation
					nav : true,
					navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
				    rewindNav : true,
				    dots:false,

				    // Responsive 
					responsiveClass:true,
					responsiveRefreshRate : 200,
					responsiveBaseWidth: window,

				    //Lazy load
				    lazyLoad : true,
				    lazyFollow : true,
				    lazyEffect : "fade",
				});
				
			});
			</script>
		<?php
	
		//include the template based on user choice
        if(!empty($result->data)) {

	        if($template == "slider"){
			   $this->magazilla_instagram_slider($template, $result, $link_to, $unique_key);
			}
			else{
				$this->magazilla_instagram_slider_thumbs($template, $result, $link_to);
			}
		}
	?>

								
<?php echo $after_widget; ?>
			 
<?php }
	
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) {	
	
        return $new_instance;
    }
	
	
	/** @see WP_Widget::form */
    function form($instance) {
      /* Set up some default widget settings. */
      $defaults = array(
		 'title' 		=> __('Instagram Slider', 'magzilla'),
		 'userid' 		=> '',
		 'accessToken'  => '',
		 'template' 		=> 'slider',
		 'images_link' 	=> 'image_url',
		 'images_number' => 6
	 );
	 $instance = wp_parse_args( (array) $instance, $defaults );
			
			
    ?>
    	<p>Generate your Instagram user ID and Instagram access token on: <a target="_blank" href="http://www.pinceladasdaweb.com.br/instagram/access-token/">Instagram access token generator</a> website</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'magzilla'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title']); ?>" />
		</p>
		<p><label for="<?php echo $this->get_field_id('userid'); ?>"><?php _e('Instagram user ID:', 'wegotext'); ?> <input class="widefat" id="<?php echo $this->get_field_id('userid'); ?>" name="<?php echo $this->get_field_name('userid'); ?>" type="text" value="<?php echo $instance['userid']; ?>" /></label></p>
	  	<p><label for="<?php echo $this->get_field_id('accessToken'); ?>"><?php _e('Instagram access token:', 'wegotext'); ?> <input class="widefat" id="<?php echo $this->get_field_id('accessToken'); ?>" name="<?php echo $this->get_field_name('accessToken'); ?>" type="text" value="<?php echo $instance['accessToken']; ?>" /></label></p>
        <p>
          <label for="<?php echo $this->get_field_id( 'template' ); ?>"><?php _e( 'Images Layout', 'magzilla' ); ?>
          <select class="widefat" name="<?php echo $this->get_field_name( 'template' ); ?>">
          <option value="slider" <?php echo ($instance['template'] == 'slider') ? ' selected="selected"' : ''; ?>><?php _e( 'Slider', 'magzilla' ); ?></option>
          <!-- <option value="slider-overlay" <?php echo ($instance['template'] == 'slider-overlay') ? ' selected="selected"' : ''; ?>><?php _e( 'Slider - Overlay Text', 'magzilla' ); ?></option> -->
          <option value="thumbs" <?php echo ($instance['template'] == 'thumbs') ? ' selected="selected"' : ''; ?>><?php _e( 'Thumbnails', 'magzilla' ); ?></option>
          </select>  
          </label>
       </p>
       <p>
            <?php _e('Link Images To:', 'magzilla'); ?><br>
            <label><input type="radio" id="<?php echo $this->get_field_id( 'images_link' ); ?>" name="<?php echo $this->get_field_name( 'images_link' ); ?>" value="image_url" <?php checked( 'image_url', $instance['images_link'] ); ?> /> <?php _e('Instagram Image', 'magzilla'); ?></label><br />
            <label><input type="radio" id="<?php echo $this->get_field_id( 'images_link' ); ?>" name="<?php echo $this->get_field_name( 'images_link' ); ?>" value="user_url" <?php checked( 'user_url', $instance['images_link'] ); ?> /> <?php _e('Instagram Profile', 'magzilla'); ?></label><br />
            
         </p>
		   
		<p>
			<label  for="<?php echo $this->get_field_id( 'images_number' ); ?>"><?php _e('Number of Images to Show:', 'magzilla'); ?>
			<input  class="small-text" id="<?php echo $this->get_field_id( 'images_number' ); ?>" name="<?php echo $this->get_field_name( 'images_number' ); ?>" value="<?php echo $instance['images_number']; ?>" />
			<small><?php _e('( max 20 )', 'magzilla'); ?></small>
            </label>
		</p>

			
<?php }



	// Gets our data
	function fetchData($url){
	     $ch = curl_init();
	     curl_setopt($ch, CURLOPT_URL, $url);
	     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	     curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	     $result = curl_exec($ch);
	     curl_close($ch); 
	     return $result;
	}

	function magazilla_instagram_slider($template, $result, $link_to, $unique_key){?>

		
		<div class="widget-instagramm-slider">
		<div class="widget-body">
			<div class="module-body">
				<div id="owl-carousel-instagram-<?php echo $unique_key; ?>" class="owl-carousel">
					
					<?php
			        foreach ( $result->data as $post) {


			        		if ( $link_to == 'image_url' ) {
			                    $link = $post->link;
			                } else {
			                	$link = "http://instagram.com/".$post->user->username."";
			                }

			                if( isset( $post->caption->text ) ) {
			                	$text = $post->caption->text;
			                } else {
			                	$text = '';
			                }
			                
			                echo '<div class="slide">'. "\n";
			                echo '<a target="_blank" href="'.$link.'"><img class="featured-image lazyOwl" data-src="'.$post->images->standard_resolution->url.'" src="'.$post->images->standard_resolution->url.'" alt="'.$text.'"></a>' . "\n";
			                echo '</div>' . "\n";

			        }
			        ?>


				</div>
			</div>
		</div>
		</div>

		<?php
		}


		function magazilla_instagram_slider_thumbs($template, $result, $link_to){ ?>
	
		<div class="widget-instagramm-thumbs">
		<div class="widget-body">
			<div class="module-body">
				<div class="instagramm-thumbs clearfix">
					
					<?php
					foreach ( $result->data as $post) {

			        		if ( $link_to == 'image_url' ) {
			                    $link = $post->link;
			                } else {
			                	$link = "http://instagram.com/".$post->user->username."";
			                }
			               
			                echo '<a target="_blank" href="' . $link . '"><img width="100" src="' . $post->images->thumbnail->url . '" alt=""></a>' . "\n";

			        }
				    ?>

				</div>
			</div>
		</div>
		</div>

		<?php	
		}


}// end .magazilla_instagram

if ( ! function_exists( 'magazilla_instagram_loader' ) ) {
    function magazilla_instagram_loader (){
     register_widget( 'magazilla_instagram' );
    }
     add_action( 'widgets_init', 'magazilla_instagram_loader' );
}


