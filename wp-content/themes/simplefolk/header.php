<!DOCTYPE html>
<html class="no-js [🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️📸🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️]"
    <?php language_attributes(); ?>>
<?php get_template_part('commentapalooza'); ?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title><?php wp_title(''); ?></title>
    <meta name="description" content="<?php echo get_meta_description(); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <section class="top-nav">
        <div id="site_branding">
            <?php echo get_site_info(); ?>
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class="menu-button-container" for="menu-toggle">
            <div class="menu-button"></div>
        </label>

        <?php if (has_nav_menu('primary')) : ?>
        <ul class="menu">
            <?php if (has_nav_menu('primary')) :
                    wp_nav_menu(
                        array(
                            'container' => '',
                            'theme_location' => 'primary',
                            'items_wrap'     => '%3$s',
                        )
                    );
                endif; ?>
        </ul>
        <?php endif; ?>
        <input id="mode-toggle" type="checkbox" />
        <label class="mode-button-container" for="mode-toggle">
            <div class="mode-button">
            </div>
        </label>
    </section>
    <div id="crumb_wrap">
        <?php echo the_breadcrumb(); ?>
    </div>
    <div id="content" class="site-content">