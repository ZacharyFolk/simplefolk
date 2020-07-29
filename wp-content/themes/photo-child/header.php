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
	// echo get_random_image();
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} ?>
<div id="page" class="site">
<a class="scroll-down" href="#" title="View latest posts">
	<header id="masthead" class="site-header clearfix" role="banner">
		<?php
			if(is_front_page() ) { ?>
				<?php random_home();
		} ?>
		<button type="button" class="scroll-down" type="button">
			<span><?php esc_html_e('menu','photograph');?></span><span></span><span></span></button>
	</header>
	</a>


	<div id="site-content-contain" class="site-content-contain">
		<div id="content" class="site-content">
