<?php

/**
 * Template Name: Home Template
 *
 */

get_header();

?>
<div id="primary_full-width">
    <main id="main" class="site-main" role="main">
        <div class="home-top-container">
            <div class="home-main-content">
                <?php the_content(); ?>
            </div>
            <div class="home-aside-container">
                <div class="home-aside-1">
                    <?php
                    if (is_active_sidebar('home-1')) : ?>
                    <aside class="widget-area" aria-label="<?php esc_attr_e('Home One', 'simplefolk'); ?>">
                        <?php dynamic_sidebar('home-1'); ?>
                    </aside>
                    <?php endif; ?>
                </div>
                <div class="home-aside-2">
                    <?php
                    if (is_active_sidebar('home-2')) : ?>
                    <aside class="widget-area" aria-label="<?php esc_attr_e('Home Two', 'simplefolk'); ?>">
                        <?php dynamic_sidebar('home-2'); ?>
                    </aside>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php get_template_part('page-templates/featured-gallery'); ?>
    </main>
</div>
<?php get_footer();

//  Welcome to the website for me to express and indulge my passions for photography and web development. The subject matter ranges from the scales of a dragonfly wing to the galacic core of the milky way universe and a few things in between.  I am fascinated, amazed, and awe of life and I do my small part to pay tribute, to collect and categorize, a small representation of the experience. I love photography and the tools and medium I use are diverse as the subject matter.  A wide range of vintage and toy cameras, film and digital, experiments and stuff.