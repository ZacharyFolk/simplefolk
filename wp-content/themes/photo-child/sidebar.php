<?php
$id = get_the_ID();
$title = apply_filters('the_content', get_post_field('post_title', $id));
$content = apply_filters('the_content', get_post_field('post_content', $id));
$photograph_settings = photograph_get_theme_options();

$photograph_post_category = $photograph_settings['photograph_post_category'];

?>

<aside id="secondary" class="widget-area">
  <?php
  if ($id) : ?>
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
    <p>
      <?php
      // Image Caption
      echo wp_get_attachment_caption(get_post_thumbnail_id());
      ?>
    </p>
    <div id="photo_tag_container">
      Tags : <?php echo hashed_tags(); ?>
    </div>
    <h3 class="cat-heading"><?php echo cat_thumb_heading(); ?></h3>
  <?php
    echo '<div id="cat_thumbs_wrap">';
    echo this_cats_thumbs($id);
    echo '</div>';
    echo get_cat_link();
  endif;
  ?>
</aside>

<script>
  var $container = jQuery('#recent_posts');


  jQuery(window).on('load', function() {

    // Fire Isotope only when images are loaded
    // $container.height(250);
    $container.show();

    $container.isotope({
      itemSelector: '.recent-item',
      percentPosition: true,
      masonry: {
        columnWidth: '.grid-sizer',
        gutter: 5
      }
    });



  });

  // callback used to set new height of container with hidden overflow
  $container.on('arrangeComplete', function(event) {
    jQuery('#cat_thumbs_wrap').height(350);
  });


  (function() {

    "use strict";

    document.addEventListener("contextmenu", function(e) {
      // e.preventDefault();
      console.log(e);
    });

  })();
</script>

<style>
  #right_context_window {
    display: none;
    z-index: 100;
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    width: 20%;
    height: 20%;
    background-color: purple;
  }
</style>
<div id="right_context_window">
  All images are © Zachary Folk 2021
  Please share using the social links or contact me if you are interested in using any of my images.
</div>