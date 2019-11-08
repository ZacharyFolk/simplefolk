<?php
/**
 * The template for displaying the footer.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */

$photograph_settings = photograph_get_theme_options(); ?>
</div><!-- end #content -->
<!-- Footer Start ============================================= -->
<footer id="colophon" class="site-footer" role="contentinfo">
<?php
 if ( is_front_page() && is_home() ) {
	if ((function_exists('display_instagram')) && $photograph_settings['photograph_instagram_feed_display'] ==0){
		echo do_shortcode('[instagram-feed]');
	}// Default homepage
} elseif ( is_front_page()){
	if ((function_exists('display_instagram')) && $photograph_settings['photograph_instagram_feed_display'] ==0){
		echo do_shortcode('[instagram-feed]');
	}//Static homepage
} else {
//silence is golden
}
$footer_column = $photograph_settings['photograph_footer_column_section'];
	if( is_active_sidebar( 'photograph_footer_1' ) || is_active_sidebar( 'photograph_footer_2' ) || is_active_sidebar( 'photograph_footer_3' ) || is_active_sidebar( 'photograph_footer_4' )) { ?>
	<div class="widget-wrap">
		<div class="wrap">
			<div class="widget-area">
			<?php
				if($footer_column == '1' || $footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.absint($footer_column).'">';
					if ( is_active_sidebar( 'photograph_footer_1' ) ) :
						dynamic_sidebar( 'photograph_footer_1' );
					endif;
				echo '</div><!-- end .column'.absint($footer_column). '  -->';
				}
				if($footer_column == '2' ||  $footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.absint($footer_column).'">';
					if ( is_active_sidebar( 'photograph_footer_2' ) ) :
						dynamic_sidebar( 'photograph_footer_2' );
					endif;
				echo '</div><!--end .column'.absint($footer_column).'  -->';
				}
				if($footer_column == '3' || $footer_column == '4'){
				echo '<div class="column-'.absint($footer_column).'">';
					if ( is_active_sidebar( 'photograph_footer_3' ) ) :
						dynamic_sidebar( 'photograph_footer_3' );
					endif;
				echo '</div><!--end .column'.absint($footer_column).'  -->';
				}
				if($footer_column == '4'){
				echo '<div class="column-'.absint($footer_column).'">';
					if ( is_active_sidebar( 'photograph_footer_4' ) ) :
						dynamic_sidebar( 'photograph_footer_4' );
					endif;
				echo '</div><!--end .column'.absint($footer_column).  '-->';
				}
				?>
			</div> <!-- end .widget-area -->
		</div><!-- end .wrap -->
	</div> <!-- end .widget-wrap -->
	<?php } ?>
	<div class="site-info"  <?php if($photograph_settings['photograph_img-upload-footer-image'] !=''){?>style="background-image:url('<?php echo esc_url($photograph_settings['photograph_img-upload-footer-image']); ?>');" <?php } ?>>
		<div class="wrap">
			<div class="copyright-wrap clearfix">
				<?php
				 
				 if ( is_active_sidebar( 'photograph_footer_options' ) ) :
					dynamic_sidebar( 'photograph_footer_options' );
				else: ?>
					<div class="copyright">
						<a title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" target="_blank" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name', 'display' ); ?></a> | 
									<?php esc_html_e('Designed by:','photograph'); ?> <a title="<?php echo esc_attr__( 'Theme Freesia', 'photograph' ); ?>" target="_blank" href="<?php echo esc_url( 'https://themefreesia.com' ); ?>"><?php esc_html_e('Theme Freesia','photograph');?></a> |
									<?php  date_i18n(__('Y','photograph')) ; ?> <a title="<?php echo esc_attr__( 'WordPress', 'photograph' );?>" target="_blank" href="<?php echo esc_url( 'https://wordpress.org' );?>"><?php esc_html_e('WordPress','photograph'); ?></a> | <?php echo '&copy; ' . esc_attr__('Copyright All right reserved ','photograph'); ?>
						<?php
							if ( function_exists( 'the_privacy_policy_link' ) ) { 
								the_privacy_policy_link( ' | ', '<span role="separator" aria-hidden="true"></span>' );
							}
							?>
					</div>
				<?php endif;

				if($photograph_settings['photograph_buttom_social_icons'] == 0):
					do_action('photograph_social_links');
				endif; ?>
			</div> <!-- end .copyright-wrap -->
			<div style="clear:both;"></div>
		</div> <!-- end .wrap -->
	</div> <!-- end .site-info -->
	<?php
		$disable_scroll = $photograph_settings['photograph_scroll'];
		if($disable_scroll == 0):?>
			<button type="button" class="go-to-top">
				<span class="icon-bg"></span>
					<i class="fa fa-angle-up back-to-top-text"></i>
					<i class="fa fa-angle-double-up back-to-top-icon"></i>
			</button>
	<?php endif; ?>
	<div class="page-overlay"></div>
</footer> <!-- end #colophon -->
</div><!-- end .site-content-contain -->
</div><!-- end #page -->
<?php wp_footer(); ?>
</body>
</html>