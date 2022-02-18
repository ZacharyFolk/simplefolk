<?php

/**
 * Template Name: Tags Template
 * Displays the Tags page
 */
get_header();
?>
<div id="photos_page" class="wrap">
  <header class="page-header">
    <h2 class="page-title"><?php single_post_title(); ?></h2>
    <?php photograph_breadcrumb(); ?>
  </header>
  <div id="primary" class="content-area">wtf
    <main id="main" class="site-main" role="main">
      <div class="container post-featured-gallery post-gallery-col-5">

        <?php
        $tags = get_tags();
        foreach ($tags as $tag) :
          // get tag link
          $tag_link = get_tag_link($tag->term_id);
          // // get random image for this tag
          // $args = array(
          // 'post_type' => 'custom_event',
          // 'order' => 'rand',
          // 'tag__in' => array ($tag->term_id),
          // 'posts_per_page' => 1,
          // );
          // var_dump($tag);
          $post_tag = $tag->slug;
          $desc = $tag->description;
          $count = $tag->count;
          $the_query = new WP_Query(array('orderby' => 'rand', 'posts_per_page' => '1', 'tag' => $post_tag));

          if ($the_query->have_posts()) : ?>
            <?php while ($the_query->have_posts()) :
              $the_query->the_post();
              if (has_post_thumbnail()) : ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-featured-item'); ?>>
                  <div class="post-featured-gallery-wrap freesia-animation fadeInUp">
                    <div class="entry-thumb">
                      <figure class="entry-thumb-content">
                        <a data-title="<?php the_title_attribute(); ?>" href="<?php echo esc_url(get_permalink()); ?>">
                          <?php
                          echo $post_tag . ' in ' . $count . ' posts ' . $desc;
                          ?>
                        </a>
                      </figure>
                    </div>
                  </div>
                </article>
              <?php endif; ?>
        <?php
            endwhile;
          endif;
        endforeach;
        ?>
        <?php  // display rest of content
        // echo '<div id="tag-block">'
        //    . $tag->name
        //    . $tag->description
        //    . '<a href="'.$tag_link.'">see tag archive</a>'
        //    . $tag->count
        //    . '</div>';
        ?>
      </div>

  </div>
</div>