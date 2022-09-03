<?php

/**
 * Template Name: Attachment Category Template
 */
get_header();



$all_cats = get_terms(
    array(
        'taxonomy' => 'category',
        'hide_empty' => false,
        'exclude' => array(115) // category named "exclude" 
        // TODO : Find a way to pass the slug here instead of id
        // OR could programmatically set the category and id? 
    )
);


?>

<div id="primary_full_width">

    <main id="main" class="site-main">
        <div class="archive-container">
            <?php
            foreach ($all_cats as $cat) :
                $id = $cat->term_id;
            ?>

            <article class="archive-card">
                <div class="archive-wrap">
                    <?php featured_cat_card($id); ?>

                </div>
            </article>
            </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>