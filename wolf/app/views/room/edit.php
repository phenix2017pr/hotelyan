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

  $postdata = Flash::get('room_postdata');

  $roomid = (!empty($room)?$room->id:'');

?>

<!-- ckeditor -->  

<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/scripts/ckeditor/ckeditor.js"></script>

<script type="text/javascript" charset="utf-8" src="<?php echo URL_PUBLIC ?>wolf/plugins/ckeditor/ckeditor_custom_config.js"></script>

<input type="hidden" value="ckeditor" class="filter-selector" name="ckeditor_trigger">

<!-- End ckeditor -->



<form action="<?php echo $action=='edit' ? get_url('room/edit/'.$room->id): get_url('room/add'); ; ?>" method="post" enctype="multipart/form-data">

    <input id="csrf_token" name="csrf_token" type="hidden" value="<?php echo $csrf_token; ?>" />



	<h1><?php echo __(ucfirst($action).' Room'); ?></h1>



	<h3><?php echo __('Room Name'); ?></h3>

	<div id="meta-pages" class="pages">

		<input class="textbox" id="room_name" maxlength="255" name="room[name]" size="80" type="text" value="<?php if (!empty($room->name)) { echo $room->name; } elseif (!empty($postdata['name'])) { echo $postdata['name']; } ?>" />

	</div>

	

<!-- 	<div class="pages">

    <h3><?php echo __('Assign to Page'); ?></h3>	  

		<div id="meta-pages" class="">

			<select id="pageid"  name="room[pageid]">

			<option value=""></option>

			<?php

			  foreach($pages as $page){

				$page_selected = ($page->id==$room->pageid?"selected":"");

				

				if($page->id!=1){

					if($page->hasChildren($page->id)){

						echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";

						$subpages = $page->childrenOf($page->id);

						foreach($subpages as $subpage){

							$subpage_selected = ($subpage->id==$room->pageid?"selected":"");

							

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

	</div>  -->

	

	<h3><?php echo __('Description'); ?></h3>

	<div id="meta-pages" class="pages">

		<textarea id="room_description" name="room[description]" class="textarea markitup ckeditor" rows=10><?php echo(isset($postdata) ? $postdata['description'] : (isset($room) ? $room->description : '')) ?></textarea>

	</div>



<!-- 	<h3><?php echo __('Home Page Image'); ?></h3>

	<div id="meta-pages" class="pages">

		<input id="upload_path" name="upload[path2]" type="hidden" value="" />

		<input id="upload_file_home" name="upload_file_home" type="file" />

	</div>

	

	<?php if (isset($room->filename)) { ?>

	    <div class="clear"></div>

        <h5> <?php echo ($room->filename_home!=''?'public/room/images/'.$room->filename_home:''); ?> &nbsp;&nbsp; 

    <font size=1><?php echo ($room->filename_home!=''?'<a href="javascript:void(0)" onclick="validate2()">Remove</a>':''); ?></font></h5>

    <?php echo ($room->filename_home!=''?'<img src="'.BASE_FILES_DIR.'/room/images/'.$room->filename_home.'" width=500 />':''); ?>   

    

	<?php } ?> -->

	

<!--  	<h3><?php echo __('Home Page Description'); ?></h3>

	<div id="meta-pages" class="pages">

		<textarea class="textarea markitup ckeditor" id="url_name" name="room[url_name]" type="text" rows=8><?php if (!empty($room->url_name)) { echo $room->url_name; } elseif (!empty($postdata['url_name'])) { echo $postdata['url_name']; } ?>" </textarea>

	</div> 
 -->
	

	<h3><?php echo __('Book Now URL'); ?></h3>

	<div id="meta-pages" class="pages">

		<input class="textbox" id="url" name="room[url]" type="text" size="80" value="<?php if (!empty($room->url)) { echo $room->url; } elseif (!empty($postdata['url'])) { echo $postdata['url']; } ?>" />

	</div>

	

	<h3><?php echo __('Main Image'); ?></h3>

	<div id="meta-pages" class="pages">

		<input id="upload_path" name="upload[path]" type="hidden" value="" />

		<input id="upload_file" name="upload_file" type="file" />

	</div>

	

	<?php if (isset($room->filename)) { ?>

	    <div class="clear"></div>

		<!--<a href="<?php echo BASE_FILES_DIR.'/room/images/'.$room->filename; ?>" target="_new"><?php echo $room->filename; ?></a>-->

        <h5> <?php echo ($room->filename!=''?'public/room/images/'.$room->filename:''); ?> &nbsp;&nbsp; 

    <font size=1><?php echo ($room->filename!=''?'<a href="javascript:void(0)" onclick="validate()">Remove</a>':''); ?></font></h5>

    <?php echo ($room->filename!=''?'<img src="'.BASE_FILES_DIR.'/room/images/'.$room->filename.'" width=500 />':''); ?>   

    

	<?php } ?>

	

	

	

	<p class="buttons">

	    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />

	    <input class="button" type="submit" accesskey="s" value="<?php echo __('Save & Continue Editing'); ?>" />

	    <?php echo __('or'); ?> <a href="<?php echo get_url('room'); ?>"><?php echo __('Cancel'); ?></a>

	</p>

</form>

<br>

<form name="thisform" method="post" action="<?php echo get_url('room/save_imageorder') ?>">

	<input id="room_id" name="room_id" type="hidden" value="<?php echo $room->id; ?>" />

	<h3 style="float:left"><?php echo __('Room Gallery'); ?></h3>

	<div style="float:right"><input type=submit value="<?php echo __('Save Order'); ?>"></div>

	<div style="clear:both"></div>

  	<table id="roomlist" class="index" cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px; ">

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

			if (!empty($roomgalleries)){

			  foreach ($roomgalleries as $roomimage) { ?>

			  <tr class="<?php echo odd_even(); ?>">

				<td><a href="<?php  echo get_url('room/edit_room_image/'.$roomimage->id); ?>">

				  <?php echo $roomimage->title; ?></a></td>

				<td class="user">

				    <a href="<?php  echo get_url('room/edit_room_image/'.$roomimage->id); ?>">

				  <?php echo ($roomimage->filename!=''?'<img src="'.BASE_FILES_DIR.'/room/gallery/'.$roomimage->filename.'" width=100 />':''); ?>

				  </a>

				</td>

				<td>

					<input type=hidden name="roomimage_id[]" value="<?php echo $roomimage->id ?>">

					<input type="text" value="<?php echo $roomimage->sequence ?>" name="order[]" size=1 style="text-align:right;">

				</td>

				<td>

				  <a href="<?php echo get_url('room/delete_image/'.$roomimage->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete room image : '); ?> <?php echo $roomimage->filename; ?>?');">

					<img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="delete image" title="Delete Image" />

				  </a>

				</td>

			  </tr>

			<?php

			  }

			}?>

		</tbody>

  	</table>

  	<?php Observer::notify('room_edit_view_after_details', $room); ?>

</form>

<br>

<!--

<form name="thisform" method="post" action="<?php echo get_url('room/save_featureimageorder') ?>">

	<input id="room_id" name="room_id" type="hidden" value="<?php echo $room->id; ?>" />

	<h3 style="float:left"><?php echo __('Feature'); ?></h3>

	<div style="float:right"><input type=submit value="<?php echo __('Save Order'); ?>"></div>

	<div style="clear:both"></div>

  	<table id="roomlist" class="index" cellpadding="0" cellspacing="0" border="0" style="margin-top: 10px; ">

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

			if (!empty($features)){

			  foreach ($features as $feature) { ?>

			  <tr class="<?php echo odd_even(); ?>">

				<td><a href="<?php  echo get_url('room/edit_feature/'.$feature->id); ?>">

				  <?php echo $feature->title; ?></a></td>

				<td class="user">

				  <a href="<?php  echo get_url('room/edit_feature/'.$feature->id); ?>">

				  <?php echo ($feature->filename!=''?'<img src="'.BASE_FILES_DIR.'/room/feature/'.$feature->filename.'" width=40 />':''); ?>

				  </a>

				</td>

				<td>

					<input type=hidden name="featureimage_id[]" value="<?php echo $feature->id ?>">

					<input type="text" value="<?php echo $feature->sequence ?>" name="order[]" size=1 style="text-align:right;">

				</td>

				<td>

				  <a href="<?php echo get_url('room/delete_featureimage/'.$feature->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete Feature image : '); ?> <?php echo $feature->filename; ?>?');">

					<img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="delete image" title="Delete Image" />

				  </a>

				</td>

			  </tr>

			<?php

			  }

			}?>

		</tbody>

  	</table>

  	<?php Observer::notify('room_edit_view_after_details', $room); ?>

</form>

-->



<div id="boxes">

	<div class="window" id="upload-file-popup">

		<form action="<?php echo get_url('room/upload/'.$room->id); ?>" method="post" enctype="multipart/form-data">

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



	<!-- Do not remove div#mask, because you'll need it to fill the whole screen -->

 	<div id="mask"></div>

</div>



<div id="boxes">

	<div class="window" id="upload-feature-popup">

		<form action="<?php echo get_url('room/uploadfeature/'.$room->id); ?>" method="post" enctype="multipart/form-data">

			<div class="titlebar">

		  		<?php echo __('Feature Image Upload'); ?>

		  		<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>

		  	</div>

		  	<div class="content" style="width:520px;">

				<div id="meta-pages" class="">

					  <?php echo __('Title'); ?><br>

					  <input id="title" name="title" type="text" value="" class="textbox" />

				  </div>

			  

		  	  <div id="meta-pages" class="">

		  		  <div style="clear:both;"><?php echo __('Upload Image'); ?></div>

		  	      <input id="upload_feature_path" name="upload[feature_path]" type="hidden" value="" />

		  	      <input id="upload_feature_file" name="upload_feature_file" type="file" />

		  	      <input id="upload_feature_file_button" name="commit" type="submit" value="<?php echo __('Upload'); ?>" style="width:100px;float:right" />

		  	  </div>

		  	</div>

		</form>

	</div>



	<!-- Do not remove div#mask, because you'll need it to fill the whole screen -->

 	<div id="mask"></div>

</div>



<script type="text/javascript">

// <![CDATA[
     $(function () {  

		CKEDITOR.replace("room_description",
		{
			toolbar : 'BasicFront',
			width: 900,
			height: 400
		});

     });

    function setConfirmUnload(on, msg) {

        window.onbeforeunload = (on) ? unloadMessage : null;

        return true;

    }

	

	function validate(){

		if(confirm('Are you sure want to remove this image?')){	

			window.location="<?php echo get_url('room/delete_mainimage/'.$room->id); ?>";	

		}

	} 



	function validate2(){

		if(confirm('Are you sure want to remove home image?')){	

			window.location="<?php echo get_url('room/delete_homeimage/'.$room->id); ?>";	

		}

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

