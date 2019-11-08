<?php
/**
 * Template Name: About Us Template
 *
 * Displays the About Us page template.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
get_header();
$attachment_id = get_post_thumbnail_id();
$image_attributes = wp_get_attachment_image_src($attachment_id,'full'); ?>
<div <?php post_class('about-contant'); if(has_post_thumbnail()){ ?> style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');" <?php } ?>>
	<div class="wrap">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<article>
					<header class="page-header">
						<h1 class="page-title"><?php the_title();?></h1>
						<!-- .page-title -->
						<?php photograph_breadcrumb(); ?><!-- .breadcrumb -->
					</header><!-- .page-header -->
					<div class="entry-content">
						<?php
							if( have_posts() ) {
								while( have_posts() ) {
									the_post();
									the_content();
									comments_template();
								}
							} else { ?>
							<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'photograph' ); ?> </h2>
							<?php } ?>

					</div> <!-- end #entry-content -->
				</article>
			</main> <!-- end #main -->
		</div> <!-- #primary -->
	</div><!-- end .wrap -->
</div><!-- end .about-content -->
<?php get_footer();