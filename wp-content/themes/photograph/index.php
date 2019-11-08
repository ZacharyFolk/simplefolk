<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
get_header();
$photograph_settings = photograph_get_theme_options();
$photograph_blog_column_gallery_layout = $photograph_settings['photograph_blog_column_gallery_layout'];
$photograph_blog_gallery_border = $photograph_settings['photograph_blog_gallery_border'];
$photograph_blog_gallery_text_content = $photograph_settings['photograph_blog_gallery_text_content'];
$photograph_blog_gallery_box_layout = $photograph_settings['photograph_blog_gallery_box_layout'];
$blog_gallery_col='';
$blog_gallery_border='';
$blog_gallery_text_content='';
$blog_gallery_box_layout='';

if($photograph_blog_column_gallery_layout == '2'){
		$blog_gallery_col='post-gallery-col-2';
	} elseif ($photograph_blog_column_gallery_layout == '3'){
		$blog_gallery_col='post-gallery-col-3';
	}elseif ($photograph_blog_column_gallery_layout == '4'){
		$blog_gallery_col='post-gallery-col-4';
	} else {
		$blog_gallery_col='post-gallery-col-5';
	}

	if($photograph_blog_gallery_border == 'hide'){
		$blog_gallery_border='no-posts-border';
	}

	if($photograph_blog_gallery_text_content == 'show-on-hover'){
		$blog_gallery_text_content='text-hover-presentation';
	}

	if($photograph_blog_gallery_box_layout == 'box-gallery-post'){
		$blog_gallery_box_layout='box-gallery-post';
	}?>
<div class="wrap">
	<header class="page-header">
		<h2 class="page-title"><?php single_post_title();?></h2>
		<!-- .page-title -->
		<?php photograph_breadcrumb(); ?><!-- .breadcrumb -->
	</header><!-- .page-header -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="container post-featured-gallery <?php echo esc_attr($blog_gallery_col) .' '. esc_attr($blog_gallery_border) .' '. esc_attr($blog_gallery_text_content). ' '. esc_attr($blog_gallery_box_layout); ?>">
				<?php
				if( have_posts() ) {
					while(have_posts() ) {
						the_post();
						get_template_part( 'content', get_post_format() );
					}
				}
				else { ?>
				<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'photograph' ); ?> </h2>
				<?php } ?>
			</div> <!-- end .container -->
			<?php get_template_part( 'pagination', 'none' ); ?>
		</main><!-- end #main -->
	</div> <!-- #primary -->
</div><!-- end .wrap -->
<?php
get_footer();