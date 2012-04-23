/* jshint mootools:true */

window.Slideshow = new Class({
  Implements: [Options, Events],
  
  options: {
    duration: 500,
    delay: 5000,
    slides: [],
    direction: 1,
    slideContainerSelector: '.slides > div',
    slideSelector: '.slide',
    thumbSelector: null,
    debug: false
  },
  
  container: null,
  slidesContainer: null,
  slides: null,
  timer: null,
  running: false,
  current: 0,
  maxHeight: 0,
  maxWidth: 0,
  
  initialize: function(container, options) {
    this.setOptions(options);
    this.container = container;
    this.slidesContainer = container.getElement(this.options.slideContainerSelector);
    this.slides = [];
    
    window.addEvent('load', (function() {
      this.setup();
      return this.fireEvent('ready');
    }).bind(this));
  },

  setup: function() {
    var i, slide;
    this.addSlides(this.options.slides);
    this.addSlides(this.container.getElements(this.options.slideSelector));

    for (i = 0; i < 2; i++) {
      slide = this.slidesContainer.getLast(this.options.slideSelector);
      slide.inject(this.slidesContainer, 'top');
    }

    this.container.removeClass('loading');
    this.slidesContainer.get('tween').options.duration = this.options.duration;
    this.slidesContainer.get('tween').addEvent('onComplete', (function() {
      this.queueSlide();
      return this.fireEvent('didShowSlide');
    }).bind(this));
  },

  addSlide: function(slide) {
    this.addSlides(Array.from(slide));
  },

  addSlides: function(slides) {
    var slide, _i, _len;
    for (_i = 0, _len = slides.length; _i < _len; _i++) {
      slide = slides[_i];
      if (this.slides.length === 0) {
        slide.addClass('active');
      }
      this.slides.include(slide);
      if (slide.getSize().y > this.maxHeight) {
        this.maxHeight = slide.getSize().y;
      }
    }
    this.slidesContainer.setStyle('height', this.maxHeight);
  },

  start: function() {
    this.queueSlide();
    this.running = true;
  },

  stop: function() {
    this.running = false;
    clearTimeout(this.timer);
  },

  next: function() {
    this.options.direction = 1;
    this.showSlide();
  },
  prev: function() {
    this.options.direction = 0;
    this.showSlide();
  },
  goTo: function(index) {

  },

  queueSlide: function() {
    this.timer = this.showSlide.delay(this.options.delay, this);
  },

  showSlide: function() {
    var fromSlide, oldIndex, toSlide;
    if (this.running) {
      clearTimeout(this.timer);
    }

    oldIndex = this.current;
    fromSlide = this.slides[this.current];
    this.current = this.updateCurrent(1);
    toSlide = this.slides[this.current];
    
    this.fireEvent('willShowSlide');
    this.transition(fromSlide, toSlide, oldIndex, this.current);
  },

  updateCurrent: function(distance) {
    var current = this.current + (this.options.direction * 2 - 1) * distance;
    current += this.slides.length;
    current %= this.slides.length;

    return current;
  },

  transition: function(from, to, index_from, index_to) {
    // replace with proper implementation
  }
});
