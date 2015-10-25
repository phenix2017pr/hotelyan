<?php

/**
 * Frog CMS - Content Management Simplified. <http://www.madebyfrog.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 * Copyright (C) 2008 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Frog CMS.
 *
 * Frog CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Frog CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Frog CMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Frog CMS has made an exception to the GNU General Public License for plugins.
 * See exception.txt for details and the full text.
 */

/**
 * The FileManager allows users to upload and manipulate files.
 *
 * @package frog
 * @subpackage plugin.file_manager
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @version 1.0.0
 * @since Frog version 0.9.0
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Philippe Archambault & Martijn van der Kleijn, 2008
 */

  $out = '';
  $progres_path = '';
  $paths = explode('/', $banner->filename); 
  $nb_path = count($paths);
  foreach ($paths as $i => $path) {
    if ($i+1 == $nb_path) {
      $out .= $path;
    } else {
      $progres_path .= $path.'/';
      $out .= '<a href="'.get_url('banner/browse/'.rtrim($progres_path, '/')).'">'.$path.'</a>/';
    }
  }
 
  $banner->type=($banner->type==''?'inner':$banner->type);
?>
<!-- ckeditor -->  
<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/ckeditor_custom_config.js"></script>
<input type="hidden" value="ckeditor" class="filter-selector" name="ckeditor_trigger">
<!-- End ckeditor -->


<h1><?php echo __('Edit Banner'); ?></h1>

<form method="post" action="<?php echo get_url('banner/edit/'.$banner->id); ?>" enctype="multipart/form-data">
	<h3><?php echo __('Title'); ?></h3>
	<div id="meta-pages" class="pages">
	    <input class="textbox" id="banner_name" name="banner[name]" size="50" type="text" value="<?php echo $banner->name ?>" />
    </div>
    
	<h3><?php echo __('External URL'); ?></h3>
	<div id="meta-pages" class="pages">
	    <input class="textbox" id="external_url" name="banner[external_url]" size="100" type="text" value="<?php echo $banner->external_url ?>" />
    </div>   
  
   <!-- <h3><?php echo __('Description'); ?></h3>
	<div id="meta-pages" class="">
	    <!-- <textarea id="caption" name="banner[caption]" type="text" style="height:60px;width:622px" ><?php //echo $banner->caption ?></textarea> -->
	    <!--<textarea id="caption" name="banner[caption]" class="textarea markitup ckeditor"><?php //echo $banner->caption ?></textarea>
    </div><br>-->
   
	<h3><?php echo __('Banner Type'); ?></h3>
	<div id="meta-pages" class="pages">
 		<input class="textbox" id="home" value='home' name="banner[type]" type="radio" <?php echo ($banner->type=='home'?'checked':'') ?> onclick="changeB(this.value)" /> Home Page &nbsp; 
	    <input class="textbox" id="inner" value='inner' name="banner[type]" type="radio" <?php echo ($banner->type=='inner'?'checked':'') ?> onclick="changeB(this.value)" /> Inner Page
		<!--<input class="textbox" id="fnb" value='fnb' name="banner[type]" type="radio" <?php echo ($banner->type=='fnb'?'checked':'') ?> onclick="changeB(this.value)" /> F&B Banner
		<input class="textbox" id="fnb-menu" value='fnb-menu' name="banner[type]" type="radio" <?php echo ($banner->type=='fnb-menu'?'checked':'') ?> onclick="changeB(this.value)" /> F&B Menu-->
    </div> 
     
    <div id="inner-page">
	    <h3><?php echo __('Assign to Page'); ?></h3>	  
		<div id="meta-pages" class="">
		    <select id="page_id" name="banner[page_id]">
		    <option value=""></option>
			<?php
			  foreach($pages as $page){
				$page_selected = ($page->id==$banner->page_id?"selected":"");
				
				if($page->id!=1){
					if($page->hasChildren($page->id)){
						echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
						$subpages = $page->childrenOf($page->id);
						foreach($subpages as $subpage){
							$subpage_selected = ($subpage->id==$banner->page_id?"selected":"");
							
							echo "<option value='".$subpage->id."' ".$subpage_selected."> - - - - - ".$subpage->title."</option>";
						}		
					}else{
						echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
					}
			 	}else{
				 	echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
			 	}
			  }
			?>
		    </select> 
	    </div>
    </div> 
        
    <div id="home-loc">
	    <h3><?php echo __('Assign to Location'); ?></h3>	  
		<div id="meta-pages" class="">
		    <select id="location" name="banner[location]">
		    	<option value="background" <?php echo ($banner->location=="background"?"selected":"") ?>>Background</option>
				<option value="leftslide" <?php echo ($banner->location=="leftslide"?"selected":"") ?>>Left Slider</option>
				<option value="aboutus" <?php echo ($banner->location=="aboutus"?"selected":"") ?>>Home AboutUS</option>
				<option value="dining" <?php echo ($banner->location=="dining"?"selected":"") ?>>Home Dining</option>
		    </select> 
	    </div>
    </div> 

            
    
    <h3><?php echo __('Status'); ?></h3>	   
	<div id="meta-pages" class="">
	    <select id="status" name="banner[status]">
	    	<option value="1" <?php echo ($banner->status=="1"?"selected":"") ?>>Show</option>
	        <option value="0" <?php echo ($banner->status=="0"?"selected":"") ?>>Hidden</option>
	    </select>
    </div>  
     
	<h3><?php echo __('Order'); ?></h3>
	<div id="meta-pages" class="pages">
	    <input class="textbox" id="sequence" name="banner[sequence]" size="5" type="text" value="<?php echo $banner->sequence ?>" />
    </div>   
    
    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />
        <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
        <?php echo __('or'); ?> <a href="<?php echo get_url('banner'); ?>"><?php echo __('Cancel'); ?></a>
    </p>
    
    <br />
    <div id="meta-pages" class="">
    <?php echo __('Select Image'); ?><br>
        <input id="upload_path" name="upload[path]" type="hidden" value="" />
        <input id="upload_file" name="upload_file" type="file" />
    </div>
    <h5> <?php echo ($banner->filename!=''?'public/banner/'.$out:''); ?> &nbsp;&nbsp; 
    <font size=1><?php echo ($banner->filename!=''?'<a href="javascript:void(0)" onclick="validate()">Remove</a>':''); ?></font></h5>
    <?php echo ($banner->filename!=''?'<img src="'.BASE_FILES_DIR.'/banner/'.$banner->filename.'" width=500 />':''); ?>          

</form>
<script type="text/javascript">
	function validate(){
		if(confirm('Are you sure want to remove this image?')){	
			window.location="<?php echo get_url('banner/delete_image/'.$banner->id); ?>";	
		}
	}  
	
	function changeB(v){
		if(v=="inner"){
			document.getElementById('inner-page').style.display='';
			document.getElementById('home-loc').style.display='none';	
			
		}
		else if(v=="home"){
			document.getElementById('inner-page').style.display='none';
			document.getElementById('home-loc').style.display='';			
		}
		else{
			document.getElementById('inner-page').style.display='none';
			document.getElementById('home-loc').style.display='none';			
		}
	}
	
	changeB('<?php echo $banner->type ?>');

</script>
	


