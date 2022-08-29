<?php

/**
 * Template Name: Attachment Category Template
 */
get_header();

$all_cats = get_terms(
    array(
        'taxonomy' => 'category',
        'hide_empty' => false,
    )
);
?>

<div id="primary_full_width">

    <main id="main" class="site-main">
        <div class="archive-container">
            <?php
            foreach ($all_cats as $cat) :
                $title = $cat->name;
                $slug = $cat->slug;
                $desc = $cat->description;
            ?>

            <article class="archive-card">
                <div class="archive-wrap">
                    <header>
                        <h1>
                            <?php echo  $title; ?>
                        </h1>
                    </header>
                    <div class="img-wrap">
                        <a href="<?php echo $slug; ?>"
                            title="View all photos from the collection <?php echo strtolower($title); ?>">
                            <?php get_random_atta_img_src_by_term('category', $slug); ?>
                        </a>
                    </div>
                    <?php if ($desc) :
                            echo '<p>' . $desc . '</p>';
                        endif;
                        ?>
                </div>
            </article>
            </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>