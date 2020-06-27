<?php
/**
 * The template for displaying search content.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
$photograph_settings = photograph_get_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class();?>>
	<?php  $photograph_blog_post_image = $photograph_settings['photograph_blog_post_image'];
	if( has_post_thumbnail() && $photograph_blog_post_image == 'on') { ?>
		<div class="entry-thumb">
			<figure class="entry-thumb-content">
				<?php the_post_thumbnail(); ?>
			</figure>
		</div> <!-- end .entry-thumb -->
	<?php } ?>
	<header class="entry-header">
		<h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> <?php the_title();?> </a> </h2> <!-- end.entry-title -->
	</header><!-- end .entry-header -->
	<div class="entry-summary">
			<?php the_excerpt(); ?>		
	</div><!-- end .entry-content -->
</article><!-- end .post -->
