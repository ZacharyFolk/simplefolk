<?php

/**
 * The template for the content of the card for archive pages 
 *
 */
$fancy_link = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
?>
<article class="archive-card">
    <div class="archive-wrap">
        <header>
            <h1>
                #<?php echo strtolower(the_title()); ?>
            </h1>
        </header>
        <div class="img-wrap">
            <?php if (has_post_thumbnail()) : ?>
            <a title="<?php the_title_attribute(['before' => 'View the full post for ']); ?>"
                href="<?php echo esc_url(get_permalink()); ?>">
                <?php the_post_thumbnail('medium_large'); ?>
            </a>
            <?php endif; ?>
        </div>
    </div>
</article>