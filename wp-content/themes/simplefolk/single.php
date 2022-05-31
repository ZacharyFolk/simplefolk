<?php

/**
 * The template for displaying all single posts.
 *
 */
get_header();

while (have_posts()) {
    the_post(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php

                    if (has_post_thumbnail()) {
                        // Main Image
                    ?>
                <div class="entry-thumb">
                    <figure class="entry-thumb-content">
                        <a data-fancybox="gallery" data-caption="Cool ass caption"
                            href="<?php the_post_thumbnail_url(); ?>">
                            <?php the_post_thumbnail('medium_large'); ?></a>
                    </figure>
                </div>
                <?php }
                    ?>
                <?php the_content(); ?>
            </article>
        </main>
    </div>
    <?php
        get_sidebar();
        ?>
</div>
<?php }
get_footer();