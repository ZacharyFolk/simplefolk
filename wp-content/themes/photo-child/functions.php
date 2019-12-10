<?php
add_action( 'wp_enqueue_scripts', 'photo_child_enqueue_styles' );
function photo_child_enqueue_styles() {

    $parent_style = 'photo-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
// Use the after_setup_theme hook with a priority of 11 to load after the
// parent theme, which will fire on the default priority of 10
// removing support for post-formats, see: content.php #39

add_action( 'after_setup_theme', 'remove_meta_entry_format', 11 );
function remove_meta_entry_format() {
    remove_theme_support( 'post-formats' );
    // Add this line in to re-enable support for just Posts
  //  add_theme_support( post-formats', array( 'post' ) );
}
add_image_size( 'folk_recent_thumbs', 55, 55, true );

add_image_size( 'tag_thumbs', 200, 200, array( 'left', 'top' ) );

function delicious_recent_posts() {
  $args = array(
      'numberposts' => 5,
      'offset' => 0,
      'category' => 7,
      //'post__not_in' => array( $post->ID )
  );
    $recent_posts = new WP_Query($args);
        while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
            <li>
                <a href="<?php esc_url(the_permalink()); ?>">
                    <?php echo '<a href="' . get_permalink() . '"' ?>
                      <?php the_post_thumbnail('folk_recent_thumbs'); ?>
                </a>
                <h4>
                    <a href="<?php esc_url(the_permalink()); ?>">
                        <?php esc_html(the_title()); ?>
                   </a>
                </h4>
            </li>
        <?php endwhile;
    wp_reset_postdata();
}

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


/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
function photograph_scripts() {
	$photograph_settings = photograph_get_theme_options();
	$photograph_stick_menu = $photograph_settings['photograph_stick_menu'];
	$photograph_slider_video_display = $photograph_settings['photograph_slider_video_display'];
	$photograph_video_upload = $photograph_settings['photograph_video_upload'];
	$photograph_slider_youtube_url = $photograph_settings['photograph_slider_youtube_url'];
	$photograph_enable_slider = $photograph_settings['photograph_enable_slider'];
	wp_enqueue_script('photograph-main', get_template_directory_uri().'/js/photograph-main.js', array('jquery'), false, true);
	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_style( 'photograph-style', get_stylesheet_uri() );
	if( $photograph_settings['photograph_animate_css'] == 0) {
		wp_enqueue_style('animate-css', get_template_directory_uri().'/assets/wow/css/animate.min.css');
		wp_enqueue_script('wow', get_template_directory_uri().'/assets/wow/js/wow.min.js', array('jquery'), false, true);
		wp_enqueue_script('photograph-wow-settings', get_template_directory_uri().'/assets/wow/js/wow-settings.js', array('jquery'), false, true);
	}
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');

	if( $photograph_stick_menu != 1 ):

		wp_enqueue_script('jquery-sticky', get_template_directory_uri().'/assets/sticky/jquery.sticky.min.js', array('jquery'), false, true);
		wp_enqueue_script('photograph-sticky-settings', get_template_directory_uri().'/assets/sticky/sticky-settings.js', array('jquery'), false, true);

	endif;

	wp_enqueue_script('photograph-navigation', get_template_directory_uri().'/js/navigation.js', array('jquery'), false, true);

	wp_enqueue_script('photograph-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array('jquery'), false, true);

	if( ($photograph_slider_video_display=='video') && ( $photograph_video_upload !=0 || $photograph_slider_youtube_url !='' || $photograph_settings['photograph_video_category'] !='') ){
		if (($photograph_settings['photograph_slider_video_display'] == 'video') && ($photograph_enable_slider=='frontpage'|| $photograph_enable_slider=='enitresite') ){
			if((is_front_page() && ($photograph_enable_slider=='frontpage') ) || ($photograph_enable_slider=='enitresite') ) {
				wp_enqueue_script('jquery-jarallax', get_template_directory_uri().'/assets/jarallax/jarallax.js', array('jquery'), false, true);
				wp_enqueue_script('jarallax-video', get_template_directory_uri().'/assets/jarallax/jarallax-video.js', array('jquery'), false, true);
				wp_enqueue_script('photograph-video', get_template_directory_uri().'/assets/jarallax/jarallax-settings.js', array('jquery-jarallax'), false, true);
			}
		}
	} elseif (($photograph_settings['photograph_slider_video_display'] == 'category-slider') && ($photograph_enable_slider=='frontpage'|| $photograph_enable_slider=='enitresite') ){
		if((is_front_page() && ($photograph_enable_slider=='frontpage') ) || ($photograph_enable_slider=='enitresite') ) {
				wp_enqueue_script('jquery-flexslider', get_template_directory_uri().'/js/jquery.flexslider-min.js', array('jquery'), false, true);
				wp_enqueue_script('photograph-slider', get_template_directory_uri().'/js/flexslider-setting.js', array('jquery-flexslider'), false, true);
			}
	}

	wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
	wp_enqueue_script('isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'), false, true);
	wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri().'/js/isotope-setting.js', array('isotope'), false, true);

	if($photograph_settings['photograph_disable_fancy_box']==0){
		wp_enqueue_style('fancybox-css', get_template_directory_uri().'/assets/fancybox/css/jquery.fancybox.min.css');
		wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/fancybox/js/jquery.fancybox.min.js', array('jquery'), false, true);
		wp_enqueue_script('photograph-fancybox-settings', get_template_directory_uri().'/assets/fancybox/js/fancybox-settings.js', array('fancybox'), false, true);
	}


	$photograph_animation_effect   = esc_attr($photograph_settings['photograph_animation_effect']);
	$photograph_slideshowSpeed    = absint($photograph_settings['photograph_slideshowSpeed'])*1000;
	$photograph_animationSpeed = absint($photograph_settings['photograph_animationSpeed'])*100;
	wp_localize_script(
		'photograph-slider',
		'photograph_slider_value',
		array(
			'photograph_animation_effect'   => $photograph_animation_effect,
			'photograph_slideshowSpeed'    => $photograph_slideshowSpeed,
			'photograph_animationSpeed' => $photograph_animationSpeed,
		)
	);
	wp_enqueue_script( 'photograph-slider' );
	if( $photograph_settings['photograph_responsive'] == 'on' ) {
		wp_enqueue_style('photograph-responsive', get_template_directory_uri().'/css/responsive.css');
	}
	/********* Adding Multiple Fonts ********************/
	// $photograph_googlefont = array();
	// array_push( $photograph_googlefont, 'Roboto');
	// array_push( $photograph_googlefont, 'Rajdhani');
	// $photograph_googlefonts = implode("|", $photograph_googlefont);
	//
	// wp_register_style( 'photograph-google-fonts', '//fonts.googleapis.com/css?family='.$photograph_googlefonts .':300,400,400i,500,600,700');
	// wp_enqueue_style( 'photograph-google-fonts' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	$photograph_internal_css='';
	/* Theme Color Styles */
	$photograph_theme_color_styles = get_theme_mod( 'theme_color_styles', '#fd513b' );
	if($photograph_theme_color_styles !='#fd513b'){
	$photograph_internal_css .= '	/* Nav, links and hover */

		a,
		ul li a:hover,
		ol li a:hover,
		.main-navigation a:hover, /* Navigation */
		.main-navigation ul li.current-menu-item a,
		.main-navigation ul li.current_page_ancestor a,
		.main-navigation ul li.current-menu-ancestor a,
		.main-navigation ul li.current_page_item a,
		.main-navigation ul li:hover > a,
		.main-navigation li.current-menu-ancestor.menu-item-has-children > a:after,
		.main-navigation li.current-menu-item.menu-item-has-children > a:after,
		.main-navigation ul li:hover > a:after,
		.main-navigation li.menu-item-has-children > a:hover:after,
		.main-navigation li.page_item_has_children > a:hover:after,
		.main-navigation ul li ul li a:hover,
		.main-navigation ul li ul li:hover > a,
		.main-navigation ul li.current-menu-item ul li a:hover,
		.side-menu-wrap .side-nav-wrap a:hover, /* Side Menu */
		.entry-title a:hover, /* Post */
		.entry-title a:focus,
		.entry-title a:active,
		.entry-meta a:hover,
		.image-navigation .nav-links a,
		a.more-link,
		.widget ul li a:hover, /* Widgets */
		.widget-title a:hover,
		.widget_contact ul li a:hover,
		.site-info .copyright a:hover, /* Footer */
		#secondary .widget-title,
		#colophon .widget ul li a:hover,
		#footer-navigation a:hover,
		blockquote:before,
		.filter-button div button:hover,
		.filter-button div button.active,
		.couples-row .couples-column:first-child:before {
			color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		.main-navigation ul li ul:before,
		.side-menu:after,
		.page-overlay:before,
		#secondary .widget-title:before,
		.featured-gallery .featured-text-content,
		.maps-container:before {
			background-color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		.main-navigation ul li ul:after {
			border-bottom-color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		/* Webkit */
		::selection {
			background: '. esc_attr( $photograph_theme_color_styles ).';
			color: #fff;
		} '.'

		/* Gecko/Mozilla */
		::-moz-selection {
			background: '. esc_attr( $photograph_theme_color_styles ).';
			color: #fff;
		} '.'

		/* Accessibility
		================================================== */
		.screen-reader-text:hover,
		.screen-reader-text:active,
		.screen-reader-text:focus {
			background-color: #f1f1f1;
			color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		/* Default Buttons
		================================================== */
		input[type="reset"],/* Forms  */
		input[type="button"],
		input[type="submit"],
		.search-submit,
		.btn-default,
		.widget_tag_cloud a,
		.search-x {
			background-color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		/* #Search Box
		================================================== */
		#search-box .search-submit {
			border-bottom: 1px solid '. esc_attr( $photograph_theme_color_styles ).';
			color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		#search-box input[type="search"] {
			border-bottom: 1px solid '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		/* #bbpress
		================================================== */
		#bbpress-forums .bbp-topics a:hover {
			color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		.bbp-submit-wrapper button.submit {
			background-color: '. esc_attr( $photograph_theme_color_styles ).';
			border: 1px solid '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		/* Woocommerce
		================================================== */
		.woocommerce #respond input#submit,
		.woocommerce a.button,
		.woocommerce button.button,
		.woocommerce input.button,
		.woocommerce #respond input#submit.alt,
		.woocommerce a.button.alt,
		.woocommerce button.button.alt,
		.woocommerce input.button.alt,
		.woocommerce-demo-store p.demo_store {
			background-color: '. esc_attr( $photograph_theme_color_styles ).';
		}'.'

		.woocommerce .woocommerce-message:before {
			color:'. esc_attr( $photograph_theme_color_styles ).';
		}';

}
	/* Custom Css */


	if ($photograph_settings['photograph_logo_high_resolution'] !=0){
		$photograph_internal_css .= '/* Center Logo for high resolution screen(Use 2X size image) */
		.top-logo-title .custom-logo-link {
			display: inline-block;
		}

		.top-logo-title .custom-logo {
			height: auto;
			width: 50%;
		}

		.top-logo-title #site-detail {
			display: block;
			text-align: center;
		}

		@media only screen and (max-width: 767px) {
			.top-logo-title .custom-logo-link .custom-logo {
				width: 60%;
			}
		}

		@media only screen and (max-width: 480px) {
			.top-logo-title .custom-logo-link .custom-logo {
				width: 80%;
			}
		}';
	}

	if($photograph_settings['photograph_slider_content_bg_color'] =='on' ){
		$photograph_internal_css .= '/*  Slider/Video/Image Content With background color */
		.layer-slider .slider-content,
		.vid-thumb-bg:not(.movie) .vid-thumb-content {
			background-color: rgba(0, 0, 0, 0.5);
			border-radius: 20px;
			padding: 30px;
		}';
	}

	if($photograph_settings['photograph_slider_content'] == 'off'){
		$photograph_internal_css .=
		/* Hide Slider/Video/Image Content */
		'.slider-content,
		.vid-thumb-content {
			display: none;
		}';
	}

	if($photograph_settings['photograph_disable_volume_button'] == 1){
		$photograph_internal_css .=
		/* Disable volume button */
		'.jarallax-video-pause {
			display: none;
		}';
	}

	if($photograph_settings['photograph_header_display']=='header_logo'){
		$photograph_internal_css .= '
		#site-branding #site-title, #site-branding #site-description{
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}';
	}

	wp_add_inline_style( 'photograph-style', wp_strip_all_tags($photograph_internal_css) );
}
add_action( 'wp_enqueue_scripts', 'photograph_scripts' );


function selective_load(){
  if (is_page('home')) {
    wp_enqueue_style('new-styles.css', get_template_directory_uri().'/path/to/new-styles.css', false ,'1.0', 'all' );
    wp_enqueue_script('new-scripts.js', get_template_directory_uri().'/path/to/new-scripts.js', false ,'1.0', 'all' );
  } else {

  }
}
add_action( 'wp_enqueue_scripts', 'selective_load' );


?>
