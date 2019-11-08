<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
/******************** PHOTOGRAPH CUSTOMIZE REGISTER *********************************************/
add_action( 'customize_register', 'photograph_customize_register_wordpress_default' );
function photograph_customize_register_wordpress_default( $wp_customize ) {
	$wp_customize->add_panel( 'photograph_wordpress_default_panel', array(
		'priority' => 5,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'WordPress Settings', 'photograph' ),
	) );
}

add_action( 'customize_register', 'photograph_customize_register_options');
function photograph_customize_register_options( $wp_customize ) {
	$wp_customize->add_panel( 'photograph_options_panel', array(
		'priority' => 6,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options', 'photograph' ),
	) );
}

add_action( 'customize_register', 'photograph_customize_register_featuredcontent' );
function photograph_customize_register_featuredcontent( $wp_customize ) {
	$wp_customize->add_panel( 'photograph_featuredcontent_panel', array(
		'priority' => 8,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Slider/ Video Options', 'photograph' ),
	) );
}

add_action( 'customize_register', 'photograph_customize_register_frontpage_options');
function photograph_customize_register_frontpage_options( $wp_customize ) {
	$wp_customize->add_panel( 'photograph_frontpage_panel', array(
		'priority' => 7,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Frontpage', 'photograph' ),
	) );
}

add_action( 'customize_register', 'photograph_customize_register_colors' );
function photograph_customize_register_colors( $wp_customize ) {
	$wp_customize->add_panel( 'colors', array(
		'priority' => 9,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Colors Section', 'photograph' ),
	) );
}