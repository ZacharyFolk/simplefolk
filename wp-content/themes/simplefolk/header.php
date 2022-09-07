<!DOCTYPE html>
<html class="no-js [🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️📸🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️🎞️]"
    <?php language_attributes(); ?>>
<?php get_template_part('commentapalooza'); ?>
<?php $analytics_key =  esc_attr(get_theme_mod('analytics_key')); ?>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <title><?php wp_title(''); ?></title>
    <meta name="description" content="<?php echo get_meta_description(); ?>">
    <?php wp_head(); ?>
    <?php if ($analytics_key) : ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $analytics_key; ?>"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '<?php echo $analytics_key; ?>');
    </script>
    <?php endif; ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <section class="top-nav">
        <div id="site_branding">
            <?php echo get_site_info(); ?>
        </div>
        <input id="menu-toggle" type="checkbox" />
        <label class="menu-button-container" for="menu-toggle">
            <div class="menu-button">
                <svg class="menu-closed" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="28"
                    viewBox="0 0 24 28">
                    <title>bars</title>
                    <path
                        d="M24 21v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 13v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1zM24 5v2c0 0.547-0.453 1-1 1h-22c-0.547 0-1-0.453-1-1v-2c0-0.547 0.453-1 1-1h22c0.547 0 1 0.453 1 1z">
                    </path>
                </svg>

                <svg class="menu-expanded" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="28"
                    viewBox="0 0 24 28">
                    <title>times-circle</title>
                    <path
                        d="M17.953 17.531c0-0.266-0.109-0.516-0.297-0.703l-2.828-2.828 2.828-2.828c0.187-0.187 0.297-0.438 0.297-0.703s-0.109-0.531-0.297-0.719l-1.406-1.406c-0.187-0.187-0.453-0.297-0.719-0.297s-0.516 0.109-0.703 0.297l-2.828 2.828-2.828-2.828c-0.187-0.187-0.438-0.297-0.703-0.297s-0.531 0.109-0.719 0.297l-1.406 1.406c-0.187 0.187-0.297 0.453-0.297 0.719s0.109 0.516 0.297 0.703l2.828 2.828-2.828 2.828c-0.187 0.187-0.297 0.438-0.297 0.703s0.109 0.531 0.297 0.719l1.406 1.406c0.187 0.187 0.453 0.297 0.719 0.297s0.516-0.109 0.703-0.297l2.828-2.828 2.828 2.828c0.187 0.187 0.438 0.297 0.703 0.297s0.531-0.109 0.719-0.297l1.406-1.406c0.187-0.187 0.297-0.453 0.297-0.719zM24 14c0 6.625-5.375 12-12 12s-12-5.375-12-12 5.375-12 12-12 12 5.375 12 12z">
                    </path>
                </svg>


            </div>
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
    </section>
    <div id="crumb_wrap">
        <?php echo the_breadcrumb(); ?>
    </div>
    <div id="content" class="site-content">