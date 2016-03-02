<?php global $ft_option, $fave_container, $magzilla_allowedtags; ?>

<div class="bottom-footer">
<div class="row" style="padding:10px;">  
            <ul class="col-lg-2 col-lg-offset-2"style="list-style:none;" >
                <li><a href="http://heartcenteredrebalancing.com/about-us/">About Us</a></li>
                <li><a href="http://heartcenteredrebalancing.com/contact-us-2/">Contact Us</a></li>
                <li><a href="http://heartcenteredrebalancing.com/advertising_commitment/">Advertising Commitment</a></li>
                <li><a href="http://heartcenteredrebalancing.com/dmca-removal/">DMCA / Removal</a></li>
            </ul>
        
        
            <ul class="col-lg-2" style="list-style:none;width:150px;">
                <li><a href="http://heartcenteredrebalancing.com/privacy-policy/">Privacy Policy</a></li>
                <li><a href="/section/tos">Terms of Service</a></li>
                <li><a href="http://heartcenteredrebalancing.com/disclaimer/">Disclaimer</a></li>
				<li><a href="http://heartcenteredrebalancing.com/why-cookies/">We Use Cookies</a></li>
            </ul>
           
	
			
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
				
				<?php
                // Pages Menu
                if ( has_nav_menu( 'footer-menu' ) ) :
                    wp_nav_menu( array (
                        'theme_location' => 'footer-menu',
                        'container' => '',
                        'container_class' => '',
                        'menu_class' => 'nav navbar-nav navbar-right',
                        'menu_id' => 'footer-nav',
                        
                     ));
                 endif;
                ?>

			</div>
	
        </div>
		<div class="row" style="padding:10px;"> 
		<div class="col-lg-12 col-md-12" style="text-align:center;margin-top:-20px;">
				<p><?php if( !empty($ft_option['copyright_text']) ) { echo wp_kses( $ft_option['copyright_text'], $magzilla_allowedtags ); } ?></p>
			</div>
			</div>
</div><!-- bottom-footer -->