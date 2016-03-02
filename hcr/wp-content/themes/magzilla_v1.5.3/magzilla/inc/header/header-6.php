<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 03/12/15
 * Time: 4:00 PM
 */
global $ft_option, $fave_container;
$sticky_nav = isset( $ft_option['desktop_sticky_nav'] ) ? $ft_option['desktop_sticky_nav'] : 0;
$menu_skin = $ft_option['header_6_skin'];
$menu_pos = $ft_option['header_6_menu_position'];
$logo_pos = $ft_option['header_6_logo_position'];

if( $logo_pos == 'center_align' ) {
	$css_class = 'col-xs-12 col-sm-12 col-md-12 col-lg-12';
	$text_align = 'text-center';
} else {
	$css_class = 'col-xs-4 col-sm-12 col-md-4 col-lg-4';
	$text_align = 'text-left';
}

?>

<div class="header-6 hidden-xs hidden-sm" itemscope itemtype="http://schema.org/WPHeader">

	<!-- header 1 -->
	<div class="<?php echo $fave_container; ?>">
		<div class="row" style="padding-top:50px;">
			<div class="<?php echo $css_class; ?>">
				<div class="logo-wrap <?php echo $text_align; ?>">
					<?php get_template_part('inc/header/logo'); ?>
				</div>
			</div>
			<?php if( $logo_pos != 'center_align' ): ?>
			<div class="col-xs-8 col-sm-12 col-md-8 col-lg-8">
				<?php if( !empty( $ft_option['header_ads_right_728_90'] ) ): ?>
					<div class="banner-right"><?php echo $ft_option['header_ads_right_728_90']; ?></div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="<?php echo esc_attr( $fave_container ); ?>">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<nav class="magazilla-main-nav <?php echo $menu_skin.' '.$menu_pos; ?> navbar yamm navbar-header-6" data-sticky="<?php echo $sticky_nav; ?>" >
					<div class="sticky_inner menu-hack">
					
						<?php
						// Pages Menu
						if ( has_nav_menu( 'main-menu' ) ) :
							wp_nav_menu( array (
								'theme_location' => 'main-menu',
								'container' => '',
								'container_class' => '',
								'menu_class' => 'nav navbar-nav',
								'menu_id' => 'main-nav',
								'depth' => 4,
								'walker' => new favethemes_Walker()
							));
						endif;
						?>
						<div id="logoCont">
						
						</div>
						<div id="social" style="height:2px">
						<div id="addthis" style="display:inline"></div>
						</div>
						
						<div id="drop" style="height:0px">
						<div class="dropdown" style="border-radius:25px">
						<button id="follow-button" class="btn" style="border-radius:25px; ">Follow
						</button>
							<ul class="dropdown-menu header-socials" style="border:none; background:none;box-shadow:none; margin-top:-10px;height:40px;">
								<li><a href="http://facebook.com/heartcenteredrebalancing" style="border:none;"><i class="fa fa-facebook"></i></a></li>
								<li><a href="http://youtube.com/heartcenteredrebalancing"style="border:none;"><i class="fa fa-youtube"></i></a></li>
								<li><a href="http://instagram.com/heartcenteredrebalancing"style="border:none;"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
						</div>
						<?php if( $ft_option['header_search'] != 0 ){ ?>
							<?php get_template_part('inc/header/search', 'form' ); ?>
						<?php } ?>
					</div>
					
				</nav><!-- navbar -->
			</div>
		</div>
	</div>

</div><!-- header-6 -->