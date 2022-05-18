<?php

////////////////////////////////////////
//                                    //
//    Load them scripts and styles    //
//                                    //
////////////////////////////////////////

/////////////////////////////////////////////
//  ________  ______   _______    ______   //
// /        |/      \ /       \  /      \  //
// $$$$$$$$//$$$$$$  |$$$$$$$  |/$$$$$$  | //
//    $$ |  $$ |  $$ |$$ |  $$ |$$ |  $$ | //
//    $$ |  $$ |  $$ |$$ |  $$ |$$ |  $$ | //
//    $$ |  $$ |  $$ |$$ |  $$ |$$ |  $$ | //
//    $$ |  $$ \__$$ |$$ |__$$ |$$ \__$$ | //
//    $$ |  $$    $$/ $$    $$/ $$    $$/  //
//    $$/    $$$$$$/  $$$$$$$/   $$$$$$/   //
//                                         //
/////////////////////////////////////////////
// note : have to use get_stylesheet_directory_uri here because get_template_directory_uri returns the parent
// update and make this regular theme
// var_dump(get_template_directory());  
// C:\xampp\htdocs\folkphotography/wp-content/themes/PARENT
// var_dump(get_stylesheet_directory());
// C:\xampp\htdocs\folkphotography/wp-content/themes/CHILD
// this also works
//var_dump(get_theme_file_path());
// C:\xampp\htdocs\folkphotography/wp-content/themes/CHILD


// var_dump( get_theme_file_uri());
// https://folkphotography.dev/wp-content/themes/child

define( 'CHILD_PATH_CSS',  get_theme_file_uri() . '/css' );
define( 'CHILD_THEME_VERSION', '0.1' );

function photo_child_enqueue_styles()
{
  $parent_style = 'photo-style';
  wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
  wp_enqueue_style(
    'child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array($parent_style),
    wp_get_theme()->get('Version')
  );
  // wp_enqueue_style('fancybox-css', get_stylesheet_directory_uri() . '/assets/fancybox/css/3.5.7/jquery.fancybox.css');
  // wp_enqueue_script('photograph-fancybox-settings', get_template_directory_uri() . '/assets/fancybox/js/fancybox-settings.js', array('fancybox'), false, true);
  // wp_enqueue_script('jquery-jarallax', get_template_directory_uri() . '/assets/jarallax/jarallax.js', array('jquery'), false, true);

  wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri() . '/js/isotope-setting.js', array('isotope'), false, true);
  // wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/assets/fancybox/js/3.5.7/jquery.fancybox.min.js', array('jquery'), false, true);
  // wp_enqueue_script('scrolling', get_stylesheet_directory_uri() . '/assets/scripts/scrolling.js', array('jquery'), false, true);
  wp_enqueue_script('horizMasonry', get_stylesheet_directory_uri() . '/assets/scripts/masonryHorizontal.js', array('jquery'), false, true);
  // wp_enqueue_style('responsive-styles', get_stylesheet_directory_uri() . '/css/mobile.css');
  wp_enqueue_style('menu', CHILD_PATH_CSS . '/menu2020.css',array(), CHILD_THEME_VERSION, 'all' );

}		

add_action('wp_enqueue_scripts', 'photo_child_enqueue_styles');


//////////////////////////////////////////
//                                      //
//    TODO : Figure out image sizes     //
//                                      //
//////////////////////////////////////////
add_image_size('tag_thumbs', 85, 45, true);
add_image_size('admin_thumbs', 150, 100, true);


// note : have to use STYLESHEETPATH here because TEMPLATEPATH returns the parent
// var_dump(get_template_directory());
//var_dump(get_stylesheet_directory());
// this also works
//var_dump(get_theme_file_path());

//////////////////////////////////////////////////
//                                              //
//    // TODO : set up admin customize panel    //
//                                              //
//////////////////////////////////////////////////
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');



///////////////////////////
//                       //
//    Set image sizes    //
//                       //
///////////////////////////


add_image_size('cat-squares', 300, 300, TRUE);


//////////////////////////////////
//                              //
//    Display a random image    //
//                              //
//////////////////////////////////

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


// $photograph_googlefont = array();
// 	array_push( $photograph_googlefont, 'Roboto');
// 	array_push( $photograph_googlefont, 'Rajdhani');
// 	$photograph_googlefonts = implode("|", $photograph_googlefont);

	// wp_register_style( 'photograph-google-fonts', '//fonts.googleapis.com/css?family='.$photograph_googlefonts .':300,400,400i,500,600,700');
	// wp_enqueue_style( 'photograph-google-fonts' );
	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }

  
function add_google_fonts()
{
  wp_enqueue_style('google-fonts', 
  'https://fonts.googleapis.com/css2?family=Merriweather&family=Roboto&family=Rajdhani&family=Special+Elite&family=Rajdhani&family=Reenie+Beanie&family=Space+Mono&family=Allerta+Stencil&family=Koulen&family=Zen+Maru+Gothic&display=swap', 
  array(), null );
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

add_filter('manage_posts_custom_column', 'manage_img_column', 10, 2);

function add_img_column($columns)
{
  $columns = array_slice($columns, 0, 1, true) + array("img" => "Featured Image") + array_slice($columns, 1, count($columns) - 1, true);
  return $columns;
}

function manage_img_column($column_name, $post_id)
{
  if ($column_name == 'img') {
    echo get_the_post_thumbnail($post_id, 'admin_thumbs');
  }
  return $column_name;
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


function hashed_tags()
{
  $post_tags = get_the_tags();
  $prefix = '#';
  $separator = ' ';
  $output = '';

  if (!empty($post_tags)) {
    foreach ($post_tags as $tag) {
      $output .= '<a title="View all photos with the tag ' . $tag->name . '"  href="' . esc_attr(get_tag_link($tag->term_id)) . '">' . $prefix . __($tag->name) . '</a>' . $separator;
    }
  }

  return trim($output, $separator);
}

///////////////////////
//                   //
//    Breadcrumbs    //
//                   //
///////////////////////



function the_breadcrumb()
{
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '&raquo;'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb



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
      echo $before . '<a href="/projects/"> Projects</a> ' . $delimiter . ' ' . single_cat_title('', false) . $after;
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
} // end the_breadcrumb()



?>