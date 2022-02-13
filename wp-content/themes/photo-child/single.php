<?php

/**
 * The template for displaying all single posts.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
get_header();
$photograph_settings = photograph_get_theme_options();
$photograph_display_page_single_featured_image = $photograph_settings['photograph_display_page_single_featured_image'];
$format = get_post_format();
$photograph_entry_meta_single = $photograph_settings['photograph_entry_meta_single'];
$tag_list = get_the_tag_list();
$photograph_post_category = $photograph_settings['photograph_post_category'];
$photograph_post_author = $photograph_settings['photograph_post_author'];
$photograph_post_date = $photograph_settings['photograph_post_date'];
$photograph_post_comments = $photograph_settings['photograph_post_comments'];
while (have_posts()) {
    the_post(); ?>
    <div class="wrap">
        <?php echo the_breadcrumb(); ?>
    </div>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if (has_post_thumbnail() && $photograph_display_page_single_featured_image == 0) {
                        // Main Image
                    ?>
                        <div class="entry-thumb">
                            <figure class="entry-thumb-content">
                                <a href="<?php the_post_thumbnail_url(); ?>"> <?php the_post_thumbnail(); ?></a>
                            </figure>
                        </div>
                    <?php }
                    ?>
                </article>
            </main>
        </div>
        <?php
        get_sidebar();
        ?>
    </div>
<?php }
get_footer();
