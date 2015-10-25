
  <div class="homepage">
      <div class="home-slider-wrap">
          <div class="home-slider">
              <?php
              $oBanner = new Banner();
              $oOffer = new Offer();
              $offerAll=$oOffer->findAllFrom("Offer","1=1 order by sequence");
              $bannerLeft=$oBanner->findAllFrom("Banner","type='home' AND location='leftslide' AND status=1");
              $idx = 1;
               if($oBanner->countFrom('Banner',"1=1") > 0){
            ?>
              <div class="room-slide">
                 <?php foreach($bannerLeft as $banner){ ?>
                  <div><img src="<?php echo URL_PUBLIC ?>public/banner/<?php echo $banner->filename?>"></div>
                  <!--<div class="room-slide-div">-->
<!--                   <a class="room-slide-a" id="room_a_<?php echo $idx;?>" href="javascript:void(0);">
                    <img src="<?php echo URL_PUBLIC ?>public/banner/<?php echo $banner->filename ?>"
                    data-title=""
                    data-description=""
                    data-big="<?php echo URL_PUBLIC ?>public/banner/<?php echo $banner->filename?>"
                    /> 
                  </a> -->
                  <!--</div>-->
                   <?php $idx++;
           }?>
               
          
            <?php
        }
            ?> 
              </div>
     <!--            <img id="room-next"  src="<?php echo URL_PUBLIC ?>public/themes/css/images/next-arrow.png" />
                <img id="room-prev"  src="<?php echo URL_PUBLIC ?>public/themes/css/images/prev-arrow.png" /> -->

          </div>
      </div>
     
       <div class="home-slider-right">
          <div class="home-content-main laptop-only">
            <?php         
              
              $bannerAbout=$oBanner->findAllFrom("Banner","type='home' AND location='aboutus' AND status=1");
              $idx = 1;
               if($oBanner->countFrom('Banner',"1=1") > 0){
                    foreach($bannerAbout as $banner){
              ?>
              <img class="bg-img" src="<?php echo URL_PUBLIC ?>public/banner/<?php echo $banner->filename;?>" width=100% height=100% />
              <?php } }?>
              <img class="logo-img" src="<?php echo URL_PUBLIC ?>public/themes/images/logo-white.png" />
              <div class="home-main-content">
                  <div class="home-main-inner">
                      
                        <?php if($this->content('body')!=""){ 
                            echo $this->content('body');
                     } ?>
                  </div>
                  <?php echo $this->content('readmore-link'); ?>
              </div>
          </div>

           <div class="home-block" id="home-studio">
              <div style="height:100%;">
              <?php 
                $count=1;
                foreach($offerAll as $offer){ ?>
                <div class="offer-desc-block" id="desc_<?php echo $count;?>">
                <img class="desc_img" src="<?php echo URL_PUBLIC ?>public/offer/images/<?php echo $offer->filename;?>"  />
                  <div class="offer-desc-inner">
                  <div class="desc-title"><span><?php echo $offer->name;?></span></div>
                    <div class="description-full">
                      <div class="inner">
                        <?php echo $offer->description_home;?>
                    </div>
                   </div>
                    
                    <a href="<?php echo URL_PUBLIC ?>offers#<?php echo $count;?>" target="_blank" title="Read More">
                      <div class="desc-book-now">
                      READ MORE
                      </div>
                    </a> 
                    
                  </div> 
                </div>
              <?php $count++;} ?>
            </div>
               <img id="offer-next"  src="<?php echo URL_PUBLIC ?>public/themes/css/images/next-arrow.png" />
               <img id="offer-prev"  src="<?php echo URL_PUBLIC ?>public/themes/css/images/prev-arrow.png" />
            </div>
            
            <div class="home-content-main mobile-only">

            <?php         
              $oBanner = new Banner();
              $bannerAbout=$oBanner->findAllFrom("Banner","type='home' AND location='aboutus' AND status=1");
              $idx = 1;
               if($oBanner->countFrom('Banner',"1=1") > 0){
                    foreach($bannerAbout as $banner){
              ?>
              <img class="bg-img" src="<?php echo URL_PUBLIC ?>public/banner/<?php echo $banner->filename;?>" width=100% height=100% />
              <?php } }?>
              <img class="logo-img" src="<?php echo URL_PUBLIC ?>public/themes/images/logo-white.png" />
              <div class="home-main-content">
                  <div class="home-main-inner">
                      
                        <?php if($this->content('body')!=""){ 
                            echo $this->content('body');
                     } ?>
                  </div>
                  <?php echo $this->content('readmore-link'); ?>
              </div>
          </div>   
          

      </div>
      <div class="clear">&nbsp;</div>
	</div>
  <div class="col-full">
	   <div class="full-block" id="home-dining-wrap">
        
        <?php if(strlen($this->content("bottom-title"))>0){ ?><div class="dining-title"><h2><?php echo $this->content("bottom-title") ?></h2></div><?php } ?>
        <div class="dining-left">
            <div class="inner">
                <div class="content">
                  <?php echo $this->content('dining-desc');?>
                </div>
                <div class='read-more'>
                  <?php echo $this->content("bottom-readmore") ?>
                </div>
            </div>
        </div>
        <div class="dining-right">
            <div class="inner">
              <div class="dining-slide">
              <?php
              $bannerDining=$oBanner->findAllFrom("Banner","type='home' AND location='dining' AND status=1");
                  if($oBanner->countFrom('Banner',"1=1") > 0){
                    foreach($bannerDining as $banner){
              ?>
                <div><img class="dining-img" src="<?php echo URL_PUBLIC ?>public/banner/<?php echo $banner->filename;?>"/></div>
            <?php }} ?>
              </div>
            </div>
        </div>
         <div style="clear:both">&nbsp;</div>
  </div>
</div>