jQuery(function() {
  jQuery('.menu-item-634 a').click (function(e) {
    console.log('click latest link');
    e.preventDefault();
    jQuery('html, body').animate({scrollTop: jQuery('.site-content-contain').offset().top - jQuery('.main-header').height()}, 900, 'swing');
    return false;
  });
});
