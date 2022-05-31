<?php
$id = get_the_ID();
$title = apply_filters('the_content', get_post_field('post_title', $id));
$content = apply_filters('the_content', get_post_field('post_content', $id));
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
      //    echo wp_get_attachment_caption(get_post_thumbnail_id());
      echo get_the_excerpt();
      ?>
    </p>
    <div id="photo_tag_container">
        Tags : <?php echo hashed_tags(); ?>
    </div>
    <h3 class="cat-heading"><?php echo cat_thumb_heading(); ?></h3>
    <?php
    echo '<div id="cat_thumbs">';
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


<div class="page-overlay"></div>
<nav id="context-menu" class="context-menu">
    <h6>All images &copy; copyright Zachary Folk</h6>
    <!-- <p>If you are interested in licensing an image please reach out to me using my contact form</p> -->
    <!-- <ul class="context-menu__items">
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="View">
          <i class="fa fa-eye"></i> View Task
        </a>
      </li>
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="Edit">
          <i class="fa fa-edit"></i> Edit Task
        </a>
      </li>
      <li class="context-menu__item">
        <a href="#" class="context-menu__link" data-action="Delete">
          <i class="fa fa-times"></i> Delete Task
        </a>
      </li>
    </ul> -->
</nav>
</footer> <!-- end #colophon -->
</div><!-- end .site-content-contain -->
</div><!-- end #page -->
<?php wp_footer(); ?>

<style type="text/css">
/* tasks */

.tasks {
    list-style: none;
    margin: 0;
    padding: 0;
}

.task {
    display: flex;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: solid 1px #dfdfdf;
}

.task:last-child {
    border-bottom: none;
}

/* context menu */

.context-menu {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    /* bring your own prefixes */
    /* transform: translate(-50%, -50%); */
    margin-top: -50px;
    margin-left: -120px;
    z-index: 10;
    padding: 20px;
    width: 240px;
    background-color: #fff;
    border: solid 1px #dfdfdf;
    box-shadow: 1px 1px 2px #cfcfcf;
}

.context-menu--active {
    display: block;
}

.context-menu__items {
    list-style: none;
    margin: 0;
    padding: 0;
}

.context-menu__item {
    display: block;
    margin-bottom: 4px;
}

.context-menu__item:last-child {
    margin-bottom: 0;
}

.context-menu__link {
    display: block;
    padding: 4px 12px;
    color: #0066aa;
    text-decoration: none;
}

.context-menu__link:hover {
    color: #fff;
    background-color: #0066aa;
}
</style>