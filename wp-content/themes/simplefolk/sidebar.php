<?php

/**
 * Sidebar template for displaying all single posts.
 *
 */

$id = get_the_ID();
$title = apply_filters('the_content', get_post_field('post_title', $id));
$content = apply_filters('the_content', get_post_field('post_content', $id));
$short_description = esc_attr(get_post_meta(get_the_ID(), 'photo_short', true));
$location = esc_attr(get_post_meta(get_the_ID(), 'photo_location', true));
$camera =  esc_attr(get_post_meta(get_the_ID(), 'photo_camera', true));
$film  = esc_attr(get_post_meta(get_the_ID(), 'photo_film', true));
$prints = esc_attr(get_post_meta(get_the_ID(), 'print_available', true));
?>

<aside id="secondary" class="widget-area">
    <?php
  if ($id) :

    echo the_title('<h1>', '</h1>');

    if ($short_description) :
      echo '<p>' . $short_description . '</p>';
    endif;

    if ($location) :
      echo '<p>Location: ' . $location . '</p>';
    endif;

    if ($camera) :
      echo '<p>Camera: ' . $camera . '</p>';
    endif;

    if ($film) :
      echo '<p>Film: ' . $film . '</p>';
    endif;

    echo hashed_tags();

    echo cat_thumb_heading();
    echo '<div id="cat_thumbs">';
    echo this_cats_thumbs($id);
    echo '</div>';
    echo get_cat_link();

  endif;
  ?>
</aside>