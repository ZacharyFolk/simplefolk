<?php

/**
 * The template for displaying all single posts.
 *
 */
get_header(); ?>

<div class="content-wrap single-post">
    <main id="main" class="single-main" role="main">
        <div id="primary" class="content-area">
            <?php get_template_part('includes/loop', 'single'); ?>
        </div>
        <?php get_sidebar(); ?>
    </main>
</div>
<?php
get_footer();