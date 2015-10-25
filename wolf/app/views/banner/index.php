<?php
/**
 * Frog CMS - Content Management Simplified. <http://www.madebyfrog.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
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
 * @package frog
 * @subpackage views
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @version 0.1
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Philippe Archambault, 2008
 */

?>

<h1><?php echo __('Banners'); ?></h1>
<br />
<form name="thisform" method="post" action="<?php echo get_url('banner/save_order') ?>">
<div align=right><input type=submit value="Save Order"></div>
<table id="files-list" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th class="files"><?php echo __('Banner Title'); ?></th>
      <th class="files" width=180><?php echo __('Image'); ?></th>  
      <th class="files"><?php echo __('Filename'); ?></th>
      <th class="size" width=150><?php echo __('Type'); ?></th>
      <th class="size" width=50><?php echo __('Order'); ?></th>
      <th class="modify" width=50><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach ($banners as $banner): ?>
<?php $page = Record::findByIdFrom('Page', $banner->page_id); ?>
<?php $type_detail = $banner->type=='home' ? $banner->location : $page->slug; ?>
<!--ws 2/10/2015 for non-object prroperty problem-->
    <tr class="<?php echo odd_even(); ?>">
      <td><?php echo $banner->name ?></td>
      <td><?php echo ($banner->filename!=''?'<img src="'.BASE_FILES_DIR.'/banner/'.$banner->filename.'" width=100 />':''); ?></td> 
      <td>
        <img src="<?php echo URL_PUBLIC ?>wolf/plugins/file_manager/images/page_16.png" align="top" alt="page icon" />
        <a href="<?php echo get_url('banner/view/'.$banner->id) ?>"><?php echo $banner->filename; ?></a>
      </td>
      <td><code><?php echo $banner->type; ?>/<?php echo $type_detail; ?></code></td>
      <td><input type=hidden name="banner_id[]" value="<?php echo $banner->id ?>"><input type="text" value="<?php echo $banner->sequence ?>" name="order[]" size=1></td>
      <td>
        <a href="<?php echo get_url('banner/view/'.$banner->id) ?>"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-edit.gif" alt="edit icon" /></a>&nbsp;<a href="<?php echo get_url('banner/delete_banner/'.$banner->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete'); ?> <?php echo $banner->name; ?>?');"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-remove.gif" alt="remove icon" /></a>
      </td>
    </tr>
<?php endforeach; ?>
  </tbody>
</table>
</form>

<div id="boxes">
	<div class="window" id="upload-file-popup">
		<form action="<?php echo get_url('banner/upload'); ?>" method="post" enctype="multipart/form-data"> 
			<div class="titlebar">
		  		<?php echo __('Banner Upload'); ?>
		  		<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
		  	</div>
		  
			<div class="content">
			 	<?php echo __('Title'); ?>
				<div id="meta-pages" class="">
				    <input class="textbox" id="banner_name" name="banner[name]" size="50" type="text" value="" />
			    </div><br>
			    
			    <?php echo __('External URL'); ?>
				<div id="meta-pages" class="">
				    <input class="textbox" id="external_url" name="banner[external_url]" size="80" type="text" value="" />
			    </div><br>
			    
			  		    
			    <?php echo __('Description'); ?>
				<div id="meta-pages" class="">
				    <textarea id="caption" name="banner[caption]" type="text" style="height:60px;"></textarea>
			    </div><br>
			   	
			    	
				<?php echo __('Banner Type'); ?>
				<div id="meta-pages" class="pages">
				    <input class="textbox" id="home" value='home' name="banner[type]" type="radio" checked onclick="changeB(this.value)" /> Home Page &nbsp;
				    <input class="textbox" id="inner" value='inner' name="banner[type]" type="radio" onclick="changeB(this.value)" /> Inner Page 
				<!--	<input class="textbox" id="fnb" value='dining' name="banner[type]" type="radio" onclick="changeB(this.value)" /> Home Dining -->
					<!--<input class="textbox" id="fnb-menu" value='fnb-menu' name="banner[type]" type="radio" onclick="changeB(this.value)" /> F&B Menu-->
			    </div> <br>
			     
			    <div id="inner-page" style="display:none">
				    <?php echo __('Assign to Page'); ?>	  
					<div id="meta-pages" class="">
					    <select id="page_id"  name="banner[page_id]">
					    <option value=""></option>
						<?php
						  foreach($pages as $page){
							if($page->id!=1){
								if($page->hasChildren($page->id)){
									echo "<option value='".$page->id."'>".$page->title."</option>";
									$subpages = $page->childrenOf($page->id);
									foreach($subpages as $subpage){
										echo "<option value='".$subpage->id."'> - - - - - ".$subpage->title."</option>";
									}		
								}else{
									echo "<option value='".$page->id."'>".$page->title."</option>";
								}
						 	}else{
							 	echo "<option value='".$page->id."'>".$page->title."</option>";
						 	}
						  }
						?>
					    </select> 
				    </div><br> 
			    </div>
			        
			    <div id="home-loc">
				    <?php echo __('Assign to Location'); ?>  
					<div id="meta-pages" class="">
					    <select id="location"  name="banner[location]">
					    	<option value="background" <?php echo ($banner->location=="background"?"selected":"") ?>>Top Banner</option>
							<option value="leftslide" <?php echo ($banner->location=="leftslide"?"selected":"") ?>>Left Slider</option>
							<option value="aboutus" <?php echo ($banner->location=="aboutus"?"selected":"") ?>>About Us Background</option>
							<option value="dining" <?php echo ($banner->location=="dining"?"selected":"") ?>>Home Dining</option>
					    </select> 
				    </div><br> 
			    </div>
          
			    <div id="meta-pages" class="">
			    <?php echo __('Select Image'); ?><br>
			        <input id="upload_path" name="upload[path]" type="hidden" value="" />
			        <input id="upload_file" name="upload_file" type="file" />
			        <input id="upload_file_button" name="commit" type="submit" value="<?php echo __('Upload'); ?>" style="width:100px;float:right" /> 
			    </div>
		  	</div>
		</form>
	</div>	

    <!-- Do not remove div#mask, because you'll need it to fill the whole screen -->
 	<div id="mask"></div>
 	
</div>

<script type="text/javascript">	
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
</script>
	