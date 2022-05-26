<?php

/**
 * Template Name: Tags Root Template
 */
get_header();
?>
<div id="primary_full_width">
    <main id="main" class="site-main">
        <div class="archive-container">
            <?php
            $all_tags = get_tags();
            foreach ($all_tags as $single_tag) :
                $tag_name = $single_tag->name;
                $tag_link =  $single_tag->slug;
            ?>
            <article class="archive-card">
                <div class="archive-wrap">
                    <header>
                        <h1>

                            #<?php echo strtolower($single_tag->name); ?>

                        </h1>

                    </header>

                    <div class="img-wrap">
                        <?php echo get_random_img_src_by_tag($tag_name); ?>
                    </div>

                    <p><?php echo $single_tag->description; ?></p>
                    <div class="tag-link">
                        <a class="buttonish" href="<?php echo $tag_link; ?>"
                            title="View all photos from the project <?php echo strtolower($tag_name); ?>">
                            View all photos tagged with #<?php echo strtolower($tag_name); ?>
                        </a>
                    </div>


            </article>
            </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>