<?php
function photo_child_enqueue_styles() {
    $parent_style = 'photo-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'photo_child_enqueue_styles' );
add_image_size( 'tag_thumbs', 85, 45, true );

// note : have to use STYLESHEETPATH here because TEMPLATEPATH returns the parent
// var_dump(get_template_directory());
//var_dump(get_stylesheet_directory());
// this also works
//var_dump(get_theme_file_path());


 require get_theme_file_path() . '/inc/settings/asset-functions.php';
function my_recent_posts() {
echo '<div id="recent_posts"><div class="grid-sizer"></div>';
$args = array(
  'numberposts' => '15',
  'post__not_in' => array( get_the_ID() )
 );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ) :
    $id = $recent["ID"];
    if ( has_post_thumbnail($id)) : ?>
    <div class="recent-item">
      <a href="<?php echo get_permalink($id); ?>">
        <?php echo get_the_post_thumbnail($id,'thumbnail'); ?>
      </a></div>
       <?php endif;
       //		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
	endforeach;
	wp_reset_query();
}

function add_font() {
$folk_font = array();
array_push( $folk_font, 'Special+Elite');
array_push( $folk_font, 'Rajdhani');
$folk_fonts = implode("|", $folk_font);
wp_register_style( 'folk-fonts', '//fonts.googleapis.com/css?family='.$folk_fonts.'&display=swap');
wp_enqueue_style( 'folk-fonts' );
}
add_action( 'wp_enqueue_scripts', 'add_font' );

/* Remove inline width/height attributes */

add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}


// Prevent WP from adding <p> tags on all post types
function disable_wp_auto_p( $content ) {
  remove_filter( 'the_content', 'wpautop' );
  remove_filter( 'the_excerpt', 'wpautop' );
  return $content;
}
add_filter( 'the_content', 'disable_wp_auto_p', 0 );


// add featured post image in admin post list
add_filter('manage_posts_columns', 'add_img_column');
add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns) {
  $columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id) {
 if( $column_name == 'img' ) {
  echo get_the_post_thumbnail($post_id, 'thumbnail');
 }
 return $column_name;
}
/* Copying over from /inc/settings/photograph-functions.php

/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
// function photograph_scripts() {
// 	$photograph_settings = photograph_get_theme_options();
// 	$photograph_stick_menu = $photograph_settings['photograph_stick_menu'];
// 	$photograph_slider_video_display = $photograph_settings['photograph_slider_video_display'];
// 	$photograph_video_upload = $photograph_settings['photograph_video_upload'];
// 	$photograph_slider_youtube_url = $photograph_settings['photograph_slider_youtube_url'];
// 	$photograph_enable_slider = $photograph_settings['photograph_enable_slider'];
//
// 	wp_enqueue_script('photograph-main', get_template_directory_uri().'/js/photograph-main.js', array('jquery'), false, true);
// 	// Load the html5 shiv.
// 	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
// 	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
// 	wp_enqueue_style( 'photograph-style', get_stylesheet_uri() );
//
// 	if( $photograph_settings['photograph_animate_css'] == 0) {
// 		wp_enqueue_style('animate-css', get_template_directory_uri().'/assets/wow/css/animate.min.css');
// 		wp_enqueue_script('wow', get_template_directory_uri().'/assets/wow/js/wow.min.js', array('jquery'), false, true);
// 		wp_enqueue_script('photograph-wow-settings', get_template_directory_uri().'/assets/wow/js/wow-settings.js', array('jquery'), false, true);
// 	}
//
// 	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
// 	wp_enqueue_script('photograph-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array('jquery'), false, true);
// 	wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
// 	wp_enqueue_script('isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'), false, true);
// 	wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri().'/js/isotope-setting.js', array('isotope'), false, true);
// 	wp_enqueue_script( 'photograph-slider' );
//
// 	if( $photograph_settings['photograph_responsive'] == 'on' ) {
// 		wp_enqueue_style('photograph-responsive', get_template_directory_uri().'/css/responsive.css');
// 	}
// 	/********* Adding Multiple Fonts ********************/
// 	// $photograph_googlefont = array();
// 	// array_push( $photograph_googlefont, 'Roboto');
// 	// array_push( $photograph_googlefont, 'Rajdhani');
// 	// $photograph_googlefonts = implode("|", $photograph_googlefont);
// 	//
// 	// wp_register_style( 'photograph-google-fonts', '//fonts.googleapis.com/css?family='.$photograph_googlefonts .':300,400,400i,500,600,700');
// 	// wp_enqueue_style( 'photograph-google-fonts' );
// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// 	$photograph_internal_css='';
// 	/* Theme Color Styles */
// 	$photograph_theme_color_styles = get_theme_mod( 'theme_color_styles', '#fd513b' );
// 	/* Custom Css */
// 	if ($photograph_settings['photograph_logo_high_resolution'] !=0){
// 		$photograph_internal_css .= '/* Center Logo for high resolution screen(Use 2X size image) */
// 		.top-logo-title .custom-logo-link {
// 			display: inline-block;
// 		}
//
// 		.top-logo-title .custom-logo {
// 			height: auto;
// 			width: 50%;
// 		}
//
// 		.top-logo-title #site-detail {
// 			display: block;
// 			text-align: center;
// 		}
//
// 		@media only screen and (max-width: 767px) {
// 			.top-logo-title .custom-logo-link .custom-logo {
// 				width: 60%;
// 			}
// 		}
//
// 		@media only screen and (max-width: 480px) {
// 			.top-logo-title .custom-logo-link .custom-logo {
// 				width: 80%;
// 			}
// 		}';
// 	}
//
//
// 	if($photograph_settings['photograph_header_display']=='header_logo'){
// 		$photograph_internal_css .= '
// 		#site-branding #site-title, #site-branding #site-description{
// 			clip: rect(1px, 1px, 1px, 1px);
// 			position: absolute;
// 		}';
// 	}
//
// 	wp_add_inline_style( 'photograph-style', wp_strip_all_tags($photograph_internal_css) );
// }
// add_action( 'wp_enqueue_scripts', 'photograph_scripts' );
//

// function selective_load(){
//   if (is_front_page()) {
//     wp_enqueue_style('new-styles.css', get_template_directory_uri().'/path/to/new-styles.css', false ,'1.0', 'all' );
//     wp_enqueue_script('new-scripts.js', get_template_directory_uri().'/path/to/yes.js', false ,'1.0', 'all' );
//   } else {
//     wp_enqueue_script('new-scripts.js', get_template_directory_uri().'/path/to/else.js', false ,'1.0', 'all' );
//
//   }
// }
// add_action( 'wp_enqueue_scripts', 'selective_load' );
?>
