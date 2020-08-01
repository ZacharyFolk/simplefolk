jQuery(function() {
  jQuery('.scroll-down').click (function(e) {
    e.preventDefault();
    jQuery('html, body').animate({scrollTop: jQuery('.site-content-contain').offset().top - jQuery('.main-header').height()}, 900, 'swing');
    return false;
  });
});
