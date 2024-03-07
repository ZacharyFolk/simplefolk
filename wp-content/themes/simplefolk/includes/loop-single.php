<?php
while (have_posts()) :
    the_post();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
    $the_tags = get_the_tags();
    $tag_array = wp_list_pluck($the_tags, 'name');
    $tag_list = implode(', ', $tag_array);
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php echo the_title('<div id="post_title"><h1>', '</h1></div>'); ?>
        <div class="post-meta">
            <p>Published : <?php the_time('m/j/y g:i A'); ?></p>
        </div>
        <?php the_content(); ?>
    </article>
    <div class="post-navigation">
        <div class="previous-post-link"><?php previous_post_link('%link', 'Previous Post'); ?></div>
        <div class="next-post-link"><?php next_post_link('%link', 'Next Post'); ?></div>
    </div>
<?php
    if (comments_open() || get_comments_number()) {
        comments_template();
    }

endwhile;
