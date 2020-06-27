<?php
/**
 * Template Name: Tags Template
 * Displays the Tags page
 */
 get_header();
 ?>
 	<!-- <header class="page-header">
    <div class="wrap">
  		<h2 class="page-title"><?php // single_post_title();?></h2>
    </div>
  	</header> -->
    <style>
    ul.tags-list {
      display: inline-block;
      margin: 0;
      width: 100%;
      font-family: "Special Elite", sans-serif;
      border-bottom: 1px dashed #2a2a2a;
      padding: 0 0 10px;
    }
    ul.tags-list li {
      float: left;
      margin: 5px 0 0;
    }
    ul.tags-list li:first-child {
      margin-top: 10px;
      min-width: 85px;
      max-width: 170px;
      display: block;
      line-height: 30px;
      margin-right: 20px;

    }
    </style>
<div class="wrap">

      <div class="container post-featured-gallery post-gallery-col-5">
        <?php $tags = get_tags();
        foreach ( $tags as $tag ) :
          $tag_link = get_tag_link( $tag->term_id );
          $post_tag = $tag->slug;
          $desc = $tag->description;
          $count = $tag->count;
          $path = '/tag/' . $post_tag;
          $the_query = new WP_Query(  array ( 'orderby' => 'rand', 'posts_per_page' => '20', 'tag' => $post_tag )); ?>
          <ul class="tags-list">
            <li>
              <a  title="<?php the_title_attribute(); ?>" href="<?php echo $path; ?>">
                <?php echo $post_tag ?>
              </a>
              <?php echo ' (' . $count . ') ' ?>
            </li>
            <?php if ( $the_query->have_posts() ) : ?>
              <?php while ( $the_query->have_posts() ) : $the_query->the_post();
              if( has_post_thumbnail()) : ?>
              <li>
                <a href="<?php echo get_permalink(); ?>"  title="<?php the_title_attribute(); ?>">
                  <?php echo the_post_thumbnail('tag_thumbs'); ?>
                </a>
              </li>
            <?php endif; ?>
          <?php endwhile; endif; ?>
        </ul>
      <?php endforeach;?>
    </div>

</div>
