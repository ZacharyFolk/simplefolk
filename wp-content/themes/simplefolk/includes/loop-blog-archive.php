<?php
$args = array(
    'post_type' => 'post',
    // 'tax_query' => array(
    // 	array(
    // 		'taxonomy' => 'people',
    // 		'field'    => 'slug',
    // 		'terms'    => 'bob',
    // 	),
    // ),
);
$query = new WP_Query($args);
$counter = 0;

while ($query->have_posts()) {
    $query->the_post();
    $post_link = get_permalink();
    $counter++;

    $article_classes = 'post-excerpt';


    if ($counter % 2 == 0) {
        $article_classes .= ' odd';
    }
?>
    <article class="<?php echo $article_classes; ?>" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1>
            <a href="<?php echo $post_link; ?>" title="View the full posts">
                <?php the_title(); ?>
            </a>
        </h1>
        <span>
            <?php the_date(); ?>
        </span>
        <div class="post-excerpt-container">
            <?php if (has_post_thumbnail()) : ?>
                <figure class="post-thumb">
                    <?php get_img_with_sizes('thumbnail'); ?>
                </figure>
            <?php endif; ?>
            <div class="excerpt-content">
                <?php the_excerpt(); ?>
                <span class="read-more"><a href="<?php echo $post_link; ?>" title="View the full posts">Read more
                        &raquo;</a></span>
            </div>
        </div>
    </article>
<?php
};

?>