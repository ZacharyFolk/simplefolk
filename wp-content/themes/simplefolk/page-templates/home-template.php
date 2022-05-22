<?php

/**
 * Template Name: Home Template
 *
 */

get_header();

//////////////////////////////////////////////
//                                          //
//    TODO : Create admin CMS for these     //
//                                          //
//////////////////////////////////////////////

$gallery_heading = "Latest Posts";
$featured_tabs = array ('dogs','night','birds','bears');
?>

<main id="main" class="site-main" role="main">
    <?php the_content(); ?>
    <div class="featured-gallery-wrap">
        <div class="featured-gallery-content">
            <div class="featured-gallery-header">
               
                <h2 class="featured-gallery-title">
                    <?php echo esc_html($gallery_heading); ?>
                </h2> 
                <div class="filters filter-button">

                        <?php
                            $i = 1;
                            foreach ($featured_tabs as $featured_tab) :
                                $post_tags = get_term_by('slug', $featured_tab, 'post_tag');
                                if ($i == 1) : ?>
                        <button type="button" class="active" data-category="*">All</button>
                        <button type="button"
                            data-category=".tag-<?php echo esc_attr($featured_tab); ?>"><?php echo esc_html($post_tags->name); ?></button>
                        <?php else : 
                            if($post_tags) :?>
                        <button type="button"
                            data-category=".tag-<?php echo esc_attr($featured_tab); ?>"><?php echo esc_html($post_tags->name); ?></button>
                        <?php endif; 
                        endif;
                                $i++;
                            endforeach;?>
                    
                </div>
            </div>

            <div class="featured-gallery gallery-col-4">
                <?php
                    $get_featured_posts = new WP_Query(array(
                        'posts_per_page' => 60,
                        'post_status'        =>    'publish',
                        'ignore_sticky_posts' =>    'true'
                    ));
                    while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post();
                        $attachment_id = get_post_thumbnail_id();
                        $image_attributes = wp_get_attachment_image_src($attachment_id, 'full');  ?>
                <article <?php post_class('featured-item'); ?>>
                    <div class="post-gallery-wrap freesia-animation fadeInUp">
                        <?php if (has_post_thumbnail()) { ?>
                        <div class="featured-image-content">


                            <!--// 
                        <a class="popup-image" data-fancybox="post-gallery" data-title="<?php // the_title_attribute(); ?>" 
                        href="<?php // echo esc_url($image_attributes[0]); ?>">
                        <?php //the_post_thumbnail(); ?>
                        </a> 
                        -->

                            <a class="popup-image" data-fancybox="post-gallery"
                                data-title="<?php the_title_attribute(); ?>"
                                href="<?php echo esc_url(get_permalink()); ?>">
                                <?php the_post_thumbnail(); ?>
                            </a>
                        </div><!-- end.featured-image-content -->
                        <?php } ?>
                        <div class="featured-text-content">
                            <h3 class="featured-title">
                                <a title="<?php the_title_attribute(); ?>"
                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                        </div>
                    </div>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata(); ?>
            </div>
        </div>
    </div>

</main>
<?php get_footer();