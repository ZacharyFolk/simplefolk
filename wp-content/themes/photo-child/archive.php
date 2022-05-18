<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package photo-child
 */

get_header(); ?>
<div class="wrap">
    <?php echo the_breadcrumb(); ?>
    <header class="page-header">
        <?php if (is_category()) : ?>
            <h1>Collection of photos from the category :  <?php echo strtolower(get_queried_object()->name);  ?></h1>
        <?php else :  // is tags ?>
        <h1>Collection of photos tagged with  #<?php echo strtolower(get_queried_object()->name);  ?></h1>
        <?php endif; ?>

        <h2>

            <?php
        the_archive_description('<div class="taxonomy-description">', '</div>');
        ?>
        </h2>
    </header>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container post-featured-gallery post-gallery-col-4">
                <?php
                if (have_posts()) { ?>

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