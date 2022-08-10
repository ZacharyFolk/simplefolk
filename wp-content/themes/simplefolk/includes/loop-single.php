<?php
while (have_posts()) :
    the_post();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
?>
<div class="wrap">
    <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>
    <div class="content-wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                    <figure class="main-image">
                        <a data-fancybox="gallery" data-caption="<?php echo $image_caption; ?>"
                            href="<?php the_post_thumbnail_url(); ?>">
                            <?php get_img_with_sizes('medium_large'); ?>
                        </a>
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
</div>
<?php endwhile;