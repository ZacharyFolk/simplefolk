<?php

////////////////////////////////////////
//                                    //
//    Load them scripts and styles    //
//                                    //
////////////////////////////////////////

define('SIMPLE_THEME_VERSION', '1.2.0');

function main_scripts()
{
  wp_enqueue_style('main',  get_theme_file_uri() . '/style.css', array(), SIMPLE_THEME_VERSION, 'all');
  wp_enqueue_style('icons',  get_theme_file_uri() . '/assets/icomoon/style.css', array(), SIMPLE_THEME_VERSION, 'all');
  wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri() . '/js/isotope-setting.js', array('isotope'), false, true);
  wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js');
}

add_action('wp_enqueue_scripts', 'main_scripts');



function single_scripts()
{
  if (is_singular('post')) {
    wp_enqueue_style('fancy',  get_theme_file_uri() . '/assets/fancybox/fancybox.css', array(), SIMPLE_THEME_VERSION, 'all');
    wp_enqueue_script('fancyboxjs',  get_theme_file_uri() . '/assets/fancybox/fancybox.js', array('jquery'), false, true);
  }
}

add_action('wp_enqueue_scripts', 'single_scripts');


include('customizer.php');

// Load styles for admin area

function simple_admin_css()
{
  if (is_admin()) {
    wp_enqueue_style(
      "simple_admin",
      get_bloginfo('template_directory') . "/simple_admin.css",
      false,
      false,
      "all"
    );
  }
}
add_action('admin_print_styles', 'simple_admin_css');
add_action('wp_enqueue_scripts', 'simple_admin_css');

//////////////////////////////////
//                              //
//    Disable Gutenberg  CSS    //
//                              //
//////////////////////////////////

function remove_gutenberg_block_library_css()
{
  $disable = esc_attr(get_theme_mod('gutenberg_blocks'));
  if ($disable) {
    wp_dequeue_style('wp-block-library');
  }
}


add_action('wp_enqueue_scripts', 'remove_gutenberg_block_library_css', 100);



//////////////////////////////
//                          //
//    Debug highlighter     //
//                          //
//////////////////////////////

function wut($var, $exit = false)
{
  echo '<pre style="font-size:14px;">';

  if (is_array($var) || is_object($var)) {
    echo htmlentities(print_r($var, true));
  } elseif (is_string($var)) {
    echo "string(" . strlen($var) . ") \"" . htmlentities($var) . "\"\n";
  } else {
    var_dump($var);
  }

  echo "\n</pre>";

  if ($exit) {
    exit;
  }
}

//////////////////////////////////////////////////
//                                              //
//     TODO : set up admin customize panel      //
//                                              //
//////////////////////////////////////////////////
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');

register_nav_menus(array(
  'primary' => __('Main Menu', 'simplefolk'),
  'side-nav-menu' => __('Side Menu', 'simplefolk'),
  'social-link'  => __('Add Social Icons Only', 'simplefolk'),
));

///////////////////////////
//                       //
//    Set image sizes    //
//                       //
///////////////////////////

/**
 * 
 * Home / Archive Gallery
 * Single Hero
 * Retina / Zoom? 
 * Sidebar thumbs */

// disable srcset on frontend
function disable_wp_responsive_images()
{
  return 1;
}
add_filter('max_srcset_image_width', 'disable_wp_responsive_images');


//////////////////////////
//                      //
//    Get site info     //
//                      //
//////////////////////////
/**
 * Returns the site title and description
 * TODO : Include option for logo and hook with customizer
 *
 * @since .01
 * @return string The html that contains title and description
 */
function get_site_info()
{
  $blog_info    = get_bloginfo('name');
  $show_title   = (true === get_theme_mod('display_title_and_tagline', true));
?>
<?php if ($blog_info) : ?>

<?php if (is_front_page() && !is_paged()) : ?>
<h1 class="site-title"><?php echo esc_html($blog_info); ?></h1>
<?php elseif (is_front_page() && !is_home()) : ?>
<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info); ?></a>
</h1>
<?php else : ?>
<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($blog_info); ?></a></p>
<?php endif; ?>
<?php endif;
}

// TODO : Connect with customizer options and add description
// $description  = get_bloginfo( 'description', 'display' );
// if ( $description && true === get_theme_mod( 'display_title_and_tagline', true ) ) :
// echo $description; // phpcs:ignore WordPress.Security.EscapeOutput 


//////////////////////////////////
//                              //
//    Display a random image    //
//                              //
//////////////////////////////////

/**
 * Returns a random image from a selected category
 * @since 0.0.1
 * @param string $cat Category name to retrieve from, default is 'uncategorized'
 * @return string HTML generated from get_the_post_thumbnail 
 * */


function get_random_image_src($cat = 'uncategorized')
{
  $query = new WP_Query(array(
    'posts_per_page' =>  1,
    'orderby' => 'rand',
    'post_type' => 'post',
    'category_name' => esc_attr($cat),
  ));
  while ($query->have_posts()) : $query->the_post();
    $id = get_the_ID();
    if (has_post_thumbnail($id)) :
      echo get_the_post_thumbnail($id, 'post-thumbnail');
    endif;
  endwhile;
}


function get_random_img_src_by_tag($tag = '')
{
  if ($tag) {
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 1,
      'orderby' => 'rand',
      'tax_query' => array(
        array(
          'taxonomy' => 'post_tag',
          'field'    => 'name',
          'terms'    => $tag,
        ),
      ),
    );
    $query = new WP_Query($args);
    while ($query->have_posts()) : $query->the_post();
      $id = get_the_ID();
      if (has_post_thumbnail($id)) :
        echo get_img_with_sizes('medium_large');
      endif;
    endwhile;
  }
}


///////////////////////////////////
//                               //
//    Updates for page title     //
//                               //
///////////////////////////////////
/**
 * Fix for empty title on home page
 * 
 * @param string $title The original title.
 * @return string The title to use.
 */

add_filter('wp_title', 'wp_title_home');
function wp_title_home($title)
{
  if (empty($title) && (is_home() || is_front_page())) {
    $title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
  }

  return $title;
}

//////////////////////////////////////
//                                  //
//    Optimize page descriptions    //
//                                  //
//////////////////////////////////////
/**
 * Dynamic meta descriptions
 * 
 * @return string The description of the page based on this fallback:
 * 1) Check if custom meta description ('meta_desc') is defined from the page or post 
 * 2) If no meta description and it is a single post check for image caption 
 * 3) No meta, no caption, then just shows default site description
 */
function get_meta_description()
{
  $field = get_post_meta(get_queried_object_id(), 'meta_desc', true);
  if (is_single()) {
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
    $desc = (empty($field) ? (empty($image_caption) ? get_bloginfo('description') : $image_caption) : $field);
  } else {
    $desc = (empty($field) ?  get_bloginfo('description')  : $field);
  }

  return esc_attr(trim($desc));
}

//////////////////////////////
//                          //
//    Gallery by tag    //
//                          //
//////////////////////////////

function get_gallery_by_tag($post_tag)
{

  $args = array(
    'tag' => $post_tag
  );

  $tag_query = new WP_Query($args);

  if ($tag_query->have_posts()) :
    echo '<div id="tag_thumbs">';
    while ($tag_query->have_posts()) :
      $tag_query->the_post();
      if (has_post_thumbnail()) :
        $image_id = get_post_thumbnail_id();
        $image_caption =  wp_get_attachment_caption($image_id);
    ?>
<a data-fancybox="gallery" data-caption="<?php echo $image_caption; ?>" href="<?php the_post_thumbnail_url(); ?>">
    <?php get_img_with_sizes('thumbnail'); ?>
</a>
<?php endif;
    endwhile;
    echo '</div>';
  endif;
}

////////////////////////////////////////////////
//                                            //
//    Sidebar Thumbs from current category    //
//                                            //
////////////////////////////////////////////////

function this_cats_thumbs()
{
  $the_cat = get_the_category();
  if ($the_cat) :
    $category_name = $the_cat[0]->name;
    $category_link = get_category_link($the_cat[0]->cat_ID);
    $num_posts = $the_cat[0]->category_count;
    $args = array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'category_name' => $category_name,
      'post__not_in' => array(get_the_ID()),
      'posts_per_page' => 9,
    );
    $arr_posts = new WP_Query($args);
    echo   '<p>Category: ' . $category_name . '</p>';
    if ($arr_posts->have_posts()) :

      echo '<div id="cat_thumbs">';

      while ($arr_posts->have_posts()) :
        $arr_posts->the_post();
        if (has_post_thumbnail()) :
        ?>
<a href="<?php the_permalink(); ?>">
    <?php get_img_with_sizes('thumbnail'); ?>
</a>
<?php endif;
      endwhile;
      echo '</div>';
    endif;
    if ($num_posts > 9) :
      echo '<div class="single-cat-link">View all of the <a href="' . $category_link . '">' . $category_name . ' collection &gt; &gt;</a></div>';
    endif;
  endif;
}




/**
 * ? Still need this function 
 * Remove inline width/height attributes 
 */

add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

function remove_width_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
  return $html;
}

/**
 * ? Still need this function 
 * Prevent WP from adding <p> tags on all post types
 */

function disable_wp_auto_p($content)
{
  remove_filter('the_content', 'wpautop');
  remove_filter('the_excerpt', 'wpautop');
  return $content;
}
add_filter('the_content', 'disable_wp_auto_p', 0);


//////////////////////////////////////////////////////
//                                                  //
//    Add featured post image in admin post list    //
//                                                  //
//////////////////////////////////////////////////////

/**
 * Add featured image column to WP admin panel - posts AND pages
 * See: https://bloggerpilot.com/featured-image-admin/
 */

// Set thumbnail size
add_image_size('j0e_admin-featured-image', 60, 60, false);

// Add the posts and pages columns filter. Same function for both.
add_filter('manage_posts_columns', 'j0e_add_thumbnail_column', 2);
add_filter('manage_pages_columns', 'j0e_add_thumbnail_column', 2);
function j0e_add_thumbnail_column($j0e_columns)
{
  $j0e_columns['j0e_thumb'] = __('Image');
  return $j0e_columns;
}

// Add featured image thumbnail to the WP Admin table.
add_action('manage_posts_custom_column', 'j0e_show_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'j0e_show_thumbnail_column', 5, 2);
function j0e_show_thumbnail_column($j0e_columns, $j0e_id)
{
  switch ($j0e_columns) {
    case 'j0e_thumb':
      if (function_exists('the_post_thumbnail'))
        echo the_post_thumbnail('j0e_admin-featured-image');
      break;
  }
}

// Move the new column at the first place.
add_filter('manage_posts_columns', 'j0e_column_order');
function j0e_column_order($columns)
{
  $n_columns = array();
  $move = 'j0e_thumb'; // which column to move
  $before = 'title'; // move before this column

  foreach ($columns as $key => $value) {
    if ($key == $before) {
      $n_columns[$move] = $move;
    }
    $n_columns[$key] = $value;
  }
  return $n_columns;
}

// Format the column width with CSS
add_action('admin_head', 'j0e_add_admin_styles');
function j0e_add_admin_styles()
{
  echo '<style>.column-j0e_thumb {width: 60px;}</style>';
}



/**
 * Returns an image with alt, width, and height attributes
 * @since 0.8.2
 * @param string $size thumbnail | medium | medium-full | full
 * @return string HTML for image with attributes
 * */
function get_img_with_sizes($size)
{
  $image_id = get_post_thumbnail_id();
  $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id(), $size, true);
  $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);

  if ($image_attributes) :
    ?>
<img src="<?php echo $image_attributes[0]; ?>" width="<?php echo $image_attributes[1]; ?>"
    height="<?php echo $image_attributes[2]; ?>" alt="<?php echo $image_alt ?>" />
<?php endif;
};

///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
//    Return only the first category when outputting the previous/next post links    //
//                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////

function my_custom_post_navigation($terms, $object_ids, $taxonomies, $args)
{

  return array_slice($terms, 0, 1);
}


////////////////////////////////////////////////
//                                            //
//    Filter to prepend tags with a hash #    //
//                                            //
////////////////////////////////////////////////

/**
 * Retrieves a list of all tags with the '#' symbol prefix
 *
 * @since 0.0.1
 * @return string HTML of links of hashed tags
 * */


function hashed_tags()
{
  $post_tags = get_the_tags();
  $prefix = '#';
  $separator = ' ';
  $output = '';
  $string = '';

  if (!empty($post_tags)) :
    $string = '<div id="photo_tag_container">Tags: ';
    foreach ($post_tags as $tag) :
      $output .= '<a title="View all photos with the tag #' . strtolower($tag->name) . '"
        href="' . esc_attr(get_tag_link($tag->term_id)) . '">' . $prefix . __($tag->name) . '</a>' . $separator;
    endforeach;
    $string .= trim($output, $separator);
    $string .= '</div>';
  endif;
  return $string;
}


////////////////////////
//                    //
//    Breadcrumbs     //
//                    //
////////////////////////
/**
 * Retrieves the breadcrumb for the header
 * @since 0.0.1
 * @return string HTML of links and current location
 */

function the_breadcrumb()
{
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
  $catLink = '<a href="/projects/"> Projects</a> ';

  global $post;
  $homeLink = get_bloginfo('url');
  if (is_home() || is_front_page()) {
    if ($showOnHome == 1) {
      echo '<div id="crumbs" class="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div>';
    }
  } else { // Category Pages
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    if (is_category()) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) {
        echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
      }
      echo $catLink  . $delimiter . $before . ' ' . single_cat_title('', false) . $after;
    } elseif (is_single() && !is_attachment()) {
      if (get_post_type() != 'post') {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) {
          echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        }
      } else {
        $cat = get_the_category();
        $cat = $cat[0];
        $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) {
          $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        }
        echo $catLink . ' ' . $delimiter . ' ' . $cats;
        if ($showCurrent == 1) {
          echo $before . get_the_title() . $after;
        }
      }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_page() && !$post->post_parent) {
      if ($showCurrent == 1) {
        echo $before . get_the_title() . $after;
      }
    } elseif (is_page() && $post->post_parent) {
      $parent_id = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_post($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs) - 1) {
          echo ' ' .
            $delimiter . ' ';
        }
      }
      if ($showCurrent == 1) {
        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      }
    } elseif (is_tag()) {
      echo $before . '<a href="/tags/" title="View all of the tags"> Tags </a>' . $delimiter
        . ' ' . single_tag_title('', false) . $after;
    }

    echo '</div>';
  }
}


////////////////////////////////////////
//                                    //
//    Check cookie for light theme    //
//                                    //
////////////////////////////////////////

function light_mode($classes)
{
  if (isset($_COOKIE["mode"])) :
    if ($_COOKIE["mode"] == 'light') :
      return array_merge($classes, array('lightmode'));
    endif;
  endif;
  return $classes;
}
add_filter('body_class', 'light_mode');


/////////////////////////
// Metaboxes //
/////////////////////////

/**
 * Register meta box for media attachment
 **/

function photo_meta_boxes()
{
  add_meta_box('fp-2', esc_html__('Photo Meta', 'pmeta'), 'photo_meta_callback', 'attachment');
}
add_action('add_meta_boxes_attachment', 'photo_meta_boxes');


/**
 * Display meta boxes for image
 *
 * @param WP_Post $post Current post object.
 */
function photo_meta_callback($post)
{
  wp_nonce_field(basename(__FILE__), "meta-box-nonce");
  ?>
<p>
    <label for="photo_location">Location : </label>
    <input id="photo_location" type="text" name="photo_location" style="margin-right: 10px; width: 100%"
        value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'photo_location', true)); ?>">
</p>
<p>
    <label for="photo_camera">Camera : </label>
    <input id="photo_camera" type="text" name="photo_camera" style="margin-right: 10px; width:100%"
        value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'photo_camera', true)); ?>">
</p>
<p>
    <label for="photo_film">Film type : </label>
    <input id="photo_film" type="text" name="photo_film" style="margin-right: 10px; width: 100%"
        value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'photo_film', true)); ?>">
</p>
<p>
    <label for="print_available">Prints Available?</label>
    <?php
    $checkbox_value = get_post_meta($post->ID, "print_available", true);
    if ($checkbox_value == "") {
    ?>
    <input name="print_available" type="checkbox" value="true">
    <?php
    } else if ($checkbox_value == "true") {
    ?>
    <input name="print_available" type="checkbox" value="true" checked>
    <?php
    }
    ?>
    </div>
    <?php }

/**
 * Save post meta box content.
 *
 * @param int $post_id Post ID
 */

add_action('edit_attachment', 'photo_save_meta');

function photo_save_meta($post_id)
{

  // Check if user has permissions to save data.
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  $textfields = [
    'photo_location',
    'photo_camera',
    'photo_film',
    'print_available'
  ];
  foreach ($textfields as $field) {
    if (array_key_exists($field, $_POST)) {
      update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
    }
  }
}


/**
 * Display data from the media meta boxes
 *
 * Displays optional location, camera type, film, and prints available
 *
 * @param $id The current post id
 * @return string HTML and data to sidebar.php
 */
function display_photo_meta($id)
{
  $attachment_id = (get_post_thumbnail_id($id));
  $core_meta = wp_get_attachment($attachment_id);
  if (isset($core_meta) && !empty($core_meta)) {
    if (!empty($core_meta['description'])) {
      echo '<p>' . $core_meta['description'] . '</p>';
    }
  }

  $attachment_fields = get_post_custom($attachment_id);
  if (array_key_exists('photo_location', $attachment_fields)) {
    $loc = $attachment_fields['photo_location'][0];
    if ($loc) :
      echo '<p>Location: ' . $loc . '</p>';
    endif;
  }
  if (array_key_exists('photo_camera', $attachment_fields)) {
    $cam = $attachment_fields['photo_camera'][0];
    if ($cam) :
      echo '<p>Camera: ' . $cam . '</p>';
    endif;
  }
  if (array_key_exists('photo_film', $attachment_fields)) {
    $film = $attachment_fields['photo_film'][0];
    if ($film) :
      echo '<p>Film: ' . $film . '</p>';
    endif;
  }
}


/**
 * Return all of the data from attachment

 *
 * @param $attachment_id The id of the media attachment, a featured post can use get_post_thumbnail_id($post);
 * @return array HTML and data to sidebar.php
 */
function wp_get_attachment($attachment_id)
{

  $attachment = get_post($attachment_id);
  return array(
    'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
    'caption' => $attachment->post_excerpt,
    'description' => $attachment->post_content,
    'href' => get_permalink($attachment->ID),
    'src' => $attachment->guid,
    'title' => $attachment->post_title
  );
}

  ?>