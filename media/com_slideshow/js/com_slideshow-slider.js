/* jshint mootools:true */

window.Slideshow.Slider = new Class({
  Extends: window.Slideshow,

  transition: function(from, to, index_from, index_to) {
    from.tween('left', 0);
    to.tween('left', 0);
  }
});
