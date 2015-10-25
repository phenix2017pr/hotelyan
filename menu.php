<?php

function snippet_menubar($page_submenu){

    $out = ''; 
    $count = count($page_submenu->children(array()));
   
    if ($count>0 && $page_submenu->id!=1){
      //$out .= '<ul>';             
    }

    foreach ($page_submenu->children(array()) as $menuPage){
      //if($menuPage->location=='top'){
      if($menuPage->location=='top' && $menuPage->level() == 1){
          
          if($menuPage->type=="link"){
             $out .= '<img class="menu_dot" src="'.THEME_PATH.'css/images/middot.png" /><li '.(url_match($menuPage->slug) ? ' class="active"': '').'>'.$menuPage->extlink($menuPage->title, ($menuPage->newwindow==1? ' target="_new"' : ''),$menuPage->external_url).snippet_menubar($menuPage).'</li>';           
          } else {
              $out .= '<img class="menu_dot" src="'.THEME_PATH.'css/images/middot.png" /><li '.(url_match($menuPage->slug) ? ' class="active"': '').'>'.$menuPage->link($menuPage->title, ($menuPage->newwindow==1? ' target="_new"' : '')).snippet_menubar($menuPage).'</li>';
          }   
      }

    } 

    if ($count>0 && $page_submenu->id!=1){
      //$out .= '</ul>';             
    } 
	
    return $out;
}
?> 
  
  <div class="wrap-nav">

	
    
    <!--<div id="booking-click">
    	<a href="javascript:void(0);"><img src="<?php echo THEME_PATH ?>images/book-dash-hotel.png" /></a>
    </div>-->
		
	<?php $this->includeSnippet('mobile-menu') ?>

      <div class="menu">
        <ul class="srt-menu">
  	    <li <?php echo ($this->id== 1 ? ' class="active"': '') ?>><a href="<?php echo URL_PUBLIC ?>">HOME</a></li>
        <?php 
            echo snippet_menubar($this->find('/'));
        ?>
        <!--<li id="hotel-list">
        	<?php $this->includeSnippet('hotel-list') ?>
       
        	</li>-->
        </ul>
      </div>
      <div class="social_menu">
           <a href="https://www.facebook.com/Hotel-YAN-Singapore-1653956471486268/" target="_blank" title="Facebook"><img class="fb-img" src="<?php echo THEME_PATH ?>images/icons/fb-logo.png" /></a>
           <a href="https://instagram.com/hotelyan/" target="_blank" title="Instagram"><img src="<?php echo THEME_PATH ?>images/icons/instagram-icon.png" class="twitter-img"/></a>
           <a href="http://www.tripadvisor.com.sg/Hotel_Review-g294265-d8637722-Reviews-Hotel_Yan-Singapore.html" target="_blank" title="Trip Advisor"><img class="trip-img" src="<?php echo THEME_PATH ?>images/icons/trip-logo.png" /></a>
      </div>
      <!-- Mobile Menu Start-->
        <?php //$this->includeSnippet('mobile-menu');?>
      <!-- Mobile Menu End-->
      
    </div>
    <div id="booking-wrapper">
        <div id="booking-close">
            <img src="public/themes/css/images/booking-close-bg.png"/>
            <div class="span">BOOK DIRECT</div>
        </div>
        <div id="booking-form">
          <?php $this->includeSnippet('booking-form'); ?>
        </div>

      </div>