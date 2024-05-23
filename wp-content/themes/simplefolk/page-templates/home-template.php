<?php

/**
 * Template Name: Home Template
 *
 */

get_header();

?>
<div id="primary_full-width">
    <main id="main" class="site-main">
        <div class="home-full-width">
            <?php
            if (is_active_sidebar('home-full-top')) : ?>
                <aside class="widget-area" aria-label="<?php esc_attr_e('Home Full Top', 'simplefolk'); ?>">
                    <?php dynamic_sidebar('home-full-top'); ?>
                </aside>
            <?php endif; ?>
        </div>
        <div class="home-top-container">

            <div class="home-main-content">
                zz
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
