<?php
/**
 * The sidebar containing the main Sidebar area.
 *
 * @package Theme Freesia
 * @subpackage Photograph
 * @since Photograph 1.0
 */
	$photograph_settings = photograph_get_theme_options();
	if( $post ) {
		$layout = get_post_meta( get_queried_object_id(), 'photograph_sidebarlayout', true );
	}
	if( empty( $layout ) || is_archive() || is_search() || is_home() ) {
		$layout = 'default';
	}

if( 'default' == $layout ) { //Settings from customizer
	if(($photograph_settings['photograph_sidebar_layout_options'] != 'nosidebar') && ($photograph_settings['photograph_sidebar_layout_options'] != 'fullwidth')){ ?>
<?php
// todo : move this stuff into widgets
$id = get_the_ID();
$title = apply_filters('the_content', get_post_field('post_title', $id));
$content = apply_filters('the_content', get_post_field('post_content', $id));
echo $title;
echo $content;
echo get_the_tag_list('<p>Tags: ',', ','</p>');
?>
<ul class="thumb-pagination">
<?php
if( $prev_post = get_previous_post() ):

$prevpost = get_the_post_thumbnail( $prev_post->ID, 'thumbnail', array('class' => 'pagination-previous'));
$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $prev_post->ID ) );
echo $thumbnail[0];
echo '<div style="background-image: url(' . $thumbnail[0] . ')">';
// previous_post_link( '%link',"$prevpost  <p>Previous</p>", FALSE );
echo'</div>';
endif;

if( $next_post = get_next_post() ):
echo'<li>';
$nextpost = get_the_post_thumbnail( $next_post->ID, 'thumbnail', array('class' => 'pagination-next'));
next_post_link( '%link',"$nextpost  <p>Next</p>", FALSE );
echo'</li>';
endif;
 ?>
</ul>
<style>
/* .thumb-pagination {
    padding: 0;
    margin: 0;
    list-style: none;
}

.thumb-pagination li {
    float: left;
    height: 100px;
    width: 100px;
    margin: 5px;
    overflow: hidden;
}

.thumb-pagination img {
    display: inline-block;
    min-width: 150%;
    min-height: 150%;
    -ms-interpolation-mode: bicubic;
}

.thumb-pagination div {
    display: inline-block;
    width: 100px;
    height: 100px;
    margin: 5px;
    border: 3px solid #c99;
    background-position: center center;
    background-size: cover;
} */
</style>
<aside id="secondary" class="widget-area">
<?php }
}else{ // for page/ post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){ ?>
<aside id="secondary" class="widget-area">
  <?php }
	}?>
  <?php
	if( 'default' == $layout ) { //Settings from customizer
		if(($photograph_settings['photograph_sidebar_layout_options'] != 'nosidebar') && ($photograph_settings['photograph_sidebar_layout_options'] != 'fullwidth')): ?>
  <?php dynamic_sidebar( 'photograph_main_sidebar' ); ?>
</aside><!-- end #secondary -->
<?php endif;
	}else{ // for page/post
		if(($layout != 'no-sidebar') && ($layout != 'full-width')){
			dynamic_sidebar( 'photograph_main_sidebar' );
			echo '</aside><!-- end #secondary -->';
		}
	}

echo my_recent_posts();
