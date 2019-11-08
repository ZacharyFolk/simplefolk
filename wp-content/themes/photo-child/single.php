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
<div class="wrap">
	<div <?php post_class('single-post-title'); ?>>

	</div> <!-- end.single-post-title -->
</div> <!-- end .wrap -->

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
      			<h1 class="entry-title"><?php the_title();?></h1>
			<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
				<?php if(has_post_thumbnail() && $photograph_display_page_single_featured_image == 0 ){ ?>
					<div class="entry-thumb">
						<figure class="entry-thumb-content">
							<?php the_post_thumbnail(); ?>
						</figure>
					</div> <!-- end .entry-thumb -->
				<?php }
				 ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- end .entry-content -->
				<?php wp_link_pages( array(
					'before'            => '<div style="clear: both;"></div><div class="pagination clearfix">'.esc_html__( 'Pages:', 'photograph' ),
					'after'             => '</div>',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'pagelink'          => '%',
					'echo'              => 1
				) );
        echo get_the_tag_list('<p>Tagged with: ',', ','</p>'); ?>
			</article><!-- end .post -->
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
							'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'photograph' ),
						) );
			} elseif ( is_singular( 'post' ) ) {
			the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'photograph' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'photograph' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'photograph' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'photograph' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
				} ?>
		</main><!-- end #main -->
	</div> <!-- end #primary -->
	<?php
	get_sidebar();
	?>
</div><!-- end .wrap -->
<?php }
get_footer();
