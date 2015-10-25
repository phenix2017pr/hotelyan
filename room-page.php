<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<?php $this->includeSnippet('meta-tag'); ?>

<!--<script src="<?php echo THEME_PATH ?>js/galleria/galleria-1.4.2.js"></script>
<script src="<?php echo THEME_PATH ?>js/galleria/themes/classic/galleria.classic.js"></script>
<link rel="stylesheet" href="<?php echo THEME_PATH ?>js/galleria/themes/classic/galleria.classic.css">-->
<style>

</style>
</head>
<body>
<div id="home">

<div id="body-bg">
	
	<?php $this->includeSnippet('header') ?>
</div> <div id="banner-bg">
	<?php $this->includeSnippet('logo_form') ?>

</div> <!-- #body-bg -->
<div class="clear">&nbsp;</div> 

<!--Content-->
<div id="content room-section">
	<div class="wrap-content zerogrid">

		<div class="col-full" id="col-full-room-section">
			<?php

                                   	foreach($this->part as $p){ 
                                       		if ($p->name <> 'body') {
                                           		echo $this->part_content($p);
                                       		}
                                  	 }

            ?>
            
			
	
		</div>
		
		<div style="clear:both">&nbsp</div>
		
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