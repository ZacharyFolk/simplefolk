<!DOCTYPE html>
<html class="no-js [🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️📸🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️]" <?php language_attributes(); ?>>
<?php get_template_part('commentapalooza'); ?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header id="site-header">
        <div class="main-header">
            <div id="site-branding">
                <?php echo get_site_info(); ?>
            </div>
        
                <?php if (has_nav_menu('primary')) : ?>
                <nav class="header-nav">
                    <ul>
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
                </nav>
                <?php endif; ?>
           
        </div>
    </header>

    <div id="site-content-contain" class="site-content-contain">
        <div id="content" class="site-content">