<?php

/**
 * Sidebar template container for widget area on single posts
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e('Blog Sidebar', 'simplefolk'); ?>">
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside>