<?php // get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <header>
                <h1 class="page-title screen-reader-text">
                    <?php single_post_title(); ?>
                </h1>
            </header>

            <?php 	if ( have_posts() ) :
				// Start the Loop.
				while ( have_posts() ) : the_post();


if ( has_post_thumbnail() ) {
	// the current post has a thumbnail
	the_post_thumbnail('home');
} else {
	// the current post lacks a thumbnail
}

			// End the loop.
			endwhile;

	
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php // get_footer(); ?>
