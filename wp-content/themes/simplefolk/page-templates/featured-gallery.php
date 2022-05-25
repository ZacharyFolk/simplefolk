<?php
//////////////////////////////////////////////
//                                          //
//    TODO : Create admin CMS for these     //
//                                          //
//////////////////////////////////////////////

$gallery_heading = "Latest Posts";
$featured_tabs = array('dogs', 'night', 'birds', 'bears');
$num_posts = 40;

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
            <div class="hashtag-container">
                #
            </div>
            <div class="tag-buttons">
                <?php
                $i = 1;
                foreach ($featured_tabs as $featured_tab) :
                    $post_tags = get_term_by('slug', $featured_tab, 'post_tag');
                    if ($i == 1) : ?>
                <button type="button" class="active" data-category="*">All</button>
                <button type="button"
                    data-category=".tag-<?php echo esc_attr($featured_tab); ?>"><?php echo esc_html($post_tags->name); ?></button>
                <?php else :
                        if ($post_tags) : ?>
                <button type="button"
                    data-category=".tag-<?php echo esc_attr($featured_tab); ?>"><?php echo esc_html($post_tags->name); ?></button>
                <?php endif;
                    endif;
                    $i++;
                endforeach; ?>
            </div>
        </div>
    </div>

    <div class="featured-gallery gallery-col-4">
        <?php
        $get_featured_posts = new WP_Query(array(
            'posts_per_page' => $num_posts,
            'post_status'        =>    'publish',
            'ignore_sticky_posts' =>    'true'
        ));
        while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post();
            $fancy_link = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        ?>
        <article <?php post_class('featured-item'); ?>>
            <?php if (has_post_thumbnail()) { ?>
            <div class="featured-image-content">
                <?php the_post_thumbnail(); ?>
            </div>
            <?php } ?>
            <div class="featured-text-content">
                <h3 class="featured-title">
                    <?php the_title(); ?>
                </h3>
                <div class="image-tools">
                    <div class="zoom-button">
                        <a class="popup-image" title="View the full sized image"
                            data-title="<?php the_title_attribute(); ?>" data-fancybox="post-gallery"
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
        </article>
        <?php
        endwhile;
        wp_reset_postdata(); ?>
    </div>
</div>