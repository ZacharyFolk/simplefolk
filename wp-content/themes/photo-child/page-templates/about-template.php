<?php

/**
 * Template Name: About Template
 */
get_header();
$attachment_id = get_post_thumbnail_id();
$image_attributes = wp_get_attachment_image_src($attachment_id, 'full'); ?>
<div <?php post_class('about-contant');
		if (has_post_thumbnail()) { ?> style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');" <?php } ?>>
	<div class="wrap" style="margin-top: 50px;">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
				<article>
					<div class="entry-content">
						<?php
						if (have_posts()) {
							while (have_posts()) {
								the_post();
								the_content();
								comments_template();
							}
						} else { ?>
							<h2 class="entry-title"> <?php esc_html_e('No Posts Found.', 'photograph'); ?> </h2>
						<?php } ?>
					</div>
				</article>
			</main>
		</div>
		<aside id="secondary" class="widget-area">
			<?php echo do_shortcode('[contact-form-7 id="18" title="Contact"]'); ?>
		</aside>
	</div>
</div>

<?php get_footer();
