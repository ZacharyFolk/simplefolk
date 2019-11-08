<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
$photograph_settings = photograph_get_theme_options();
/********************** PHOTOGRAPH WORDPRESS DEFAULT PANEL ***********************************/
$wp_customize->add_section('header_image', array(
'title' => __('Header Media', 'photograph'),
'priority' => 20,
'panel' => 'photograph_wordpress_default_panel'
));
$wp_customize->add_section('colors', array(
'title' => __('Colors', 'photograph'),
'priority' => 30,
'panel' => 'photograph_wordpress_default_panel'
));
$wp_customize->add_section('background_image', array(
'title' => __('Background Image', 'photograph'),
'priority' => 40,
'panel' => 'photograph_wordpress_default_panel'
));
$wp_customize->add_section('nav', array(
'title' => __('Navigation', 'photograph'),
'priority' => 50,
'panel' => 'photograph_wordpress_default_panel'
));
$wp_customize->add_section('static_front_page', array(
'title' => __('Static Front Page', 'photograph'),
'priority' => 60,
'panel' => 'photograph_wordpress_default_panel'
));
$wp_customize->add_section('title_tagline', array(
	'title' => __('Site Title & Logo Options', 'photograph'),
	'priority' => 10,
	'panel' => 'photograph_wordpress_default_panel'
));

$wp_customize->add_section('photograph_custom_header', array(
	'title' => __('Options', 'photograph'),
	'priority' => 503,
	'panel' => 'photograph_options_panel'
));

$wp_customize->add_section( 'search_text', array(
   'title'    => __('Search Text', 'photograph'),
   'priority'       => 508,
   'panel' => 'photograph_options_panel'
));

$wp_customize->add_section( 'excerpt_tag_setting', array(
   'title'    => __('Excert Text/ Excerpt Length', 'photograph'),
   'priority'       => 509,
   'panel' => 'photograph_options_panel'
));

$wp_customize->add_section('photograph_footer_image', array(
	'title' => __('Footer Background Image', 'photograph'),
	'priority' => 510,
	'panel' => 'photograph_options_panel'
));

/********************  PHOTOGRAPH THEME OPTIONS ******************************************/

$wp_customize->add_setting('photograph_theme_options[photograph_header_display]', array(
	'capability' => 'edit_theme_options',
	'default' => $photograph_settings['photograph_header_display'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('photograph_theme_options[photograph_header_display]', array(
	'label' => __('Site Logo/ Text Options', 'photograph'),
	'priority' => 105,
	'section' => 'title_tagline',
	'type' => 'select',
	'checked' => 'checked',
		'choices' => array(
		'header_text' => __('Display Site Title Only','photograph'),
		'header_logo' => __('Display Site Logo Only','photograph'),
		'show_both' => __('Show Both','photograph'),
		'disable_both' => __('Disable Both','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_logo_high_resolution]', array(
	'default' => $photograph_settings['photograph_logo_high_resolution'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_logo_high_resolution]', array(
	'priority'=>110,
	'label' => __('Center Logo for high resolution screen(Use 2X size image)', 'photograph'),
	'section' => 'title_tagline',
	'type' => 'checkbox',
));

$wp_customize->add_setting('photograph_theme_options[photograph_header_design_layout]', array(
	'default' => $photograph_settings['photograph_header_design_layout'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('photograph_theme_options[photograph_header_design_layout]', array(
	'priority' =>120,
	'label' => __('Header Design Layout', 'photograph'),
	'section' => 'title_tagline',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'' => __('Default','photograph'),
		'top-logo-title' => __('Top/center logo & site title','photograph'),
	),
));

$wp_customize->add_setting('photograph_theme_options[photograph_animate_css]', array(
	'default' => $photograph_settings['photograph_animate_css'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control('photograph_theme_options[photograph_animate_css]', array(
	'priority' =>15,
	'label' => __('Disable Wow Animation Options', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_search_custom_header]', array(
	'default' => $photograph_settings['photograph_search_custom_header'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_search_custom_header]', array(
	'priority'=>20,
	'label' => __('Disable Search Form', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_side_menu]', array(
	'default' => $photograph_settings['photograph_side_menu'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_side_menu]', array(
	'priority'=>25,
	'label' => __('Disable Side Menu', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_stick_menu]', array(
	'default' => $photograph_settings['photograph_stick_menu'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_stick_menu]', array(
	'priority'=>30,
	'label' => __('Disable Stick Menu', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_scroll]', array(
	'default' => $photograph_settings['photograph_scroll'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_scroll]', array(
	'priority'=>40,
	'label' => __('Disable Goto Top', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_top_social_icons]', array(
	'default' => $photograph_settings['photograph_top_social_icons'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_top_social_icons]', array(
	'priority'=>50,
	'label' => __('Disable Header Social Icons', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_side_menu_social_icons]', array(
	'default' => $photograph_settings['photograph_side_menu_social_icons'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_side_menu_social_icons]', array(
	'priority'=>60,
	'label' => __('Disable Side Menu Social Icons', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_buttom_social_icons]', array(
	'default' => $photograph_settings['photograph_buttom_social_icons'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_buttom_social_icons]', array(
	'priority'=>70,
	'label' => __('Disable Bottom Social Icons', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_display_page_single_featured_image]', array(
	'default' => $photograph_settings['photograph_display_page_single_featured_image'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_display_page_single_featured_image]', array(
	'priority'=>100,
	'label' => __('Disable Page/Single Featured Image', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_disable_main_menu]', array(
	'default' => $photograph_settings['photograph_disable_main_menu'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_disable_main_menu]', array(
	'priority'=>120,
	'label' => __('Disable Main Menu', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_instagram_feed_display]', array(
	'default' => $photograph_settings['photograph_instagram_feed_display'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_instagram_feed_display]', array(
	'priority'=>49,
	'label' => __('Disable Instagram', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_disable_volume_button]', array(
	'default' => $photograph_settings['photograph_disable_volume_button'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_disable_volume_button]', array(
	'priority'=>130,
	'label' => __('Disable Volumen Button', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_disable_fancy_box]', array(
	'default' => $photograph_settings['photograph_disable_fancy_box'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_disable_fancy_box]', array(
	'priority'=>130,
	'label' => __('Disable Fancy Box', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_reset_all]', array(
	'default' => $photograph_settings['photograph_reset_all'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'photograph_reset_alls',
	'transport' => 'postMessage',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_reset_all]', array(
	'priority'=>150,
	'label' => __('Reset all default settings. (Refresh it to view the effect)', 'photograph'),
	'section' => 'photograph_custom_header',
	'type' => 'checkbox',
));

/********************** Footer Background Image ***********************************/
$wp_customize->add_setting( 'photograph_theme_options[photograph_img-upload-footer-image]',array(
	'default'	=> $photograph_settings['photograph_img-upload-footer-image'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'photograph_theme_options[photograph_img-upload-footer-image]', array(
	'label' => __('Footer Background Image','photograph'),
	'description' => __('Image will be displayed on footer','photograph'),
	'priority'	=> 50,
	'section' => 'photograph_footer_image',
	)
));