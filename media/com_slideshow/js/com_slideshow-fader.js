/* jshint mootools:true */

window.Slideshow.Fader = new Class({
	Extends: window.Slideshow,

	_transition: function(slideData) {
		slideData.previous.element
			.removeClass('active')
			.tween('opacity', 0);
		slideData.previous.thumb
			.removeClass('active');
		slideData.next.element
			.addClass('active')
			.tween('opacity', 1);
		slideData.next.thumb
			.addClass('active');
	}
});
