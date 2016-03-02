<?php
/*  ----------------------------------------------------------------------------
    Category Module D-B
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

	$img_1_width = '770'; $img_1_height = '500'; $fave_excerpt = '560';

} elseif( $fave_cat_sidebar_position == "right") {
	$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
	$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

	$img_1_width = '770'; $img_1_height = '500'; $fave_excerpt = '125';

} elseif( $fave_cat_sidebar_position == "left" ) {
	$column_one = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
	$column_two = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

	$img_1_width = '770'; $img_1_height = '500'; $fave_excerpt = '125';
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
			<div class="archive archive-6 post-archive main-box-for-load-more ">
				
			
				<!-- ==== start all post ==== -->
				
				<div class="fave-loop-wrap">

				<?php if( have_posts() ): while ( have_posts() ): the_post(); ?>


				<div id="ID-<?php the_ID(); ?>" <?php post_class('archive-post fave-post'); ?> <?php echo fave_get_item_scope(); ?>>
					<div class="row">
						
						<?php if( has_post_thumbnail() ): ?>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<div class="featured-image-wrap">
								<?php get_template_part( 'inc/article', 'icon' ); ?>
								<a href="<?php echo esc_url( get_permalink() ); ?>">
									<img itemprop="image" class="featured-image" width="<?php echo $img_1_width; ?>" height="<?php echo $img_1_height; ?>" src="<?php echo fave_featured_image( get_the_ID(), $img_1_width, $img_1_height , true, true, true ); ?>" alt="<?php the_title(); ?>">
								</a>
							</div><!-- featured-image-wrap -->
						</div><!-- col-lg-8 col-md-8 col-sm-8 col-xs-12 -->
						<?php endif; ?>

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<article class="post">
								<h2 itemprop="headline" class="post-title module-big-title"><a itemprop="url" href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a></h2>
								<ul class="list-inline post-meta">
									<?php get_template_part('inc/cat', 'meta'); ?>
								</ul><!-- .post-meta -->
								
								<?php if( $fave_cat_excerpt != 'disable' ): ?>
								<div class="post-content post-small-content" itemprop="articleBody">
									<p><?php echo fave_clean_excerpt( $fave_excerpt, 'true' ); ?></p>
								</div><!-- post-content -->
								<?php endif; ?>

							</article><!-- .post -->
						</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
					</div><!-- row -->
				</div>


				<?php endwhile; endif; ?>
				</div>	

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
