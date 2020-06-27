<?php
/**
 * Theme Customizer Functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */

/******************** PHOTOGRAPH FRONTPAGE  *********************************************/
/* Frontpage Photograph */
$photograph_settings = photograph_get_theme_options();
$photograph_categories_lists = photograph_categories_lists();

$wp_customize->add_section( 'photograph_frontpage_features', array(
	'title' => __('Featured Gallery','photograph'),
	'priority' => 20,
	'panel' =>'photograph_frontpage_panel'
));


/* Frontpage Feature News */
$wp_customize->add_setting( 'photograph_theme_options[photograph_disable_feature_tab_category]', array(
	'default' => $photograph_settings['photograph_disable_feature_tab_category'],
	'sanitize_callback' => 'photograph_checkbox_integer',
	'type' => 'option',
));
$wp_customize->add_control( 'photograph_theme_options[photograph_disable_feature_tab_category]', array(
	'priority' => 5,
	'label' => __('Disable Feature Tab Section', 'photograph'),
	'section' => 'photograph_frontpage_features',
	'type' => 'checkbox',
));

  $wp_customize->add_setting( 'photograph_theme_options[potograph_total_posts_display]', array(
      'default' => $photograph_settings['potograph_total_posts_display'],
      'sanitize_callback' => 'photograph_numeric_value',
      'type' => 'option',
      'capability' => 'manage_options'
      )
  );
  $wp_customize->add_control( 'photograph_theme_options[potograph_total_posts_display]', array(
      'priority' => 9,
      'label' => __( 'No of Featured Post ', 'photograph' ),
      'section' => 'photograph_frontpage_features',
      'type' => 'text',
      )
  );

$wp_customize->add_setting('photograph_theme_options[photograph_hide_show_gallery_title]', array(
   'default'        => $photograph_settings['photograph_hide_show_gallery_title'],
   'sanitize_callback' => 'photograph_sanitize_select',
   'type'                  => 'option',
   'capability'            => 'manage_options'
));
$wp_customize->add_control('photograph_theme_options[photograph_hide_show_gallery_title]', array(
   'priority'      => 100,
   'label'      => __(' Gallery Title ', 'photograph'),
   'description'      => __(' This feature will work only with Featured Image ', 'photograph'),
   'section'    => 'photograph_frontpage_features',
   'type'       => 'select',
   'checked'   => 'checked',
   'choices'    => array(
       'show-fgt' => __('Show Gallery Title','photograph'),
       'hide-fgt' => __('Hide Gallery Title','photograph'),
       'show-fgt-hover' => __('Show Title in Hover  (Default)','photograph'),
   ),
));

$wp_customize->add_setting( 'photograph_theme_options[photograph_feature_tab_title]', array(
	'default' => $photograph_settings['photograph_feature_tab_title'],
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'photograph_theme_options[photograph_feature_tab_title]', array(
	'priority' => 110,
	'label' => __( 'Title', 'photograph' ),
	'section' => 'photograph_frontpage_features',
	'type' => 'text',
	)
);

$wp_customize->add_setting( 'photograph_theme_options[photograph_tab_category]', array(
	'default' => $photograph_settings['photograph_tab_category'],
	'sanitize_callback' => 'photograph_sanitize_category_select',
	'type' => 'option',
	'capability' => 'manage_options'
	)
);
$wp_customize->add_control( 'photograph_theme_options[photograph_tab_category]', array(
	'priority' => 120,
	'label' => __( 'Select Category', 'photograph' ),
	'description'					=> __('Selected category will only be displayed. Below selected Tags will be displayed which fall under this selected category only. If no category is selected then latest post will be displayed', 'photograph'),
	'section' => 'photograph_frontpage_features',
	'type'					=>'select',
	'choices'	=>  $photograph_categories_lists 
	)
);

for ( $i=1; $i <= $photograph_settings['photograph_total_feature_tab_tag']; $i++ ) {
	$wp_customize->add_setting(
		'photograph_theme_options[photograph_featured_tab_tag_'. $i .']', array(
			'default'				=> '',
			'capability'			=> 'manage_options',
			'sanitize_callback'	=> 'photograph_sanitize_category_select',
			'type'				=> 'option'
		)
	);
	$wp_customize->add_control( 'photograph_theme_options[photograph_featured_tab_tag_'. $i .']',
			array(
				'priority' => 13 . absint($i),
				'label'       => __( 'Select Tab Tags # ', 'photograph' ). ' ' . absint($i) ,
				'section'     => 'photograph_frontpage_features',
				'settings'	  => 'photograph_theme_options[photograph_featured_tab_tag_'. $i .']',
				'type'        => 'select',
				'choices'	=>  photograph_tag_lists(),
			)
	);
}