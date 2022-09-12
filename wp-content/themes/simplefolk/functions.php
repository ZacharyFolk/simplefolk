<?php

////////////////////////////////////////
//                                    //
//    Load them scripts and styles    //
//                                    //
////////////////////////////////////////

define('SIMPLE_THEME_VERSION', '2.0.1');

function main_scripts()
{
  wp_enqueue_style('main',  get_theme_file_uri() . '/style.css', array(), SIMPLE_THEME_VERSION, 'all');
  wp_enqueue_style('glightbox',  get_theme_file_uri() . '/assets/glightbox/css/glightbox.min.css', array(), SIMPLE_THEME_VERSION, 'all');
  wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array(), false, true);
  wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array(), false, true);
  wp_enqueue_script('glightbox-script', get_template_directory_uri() . '/assets/glightbox/js/glightbox.min.js', array(), false, true);
  wp_enqueue_script('theme-scripts', get_template_directory_uri() . '/js/theme-scripts.js', array(), false, true);
}

add_action('wp_enqueue_scripts', 'main_scripts');

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

///////////////////////////////////////////////
//                                           //
//    Add tags and category to media page    //
//                                           //
///////////////////////////////////////////////


function add_media_cats()
{
  register_taxonomy_for_object_type(
    'category',
    'attachment'
  );
}

add_action('init', 'add_media_cats');


function add_media_tags()
{
  register_taxonomy_for_object_type(

    'post_tag',
    'attachment'
  );
}

add_action('init', 'add_media_tags');

////////////////////////////
//                        //
//    Register widgets    //
//                        //
////////////////////////////
/**
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function simple_widgets_init()
{
  register_sidebar(
    array(
      'name'          => __('Blog Sidebar', 'simplefolk'),
      'id'            => 'sidebar-1',
      'description'   => __('Add widgets here to appear in your sidebar on single posts.', 'simplefolk'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => __('Home Column 1', 'simplefolk'),
      'id'            => 'home-1',
      'description'   => __('Widget for column on home page.', 'simplefolk'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => __('Home Column 2', 'simplefolk'),
      'id'            => 'home-2',
      'description'   => __('Widget for additional column on home page.', 'simplefolk'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => __('Footer 1', 'simplefolk'),
      'id'            => 'footer-1',
      'description'   => __('Add widgets here to appear in your footer column one.', 'simplefolk'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

  register_sidebar(
    array(
      'name'          => __('Footer 2', 'simplefolk'),
      'id'            => 'footer-2',
      'description'   => __('Add widgets here to appear in your footer column two.', 'simplefolk'),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action('widgets_init', 'simple_widgets_init');


///////////////////////////////////
//                               //
//    Light/Dark Mode toggle     //
//                               //
///////////////////////////////////
/**
 * @return string HTML for the sun/moon toggle 
 */
function createLightSwitch($item)
{
  $lightSwitch = <<<END
  <li>
  <input id="mode-toggle" type="checkbox" />
  <label class="mode-button-container" for="mode-toggle">
      <div class="mode-button">
          <svg class="lightsoff" version="1.1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              viewBox="0 0 32 32">
              <title>sun</title>
              <path
                  d="M16 26c1.105 0 2 0.895 2 2v2c0 1.105-0.895 2-2 2s-2-0.895-2-2v-2c0-1.105 0.895-2 2-2zM16 6c-1.105 0-2-0.895-2-2v-2c0-1.105 0.895-2 2-2s2 0.895 2 2v2c0 1.105-0.895 2-2 2zM30 14c1.105 0 2 0.895 2 2s-0.895 2-2 2h-2c-1.105 0-2-0.895-2-2s0.895-2 2-2h2zM6 16c0 1.105-0.895 2-2 2h-2c-1.105 0-2-0.895-2-2s0.895-2 2-2h2c1.105 0 2 0.895 2 2zM25.899 23.071l1.414 1.414c0.781 0.781 0.781 2.047 0 2.828s-2.047 0.781-2.828 0l-1.414-1.414c-0.781-0.781-0.781-2.047 0-2.828s2.047-0.781 2.828 0zM6.101 8.929l-1.414-1.414c-0.781-0.781-0.781-2.047 0-2.828s2.047-0.781 2.828 0l1.414 1.414c0.781 0.781 0.781 2.047 0 2.828s-2.047 0.781-2.828 0zM25.899 8.929c-0.781 0.781-2.047 0.781-2.828 0s-0.781-2.047 0-2.828l1.414-1.414c0.781-0.781 2.047-0.781 2.828 0s0.781 2.047 0 2.828l-1.414 1.414zM6.101 23.071c0.781-0.781 2.047-0.781 2.828 0s0.781 2.047 0 2.828l-1.414 1.414c-0.781 0.781-2.047 0.781-2.828 0s-0.781-2.047 0-2.828l1.414-1.414z">
              </path>
              <path
                  d="M16 8c-4.418 0-8 3.582-8 8s3.582 8 8 8c4.418 0 8-3.582 8-8s-3.582-8-8-8zM16 21c-2.761 0-5-2.239-5-5s2.239-5 5-5 5 2.239 5 5-2.239 5-5 5z">
              </path>
          </svg>
          <svg class="lightson" version="1.1" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
              viewBox="0 0 24 24">
              <title>crescent_moon</title>
              <path
                  d="M9.984 2.016q4.172 0 7.102 2.93t2.93 7.055-2.93 7.055-7.102 2.93q-2.719 0-4.969-1.313 2.297-1.313 3.633-3.633t1.336-5.039-1.336-5.039-3.633-3.633q2.25-1.313 4.969-1.313z">
              </path>
          </svg>
      </div>
  </label>
  </li>
  END;
  return $item . $lightSwitch;
}

add_filter('wp_nav_menu_items', 'createLightSwitch');

// TODO : Add customizer and options for which menu to target
// function addTargetMenus($target)
// {
// }
// add_action('wp_nav_menu_items', 'addTargetMenus');


////////////////////////////////////////
//                                    //
//    Featured projects widget        //
//                                    //
////////////////////////////////////////

/**
 * 
 * Creates a widget that allows to select from category dropdown
 * Selected category will generate an archive card that includes
 * Category thumbnail, title, description and link to archive collection
 */
class project_thumbs_widget extends WP_Widget
{

  function __construct()
  {
    parent::__construct(

      'project_thumbs_widget',
      __('Project thumbs', 'simplefolk'),
      array('description' => __('Get random collection of images from specific project(category)', 'simplefolk'),)
    );
  }

  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $cat = apply_filters('widget_text', $instance['cat']);

    echo $args['before_widget'];
    if (!empty($title)) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    featured_cat_card($cat);
    echo $args['after_widget'];
  }

  public function form($instance)
  {
    if (isset($instance['title'])) {
      $title = $instance['title'];
    } else {
      $title = __('New title', 'simplefolk');
    }
    if (isset($instance['cat'])) {
      $cat = $instance['cat'];
    } else {
      $cat = 1; // 1 should be Uncategorized as default
    }

?>
<?php if ($cat) {
      featured_cat_card($cat);
    }
    ?>
<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
</p>
<p>
    <label for="<?php echo $this->get_field_id('cat'); ?>">
        Select featured project:
        <select class="widefat" id="<?php echo $this->get_field_id('cat'); ?>"
            name="<?php echo $this->get_field_name('cat'); ?>" />
        <?php
        echo '<option>' . __('No Category', 'simplefolk') . '</option>';
        $args = array('show_option_none' => 'No Category', 'hide_empty' => 0);
        $categories = get_categories($args);
        foreach ($categories as $category) :
          $selected = ($cat ==  $category->term_id) ? 'selected' : '';
          echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
        endforeach; ?>
        </select>
    </label>
</p>
<?php
  }
  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['cat'] = (!empty($new_instance['cat'])) ? strip_tags($new_instance['cat']) : '';
    return $instance;
  }
}

function load_cat_thumb_widget()
{
  register_widget('project_thumbs_widget');
}
add_action('widgets_init', 'load_cat_thumb_widget');

/**
 * Returns card elements from a category id
 * HTML of category name, description, and attachment
 * @param string $catID Category id to build elements
 * @return string HTML of image with category title and description
 * 
 * */
function featured_cat_card($catID)
{
  echo '<div class="featured-cat-banner">';
  echo get_attachment_by_cat_id($catID, 'landscape_thumb');
  echo '<header><h3>' . get_cat_name($catID) . '</h3></header>';
  echo '</div>';
  echo category_description($catID);
  echo '<div class="category-link" style="text-align: right"><a title="View all photos from the ' . get_cat_name($catID) . ' collection" href="' . get_category_link($catID) . '">View collection &raquo; </a>';
}

////////////////////////////////////////////////////
//                                                //
//    Create new permalink for archive pages      //
//                                                //
////////////////////////////////////////////////////


// add_filter('attachment_link', 'updated_attachment_link', 20, 2);
function updated_attachment_link($link, $attachment_id)
{

  $attachment = get_post($attachment_id);

  // Only for attachments actually attached to a parent post
  if (!empty($attachment->post_parent)) {

    $parent_link = get_permalink($attachment->post_parent);
    // make the link compatible with permalink settings with or without "/" at the end
    $parent_link = rtrim($parent_link, "/");
    $link =  $parent_link . '/gallery/' . $attachment_id;
  }

  return $link;
}


add_action('init', function () {

  // Tell WordPress how to handle the new structure
  // add_rewrite_rule('(.+)/gallery/([0-9]{1,})/?$', 'index.php?attachment_id=$matches[2]', 'top');
});


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


add_image_size('landscape_thumb', 750, 220, true);
add_image_size('square_hero', 450, 450, true);
add_image_size('tiny_thumb', 80, 80, true);

/* Add new sizes to admin menus */
function new_image_sizes($size_names)
{
  $new_sizes = array(
    'landscape_thumb' => 'Landscape Thumbmail',
    'square_hero' => 'Square 450',
    'tiny_thumb' => 'Square 80'

  );
  return array_merge($size_names, $new_sizes);
}
add_filter('image_size_names_choose', 'new_image_sizes');

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


function get_random_atta_img_src_by_tag($tag = '')
{
  if ($tag) {

    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
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
    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
        $id = get_the_ID();
        $atta_img = wp_get_attachment_image($id, 'medium_large');
        if ($atta_img) {
          echo $atta_img;
        }
      endwhile;
    endif;
  }
}



function get_random_atta_img_src_by_term($tax, $term = '')
{
  // Note :  Found passing slug breaks this because the spaces are hyphenated
  // Passing title for $term seems to work ok

  if ($term) {
    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'posts_per_page' => 1,
      'orderby' => 'rand',
      'tax_query' => array(
        array(
          'taxonomy' => $tax,
          'field'    => 'name',
          'terms'    => $term,
        ),
      ),
    );

    $query = new WP_Query($args);
    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
        $id = get_the_ID();
        $atta_img = wp_get_attachment_image($id, 'medium_large');
        if ($atta_img) {
          echo $atta_img;
        }
      endwhile;
    endif;
  }
}


/**
 * Returns the display for each tag on the root tags/ page 
 * @param string $tax Taxonomy to use for the query eg: post_tag
 * @param object $single_tag WP_Term Object
 * @return string HTML generated from get_the_post_thumbnail 
 * */
function get_tag_display($tax, $single_tag)
{
  // Note :  Found passing slug breaks this because the spaces are hyphenated
  //   $single_tag->name for $term seems to work ok

  $term = $single_tag->name;
  if ($term) {
    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'posts_per_page' => 10,
      'orderby' => 'rand',
      'tax_query' => array(
        array(
          'taxonomy' => $tax,
          'field'    => 'name',
          'terms'    => $term,
        ),
      ),
    );

    $name = '#' . strtolower($term);
    $tag_banner_array = array('<span>' . $name . '</span>');


    $query = new WP_Query($args);
    if ($query->have_posts()) :
      while ($query->have_posts()) : $query->the_post();
        $id = get_the_ID();
        $atta_img = wp_get_attachment_image($id, 'tiny_thumb');
        if ($atta_img) {
          array_push($tag_banner_array, $atta_img);
          // echo $atta_img;
        }
      endwhile;
    endif;


    shuffle($tag_banner_array);



    foreach ($tag_banner_array as $output) {
      echo $output;
    }
  }
}



/**
 * Returns a random image from attachments with that category id
 * @param int $id (required) - Category id (term_id)  
 * @param string $size (optional) - Default value of 'thumbnail'
 * @return string HTML of random image src 
 * 
 * */
function get_attachment_by_cat_id($id, $size = 'thumbnail')
{
  $args = array(
    'post_type' => 'attachment',
    'post_status' => 'inherit',
    'posts_per_page' => 10,
    'orderby' => 'rand',
    'tax_query' => array(
      array(
        'taxonomy' => 'category',
        'field'    => 'term_id',
        'terms'    => $id,
      ),
    ),
  );

  $query = new WP_Query($args);
  if ($query->have_posts()) :
    while ($query->have_posts()) : $query->the_post();
      $id = get_the_ID();
      $atta_img = wp_get_attachment_image($id, $size);
      if ($atta_img) {
        return $atta_img;
      }
    endwhile;
  endif;
}

//////////////////////////////////
//                              //
//    Get image and lightbox    //
//                              //
//////////////////////////////////

/**
 * @param int $id Term id to get attachment and meta
 * @return string HTML of image with modal link
 * 
 * Returns an image with lightbox enabled and image meta available in the modal
 */


function get_lightbox_image($id)
{
  $full_image_link = wp_get_attachment_image_url($id, 'full');
  $slide_class = "full-meta-" . $id;
  $atta_img = wp_get_attachment_image($id, 'medium_large');
  if ($atta_img) :
    echo '<a href="' . $full_image_link . '" 
  class="glightbox"
  data-desc-position="bottom"  // todo: configs for this
  data-glightbox="description: .' . $slide_class . '">';
    echo $atta_img;
    echo '</a>';
    echo '<div class="glightbox-desc ' . $slide_class .  '">'; // hidden element that shows in modal
    modal_display_photo_meta($id);
    echo '</div>';
  endif;
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
 * 2) If no meta_desc then use custom excerpt
 * 3) No custom excerpt then auto excerpt generated WP with 260 char limit
 * 4) No auto excerpt (no text) and it is a single post check for image caption 
 * 5) No meta, no excerpts, no caption, then it just shows default site description
 */
function get_meta_description()
{
  $field = get_post_meta(get_queried_object_id(), 'meta_desc', true);
  if (is_single()) {
    $post_excerpt = the_excerpt();
    $image_id = get_post_thumbnail_id();
    $image_caption =  wp_get_attachment_caption($image_id);
    $desc = (empty($field) ? (empty($post_excerpt) ? (empty($image_caption) ? get_bloginfo('description') : $image_caption) : $post_excerpt) : $field);
  } else {
    $desc = (empty($field) ?  get_bloginfo('description')  : $field);
  }

  return esc_attr(trim($desc));
}

///////////////////////////////
//                           //
//    Update excerpt link    //
//                           //
///////////////////////////////

function new_excerpt_more($more)
{
  global $post;
  return '… <a title="View the full post: ' . get_the_title($post->ID) . '" href="' . get_permalink($post->ID) . '">' . '<span class="more">Read more &raquo;</span>' . '</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

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

function this_archive_cats_thumbs()
{
  $the_cat = get_the_category();

  if ($the_cat) :
    $category_name = $the_cat[0]->name;
    $category_term_id = (int)$the_cat[0]->term_id;
    $category_link = get_term_link($category_term_id);

    $args = array(
      'post_type' => 'attachment',
      'post_status' => 'inherit',
      'posts_per_page' => 9,
      'post__not_in' => array(get_the_ID()),
      'tax_query' => array(
        array(
          'taxonomy' => 'category',
          'field' => 'slug',
          'terms' => $category_name,
        )
      ),
    );
    $atta_query = new WP_Query($args);
    if ($atta_query->have_posts()) :
      echo '<div id="cat_thumbs">';
      while ($atta_query->have_posts()) :
        $atta_query->the_post();
        $atta_img = wp_get_attachment_image(get_the_ID(), 'thumbnail');
        $atta_link = get_attachment_link();
        if ($atta_img) {
          echo '<a href="' . $atta_link . '">' . $atta_img . '</a>';
        }
      endwhile;
      echo '</div>';

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
// //
// Add featured post image in admin post list //
// //
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
  echo '<style>
    .column-j0e_thumb {
        width: 60px;
    }
    </style>';
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
 * @return string HTML of links and current location
 */

function the_breadcrumb()
{
  /* TODO : Add configs for this */
  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '<span class="delimiter"> &raquo; </span>'; // delimiter between crumbs
  $home = 'Home'; // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
  $catLink = '<a href="/projects/"> Projects</a> ';
  $tagLink = '<a href="/tags/">Tags</a>';

  global $post;
  $homeLink = get_bloginfo('url');
  if (is_home() || is_front_page()) {
    if ($showOnHome == 1) {
      echo '<div id="crumbs" class="breadcrumb"><a href="' . $homeLink . '">' . $home . '</a></div>';
    }
  } else {
    echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
    // archive / category
    if (is_archive()) {
      if (is_category()) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) {
          echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
        }
        echo $catLink  . $delimiter . $before . ' ' . single_cat_title('', false) . $after;
      }
    }
    if (is_tag()) {
      echo $tagLink  . $delimiter . $before . ' ' . get_queried_object()->name . $after;
    } elseif (is_single() && !is_attachment()) {
      echo ' ' . $before . get_the_title() . $after;
    }
    if (is_attachment()) {

      // NOTE: This may be unorthodox, reason is to distinguish between if the previous page
      // was a tag or category.  If neither then it just defaults to the root.  
      // TODO : This along with actual permalink path need to be consistent
      // Does this cause duplicate content SEO problems?

      $ref = ($_SERVER['HTTP_REFERER']);
      // search string for 'tags' 
      if (strpos($ref, 'tags') !== false) {
        echo '<a href="' . $ref . '">Tags</a>' . $delimiter;
      }
      if (strpos($ref, 'projects') !== false) {
        echo '<a href="/projects/">Projects</a>' . $delimiter;
      }
      echo ' ' . $before . get_the_title() . $after;
    }
    // if (is_archive()) {


    //   // $tax = get_queried_object()->taxonomy;
    //   // // NOTE : This is not great - reconsider this whole naming convention for the taxonomy
    //   // // Maybe should just scrape url for whatever these pages are called
    //   // wut($tax);
    //   // echo '<a href="">Tags</a> ' . $delimiter . ' ' . $before . get_the_title() . $after;
    //   // // $part = explode('-', $tax);
    //   // $slug = get_queried_object()->slug;
    //   // wut($slug);
    //   // wut($part[1]);
    //   // wut(get_queried_object());
    //   // echo '<a href="/' . $part[1] . '">' . $part[1] . '</a> ' . $delimiter . ' ' . $before . $slug . $after;
    // } 
    if (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
      // $post_type = get_post_type_object(get_post_type());
      // echo $before . $post_type->labels->singular_name . $after;
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
  add_meta_box('simple_exif', 'Photo Meta', 'photo_meta_callback', 'attachment', 'side', 'high');
}
add_action('add_meta_boxes_attachment', 'photo_meta_boxes');


// wp_read_image_metadata() converts the raw EXIF with wp_exif_frac2dec()
// @see wp-admin/includes/image.php
// Convert decimal to fraction
// @https://stackoverflow.com/a/14357170/82330

function float2rat($n, $tolerance = 1.e-6)
{
  $h1 = 1;
  $h2 = 0;
  $k1 = 0;
  $k2 = 1;
  $b = 1 / $n;
  do {
    $b = 1 / $b;
    $a = floor($b);
    $aux = $h1;
    $h1 = $a * $h1 + $h2;
    $h2 = $aux;
    $aux = $k1;
    $k1 = $a * $k1 + $k2;
    $k2 = $aux;
    $b = $b - $a;
  } while (abs($n - $h1 / $k1) > $n * $tolerance);
  return "$h1/$k1";
}


/**
 * Display meta boxes for image
 *
 * @param WP_Post $post Current post object.
 */
function photo_meta_callback($post)
{
  wp_nonce_field(basename(__FILE__), "meta-box-nonce");
  require_once ABSPATH . '/wp-admin/includes/image.php'; // Without this wp_read_image_metadata() throws Fatal error: Uncaught Error: Call to undefined function
  $id = get_the_ID();
  $filepath = get_attached_file($id);
  $imageEXIF = wp_read_image_metadata($filepath);
  // wut(wp_read_image_metadata($filepath));

  // [aperture]
  $exif_aperture = empty($imageEXIF['aperture']) ? '' :  $imageEXIF['aperture'];
  $meta_aperture = esc_attr(get_post_meta(get_the_ID(), 'aperture', true));
  $aperture_value = empty($meta_aperture) ? $exif_aperture : $meta_aperture;

  // [camera] 
  // converted ex: NIKON D10 => Nikon D10
  $exif_camera = empty($imageEXIF['camera']) ? '' :  $imageEXIF['camera'];
  if (!empty($exif_camera)) :
    $fixCase = explode(' ', $exif_camera);
    $cam1 = $fixCase[0];
    $capitalFirst = strtolower($cam1);
    $capitalFirst = ucwords($capitalFirst);
    $exif_camera = $capitalFirst . ' ' .  $fixCase[1];
  endif;
  $meta_camera = esc_attr(get_post_meta(get_the_ID(), 'camera', true));
  $camera_value = empty($meta_camera) ? $exif_camera : $meta_camera;

  // [iso] 
  $exif_iso =  empty($imageEXIF['iso']) ? '' :  $imageEXIF['iso'];
  $meta_iso = esc_attr(get_post_meta(get_the_ID(), 'iso', true));
  $iso_value = empty($meta_iso) ? $exif_iso : $meta_iso;

  // [shutter_speed] 
  $exif_shutter =  empty($imageEXIF['shutter_speed']) ? '' :  $imageEXIF['shutter_speed'];
  if (!empty($exif_shutter)) :
    $exif_shutter = float2rat($exif_shutter);
    $ExposureTime = '';
    $arrExposureTime = explode('/', $exif_shutter);
    // wut($arrExposureTime);
    // Sanity check for zero denominator.
    if ($arrExposureTime[1] == 0) {
      $ExposureTime = '<sup>1</sup>/? sec';
      // In case numerator is zero.
    } elseif ($arrExposureTime[0] == 0) {
      $ExposureTime = '<sup>0</sup>/' . $arrExposureTime[1] . ' sec';
      // When denominator is 1, display time in whole seconds, minutes, and/or hours.
    } elseif ($arrExposureTime[1] == 1) {
      // In the Seconds range.
      if ($arrExposureTime[0] < 60) {
        $ExposureTime = $arrExposureTime[0] . ' s';
        // In the Minutes range.
      } elseif (($arrExposureTime[0] >= 60) && ($arrExposureTime[0] < 3600)) {
        $ExposureTime = gmdate("i\m:s\s", $arrExposureTime[0]);
        // In the Hours range.
      } else {
        $ExposureTime = gmdate("H\h:i\m:s\s", $arrExposureTime[0]);
      }
      // When inverse is evenly divisable, show reduced fractional exposure.
    } elseif (($arrExposureTime[1] % $arrExposureTime[0]) == 0) {
      $ExposureTime = '<sup>1</sup>/' . $arrExposureTime[1] / $arrExposureTime[0] . ' sec';
      // If the value is greater or equal to 3/10, which is the smallest standard
      // exposure value that doesn't divide evenly, show it in decimal form.
    } elseif (($arrExposureTime[0] / $arrExposureTime[1]) >= 3 / 10) {
      $ExposureTime = round(($arrExposureTime[0] / $arrExposureTime[1]), 1) . ' sec';
      // If all else fails, just display it as it was found.
    } else {
      $ExposureTime = '<sup>' . $arrExposureTime[0] . '</sup>/' . $arrExposureTime[1] . ' sec';
    }
  //  wut($ExposureTime);

  endif;
  $meta_shutter = esc_attr(get_post_meta(get_the_ID(), 'shutter', true));
  $shutter_value = empty($meta_shutter) ? $exif_shutter : $meta_shutter;

  // [focal_length] 
  // lens focal length (in millimeters (mm))

  $exif_focal = empty($imageEXIF['focal_length']) ? '' :  $imageEXIF['focal_length'] . 'mm';
  $meta_focal = esc_attr(get_post_meta(get_the_ID(), 'focal', true));
  $focal_value = empty($meta_focal) ? $exif_focal  : $meta_focal;

  // [created_timestamp] 
  // unix timestamp converted, eg: 1471244893 => August 15, 2016, 7:08 AM
  // date("F j, Y, g:i a")

  $exif_time = empty($imageEXIF['created_timestamp']) ? '' :  $imageEXIF['created_timestamp'];
  $converted_time = '';
  if (!empty($exif_time)) :
    $converted_time = date("F j, Y, g:i A", $exif_time);
  endif;
  $meta_time = esc_attr(get_post_meta(get_the_ID(), 'time', true));
  $time_value = empty($meta_time) ? $converted_time : $meta_time;
  ?>
<p>
    <label for="camera">Camera : </label>
    <input id="camera" type="text" name="camera" style="margin-right: 10px; width: 100%"
        value="<?php echo $camera_value; ?>">

</p>
<p>
    <label for="iso">ISO : </label>
    <input id="iso" type="text" name="iso" style="margin-right: 10px; width:100%; text-align: center;"
        value="<?php echo $iso_value; ?>">
</p>
<p>
    <label for="aperture">Aperture : </label>
    <input id="aperture" type="text" name="aperture" style="margin-right: 10px; width:100%; text-align: center;"
        value="<?php echo $aperture_value; ?>">
    <span class="extra-info">
        This value is displayed with ƒ prefix
    </span>
</p>
<p>
    <label for="shutter">Shutter : </label>
    <input id="shutter" type="text" name="shutter" style="margin-right: 10px; width:100%; text-align: center;"
        value="<?php echo $shutter_value; ?>">
</p>
<p>
    <label for="focal">Focal Length : </label>
    <input id="focal" type="text" name="focal" style="margin-right: 10px; width:100%"
        value="<?php echo $focal_value; ?>">
</p>
<p>
    <label for="film">Film type : </label>
    <input id="film" type="text" name="film" style="margin-right: 10px; width: 100%"
        value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'film', true)); ?>">
</p>
<p>
    <label for="time">Time of creation : </label>
    <input id="time" type="text" name="time" style="margin-right: 10px; width:100%" value="<?php echo $time_value; ?>">
</p>
<p>
    <label for="location">Location : </label>
    <input id="location" type="text" name="location" style="margin-right: 10px; width: 100%"
        value="<?php echo esc_attr(get_post_meta(get_the_ID(), 'location', true)); ?>">
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
    <?php
}

/**
 * Save post meta box content.
 *
 * @param int $post_id Post ID
 */

add_action('edit_attachment', 'simple_save_meta');

function simple_save_meta($post_id)
{

  // Check if user has permissions to save data.
  if (!current_user_can('edit_post', $post_id)) {
    return;
  }

  $textfields = [
    'camera',
    'iso',
    'aperture',
    'shutter',
    'focal',
    'film',
    'time',
    'location',

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
 * @return string HTML of additional data as paragraphs
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

  echo '<ul class="photo-exif">';

  if (array_key_exists('camera', $attachment_fields)) {
    $cam = $attachment_fields['camera'][0];
    if ($cam) :
      echo '<li>Camera: ' . $cam . '</li>';
    endif;
  }


  if (array_key_exists('iso', $attachment_fields)) {
    $iso = $attachment_fields['iso'][0];
    if ($iso) :
      echo '<li>ISO: ' . $iso . '</li>';
    endif;
  }


  if (array_key_exists('aperture', $attachment_fields)) {
    $aperture = $attachment_fields['aperture'][0];
    if ($aperture) :
      echo '<li>Aperture: ' . $aperture . '</li>';
    endif;
  }

  if (array_key_exists('shutter', $attachment_fields)) {
    $shutter = $attachment_fields['shutter'][0];
    if ($shutter) :
      echo '<li>Shutter speed:' . $shutter . '</li>';
    endif;
  }

  if (array_key_exists('focal', $attachment_fields)) {
    $focal = $attachment_fields['focal'][0];
    if ($focal) :
      echo '<li>Focal length: ' . $focal . '</li>';
    endif;
  }

  if (array_key_exists('film', $attachment_fields)) {
    $film = $attachment_fields['film'][0];
    if ($film) :
      echo '<li>Film: ' . $film . '</li>';
    endif;
  }

  if (array_key_exists('time', $attachment_fields)) {
    $time = $attachment_fields['time'][0];
    if ($time) :
      echo '<li>Time of capture: ' . $time . '</li>';
    endif;
  }

  if (array_key_exists('location', $attachment_fields)) {
    $loc = $attachment_fields['location'][0];
    if ($loc) :
      echo '<li>Location: ' . $loc . '</li>';
    endif;
  }

  echo '</ul>';
}



/**
 * Display partial data from the media meta boxes
 *
 * Displays title, caption, and link to full attachment
 *
 * @param $id The current post id
 * @return string HTML of additional data
 */
function modal_display_photo_meta($id)
{
  $attachment_id = (get_post_thumbnail_id($id));

  $image_title = get_the_title($attachment_id);
  $image_caption =  wp_get_attachment_caption($attachment_id);
  $image_link = get_attachment_link();

  if ($image_title) :
    echo '<h1>' . $image_title . '</h1>';
  endif;
  if ($image_caption) :
    echo '<p>' . $image_caption . '</p>';
  endif;
  if ($image_link) :
    echo '<a href ="' . $image_link . '"> View more &raquo; </a>';
  endif;
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