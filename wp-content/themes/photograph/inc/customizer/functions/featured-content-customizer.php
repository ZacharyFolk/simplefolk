<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */

/******************** PHOTOGRAPH SLIDER SETTINGS ******************************************/
$photograph_settings = photograph_get_theme_options();
$photograph_categories_lists = photograph_categories_lists();
$wp_customize->add_section( 'featured_content', array(
	'title' => __( 'Slider/ Video Settings', 'photograph' ),
	'priority' => 140,
	'panel' => 'photograph_featuredcontent_panel'
));

$wp_customize->add_section( 'slider_category_content', array(
	'title' => __( 'Select Category Slider', 'photograph' ),
	'priority' => 150,
	'panel' => 'photograph_featuredcontent_panel'
));
$wp_customize->add_section( 'slider_video_content', array(
	'title' => __( 'Select Video', 'photograph' ),
	'priority' => 155,
	'panel' => 'photograph_featuredcontent_panel'
));
$wp_customize->add_setting( 'photograph_theme_options[photograph_slider_video_display]', array(
	'default' => $photograph_settings['photograph_slider_video_display'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_slider_video_display]', array(
	'priority'=>5,
	'label' => __('Choose Video/ Category Slider', 'photograph'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'video' => __('Default/ Video / Single Featured Image','photograph'),
		'category-slider' => __('Display Category Slider','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_enable_slider]', array(
	'default' => $photograph_settings['photograph_enable_slider'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_enable_slider]', array(
	'priority'=>20,
	'label' => __('Enable Slider/ Video Section', 'photograph'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'frontpage' => __('Front Page','photograph'),
		'enitresite' => __('Entire Site','photograph'),
		'disable' => __('Disable Slider/ Video','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_animation_effect]', array(
	'default' => $photograph_settings['photograph_animation_effect'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_animation_effect]', array(
	'priority'=>60,
	'label' => __('Animation Effect', 'photograph'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
		'slide' => __('Slide','photograph'),
		'fade' => __('Fade','photograph'),
	),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_slideshowSpeed]', array(
	'default' => $photograph_settings['photograph_slideshowSpeed'],
	'sanitize_callback' => 'photograph_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_slideshowSpeed]', array(
	'priority'=>70,
	'label' => __('Set the speed of the slideshow cycling', 'photograph'),
	'section' => 'featured_content',
	'type' => 'text',
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_animationSpeed]', array(
	'default' => $photograph_settings['photograph_animationSpeed'],
	'sanitize_callback' => 'photograph_numeric_value',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_animationSpeed]', array(
	'priority'=>80,
	'label' => __(' Set the speed of animations', 'photograph'),
	'description' => __('This feature will not work on Animation Effect set to fade','photograph'),
	'section' => 'featured_content',
	'type' => 'text',
));

$wp_customize->add_setting('photograph_theme_options[photograph_slider_content]', array(
        'default'        => $photograph_settings['photograph_slider_content'],
        'sanitize_callback' => 'photograph_sanitize_select',
        'type'                  => 'option',
    ));
$wp_customize->add_control('photograph_theme_options[photograph_slider_content]', array(
        'priority'      => 90,
        'label'      => __('Hide Slider/Video/Image Content', 'photograph'),
        'section'    => 'featured_content',
        'type'       => 'select',
        'checked'   => 'checked',
        'choices'    => array(
            'on' => __('ON ','photograph'),
            'off' => __('OFF','photograph'),
        ),
    ));

/* Slider Category Section */

$wp_customize->add_setting('photograph_theme_options[photograph_slider_content_bg_color]', array(
	'default' =>$photograph_settings['photograph_slider_content_bg_color'],
	'sanitize_callback' => 'photograph_sanitize_select',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('photograph_theme_options[photograph_slider_content_bg_color]', array(
	'priority' =>8,
	'label' => __('Slider Content With background color', 'photograph'),
	'section' => 'featured_content',
	'type' => 'select',
	'checked' => 'checked',
	'choices' => array(
	'on' => __('Show Background Color','photograph'),
	'off' => __('Hide Background Color','photograph'),
	),
));

/* Select your category to display Slider */

$wp_customize->add_setting( 'photograph_theme_options[photograph_default_category_slider]', array(
		'default'				=>$photograph_settings['photograph_default_category_slider'],
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'photograph_sanitize_category_select',
		'type'				=> 'option'
	));
$wp_customize->add_control(
	
	'photograph_theme_options[photograph_default_category_slider]',
		array(
			'priority' 				=> 10,
			'label'					=> __('Select Category Slider','photograph'),
			'description'					=> __('By default no slider is displayed','photograph'),
			'section'				=> 'slider_category_content',
			'settings'				=> 'photograph_theme_options[photograph_default_category_slider]',
			'type'					=>'select',
			'choices'	=>  $photograph_categories_lists 
	)
);

/******** Video Section */
$wp_customize->add_setting( 'photograph_theme_options[photograph_video_upload]',array(
	'default'	=> $photograph_settings['photograph_video_upload'],
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'absint',
	'type' => 'option',
));
$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'photograph_theme_options[photograph_video_upload]', array(
	'label' => __('Upload Video','photograph'),
	'priority'	=> 20,
	'section' => 'slider_video_content',
	'mime_type' => 'video'
	)
));
$wp_customize->add_setting('photograph_theme_options[photograph_slider_youtube_url]', array(
	'default' =>$photograph_settings['photograph_slider_youtube_url'],
	'sanitize_callback' => 'esc_url_raw',
	'type' => 'option',
	'capability' => 'manage_options'
));
$wp_customize->add_control('photograph_theme_options[photograph_slider_youtube_url]', array(
	'priority' =>20,
	'label' => __('Or, enter a YouTube URL:', 'photograph'),
	'section' => 'slider_video_content',
	'type' => 'text',
));

/* Select your category to display text in video section */
$wp_customize->add_setting( 'photograph_theme_options[photograph_video_category]', array(
		'default'				=>$photograph_settings['photograph_video_category'],
		'capability'			=> 'manage_options',
		'sanitize_callback'	=> 'photograph_sanitize_category_select',
		'type'				=> 'option'
	));
$wp_customize->add_control('photograph_theme_options[photograph_video_category]',
		array(
			'priority' 				=> 30,
			'label'					=> __('Display text and content in Video','photograph'),
			'description'			=> __('Select Category to display title and content in video. If no video is added then featured image of selected post will be displayed.','photograph'),
			'section'				=> 'slider_video_content',
			'settings'				=> 'photograph_theme_options[photograph_video_category]',
			'type'					=>'select',
			'choices'	=>  $photograph_categories_lists 
		)
);
