jQuery(function () {
  var t = jQuery('.featured-gallery, .post-featured-gallery');
  t.imagesLoaded(function () {
    t.isotope({ itemSelector: '.featured-item, .post-featured-item' }),
      jQuery('.filter-button').on('click', 'button', function () {
        var e = jQuery(this).attr('data-category');
        t.isotope({ filter: e }),
          jQuery('.filter-button button').removeClass('active'),
          jQuery(this).addClass('active');
      });
  });
});
