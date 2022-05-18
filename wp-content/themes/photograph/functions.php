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

add_action( 'after_setup_theme', 'photograph_setup' );


if(!function_exists('photograph_get_theme_options')):
	function photograph_get_theme_options() {
	    return wp_parse_args(  get_option( 'photograph_theme_options', array() ), photograph_get_option_defaults_values() );
	}
endif;

/***************************************************************************************/
require get_template_directory() . '/inc/customizer/photograph-default-values.php';
require get_template_directory() . '/inc/settings/photograph-functions.php';
require get_template_directory() . '/inc/settings/photograph-common-functions.php';

if (!is_child_theme()){
	require get_template_directory() . '/inc/welcome-notice.php';
}


/************************ Photograph Sidebar/ Widgets  *****************************/
require get_template_directory() . '/inc/widgets/widgets-functions/register-widgets.php';
require get_template_directory() . '/inc/widgets/widgets-functions/popular-posts.php';

/************************ Photograph Customizer  *****************************/
require get_template_directory() . '/inc/customizer/functions/sanitize-functions.php';
require get_template_directory() . '/inc/customizer/functions/register-panel.php';

function photograph_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'photograph_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'photograph_customize_partial_blogdescription',
		) );
	}
	
	require get_template_directory() . '/inc/customizer/functions/design-options.php';
	require get_template_directory() . '/inc/customizer/functions/theme-options.php';
	require get_template_directory() . '/inc/customizer/functions/color-options.php' ;
	require get_template_directory() . '/inc/customizer/functions/featured-content-customizer.php' ;
	require get_template_directory() . '/inc/customizer/functions/frontpage-features.php' ;
}
if(!class_exists('Photograph_Plus_Features')){
	if(!function_exists('webart_customize_register') && !function_exists('wedding_photos_customize_register')){
		// Add Upgrade to Plus Button.
		require_once( trailingslashit( get_template_directory() ) . 'inc/upgrade-plus/class-customize.php' );
	}
}

/** 
* Render the site title for the selective refresh partial. 
* @see photograph_customize_register() 
* @return void 
*/ 
function photograph_customize_partial_blogname() { 
bloginfo( 'name' ); 
} 

/** 
* Render the site tagline for the selective refresh partial. 
* @see photograph_customize_register() 
* @return void 
*/ 
function photograph_customize_partial_blogdescription() { 
bloginfo( 'description' ); 
}
add_action( 'customize_register', 'photograph_customize_register' );
/******************* Photograph Header Display *************************/
function photograph_header_display(){
	$photograph_settings = photograph_get_theme_options();
	$header_display = $photograph_settings['photograph_header_display'];
$photograph_header_display = $photograph_settings['photograph_header_display'];
if ($photograph_header_display == 'header_logo' || $photograph_header_display == 'header_text' || $photograph_header_display == 'show_both' || is_active_sidebar( 'photograph_header_banner' )) {

		if ($header_display == 'header_logo' || $header_display == 'header_text' || $header_display == 'show_both')	{
			echo '<div id="site-branding">';
			if($header_display != 'header_text'){
				photograph_the_custom_logo();
			}
			echo '<div id="site-detail">';
				if (is_home() || is_front_page()){ ?>
				<h1 id="site-title"> <?php }else{?> <h2 id="site-title"> <?php } ?>
				<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_html(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
				<?php if(is_home() || is_front_page()){ ?>
				</h1>  <!-- end .site-title -->
				<?php } else { ?> </h2> <!-- end .site-title --> <?php }

				$site_description = get_bloginfo( 'description', 'display' );
				if ($site_description){?>
					<div id="site-description"> <?php bloginfo('description');?> </div> <!-- end #site-description -->
			
		<?php }
		echo '</div></div>'; // end #site-branding
		}
			if( is_active_sidebar( 'photograph_header_banner' )){ ?>
				<div class="advertisement-box">
					<?php dynamic_sidebar( 'photograph_header_banner' ); ?>
				</div> <!-- end .advertisement-box -->
			<?php } 
		}
}
/************** Site Branding *************************************/
add_action('photograph_site_branding','photograph_header_display');

if ( ! function_exists( 'photograph_the_custom_logo' ) ) : 
 	/** 
 	 * Displays the optional custom logo. 
 	 * Does nothing if the custom logo is not available. 
 	 */ 
 	function photograph_the_custom_logo() { 
		if ( function_exists( 'the_custom_logo' ) ) { 
			the_custom_logo(); 
		}
 	} 
endif;

/************** Site Branding for sticky header and side menu sidebar *************************************/
add_action('photograph_new_site_branding','photograph_stite_branding_for_stickyheader_sidesidebar');

	function photograph_stite_branding_for_stickyheader_sidesidebar(){ 
		$photograph_settings = photograph_get_theme_options(); ?>
		<div id="site-branding">
			<?php	
			$photograph_header_display = $photograph_settings['photograph_header_display'];
			if ($photograph_header_display == 'header_logo' || $photograph_header_display == 'show_both') {
				photograph_the_custom_logo(); 
			}

			if ($photograph_header_display == 'header_text' || $photograph_header_display == 'show_both') { ?>
			<div id="site-detail">
				<div id="site-title">
					<a href="<?php echo esc_url(home_url('/'));?>" title="<?php echo esc_attr(get_bloginfo('name', 'display'));?>" rel="home"> <?php bloginfo('name');?> </a>
				</div>
				<!-- end #site-title -->
				<div id="site-description"><?php bloginfo('description');?></div> <!-- end #site-description -->
			</div><!-- end #site-detail -->
			<?php } ?>
		</div> <!-- end #site-branding -->
	<?php }