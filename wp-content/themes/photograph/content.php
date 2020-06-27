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
		$photograph_post_author = $photograph_settings['photograph_post_author'];
		$photograph_post_date = $photograph_settings['photograph_post_date'];
		$photograph_post_comments = $photograph_settings['photograph_post_comments'];
		 ?>
		<?php if( has_post_thumbnail() && $photograph_blog_post_image == 'on') { ?>
			<div class="entry-thumb">
				<figure class="entry-thumb-content">
					<?php if($photograph_settings['photograph_disable_fancy_box']==0){ ?>
					<a class="popup-image" data-fancybox="post-gallery" data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url($image_attributes[0]); ?>" >
						<?php the_post_thumbnail(); ?>
						</a>
					<?php }else { ?>
						<a class="popup-image" data-fancybox="post-gallery" data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url(get_permalink()); ?>" >
						<?php the_post_thumbnail(); ?>
						</a>
					<?php } ?>
				</figure><!-- end.post-featured-image  -->
				<?php if ( current_theme_supports( 'post-formats', $format ) ) { ?>
					<div class="entry-meta">
								<?php	printf( '<span class="entry-format"><a href="%1$s">%2$s</a></span>',
									esc_url( get_post_format_link( $format ) ),
									esc_attr(get_post_format_string( $format ))
								); ?>
					</div> <!-- end .entry-meta -->
				<?php	} ?>
				
			</div><!-- end .entry-thumb -->
		<?php } ?>
		<div class="entry-details">
			<header class="entry-header">
				<?php if($entry_format_meta_blog != 'hide-meta' ){
					echo  '<div class="entry-meta">';
					if($photograph_post_author !=1){
						echo '<span class="author vcard"><a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" title="'.the_title_attribute('echo=0').'"><i class="fa fa-user-o"></i> ' .esc_html(get_the_author()).'</a></span>';
					}
					if($photograph_post_date !=1){
						printf( '<span class="posted-on"><a href="%1$s" title="%2$s"><i class="fa fa-calendar-o"></i> %3$s </a></span>',
										esc_url(get_the_permalink()),
										esc_attr( get_the_time(get_option( 'date_format' )) ),
										esc_attr( get_the_time(get_option( 'date_format' )) )
									);
					}
					if ( comments_open() && $photograph_post_comments !=1) { ?>
							<span class="comments">
							<?php comments_popup_link( __( '<i class="fa fa-comment-o"></i> No Comments', 'photograph' ), __( '<i class="fa fa-comment-o"></i> 1 Comment', 'photograph' ), __( '<i class="fa fa-comment-o"></i> % Comments', 'photograph' ), '', __( 'Comments Off', 'photograph' ) ); ?> </span>
					<?php }
					echo  '</div> <!-- end .entry-meta -->';
				} ?>
				<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
			</header><!-- end .entry-header -->
			
			<div class="entry-content">
				<?php if($content_display == 'excerptblog_display'):
						the_excerpt(); ?>
					<a href="<?php the_permalink();?>" class="more-link"><?php echo esc_attr($photograph_tag_text);?><span class="screen-reader-text"> <?php the_title(); ?></span></a><!-- wp-default -->
					<?php else:
						the_content( esc_attr($photograph_tag_text));
					endif; ?>
			</div> <!-- end .entry-content -->

			<div class="entry-footer">
				<?php if($entry_format_meta_blog != 'hide-meta' ){ ?>
					<div class="entry-meta">
						<?php if ( current_theme_supports( 'post-formats', $format ) ) {
									printf( '<span class="entry-format"><a href="%1$s">%2$s</a></span>',
									esc_url( get_post_format_link( $format ) ),
									esc_attr(get_post_format_string( $format ))
								);
							}
						if($photograph_post_category !=1){
							do_action('photograph_post_categories_list_id');
						}

							if(!empty($tag_list)){ ?>
									<span class="tag-links">
										<?php   echo get_the_tag_list(); ?>
									</span> <!-- end .tag-links -->
							<?php } ?>
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