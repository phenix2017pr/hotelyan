<?php
    $oOffer = new Offer();
    $oOfferImage = new OfferImage();
    $offerAll=$oOffer->findAllFrom("Offer","1=1 order by sequence");
    $idx = 1;
    $index=90;
    $count=1;
    $title=1;
		  if($oOffer->countFrom('Offer',"1=1") > 0){

		  	foreach($offerAll as $offer){
				 $offergalleries = $oOfferImage->findByOfferId($offer->id);
				 $index--;
				 if($title==1){
				 	  $title_m='first-content';
				 }
				 else{
				 	$title_m='';
				 }
?>

<div class="col-full-room <?php echo $title_m;?> col<?php echo $idx;?> " id="" style="background-size:100% 100%;z-index:<?php echo $index;?>;">
        <?php if($title==1){?>
        	<div class="top-title"><h2>OFFERS</h2></div>
        <?php }?>
        <a id="offer-href<?php echo $count;?>" >&nbsp;</a>
        <div class="room-content" id="room-content-0<?php echo $idx;?>">   
  			<div class="inner offer-slick slider">	
  				
					<div><img src="<?php echo URL_PUBLIC;?>public/offer/images/<?php echo $offer->filename;?>"/></div>
					<?php 
					foreach($offergalleries as $gallery){
						?>
					<div><img src="<?php echo URL_PUBLIC;?>public/offer/gallery/<?php echo $gallery->filename;?>"/></div>
	        <?php
						  }
	         ?>     
  				
  			</div>
  		</div>
  		<div class="room-inner" id="room-inner-0<?php echo $idx;?>">   
  			<div class="inner-1">
   				<div class="title"><h3><?php echo $offer->name;?></h3></div>
  				<div class="desc"><div class="inner">
  					<?php echo $offer->description;?>

  				</div></div>
  				<?php if($offer->url!='') {?>
  				<div class="booknow">
  					 
               		 <a href="<?php echo $offer->url ?>" target="_blank" title="Book Now"><div class="room-book-now" 
                   
                     ><span>BOOK NOW</span></div></a>
						</div>
  				<?php }?>
  			</div>
  		</div>
</div>
<div class="col-full-room-bottom col<?php echo $idx;?>"></div>

<div class="clear">&nbsp;</div> 
 <?php
				$idx++;	
        $count++;
				$title=0;
				if($idx>2){
					$idx=1;	
				}
				}
		  	}
		
		?>            
            
            
             

			<div class="clear">&nbsp;</div>
