<?php

/**
 * The template for displaying all single products.
 *
 */
get_header(); ?>

<div class="content-wrap single-post">
    <main id="main" class="single-main" role="main">
        <div id="primary" class="content-area">
            <?php get_template_part('includes/loop', 'single'); ?>
        </div>
    </main>
</div>
<?php
get_footer();
