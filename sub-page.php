<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->

<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->

<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->

<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<head>

<?php $this->includeSnippet('meta-tag'); ?>

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

		<div class="sub-wrap">

			<div class="inner">

				<div class="sub-title"><h2><?php echo $this->title() ?></h2></div>

				<div class="page-content">

					<!-- CMS Content BOF -->

					<?php echo $this->content() ?>

					<!-- CMS Content EOF -->

					<div style="clear:both">&nbsp;</div>



            		<?php



                       	foreach($this->part as $p){ 

                           		if ($p->name <> 'body') {

                               		echo $this->part_content($p);

                           		}

                      	 }



            		?>

			</div>

				</div>

			</div>
			
			<div class="sub-wrap-bottom"></div>
			
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