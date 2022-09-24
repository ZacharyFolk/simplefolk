<?php

/**
 * Sidebar template container for widget area on single posts
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e('Blog Sidebar', 'simplefolk'); ?>">
    <?php
    if (is_page('about')) :
        dynamic_sidebar('about-1');
    else :
        dynamic_sidebar('sidebar-1');
    endif;
    ?>
</aside>