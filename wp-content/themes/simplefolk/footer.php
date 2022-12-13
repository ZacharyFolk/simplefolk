<?php

/**
 * The template for displaying the footer.
 */
?>
<?php
$copyright = get_theme_mod('copyright_info');
$fb = get_theme_mod('fb_link');
$twit = get_theme_mod('twit_link');
$insta = get_theme_mod('ig_link');
?>
</div><!-- end #content -->

<?php // TODO : Move footer info into customizer settings // 
?>
<footer id="colophon" class="site-footer">

    <div class="footer-wrap">
        <div class="site-name">
            <a title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" target="_blank"
                href="<?php echo esc_url(home_url('/')); ?>">
                <?php echo get_bloginfo('name', 'display'); ?>
            </a>
        </div>
        <?php


        echo '<div id="social_links">';
        if ($fb) :
            echo '<div class="fb-link"><a href="https://www.facebook.com/' . $fb . '" target="_blank">';
            get_template_part('assets/svg/fb');
            echo '</a></div>';
        endif;
        if ($twit) :
            echo '<div class="twitter-link"><a href="' . $twit . '" target="_blank">';
            get_template_part('assets/svg/twitter');
            echo '</a></div>';
        endif;
        if ($insta) :
            echo '<div class="instagram-link"><a href="' . $insta . '" target="_blank">';
            get_template_part('assets/svg/instagram');
            echo '</a></div>';
        endif;
        echo '</div>';

        if (function_exists('the_privacy_policy_link')) :
            the_privacy_policy_link(' | ', '<span role="separator" aria-hidden="true"></span>');
        endif;

        if ($copyright) :
            echo '<div class="copyright-container"> &copy; ' . sprintf(esc_attr__('Copyright %s  %s  All right reserved ', 'simplefolk'), $copyright, date("Y")) . '</div>';
        endif;
        ?>
    </div>
</footer>

<?php wp_footer(); ?>

</body>

</html>