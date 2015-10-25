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
  $postdata = Flash::get('attraction_postdata');
  $attractionid = (!empty($attraction)?$attraction->id:'');

?>
<!-- ckeditor -->  
<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/scripts/ckeditor/ckeditor.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/ckeditor_custom_config.js"></script>
<input type="hidden" value="ckeditor" class="filter-selector" name="ckeditor_trigger">
<!-- End ckeditor -->

<form action="<?php echo $action=='edit' ? get_url('attraction/edit/'.$attraction->id): get_url('attraction/add'); ; ?>" method="post" enctype="multipart/form-data">
    <input id="csrf_token" name="csrf_token" type="hidden" value="<?php echo $csrf_token; ?>" />

	<h1><?php echo __(ucfirst($action).' Attraction'); ?></h1>

	<h3><?php echo __('Category'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="attraction_name" maxlength="255" name="attraction[name]" size="80" type="text" value="<?php if (!empty($attraction->name)) { echo $attraction->name; } elseif (!empty($postdata['name'])) { echo $postdata['name']; } ?>" />
	</div>
	
	<h3><?php echo __('Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<textarea id="attraction[description]" name="attraction[description]" class="textarea markitup ckeditor" rows=10><?php echo(isset($postdata) ? $postdata['description'] : (isset($attraction) ? $attraction->description : '')) ?></textarea>
	</div>

	<!--<h3><?php echo __('Distance to hotel'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="distance" name="attraction[distance]" type="text" size="40" value="<?php if (!empty($attraction->distance)) { echo $attraction->distance; } elseif (!empty($postdata['distance'])) { echo $postdata['distance']; } ?>" />
	</div>

	<h3><?php echo __('Opening Hour'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="opening_hour" name="attraction[opening_hour]" type="text" size="40" value="<?php if (!empty($attraction->opening_hour)) { echo $attraction->opening_hour; } elseif (!empty($postdata['opening_hour'])) { echo $postdata['opening_hour']; } ?>" />
	</div>

	<?php if (AuthUser::hasPermission('attraction_geo')) { ?>
	
	<h3><?php echo __('Latitude'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="latitude" name="attraction[latitude]" type="text" size="40" value="<?php if (!empty($attraction->latitude)) { echo $attraction->latitude; } elseif (!empty($postdata['latitude'])) { echo $postdata['latitude']; } ?>" />
	</div>
	<h3><?php echo __('Longitude'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="longitude" name="attraction[longitude]" type="text" size="40" value="<?php if (!empty($attraction->longitude)) { echo $attraction->longitude; } elseif (!empty($postdata['longitude'])) { echo $postdata['longitude']; } ?>" />
	</div>
-->
	<?php } ?>

<!-- 	<h3><?php echo __('Location URL'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="location_link" name="attraction[location_link]" type="text" size="80" value="<?php if (!empty($attraction->location_link)) { echo $attraction->location_link; } elseif (!empty($postdata['location_link'])) { echo $postdata['location_link']; } ?>" />
	</div> -->

	<!--<h3><?php echo __('Main Image'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_file" name="upload_file" type="file" />
	</div>
	
	<?php if (isset($attraction->filename)) { ?>
	    <div class="clear"></div>
		<img src="<?php echo URL_PUBLIC.'public/attraction/images/'.$attraction->filename; ?>" style="max-width:30%" />
	<?php } ?>-->
	
	<p class="buttons">
	    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />
	    <input class="button" type="submit" accesskey="s" value="<?php echo __('Save & Continue Editing'); ?>" />
	    <?php echo __('or'); ?> <a href="<?php echo get_url('attraction'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>
<br>
<form name="thisform" method="post" action="<?php echo get_url('attraction/save_imageorder') ?>">
	<input id="attraction_id" name="attraction_id" type="hidden" value="<?php echo $attraction->id; ?>" />
	<h3 style="float:left"><?php echo __('Attraction Gallery'); ?></h3>
	<div style="float:right"><input type=submit value="<?php echo __('Save Order'); ?>"></div>
	<div style="clear:both"></div>
  	<table id="attractionlist" class="index" cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px; ">
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
			if (!empty($attractiongalleries)){
			  foreach ($attractiongalleries as $attractionimage) { ?>
			  <tr class="<?php echo odd_even(); ?>">
				<td><a href="<?php  echo get_url('attraction/edit_attraction_image/'.$attractionimage->id); ?>">
				  <?php echo $attractionimage->title; ?></a></td>
				<td class="user">
				    <a href="<?php  echo get_url('attraction/edit_attraction_image/'.$attractionimage->id); ?>">
				  <?php echo ($attractionimage->filename!=''?'<img src="'.BASE_FILES_DIR.'/attraction/gallery/'.$attractionimage->filename.'" width=100 />':''); ?>
				  </a>
				</td>
				<td>
					<input type=hidden name="attractionimage_id[]" value="<?php echo $attractionimage->id ?>">
					<input type="text" value="<?php echo $attractionimage->sequence ?>" name="order[]" size=1 style="text-align:right;">
				</td>
				<td>
				  <a href="<?php echo get_url('attraction/delete_image/'.$attractionimage->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete attraction image : '); ?> <?php echo $attractionimage->filename; ?>?');">
					<img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="delete image" title="Delete Image" />
				  </a>
				</td>
			  </tr>
			<?php
			  }
			}?>
		</tbody>
  	</table>
  	<?php Observer::notify('attraction_edit_view_after_details', $attraction); ?>
</form>
<br>


<div id="boxes">
	<div class="window" id="upload-file-popup">
		<form action="<?php echo get_url('attraction/upload/'.$attraction->id); ?>" method="post" enctype="multipart/form-data">
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
		  		  <?php echo __('Distance'); ?><br>
		  	      <input id="distance" name="distance" type="text" value="" class="textbox" />
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

	<!-- Do not remove div#mask, because you'll need it to fill the whole screen -->
 	<div id="mask"></div>
</div>



<script type="text/javascript">
// <![CDATA[
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
