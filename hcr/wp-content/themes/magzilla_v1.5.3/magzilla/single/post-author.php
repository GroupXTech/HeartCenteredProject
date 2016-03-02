<?php
//
// post author template
//
global $ft_option;
?>
<div class="post-author">
	<div class="media">
		
		<?php if( isset( $ft_option['single_author_pic'] ) && $ft_option['single_author_pic'] != 0 ) { ?>
		<div class="media-left media-top">
			<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<img itemprop="image" class="media-object img-circle post-author-avatar" src="<?php echo fave_get_avatar_url(get_avatar( get_the_author_meta( 'ID' ), 50 )); ?>" alt="avatar" />
			</a>
		</div>
		<?php } ?>

		<div class="media-body">
			<ul class="list-inline post-meta">
				
				By<?php if( isset( $ft_option['single_author_name'] ) && $ft_option['single_author_name'] != 0 ) { ?>
				<li class="post-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php esc_attr( the_author_meta( 'display_name' )); ?></a></li>
				<!-- <li>|</li> -->
				<?php } ?>

				<?php if( isset( $ft_option['single_author_social_link'] ) && $ft_option['single_author_social_link'] != 0 ) { ?>
				<li class="post-author-social-links">
					<?php if( get_the_author_meta('fave_author_flickr') ) { ?>
					<a class="flickr-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_flickr') ); ?>"><i class="fa fa-flickr"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_pinterest') ) { ?>
					<a class="pinterest-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_pinterest') ); ?>"><i class="fa fa-pinterest-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_youtube') ) { ?>
					<a class="youtube-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_youtube') ); ?>"><i class="fa fa-youtube-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_foursquare') ) { ?>
					<a class="foursquare-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_foursquare') ); ?>"><i class="fa fa-foursquare"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_instagram') ) { ?>
					<a class="instagram-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_instagram') ); ?>"><i class="fa fa-instagram"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_twitter') ) { ?>
					<a class="twitter-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_twitter') ); ?>"><i class="fa fa-twitter-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_vimeo') ) { ?>
					<a class="vimeo-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_vimeo') ); ?>"><i class="fa fa-vimeo-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_facebook') ) { ?>
					<a class="facebook-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_facebook') ); ?>"><i class="fa fa-facebook-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_google_plus') ) { ?>
					<a class="google-plus-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_google_plus') ); ?>"><i class="fa fa-google-plus-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_linkedin') ) { ?>
					<a class="linkedin-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_linkedin') ); ?>"><i class="fa fa-linkedin-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_tumblr') ) { ?>
					<a class="tumblr-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_tumblr') ); ?>"><i class="fa fa-tumblr-square"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('fave_author_dribbble') ) { ?>
					<a class="dribbble-icon" href="<?php echo esc_url( get_the_author_meta('fave_author_dribbble') ); ?>"><i class="fa fa-dribbble"></i></a>
					<?php } ?>

					<?php if( get_the_author_meta('user_email') ) { ?>
					<a class="envelope-icon" href="mailto:<?php echo get_the_author_meta('user_email' ); ?>"><i class="fa fa-envelope"></i></a>
					<?php } ?>
				</li>
				<?php } ?>

			

				<?php if( isset( $ft_option['single_views'] ) && $ft_option['single_views'] != 0 ) { ?>
				<li class="post-total-shares"><i class="fa fa-eye"></i> <?php echo number_format_i18n( fave_getViews( get_the_id() ), 0 ); ?></li>
				<!-- <li>|</li> -->
				<?php } ?>

				<?php if( isset( $ft_option['single_post_comment_count'] ) && $ft_option['single_post_comment_count'] != 0 ) { ?>
				<?php if ( comments_open() ) { ?>
				<li class="post-total-comments">
					<?php comments_popup_link(__('<i class="fa fa-comment-o"></i> 0', 'magzilla'), __('<i class="fa fa-comment-o"></i> 1', 'magzilla'), __('<i class="fa fa-comment-o"></i> %', 'magzilla'), 'comments', ''); ?>
				</li>
				<?php } ?>
				<?php } ?>
				
			</ul><!-- post-meta -->
		</div><!-- media-body -->
	</div><!-- media -->
</div><!-- post-author -->