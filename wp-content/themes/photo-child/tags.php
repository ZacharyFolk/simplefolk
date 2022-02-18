<?php

/**
 * The template for displaying tag pages
 */
get_header();
?>
<div id="tag_page" class="wrap">
	<header class="page-header">
		<h2 class="page-title"><?php echo 	single_term_title('Tagged with: ', false); ?></h2>
		<?php
		the_archive_description('<div class="tag-description">', '</div>');
		photograph_breadcrumb(); ?>
	</header>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			if (have_posts()) { ?>
				<div class="container post-featured-gallery post-gallery-col-4">
					<?php while (have_posts()) {
						the_post();
						get_template_part('content', get_post_format());
					}
				} else { ?>
					<h2 class="entry-title"> <?php esc_html_e('No Posts Found.', 'photograph'); ?> </h2>
				<?php } ?>
				</div>
				<?php get_template_part('pagination', 'none'); ?>
		</main>
	</div>
</div>
<?php
get_footer();
