<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
/********************* Color Option **********************************************/
	$wp_customize->add_section( 'color_styles', array(
		'title' 						=> __('Color Options','photograph'),
		'priority'					=> 10,
		'panel'					=>'colors'
	));

	$wp_customize->add_section( 'colors', array(
		'title' 						=> __('Background Color Options','photograph'),
		'priority'					=> 100,
		'panel'					=>'colors'
	));

	$wp_customize->add_setting( 'theme_color_styles', array(
		'default'				=> '#fd513b',
		'sanitize_callback'	=> 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color_styles', array(
		'description'       => __( 'Theme Color Styles', 'photograph' ),
		'section'     => 'color_styles',
		'priority'					=> 10,
	) ) );