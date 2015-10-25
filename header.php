	<nav>
		<?php $this->includeSnippet('menubar'); ?>
   		
	</nav>
    
	<?php $next_day = date("Y-m-d",strtotime("+1 days ")); ?>
	<input type=hidden id="arrival_date" name="arrival_date" class="checkInDate" value="<?php echo date('Y-m-d') ?>" autocomplete="off">
	<input type=hidden id="departure_date" name="departure_date" class="checkOutDate" value="<?php echo $next_day ?>" autocomplete="off">
	<input type=hidden name="rooms" value="1">
	<input type=hidden name="adults[]" value="1">
	<input type=hidden name="children[]" value="0">
	<input type=hidden name="offer_code" value="Optional">

	