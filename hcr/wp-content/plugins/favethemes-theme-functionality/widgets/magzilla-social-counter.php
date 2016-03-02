<?php
class magzilla_social_counter extends WP_Widget {

	public function __construct() {

		parent::__construct(
			'magzilla-social-counter', // base id
			__('Magzilla: Social Counter', 'magzilla'),
			array( 'description' => __( 'Social Counter', 'magzilla' ), 'classname' => 'widget-social-profiles' ) // Args
		);
	}

	function widget( $args, $instance ) {
		extract( $args );

		global $ft_option;

		$sc_cache = $instance['sc_cache'] ;
		$new_window = $instance['new_window'];

		if( $new_window ) $new_window =' target="_blank" ';
		else $new_window ='';

		echo $before_widget;

		$facebook_page = $ft_option['facebook_count_id'];

		$twitter_username = $ft_option['twitter_uname']; //favethemes';
		$consumer_key = $ft_option['twitter_com_key']; //'SnPUggAmh6l5Jg5ShSnjmo60a';
		$consumer_secret = $ft_option['twitter_com_secret']; //'NEz4WgydSOK2TMsBcDJh8fmavPFMSbYJafgrXXbnJVYBpyD6yG';
		$access_token = $ft_option['twitter_access_token']; //'924216925-tax01d22ZZCWasYPG0OATFZM9jVARhttDgIWdqzT';
		$access_token_secret  = $ft_option['twitter_access_token_secret']; //'RjndNuU9aPSK54jmGDsgp0eczHMbZgxsNF06aBKMmPfZ9';

		$google_page_id = $ft_option['google_page_id'];
		$google_api_key = $ft_option['google_api_key'];

		$instagram_u_name = $ft_option['instagram_u_name'];
		$instagram_u_id = $ft_option['instagram_u_id'];
		$instagram_access_token = $ft_option['instagram_access_token'];

		$yt_ch_url = $ft_option['yt_ch_url'];
		$yt_ch_id = $ft_option['yt_ch_id'];//'UCCYussvCX6h7fmcwS1AYQlA';
		$yt_ch_api = $ft_option['yt_ch_api'];//'AIzaSyBbDttChe2yU6fu-Ea3c-Eh3sbJbUtIi5o';

		if ( ! empty( $title ) ) {
			echo $before_title . $title . $after_title;
		} ?>

		<div class="widget-body">
			<div class="module-body">

				<!-- facebook -->
				<?php if( !empty( $facebook_page ) ):
					$fb_fans = magzilla_facebook_fans( $facebook_page, $sc_cache ); ?>
					<ul class="list-inline">
						<li class="facebook">
							<i class="fa fa-facebook-square"></i>
						</li>
						<li class="social-count"><?php echo ft_formatted_count( $fb_fans, 'short' ); ?></li>
						<li class="social-text"><?php _e( 'Fans', 'magzilla' ); ?></li>
						<li class="social-button"><a class="btn btn-theme" <?php echo $new_window ?> href="<?php echo esc_url( $facebook_page ); ?>"><?php _e( 'Like us', 'magzilla' ); ?></a></li>
					</ul>
				<?php endif; ?>

				<!-- twitter -->
				<?php
				if( !empty( $twitter_username ) && !empty( $consumer_key ) && !empty( $consumer_secret ) && !empty( $access_token ) && !empty( $access_token_secret ) ):
					$twitter_followers = magzilla_twitter_followers( $sc_cache );
					$profile_url = 'https://twitter.com/' . $twitter_username;?>
				<ul class="list-inline">
					<li class="twitter">
						<i class="fa fa-twitter-square"></i>
					</li>
					<li class="social-count"><?php echo ft_formatted_count( $twitter_followers, 'short' ); ?></li>
					<li class="social-text"><?php _e( 'Followers', 'magzilla' ); ?></li>
					<li class="social-button"><a class="btn btn-theme" <?php echo $new_window ?> href="<?php echo esc_url($profile_url); ?>"><?php _e( 'Follow us', 'magzilla' ); ?></a></li>
				</ul>
				<?php endif; ?>

				<!-- google + -->
				<?php
				if( !empty( $google_page_id ) && !empty( $google_api_key ) ):
				$google_followers = magzilla_google_followers( $sc_cache );
				$social_profile_url = 'https://plus.google.com/' . $google_page_id;?>
				<ul class="list-inline">
					<li class="google-plus">
						<i class="fa fa-google-plus-square"></i>
					</li>
					<li class="social-count"><?php echo ft_formatted_count( $google_followers, 'short' ); ?></li>
					<li class="social-text"><?php _e( 'Followers', 'magzilla' ); ?></li>
					<li class="social-button"><a class="btn btn-theme" <?php echo $new_window ?> href="<?php echo esc_url($social_profile_url); ?>"><?php _e( 'Follow us', 'magzilla' ); ?></a></li>
				</ul>
				<?php endif; ?>

				<!-- youtube -->
				<?php
				if( !empty( $yt_ch_api ) && !empty( $yt_ch_id ) && !empty( $yt_ch_url ) ):
					$youtube_subscribers = magzilla_youtube_subscribers( $sc_cache ); ?>
				<ul class="list-inline">
					<li class="youtube">
						<i class="fa fa-youtube-square"></i>
					</li>
					<li class="social-count"><?php echo ft_formatted_count( $youtube_subscribers, 'short' ); ?></li>
					<li class="social-text"><?php _e( 'Subscribers', 'magzilla' ); ?></li>
					<li class="social-button"><a class="btn btn-theme" <?php echo $new_window ?> href="<?php echo esc_url($yt_ch_url); ?>"><?php _e( 'Subscribe', 'magzilla' ); ?></a></li>
				</ul>
				<?php endif; ?>

				<?php
				if( !empty( $instagram_u_name ) && !empty( $instagram_u_id ) && !empty( $instagram_access_token ) ):
					$instagram_followers = magzilla_instagram_followers( $sc_cache );
					$social_profile_url = 'https://instagram.com/' . $instagram_u_name;?>
				<ul class="list-inline">
						<li class="instagram">
							<i class="fa fa-instagram"></i>
						</li>
						<li class="social-count"><?php echo ft_formatted_count( $instagram_followers, 'short' ); ?></li>
						<li class="social-text"><?php _e( 'Followers', 'magzilla' ); ?></li>
						<li class="social-button"><a class="btn btn-theme" href="<?php echo esc_url($social_profile_url); ?>" <?php echo $new_window ?>><?php _e('Follow us' , 'magzilla' ) ?></a></li>
				</ul>
				<?php endif; ?>

			</div>
		</div>

	<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['new_window'] = strip_tags( $new_instance['new_window'] );
		$instance['sc_cache'] = $new_instance['sc_cache'] ;

		delete_transient('fans_count');
		delete_transient('twitter_followers');
		delete_transient('google_followers');
		delete_transient('instagram_followers');
		delete_transient('youtube_subscribers');

		delete_option('fans_count');
		delete_option('twitter_followers');
		delete_option('google_followers');
		delete_option('instagram_followers');
		delete_option('youtube_subscribers');

		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'sc_cache' => '600' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'sc_cache' ); ?>">Cache Period : </label>
			<input id="<?php echo $this->get_field_id( 'sc_cache' ); ?>" name="<?php echo $this->get_field_name( 'sc_cache' ); ?>" value="<?php echo $instance['sc_cache']; ?>" class="widefat" type="text" />
			<small>Time until expiration in seconds from now, or 0 for never expires. Ex: For one day, the expiration value would be: (60 * 60 * 24).
				Default: 0</small>

		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'new_window' ); ?>">Open links in a new window:</label>
			<input id="<?php echo $this->get_field_id( 'new_window' ); ?>" name="<?php echo $this->get_field_name( 'new_window' ); ?>" value="true" <?php if( $instance['new_window'] ) echo 'checked="checked"'; ?> type="checkbox" />
		</p>
		<p>
			<label>Please set Social Counter accounts under Appearance -> Magzilla Options -> Social Counter</label>
		</p>

	<?php
	}
}

if ( ! function_exists( 'magzilla_social_counter_loader' ) ) {
	function magzilla_social_counter_loader (){
		register_widget( 'magzilla_social_counter' );
	}
	add_action( 'widgets_init', 'magzilla_social_counter_loader' );
}

function magzilla_twitter_followers( $sc_cache ) {
	global $ft_option;

	$twitter_username = $ft_option['twitter_uname']; //favethemes';
	$consumer_key = $ft_option['twitter_com_key']; //'SnPUggAmh6l5Jg5ShSnjmo60a';
	$consumer_secret = $ft_option['twitter_com_secret']; //'NEz4WgydSOK2TMsBcDJh8fmavPFMSbYJafgrXXbnJVYBpyD6yG';
	$access_token = $ft_option['twitter_access_token']; //'924216925-tax01d22ZZCWasYPG0OATFZM9jVARhttDgIWdqzT';
	$access_token_secret  = $ft_option['twitter_access_token_secret']; //'RjndNuU9aPSK54jmGDsgp0eczHMbZgxsNF06aBKMmPfZ9';

	$api_url = 'https://api.twitter.com/1.1/users/show.json';
	$params = array(
		'method' => 'GET',
		'sslverify' => false,
		'timeout' => 60,
		'headers' => array(
			'Content-Type' => 'application/x-www-form-urlencoded',
			'Authorization' => ft_authorization(
				$twitter_username, $consumer_key, $consumer_secret, $access_token, $access_token_secret
			)
		)
	);

	$followers = get_transient('twitter_followers');

	if( empty( $followers ) ) {
		$connection = wp_remote_get( $api_url . '?screen_name=' . $twitter_username, $params );
		if ( ! is_wp_error( $connection ) ) {
			$body        = wp_remote_retrieve_body( $connection );
			$json_decode = json_decode( $body );
			$followers   = $json_decode->followers_count;
		} else {
			$followers = 0;
		}

		if( !empty( $followers ) ) {
			set_transient('twitter_followers', $followers,  $sc_cache );
			if( get_option('twitter_followers') != $followers ) {
				update_option('twitter_followers', $followers );
			}
		}

		if( $followers == 0 && get_option( 'twitter_followers') ) {
			$followers = get_option( 'twitter_followers' );

		} elseif( $followers == 0 && !get_option( 'twitter_followers') ) {
			$followers = 0;
		}

	}

	return $followers;
}

function magzilla_facebook_fans( $page_link, $sc_cache ) {
	$face_link = @parse_url($page_link);

	if( $face_link['host'] == 'www.facebook.com' || $face_link['host']  == 'facebook.com' ){
		$fans = get_transient('fans_count');

		if( empty( $fans ) ) {
			$rest_url = "http://api.facebook.com/restserver.php?format=json&method=links.getStats&urls=" . urlencode( $page_link );
			$response = wp_remote_get( $rest_url, array( 'timeout' => 120 ) );
			if ( is_array( $response ) ) {
				$body        = wp_remote_retrieve_body($response); // use the content
				$json_decode = json_decode( $body ); // json decode
				$fans = $json_decode[0]->like_count;
			} else {
				$fans = 0;
			}
			if( !empty( $fans ) ) {
				set_transient('fans_count', $fans, $sc_cache );
				if( get_option('fans_count') != $fans ) {
					update_option('fans_count', $fans );
				}
			}

			if( $fans == 0 && get_option( 'fans_count') ) {
				$fans = get_option( 'fans_count' );

			} elseif( $fans == 0 && !get_option( 'fans_count') ) {
				$fans = 0;
			}
		}

		return $fans;
	}
}

function magzilla_google_followers( $sc_cache ) {
	global $ft_option;

	$user_id = $ft_option['google_page_id']; //'107368668183878099300';
	$api_key = $ft_option['google_api_key'];//'AIzaSyCzBFEo7jqWcfrkqeHqKaDOrMRZ6_gISSo';

	$followers = get_transient( 'google_followers' );

	if( empty( $followers ) ) {
		$api_url = "https://www.googleapis.com/plus/v1/people/".$user_id."?key=".$api_key."";
		$params = array(
			'sslverify' => false,
			'timeout' => 60
		);
		$response = wp_remote_get( $api_url, $params );
		if( !is_wp_error( $response ) ) {
			$body = wp_remote_retrieve_body( $response );
			$json_decode = json_decode( $body );
			$followers = $json_decode->circledByCount;
		} else {
			$followers = 0;
		}

		if( !empty( $followers ) ) {
			set_transient( 'google_followers', $followers, $sc_cache );
			if( get_option( 'google_followers' ) != $followers )
				update_option('google_followers', $followers );
		}

		if( $followers == 0 && !get_option( 'google_followers' ) ) {
			$followers = 0;

		} elseif ( $followers == 0 && get_option( 'google_followers' ) ) {
			$followers = get_option( 'google_followers' );
		}

	}
	return $followers;
}

function magzilla_instagram_followers( $sc_cache ) {
	global $ft_option;

	$user_id = $ft_option['instagram_u_id'];//'1418205831';
	$accessToken = $ft_option['instagram_access_token'];//"1418205831.5b9e1e6.d3d38b310e734ad2accd434c9409b290";

	$followers = get_transient( 'instagram_followers' );

	if( empty( $followers ) ) {
		$api_url  = "https://api.instagram.com/v1/users/" . $user_id . "/?access_token=" . $accessToken . "";
		$params   = array(
			'sslverify' => false,
			'timeout'   => 60
		);
		$response = wp_remote_get( $api_url, $params );

		if ( ! is_wp_error( $response ) ) {
			$body        = wp_remote_retrieve_body( $response );
			$json_decode = json_decode( $body );
			$followers   = $json_decode->data->counts->followed_by;
		} else {
			$followers = 0;
		}

		if ( ! empty( $followers ) ) {
			set_transient( 'instagram_followers', $followers, $sc_cache );
			if ( get_option( 'instagram_followers' ) != $followers ) {
				update_option( 'instagram_followers', $followers );
			}
		}

		if ( $followers == 0 && ! get_option( 'instagram_followers' ) ) {
			$followers = 0;
		} elseif ( $followers == 0 && get_option( 'instagram_followers' ) ) {
			$followers = get_option( 'instagram_followers' );
		}
	}
	return $followers;

}

function magzilla_youtube_subscribers( $sc_cache ) {
	global $ft_option;

	$channel_id = $ft_option['yt_ch_id'];//'UCCYussvCX6h7fmcwS1AYQlA';
	$api_key = $ft_option['yt_ch_api'];//'AIzaSyBbDttChe2yU6fu-Ea3c-Eh3sbJbUtIi5o';

	$count = get_transient( 'youtube_subscribers' );

	if( empty( $count ) ) {
		$api_url = 'https://www.googleapis.com/youtube/v3/channels?part=statistics&id=' . $channel_id . '&key=' . $api_key;

		$connection = wp_remote_get( $api_url, array( 'timeout' => 60 ) );
		if ( ! is_wp_error( $connection ) ) {
			$body     = wp_remote_retrieve_body( $connection );
			$response = json_decode( $body, true );
			if ( isset( $response['items'][0]['statistics']['subscriberCount'] ) ) {
				$count = $response['items'][0]['statistics']['subscriberCount'];
			}
		} else {
			$count = 0;
		}

		if ( ! empty( $count ) ) {
			set_transient( 'youtube_subscribers', $count, $sc_cache );
			if ( get_option( 'youtube_subscribers' ) != $count ) {
				update_option( 'youtube_subscribers', $count );
			}
		}

		if ( $count == 0 && ! get_option( 'youtube_subscribers' ) ) {
			$count = 0;
		} elseif ( $count == 0 && get_option( 'youtube_subscribers' ) ) {
			$count = get_option( 'youtube_subscribers' );
		}
	}
	return $count;
}

/**
 *
 * @param int $count
 * @param string $format
 */
function ft_formatted_count($count, $format) {
	if($count==''){
		return '';
	}
	switch ($format) {
		case 'comma':
			$count = number_format($count);
			break;
		case 'short':
			$count = ft_abreviateTotalCount($count);
			break;
		default:
			break;
	}
	return $count;
}

/**
 *
 * @param integer $value
 * @return string
 */
function ft_abreviateTotalCount($value) {

	$abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

	foreach ($abbreviations as $exponent => $abbreviation) {

		if ($value >= pow(10, $exponent)) {

			return round(floatval($value / pow(10, $exponent)), 1) . $abbreviation;
		}
	}
}

/**
 *
 * @param type $user
 * @param type $consumer_key
 * @param type $consumer_secret
 * @param type $oauth_access_token
 * @param type $oauth_access_token_secret
 * @return string
 */
function ft_authorization($user, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret) {
	$query = 'screen_name=' . $user;
	$signature = ft_signature($query, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret);

	return ft_header($signature);
}

/**
 *
 * @param type $url
 * @param type $query
 * @param type $method
 * @param type $params
 * @return type string
 */
function ft_signature_base_string($url, $query, $method, $params) {
	$return = array();
	ksort($params);

	foreach ($params as $key => $value) {
		$return[] = $key . '=' . $value;
	}

	return $method . "&" . rawurlencode($url) . '&' . rawurlencode(implode('&', $return)) . '%26' . rawurlencode($query);
}

/**
 *
 * @param type $query
 * @param type $consumer_key
 * @param type $consumer_secret
 * @param type $oauth_access_token
 * @param type $oauth_access_token_secret
 * @return type array
 */
function ft_signature($query, $consumer_key, $consumer_secret, $oauth_access_token, $oauth_access_token_secret) {
	$oauth = array(
		'oauth_consumer_key' => $consumer_key,
		'oauth_nonce' => hash_hmac('sha1', time(), true),
		'oauth_signature_method' => 'HMAC-SHA1',
		'oauth_token' => $oauth_access_token,
		'oauth_timestamp' => time(),
		'oauth_version' => '1.0'
	);
	$api_url = 'https://api.twitter.com/1.1/users/show.json';
	$base_info = ft_signature_base_string($api_url, $query, 'GET', $oauth);
	$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);
	$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
	$oauth['oauth_signature'] = $oauth_signature;

	return $oauth;
}

/**
 * Build the header.
 *
 * @param  array $signature OAuth signature.
 *
 * @return string           OAuth Authorization.
 */
function ft_header($signature) {
	$return = 'OAuth ';
	$values = array();

	foreach ($signature as $key => $value) {
		$values[] = $key . '="' . rawurlencode($value) . '"';
	}

	$return .= implode(', ', $values);

	return $return;
}

?>