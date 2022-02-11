<?php
function selective_load(){
  // global scripts
  if (is_front_page()) {
    wp_enqueue_style('new-styles.css', get_template_directory_uri().'/path/to/new-styles.css', false ,'1.0', 'all' );
  } else {
  //  wp_enqueue_script('new-scripts.js', get_stylesheet_directory_uri().'/assets/sticky/derpy.js', false ,'1.0', 'all' );
  }
  wp_enqueue_script('right-click', get_stylesheet_directory_uri().'/assets/scripts/rc.js', false ,'0.3', 'all' );

}
add_action( 'wp_enqueue_scripts', 'selective_load' );
