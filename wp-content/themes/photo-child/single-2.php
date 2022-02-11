<?php
/**
 * The template for displaying all single posts.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
get_header();
$photograph_settings = photograph_get_theme_options();
$photograph_display_page_single_featured_image = $photograph_settings['photograph_display_page_single_featured_image'];
$format = get_post_format();
$photograph_entry_meta_single = $photograph_settings['photograph_entry_meta_single'];
$tag_list = get_the_tag_list();
$photograph_post_category = $photograph_settings['photograph_post_category'];
$photograph_post_author = $photograph_settings['photograph_post_author'];
$photograph_post_date = $photograph_settings['photograph_post_date'];
$photograph_post_comments = $photograph_settings['photograph_post_comments'];
while( have_posts() ) {
	the_post(); ?>

	<!-- // todo : remove this when have header fixed -->
<div class="wrap">
	<div <?php post_class('single-post-title'); ?>>

	</div> <!-- end.single-post-title -->
</div> <!-- end .wrap -->

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
				<?php if(has_post_thumbnail() && $photograph_display_page_single_featured_image == 0 ) :
					$imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "size" ); ?>
					<?php if( $prev_post = get_previous_post() ):
					previous_post_link( '%link',"<span class='previous-post'>&laquo;</span>", FALSE );
					endif; ?>
					<?php if( $next_post = get_next_post() ):
					next_post_link( '%link',"<span class='next-post'>&raquo;</span>", FALSE );
				endif; ?>
			<?php endif;?>
					<div class="main-post-image">
						<a data-fancybox href="<?php echo $imgUrl[0]; ?>">
							<?php the_post_thumbnail(); ?>
						</a>
					</div>

					<h1 class="photo-title"><?php the_title();?></h1>
					<p><?php the_content();?></p>
					<?php echo get_the_tag_list('<p>Tags: ',', ','</p>'); ?>
					<?php if( $prev_post = get_previous_post() ):
	previous_post_link( '%link',"<span class=''>&laquo; Previous </span>", FALSE );
	endif; ?>
	<?php if( $next_post = get_next_post() ):
	next_post_link( '%link',"<span class=''>Next &raquo;</span>", FALSE );
endif; ?>
			</article>
		</main>
	</div>
</div>
<?php }
get_footer();
