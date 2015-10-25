<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->

<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

<?php $this->includeSnippet('meta-tag'); ?>





<!--fancybox-->

<!--

<link rel="stylesheet" href="<?php echo THEME_PATH ?>js/fancybox/jquery.fancybox-2.1.5.css">

<script src="<?php echo THEME_PATH ?>js/fancybox/jquery.fancybox-2.1.5.pack.js"></script>

<script src="<?php echo THEME_PATH ?>js/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>

-->



<!--[if lte IE 9]>

      <link href='<?php echo THEME_PATH ?>js/animate-it-master/css/animations-ie-fix.css' rel='stylesheet'>

<![endif]-->



</head>

<body>

<div id="home">

<div id="body-bg">

  

  <?php $this->includeSnippet('header') ?>

</div>

<div id="banner-bg">

  <?php $this->includeSnippet('logo_form') ?>

  <div id="slider-banner" >

    <?php $this->includeSnippet('inner-banner') ?>

  </div>



</div> <!-- #body-bg -->





<!--Content-->

<div id="content">   

    <div class="col-full">

        <?php echo $this->content('fnb-content');?>
        
    </div>    
    
    <div style="clear:both">&nbsp;</div>

</div>



<!--Footer-->

<footer>

<?php $this->includeSnippet('footer') ?>

</footer>



<script src="<?php echo THEME_PATH ?>js/main.js"></script>

<?php $this->includeSnippet('nivo-slider'); ?>

</div>

</body>

</html>