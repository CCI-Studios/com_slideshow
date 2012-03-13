/*jshint mootools:true
*/
var Slideshow;

Slideshow = new Class({
  Implements: [Options, Events],
  options: {
    transition: 'slide',
    duration: 500,
    delay: 5000,
    slides: [],
    direction: 1,
    slideSelector: '.slides .slide',
    thumbSelector: '.thumbs .thumb'
  },
  slides: null,
  container: null,
  timer: null,
  running: false,
  current: 0,
  maxHeight: 0,
  initialize: function(container, options) {
    this.setOptions(options);
    this.container = $$(container);
    this.slides = [];
    window.addEvent('load', (function() {
      return this.setup();
    }).bind(this));
    return this;
  },
  setup: function() {
    this.addSlides(this.options.slides);
    this.addSlides($$(this.options.slideSelector));
    this.container.removeClass('loading');
    if (this.options.transition === 'slide') {
      return this.slides[0].setStyle('left', 0);
    } else if (this.options.transition === 'fade') {
      return this.slides[0].setStyle('opacity', 1);
    }
  },
  addSlide: function(slide) {
    return this.addSlides(Array.from(slide));
  },
  addSlides: function(slides) {
    var slide, _i, _len;
    for (_i = 0, _len = slides.length; _i < _len; _i++) {
      slide = slides[_i];
      this.slides.include(slide);
      if (slide.getSize().y > this.maxHeight) this.maxHeight = slide.getSize().y;
      slide.get('tween').options.unit = '%';
      slide.get('tween').options.duration = this.options.duration;
      slide.get('tween').addEvent('onComplete', (function() {
        return this.queueSlide();
      }).bind(this));
    }
    return this.container.setStyle('height', this.maxHeight);
  },
  start: function() {
    this.queueSlide();
    return this.running = true;
  },
  stop: function() {
    this.running = false;
    return clearTimeout(this.timer);
  },
  showSlide: function() {
    var fromSlide, toSlide;
    if (this.running) clearTimeout(this.timer);
    fromSlide = this.slides[this.current];
    this.current += this.options.direction * 2 - 1;
    if (this.current < 0) this.current = this.slides.length - 1;
    this.current %= this.slides.length;
    toSlide = this.slides[this.current];
    this.fireEvent('willShowSlide');
    if (this.options.transition === 'slide') {
      return this.slideSlide(fromSlide, toSlide);
    } else if (this.options.transition === 'fade') {
      return this.fadeSlide(fromSlide, toSlide);
    }
  },
  queueSlide: function() {
    return this.timer = this.showSlide.delay(this.options.delay, this);
  },
  slideSlide: function(fromSlide, toSlide) {
    toSlide.setStyle('left', '-100%');
    toSlide.tween('left', 0);
    return fromSlide.tween('left', '100%');
  },
  fadeSlide: function(fromSlide, toSlide) {
    toSlide.setStyle('opacity', 0);
    toSlide.tween('opacity', 1);
    return fromSlide.tween('opacity', 0);
  }
});
