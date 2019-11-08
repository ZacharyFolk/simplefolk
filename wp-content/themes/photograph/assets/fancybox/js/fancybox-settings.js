jQuery( function() {
	jQuery('[data-fancybox="gallery, post-gallery"]').fancybox({
		animationDuration: 700,
		transitionEffect: 'slide',
		transitionDuration: 900,
		idleTime: 3,
		buttons: [
	        "zoom",
	        'slideShow',
	        'fullScreen',
	        "thumbs",
	        "close"
	    ]
	});
});