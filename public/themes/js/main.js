$(document).ready(function(){
	
	//Make Top Header Sticky
	 $("nav").sticky({topSpacing:0});
	
	
	 /*Home Page Main Offer slider*/
  	$(".room-slide .room-slide-a").each(function(e) {
       if (e != 0)
            $(this).hide();
		else{
			$(".room-slide .room-slide-a:first").fadeIn("5000");
		}
    });

	$("#home-studio .offer-desc-block").each(function(e) {

       if (e != 0){
            $(this).hide();
            $(this).find(".offer-desc-inner").hide();
	   }
		else{
			$("#home-studio .offer-desc-block:first").fadeIn("5000");
			$("#home-studio .offer-desc-block:first .offer-desc-inner").fadeIn("fast");
			//$("#home-studio .offer-desc-block:first .desc-book-now").fadeIn("fast");
			//$("#home-studio .offer-desc-block:first .description-full").fadeIn("fast");
		}
    });

	if($("#home-studio .offer-desc-block").length==1){
		$("#offer-next").hide();
		$("#offer-prev").hide();
	}

	$("#room-next").click(function(){
        if ($(".room-slide .room-slide-a:visible").next().length != 0){
			if($(window).width()<480){
				
				var height=$(".room-slide").height();
				//alert(height);
				$(".room-slide").css("height",height);
				$(".room-slide  .room-slide-a").css("height",height);
				$(".room-slide .room-slide-a").css("position","absolute");
				
				$(".room-slide .room-slide-a:visible").next().show("slide",{direction:'right'});
				$(".room-slide .room-slide-a:visible:first").hide("slide",{direction:'left'});
	
				$(".room-slide").css("height","100%");
				$(".room-slide  .room-slide-a").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");

			}
			else{
				$(".room-slide .room-slide-a:visible").next().show("slide",{direction:'right'});
				$(".room-slide .room-slide-a:visible:first").hide("slide",{direction:'left'});
			}
		}
        else {
			if($(window).width()<480){
				var height=$(".room-slide").height();
				//alert(height);
				//$("#home-rooms").css("height",height);
				$(".room-slide").css("height",height);
				$(".room-slide  .room-slide-a").css("height",height);
				$(".room-slide .room-slide-a").css("position","absolute");
				
				$(".room-slide .room-slide-a:visible").hide("slide",{direction:'left'});
				$(".room-slide .room-slide-a:first").show("slide",{direction:'right'});
				
				//$("#home-rooms").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");
				$(".room-slide  .room-slide-a").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");
			}
			else{				
				$(".room-slide .room-slide-a:visible").hide("slide",{direction:'left'});
				$(".room-slide .room-slide-a:first").show("slide",{direction:'right'});
			}
        }
        return false;
    });

    $("#room-prev").click(function(){
        if ($(".room-slide .room-slide-a:visible").prev().length != 0){
			if($(window).width()<480){
				
				var height=$(".room-slide").height();
				//alert(height);
				//$("#home-rooms").css("height",height);
				$(".room-slide").css("height",height);
				$(".room-slide  .room-slide-a").css("height",height);
				$(".room-slide .room-slide-a").css("position","absolute");
				$(".room-slide .room-slide-a:visible").prev().show("slide",{direction:'left'});
				$(".room-slide .room-slide-a:visible:last").hide("slide",{direction:'right'});

				//$("#home-rooms").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");
				$(".room-slide  .room-slide-a").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");
			}
			else{
				$(".room-slide .room-slide-a:visible").prev().show("slide",{direction:'left'});
				$(".room-slide .room-slide-a:visible:last").hide("slide",{direction:'right'});
			}
			
		}
        else {
			if($(window).width()<480){
				$(".room-slide .room-slide-a").css("position","absolute");
				var height=$(".room-slide").height();
				//alert(height);
				//$("#home-rooms").css("height",height);
				$(".room-slide").css("height",height);
				$(".room-slide  .room-slide-a").css("height",height);
				$(".room-slide .room-slide-a").css("position","absolute");
				
				$(".room-slide .room-slide-a:visible").hide("slide",{direction:'right'});
				$(".room-slide .room-slide-a:last").show("slide",{direction:'left'});
			
				//$("#home-rooms").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");
				$(".room-slide  .room-slide-a").css("height","auto");
				$(".room-slide .room-slide-a").css("position","relative");
			}
			else{	
				//alert("lala");			
				$(".room-slide .room-slide-a:visible").hide("slide",{direction:'right'});
				$(".room-slide .room-slide-a:last").show("slide",{direction:'left'});
			}
        }
        return false;
    });

	//Home Offer Slide Next prev
	$("#offer-next").click(function(){
        if ($("#home-studio .offer-desc-block:visible").next().length != 0){
			if($(window).width()<480){
				
				var height=$(".room-slide").height();
	
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").next().show("slide",{direction:'right'});
				
				$("#home-studio .offer-desc-block:visible:first").hide("slide",{direction:'left'},function(){
					$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeIn("slow");
				});
				$("#home-rooms").css("height","auto");

			}
			else{	
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").next().show("slide",{direction:'right'});

				$("#home-studio .offer-desc-block:visible:first").hide("slide",{direction:'left'},function(){
					$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeIn("slow");
				});

				/*$("#home-studio .offer-desc-block:visible .desc-title").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible .desc-book-now").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible .description-full").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").hide("slide",{direction:'left'});
				
				$("#home-studio .offer-desc-block:first").show("slide",{direction:'right'},function(){
					$("#home-studio .offer-desc-block:first .desc-title").fadeIn("slow");
					$("#home-studio .offer-desc-block:first .desc-book-now").fadeIn("slow");
					$("#home-studio .offer-desc-block:first .description-full").fadeIn("slow");
				});*/
			}
		}
        else {
			if($(window).width()<480){
				var height=$(".room-slide").height();
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").hide("slide",{direction:'left'});
				
				$("#home-studio .offer-desc-block:first").show("slide",{direction:'right'},function(){
					$("#home-studio .offer-desc-block:first .offer-desc-inner").fadeIn("slow");
				});
				$("#home-studio .offer-desc-block").css("position","relative");
			}
			else{				
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").hide("slide",{direction:'left'});
				
				$("#home-studio .offer-desc-block:first").show("slide",{direction:'right'},function(){
					$("#home-studio .offer-desc-block:first .offer-desc-inner").fadeIn("slow");
				});
			}
        }
        return false;
    });

    $("#offer-prev").click(function(){
		//alert("prev");
        if ($("#home-studio .offer-desc-block:visible").prev().length != 0){
			if($(window).width()<480){
				
				var height=$(".room-slide").height();
				//alert(height);
				$("#home-studio .offer-desc-block").css("position","absolute");
			
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").prev().show("slide",{direction:'left'});
				
				
				$("#home-studio .offer-desc-block:visible:last").hide("slide",{direction:'right'},function(){
					$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeIn("slow");
				});

				$("#home-studio .offer-desc-block").css("position","relative");
			}
			else{
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").prev().show("slide",{direction:'left'});
				
				
				$("#home-studio .offer-desc-block:visible:last").hide("slide",{direction:'right'},function(){
					$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeIn("slow");
				});
			}
			
		}
        else {
			if($(window).width()<480){
				$("#home-studio .offer-desc-block").css("position","absolute");
				var height=$(".room-slide").height();

				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").hide("slide",{direction:'right'});
				
				$("#home-studio .offer-desc-block:last").show("slide",{direction:'left'},function(){
					$("#home-studio .offer-desc-block:last .offer-desc-inner").fadeIn("slow");
				});
				$("#home-studio .offer-desc-block").css("position","relative");

			}
			else{				
				$("#home-studio .offer-desc-block:visible .offer-desc-inner").fadeOut("fast");
				$("#home-studio .offer-desc-block:visible").hide("slide",{direction:'right'});
				
				$("#home-studio .offer-desc-block:last").show("slide",{direction:'left'},function(){
					$("#home-studio .offer-desc-block:last .offer-desc-inner").fadeIn("slow");
				});
			}
        }
        return false;
    });
	
	//Booking Form Close Open
	$("#booking-close").click(function(){
		var winWidth = $(window).width();
		if(winWidth>1200){
			//alert("here");
			// $("#booking-wrapper").css("right","50%");
			// $("#booking-wrapper").css("margin-right","-550px");
		}

		$("#booking-close").hide();
		$("#booking-form").slideDown(500);	
		// $("#booking-wrapper").css("position","fixed");

		
	});
	
	//Offer Page href Scroll
	if(window.location.hash) {

		var type = window.location.hash.substr(1);

		$(document).scrollTop($("#offer-href"+type).offset().top-50);  
	}

	/*OPen booking Form while scrollTop==0*/
	$(function () {
		var $win = $(window);
		$win.scroll(function () {
			//$(".left-container").stick_in_parent();
			if ($win.scrollTop() == 0){
				if($("#booking-form:hidden").length==0){
					//alert("hideno");
				}
				else{
					$("#booking-form").slideDown(250);	
					$("#booking-close").hide();
				}
				$("#booking-close").hide();
			}else if ($win.scrollTop() != 0){
				$("#booking-form").slideUp(100,function(){
					$("#booking-close").show();
				});
				// $("#booking-close").fadeIn(600);
				
			}
			$("#booking-wrapper").css("position","absolute");
			$("#booking-wrapper").css("right","0px");
			$("#booking-wrapper").css("margin-right","50px");

		});
	});
	

/*Mobile Menu*/
$('.sbOptions').find('li:eq(0)').css({'display': 'none'})
	//Mobile navigation menu
	$('#menu .span').click(function () {
		$(this).toggleClass("active");  
		$(this).parent().find("> ul").slideToggle('medium');
	});
	$('#menu.m-menu > ul > li.categories > div > .column > div').before('<span class="more"></span>');
	$('span.more').click(function () {
		$(this).next().slideToggle('fast');
		$(this).toggleClass('plus');
	});
	

/*Scroll with Speed*/
$('a[href*=#]').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')&& location.hostname == this.hostname) {
	  var $target = $(this.hash);
	  //var $height=$(".header").height();
	  $target = $target.length && $target
	  || $('[name=' + this.hash.slice(1) +']');
	  if ($target.length) {
		var targetOffset = $target.offset().top;
		//alert($height);
		$('html,body')
		.animate({scrollTop: targetOffset}, 1000);
	   return false;
	  }
	}
});
	
	
	//Check in Check out date
	$(".arriving-tab .booking-bg").live("mouseover", function() {
		$(this).find('.ui-datepicker').css('visibility','visible').show(10);
		// $(this).find('.ui-datepicker').show(10);

		$(this).datepicker({
			dateFormat: 'yy-mm-dd', 
			minDate: 0,
			onSelect: function(dateText, inst) {
				// $(this).find('.ui-datepicker').hide(10);
	    		$(this).find('.ui-datepicker').css('visibility','hidden');


				var selDate = new Date(dateText);
	            $('.checkInDate').val($.datepicker.formatDate('yy-mm-dd',selDate));
				// var selDay = selDate.getDate();
				// var selMonth = selDate.getMonth()+1;
				// var selYear = selDate.getFullYear();
				$('.in-date').html($.datepicker.formatDate('d',selDate));
				$('.in-month').html($.datepicker.formatDate('MM',selDate));

				var checkIn = $('.checkInDate').val();
				var checkOut = $('.checkOutDate').val();
				var checkInDate = new Date(checkIn);
				var checkOutDate = new Date(checkOut);

				//To reset checkout date if select lower checkin date
				var minDate = new Date(Date.parse(dateText));
				minDate.setDate(minDate.getDate() + 1);
				
				$(".departing-tab .booking-bg").datepicker("option", "minDate", minDate);
				if(daysBetween(checkInDate, checkOutDate) < 1){
					$('.out-date').html($.datepicker.formatDate('d',minDate));
					$('.out-month').html($.datepicker.formatDate('MM',minDate));
					$('.checkOutDate').val($.datepicker.formatDate('yy-mm-dd',minDate));
					checkOutDate = minDate;
				}
				//To reset checkout date if select lower checkin date

				$('.nightStay').html(daysBetween(checkInDate, checkOutDate));
			}
		});
	}).live("mouseleave", function() {
	    $(this).find('.ui-datepicker').hide(10);
	})


	$(".departing-tab .booking-bg").live("mouseover", function() {
		$(this).find('.ui-datepicker').css('visibility','visible').show(10);
		// $(this).find('.ui-datepicker').show(10);
		
		$(this).datepicker({
			dateFormat: 'yy-mm-dd', 
			minDate: "+1D",
			onSelect: function(dateText, inst) {
				// $(this).find('.ui-datepicker').hide(10);
				$(this).find('.ui-datepicker').css('visibility','hidden');

				var selDate = new Date(dateText);

				$('.out-date').html($.datepicker.formatDate('d',selDate));
				$('.out-month').html($.datepicker.formatDate('MM',selDate));

				// var maxDate = new Date(Date.parse(dateText));
				// maxDate.setDate(maxDate.getDate() - 1);    
				// $(".arriving-tab-tab .booking-bg").datepicker( "option", "maxDate", maxDate)
				// $('#in-date').html($.datepicker.formatDate('d',maxDate));
				// $('#in-month').html($.datepicker.formatDate('MM',maxDate));

				// $('#arrival_date').val($.datepicker.formatDate('yy-mm-dd',selDate));
				$('.checkOutDate').val($.datepicker.formatDate('yy-mm-dd',selDate));

				var checkIn = $('.checkInDate').val();
				var checkOut = $('.checkOutDate').val();
				var checkInDate = new Date(checkIn);
				var checkOutDate = new Date(checkOut);
				
				//To reset checkin date if select higher checkout date
				var minDate = new Date(Date.parse(dateText));
				minDate.setDate(minDate.getDate() - 1);
				if(daysBetween(checkInDate, checkOutDate) < 1){
					$('.in-date').html($.datepicker.formatDate('d',minDate));
					$('.in-month').html($.datepicker.formatDate('MM',minDate));
					$('.checkInDate').val($.datepicker.formatDate('yy-mm-dd',minDate));
					checkInDate = minDate;
				}
				//To reset checkin date if select higher checkout date

				$('.nightStay').html(daysBetween(checkInDate, checkOutDate));
			}

		});
	}).live("mouseleave", function() {
	    $(this).find('.ui-datepicker').hide(10);
	})	

	function daysBetween( date1, date2 ) {
		//Get 1 day in milliseconds
		var one_day=1000*60*60*24;

		// Convert both dates to milliseconds
		var date1_ms = date1.getTime();
		var date2_ms = date2.getTime();

		// Calculate the difference in milliseconds
		var difference_ms = date2_ms - date1_ms;

		// Convert back to days and return
		return Math.round(difference_ms/one_day); 
	}
	//Check in CHeck out date

	//Live update booking form engine hidden value
	$('.room_no').keyup(function() {
        $('input[name=rooms]').val($(this).val());
        $('.room_no').val($(this).val());
    });
	$('.adult_no').keyup(function() {
        $('input[name="adults[]"]').val($(this).val());
        $('.adult_no').val($(this).val());
    });
	$('.offercode').keyup(function() {
        $('input[name=offer_code]').val($(this).val());
        $('.offercode').val($(this).val());
    });


   $('.room-slide').slick({
		autoplay: false,
		infinite: true,
		swipeToSlide:true,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: false
   });;

	//Room And Offer Slider
	$('.room-slick').each(function (idx, item) {
	   var largeId = "large" + idx;
	   var thumbId = "thumb" + idx;
	   this.id = largeId;
	   $(this).slick({
			autoplay: false,
			infinite: true,
			swipeToSlide:true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false
	   });
	});

	$('.offer-slick').each(function (idx, item) {
	   var largeId = "large" + idx;
	   var thumbId = "thumb" + idx;
	   this.id = largeId;
	   $(this).slick({
			autoplay: false,
			swipeToSlide:true,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false
	   });
	});

	$('.fnb-slide').each(function (idx, item) {
	   var largeId = "large" + idx;
	   var thumbId = "thumb" + idx;
	   this.id = largeId;
	   $(this).slick({
			autoplay: false,
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: false
	   });
	});



	rePositionDatePicker();
	rePositionSliderNav();
	mobileAccordion();
	recalculateAbsoluteHeight();
});

$(window).load(function() {
	rePositionDatePicker();
	rePositionSliderNav();
	recalculateAbsoluteHeight();
});
$(window).resize(function() {
	rePositionDatePicker();
	rePositionSliderNav();
});



function rePositionDatePicker(){
	var viewportWidth = $(window).width();
	var viewportHeight = $(window).height();

	//To move the datepicker position to more left side in smaller screen
	// if(viewportWidth < 425){
		$('body').find('.departing-tab .ui-datepicker').css('margin-left', '-80px');
	// }
}

function rePositionSliderNav(){
	// var parentBannerWidth  = $('.theme-default .nivoSlider').width();

	// var viewportWidth = $(window).width();
	// var viewportHeight = $(window).height();
	
	// if(parentBannerWidth > viewportWidth){
	// 	$('body').find('.theme-default a.nivo-nextNav').css('right', 100 - (viewportWidth / parentBannerWidth * 100) + "%" );
	// }else{
	// 	$('body').find('.theme-default a.nivo-nextNav').css('right', '0px');
	// }
}

//Location mobile accordion
function mobileAccordion(){
	var allPanels = $('.accordion > dd').hide();
	$('.accordion > dt > a').click(function () {
		// allPanels.slideUp();
		$(this).parent().next().slideToggle();
		return false;
	});
}

//Location google Map

var locationMap;
var mapIcon = "public/themes/images/map-marker_new.png";
function initializeMap(){
	try {
		var latlng = new google.maps.LatLng(1.312016,103.860728);
		var latlngBounds = new google.maps.LatLngBounds();

		var myOptions = {
			zoom: 19,
			center: latlng,
			scrollWheelZoom:'center',
			mapTypeControl: false,
			zoomControl:true,
			draggable:true,
			scrollwheel: false,
			disableDefaultUI: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		locationMap = new google.maps.Map(document.getElementById("location-map"), myOptions);

		var image3 = {
					url: mapIcon,
					size: new google.maps.Size(171, 127)
					// origin: new google.maps.Point(0, 0),
					// anchor: new google.maps.Point(23, 47)
				};

		// marker
		var mapPnt = new google.maps.LatLng(1.312016,103.860728);
		var mapMarker = new google.maps.Marker({
			position: mapPnt,
			map: locationMap,
			icon: image3,
			scrollWheelZoom:'center' 
		});
	}
	catch (e) {  }
}


$(window).load(function() {
	initializeMap();
});




function isTabletMode(){
	var windowWidth = window.innerWidth;
	return (windowWidth <= 1066);
}

function isMobileMode(){
	return ($('#menu .span').css('display') == 'block');
}


function submitBooking(){
	//var hotelname = document.getElementById("HotelList").value;
	var hotelLink="https://www.book-secure.com/index.php?s=results&property=";
	
	var arrival = document.getElementById("arrival_date").value;
	var departure = document.getElementById("departure_date").value;
	//var adults = $("input[name='adults[]']").val();
	//var rooms = $("input[name='rooms']").val();
	//var AccessCode = $("input[name='offer_code']").val();

	/*if(AccessCode == 'Optional'){
		ofcode='';
	}else{
		ofcode='&offer_code='+AccessCode;
	}*/

	// window.location=hotelLink+"?rooms="+rooms+"&adults="+adults+"&arrival_date="+arrival+"&departure_date="+departure + ofcode;
	var submission_link = hotelLink+"?arrival="+arrival+"&departure="+departure+"&rooms=1&locale=en_GB&adults1=1&children1=0";
	window.open(submission_link,'_blank');
}

//Slide Weather forecast each 5 seconds

	
function recalculateAbsoluteHeight(){
	//To check if the description of room/offers height is shorter than image height, will follow the image height
	//Because image height is absolute so need to manual add JS
	if($(window).width()>600){
		$('.col-full-room').each(function(i, obj) {

			var content = $(this).find('.room-inner');
			var cimage = $(this).find('.room-content img');
			var cimage_top = parseInt($(this).find('.room-content .inner').css('top'));
			// alert(content.height() + ' < ' + cimage.height())
			if(content.height() < cimage.height()){
				content.height(cimage.height() + cimage_top);
			}

		});
	}
}

//$('#show_date').text(date_now);

//$("#show_date").text(date_now);

