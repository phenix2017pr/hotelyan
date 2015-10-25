<?php

    $oRoom = new Room();
    $oRoomImage = new RoomImage();
    $roomAll=$oRoom->findAllFrom("Room","1=1 order by sequence");

    $idx = 1;
    $index=90;
    $count=1;
    $title=1;

    if($oRoom->countFrom('Room',"1=1") > 0){

        foreach($roomAll as $room){

            $roomgalleries = $oRoomImage->findByRoomId($room->id);

            $index--;

            if($title==1){
                $title_m='first-content';
            }else{
                $title_m='';
            }
?>

            <div class="col-full-room <?php echo $title_m;?> col<?php echo $idx;?>" id="" style="background-size:100% 100%;z-index:<?php echo $index;?>;">
                <?php if($title==1){?>
                	<div class="top-title"><h2>ROOMS</h2></div>
                <?php }?>
                <div class="room-content" id="room-content-0<?php echo $idx;?>">   
          			<div class="inner room-slick slider">	        			
                        <div><img src="<?php echo URL_PUBLIC;?>public/room/images/<?php echo $room->filename;?>"/></div>
                    <?php foreach($roomgalleries as $gallery){ ?>
                        <div><img src="<?php echo URL_PUBLIC;?>public/room/gallery/<?php echo $gallery->filename;?>"/></div>
                    <?php } ?>     
          			</div>
          		</div>
          		<div class="room-inner" id="room-inner-0<?php echo $idx;?>">   
          			<div class="inner-1">
           				<div class="title"><h3><?php echo $room->name;?></h3></div>
          				<div class="desc">
                            <div class="inner">
                              <?php echo $room->description;?>
                            </div>
                        </div>
          				<?php if($room->url!='') {?>
                        <div class="booknow">
                            <a href="<?php echo $room->url ?>" target="_blank" title="Book Now"><div class="room-book-now"><span>BOOK NOW</span></div></a>
                        </div>
          				<?php }?>
          			</div>
          		</div>  
            </div>
            <div class="col-full-room-bottom col<?php echo $idx;?>"></div>

            <div class="clear">&nbsp;</div> 
<?php
            $idx++;	
            $title=0;

            if($idx>2){
                $idx=1;	
            }

        }

    }
?>                        
            <div class="clear">&nbsp;</div>