window.Slideshow.Continuous = new Class({
  Extends: window.Slideshow,

  _setup: function() {
    this.parent();

    var slides = this.slidesContainer.getElements(this.options.slideSelector);
    slides.removeClass('active');
    slides[2].addClass('active');
  },

  _transition: function(slideData) {

    var slides = this.slidesContainer.getElements(this.options.slideSelector);
        slide = null;
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

    slides.removeClass('active');
    slides[3].addClass('active');
    this.thumbs.removeClass('active');
  }
});