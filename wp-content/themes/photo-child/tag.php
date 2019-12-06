<?php
/**
 * The template for displaying tag pages
 */
get_header();
?>
<div id="tag_page" class="wrap">
	<header class="page-header">
    <h2 class="page-title"><?php echo 	single_term_title( 'Tagged with: ', false ); ?></h2>
		<span class="details-link" data-toggle-on="hide details" data-toggle-off="view details">view details</span>
		<?php
		the_archive_description( '<div class="tag-description">', '</div>' );
		photograph_breadcrumb(); ?>
	</header>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			if( have_posts() ) { ?>
				<div class="container post-featured-gallery post-gallery-col-4">
					<?php	while(have_posts() ) {
							the_post();
							get_template_part( 'content', get_post_format() );
						}
					}
					else { ?>
					<h2 class="entry-title"> <?php esc_html_e( 'No Posts Found.', 'photograph' ); ?> </h2>
					<?php } ?>
			</div>
			<?php get_template_part( 'pagination', 'none' ); ?>
		</main>
	</div>
</div>
<script>
jQuery(function($){
  var $container = jQuery('.featured-gallery, .post-featured-gallery');
  $.fn.toggleText = function(t1, t2){
  if (this.text() == t1) {
    this.text(t2);
    $('.entry-details').show();
    $container.isotope();
  } else {
    this.text(t1);
    $('.entry-details').hide();
    $container.isotope();
  }
  return this;
};

$('.details-link').click(function(){
  $(this).toggleText('view details', 'hide details');
})
//   var $container = jQuery('.featured-gallery, .post-featured-gallery');
//   var openText = $('.details-link').data('toggle-on');
//   var closeText = $('.details-link').data('toggle-off');
//
//   jQuery('.details-link').toggle(function(){
//     $(this).text(openText);
//     $container.isotope();
//     jQuery('.entry-details').show()
//   }), function() {
//     $(this).text(closeText);
//     $container.isotope();
//     jQuery('.entry-details').hide()
//   }
// })
});
</script>
<?php
get_footer();
