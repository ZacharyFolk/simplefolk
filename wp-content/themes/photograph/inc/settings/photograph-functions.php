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
		 ?>
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
