<?php

/**
 * Template Name: Home Template
 *
 */

get_header();

?>
<div id="primary_full-width">
    <main id="main" class="site-main" role="main">
        <?php the_content(); ?>
        <?php get_template_part('page-templates/featured-gallery'); ?>
    </main>
</div>
<?php get_footer();