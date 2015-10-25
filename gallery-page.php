<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<?php $this->includeSnippet('meta-tag'); ?>

<style>
html, body {width:100%; padding:0; margin:0; overflow:hidden; }
#gallery{
	width:100%;
	/*max-width:1400px;*/
	margin: auto;
	height:100%;	
	position:relative;
}
#gallery #slider-banner{ 
	background:none;
} 
#gallery footer{ 
	position: fixed;
	bottom:0px;
	margin-top:0px;
	height:20px !important;
	z-index:11111 !important;
}
#gallery .footer-menu {
	bottom:5px;
}
</style>
</head>

<body>
<div id="gallery">

	<div id="body-bg">
		<?php $this->includeSnippet('header') ?>
	</div>

	<div id="banner-bg">
		<?php $this->includeSnippet('logo_form') ?>

		<div id="slider-banner" >
			<?php //$this->includeSnippet('inner-banner') ?>
			<?php $this->includeSnippet('gallery') ?>
		</div>
	</div> 

	<!--Content-->
	<div id="content">			
		<div class="col-full">
			<div class="">
				<div class="inner">
<!-- 					<div class="sub-title"><h2><?php echo $this->title() ?></h2></div>
					<div class="page-content">

						<?php echo $this->content() ?>
				
						<div style="clear:both">&nbsp;</div>

	            		<?php
	                       	foreach($this->part as $p){ 
	                           		if ($p->name <> 'body') {
	                               		echo $this->part_content($p);
	                           		}
	                      	 }
	            		?>
					</div> -->
				</div>
			</div>
				
			<div class="gallery-wrap-bottom"></div>

			<div style="clear:both">&nbsp;</div>

		</div>

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