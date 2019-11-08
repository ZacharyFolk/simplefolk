<?php
if(!function_exists('photograph_get_option_defaults_values')):
	/******************** PHOTOGRAPH DEFAULT OPTION VALUES ******************************************/
	function photograph_get_option_defaults_values() {
		global $photograph_default_values;
		$photograph_default_values = array(
			'photograph_responsive'	=> 'on',
			'photograph_animate_css'	=> 0,
			'photograph_design_layout' => 'full-width-layout',
			'photograph_sidebar_layout_options' => 'right',
			'photograph_search_custom_header' => 0,
			'photograph_side_menu'	=> 0,
			'photograph_img-upload-footer-image' => '',
			'photograph_header_display'=> 'header_text',
			'photograph_scroll'	=> 0,
			'photograph_tag_text' => esc_html__('View More','photograph'),
			'photograph_excerpt_length'	=> '25',
			'photograph_reset_all' => 0,
			'photograph_stick_menu'	=>0,
			'photograph_logo_high_resolution'	=> 0,
			'photograph_blog_post_image' => 'on',
			'photograph_search_text' => esc_html__('Search &hellip;','photograph'),
			'photograph_header_design_layout'	=> '',
			'photograph_entry_meta_single' => 'show',
			'photograph_entry_meta_blog' => 'show-meta',
			'photograph_blog_content_layout'	=> 'excerptblog_display',
			'photograph_post_category' => 1,
			'photograph_post_author' => 1,
			'photograph_post_date' => 1,
			'photograph_post_comments' => 1,
			'photograph_footer_column_section'	=>'4',
			'photograph_disable_main_menu' => 0,
			'photograph_current_date'=>0,
			'photograph_instagram_feed_display'=>0,
			'photograph_blog_column_gallery_layout' => '4',
			'photograph_blog_gallery_border' => 'show',
			'photograph_blog_gallery_text_content' => 'show',
			'photograph_blog_gallery_box_layout' => 'fullwidth-layout-posts',
			'photograph_disable_volume_button' => 0,
			'photograph_disable_fancy_box'=>0,

			/* Slider Settings */
			'photograph_slider_video_display' => 'video',
			'photograph_video_upload' => '',
			'photograph_slider_youtube_url' => '',
			'photograph_video_category' => '',
			'photograph_slider_content_bg_color' => 'off',
			'photograph_slider_type'	=> 'default_slider',
			'photograph_slider_link' =>0,
			'photograph_enable_slider' => 'frontpage',
			'photograph_default_category_slider' => '',
			'photograph_slider_number'	=> '4',
			'photograph_slider_content'	=> 'on',
			/* Layer Slider */
			'photograph_animation_effect' => 'fade',
			'photograph_slideshowSpeed' => '5',
			'photograph_animationSpeed' => '7',
			'photograph_display_page_single_featured_image'=>0,
			/* Front page feature */
			/* Frontpage Feature Tag Tab */
			'photograph_disable_feature_tab_category'	=> 0,
			'photograph_total_feature_tab_tag'	=> '5',
			'potograph_total_posts_display' => '20',
			'photograph_feature_tab_title'	=> '',
			'photograph_tab_category' => '',
			'photograph_feature_tab_all_text' => esc_html__('All','photograph'),
			'photograph_column_gallery_layout' => '4',
			'photograph_hide_gallery_border' => '',
			'photograph_hide_show_gallery_title' => 'show-fgt-hover',
			'photograph_gallery_layout' => '',
			'photograph_gray_scale' => 'off',
			'photograph_gallery_box' => '',
			/*Social Icons */
			'photograph_top_social_icons' =>0,
			'photograph_side_menu_social_icons' =>0,
			'photograph_buttom_social_icons'	=>0,
			);
		return apply_filters( 'photograph_get_option_defaults_values', $photograph_default_values );
	}
endif;