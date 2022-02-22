<?php

/**
 * Template Name: Category Template
 * Displays the page for category root - list all page
 */
get_header();
?>
<div id="photos_page" class="wrap">
    <div id="primary" class="content-area">
        <?php echo the_breadcrumb(); ?>
        <main id="main" class="site-main">
            <div class="container post-featured-gallery post-gallery-col-4">
                <?php
                $all_cats = get_categories();
                foreach ($all_cats as $cat) :
                    echo '<a href="/' . $cat->slug . '" title="View all photos from the project ' . strtolower($cat->name) . '">';
                ?>
                    <article class="post-featured-item">
                        <div class="post-featured-gallery-wrap main-archive-container">
                            <div class="box-heading">
                                <div class="box-col">
                                    <h2>
                                        <?php echo  $cat->name; ?>
                                    </h2>
                                </div>
                            </div>
                            <div class="box-content">
                                <?php
                                echo  get_random_image_src($cat->slug);
                                echo  '<p>' . $cat->description . '</p>';

                                ?>
                            </div>
                        </div>
                    </article>
                    </a>
                <?php endforeach; ?>
            </div>
        </main>
    </div>
</div>
<?php get_footer(); ?>