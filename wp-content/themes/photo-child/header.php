<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif;
    wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php
    if (function_exists('wp_body_open')) {

        wp_body_open();
    } ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#site-content-contain"><?php esc_html_e('Skip to content', 'photograph'); ?></a>
        <!-- Masthead ============================================= -->
        <header id="masthead" class="site-header clearfix" role="banner">
    
            <div class="header-wrap">

                <!-- Top Header============================================= -->
                <div class="top-header">

                    <!-- Main Header============================================= -->
                    <div id="sticky-header" class="clearfix">
                        <div class="main-header clearfix">
                            <?php do_action('photograph_site_branding'); ?>

                            <!-- Main Nav ============================================= -->
              
                                <nav id="site-navigation" class="main-navigation clearfix" role="navigation" aria-label="<?php esc_attr_e('Main Menu', 'photograph'); ?>">

                                    <button type="button" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                                        <span class="line-bar"></span>
                                    </button>
                                    <!-- end .menu-toggle -->
                                    <?php if (has_nav_menu('primary')) {
                                        $args = array(
                                            'theme_location' => 'primary',
                                            'container'      => '',
                                            'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>',
                                        ); ?>

                                    <?php wp_nav_menu($args); //extract the content from apperance-> nav menu
                                    } else { // extract the content from page menu only
                                        wp_page_menu(array('menu_class' => 'menu', 'items_wrap'     => '<ul id="primary-menu" class="menu nav-menu">%3$s</ul>'));
                                    } ?>
                                </nav> <!-- end #site-navigation -->
                   
                        </div> <!-- end .main-header -->
                    </div> <!-- end #sticky-header -->
                </div> <!-- end .top-header -->
         
         
            </div><!-- end .header-wrap -->
  

        </header> <!-- end #masthead -->
        <!-- Main Page Start ============================================= -->
        <div id="site-content-contain" class="site-content-contain">
            <div id="content" class="site-content">