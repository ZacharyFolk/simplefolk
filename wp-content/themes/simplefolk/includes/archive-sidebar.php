<?php

/**
 * Sidebar template for displaying all single posts.
 */
$id = get_the_ID(); ?>
<?php if (($id)) :
  display_photo_meta($id);

  get_template_part('includes/social-share');

  echo this_collections_thumbs($id);
endif;
?>