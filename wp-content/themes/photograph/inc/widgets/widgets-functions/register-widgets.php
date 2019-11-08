<?php
/**
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
/**************** PHOTOGRAPH REGISTER WIDGETS ***************************************/
add_action('widgets_init', 'photograph_widgets_init');
function photograph_widgets_init() {

	register_sidebar(array(
			'name' => __('Main Sidebar', 'photograph'),
			'id' => 'photograph_main_sidebar',
			'description' => __('Shows widgets at Main Sidebar.', 'photograph'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('Side Menu', 'photograph'),
			'id' => 'photograph_side_menu',
			'description' => __('Shows widgets on all page.', 'photograph'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Slider Section', 'photograph'),
			'id' => 'slider_section',
			'description' => __('Use any Slider Plugins and drag that slider widgets to this Slider Section but you must select Display Category Slider from Customize > Slider/ Video Options > Choose Video/ Category Slider', 'photograph'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Contact Page Sidebar', 'photograph'),
			'id' => 'photograph_contact_page_sidebar',
			'description' => __('Shows widgets on Contact Page Template.', 'photograph'),
			'before_widget' => '<aside id="%1$s" class="widget widget_contact">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
		));
	register_sidebar(array(
			'name' => __('Iframe Code For Google Maps', 'photograph'),
			'id' => 'photograph_form_for_contact_page',
			'description' => __('Add Iframe Code using text widgets', 'photograph'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_sidebar(array(
			'name' => __('WooCommerce Sidebar', 'photograph'),
			'id' => 'photograph_woocommerce_sidebar',
			'description' => __('Add WooCommerce Widgets Only', 'photograph'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		));
	register_widget( 'Photograph_popular_Widgets' );
}