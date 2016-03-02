<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 30/11/15
 * Time: 1:16 PM
 */
if (   ! is_active_sidebar( 'footer-col-1'  ) )
	return;

global $ft_option, $fave_container;
?>
<div class="top-footer">
	<div class="<?php echo esc_attr( $fave_container ); ?>">
		<div class="row">
			
			<?php if ( is_active_sidebar( 'footer-col-1' ) ) : ?>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  <div class="footer-col-left">
            <ul class="footer-list-link">
                <li><a href="/section/about">About Us</a></li>
                <li><a href="/section/contact-us">Contact Us</a></li>
                <li><a href="/section/advertising-commitment">Advertising Commitment</a></li>
                <li><a href="/section/dmca-removal">DMCA / Removal</a></li>
            </ul>
        </div>
        <div class="footer-col-right">
            <ul class="footer-list-link">
                <li><a href="/section/privacy-policy">Privacy Policy</a></li>
                <li><a href="/section/tos">Terms of Service</a></li>
                <li><a href="/section/disclaimer">Disclaimer</a></li>
            </ul>
            <p class="copy">&copy; 2016 Higher Perspective, LLC</p>
        </div>
					<?php dynamic_sidebar( 'footer-col-1' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div><!-- top-footer -->