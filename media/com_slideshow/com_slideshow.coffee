###jshint mootools:true###

Slideshow = new Class
	Implements: [Options, Events]
	options:
		transition: 'slide'
		duration: 500
		delay: 5000
		slides: []
		direction: 1
		slideSelector: '.slides .slide'
		thumbSelector: '.thumbs .thumb'

		# willShowSlide(slide, index)
		# didShowSlide(slide, index)

	slides: null
	container: null
	timer: null
	running: false
	current: 0
	maxHeight: 0

	initialize: (container, options)->
		@setOptions options
		@container = $$(container)
		@slides = []

		window.addEvent 'load', (->
			@setup()
		).bind @

		@

	setup: ->
		@addSlides @options.slides
		@addSlides $$ @options.slideSelector
		@container.removeClass 'loading'

		if @options.transition == 'slide'
			@slides[0].setStyle 'left', 0
		else if @options.transition == 'fade'
			@slides[0].setStyle 'opacity', 1

	addSlide: (slide)->
		@addSlides Array.from(slide)

	addSlides: (slides)->
		for slide in slides
			@slides.include slide
			if slide.getSize().y > @maxHeight
				@maxHeight = slide.getSize().y
			slide.get('tween').options.unit = '%'
			slide.get('tween').options.duration = @options.duration
			slide.get('tween').addEvent('onComplete', (->
				@queueSlide()
			).bind @)
		@container.setStyle 'height', @maxHeight

	start: ->
		@queueSlide()
		@running = true

	stop: ->
		@running = false
		clearTimeout @timer

	showSlide: ->
		if @running
			clearTimeout @timer

		fromSlide = @slides[@current]
		@current += @options.direction*2 - 1
		@current = @slides.length - 1 if @current < 0

		@current %= @slides.length
		toSlide = @slides[@current]

		@fireEvent('willShowSlide')
		if @options.transition == 'slide'
			@slideSlide fromSlide, toSlide
		else if @options.transition == 'fade'
			@fadeSlide fromSlide, toSlide

	queueSlide: ->
		@timer = @showSlide.delay @options.delay, @

	slideSlide: (fromSlide, toSlide)->
		toSlide.setStyle 'left', '-100%'
		toSlide.tween 'left', 0
		fromSlide.tween 'left', '100%'


	fadeSlide: (fromSlide, toSlide)->
		toSlide.setStyle 'opacity', 0
		toSlide.tween 'opacity', 1
		fromSlide.tween 'opacity', 0

