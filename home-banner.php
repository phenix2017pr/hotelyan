
<link rel="stylesheet" href="<?php echo THEME_PATH; ?>js/svgslider/svgslider.css">
<script src="<?php echo THEME_PATH; ?>js/svgslider/svgslider.js"></script>

  <div id="col-top">

    <div class="directionNav">
      <div class="prevNav"><a href="#">PREV</a></div>
      <div class="nextNav"><a href="#">NEXT</a></div>
    </div>

      <svg width="1295" height="633" id="svg" baseProfile="full" version="1.2">
          <defs>
              <mask id="svgmask1" class="svgmask" maskUnits="userSpaceOnUse" maskContentUnits="userSpaceOnUse" transform="scale(1)" >
                  <image width="100%" height="633" xlink:href="<?php echo THEME_PATH ?>images/bigbanner-shape.png"   />
              </mask>
          </defs>

          <?php
            $idx=0;
            $oBanner = new Banner();
            $banners = $oBanner->findAllFrom("Banner","type='home' AND location='background' AND status=1 order by sequence,id");
            foreach($banners as $banner){
               $idx++;
               echo '<image id="the-mask'.$idx.'" data-index="'.$idx.'" class="the-mask" mask="url(#svgmask1)" width="100%" height="633" y="0" x="0" xlink:href="'.URL_PUBLIC.'public/banner/'.$banner->filename.'" />';
            }       
          
          ?> 
      </svg>
  </div>

  <div id="bottom-mask"><img src="<?php echo THEME_PATH ?>images/bottom-mask.png"></div>

  <?php include('homepage-list.php') ?>

  </div>

<script>

  $(document).ready(function(){

    $('img.the-mask').svgslider({
      parentSlide : '#col-top svg',
      slides: 'image.the-mask'
    });
    
  });
</script>