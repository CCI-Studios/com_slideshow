
;(function() {

var Slideshow = this.Slideshow = new Class({
  Implements: [Options, Events],

  options: {
    // transitions
    duration: 500,
    delay: 5000,
    direction: 1,
    autoplay: false,

    // selectors
    slidesContainerSelector: '.slides > div',
    slideSelector: '.slide',
    thumbsContainerSelector: '.thumbs > div',
    thumbSelector: '.thumb',

    // callbacks
    onShow: function() {},
    onShowComplete: function() {},
    onReverse: function() {},
    onPlay: function() {},
    onPause: function() {},

    debug: false
  },

  element: null,
  current: null,
  index: 0,

  slides: null,
  slidesContainer: null,
  thumbs: null,
  thumbsContainer: null,
  timer: null,
  running: false,

  initialize: function(element, options) {
    this.setOptions(options);
    this.element = document.id(element);

    window.addEvent('load', (function() {
      this._setup();
      this.fireEvent('ready');
    }).bind(this));
  },

  _setup: function() {
    this.slidesContainer = this.element.getElement(this.options.slidesContainerSelector);
    this.slides = this.slidesContainer.getElements(this.options.slideSelector);
    this.thumbsContainer = this.element.getElement(this.options.thumbsContainerSelector);
    this.thumbs = this.thumbsContainer.getElements(this.options.thumbSelector);

    this.thumbs.each((function(thumb) {
      thumb.addEvent('click', (function() {
        this.goTo(this.thumbs.indexOf(thumb));
      }).bind(this));
    }).bind(this));

    var maxHeight = 0,
      i = 0,
      _len = this.slides.length;
    for (; i < _len; i++) {
      if (this.slides[i].getSize().y > maxHeight) {
        maxHeight = this.slides[i].getSize().y;
      }
    }

    for (i = 0; i < _len; i++) {
      this.slides[i].setStyle('height', maxHeight);
    }

    this.slidesContainer.setStyle('height', maxHeight);
    this.direction = this.options.direction;

    this.index = 0;
    this.current = this.slides[this.index];

    this.element.removeClass('loading');
  },

  start: function() {
    this.running = true;
    this._queueSlide();
  },

  stop: function () {
    this.running = false;
    clearTimeout(this.timer);
  },

  next: function() {
    this.direction = 1;
    this.stop();
    this._showSlide(this._newIndex(1));
  },

  prev: function() {
    this.direction = -1;
    this.stop();
    this._showSlide(this._newIndex(-1));
  },

  goTo: function(index) {
    this.stop();
    this._showSlide(index);
  },

  _queueSlide: function(index) {
    this.running = true;
    this.timer = this._showSlide.bind(this, this._newIndex(1)).delay(this.options.delay);
  },

  _newIndex: function(distance) {
    var current = this.index + this.direction * distance;
    current += this.slides.length;
    current %= this.slides.length;

    return current;
  },

  _showSlide: function (nextIndex) {
    var slideData = {
      previous: {
        element: this.current,
        thumb: this.thumbs[this.index],
        index: this.index
      },
      next: {
        element: this.slides[nextIndex],
        thumb: this.thumbs[nextIndex],
        index: nextIndex
      }
    };

    this._transition(slideData);

    this.current = slideData.next.element;
    this.index = slideData.next.index;

    (function() {
      if (this.running) {
        this._queueSlide();
      }
    }).bind(this).delay(this.options.duration);
  },

  _transition: function(slideData) {
    //console.log(slideData);
  }

});

})();