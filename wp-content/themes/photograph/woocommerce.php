<?php
/**
 * This template to displays woocommerce page
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */

get_header();
	$photograph_settings = photograph_get_theme_options();
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'photograph_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	} ?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php woocommerce_content(); ?>
		</main><!-- end #main -->
	</div> <!-- #primary -->
<?php 
if( 'default' == $layout ) { //Settings from customizer
	if(($photograph_settings['photograph_sidebar_layout_options'] != 'nosidebar') && ($photograph_settings['photograph_sidebar_layout_options'] != 'fullwidth')){ ?>
<aside id="secondary" class="widget-area">
	<?php }
} 
	if( 'default' == $layout ) { //Settings from customizer
		if(($photograph_settings['photograph_sidebar_layout_options'] != 'nosidebar') && ($photograph_settings['photograph_sidebar_layout_options'] != 'fullwidth')): ?>
		<?php dynamic_sidebar( 'photograph_woocommerce_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}
?>
</div><!-- end .wrap -->
<?php
get_footer();