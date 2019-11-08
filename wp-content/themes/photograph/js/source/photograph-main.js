jQuery( function() {
		
		jQuery('.header-search').click( function(){
			jQuery('#search-box').addClass('show-search-box');
		});

		jQuery('.search-x').click( function(){
			jQuery('#search-box').removeClass('show-search-box');
		});

		// Scroll Down Social
		jQuery(window).scroll(function(){
		    if (jQuery(this).scrollTop() > 100) {
		       jQuery('.header-social-block').addClass('scrolled-social');
		    } else {
		       jQuery('.header-social-block').removeClass('scrolled-social');
		    }
		});

		// Scroll Down
		jQuery(function() {
			jQuery('.scroll-down').click (function() {
			  jQuery('html, body').animate({scrollTop: jQuery('.site-content-contain').offset().top - jQuery('.main-header').height()}, 900, 'swing');
			  return false;
			});
		});

		// Menu toggle for below 981px screens.
		( function() {
			var togglenav = jQuery( '.main-navigation' ), button, menu;
			var togglebody = jQuery( 'body' );
			if ( ! togglenav ) {
				return;
			}

			button = togglenav.find( '.menu-toggle' );
			if ( ! button ) {
				return;
			}
			
			menu = togglenav.find( '.menu' );
			if ( ! menu || ! menu.children().length ) {
				button.hide();
				return;
			}

			jQuery( '.menu-toggle' ).on( 'click', function() {
				jQuery(this).toggleClass("on");
				togglenav.toggleClass( 'toggled-on' );
				togglebody.toggleClass( 'no-tog' );
			} );
		} )();

		// Top Menu toggle for below 981px screens.
		( function() {
			var togglenav = jQuery( '.top-bar-menu' ), button, menu;
			if ( ! togglenav ) {
				return;
			}

			button = togglenav.find( '.top-menu-toggle' );
			if ( ! button ) {
				return;
			}
			
			menu = togglenav.find( '.top-menu' );
			if ( ! menu || ! menu.children().length ) {
				button.hide();
				return;
			}

			jQuery( '.top-menu-toggle' ).on( 'click', function() {
				jQuery(this).toggleClass("on");
				togglenav.toggleClass( 'toggled-on' );
			} );
		} )();

		// Menu toggle for side nav.
		jQuery(document).ready( function() {
		  //when the button is clicked
		  jQuery(".show-menu-toggle, .hide-menu-toggle, .page-overlay").click( function() {
		    //apply toggleable classes
		    jQuery(".side-menu").fadeToggle('slow');
		    jQuery(".side-menu").addClass("show");
		    jQuery(".page-overlay").toggleClass("side-menu-open"); 
		    jQuery("#page").addClass("side-content-open");  
		  });
		  
		  jQuery(".hide-menu-toggle, .page-overlay").click( function() {
		    jQuery(".side-menu").removeClass("show");
		    jQuery(".page-overlay").removeClass("side-menu-open");
		    jQuery("#page").removeClass("side-content-open");
		  });
		});

		// Go to top button.
		jQuery(document).ready(function(){

		// Hide Go to top icon.
			jQuery(".go-to-top").hide();

			jQuery(window).scroll(function(){

				var windowScroll = jQuery(window).scrollTop();
				if(windowScroll > 900)
				{
				  jQuery('.go-to-top').fadeIn();
				}
				else
				{
				  jQuery('.go-to-top').fadeOut();
				}
			});

			  // scroll to Top on click
			jQuery('.go-to-top').click(function(){
			jQuery('html,header,body').animate({
				scrollTop: 0
			}, 700);
				return false;
			});

		});

} );