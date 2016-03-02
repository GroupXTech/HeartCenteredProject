<?php
/*
Plugin Name: Favethemes Themes - Functionality
Plugin URI:  http://themeforest.net/user/favethemes
Description: Adds functionality to Favethemes Themes
Version:     1.4
Author:      Favethemes
Author URI:  http://themeforest.net/user/favethemes
License:     GPL2
*/

class Favethemes_Functionality {

	/**
     * Constructor
     *
     * @since 1.0
     *
    */
    public function __construct() {
        $this->favethemes_constants();
    	$this->favethemes_inc_files();
    }

    /**
     * Define constants
     *
     * @since 1.0
     *
    */
    protected function favethemes_constants() {

        /**
         * Plugin Path
         */
        define( 'FAVE_FUNC_PATH', plugin_dir_path( __FILE__ ) );

    }

    /**
     * include files
     *
     * @since 1.0
     *
    */
    function favethemes_inc_files() {
    	$fave_theme_name = (wp_get_theme()->Name);
    	
    	if( $fave_theme_name == 'Magzilla' ) {

    		//Custom Post Types
    		require_once ( FAVE_FUNC_PATH . 'post-types/gallery-post-type.php' );
    		require_once ( FAVE_FUNC_PATH . 'post-types/video-post-type.php' );

    		// Widgets
    		require_once( FAVE_FUNC_PATH . '/widgets/magazilla-latest-posts.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-latest-videos.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-latest-galleries.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-image-banner-300-250.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-image-banner-336-280.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-image-banner-180-150.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-instagram.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-latest-comments.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-flickr-photos.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-code-banner.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-video.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-latest-reviews.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-tabs.php' );
			require_once( FAVE_FUNC_PATH . '/widgets/magazilla-authors.php' );
            require_once( FAVE_FUNC_PATH . '/widgets/magazilla-twitter.php' );
		    require_once( FAVE_FUNC_PATH . '/widgets/magazilla-facebook.php' );
		    require_once( FAVE_FUNC_PATH . '/widgets/magzilla-soundcloud.php' );
		    require_once( FAVE_FUNC_PATH . '/widgets/magzilla-google.php' );
		    require_once( FAVE_FUNC_PATH . '/widgets/magzilla-youtube.php' );

		    require_once( FAVE_FUNC_PATH . '/widgets/magzilla-social.php' );
		    require_once( FAVE_FUNC_PATH . '/widgets/magzilla-social-counter.php' );
		    require_once( FAVE_FUNC_PATH . '/widgets/magzilla-feedburner.php' );
    	}

    }


}

/**
 * Instantiate the Class
 *
 * @since     1.0
 * @global    object
 */
$Favethemes_Functionality = new Favethemes_Functionality();
?>