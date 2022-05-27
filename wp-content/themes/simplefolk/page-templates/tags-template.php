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
                $tag_description = $single_tag->description;
            ?>
            <article class="archive-card">
                <div class="archive-wrap">
                    <header>
                        <h1>

                            #<?php echo ($single_tag->name); ?>

                        </h1>

                    </header>

                    <div class="img-wrap">
                        <a href="<?php echo $tag_link; ?>"
                            title="View all photos tagged with #<?php echo strtolower($tag_name); ?>" />
                        <?php echo get_random_img_src_by_tag($tag_name); ?>
                    </div>

                    <?php if ($tag_description) :
                            echo '<p>' . $tag_description . '</p>';
                        endif;
                        ?>
            </article>
            </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>