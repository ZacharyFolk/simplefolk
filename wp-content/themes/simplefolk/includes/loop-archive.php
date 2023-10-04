<?php
$term = get_queried_object();
$tax = $term->taxonomy;
$current_slug = $term->slug;
$args = array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'posts_per_page' => -1,
    'orderby' => 'random',
    'tax_query' => array(
        array(
            'taxonomy' => $tax,
            'terms' => $current_slug,
            'field' => 'slug',
        )
    ),
);
$atta_query = new WP_Query($args);
if ($atta_query->have_posts()) :
    while ($atta_query->have_posts()) :
        $atta_query->the_post();
        $id = get_the_ID();
?>
        <article class="archive-card">
            <?php get_lightbox_image($id); ?>
        </article>
<?php
    endwhile;
endif;
wp_reset_postdata();

?>