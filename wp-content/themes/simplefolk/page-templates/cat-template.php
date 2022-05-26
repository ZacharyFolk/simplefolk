<?php

/**
 * Template Name: Category Root Template
 */
get_header();

/* Currently naming category page projects, might want to change so setting var here */
$cat_dir = "/projects/";

$pre_txt = "View all photos from the project ";
?>

<div id="primary_full_width">

    <main id="main" class="site-main">
        <div class="archive-container">
            <?php
            $all_cats = get_categories();
            foreach ($all_cats as $cat) :
                $title = $cat->name;
                $slug = $cat->slug;
                $path = $cat_dir . $slug;
                $desc = $cat->description;
            ?>

            <article class="archive-card">
                <div class="archive-wrap">
                    <header>
                        <h1>
                            <?php echo  $cat->name; ?>
                        </h1>

                    </header>

                    <a href="<?php echo $path; ?>"
                        title="View all photos from the project <?php echo strtolower($title); ?>">
                        <?php
                            echo  get_random_image_src($slug);
                            ?>
                    </a>
                    <p>
                        <?php echo $desc; ?>
                        <a href="<?php echo $path; ?>">View all photos from this project. </a>
                    </p>
                </div>
            </article>
            </a>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php get_footer(); ?>