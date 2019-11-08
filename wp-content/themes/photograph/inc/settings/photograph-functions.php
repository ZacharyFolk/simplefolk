<?php
/**
 * Custom functions
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
/********************* Set Default Value if not set ***********************************/
	if ( !get_theme_mod('photograph_theme_options') ) {
		set_theme_mod( 'photograph_theme_options', photograph_get_option_defaults_values() );
	}
/********************* PHOTOGRAPH RESPONSIVE AND CUSTOM CSS OPTIONS ***********************************/
function photograph_responsiveness() {
	$photograph_settings = photograph_get_theme_options();
	if( $photograph_settings['photograph_responsive'] == 'on' ) { ?>
	<meta name="viewport" content="width=device-width" />
	<?php } else { ?>
	<meta name="viewport" content="width=1280" />
	<?php  }
}
add_filter( 'wp_head', 'photograph_responsiveness');

/******************************** EXCERPT LENGTH *********************************/
function photograph_excerpt_length($photograph_excerpt_length) {
	$photograph_settings = photograph_get_theme_options();
	if( is_admin() ){
		return absint($photograph_excerpt_length);
	}

	$photograph_excerpt_length = $photograph_settings['photograph_excerpt_length'];
	return absint($photograph_excerpt_length);
}
add_filter('excerpt_length', 'photograph_excerpt_length');

/********************* CONTINUE READING LINKS FOR EXCERPT *********************************/
function photograph_continue_reading($more) {
	if( is_admin() ){
		return $more;
	}

	return '&hellip; ';
}
add_filter('excerpt_more', 'photograph_continue_reading');

/***************** USED CLASS FOR BODY TAGS ******************************/
function photograph_body_class($photograph_class) {
	$photograph_settings = photograph_get_theme_options();
	$photograph_site_layout = $photograph_settings['photograph_design_layout'];
	$photograph_header_design_layout = $photograph_settings['photograph_header_design_layout'];
	$photograph_slider_video_display = $photograph_settings['photograph_slider_video_display'];
	$photograph_video_upload = $photograph_settings['photograph_video_upload'];
	$photograph_slider_youtube_url = $photograph_settings['photograph_slider_youtube_url'];
	$photograph_enable_slider = $photograph_settings['photograph_enable_slider'];
	$photograph_default_category_slider = $photograph_settings['photograph_default_category_slider'];
	if ($photograph_site_layout =='boxed-layout') {
		$photograph_class[] = 'boxed-layout';
	}elseif ($photograph_site_layout =='small-boxed-layout') {
		$photograph_class[] = 'boxed-layout-small';
	}else{
		$photograph_class[] = '';
	}

	if ( is_singular() && false !== strpos( get_queried_object()->post_content, '<!-- wp:' ) ) {
		$photograph_class[] = 'gutenberg';
	}

	if(is_page_template('page-templates/photograph-template.php')) {
		$photograph_class[] = 'photograph-corporate';
	}

	if(is_page_template('page-templates/aboutus-template.php')) {
		$photograph_class[] = 'about-template';
	}

	if(is_page_template('page-templates/contact-template.php')) {
		$photograph_class[] = 'contact-template';
	}

	if( ($photograph_slider_video_display=='video') && ( $photograph_video_upload !=0 || $photograph_slider_youtube_url !='' || $photograph_settings['photograph_video_category'] !='') ){
		if (($photograph_settings['photograph_slider_video_display'] == 'video') && ($photograph_enable_slider=='frontpage'|| $photograph_enable_slider=='enitresite') ){
			if((is_front_page() && ($photograph_enable_slider=='frontpage') ) || ($photograph_enable_slider=='enitresite') ) {
				$photograph_class[] = 'vid-thumb';
			}
		}
	} elseif (($photograph_settings['photograph_slider_video_display'] == 'category-slider') && ($photograph_enable_slider=='frontpage'|| $photograph_enable_slider=='enitresite') ){
		if((is_front_page() && ($photograph_enable_slider=='frontpage') ) || ($photograph_enable_slider=='enitresite') ) {
			if($photograph_default_category_slider !=''){
				$photograph_class[] = 'sld-plus';
			}
		}
	}

	if($photograph_header_design_layout == ''){
		$photograph_class[] = '';
	}else{
		$photograph_class[] = 'top-logo-title';
	}
	return $photograph_class;
}
add_filter('body_class', 'photograph_body_class');

/********************** SCRIPTS FOR DONATE/ UPGRADE BUTTON ******************************/
function photograph_customize_scripts() {
	wp_enqueue_style( 'photograph_customizer_custom', get_template_directory_uri() . '/inc/css/photograph-customizer.css');
}
add_action( 'customize_controls_print_scripts', 'photograph_customize_scripts');

/**************************** SOCIAL MENU *********************************************/
function photograph_social_links_display() {
		if ( has_nav_menu( 'social-link' ) ) : ?>
	<div class="social-links clearfix">
	<?php
		wp_nav_menu( array(
			'container' 	=> '',
			'theme_location' => 'social-link',
			'depth'          => 1,
			'items_wrap'      => '<ul>%3$s</ul>',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
		) );
	?>
	</div><!-- end .social-links -->
	<?php endif; ?>
<?php }
add_action ('photograph_social_links', 'photograph_social_links_display');

/******************* DISPLAY BREADCRUMBS ******************************/
function photograph_breadcrumb() {
	if (function_exists('bcn_display')) { ?>
		<div class="breadcrumb home">
			<?php bcn_display(); ?>
		</div> <!-- .breadcrumb -->
	<?php }
}

/**************** Video and Image Header ***********************/
function photograph_video_category_sliders() {
	$photograph_settings = photograph_get_theme_options();
	$photograph_slider_video_display = $photograph_settings['photograph_slider_video_display'];
	$photograph_video_upload = $photograph_settings['photograph_video_upload'];
	$photograph_slider_youtube_url = $photograph_settings['photograph_slider_youtube_url'];
	$query = new WP_Query(array(
					'posts_per_page' =>  1,
					'post_type'					=> 'post',
					'category_name' => esc_attr($photograph_settings['photograph_video_category']),
				));
	if( ($photograph_slider_video_display=='video') && ( $photograph_video_upload !=0 || $photograph_slider_youtube_url !='' || $photograph_settings['photograph_video_category'] !='') ){ ?>
			<div class="vid-thumb-tray clearfix">
				<?php
				if($photograph_slider_video_display=='video') {
					if(($photograph_video_upload ==0) && ($photograph_slider_youtube_url == '') ){ ?>
						<?php while ($query->have_posts() && ($photograph_settings['photograph_video_category'] !='')):$query->the_post();
						$attachment_id = get_post_thumbnail_id();
						$image_attributes = wp_get_attachment_image_src($attachment_id,'full'); ?>
						<div class="vid-thumb-bg jarallax" title="<?php the_title_attribute(); ?>" data-jarallax style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');">
						<?php endwhile; ?>
					<?php } else {
						if ($photograph_video_upload !=0 && $photograph_slider_youtube_url==''){  ?>
							<div class="vid-thumb-bg jarallax movie" data-jarallax-video="mp4:<?php echo esc_url(wp_get_attachment_url( $photograph_video_upload ));?>">
						<?php } else { ?>
							<div class="vid-thumb-bg jarallax movie" data-jarallax-video="<?php echo esc_url($photograph_slider_youtube_url);?>">
						<?php }
						}

				}
				if($photograph_settings['photograph_video_category'] !='') { ?>
					<?php while ($query->have_posts()):$query->the_post(); ?>
						<div class="vid-thumb-content">
							<div class="vid-thumb-text">
								<h2 class="vid-thumb-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<!-- .vid-thumb-title -->
								<?php if ( ( get_the_excerpt() !='' ) ): ?>
									<span class="vid-thumb-text-area"><?php the_excerpt(); ?></span>
									<!-- end .vid-thumb-text -->
								<?php endif; ?>
							</div>
							<!-- end .vid-thumb-text-content -->
						</div>
						<!-- end .vid-thumb-content -->
					<?php endwhile;
				} ?>
				<?php
				if($photograph_slider_video_display=='video') {
					echo	'</div> <!-- end .vid-thumb-bg -->';
				} ?>
			</div><!-- end .vid-thumb-tray -->
	<?php }

}
/*********************** photograph Category SLIDERS ***********************************/
function photograph_category_sliders() {
	global $post;
	$photograph_settings = photograph_get_theme_options();
	global $excerpt_length;
	$photograph_tag_text = $photograph_settings['photograph_tag_text'];
	$entry_format_meta_blog = $photograph_settings['photograph_entry_meta_blog'];
	$category = $photograph_settings['photograph_default_category_slider'];
	$query = new WP_Query(array(
				'posts_per_page' =>  intval($photograph_settings['photograph_slider_number']),
				'post_type' => array(
					'post'
				) ,
				'category_name' => esc_attr($category),
			));

	if($query->have_posts() && !empty($category) ){ ?>

		<div class="main-slider animation-bottom clearfix">
			<div class="layer-slider">
				<ul class="slides">
					<?php while ($query->have_posts()):$query->the_post();
						$attachment_id = get_post_thumbnail_id();
						$image_attributes = wp_get_attachment_image_src($attachment_id,'photograph_slider_image');
						$title_attribute = apply_filters('the_title', get_the_title(get_queried_object_id()));
						$excerpt = get_the_excerpt();
							echo '<li>';
							if ($image_attributes) {
								echo  '<div class="image-slider" title="'.the_title_attribute('echo=0').'"' .' style="background-image:url(' ."'" .esc_url($image_attributes[0])."'" .')">';
							}else{
								echo  '<div class="image-slider">';
							}
							echo  '<article class="slider-content">';
							if ($title_attribute != '' || $excerpt != '') {
								echo  '<div class="slider-text-content">';

								$remove_link = $photograph_settings['photograph_slider_link'];
									if($remove_link == 0){
										if ($title_attribute != '') {
											echo '<h2 class="slider-title"><a href="'.esc_url(get_permalink()).'" title="'.the_title_attribute('echo=0').'" rel="bookmark">'.get_the_title().'</a></h2><!-- .slider-title -->';
										}
									}else{
										echo '<h2 class="slider-title">'.get_the_title().'</h2><!-- .slider-title -->';
									}

									if ($excerpt != '') {
										echo '<p class="slider-text">'.wp_strip_all_tags( get_the_excerpt(), true ).'</p><!-- end .slider-text -->';
									}
								echo  '</div><!-- end .slider-text-content -->';
							}
							echo '</article><!-- end .slider-content --> ';
							echo '</div><!-- end .image-slider -->
							</li>';
						endwhile;
			wp_reset_postdata(); ?>
			</ul><!-- end .slides -->
		</div> <!-- end .layer-slider -->
	</div> <!-- end .main-slider -->
<?php }
}
/*************************** Getting Cat ID dynamic ****************************************/
function photograph_post_categories_list() {
	global $post;
	$photograph_post_id = $post->ID;
	$photograph_categories_list = get_the_category($photograph_post_id); ?>
	<span class="cats-links">
		<?php if( !empty( $photograph_categories_list ) ) {
				foreach ( $photograph_categories_list as $category_list ) {
					$photograph_category_name = $category_list->name;
					$photograph_category_id = $category_list->term_id;
					$photograph_category_link = get_category_link( $photograph_category_id ); ?>
						<a href="<?php echo esc_url( $photograph_category_link ); ?>"><?php echo esc_html( $photograph_category_name ); ?></a>
			<?php  }
			} ?>
	</span><!-- end .cat-links -->
<?php }

add_action( 'photograph_post_categories_list_id', 'photograph_post_categories_list' );
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

/**************** Categoy Lists ***********************/

if( !function_exists( 'photograph_categories_lists' ) ):
    function photograph_categories_lists() {
        $photograph_cat_args = array(
            'type'       => 'post',
            'taxonomy'   => 'category',
        );
        $photograph_categories = get_categories( $photograph_cat_args );
        $photograph_categories_lists = array('' => esc_html__('--Select--','photograph'));
        foreach( $photograph_categories as $category ) {
            $photograph_categories_lists[esc_attr( $category->slug )] = esc_html( $category->name );
        }
        return $photograph_categories_lists;
    }
endif;

/**************** Tag list Lists ***********************/
if( !function_exists( 'photograph_tag_lists' ) ):
	function photograph_tag_lists() {
		$tags = get_tags();
		$photograph_tag_list = array('' => esc_html__('--Select--','photograph'));
		foreach ( (array) $tags as $tag ) {
			$photograph_tag_list[esc_attr( $tag->slug )] = esc_html($tag->name);
		}

		return $photograph_tag_list;
	}
endif;
