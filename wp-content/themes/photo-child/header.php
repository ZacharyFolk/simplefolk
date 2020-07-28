<?php
/**
 * Displays the header content
 *
 * @package photo-child
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif;
wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#site-content-contain"><?php esc_html_e('Skip to content','photograph');?></a>
	<!-- Masthead ============================================= -->
	<header id="masthead" class="site-header clearfix" role="banner">
		<?php
			if(is_front_page() ) { ?>
				<!-- Video and image header ============================================= -->
				<?php photograph_video_category_sliders();
		} ?>
		<button type="button" class="scroll-down" type="button"><span><?php esc_html_e('menu','photograph');?></span><span></span><span></span></button><!-- Scroll Down Button -->
	</header> <!-- end #masthead -->
	<!-- Main Page Start ============================================= -->
	<div id="site-content-contain" class="site-content-contain">
		<div id="content" class="site-content">
