/** 

Author : Ooi Kai Shien - OKSTMTCC
20151015

*/

$.fn.svgslider = function(options) {

    // This is the easiest way to have default options.
    var settings = $.extend({

        slideInterval: 3000,
        fadeDuration: 2000,
        parentSlide: null,
        slides: null

    }, options );


	var totalSlides = $(this).length;

  	var slideInterval = settings.slideInterval,
    fadeDuration = settings.fadeDuration,
    // $slideshow = $('#col-top svg'),
    // $slides = $('image.the-mask');
    $slideshow = settings.parentSlide,
    $slides = $(settings.slides);

	$slides.eq(0).show()

	setInterval(function() {

	    if ($(this).is(':animated')){
	        return false;
	    }

		// $slides = $('image.the-mask');
		$slides.eq(0).fadeOut(fadeDuration, function() {
		  $(this).appendTo($slideshow);
		});
		$slides.eq(1).fadeIn(fadeDuration);
	}, slideInterval);

	//Next Button
	$(".nextNav").click(function(e){
		e.preventDefault();
	    if ($(this).is(':animated')){
	        return false;
	    }

		var current_slide = $('image.the-mask[style="display: inline;"]');
		var current_index = current_slide.attr("data-index");

		$('image.the-mask:eq(0)').fadeOut(fadeDuration)
			.next(this)
			.fadeIn(fadeDuration)
			.end()
			.appendTo($slideshow);

	});

	//Prev Button
	$(".prevNav").click(function(e){
		e.preventDefault();
	    if ($(this).is(':animated')){
	        return false;
	    }

		var current_slide = $('image.the-mask[style="display: inline;"]');
		var current_index = current_slide.attr("data-index");
		var prev_index = 0;

		if(current_index==1){
			prev_index = totalSlides;
		}else{
			prev_index = (current_index - 1);
		}

		$('image#the-mask'+current_index).fadeOut(fadeDuration);
			$('image#the-mask'+prev_index)
			.fadeIn(fadeDuration)
			.end()
			.appendTo($slideshow);

	});

};