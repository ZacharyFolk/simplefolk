<?php
while (have_posts()) :
    the_post();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
    $image = wp_get_attachment_image($image_id, 'large'); // set as w=0(auto) max height=900
    $full_image_link = wp_get_attachment_image_url($post->ID, 'full');
?>
<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if ($image) : ?>
                <figure class="main-image">
                    <a href="<?php echo $full_image_link; ?>" class="glightbox">
                        <?php echo $image; ?>
                    </a>
                </figure>
                <?php if ($image_caption) :
                            echo '<figcaption>' . $image_caption . '</figcaption>';
                        endif;
                    endif; ?>
            </article>
        </main>
    </div>
    <aside id="secondary" class="widget-area">
        <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>

        <?php get_template_part('includes/archive-sidebar'); ?></aside>
</div>
<?php endwhile; ?>