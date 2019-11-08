<?php
add_action( 'wp_enqueue_scripts', 'photo_child_enqueue_styles' );
function photo_child_enqueue_styles() {

    $parent_style = 'photo-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
// Use the after_setup_theme hook with a priority of 11 to load after the
// parent theme, which will fire on the default priority of 10
// removing support for post-formats, see: content.php #39

add_action( 'after_setup_theme', 'remove_meta_entry_format', 11 );
function remove_meta_entry_format() {
    remove_theme_support( 'post-formats' );
    // Add this line in to re-enable support for just Posts
  //  add_theme_support( post-formats', array( 'post' ) );
}
add_image_size( 'folk_recent_thumbs', 55, 55, true );


function delicious_recent_posts() {
  $args = array(
      'numberposts' => 5,
      'offset' => 0,
      'category' => 7,
      //'post__not_in' => array( $post->ID )
  );
    $del_recent_posts = new WP_Query($args);

        while ($del_recent_posts->have_posts()) : $del_recent_posts->the_post(); ?>
            <li>
                <a href="<?php esc_url(the_permalink()); ?>">
                    <?php the_post_thumbnail('folk_recent_thumbs'); ?>
                </a>
                <h4>
                    <a href="<?php esc_url(the_permalink()); ?>">
                        <?php esc_html(the_title()); ?>
                   </a>
                </h4>
            </li>
        <?php endwhile;
    wp_reset_postdata();
}

function my_recent_posts() {
// $args = array(
// 	'numberposts' => 10,
// 	'offset' => 0,
// 	'category' => 0,
// 	'orderby' => 'post_date',
// 	'order' => 'DESC',
// 	'include' => '',
// 	'exclude' => '',
// 	'meta_key' => '',
// 	'meta_value' =>'',
// 	'post_type' => 'post',
// 	'post_status' => 'draft, publish, future, pending, private',
// 	'suppress_filters' => true
// );
//
// $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
//

$args = array( 'numberposts' => '5', 'post__not_in' => array( get_the_ID() ) );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
	}
	wp_reset_query();
}

function add_font() {
$folk_font = array();
array_push( $folk_font, 'Special+Elite');
array_push( $folk_font, 'Rajdhani');
$folk_fonts = implode("|", $folk_font);

wp_register_style( 'folk-fonts', '//fonts.googleapis.com/css?family='.$folk_fonts.'&display=swap');
wp_enqueue_style( 'folk-fonts' );
}

add_action( 'wp_enqueue_scripts', 'add_font' );


?>
