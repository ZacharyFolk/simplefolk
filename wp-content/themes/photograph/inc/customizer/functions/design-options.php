<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
$photograph_settings = photograph_get_theme_options();

$wp_customize->add_section('photograph_layout_options', array(
	'title' => __('Layout Options', 'photograph'),
	'priority' => 102,
	'panel' => 'photograph_options_panel'
));

$wp_customize->add_setting('photograph_theme_options[photograph_responsive]', array(
	'default' => $photograph_settings['photograph_responsive'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control('photograph_theme_options[photograph_responsive]', array(
	'priority' =>20,
	'label' => __('Responsive Layout', 'photograph'),
	'section' => 'photograph_layout_options',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'on' => __('ON ','photograph'),
		'off' => __('OFF','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_entry_meta_single]', array(
	'default' => $photograph_settings['photograph_entry_meta_single'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_entry_meta_single]', array(
	'priority'=>40,
	'label' => __('Disable Entry Meta from Single Page', 'photograph'),
	'section' => 'photograph_layout_options',
	'type' => 'select',
	'choices' => array(
		'show' => __('Display Entry Format','photograph'),
		'hide' => __('Hide Entry Format','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_entry_meta_blog]', array(
	'default' => $photograph_settings['photograph_entry_meta_blog'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_entry_meta_blog]', array(
	'priority'=>50,
	'label' => __('Disable Entry Meta from Blog', 'photograph'),
	'section' => 'photograph_layout_options',
	'type'	=> 'select',
	'choices' => array(
		'show-meta' => __('Display Entry Meta','photograph'),
		'hide-meta' => __('Hide Entry Meta','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_post_category]', array(
	'default' => $photograph_settings['photograph_post_category'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_post_category]', array(
	'priority'=>55,
	'label' => __('Disable Category', 'photograph'),
	'section' => 'photograph_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_post_author]', array(
	'default' => $photograph_settings['photograph_post_author'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_post_author]', array(
	'priority'=>60,
	'label' => __('Disable Author', 'photograph'),
	'section' => 'photograph_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_post_date]', array(
	'default' => $photograph_settings['photograph_post_date'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_post_date]', array(
	'priority'=>65,
	'label' => __('Disable Date', 'photograph'),
	'section' => 'photograph_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_post_comments]', array(
	'default' => $photograph_settings['photograph_post_comments'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_post_comments]', array(
	'priority'=>68,
	'label' => __('Disable Comments', 'photograph'),
	'section' => 'photograph_layout_options',
	'type' => 'checkbox',
));

$wp_customize->add_setting('photograph_theme_options[photograph_blog_content_layout]', array(
   'default'        => $photograph_settings['photograph_blog_content_layout'],
   'sanitize_callback' => 'photograph_sanitize_select',
   'type'                  => 'option',
   'capability'            => 'manage_options'
));
$wp_customize->add_control('photograph_theme_options[photograph_blog_content_layout]', array(
   'priority'  =>75,
   'label'      => __('Blog Content Display', 'photograph'),
   'section'    => 'photograph_layout_options',
   'type'       => 'select',
   'checked'   => 'checked',
   'choices'    => array(
       'fullcontent_display' => __('Blog Full Content Display','photograph'),
       'excerptblog_display' => __(' Excerpt  Display','photograph'),
   ),
));

$wp_customize->add_setting('photograph_theme_options[photograph_design_layout]', array(
	'default'        => $photograph_settings['photograph_design_layout'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type'                  => 'option',
));
$wp_customize->add_control('photograph_theme_options[photograph_design_layout]', array(
	'priority'  =>80,
	'label'      => __('Design Layout', 'photograph'),
	'section'    => 'photograph_layout_options',
	'type'       => 'select',
	'checked'   => 'checked',
	'choices'    => array(
		'full-width-layout' => __('Full Width Layout','photograph'),
		'boxed-layout' => __('Boxed Layout','photograph'),
		'small-boxed-layout' => __('Small Boxed Layout','photograph'),
	),
));

$wp_customize->add_setting('photograph_theme_options[photograph_blog_gallery_text_content]', array(
   'default'        => $photograph_settings['photograph_blog_gallery_text_content'],
   'sanitize_callback' => 'photograph_sanitize_select',
   'type'                  => 'option',
   'capability'            => 'manage_options'
));
$wp_customize->add_control('photograph_theme_options[photograph_blog_gallery_text_content]', array(
   'priority'      => 110,
   'label'      => __('Display Content Type in Blog', 'photograph'),
   'section'    => 'photograph_layout_options',
   'type'       => 'select',
   'checked'   => 'checked',
   'choices'    => array(
       'show' => __('Show all Content','photograph'),
       'show-on-hover' => __('Show title on Hover ','photograph'),
   ),
));