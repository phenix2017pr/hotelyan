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
 if(isset($_GET['page'])){ $page = $_GET['page']; }else{ $page=""; }
?>
<h1 style="display:none;"><?php echo __('Album'); ?></h1>
<form style="display:none;" name="thisform" method="post" action="<?php echo get_url('fnbgallery/save_album_order') ?>">
<br style="display:none;"/>
<div align=right><input type=submit value="<?php echo __('Save Order'); ?>"></div>
<table id="files-list" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th width=80><?php echo __('Album Id'); ?></th>
      <!-- <th width=80><?php echo __('Page Id'); ?></th> -->
      <th class="files" ><?php echo __('Album Title'); ?></th>
      <th class="size" width=100><?php echo __('Order'); ?></th>
      <th class="size" width=100><?php echo __('Status'); ?></th>
      <th class="modify" width=50><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php while($album = $select_albums ->fetchObject()){ ?>
    <tr class="<?php echo odd_even(); ?>">
      <td align=center><?php echo $album->id ?></td>
	  <!-- <td align=center><?php echo $album->page_id ?></td> -->
      <td><a href="<?php echo get_url('fnbgallery/view_album/'.$album->id); ?>"><?php echo $album->name ?></a></td>
      <td>
      	<input type=hidden name="album_id[]" value="<?php echo $album->id ?>">
      	<input type="text" value="<?php echo $album->sequence ?>" name="order[]" size=3 style="text-align:right;">
      </td>
      <td><?php $status=($album->status==1?"Show":"Hidden");
      			echo ucwords($status); 
      	  ?>
      </td>
      <td>
        <a href="<?php echo get_url('fnbgallery/delete_album/'.$album->id); ?>" onclick="return confirm('<?php echo __('All images of this album will be removed as well. Are you sure you wish to delete'); ?> <?php echo $album->name; ?>?');"><img src="../wolf/admin/images/icon-remove.gif" alt="remove icon" /></a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
</form>

<!--<br><br><br><br>-->

<h1><?php echo __('Fnb Slide'); ?></h1>
<br />
<form name="thisform" method="post" action="<?php echo get_url('fnbgallery/save_order') ?>">
<div align=right><input type=submit value="<?php echo __('Save Order'); ?>"></div>
<table id="files-list" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th class="files" width=300><?php echo __('Album'); ?></th>
      <th class="files"><?php echo __('Title'); ?></th>
      <th class="files" width=200><?php echo __('Image'); ?></th>
      <th class="size"><?php echo __('Order'); ?></th>
      <th class="size" width=100><?php echo __('Status'); ?></th>
      <th class="modify" width=50><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php while($fnbgallery = $galleries ->fetchObject()){ ?>
    <tr class="<?php echo odd_even(); ?>">
      <td><?php echo $fnbgallery->album_name ?></td>
      <td><a href="<?php echo get_url('fnbgallery/view/'.$fnbgallery->id) ?>"><?php echo $fnbgallery->title ?></a></td>
      <td>
      	<a href="<?php echo get_url('fnbgallery/view/'.$fnbgallery->id) ?>">
        	<img src="<?php echo URL_PUBLIC.'public/fnb/gallery/'.$fnbgallery->album_id.'/'.$fnbgallery->filename; ?>" align="top" alt="page icon" height=60/>
        </a>
      </td>
      <td>
      	<input type=hidden name="fnbgallery_id[]" value="<?php echo $fnbgallery->id ?>">
      	<input type="text" value="<?php echo $fnbgallery->sequence ?>" name="order[]" size=3 style="text-align:right;">
      </td>
      <td><?php $status=($fnbgallery->status==1?"Show":"Hidden");
      			echo __($status);
      	  ?>
      </td>
      <td>
        <a href="<?php echo get_url('fnbgallery/delete/'.$fnbgallery->id); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete'); ?> <?php echo $fnbgallery->filename; ?>?');"><img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="remove icon" /></a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>

</form>

<div id="boxes">
	<div class="window" id="upload-file-popup">
		<form action="<?php echo get_url('fnbgallery/upload'); ?>" method="post" enctype="multipart/form-data">
			<div class="titlebar">
		  		<?php echo __('Image Upload'); ?>
		  		<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
		  	</div>
		  <div class="content" >
        <?php echo __('Album'); ?>
			<div id="meta-pages" class="">
			    <select id="album_id" name="fnbgallery[album_id]">
			    <?php
			    	while($album = $albums->fetchObject()){
			        	echo "<option value='".$album->id."'>".$album->name."</option>";
		        	}
			    ?>
			    </select>
		    </div><br>
		    <?php echo __('Title'); ?>
			<div id="meta-pages" class="">
			    <input class="textbox" id="title" name="fnbgallery[title]" style="width:100%" type="text" value="" />
		    </div><br />
		  
		    <div id="meta-pages" class="">
		    <?php echo __('Upload Image'); ?><br>
		        <input id="upload_path" name="upload[path]" type="hidden" value="" />
		        <input id="upload_file" name="upload_file" type="file" />
		        <input id="upload_file_button" name="commit" type="submit" value="<?php echo __('Upload'); ?>" style="width:100px;float:right" />
		    </div><br />
		  </div>
		</form>
	</div>

  <div class="window" id="create-album-popup">
		<form action="<?php echo get_url('fnbgallery/createalbum'); ?>" method="post" enctype="multipart/form-data"> 
		  <div class="titlebar">
			  	<?php echo __('Create Album'); ?>
			 	<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
		  </div>
		  <div class="content">
		  	<?php $oFnbGallery = new FnbGallery(); ?>
	  		<input type=hidden name="sequence" value="<?php echo $oFnbGallery->getLastAlbumSeq() ?>">

		<!-- 	<?php echo __('Assign to Page'); ?>
			<div id="meta-pages" class="">
				<select id="page_id"  name="page_id">
				<option value=""></option>
				<?php
				foreach($pages as $page){
				$page_selected = ($page->id==$album->page_id?"selected":"");
				
				if($page->id!=1){
					if($page->hasChildren($page->id)){
						echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
						$subpages = $page->childrenOf($page->id);
						foreach($subpages as $subpage){
							$subpage_selected = ($subpage->id==$album->page_id?"selected":"");
							
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
			</div><br> -->

			
		    <?php echo __('Album Name'); ?>
			<div id="meta-pages" class="">
			    <input class="textbox" id="album_name" name="album_name" size="60" type="text" value="" />
		    </div><br>
		      
		    
		    <div id="meta-pages" class="">
		        <input id="upload_file_button" name="commit" type="submit" value="<?php echo __('Create'); ?>" style="width:100px;float:right" /> 
		    </div>
		    <br />
		  </div>
		</form>
	</div>

	<!-- Do not remove div#mask, because you'll need it to fill the whole screen -->
 	<div id="mask"></div>
</div>



<?php
    $navigation = "";
    if ($CurPage == $lastpage) {
        $next = '&nbsp;&nbsp;';
    } else {
        $nextpage = $CurPage + 1;
        $next = '&nbsp;&nbsp;<a href="' . get_url('fnbgallery?page=') . '' . $nextpage .
            '" class="">Next</a>';
    }
    if ($CurPage == 0) {
       $prev = '';
    } else {
        $prevpage = $CurPage - 1;
        $prev = '<a href="' . get_url('fnbgallery?page=') . '' . $prevpage .
            '">Prev</a>';
    }
//     $navigation .= $prev;
    for ($i = 0; $i < $lastpage+1; $i++) {
        if ($i == $CurPage)
            $navigation.= '<span class="current">'.($i+1).'</span>';
        else
            $navigation.= " <a href=" . get_url('fnbgallery?page=') . "$i>".($i+1)."</a>\n";
    }

//     $navigation .= $next;
    ?>
	 <?php if($navigation!=""){ ?> <div align=right class="pagination"><?php echo __('Page'); ?>: <?php echo $navigation ?></div><?php } ?>
