<?php

/**
 * The template for the content of the card for archive pages 
 *
 */
?>
<article class="post-featured-item">
    <div class="post-featured-gallery-wrap main-archive-container">
        <!-- <div class="box-heading">
            <div class="box-col">
                
            </div>
        </div> -->

        <div class="box-content">
            <?php if (has_post_thumbnail()):?>
            <a title="<?php the_title_attribute(['before' => 'View the full post for ']); ?>"
                href="<?php echo esc_url(get_permalink()); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            <?php endif; ?>
			<h3><?php the_title(); ?></h3>
            <div class="post-tags">
                <?php echo hashed_tags(); ?>
            </div>
        </div>
    </div>
</article>