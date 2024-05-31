<?php
while (have_posts()) {
    the_post();

    // Get attachment details
    $image_id = get_post_thumbnail_id();
    $image_caption = wp_get_attachment_caption($image_id);
    $image = wp_get_attachment_image($image_id, 'large');
    $full_image_link = wp_get_attachment_image_url(get_the_ID(), 'full');

?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if ($image) : ?>
                        <figure class="main-image">
                            <a href="<?php echo esc_url($full_image_link); ?>" class="glightbox">
                                <?php echo $image; ?>
                            </a>
                            <?php if ($image_caption) : ?>
                                <figcaption><?php echo esc_html($image_caption); ?></figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php endif; ?>
                <?php } ?>
                </article>
            </main>
        </div>
        <aside id="secondary" class="widget-area">
            <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>
            <?php get_template_part('includes/archive-sidebar'); ?>
        </aside>
    </div>