<?php
// loop for custom attachment archives : gallery-category, gallery-tags

$term = get_queried_object();
$tax = $term->taxonomy;
$current_slug = get_query_var($tax);
$args = array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'posts_per_page' => -1,
    'orderby' => 'random',
    'tax_query' => array(
        array(
            'taxonomy' => $tax,
            'field' => 'slug',
            'terms' => $current_slug,
        )
    ),
);
$atta_query = new WP_Query($args);
if ($atta_query->have_posts()) :
    while ($atta_query->have_posts()) :
        $atta_query->the_post();
        $atta_img = wp_get_attachment_image($post->ID, 'medium_large');
        $atta_link = get_attachment_link();
?>
<article class="archive-card">
    <div class="archive-wrap">
        <header>
            <h1>
                <?php echo strtolower(the_title()); ?>
            </h1>
        </header>
        <div class="img-wrap">
            <a href="<?php echo $atta_link; ?>">
                <?php echo $atta_img ?>
            </a>
        </div>
    </div>
</article>
<?php
    endwhile;
endif;
wp_reset_postdata();
?>