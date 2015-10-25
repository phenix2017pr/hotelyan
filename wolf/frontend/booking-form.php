<div class="booking-body">
	
	<div class="booking-header"><h2>BOOK DIRECT</h2></div>

	<div class="">
		<div class="booking-tab date-tab arriving-tab">
			<span class="header">Arriving</span>
			<div class="booking-bg">
				<span class="in-month"><?php echo date("F"); ?></span>
				<span class="in-date"><?php echo date("j"); ?></span>
				<span class="arrow-down">&nbsp;</span>
			</div>
		</div>

		<div class="booking-tab date-tab departing-tab">
			<span class="header">Departing</span>
			<div class="booking-bg">
				<?php $next_day = date("Y-m-d",strtotime("+1 days ")); ?>
				<span class="out-month"><?php echo date("F",strtotime($next_day)); ?></span>
				<span class="out-date"><?php echo date("j",strtotime($next_day)); ?></span>
				<span class="arrow-down">&nbsp;</span>
			</div>
		</div>

		<!--<div class="booking-tab guests-tab">
			<span class="header">Nights</span>
			<div class="booking-bg">
				<span class="border-t">&nbsp;</span>
				<span class="nightStay">1</span>
			</div>
		</div>-->

		<div class="clear"></div>

	</div>


	<div class="booking-btn"><a href="javascript:" class="btn" onclick="submitBooking();">BOOK NOW</a>
    <!-- <a href="<?php echo URL_PUBLIC ?>best-rate-guarantee" class="best-rate"><span>BEST RATE</span><br/>GUARANTEE</a> -->
    </div>
	<!-- <div class="amend"><a href="<?php echo URL_PUBLIC ?>bookdirect">5 Reasons to Book Direct</a></div> -->

	<div class="clear"></div>
	 
</div>
<!--<div class="booking_close" id="booking_close" title="Close It">x</div>-->


