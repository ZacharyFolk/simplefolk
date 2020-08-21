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
	<header id="masthead" class="site-header clearfix" role="banner">
		<?php
			if(is_front_page() ) { ?>
				<?php random_home();
		} ?>
		<div class="main-nav-wrap">

		<nav id="site-navigation" class="main-navigation clearfix" role="navigation">
			<span class="home-link">
				<?php echo (is_front_page()) ? 'Zachary Folk Photography' : '<a href="https://folkphotography.com">Zachary Folk Photography</a>';  ?>
			</span>

		<?php
			$args = array(
			'theme_location' => 'primary',
			'container'      => '',
			'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
			); ?>
			<?php wp_nav_menu($args);
 ?>
		</nav>

	</div>
		<button type="button" class="scroll-down" type="button">
			<span><?php esc_html_e('menu','photograph');?></span><span></span><span></span></button>
	</header>



	<div id="site-content-contain" class="site-content-contain">
		<div id="content" class="site-content">
