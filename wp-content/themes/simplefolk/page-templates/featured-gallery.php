<?php

/**
 * Template for home page gallery
 *
 */
$gallery_heading = get_theme_mod('featured_heading');
if (empty($gallery_heading)) {
    $gallery_heading = 'Featured Collections';
}
$num_posts = (int)(get_theme_mod('num_posts', 10));
$tag_list = explode(',', esc_attr(get_theme_mod('tag_list')));
?>
<div class="featured-gallery-content">
    <div class="featured-gallery-header">
        <h2>
            <?php echo esc_html($gallery_heading); ?>
        </h2>
        <?php

        // Build button filters set from customizer tag_list
        // Display list of ones that match attachments that have that tag
        if ($tag_list) : ?>
            <div class="filter-by-tag">
                <input id="tag_toggle" title="Toggle Tags" type="checkbox">
                <label class="hashtag-container" for="tag_toggle">
                    <span class="icon-tag">#</span>
                </label>
                <div class="tag-buttons">
                    <?php $i = 0;
                    foreach ($tag_list as $tag) :
                        $post_tags = get_term_by('slug', $tag, 'hashtags');
                        if ($i == 0) :
                    ?>
                            <button type="button" class="active" data-category="*">All</button>
                            <?php
                            if ($post_tags) :
                                $tag_name = strtolower($post_tags->name);
                                $tag_name_link = str_replace(" ", "-", $tag_name)
                            ?>
                                <button type="button" data-category=".hashtags-<?php echo trim(esc_attr($tag_name_link)); ?>">
                                    <?php echo esc_html($tag_name); ?>
                                </button>
                            <?php endif; ?>
                            <?php else :
                            if ($post_tags) :
                                $tag_name = strtolower($post_tags->name);
                                $tag_name_link = str_replace(" ", "-", $tag_name)
                            ?>
                                <button type="button" data-category=".hashtags-<?php echo trim(esc_attr($tag_name_link)); ?>">
                                    <?php echo esc_html($tag_name); ?>
                                </button>
                <?php endif;
                        endif;
                        $i++;
                    endforeach;
                endif; ?>
                </div>
            </div>
    </div>
    <div class="archive-container">
        <?php
        // TODO : get_terms_with_exclusions() does not work with this query because id is not required, slugs already work
        // instead could give this it's own function and use same customizer values for terms array()
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit', // if do publish here it will only display ones that are attached to something
            'posts_per_page' => $num_posts,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'terms' => array('exclude'),
                    'field' => 'slug',
                    'operator' => 'NOT IN',

                )
            ),
        );
        $atta_query = new WP_Query($args);
        if ($atta_query->have_posts()) :
            while ($atta_query->have_posts()) :
                $atta_query->the_post();
                $id = get_the_ID(); ?>
                <article <?php post_class('archive-card'); ?>>
                    <?php get_lightbox_image($id); ?>
                </article>
        <?php
            endwhile;
        endif;
        wp_reset_postdata(); ?>
    </div>
</div>