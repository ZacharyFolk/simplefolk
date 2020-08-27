<?php
$id = get_the_ID();
$title = apply_filters('the_content', get_post_field('post_title', $id));
$content = apply_filters('the_content', get_post_field('post_content', $id));

?>

<aside id="secondary" class="widget-area">

      			<h1 class="entry-title"><?php the_title();?></h1>
            <p><?php the_content();?></p>

<?php echo get_the_tag_list('<p>Tags: ',', ','</p>'); ?>

<ul class="prevnext">
<?php
if( $prev_post = get_previous_post() ):

// $prevpost = get_the_post_thumbnail( $prev_post->ID, 'thumbnail', array('class' => 'pagination-previous'));
//$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ) );
//echo $thumbnail[0];
// echo '<div style="background-image: url(' . $thumbnail[0] . ')">';
// previous_post_link( '%link',"$prevpost  <p>Previous</p>", FALSE );
// boolean here defines whether to remain in category
previous_post_link( '%link',"<p>Previous</p>", FALSE );
//echo'</div>';
endif;

if( $next_post = get_next_post() ):
echo'<li>';
// $nextpost = get_the_post_thumbnail( $next_post->ID, 'thumbnail', array('class' => 'pagination-next'));
// next_post_link( '%link',"$nextpost  <p>Next</p>", FALSE );
next_post_link( '%link',"<p>Next</p>", FALSE );
echo'</li>';
endif;
 ?>
</ul>
<h2>Recent Posts</h2>
<?php
echo my_recent_posts();
 ?>
</aside>
<style>
#recent_posts{}
.grid-sizer,.recent-item {float: left; width: 30%}
.recent-item img {opacity: .8;
   transition: opacity .25s ease-in-out;
   -moz-transition: opacity .25s ease-in-out;
   -webkit-transition: opacity .25s ease-in-out;}
.recent-item img:hover {      opacity: 1;
}

</style>
<script>
var $container = jQuery('#recent_posts');

jQuery(window).on('load', function () {
    // Fire Isotope only when images are loaded
        $container.isotope({
          itemSelector: '.recent-item',
 percentPosition: true,
 masonry: {
   // use element for option
   columnWidth: '.grid-sizer'
 }
        });

  });
</script>
