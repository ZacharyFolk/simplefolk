<?php

/**
 * Template Name: Collections Template
 */
get_header();
$all_cats = get_terms_with_exclusions(['exclude', 'asset'], 'collections');
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