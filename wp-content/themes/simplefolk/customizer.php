<?php

add_action('customize_register', 'simplefolk_customizer_settings');
function simplefolk_customizer_settings($wp_customize)
{

    $wp_customize->add_section('simple_featured', array(
        'title'      => 'Featured Gallery (Home)',
        'priority'   => 30,
    ));

    $wp_customize->add_setting('num_posts', array(
        'default'     => 10,
        'transport'   => 'refresh',
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
    ));
    $wp_customize->add_control('tag_list', array(
        'label'        => 'Featured Tags',
        'description' => 'Comma seperated list of tags to use as filters (will only appear if posts with that tag exist)',
        'section'    => 'simple_featured',
        'settings'   => 'tag_list',
        'type' => 'text'
    ));
}