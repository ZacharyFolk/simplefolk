<?php

/**
 * Template for home page gallery
 *
 */
$gallery_heading = esc_attr(get_theme_mod('featured_heading', 'Featured Posts'));
$num_posts = (int)(get_theme_mod('num_posts', 10));
$tag_list = explode(',', esc_attr(get_theme_mod('tag_list')));
?>
<div class="featured-gallery-content">
    <div class="featured-gallery-header">
        <h2>
            <?php echo esc_html($gallery_heading); ?>
        </h2>
        <?php
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit', // if do publish here it will only display ones that are attached to something
            'posts_per_page' => $num_posts,
            'orderby' => 'random',
            'tax_query' => array(
                array(
                    'taxonomy' => 'gallery-category',
                    'terms' => array('exclude'),
                    'field' => 'slug',
                    'operator' => 'NOT IN',

                )
            ),
        );

        // Build button filters set from customizer tag_list
        // Display list of ones that match attachments that have that tag
        if ($tag_list) : ?>
        <div class="filter-by-tag">
            <input id="tag_toggle" type="checkbox" />
            <label class="hashtag-container" for="tag_toggle">
                <span class="icon-tag"></span>
            </label>

            <div class="tag-buttons">
                <?php $i = 0;
                    foreach ($tag_list as $tag) :
                        $post_tags = get_term_by('slug', $tag, 'gallery-tags');
                        if ($i == 0) : ?>
                <button type="button" class="active" data-category="*">All</button>
                <?php else :
                            if ($post_tags) :
                                $tag_name = $post_tags->name;
                            ?>
                <button type="button" data-category=".gallery-tags-<?php echo trim(esc_attr($tag_name)); ?>">
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
        <?php $atta_query = new WP_Query($args);
        if ($atta_query->have_posts()) :
            while ($atta_query->have_posts()) :
                $atta_query->the_post();
                $atta_img = wp_get_attachment_image($post->ID, 'medium_large');
                // todo : Add customizer configs to enable/disable modal view and instead link directly to attachment page
                // worth providing different links / sitemap for bots that link to attachment
                $full_image_link = wp_get_attachment_image_url($post->ID, 'full');
                $atta_link = get_attachment_link();
                $atta_tags = get_the_terms($post->ID, 'gallery-tags');
                $id = get_the_ID();
                $slide_class = "full-meta-" . $id;
                if ($atta_img) :
        ?>
        <article <?php post_class('archive-card'); ?>>
            <?php
                    echo '<a href="' . $full_image_link . '" 
                    class="glightbox"
                    data-desc-position="bottom"  // todo: configs for this
                    data-glightbox="description: .' . $slide_class . '">';
                    echo $atta_img;
                    echo '</a>';

                    echo '<div class="glightbox-desc ' . $slide_class .  '">'; // hidden element that shows in modal
                    modal_display_photo_meta($id);
                    echo '</div>';
                    echo '</article>';
                endif;
            endwhile;
        endif;
        wp_reset_postdata(); ?>
    </div>
</div>