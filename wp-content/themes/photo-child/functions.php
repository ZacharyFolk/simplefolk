<?php
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
  wp_enqueue_style('fancybox-css', get_stylesheet_directory_uri() . '/assets/fancybox/css/3.5.7/jquery.fancybox.css');
  wp_enqueue_script('photograph-fancybox-settings', get_template_directory_uri() . '/assets/fancybox/js/fancybox-settings.js', array('fancybox'), false, true);
  wp_enqueue_script('jquery-jarallax', get_template_directory_uri() . '/assets/jarallax/jarallax.js', array('jquery'), false, true);
  wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), false, true);
  wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri() . '/js/isotope-setting.js', array('isotope'), false, true);
  wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/assets/fancybox/js/3.5.7/jquery.fancybox.min.js', array('jquery'), false, true);
  wp_enqueue_script('scrolling', get_stylesheet_directory_uri() . '/assets/scripts/scrolling.js', array('jquery'), false, true);
  wp_enqueue_script('horizMasonry', get_stylesheet_directory_uri() . '/assets/scripts/masonryHorizontal.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', 'photo_child_enqueue_styles');
add_image_size('tag_thumbs', 85, 45, true);
add_image_size('admin_thumbs', 150, 100, true);

// note : have to use STYLESHEETPATH here because TEMPLATEPATH returns the parent
// var_dump(get_template_directory());
//var_dump(get_stylesheet_directory());
// this also works
//var_dump(get_theme_file_path());

// set up admin customize panel
add_theme_support('custom-logo');

add_theme_support('post-thumbnails');

// get Google fonts 

function wpb_add_google_fonts()
{
  wp_enqueue_style('wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Merriweather&family=Space+Mono&family=Zen+Maru+Gothic&display=swap', false);
}

add_action('wp_enqueue_scripts', 'wpb_add_google_fonts');

// display a random image for home page
function get_random_image_src()
{
  // collection is from gallery category
  $query = new WP_Query(array(
    'posts_per_page' =>  1,
    'orderby' => 'rand',
    'post_type'          => 'post',
    'category_name' => esc_attr('gallery'),
  ));
  while ($query->have_posts()) : $query->the_post();
    $attachment_id = get_post_thumbnail_id();
    $image_attributes = wp_get_attachment_image_src($attachment_id, 'full');
    return esc_url($image_attributes[0]);
  endwhile;
}

function random_home()
{
  $query = new WP_Query(array(
    'posts_per_page' =>  1,
    'orderby' => 'rand',
    'post_type'          => 'post',
    'category_name' => esc_attr('gallery'),
  ));
  while ($query->have_posts()) : $query->the_post();
    $attachment_id = get_post_thumbnail_id();
    $image_attributes = wp_get_attachment_image_src($attachment_id, 'full'); ?>
    <div class="vid-thumb-bg jarallax" title="<?php the_title_attribute(); ?>" data-jarallax style="background-image:url('<?php echo esc_url($image_attributes[0]); ?>');">
    <?php endwhile; ?>
  <?php } ?>
  <?php
  require get_theme_file_path() . '/inc/settings/asset-functions.php';

  /*======== Single Sidebar Thumbs from current category ===================*/

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

  function get_cat_link()
  {
    $the_cat = get_the_category();
    $category_name = $the_cat[0]->cat_name;
    $category_link = get_category_link($the_cat[0]->cat_ID);
    echo '<div class="single-cat-link">View all of the <a href="' . $category_link . '">' . $category_name . ' collection &gt; &gt;</a></div>';
  }

  function cat_thumb_heading()
  {
    $the_cat = get_the_category();
    $category_name = $the_cat[0]->cat_name;
    echo $category_name;
  }
  function add_font()
  {
    $folk_font = array();
    array_push($folk_font, 'Special+Elite');
    array_push($folk_font, 'Rajdhani');
    $folk_fonts = implode("|", $folk_font);
    wp_register_style('folk-fonts', '//fonts.googleapis.com/css?family=' . $folk_fonts . '&display=swap');
    wp_enqueue_style('folk-fonts');
  }
  add_action('wp_enqueue_scripts', 'add_font');

  /* Remove inline width/height attributes */

  add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
  add_filter('image_send_to_editor', 'remove_width_attribute', 10);

  function remove_width_attribute($html)
  {
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
  }


  // Prevent WP from adding <p> tags on all post types
  function disable_wp_auto_p($content)
  {
    remove_filter('the_content', 'wpautop');
    remove_filter('the_excerpt', 'wpautop');
    return $content;
  }
  add_filter('the_content', 'disable_wp_auto_p', 0);


  // add featured post image in admin post list
  add_filter('manage_posts_columns', 'add_img_column');
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


  /**
   * Return only the first category when outputting the previous/next post links
   */
  function my_custom_post_navigation($terms, $object_ids, $taxonomies, $args)
  {

    return array_slice($terms, 0, 1);
  }


  /* Filter to prepend tags with # */

  function hashed_tags()
  {
    $post_tags = get_the_tags();
    $prefix = '#';
    $separator = ' ';
    $output = '';

    if (!empty($post_tags)) {
      foreach ($post_tags as $tag) {
        $output .= '<a href="' . esc_attr(get_tag_link($tag->term_id)) . '">' . $prefix . __($tag->name) . '</a>' . $separator;
      }
    }

    return trim($output, $separator);
  }


  /*======== BREADCRUMBS ===================*/

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
        echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';
      }
    } else {
      echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
      if (is_category()) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) {
          echo get_category_parents($thisCat->parent, true, ' ' . $delimiter . ' ');
        }
        echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
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
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
        if ($showCurrent == 1) {
          echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        }
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
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
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

  /* Copying over from /inc/settings/photograph-functions.php

/*************************** ENQUEING STYLES AND SCRIPTS ****************************************/
  // function photograph_scripts() {
  // 	$photograph_settings = photograph_get_theme_options();
  // 	$photograph_stick_menu = $photograph_settings['photograph_stick_menu'];
  // 	$photograph_slider_video_display = $photograph_settings['photograph_slider_video_display'];
  // 	$photograph_video_upload = $photograph_settings['photograph_video_upload'];
  // 	$photograph_slider_youtube_url = $photograph_settings['photograph_slider_youtube_url'];
  // 	$photograph_enable_slider = $photograph_settings['photograph_enable_slider'];
  //
  // 	wp_enqueue_script('photograph-main', get_template_directory_uri().'/js/photograph-main.js', array('jquery'), false, true);
  // 	// Load the html5 shiv.
  // 	wp_enqueue_script( 'html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
  // 	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
  // 	wp_enqueue_style( 'photograph-style', get_stylesheet_uri() );
  //
  // 	if( $photograph_settings['photograph_animate_css'] == 0) {
  // 		wp_enqueue_style('animate-css', get_template_directory_uri().'/assets/wow/css/animate.min.css');
  // 		wp_enqueue_script('wow', get_template_directory_uri().'/assets/wow/js/wow.min.js', array('jquery'), false, true);
  // 		wp_enqueue_script('photograph-wow-settings', get_template_directory_uri().'/assets/wow/js/wow-settings.js', array('jquery'), false, true);
  // 	}
  //
  // 	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/font-awesome/css/font-awesome.min.css');
  // 	wp_enqueue_script('photograph-skip-link-focus-fix', get_template_directory_uri().'/js/skip-link-focus-fix.js', array('jquery'), false, true);
  // 	wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri().'/js/imagesloaded.pkgd.min.js', array('jquery'), false, true);
  // 	wp_enqueue_script('isotope', get_template_directory_uri().'/js/isotope.pkgd.min.js', array('jquery'), false, true);
  // 	wp_enqueue_script('photograph-isotope-setting', get_template_directory_uri().'/js/isotope-setting.js', array('isotope'), false, true);
  // 	wp_enqueue_script( 'photograph-slider' );
  //
  // 	if( $photograph_settings['photograph_responsive'] == 'on' ) {
  // 		wp_enqueue_style('photograph-responsive', get_template_directory_uri().'/css/responsive.css');
  // 	}
  // 	/********* Adding Multiple Fonts ********************/
  // 	// $photograph_googlefont = array();
  // 	// array_push( $photograph_googlefont, 'Roboto');
  // 	// array_push( $photograph_googlefont, 'Rajdhani');
  // 	// $photograph_googlefonts = implode("|", $photograph_googlefont);
  // 	//
  // 	// wp_register_style( 'photograph-google-fonts', '//fonts.googleapis.com/css?family='.$photograph_googlefonts .':300,400,400i,500,600,700');
  // 	// wp_enqueue_style( 'photograph-google-fonts' );
  // 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  // 		wp_enqueue_script( 'comment-reply' );
  // 	}
  // 	$photograph_internal_css='';
  // 	/* Theme Color Styles */
  // 	$photograph_theme_color_styles = get_theme_mod( 'theme_color_styles', '#fd513b' );
  // 	/* Custom Css */
  // 	if ($photograph_settings['photograph_logo_high_resolution'] !=0){
  // 		$photograph_internal_css .= '/* Center Logo for high resolution screen(Use 2X size image) */
  // 		.top-logo-title .custom-logo-link {
  // 			display: inline-block;
  // 		}
  //
  // 		.top-logo-title .custom-logo {
  // 			height: auto;
  // 			width: 50%;
  // 		}
  //
  // 		.top-logo-title #site-detail {
  // 			display: block;
  // 			text-align: center;
  // 		}
  //
  // 		@media only screen and (max-width: 767px) {
  // 			.top-logo-title .custom-logo-link .custom-logo {
  // 				width: 60%;
  // 			}
  // 		}
  //
  // 		@media only screen and (max-width: 480px) {
  // 			.top-logo-title .custom-logo-link .custom-logo {
  // 				width: 80%;
  // 			}
  // 		}';
  // 	}
  //
  //
  // 	if($photograph_settings['photograph_header_display']=='header_logo'){
  // 		$photograph_internal_css .= '
  // 		#site-branding #site-title, #site-branding #site-description{
  // 			clip: rect(1px, 1px, 1px, 1px);
  // 			position: absolute;
  // 		}';
  // 	}
  //
  // 	wp_add_inline_style( 'photograph-style', wp_strip_all_tags($photograph_internal_css) );
  // }
  // add_action( 'wp_enqueue_scripts', 'photograph_scripts' );
  //

  // function selective_load(){
  //   if (is_front_page()) {
  //     wp_enqueue_style('new-styles.css', get_template_directory_uri().'/path/to/new-styles.css', false ,'1.0', 'all' );
  //     wp_enqueue_script('new-scripts.js', get_template_directory_uri().'/path/to/yes.js', false ,'1.0', 'all' );
  //   } else {
  //     wp_enqueue_script('new-scripts.js', get_template_directory_uri().'/path/to/else.js', false ,'1.0', 'all' );
  //
  //   }
  // }
  // add_action( 'wp_enqueue_scripts', 'selective_load' );
  ?>