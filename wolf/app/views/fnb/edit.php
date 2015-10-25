<?php

/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2009-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/**
 * @package Views
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @copyright Philippe Archambault, 2008
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */
?>

<?php
 /*
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
*/
  $postdata = Flash::get('fnb_postdata');
  $fnbid = (!empty($fnb)?$fnb->id:'');
?>
<!-- ckeditor -->  
<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/scripts/ckeditor/ckeditor.js"></script>
<!--<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/ckeditor_custom_config.js"></script>-->
<input type="hidden" value="ckeditor" class="filter-selector" name="ckeditor_trigger">
<!-- End ckeditor -->

<form action="<?php echo $action=='edit' ? get_url('fnb/edit/'.$fnb->id): get_url('fnb/add'); ; ?>" method="post" enctype="multipart/form-data">
    <input id="csrf_token" name="csrf_token" type="hidden" value="<?php echo $csrf_token; ?>" />

	<h1><?php echo __(ucfirst($action).' Menu'); ?></h1>

	<h3><?php echo __('Menu Name'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="fnb_name" maxlength="255" name="fnb[name]" size="80" type="text" value="<?php if (!empty($fnb->name)) { echo $fnb->name; } elseif (!empty($postdata['name'])) { echo $postdata['name']; } ?>" />
	</div>
	
	<div class="pages">
    <h3><?php echo __('Assign to Page'); ?></h3>	  
		<div id="meta-pages" class="">
			<select id="pageid"  name="fnb[pageid]">
			<option value="3" selected="">F &amp; B</option>
			<?php
			  /*foreach($pages as $page){
				$page_selected = ($page->id==$fnb->pageid?"selected":"");
				
				if($page->id!=1){
					if($page->hasChildren($page->id)){
						echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
						$subpages = $page->childrenOf($page->id);
						foreach($subpages as $subpage){
							$subpage_selected = ($subpage->id==$fnb->pageid?"selected":"");
							
							echo "<option value='".$subpage->id."' ".$subpage_selected."> - - - - - ".$subpage->title."</option>";
						}		
					}else{
						echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
					}
				}else{
					echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
				}
			  }*/
			?>
			</select> 
		</div>
	</div> 
	<!--
	<h3><?php echo __('Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="quick_reference" name="fnb[quick_reference]"><?php echo(isset($postdata) ? $postdata['quick_reference'] : (isset($fnb) ? $fnb->quick_reference : '')) ?> 
	</div>
-->
	<!--<h3><?php echo __('Additional Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<textarea id="additional_description" name="fnb[additional_description]" class="textarea markitup" rows=10><?php echo(isset($postdata) ? $postdata['additional_description'] : (isset($fnb) ? $fnb->additional_description : '')) ?></textarea>
	</div>-->

	<h3><?php echo __('Menu File'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_file" name="upload_file" type="file" />
	</div>
	<?php if (isset($fnb->filename)) { ?>
	    <div class="clear"></div>
		<a href="<?php echo BASE_FILES_DIR.'/fnb/files/'.$fnb->filename; ?>" target="_new"><?php echo $fnb->filename; ?></a>
	<?php } ?>
	
	<!--<h3><?php echo __('Left Background'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_left_bg" name="upload_left_bg" type="file" />
	</div>
	<?php if (isset($fnb->left_bg)) { ?>
	    <div class="clear"></div>
		<a href="<?php echo BASE_FILES_DIR.'/fnb/bg/'.$fnb->left_bg; ?>" target="_new"><?php echo $fnb->left_bg; ?></a>
	<?php } ?>

	<h3><?php echo __('Right Background'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_right_bg" name="upload_right_bg" type="file" />
	</div>
	<?php if (isset($fnb->right_bg)) { ?>
	    <div class="clear"></div>
		<a href="<?php echo BASE_FILES_DIR.'/fnb/bg/'.$fnb->right_bg; ?>" target="_new"><?php echo $fnb->right_bg; ?></a>
	<?php } ?>-->

	<p class="buttons">
	    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />
	    <input class="button" type="submit" accesskey="s" value="<?php echo __('Save & Continue Editing'); ?>" />
	    <?php echo __('or'); ?> <a href="<?php echo get_url('fnb'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>
<br>
<!--<form name="thisform" method="post" action="<?php echo get_url('fnb/save_imageorder') ?>">
	<input id="fnb_id" name="fnb_id" type="hidden" value="<?php echo $fnb->id; ?>" />
	<h3 style="float:left"><?php echo __('Menu Gallery'); ?></h3>
	<div style="float:right"><input type=submit value="<?php echo __('Save Order'); ?>"></div>
	<div style="clear:both"></div>
  	<table id="fnblist" class="index" cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px; ">
		<thead>
			<tr>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Image'); ?></th>
				<th class="size"><?php echo __('Order'); ?></th>
				<th class="modify" width=50><?php echo __('Action'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($fnbgalleries)){
			  foreach ($fnbgalleries as $fnbimage) { ?>
			  <tr class="<?php echo odd_even(); ?>">
				<td><a href="<?php  echo get_url('fnb/edit_fnb_image/'.$fnbimage->id); ?>">
				  <?php echo $fnbimage->title; ?></a></td>
				<td class="user">
				    <a href="<?php  echo get_url('fnb/edit_fnb_image/'.$fnbimage->id); ?>">
				  <?php echo ($fnbimage->filename!=''?'<img src="'.BASE_FILES_DIR.'/fnb/gallery/'.$fnbimage->filename.'" width=100 />':''); ?>
				  </a>
				</td>
				<td>
					<input type=hidden name="fnbimage_id[]" value="<?php echo $fnbimage->id ?>">
					<input type="text" value="<?php echo $fnbimage->sequence ?>" name="order[]" size=1 style="text-align:right;">
				</td>
				<td>
				  <a href="<?php echo get_url('fnb/delete_image/'.$fnbimage->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete fnb image : '); ?> <?php echo $fnbimage->filename; ?>?');">
					<img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="delete image" title="Delete Image" />
				  </a>
				</td>
			  </tr>
			<?php
			  }
			}?>
		</tbody>
  	</table>
  	<?php Observer::notify('fnb_edit_view_after_details', $fnb); ?>
</form>
<br>
<form name="thisform" method="post" action="<?php echo get_url('fnb/save_locationorder') ?>">
	<input id="fnb_id" name="fnb_id" type="hidden" value="<?php echo $fnb->id; ?>" />
	<h3 style="float:left"><?php echo __('Locations'); ?></h3>
	<div style="float:right"><input type=submit value="<?php echo __('Save Order'); ?>"></div>
	<div style="clear:both"></div>
  	<table id="fnblist" class="index" cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px; ">
		<thead>
			<tr>
				<th><?php echo __('Title'); ?></th>
				<th><?php echo __('Image'); ?></th>
				<th class="size"><?php echo __('Order'); ?></th>
				<th class="modify" width=50><?php echo __('Action'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (!empty($locations)){
			  foreach ($locations as $location) { ?>
			  <tr class="<?php echo odd_even(); ?>">
				<td><a href="<?php  echo get_url('fnb/edit_location/'.$location->id); ?>">
				  <?php echo $location->title; ?></a></td>
				<td class="user">
				  <a href="<?php  echo get_url('fnb/edit_location/'.$location->id); ?>">
				  <?php echo ($location->filename!=''?'<img src="'.BASE_FILES_DIR.'/fnb/location/'.$location->filename.'" width=150 />':''); ?>
				  </a>
				</td>
				<td>
					<input type=hidden name="location_id[]" value="<?php echo $location->id ?>">
					<input type="text" value="<?php echo $location->sequence ?>" name="order[]" size=1 style="text-align:right;">
				</td>
				<td>
				  <a href="<?php echo get_url('fnb/delete_location/'.$location->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete location : '); ?> <?php echo $location->filename; ?>?');">
					<img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="delete image" title="Delete Image" />
				  </a>
				</td>
			  </tr>
			<?php
			  }
			}?>
		</tbody>
  	</table>
  	<?php Observer::notify('fnb_edit_view_after_details', $fnb); ?>
</form>-->

<!--<div id="boxes">
	<div class="window" id="upload-file-popup">
		<form action="<?php echo get_url('fnb/upload/'.$fnb->id); ?>" method="post" enctype="multipart/form-data">
			<div class="titlebar">
		  		<?php echo __('Image Upload'); ?>
		  		<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
		  	</div>
		  	<div class="content" style="width:520px;">			  
		  	  <div id="meta-pages" class="">
		  		  <?php echo __('Title'); ?><br>
		  	      <input id="title" name="title" type="text" value="" class="textbox" />
		  	  </div>
			  
		  	  <div id="meta-pages" class="">
		  		  <div style="clear:both;"><?php echo __('Upload Image'); ?></div>
		  	      <input id="upload_path" name="upload[path]" type="hidden" value="" />
		  	      <input id="upload_file" name="upload_file" type="file" />
		  	      <input id="upload_file_button" name="commit" type="submit" value="<?php echo __('Upload'); ?>" style="width:100px;float:right" />
		  	  </div>
		  	</div>
		</form>
	</div>

	
 	<div id="mask"></div>
</div>

<div id="boxes">
	<div class="window" id="upload-location-popup">
		<form action="<?php echo get_url('fnb/uploadlocation/'.$fnb->id); ?>" method="post" enctype="multipart/form-data">
			<div class="titlebar">
		  		<?php echo __('Add Location'); ?>
		  		<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
		  	</div>
		  	<div class="content" style="width:520px;">
				<div id="meta-pages" class="">
					  <?php echo __('Title'); ?><br>
					  <input id="title" name="title" type="text" value="" class="textbox" />
				  </div>
			  
			<h3><?php echo __('Description'); ?></h3>
			<div id="meta-pages" class="pages">
				<textarea id="description" name="description" class="" rows=10></textarea>
			</div>

			<h3><?php echo __('URL'); ?></h3>
			<div id="meta-pages" class="pages">
				<input class="textbox" id="url" name="url" size="80" type="text" value="" />
			</div>

			<br />

		  	  <div id="meta-pages" class="">
		  		  <div style="clear:both;"><?php echo __('Upload Image'); ?></div>
		  	      <input id="upload_location_path" name="upload[location_path]" type="hidden" value="" />
		  	      <input id="upload_location_file" name="upload_location_file" type="file" />
		  	      <input id="upload_location_file_button" name="commit" type="submit" value="<?php echo __('Upload'); ?>" style="width:100px;float:right" />
		  	  </div>
		  	</div>
		</form>
	</div>


 	<div id="mask"></div>
</div>-->

<script type="text/javascript">
// <![CDATA[
	wolfBaseRoute = "<?php echo rtrim(URL_PUBLIC,'/'); ?>/wolf/plugins/ckeditor/";
    filemanagerRoute = wolfBaseRoute + 'filemanager/index.html';

	CKEDITOR.replace( 'description',
    {
        filebrowserBrowseUrl : filemanagerRoute,
        filebrowserImageBrowseUrl : filemanagerRoute + '?Type=Images',
        filebrowserFlashBrowseUrl :filemanagerRoute + '?Type=Flash',
        filebrowserUploadUrl : '/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Flash'
    });

	CKEDITOR.replace( 'additional_description',
    {
        filebrowserBrowseUrl : filemanagerRoute,
        filebrowserImageBrowseUrl : filemanagerRoute + '?Type=Images',
        filebrowserFlashBrowseUrl :filemanagerRoute + '?Type=Flash',
        filebrowserUploadUrl : '/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : '/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : '/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Flash'
    });


    function setConfirmUnload(on, msg) {
        window.onbeforeunload = (on) ? unloadMessage : null;
        return true;
    }

    function unloadMessage() {
        return '<?php echo __('You have modified this page.  If you navigate away from this page without first saving your data, the changes will be lost.'); ?>';
    }

    $(document).ready(function() {
        // Prevent accidentally navigating away
        $(':input').bind('change', function() { setConfirmUnload(true); });
        $('form').submit(function() { setConfirmUnload(false); return true; });
    });

// ]]>
</script>
