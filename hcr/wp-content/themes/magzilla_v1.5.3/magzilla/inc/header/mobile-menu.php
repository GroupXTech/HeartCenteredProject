
<?php global $ft_option; ?>

<?php $mobile_sticky_nav = isset( $ft_option['mobile_sticky_nav'] ) ? $ft_option['mobile_sticky_nav'] : 0; ?>

<nav class="navbar mobile-menu hidden-lg visible-xs visible-sm"  data-sticky="<?php echo $mobile_sticky_nav; ?>">

	<div class="container-fluid">
	<div class="container col-xs-3 col-xs-offset-1">
	<div class="nav_logo">
	<a href="" ><img src="http://heartcenteredrebalancing.com/wp-content/uploads/2016/02/hcrlogo-1.png" style="width:75px" alt=""> </a>
	</div>
	</div>
<div class="container" style="padding-top: 8px;">

<div id="mobileFollow" style="visibility:hidden" class=" col-xs-6  col-sm-6 col-lg-6 "style="z-index:9999; ">
<div class="panel panel-default" style="background:none;box-shadow: 0 0px 0px rgba(0,0,0,.0); border:none;">
    <div class="panel-heading" role="tab" id="headingTwo" style="background-color:#DB2BCC;background-image:none; border-radius:25px;">
      <h4 class="panel-title" style="text-align:center;">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
     <span style="color:white;">Follow</span>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="background-color:transparent;">
	<div class="container">
	<div class="row">
	<div class= " header-socials "style="padding-top:10px">
       <a class="col-xs-4 col-sm-3"href="http://facebook.com/heartcenteredrebalancing" style="border:none; margin-left:-20px"><i class="fa fa-facebook"></i></a>
	   <a class="col-xs-4 col-sm-3"href="http://youtube.com/heartcenteredrebalancing"style="border:none;"><i class="fa fa-youtube"></i></a>
	   <a class="col-xs-1"href="http://instagram.com/heartcenteredrebalancing"style="border:none;left:9px;"><i class="fa fa-instagram"></i></a>
	</div>
	</div>
    </div>
  </div>
  </div><div id="companyName"style="visibility:visible; position:absolute;top:0px; font-size:15px;font-weight:800;"><p >Heart Centered Rebalancing</p></div>
  </div>
  
</div>
		<div class="navbar-header"style="border-bottom:none">
			<button type="button" class="navbar-toggle mobile-menu-btn collapsed" data-toggle="collapse" data-target="#mobile-menu" aria-expanded="false">
				<span class="sr-only"><?php _e("Toggle navigation","magzilla"); ?></span>
				<i class="fa fa-bars"></i>
			</button>
			<button type="button" class="navbar-toggle collapsed mobile-search-btn" data-toggle="collapse" data-target="#mobile-search" aria-expanded="false">
				<span class="sr-only"><?php _e("Toggle navigation","magzilla"); ?></span>
				<i class="fa fa-search"></i>
			</button>
		</div>

		<div class="navbar-collapse collapse mobile-menu-collapse" id="mobile-menu" >
	
			<?php
			// Pages Menu
			if ( has_nav_menu( 'mobile-menu' ) ) :
				wp_nav_menu( array (
					'theme_location' => 'mobile-menu',
					'container' => '',
					'container_class' => '',
					'menu_class' => 'nav navbar-nav',
					'menu_id' => 'favethemes_mobile_nav',
					'depth' => 3,
					'walker' => new favethemes_mobile_nav()
				));
			endif;
			?>
			
		</div>

		<div class="collapse navbar-collapse" id="mobile-search">
			<form class="navbar-form navbar-search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="text" name="s" id="s_mobile" class="form-control" placeholder="<?php _e("Search","magzilla"); ?>">
			</form>
		</div>

	</div> <!-- end container-fluid -->
	<!-- mobile-menu-layer -->
	
	<div class="mobile-menu-layer"></div>
	
</nav>
