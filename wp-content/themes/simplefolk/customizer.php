<?php

add_action('customize_register', 'simplefolk_customizer_settings');
function simplefolk_customizer_settings($wp_customize)
{

    /////////////////////////////////////
    //                                 //
    //    Featured Gallery settings    //
    //                                 //
    /////////////////////////////////////

    $wp_customize->add_section('simple_featured', array(
        'title'      => 'Featured Gallery (Home)',
        'priority'   => 30,
    ));

    $wp_customize->add_setting('num_posts', array(
        'default'     => 10,
        'transport'   => 'refresh',
        'sanitize_callback' => 'absint'
    ));
    $wp_customize->add_control('num_posts', array(
        'label'        => 'Number of posts',
        'description' => 'Max number of posts to show on home page featured gallery',
        'section'    => 'simple_featured',
        'settings'   => 'num_posts',
        'type' => 'number'
    ));

    $wp_customize->add_setting('featured_heading', array(
        'default'     => 'Featured Posts',
        'transport'   => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('featured_heading', array(
        'label'        => 'Gallery Heading',
        'description' => 'Title for featured gallery',
        'section'    => 'simple_featured',
        'settings'   => 'featured_heading',
        'type' => 'text'
    ));

    $wp_customize->add_setting('tag_list', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_control('tag_list', array(
        'label'        => 'Featured Tags',
        'description' => 'Comma seperated list of tags to use as filters (will only appear if posts with that tag exist)',
        'section'    => 'simple_featured',
        'settings'   => 'tag_list',
        'type' => 'text'
    ));

    ///////////////////////////
    //                       //
    //    Google settings    //
    //                       //
    ///////////////////////////


    $wp_customize->add_section('google_settings', array(
        'title'      => 'Google settings',
        'priority'   => 40,
    ));
    $wp_customize->add_setting('analytics_key', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'

    ));

    $wp_customize->add_control('analytics_key', array(
        'label'        => 'Analytics Key',
        'description' => 'Insert key for GA API. Example (G-XK1E*****)',
        'section'    => 'google_settings',
        'settings'   => 'analytics_key',
        'type' => 'text'
    ));


    ///////////////////////////
    //                       //
    //    Facebook settings    //
    //                       //
    ///////////////////////////


    $wp_customize->add_section('facebook_settings', array(
        'title'      => 'Facebook settings',
        'priority'   => 40,
    ));
    $wp_customize->add_setting('app_id', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'

    ));

    $wp_customize->add_control('app_id', array(
        'label'        => 'Application ID',
        'description' => 'Insert key for Facewbook App ID',
        'section'    => 'facebook_settings',
        'settings'   => 'app_id',
        'type' => 'text'
    ));



    /////////////////////////
    //                     //
    //    Theme options    //
    //                     //
    /////////////////////////



    $wp_customize->add_section('theme_options', array(
        'title'      => 'Theme options',
        'priority'   => 50,
    ));
    $wp_customize->add_setting('gutenberg_blocks', array(
        'default' => 0,
        'transport'   => 'refresh',
        'sanitize_callback' => 'theme_slug_sanitize_checkbox'
    ));

    $wp_customize->add_control('gutenberg_blocks', array(
        'label'        => 'Disable Guttenberg block editor',
        'description' => 'If not using the block editor disable for increased performance',
        'section'    => 'theme_options',
        'settings'   => 'gutenberg_blocks',
        'type' => 'checkbox'
    ));



    ////////////////////////////
    //                        //
    //    Footer settings     //
    //                        //
    ////////////////////////////


    $wp_customize->add_section('footer_settings', array(
        'title'      => 'Footer settings',
        'priority'   => 40,
    ));
    $wp_customize->add_setting('copyright_info', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'wp_filter_nohtml_kses'
    ));
    $wp_customize->add_setting('fb_link', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw'

    ));
    $wp_customize->add_setting('twit_link', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_setting('ig_link', array(
        'transport'   => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('copyright_info', array(
        'label'        => 'Copyright Name',
        'description' => 'Insert name to use for copyright information. Will print it as "Copyright {Your Name} {Current Date}, All rights reserved.',
        'section'    => 'footer_settings',
        'settings'   => 'copyright_info',
        'type' => 'text'
    ));

    $wp_customize->add_control('fb_link', array(
        'label'        => 'Facebook User Name',
        'description' => 'Insert name to link to Facebook Page.',
        'section'    => 'footer_settings',
        'settings'   => 'fb_link',
        'type' => 'text'
    ));

    $wp_customize->add_control('twit_link', array(
        'label'        => 'Twitter Link',
        'description' => 'Insert Link to your Twitter Page.',
        'section'    => 'footer_settings',
        'settings'   => 'twit_link',
        'type' => 'text'
    ));

    $wp_customize->add_control('ig_link', array(
        'label'        => 'Instagram Link',
        'description' => 'Insert Link to your Instagram Page.',
        'section'    => 'footer_settings',
        'settings'   => 'ig_link',
        'type' => 'text'
    ));
}