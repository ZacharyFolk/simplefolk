<?php

$gallery_heading = esc_attr(get_post_meta(get_the_ID(), 'fpt_title', true));
$num_posts = (int)(get_post_meta(get_the_ID(), 'fpt_count', true));
$tag_list = explode(',', esc_attr(get_post_meta(get_the_ID(), 'fpt_list', true)));

////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                                                                                                        //
//    TODO : Should replace isotope, masonry, images loaded with https://github.com/desandro/colcade ?    //
//                                                                                                        //
////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<div class="featured-gallery-content">
    <div class="featured-gallery-header">
        <h2>
            <?php echo esc_html($gallery_heading); ?>
        </h2>
        <div class="filter-by-tag">
            <input id="tag_toggle" type="checkbox" />
            <label class="hashtag-container" for="tag_toggle">
                <div class="hashtag-button">#</div>
            </label>

            <div class="tag-buttons">
                <?php
                $i = 1;

                foreach ($tag_list as $featured_tab) :
                    $post_tags = get_term_by('slug', $featured_tab, 'post_tag');
                    if ($i == 1) :
                ?>
                <button type="button" class="active" data-category="*">All</button>
                <?php if ($post_tags) : ?>
                <button type="button"
                    data-category=".tag-<?php echo esc_attr($featured_tab); ?>"><?php echo esc_html($post_tags->name); ?></button>
                <?php endif;
                    elseif ($post_tags) :
                        ?>
                <button type="button"
                    data-category=".tag-<?php echo esc_attr($featured_tab); ?>"><?php echo esc_html($post_tags->name); ?></button>
                <?php endif;
                    $i++;
                endforeach; ?>
            </div>
        </div>
    </div>

    <div class="archive-container">
        <?php
        $get_featured_posts = new WP_Query(array(
            'posts_per_page' => $num_posts,
            'post_status'        =>    'publish',
            'ignore_sticky_posts' =>    'true'
        ));
        while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post();
            $fancy_link = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        ?>
        <article <?php post_class('archive-card'); ?>>

            <?php if (has_post_thumbnail()) { ?>

            <a title="<?php the_title_attribute(['before' => 'View the full post for ']); ?>"
                href="<?php echo esc_url(get_permalink()); ?>">
                <?php the_post_thumbnail(); ?>
            </a>

            <?php } ?>

        </article>
        <?php
        endwhile;
        wp_reset_postdata(); ?>
    </div>
</div>