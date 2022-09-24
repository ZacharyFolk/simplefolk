<?php

/**
 * The template for displaying all pages.
 */

get_header();
?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <?php get_template_part('includes/loop', 'page'); ?>
        </main>
    </div>
    <?php


    get_sidebar();

    ?>
</div>
<?php
get_footer();