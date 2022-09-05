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
<style>
.tag-banner a {
    display: flex;
    align-items: center;
}

.tag-banner span {
    text-align: center;
    min-height: 80px;
    min-width: 80px;
    background-color: var(--warm-00);
    display: inline-grid;
    align-items: center;
    text-align: center;
    padding: 0 20px;
}

.tag-wrap {
    position: relative;
    width: fit-content;
}

.tag-wrap header {
    position: absolute;
    width: 100%;
    top: 0;
    left: 0;
    background-image: linear-gradient(to right,
            rgba(0, 0, 0, .4) 0%,
            rgba(0, 0, 0, .2) 15%,
            rgba(0, 0, 0, 0) 100%);
}

.small-thumbs {
    display: flex;
}
</style>