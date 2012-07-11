/* jshint mootools:true */

window.Slideshow.Fader = new Class({
	Extends: window.Slideshow,

	_transition: function(slideData) {
		slideData.previous.element
			.removeClass('active')
			.fade();
		slideData.previous.thumb
			.removeClass('active');
		slideData.next.element
			.addClass('active')
			.setStyle('display', 'block')
			.fade('in');
		slideData.next.thumb
			.addClass('active');
	}
});
