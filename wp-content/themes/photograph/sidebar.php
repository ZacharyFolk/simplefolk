<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
	$photograph_settings = photograph_get_theme_options();
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'photograph_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}

if( 'default' == $layout ) { //Settings from customizer
	if(($photograph_settings['photograph_sidebar_layout_options'] != 'nosidebar') && ($photograph_settings['photograph_sidebar_layout_options'] != 'fullwidth')){ ?>

<aside id="secondary" class="widget-area">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<aside id="secondary" class="widget-area">
  <?php }
	}?>
  <?php
	if( 'default' == $layout ) { //Settings from customizer
		if(($photograph_settings['photograph_sidebar_layout_options'] != 'nosidebar') && ($photograph_settings['photograph_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'photograph_main_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'photograph_main_sidebar' );
			echo '</aside><!-- end #secondary -->';
		}
	}

echo my_recent_posts();
