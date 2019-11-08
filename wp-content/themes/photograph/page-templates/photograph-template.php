<?php
/**
 * Template Name: Photograph Template
 *
 * Displays Magazine template.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
get_header();

$photograph_settings = photograph_get_theme_options();
$photograph_feature_tab_title = $photograph_settings['photograph_feature_tab_title'];
$photograph_disable_feature_tab_category = $photograph_settings['photograph_disable_feature_tab_category'];
$photograph_total_feature_tab_tag = $photograph_settings['photograph_total_feature_tab_tag'];
$photograph_column_gallery_layout = $photograph_settings['photograph_column_gallery_layout'];
$photograph_hide_gallery_border = $photograph_settings['photograph_hide_gallery_border'];
$photograph_hide_show_gallery_title = $photograph_settings['photograph_hide_show_gallery_title'];
$photograph_gallery_layout = $photograph_settings['photograph_gallery_layout'];
$photograph_gray_scale = $photograph_settings['photograph_gray_scale'];
$photograph_gallery_box = $photograph_settings['photograph_gallery_box'];
$potograph_total_posts_display = $photograph_settings['potograph_total_posts_display'];
$photograph_tab_category = $photograph_settings['photograph_tab_category'];
$photograph_list_tab_tags	= array();
$border_class ='';
$gallery_title ='';
$gallery_layout ='';
$gray_scale = '';
$gallery_box = '';
if($photograph_hide_gallery_border =='no-border'){
	$border_class = 'no-border';
} 

if($photograph_hide_show_gallery_title =='show-fgt'){
	$gallery_title = 'show-fgt';
} elseif($photograph_hide_show_gallery_title =='show-fgt-hover') {
	$gallery_title = 'show-fgt-hover';
} else{
	$gallery_title = '';
}

if($photograph_gallery_layout =='fg-layout-2'){
	$gallery_layout = 'fg-layout-2';
}
if($photograph_gray_scale=='on'){
	$gray_scale ='grayscale-img';
}
if($photograph_gallery_box =='box-gallery'){
	$gallery_box = 'box-gallery';
} ?>

<main id="main" class="site-main" role="main">
	<?php if($photograph_disable_feature_tab_category !=1){ 
	 ?>
		<div class="featured-gallery-wrap <?php echo esc_attr($gallery_title).' ' . esc_attr($border_class). ' '. esc_attr($gray_scale). ' ' .esc_attr($gallery_box);  ?>">
			<div class="featured-gallery-content <?php echo esc_attr($gallery_layout); ?> clearfix">
				<div class="featured-gallery-header">
					<?php if($photograph_feature_tab_title !=''){ ?>
						<h2 class="featured-gallery-title freesia-animation fadeInDown"><?php echo esc_html($photograph_feature_tab_title); ?></h2>
					<?php } ?>
					<div class="filters filter-button freesia-animation fadeInDown">
						<div>
							<?php 

							$photograph_list_tab_tags = array();
							for($i=1; $i<=$photograph_total_feature_tab_tag; $i++){
								if( isset ( $photograph_settings['photograph_featured_tab_tag_' . $i] ) && $photograph_settings['photograph_featured_tab_tag_' . $i] !='' ){
									$category_id = $photograph_settings['photograph_featured_tab_tag_' . $i];

									$photograph_list_tab_tags	=	array_merge( $photograph_list_tab_tags, array( $category_id ) );
									}
								}
								$i=1;

								foreach ( $photograph_list_tab_tags as $photograph_tag_list) :
									$post_tags = get_term_by('slug', $photograph_tag_list, 'post_tag');
									if($i==1){ 

										if($photograph_settings['photograph_feature_tab_all_text'] !=''){  ?>
										<button type="button" class="active" data-category="*"><?php echo esc_attr($photograph_settings['photograph_feature_tab_all_text']); ?></button>
										<button type="button" data-category=".tag-<?php echo esc_attr($photograph_tag_list); ?>"><?php echo esc_attr($post_tags->name); ?></button>
										<?php } else { ?>
										<button type="button" class="active" data-category=".tag-<?php echo esc_attr($photograph_tag_list); ?>"><?php echo esc_attr($post_tags->name); ?></button>
										<?php }
									} else { ?>
										<button type="button" data-category=".tag-<?php echo esc_attr($photograph_tag_list); ?>"><?php echo esc_attr($post_tags->name); ?></button>
									<?php } 
									 $i++;
								endforeach; ?>
						</div>
					</div> <!-- end .filter-button-group -->
				</div><!-- end .featured-gallery-header -->
				
				<?php if($photograph_column_gallery_layout == '2'){
					$category_gallery_col='2';
				} elseif ($photograph_column_gallery_layout == '3'){
					$category_gallery_col='3';
				}elseif ($photograph_column_gallery_layout == '4'){
					$category_gallery_col='4';
				} else {
					$category_gallery_col='5';
				}?>
				<div class="featured-gallery gallery-col-<?php echo absint($category_gallery_col); ?>">
					<?php
					$get_featured_posts = new WP_Query( array(
							'posts_per_page' => intval($potograph_total_posts_display),
							'post_status'		=>	'publish',
							'ignore_sticky_posts'=>	'true',
							'category_name' => esc_attr($photograph_tab_category)

					) );
						while( $get_featured_posts->have_posts()):$get_featured_posts->the_post();
								$attachment_id = get_post_thumbnail_id();
								$image_attributes = wp_get_attachment_image_src($attachment_id,'full');  ?>
									<article <?php post_class('featured-item');?>>
										<div class="post-gallery-wrap freesia-animation fadeInUp">
											<?php if(has_post_thumbnail()){ ?>
												<div class="featured-image-content">
													<?php if($photograph_settings['photograph_disable_fancy_box']==0){ ?>
													<a class="popup-image" data-fancybox="post-gallery" data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url($image_attributes[0]); ?>" >
														<?php the_post_thumbnail(); ?>
														</a>
													<?php }else { ?>
														<a class="popup-image" data-fancybox="post-gallery" data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url(get_permalink()); ?>" >
														<?php the_post_thumbnail(); ?>
														</a>
													<?php } ?>
												</div><!-- end.featured-image-content -->
											<?php }
											if($photograph_hide_show_gallery_title !=''){ ?>
												<div class="featured-text-content">
													<h3 class="featured-title">
														<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
													</h3> <!-- end.featured-title -->
												</div> <!-- end .featured-text-content -->
											<?php } ?>
										</div> <!-- end.post-gallery-wrap -->
									</article> <!-- end .post -->
						<?php
					endwhile;

					wp_reset_postdata(); ?>
					</div> <!-- end .featured-gallery -->
				</div> <!-- end .featured-gallery-content -->
		</div> <!-- end .featured-gallery-wrap -->
	<?php }
	the_content(); ?>
</main> <!-- end #main -->
<?php get_footer();