<?php

/**
 * Template Name: Blog Template
 */
get_header(); ?>

<div class="wrap">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php
            get_template_part('includes/loop', 'blog-archive'); ?>
        </main>
    </div>
    <!-- <aside id="secondary" class="widget-area">
        <?php // get_sidebar(); 
        ?>
    </aside> -->
</div>
<?php
get_footer();
