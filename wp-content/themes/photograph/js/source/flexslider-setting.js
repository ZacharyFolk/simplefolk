jQuery( document ).ready(function($) {
	var $window = $(window),
		flexslider = { vars:{} };

	$('.layer-slider').flexslider({
	    animation: photograph_slider_value.photograph_animation_effect,
	    animationLoop: true,
	    slideshow: true,
	    slideshowSpeed: photograph_slider_value.photograph_slideshowSpeed,
	    animationSpeed: photograph_slider_value.photograph_animationSpeed,
	    smoothHeight: true
	});
});