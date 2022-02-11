<?php
/**
 * The template for displaying content.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
$photograph_settings = photograph_get_theme_options(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-item');?>>
		<div class="post-featured-gallery-wrap freesia-animation fadeInUp">
		<?php
		$entry_format_meta_blog = $photograph_settings['photograph_entry_meta_blog'];
		$photograph_tag_text = $photograph_settings['photograph_tag_text'];
		$attachment_id = get_post_thumbnail_id();
		$image_attributes = wp_get_attachment_image_src($attachment_id,'full');
		$content_display = $photograph_settings['photograph_blog_content_layout'];
		$photograph_blog_post_image = $photograph_settings['photograph_blog_post_image'];
		$tag_list = get_the_tag_list();
		$format = get_post_format();
		$photograph_post_category = $photograph_settings['photograph_post_category'];
		 ?>

		<?php if( has_post_thumbnail() && $photograph_blog_post_image == 'on') { ?>
			<div class="entry-thumb">
				<figure class="entry-thumb-content">
						<a  data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url(get_permalink()); ?>" >
						<?php the_post_thumbnail(); ?>
						</a>

				</figure><!-- end.post-featured-image  -->
				<?php if ( current_theme_supports( 'post-formats', $format ) ) { ?>
					<div class="entry-meta">
								<?php


								printf( '<span class="entry-format"><a href="%1$s">%2$s</a></span>',
									esc_url( get_post_format_link( $format ) ),
									esc_attr(get_post_format_string( $format ))
								); ?>
					</div> <!-- end .entry-meta -->
				<?php	} ?>

			</div><!-- end .entry-thumb -->
		<?php } ?>

		<div class="entry-details">
			<header class="entry-header">
				<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
			</header><!-- end .entry-header -->

			<div class="entry-content">
				<?php if($content_display == 'excerptblog_display'):
						the_excerpt(); ?>
					<?php else:
						the_content( esc_attr($photograph_tag_text));
					endif; ?>
			</div> <!-- end .entry-content -->

			<div class="entry-footer">
					<div class="entry-meta">
						<?php

							if(!empty($tag_list)){ ?>
									<span class="tag-links">
										<?php   echo get_the_tag_list(); ?>
									</span> <!-- end .tag-links -->
					</div> <!-- end .entry-meta -->
				<?php } ?>
			</div> <!-- end .entry-footer -->
		</div><!-- end .entry-details -->
	</div><!-- end .post-featured-gallery-wrap -->

	<?php wp_link_pages( array(
			'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.esc_html__( 'Pages:', 'photograph' ),
			'after'             => '</div>',
			'link_before'       => '<span>',
			'link_after'        => '</span>',
			'pagelink'          => '%',
			'echo'              => 1
		) ); ?>
</article><!-- end .post -->
