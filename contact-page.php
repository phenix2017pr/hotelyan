<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<?php $this->includeSnippet('meta-tag'); ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&language=en"></script>
<style>
	#booking-form{
		display:none;
	}
</style>

</head>
<body>
<div id="home">
	<div id="header-bg">
		<div id="body-bg">
			
			<?php $this->includeSnippet('header') ?>
		</div>
		
	</div> <!-- #body-bg -->

	<div id="banner-bg" >
		<?php $this->includeSnippet('logo_form') ?>
				<div id="slider-banner" class="map-slider">
					<div class="slider-wrapper theme-default">

			      	<div id="map-wrapper">
			        	<div id="location-map">&nbsp;</div>
			      	</div>

			    	</div>
				</div>
	</div>
<!--Content-->
<div class="contact-bg" id="content">
		<div class="col-full">

		<div class="sub-wrap">

			<div class="inner">

				<div class="row block02">
					<div class="page-title"><h2><?php echo $this->title() ?></h2></div>
					<div class="contact-list">
						<!-- CMS Content BOF -->
						<div class="inner">
	                        <?php echo $this->content('address'); ?>
						 </div>
					</div>
					<div class="contact-form">
						<div class="inner">
	           				 <?php echo $this->content('contact'); ?>
	           			</div>	 
	          		</div>
				</div>
				
			</div>
		</div>

		<div class="sub-wrap-bottom"></div>

		<div class="clear">&nbsp;</div>
	
		</div>
		
		<div style="clear:both">&nbsp;</div>
</div>

<!--Footer-->
<footer>
<?php $this->includeSnippet('footer') ?>
</footer>

<?php $this->includeSnippet('nivo-slider'); ?>
<script src="<?php echo THEME_PATH ?>js/main.js"></script>
</div>
</body>
</html>