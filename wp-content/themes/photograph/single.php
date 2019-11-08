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
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title();?></h1> <!-- end.entry-title -->
				
				<?php if($photograph_entry_meta_single !='hide'){
					echo  '<div class="entry-meta">';
					if($photograph_post_author != 1){
						echo '<span class="author vcard"><a href="'.esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )).'" title="'.the_title_attribute('echo=0').'"><i class="fa fa-user-o"></i> ' .esc_html(get_the_author()).'</a></span>';
					}
					if($photograph_post_date !=1){
						printf( '<span class="posted-on"><a href="%1$s" title="%2$s"><i class="fa fa-calendar-o"></i> %3$s </a></span>',
										esc_url(get_the_permalink()),
										esc_attr( get_the_time(get_option( 'date_format' )) ),
										esc_attr( get_the_time(get_option( 'date_format' )) )
									);
					} 
					if ( comments_open()  && $photograph_post_comments !=1) { ?>
							<span class="comments">
							<?php comments_popup_link( __( '<i class="fa fa-comment-o"></i> No Comments', 'photograph' ), __( '<i class="fa fa-comment-o"></i> 1 Comment', 'photograph' ), __( '<i class="fa fa-comment-o"></i> % Comments', 'photograph' ), '', __( 'Comments Off', 'photograph' ) ); ?> </span>
					<?php }

					if ( current_theme_supports( 'post-formats', $format ) ) {
						printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
						sprintf( ''),
						esc_url( get_post_format_link( $format ) ),
						get_post_format_string( $format )
						);
					}

					if($photograph_post_category !=1){
						do_action('photograph_post_categories_list_id');
					}		
					
					if(!empty($tag_list)){ ?>
						<span class="tag-links">
							<?php   echo get_the_tag_list(); ?>
						</span> <!-- end .tag-links -->
					<?php }
					echo  '</div> <!-- end .entry-meta -->';
				} ?>
		</header> <!-- end .entry-header -->
	</div> <!-- end.single-post-title -->
</div> <!-- end .wrap -->

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
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
				) ); ?>
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