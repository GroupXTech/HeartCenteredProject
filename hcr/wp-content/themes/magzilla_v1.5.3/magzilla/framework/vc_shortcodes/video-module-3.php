<?php
/*-----------------------------------------------------------------------------------*/
/*	Video Module 3
/*-----------------------------------------------------------------------------------*/

function fav_video_module_3( $atts, $content = null )
{
	extract( shortcode_atts( array(
		'module_9_type'		=> '',
		'category_id'		=> '',
		'sort'	  			=> '',
		'autors_id'	  		=> '',
		'posts_limit'	  	=> '',
		'offset'	 	 	=> '',
		'header_color'	  	=> '',
		'header_text_color' => '',
		'header_border_color' => '',
		'custom_title'	  	=> '',
		'custom_url'	 	=> '',
		'hide_title'		=> '',
		'title_style'	 	=> '',
		'module_space'		=> '',
		'module_meta'   => '',
		'author_name'   => '',
		'time_diff'    => '',
		'post_date'     => '',
		'post_time'     => '',
		'post_view_count'    => '',
		'post_comment_count' => '',
		'module_bg' => '',
		'module_padding' => ''
    ), $atts ) );
	
	ob_start();

	$css_class_3 = '';
	if( $module_9_type == "sidebar_template" ) {

			$css_class_1 = "col-lg-9 col-md-9 col-sm-12 col-xs-12";
			$css_class_2 = "col-lg-3 col-md-3 col-sm-12 col-xs-12";
			$css_class_3 = "with-sidebar";

	} else {

			$css_class_1 = "col-lg-6 col-md-6 col-sm-12 col-xs-12";
			$css_class_2 = "col-lg-2 col-md-2 col-sm-12 col-xs-12";
	}

	$style = $bg = $padding = '';
	if( !empty( $module_bg ) ) {
		$bg = "background-color:".$module_bg.";";
	}
	if( !empty( $module_padding ) ) {
		$padding = "padding:".$module_padding.";";
	}

	if( !empty( $bg ) || !empty( $padding ) ) {
		$style = 'style="' . $bg . ' ' . $padding . '"';
	}

    //do the query
    $the_query = fave_video_post_type_data_source::get_wp_query($atts); //by ref  do the query

	?>
	

	<div class="module-9 video" <?php echo $style; ?>>
		
		<?php if ( $hide_title != 'hide_title' ) { ?>
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="module-top clearfix">
					
					<?php
					//get the block title
					echo fave_get_video_block_title( $atts ); ?>

				</div><!-- .module-top -->
			</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->
		</div><!-- .row -->
		<?php } ?>


		<div class="row <?php if(!empty($module_space)){ echo $module_space; }?>">
			
			<?php

			$count = 0;
			
			while ( $the_query->have_posts() ): $the_query->the_post();
				$count++;
				
			?>
				<div class="<?php echo $css_class_1; ?>">
					<div class="thumb big-thumb <?php echo ($css_class_3); ?>">
						<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
						<div class="thumb-content">
							<h2 class="gallery-title-small"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
							<ul class="list-inline post-meta">
								<?php fave_vc_video_modules_meta( $module_meta, $author_name, $time_diff, $post_date, $post_time, $post_view_count, $post_comment_count ); ?>
							</ul><!-- .post-meta -->
						</div>
						<div class="slide-image-wrap slider-with-animation">
							<img class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 722, 406, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</div><!-- slide-image-wrap -->
					</div><!-- thumb -->
				</div>
				
				<?php
				
				if ($count == 1 ) {
					break;
				}

			endwhile;
			?>
			
			
			<?php $posts_limit = $posts_limit - 1; $loop = $post_counter = 0; ?>

			<?php while ( $the_query->have_posts() ): $the_query->the_post();  $loop++; $post_counter++;?>


				<?php if( $loop == 1 ) { ?>
				<div class="<?php echo $css_class_2; ?>">
				<?php } ?>

					<div class="thumb small-thumb" >
						<a href="<?php echo esc_url( get_permalink() ); ?>"></a>
						<div class="thumb-content">
							<h2 class="gallery-title-small"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						</div>
						<div class="slide-image-wrap slider-with-animation">
							<div class="post-type-icon"><i class="fa fa-video-camera"></i></div>
							<img class="featured-image" src="<?php echo fave_featured_image( get_the_ID(), 227, 127, true, true, true ); ?>" alt="<?php the_title(); ?>">
						</div><!-- slide-image-wrap -->
					</div><!-- thumb -->
				
				<?php if( ( $loop == 3 ) || ( $post_counter == $posts_limit ) ) { $loop = 0; ?>	
				</div>
				<?php } ?>

			<?php endwhile; ?>
			
			<?php
			/* Restore original Post Data */
			wp_reset_postdata();
			?>

		</div><!-- .row -->
	</div><!-- .module-9 -->
    

	<?php 
	$result = ob_get_contents();  
	ob_end_clean();
	return $result;
	   
	}

add_shortcode('fav-video-module-3', 'fav_video_module_3');
?>