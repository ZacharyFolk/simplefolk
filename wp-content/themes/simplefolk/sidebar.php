<?php

/**
 * Sidebar template for displaying all single posts.
 *
 */
$id = get_the_ID();
?>
<aside id="secondary" class="widget-area">
    <?php if ($id) :
    echo the_title('<h1>', '</h1>');
    display_photo_meta($id);
    echo hashed_tags();
    echo this_cats_thumbs($id);
  endif;
  ?>
</aside>