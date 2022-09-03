<?php
while (have_posts()) :
    the_post();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);


?>

<div class="content-wrap single-post">
    <main id="main" class="single-main" role="main">
        <div id="primary" class="content-area">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if (has_post_thumbnail()) : ?>
                <figure class="main-image">
                    <a class="glightbox" data-caption="<?php echo $image_caption; ?>"
                        href="<?php the_post_thumbnail_url(); ?>">
                        <?php get_img_with_sizes('square_hero'); ?>
                    </a>
                </figure>

                <?php if ($image_caption) :
                            echo '<figcaption>' . $image_caption . '</figcaption>';
                        endif;
                    endif; ?>
                <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>
                <?php the_content(); ?>

            </article>
        </div>
        <?php get_sidebar(); ?>
    </main>
</div>

</div>

<?php endwhile;