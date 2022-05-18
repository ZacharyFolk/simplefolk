<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('photograph_theme_options') ) {
		set_theme_mod( 'photograph_theme_options', photograph_get_option_defaults_values() );
	}
/********************* PHOTOGRAPH RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function photograph_responsiveness() {
	$photograph_settings = photograph_get_theme_options();
	if( $photograph_settings['photograph_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width" />
	<?php } else { ?>
	<meta name="viewport" content="width=1280" />
	<?php  }
}
add_filter( 'wp_head', 'photograph_responsiveness');


/**************************** SOCIAL MENU *********************************************/
function photograph_social_links_display() {
		if ( has_nav_menu( 'social-link' ) ) : ?>
	<div class="social-links clearfix">
	<?php
		wp_nav_menu( array(
			'container' 	=> '',
			'theme_location' => 'social-link',
			'depth'          => 1,
			'items_wrap'      => '<ul>%3$s</ul>',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		) );
	?>
	</div><!-- end .social-links -->
	<?php endif; ?>
<?php }
add_action ('photograph_social_links', 'photograph_social_links_display');

/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function photograph_scripts() {
	$photograph_settings = photograph_get_theme_options();


	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	
	if($photograph_settings['photograph_disable_fancy_box']==0){
		wp_enqueue_style('fancybox-css', get_template_directory_uri().'/assets/fancybox/css/jquery.fancybox.min.css');
		wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/fancybox/js/jquery.fancybox.min.js', array('jquery'), false, true);
		wp_enqueue_script('photograph-fancybox-settings', get_template_directory_uri().'/assets/fancybox/js/fancybox-settings.js', array('fancybox'), false, true);
	}


	if( $photograph_settings['photograph_responsive'] == 'on' ) {
		wp_enqueue_style('photograph-responsive', get_template_directory_uri().'/css/responsive.css');
	}
}

add_action( 'wp_enqueue_scripts', 'photograph_scripts' );

