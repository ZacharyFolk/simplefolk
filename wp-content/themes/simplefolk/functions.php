<?php

////////////////////////////////////////
//                                    //
//    Load them scripts and styles    //
//                                    //
////////////////////////////////////////

define('SIMPLE_THEME_VERSION', '0.0.1');

function photo_child_enqueue_styles()
{
  wp_enqueue_style('main',  get_theme_file_uri() . '/style.css', array(), SIMPLE_THEME_VERSION, 'all');
  wp_enqueue_style('icons',  get_theme_file_uri() . '/assets/icomoon/style.css', array(), SIMPLE_THEME_VERSION, 'all');
  wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri() . '/js/isotope-setting.js', array('isotope'), false, true);
}

add_action('wp_enqueue_scripts', 'photo_child_enqueue_styles');


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

add_image_size('cat-squares', 300, 300, TRUE);

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
        echo get_the_post_thumbnail($id, 'post-thumbnail');
      endif;
    endwhile;
  }
}

////////////////////////////////////////////////
//                                            //
//    Sidebar Thumbs from current category    //
//                                            //
////////////////////////////////////////////////


function this_cats_thumbs($postID) // pass $id from function to get current category, TODO : use of these ids probably redundant and confusing
{
  echo '<div id="recent_posts"><div class="grid-sizer"></div>';
  $args = array(
    'category__in' => wp_get_post_categories($postID),
    'numberposts' => '9',
    'post__not_in' => array(get_the_ID())
  );
  $recent_posts = wp_get_recent_posts($args);
  foreach ($recent_posts as $recent) :
    $id = $recent["ID"];
    if (has_post_thumbnail($id)) : ?>
<div class="recent-item">
    <a href="<?php echo get_permalink($id); ?>">
        <?php echo get_the_post_thumbnail($id, 'thumbnail'); ?>
    </a>
</div>
<?php endif;
  //		echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
  endforeach;
  wp_reset_query();
  echo '</div>'; // end recent_posts
}

//////////////////////////////////////////////////////
//                                                  //
//    Create link for current category root page    //
//                                                  //
//////////////////////////////////////////////////////

function get_cat_link()
{
  $the_cat = get_the_category();
  if ($the_cat) :

    $category_name = $the_cat[0]->cat_name;
    $category_link = get_category_link($the_cat[0]->cat_ID);
    echo '<div class="single-cat-link">View all of the <a href="' . $category_link . '">' . $category_name . ' collection &gt; &gt;</a></div>';
  endif;
}

function cat_thumb_heading()
{
  $the_cat = get_the_category();
  if ($the_cat) :
    $category_name = $the_cat[0]->cat_name;
    echo $category_name;
  endif;
}

/////////////////////////////
//                         //
//    Add custom fonts     //
//                         //
/////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//  ________  ______   _______    ______                   __       __            __                          __      __        __                  __                                __        //
// /        |/      \ /       \  /      \                 /  \     /  |          /  |                        /  |    /  |      /  |                /  |                              /  |       //
// $$$$$$$$//$$$$$$  |$$$$$$$  |/$$$$$$  |       __       $$  \   /$$ |  ______  $$ |   __   ______         _$$ |_   $$ |____  $$/   _______       $$ |  ______    _______   ______  $$ |       //
//    $$ |  $$ |  $$ |$$ |  $$ |$$ |  $$ |      /  |      $$$  \ /$$$ | /      \ $$ |  /  | /      \       / $$   |  $$      \ /  | /       |      $$ | /      \  /       | /      \ $$ |       //
//    $$ |  $$ |  $$ |$$ |  $$ |$$ |  $$ |      $$/       $$$$  /$$$$ | $$$$$$  |$$ |_/$$/ /$$$$$$  |      $$$$$$/   $$$$$$$  |$$ |/$$$$$$$/       $$ |/$$$$$$  |/$$$$$$$/  $$$$$$  |$$ |       //
//    $$ |  $$ |  $$ |$$ |  $$ |$$ |  $$ |       __       $$ $$ $$/$$ | /    $$ |$$   $$<  $$    $$ |        $$ | __ $$ |  $$ |$$ |$$      \       $$ |$$ |  $$ |$$ |       /    $$ |$$ |       //
//    $$ |  $$ \__$$ |$$ |__$$ |$$ \__$$ |      /  |      $$ |$$$/ $$ |/$$$$$$$ |$$$$$$  \ $$$$$$$$/         $$ |/  |$$ |  $$ |$$ | $$$$$$  |      $$ |$$ \__$$ |$$ \_____ /$$$$$$$ |$$ |       //
//    $$ |  $$    $$/ $$    $$/ $$    $$/       $$/       $$ | $/  $$ |$$    $$ |$$ | $$  |$$       |        $$  $$/ $$ |  $$ |$$ |/     $$/       $$ |$$    $$/ $$       |$$    $$ |$$ |       //
//    $$/    $$$$$$/  $$$$$$$/   $$$$$$/                  $$/      $$/  $$$$$$$/ $$/   $$/  $$$$$$$/          $$$$/  $$/   $$/ $$/ $$$$$$$/        $$/  $$$$$$/   $$$$$$$/  $$$$$$$/ $$/        //
//                                                                                                                                                                                              //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function add_google_fonts()
{
  wp_enqueue_style(
    'google-fonts',
    'https://fonts.googleapis.com/css2?family=Merriweather&family=Roboto&family=Rajdhani:wght@600&family=Special+Elite&family=Rajdhani&family=Reenie+Beanie&family=Space+Mono&family=Allerta+Stencil&family=Koulen&family=Zen+Maru+Gothic&display=swap',
    array(),
    null
  );
}
add_action('wp_enqueue_scripts', 'add_google_fonts');


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

  if (!empty($post_tags)) {
    foreach ($post_tags as $tag) {
      $output .= '<a title="View all photos with the tag #' . strtolower($tag->name) . '"  href="' . esc_attr(get_tag_link($tag->term_id)) . '">' . $prefix . __($tag->name) . '</a>' . $separator;
    }
  }
  return trim($output, $separator);
}

///////////////////////
//                   //
//    Breadcrumbs    //
//                   //
///////////////////////
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
  $de = 'yeee';



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
      echo '<a href="/projects/"> Projects</a> ' . $delimiter . $before . ' ' . single_cat_title('', false) . $after;
    } elseif (is_search()) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
    } elseif (is_day()) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
    } elseif (is_month()) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
    } elseif (is_year()) {
      echo $before . get_the_time('Y') . $after;
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
        echo $cats;
        if ($showCurrent == 1) {
          echo $before . get_the_title() . $after;
        }
      }
    } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
    } elseif (is_attachment()) {
      // $parent = get_post($post->post_parent);
      // $cat = get_the_category($parent->ID);
      // $cat = $cat[0];
      // echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
      // echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      // if ($showCurrent == 1) {
      //   echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      // }
    } elseif (is_page() && !$post->post_parent) {
      if ($showCurrent == 1) {
        echo $before . get_the_title() . $after;
      }
    } elseif (is_page() && $post->post_parent) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs) - 1) {
          echo ' ' . $delimiter . ' ';
        }
      }
      if ($showCurrent == 1) {
        echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      }
    } elseif (is_tag()) {
      echo $before . '<a href="/tags/" title="View all of the tags"> Tags </a>'  . $delimiter . ' ' .  single_tag_title('', false)  . $after;
    } elseif (is_author()) {
      global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
    } elseif (is_404()) {
      echo $before . 'Error 404' . $after;
    }
    if (get_query_var('paged')) {
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ' (';
      }
      echo __('Page') . ' ' . get_query_var('paged');
      if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
        echo ')';
      }
    }
    echo '</div>';
  }
}

?>