<?php

/**
 * Template Name: Home Template
 *
 */

get_header();

?>

<main id="main" class="site-main" role="main">
    <?php the_content(); ?>
    <?php get_template_part('page-templates/featured-gallery'); ?>
</main>

<?php get_footer();