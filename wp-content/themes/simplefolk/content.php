<?php

/**
 * The template for the content of the card for archive pages 
 *
 */
$fancy_link = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
?>
<article class="post-featured-item">
    <div class="post-featured-gallery-wrap main-archive-container">
        <div class="box-content">
            <?php if (has_post_thumbnail()) : ?>

            <?php the_post_thumbnail(); ?>

            <?php endif; ?>
            <div class="title-bar">
                <h3><?php the_title(); ?></h3>
                <div class="image-tools">
                    <div class="zoom-button">
                        <a class="popup-image" title="View the full sized image" data-fancybox="post-gallery"
                            href="<?php echo $fancy_link[0]; ?>">
                            <span class="icon-search-plus"></span>
                        </a>
                    </div>
                    <div class="goto-button"> <a
                            title="<?php the_title_attribute(['before' => 'View the full post for ']); ?>"
                            href="<?php echo esc_url(get_permalink()); ?>"><span class="icon-mail-forward"></span> </a>
                    </div>
                </div>
            </div>
            <div class="post-tags">
                <?php echo hashed_tags(); ?>
            </div>
        </div>
    </div>
</article>