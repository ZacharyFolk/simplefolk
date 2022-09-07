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
        <div class="tag-container">
            <?php
            foreach ($all_tags as $single_tag) :
                $tag_name = $single_tag->name;
                $tag_link =  $single_tag->slug;
                $tag_description = $single_tag->description;
                $id = $single_tag->term_id;
            ?>

            <article class="archive-card tag-banner">
                <a href="<?php echo $tag_link; ?>"
                    title="View all photos tagged with #<?php echo strtolower($tag_name); ?>" />


                <?php get_tag_display('post_tag', $single_tag); ?>
                </a>

            </article>

            <?php endforeach; ?>
        </div>
    </main>
</div>
<?php get_footer(); ?>