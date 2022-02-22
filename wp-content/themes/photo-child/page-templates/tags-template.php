<?php

/**
 * Template Name: Tags Root Template
 * Displays the Tags page
 */
get_header();
?>
<div id="photos_page" class="wrap">
    <div id="primary" class="content-area">
        <?php echo the_breadcrumb(); ?>
        <main id="main" class="site-main">
            <div class="container post-featured-gallery post-gallery-col-4">
                <?php
                $i = 1;
                $tag_names = array();
                $all_tags = get_tags();

                foreach ($all_tags as $single_tag) : ?>
                    <article class="post-featured-item">
                        <div class="post-featured-gallery-wrap main-archive-container">
                            <div class="box-heading">

                                <div class="box-col">
                                    <?php
                                    $tag_name = strtolower($single_tag->name);
                                    array_push($tag_names, $tag_name);

                                    echo '<h2>' . $tag_name . '</h2>';
                                    ?>
                                </div>
                            </div>
                            <div class="box-content">
                                <?php echo get_random_img_src_by_tag($tag_name); ?>
                            </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</div>

<?php get_footer(); ?>