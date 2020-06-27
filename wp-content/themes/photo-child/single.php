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
					$imgUrl = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "size" );
?>
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
				<div class="img-meta">
					<h1 class="entry-title"><?php the_title();?></h1>
				</div>
				<style>
				.post-grid-item {width: 40%; margin-bottom: 10px;}</style>
<script>
jQuery(function($) {
var $imgWdith = $(".main-post-image img").width();
$(".img-meta").css("max-width", $imgWdith +"px");
jQuery('.post-grid').isotope({
  itemSelector: '.post-grid-item',
	masonry: {
		gutter: 5
	}
});

});


</script>


					<p><?php the_content();?></p>
			</article>
		</main>
	</div>
	<?php
	get_sidebar();
	?>
</div>
<?php }
get_footer();
