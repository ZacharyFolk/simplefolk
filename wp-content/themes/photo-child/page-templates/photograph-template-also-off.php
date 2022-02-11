<?php

/**
 * Template Name: Photograph Template
 * Main template for home page and featured
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
get_header(); ?>
<main id="main" class="site-main" role="main">
	<div class="featured-gallery-wrap">
		<div class="featured-gallery-content <?php echo esc_attr($gallery_layout); ?> clearfix">
			<div class="featured-gallery-header">
				<div class="filters filter-button freesia-animation fadeInDown">
					<div><button type="button" class="active" data-category="*">Latest</button>
						<?php
						$exclude = array(9);
						$categories = get_categories(array(
							'exclude' => $exclude
						));
						foreach ($categories as $category) : ?>
							<button type="button" data-category=".category-<?php echo esc_attr($category->slug); ?>"><?php echo esc_attr($category->name); ?></button>
						<?php endforeach; ?>
					</div>
				</div>
			</div>

			<div class="featured-gallery gallery-col-5">
				<?php
				$get_featured_posts = new WP_Query(array(
					'posts_per_page' => 0,
					'post_status'		=>	'publish',
					'ignore_sticky_posts' =>	'true',
					'hide_empty' => 0
				));
				while ($get_featured_posts->have_posts()) :
					$get_featured_posts->the_post();
					$attachment_id = get_post_thumbnail_id();
					$image_attributes = wp_get_attachment_image_src($attachment_id, 'full');  ?>
					<article <?php post_class('featured-item'); ?>>
						<div class="post-gallery-wrap freesia-animation fadeInUp">
							<?php if (has_post_thumbnail()) : ?>
								<div class="featured-image-content">
									<!-- <a data-title="<?php //the_title_attribute(); 
														?>" href="<?php //echo esc_url(get_permalink()); 
																									?>" >
														<? php // the_post_thumbnail(); 
														?>
														</a> -->
									<a class="popup-image" data-fancybox="images" data-perma="<?php echo esc_url(get_permalink()); ?>" data-title="<?php the_title_attribute(); ?>" data-caption="<?php the_title_attribute(); ?>" href="<?php echo esc_url($image_attributes[0]); ?>">
										<?php the_post_thumbnail(); ?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</article>
				<?php endwhile;
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>
	<?php the_content(); ?>
</main>

<?php get_footer(); ?>