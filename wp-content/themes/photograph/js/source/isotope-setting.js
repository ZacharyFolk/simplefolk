jQuery( function() {

	var $container = jQuery('.featured-gallery, .post-featured-gallery');

	jQuery(window).on('load', function () {
	    // Fire Isotope only when images are loaded
	    $container.imagesLoaded(function () {
	        $container.isotope({
	            itemSelector: '.featured-item, .post-featured-item',
	        });
	    });

	    // Filter
	    jQuery('.filter-button').on('click', 'button', function () {
	        var filterValue = jQuery(this).attr('data-category');
	        $container.isotope({filter: filterValue});

	        // Add or Remove css class on the bottom menu
			jQuery('.filter-button button').removeClass('active');
			jQuery(this).addClass('active');
	    });
	});

} );