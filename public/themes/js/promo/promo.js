
$(document).ready(function() {
	var slideWidth = 293;
	var slideShowInterval;
	var speed = 5000;
	var currentPosition = 0;
	
	var slides = $('#booking-wrapper').not('.mobile').find('.promo');
	var numberOfSlides = slides.length;
	var mslides = $('#booking-wrapper.mobile .promo');
	var numberOfmSlides = mslides.length;

	slideShowInterval = setInterval(changePosition, speed);

	slides.wrapAll('<div class="slidesHolder"></div>')
	mslides.wrapAll('<div class="slidesHolder"></div>')

	slides.css({ 'float' : 'left' });
	mslides.css({ 'float' : 'left' });

	$('.slidesHolder').css('width', slideWidth * numberOfSlides);	

	function changePosition() {
		if(currentPosition == numberOfSlides - 1) {
			currentPosition = 0;
		} else {
			currentPosition++;
		}
		
		if(numberOfSlides > 1){
			moveSlide();
		}
	}
	function moveSlide() {
		$('.slidesHolder')
		  .animate({'marginLeft' : slideWidth*(-currentPosition)});
		 
	}

});