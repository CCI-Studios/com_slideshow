/* jshint mootools:true */

window.Slideshow.Carousel = new Class({
  Extends: window.Slideshow,

  transition: function(from, to, index_from, index_to) {
    from.tween('opacity', 0);
    to.tween('opacity', 1);
  }
});
