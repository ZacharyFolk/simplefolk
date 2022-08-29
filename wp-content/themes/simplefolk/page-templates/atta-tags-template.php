<?php

/**
 * Template Name: Attachment Tags Root Template
 */
get_header();

$all_tags = get_terms(
    array(
        'taxonomy' => 'post_tag',
        'hide_empty' => false,
    )
);

?>
<div id="primary_full_width">
    <main id="main" class="site-main">
        <div class="archive-container">
            <?php
            foreach ($all_tags as $single_tag) :
                $tag_name = $single_tag->name;
                $tag_link =  $single_tag->slug;
                $tag_description = $single_tag->description;
            ?>
            <article class="archive-card">
                <div class="archive-wrap">
                    <header>
                        <h1>
                            #<?php echo ($tag_name); ?>
                        </h1>
                    </header>
                    <div class="img-wrap">
                        <a href="<?php echo $tag_link; ?>"
                            title="View all photos tagged with #<?php echo strtolower($tag_name); ?>" />
                        <?php get_random_atta_img_src_by_term('post_tag', $tag_name); ?>
                    </div>
            </article>
            </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>