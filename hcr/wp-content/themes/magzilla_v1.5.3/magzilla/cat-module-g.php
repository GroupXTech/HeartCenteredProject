<?php
/*  ----------------------------------------------------------------------------
    Category Module G
 */
global $ft_option;
global $cur_cat_obj;
global $fave_cat_color;
global $fave_cat_module;
global $fave_cat_sidebar_position;
global $fave_sidebar;
global $fave_cat_excerpt;
global $fave_show_child_cat;
global $fave_cat_pagination;
global $fave_container;
global $fave_cat_id;
global $stick_sidebar;

if( $fave_cat_sidebar_position == "none" ) {
	$column_one = "col-lg-12 col-md-12 col-sm-12 col-xs-12";

	$img_1_width = '670'; $img_1_height = '502';

} elseif( $fave_cat_sidebar_position == "right") {
	$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
	$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

	$img_1_width = '437'; $img_1_height = '327';

} elseif( $fave_cat_sidebar_position == "left" ) {
	$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
	$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

	$img_1_width = '437'; $img_1_height = '327';
}

?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<?php get_template_part( 'inc/cat', 'head' ); ?>
    </div>
</div>

<div class="row">
		
	<div class="<?php echo $column_one; ?>">
		<main class="site-main" role="main">
			<div class="archive archive-g post-archive main-box-for-load-more ">
				
				
				<div class="fave-loop-wrap">
				<div class="row fave-post">
				<?php
				$count = 0;

				if( have_posts() ): while ( have_posts() ): the_post();  $count++; ?>

					<!-- ==== start first post ==== -->
					<div id="ID-<?php the_ID(); ?>" <?php post_class('col-lg-7 col-md-7 col-sm-12 col-xs-12'); ?> <?php echo fave_get_item_scope(); ?>>
						
						<?php if( has_post_thumbnail() ): ?>
						<div class="featured-image-wrap">
							<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
							<?php get_template_part( 'inc/article', 'icon' ); ?>
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<img itemprop="image" class="featured-image" width="<?php echo $img_1_width; ?>" height="<?php echo $img_1_height; ?>" src="<?php echo fave_featured_image( get_the_ID(), $img_1_width, $img_1_height , true, true, true ); ?>" alt="<?php the_title(); ?>">
							</a>
						</div><!-- featured-image-wrap -->
						<?php endif; ?>

						<article class="post-g">
							<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
							<ul class="list-inline post-meta">
								<?php get_template_part('inc/cat', 'meta'); ?>
							</ul><!-- .post-meta -->
							<?php if( $fave_cat_excerpt != 'disable' ) { ?>
							<div class="post-content" itemprop="articleBody">
								<p><?php echo fave_clean_excerpt( '250', 'true' ); ?></p>
							</div><!-- post-content -->
							<?php } ?>

						</article><!-- .module-1-l-post -->
					</div>


				<?php

				if( $count == 1 ) { break; }

				endwhile; endif;
	
				?>
				
				
				<!-- ==== start all post ==== -->
				<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">	
				<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>

				
					<article id="ID-<?php the_ID(); ?>" <?php post_class('post-g'); ?> <?php echo fave_get_item_scope(); ?>>
						<div class="category-label-wrap">
							<div class="category-label"><?php get_template_part('inc/post', 'cats'); ?></div>
						</div><!-- category-label-wrap -->
						<h2 itemprop="headline" class="post-title module-small-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
						<ul class="list-inline post-meta">
							<?php get_template_part('inc/cat', 'meta'); ?>
						</ul><!-- .post-meta -->
					</article><!-- .module-1-r-post -->
				

				<?php endwhile; endif; ?>
				</div><!-- col-lg-5 col-md-5 col-sm-12 col-xs-12 -->
				</div><!-- .fave-post -->
				</div><!-- .fave-loop-wrap -->
				

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<?php get_template_part('inc/pagination/'. $fave_cat_pagination); ?>
					</div>
				</div>
				
			</div><!-- archive post-archive -->
		</main><!-- site-main -->
	</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->

	<?php if( $fave_cat_sidebar_position != "none" ): ?>
	
	<div class="<?php echo $column_two.' '.$stick_sidebar; ?>">
		<?php get_sidebar(); ?>
	</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
	
	<?php endif; ?>

</div><!-- .row -->
