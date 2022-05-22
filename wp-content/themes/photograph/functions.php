<?php
/**
 * Display all photograph functions and definitions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */

/************************************************************************************************/
if ( ! function_exists( 'photograph_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function photograph_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
			$content_width=1920; // if gallery used in home page with default template, this will display in full width
	}

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('post-thumbnails');

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Main Menu', 'photograph' ),
		'side-nav-menu' => __( 'Side Menu', 'photograph' ),
		'social-link'  => __( 'Add Social Icons Only', 'photograph' ),
	) );

}
endif; // photograph_setup

// add_action( 'after_setup_theme', 'photograph_setup' );


if(!function_exists('photograph_get_theme_options')):
	function photograph_get_theme_options() {
	    return wp_parse_args(  get_option( 'photograph_theme_options', array() ), photograph_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/photograph-default-values.php';
// require get_template_directory() . '/inc/settings/photograph-functions.php';
// require get_template_directory() . '/inc/settings/photograph-common-functions.php';

if (!is_child_theme()){
	require get_template_directory() . '/inc/welcome-notice.php';
}





