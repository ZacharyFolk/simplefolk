<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>
<?php echo the_breadcrumb(); ?>
<header class="page-header">

    <?php if (is_category()) :
        // $cat or tag name = strtolower(get_queried_object()->name);
    ?>
    <h1>
        <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
    </h1>
    <?php endif; ?>
</header>
<div id="primary_full-width" class="content-area">
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
<?php
get_footer();