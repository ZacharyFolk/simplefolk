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
        <?php
        the_archive_description('<div class="taxonomy-description">', '</div>');
        ?>
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
