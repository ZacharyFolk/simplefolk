<?php

/**
 * Sidebar template for displaying all single posts.
 * TODO : Cleaner way to exclude specific pages (About) ?
 */
$id = get_the_ID();
?>
<aside id="secondary" class="widget-area">
    <?php if (($id) && !is_page('About')) :

    display_photo_meta($id);
    echo hashed_tags();
    echo this_cats_thumbs($id);
  endif;
  ?>
    <?php
  if (is_page('About')) :
    if (is_active_sidebar('about-sidebar')) : // Widgets if available 
  ?>
    <div class="sidebar about-sidebar">
        <?php dynamic_sidebar('about-sidebar'); ?>
    </div>
    <?php endif;
    echo '<h1>Self Portraits</h1>';
    echo get_gallery_by_tag('self-portrait');

  endif; ?>
</aside>