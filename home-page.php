<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->

<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

<?php $this->includeSnippet('meta-tag'); ?>



<!--Galleria banner-->

<!--<script src="<?php echo THEME_PATH ?>js/galleria/galleria-1.4.2.js"></script>

<script src="<?php echo THEME_PATH ?>js/galleria/themes/classic/galleria.classic.js"></script>

<link rel="stylesheet" href="<?php echo THEME_PATH ?>js/galleria/themes/classic/galleria.classic.css">-->

</head>

<body>

<div id="home">





<div id="header-bg">

  <div id="body-bg">	

	 <?php $this->includeSnippet('header') ?>



  </div> <!-- #header-bg -->



  <!--Top Banner-->

  <div id="banner-bg">

      <?php $this->includeSnippet('logo_form') ?>

      <div id="slider-banner" >



        <?php $this->includeSnippet('main-banner') ?>

      </div>

  </div>



</div>

<div style="clear:both"></div>

<!-- Check-in Check-out date -->

<?php //$this->includeSnippet('hidden-datefield') ?>

<!-- Check-in Check-out date -->



<!-- mobile booking form -->

<?php //$this->includeSnippet('mobile-booking') ?>

<!-- mobile booking form -->



<!--Content-->



<div id="content">



		<?php 		echo $this->content('home-list');		?>

		
    <div class="sub-wrap-bottom"></div>
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