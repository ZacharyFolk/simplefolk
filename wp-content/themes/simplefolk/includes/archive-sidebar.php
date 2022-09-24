<?php

/**
 * Sidebar template for displaying all single posts.
 */
$id = get_the_ID(); ?>
<?php if (($id)) :
  display_photo_meta($id);
  echo hashed_tags();

  get_template_part('includes/social-share');

  echo this_archive_cats_thumbs($id);
endif;
?>