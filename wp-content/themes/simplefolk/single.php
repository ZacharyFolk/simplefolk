<?php

/**
 * The template for displaying all single posts.
 *
 */
get_header();

while (have_posts()) :
    the_post();
    $image_caption =  wp_get_attachment_caption(get_post_thumbnail_id()); ?>


<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (has_post_thumbnail()) : ?>
                <figure class="main-image">
                    <a data-fancybox="gallery" data-caption="<?php echo $image_caption; ?>"
                        href="<?php the_post_thumbnail_url(); ?>">
                        <?php the_post_thumbnail('medium_large'); ?></a>
                </figure>
                <?php if ($image_caption) :
                            echo '<figcaption>' . $image_caption . '</figcaption>';
                        endif;
                    endif; ?>
                <div class="additional-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </main>
    </div>
    <?php
        get_sidebar();
        ?>
</div>
<?php endwhile;
get_footer();