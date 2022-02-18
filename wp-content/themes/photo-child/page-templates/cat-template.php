<?php

/**
 * Template Name: Category Template
 * Displays the page for category root - list all page
 */
get_header();
?>

Test Cateogry Root Page
<main id="main" class="site-main" role="main">
    <div class="container post-featured-gallery post-gallery-col-5">
        <div class="featured-gallery-wrap">
            <div class="featured-gallery-content clearfix">
                <div class="featured-gallery-header">
                    <h2 class="featured-gallery-title freesia-animation fadeInDown">HEADING</h2>
                    <div class="filters filter-button freesia-animation fadeInDown">
                        <div>
                            <?php
                            // $photograph_list_tab_tags = array();
                            // for ($i = 1; $i <= $photograph_total_feature_tab_tag; $i++) {
                            //   if (isset($photograph_settings['photograph_featured_tab_tag_' . $i]) && $photograph_settings['photograph_featured_tab_tag_' . $i] != '') {
                            //     $category_id = $photograph_settings['photograph_featured_tab_tag_' . $i];

                            //     $photograph_list_tab_tags    =    array_merge($photograph_list_tab_tags, array($category_id));
                            //   }
                            // }
                            $i = 1;
                            $tag_names = array();
                            $all_tags = get_tags();

                            foreach ($all_tags as $single_tag) :
                                $tag_name = strtolower($single_tag->name);
                                array_push($tag_names, $tag_name);

                            // $tag_link = get_tag_link($tag->term_id);
                            // $post_tag = $tag->slug;
                            // $desc = $tag->description;
                            // $count = $tag->count;
                            // $path = '/tag/' . $post_tag;

                            // $post_tags = get_term_by('slug', $single_tag, 'post_tag');

                            endforeach;
                            foreach ($tag_names as $tag_list) :
                                //  var_dump($tag_list);
                                $post_tags = get_term_by('slug', $tag_list, 'post_tag');
                                if ($i == 1) {
                            ?>
                                    <button type="button" class="active" data-category="*">All</button>
                                    <button type="button" data-category=".tag-<?php echo esc_attr($tag_list); ?>"><?php echo esc_html($post_tags->name); ?></button>
                                <?php
                                } else { ?>
                                    <button type="button" data-category=".tag-<?php echo esc_attr($tag_list); ?>"><?php echo esc_html($post_tags->name); ?></button>
                            <?php }
                                $i++;
                            endforeach; ?>

                        </div>
                    </div> <!-- end .filter-button-group -->
                </div><!-- end .featured-gallery-header -->



                <div class="featured-gallery gallery-col-5">
                    <?php
                    $get_featured_posts = new WP_Query(array(
                        'posts_per_page' => intval(40),
                        'post_status'        =>    'publish',
                        'ignore_sticky_posts' =>    'true',
                        //'category_name' => esc_attr('gallery')

                    ));
                    while ($get_featured_posts->have_posts()) : $get_featured_posts->the_post();
                        $attachment_id = get_post_thumbnail_id();
                        $image_attributes = wp_get_attachment_image_src($attachment_id, 'full');  ?>
                        <article <?php post_class('featured-item'); ?>>
                            <div class="post-gallery-wrap freesia-animation fadeInUp">
                                <?php if (has_post_thumbnail()) { ?>
                                    <div class="featured-image-content">

                                        <a class="popup-image" data-fancybox="post-gallery" data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url(get_permalink()); ?>">
                                            <?php the_post_thumbnail(); ?>
                                        </a>

                                    </div><!-- end.featured-image-content -->
                                <?php } ?>

                                <div class="featured-text-content">
                                    <h3 class="featured-title">
                                        <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3> <!-- end.featured-title -->
                                </div> <!-- end .featured-text-content -->

                            </div> <!-- end.post-gallery-wrap -->
                        </article> <!-- end .post -->
                    <?php
                    endwhile;

                    wp_reset_postdata(); ?>
                </div> <!-- end .featured-gallery -->
            </div> <!-- end .featured-gallery-content -->
        </div> <!-- end .featured-gallery-wrap -->
    </div>
</main>
<?php get_footer();
