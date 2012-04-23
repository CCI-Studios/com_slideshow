/* jshint mootools:true */

window.Slideshow.Carousel = new Class({
  Extends: window.Slideshow,

  transition: function(from, to, index_from, index_to) {
    var slide;
    if (this.options.direction) { // rtl
      slide = this.slidesContainer.getElement(this.options.slideSelector);
      slide.inject(this.slidesContainer, 'bottom');
      this.slidesContainer.setStyle('left', -940);
      this.slidesContainer.tween('left', -1880);
    } else {  // ltr
      slide = this.slidesContainer.getLast(this.options.slideSelector);
      slide.inject(this.slidesContainer, 'top');
      this.slidesContainer.setStyle('left', -2820);
      this.slidesContainer.tween('left', -1880);
    }

    from.removeClass('active');
    to.addClass('active');
  }
});
