 <?php 

                   $oFnb = new Fnb();

                   $fnbs = $oFnb->findAllFrom("Fnb","1=1 order by sequence");

                					 

?>



 <?php 

                    $oFnbGallery = new FnbGallery();

	    $fnbgalleryAll=$oFnbGallery->findAllFrom("FnbGallery","1=1 order by sequence");

	    //1st Room 

	  

	    //8th Room



	    $idx = 1;

                					 

?>



<div class="fnb-wrap">

	<div class="inner">

		<div class="fnb-title"><h2>BISTRO &amp; BAR</h2></div>

		<div class="clear">&nbsp;</div>

		<div class="fnb-left">

			<div class="fnb-slide">

				<?php if($oFnbGallery->countFrom('FnbGallery',"1=1") > 0){

			

		  			foreach($fnbgalleryAll as $fnbgallery){ ?>

					<div><img class="fnb-img" src="<?php echo URL_PUBLIC ?>public/fnb/gallery/<?php echo $fnbgallery->album_id;?>/<?php echo $fnbgallery->filename;?>"/></div>

				<?php $idx++;}

				} ?>

			</div>

			<div class="clear">&nbsp;</div>

			<div class="fnb-detail">

				<?php echo $this->content('detail-list');?>

			</div>

		</div>

		<div class="fnb-right">

			<div class="content">

				<?php echo $this->content('body');?>

				<?php   if(count($fnbs)>0){ foreach($fnbs as $fnb){?>

				<div class="booknow">

  					 

               		 <a id="menu-<?php echo $fnb->pageid;?>" href="<?php echo URL_PUBLIC ?>public/fnb/files/<?php echo $fnb->filename;?>" target="_blank" title="<?php echo $fnb->quick_reference;?>" download><div class="room-book-now" 

                   

                     ><span><?php echo $fnb->name;?></span></div></a>

				</div>

				<?php }} ?>

			</div>

		</div>


	<div style="clear:both">&nbsp;</div>

	</div>

</div>

<div class="sub-wrap-bottom"></div>