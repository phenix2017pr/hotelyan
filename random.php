<?php
  $oRoom = new Room();
  $rooms = $oRoom->findAllFrom("Room","1=1 order by sequence");
  
  $idx = 0;

?>
      <div class="col-left">
          <div id="side-menu">
<?php
    foreach($rooms as $room){
            $roomPgURL = ($room->pageid > 0 ? Page::urlById((int)$room->pageid) : '');
            $active_cls = $this->id() == $room->pageid ? 'active' : '';
?>
            <div><a href="<?php echo $roomPgURL ?>" class="<?php echo $active_cls ?>"><?php echo $room->name ?></a></div>
<?php 
    } 
?>
          </div>

          <div id="side-dropdown-menu">
            <select onchange="location.href=this.value">
              <option value="rooms.php">Select Rooms</option>
<?php
    foreach($rooms as $room){
               $roomPgURL = ($room->pageid > 0 ? Page::urlById((int)$room->pageid) : '');
               $selected = $this->id() == $room->pageid ? 'selected' : '';
?>
              <option value="<?php echo $roomPgURL ?>" <?php echo $selected ?>><?php echo $room->name ?></option>
<?php 
    } 
?>
            </select>
          </div>

        </div> <!-- col-left -->


        <div class="col-right">

          <?php
            //This is room list page
            if($this->level() == 1){
          ?>

          <!-- rooms list -->
          <div id="rooms-list">
            <div class="rooms-inner">
<?php
    foreach($rooms as $room){
            $roomPgURL = ($room->pageid > 0 ? Page::urlById((int)$room->pageid) : '');
            $idx++;
            $nomargin = $idx%2 == 0 ? 'nomargin' : '';
            switch($idx){
              case 1: $title_color  = 'blue'; break;
              case 2: $title_color  = 'orange'; break;
              case 3: $title_color  = 'pink'; break;
              case 4: $title_color  = 'green'; break;
            }

?>
            <article class="<?php echo $nomargin ?>"> 
              <a href="<?php echo $roomPgURL ?>"><img src="<?php echo URL_PUBLIC ?>public/room/images/<?php echo $room->filename ?>" alt=""></a>
              <div class="btn-list">
                <div class="popular-btn"><?php echo $room->url_name ?></div>
                <div class="booking-btn"><a href="<?php echo $room->url ?>">BOOK NOW</a></div>
              </div>
              <div class="title-<?php echo $title_color ?>"><?php echo $room->name ?></div>
            </article>

<?php
            if($idx>3){
                $idx=0; //reset counter for 4 colors
            }
    }
?>

            </div>
          </div>
          <!-- rooms list -->

          <div class="clear">&nbsp;</div>

          <?php $this->includeSnippet('general-room-features'); ?>


<?php   
        //This is room detail
        }else{

          $room = Room::getRoomByPageId($this->id);
          $oRoomImage = new RoomImage();
          $roomgalleries = $oRoomImage->findByRoomId($room->id);
?>
          <!-- room detail -->
          <div id="room-detail">
            
              <div class="gallery-col">
                <div class="slider room-slider">
                  <?php
                    if(count($roomgalleries) > 0){
                      foreach($roomgalleries as $gallery){
                        echo '<div><img src="'.URL_PUBLIC.'public/room/gallery/'.$gallery->filename.'" width=522 height=261 /></div>'; 
                      }
                    }else{
                        echo '<div><img src="'.URL_PUBLIC.'public/room/images/'.$room->filename.'" width=522 height=261 /></div>'; 
                    }
                  ?>
                </div>
              </div>

              <div class="desc-col">
                <h3><?php echo $room->name ?></h3>
                <div class="desc">
                  <?php echo $room->description ?> 
                </div>
                <?php if(strlen($room->url)>0){ ?><div class="book-now"><a href="<?php echo $room->url ?>"><img src="<?php echo THEME_PATH ?>images/room-book-now.png" /></a></div><?php } ?>
              </div>
            
          </div>
          <!-- room detail -->

          <div class="clear">&nbsp;</div>
          
          <?php $this->includeSnippet('room-features'); ?>

<?php
        }
?>

        </div> <!-- col-right -->