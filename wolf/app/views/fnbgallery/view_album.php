
<?php
 if(isset($_GET['page'])){ $page = $_GET['page']; }else{ $page=""; }


 ?>
<form action="<?php echo get_url('fnbgallery/edit_album/'.$album->id); ?>" method="post" enctype="multipart/form-data"> 
<input type=hidden name="action" value="edit">
	
<h1><?php echo __('Edit Album'); ?> </h1>

<h3><?php echo __('Album Name'); ?></h3>
<div id="meta-pages" class="pages">
	<input class="textbox" id="album_name" name="album_name" size="60" type="text" value="<?php echo $album->name ?>" />
</div>
<!-- 
<div class="pages">
    <h3><?php echo __('Assign to Page'); ?></h3>	  
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
    </div>
</div>  -->
    
    
<h3><?php echo __('Status'); ?></h3>
<div id="meta-pages" class="">
    <select id="status"  name="status">
    	<option value="1" <?php echo ($album->status=="1"?"selected":"") ?>>Show</option>
        <option value="0" <?php echo ($album->status=="0"?"selected":"") ?>>Hidden</option>
    </select>
</div>   

<p class="buttons">
    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
    <?php echo __('or'); ?> <a href="<?php echo get_url('fnbgallery'); ?>"><?php echo __('Cancel'); ?></a>
</p>
	
</form>




<br><br><br><br>

<h1><?php echo __('FnbGallery'); ?></h1>
<br />
<form name="thisform" method="post" action="<?php echo get_url('fnbgallery/save_order') ?>">
<input type=hidden name="album_id" value="<?php echo $album->id ?>">
<div align=right><input type=submit value="<?php echo __('Save Order'); ?>"></div>
<table id="files-list" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
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
      <td><a href="<?php echo get_url('fnbgallery/view/'.$fnbgallery->id) ?>"><?php echo $fnbgallery->title ?></a></td>
      <td>
      	<a href="<?php echo get_url('fnbgallery/view/'.$fnbgallery->id) ?>">
        	<img src="<?php echo URL_PUBLIC.'public/fnbgallery/images/'.$fnbgallery->album_id.'/767x575_'.$fnbgallery->filename; ?>" align="top" alt="page icon" height=60/>
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

<?php


    $navigation = "";
    if ($CurPage == $lastpage) {
        $next = '&nbsp;&nbsp;';
    } else {
        $nextpage = $CurPage + 1;
        $next = '&nbsp;&nbsp;<a href="' . get_url('fnbgallery/view_album/'.$album->id.'?page=') . '' . $nextpage .
            '" class="">Next</a>';   
    }
    if ($CurPage == 0) {
       $prev = '';
    } else {
        $prevpage = $CurPage - 1;
        $prev = '<a href="' . get_url('fnbgallery/view_album/'.$album->id.'?page=') . '' . $prevpage .
            '">Prev</a>';
    }
//     $navigation .= $prev;
    for ($i = 0; $i < $lastpage+1; $i++) {
        if ($i == $CurPage)
            $navigation.= '<span class="current">'.($i+1).'</span>';
        else
            $navigation.= " <a href=" . get_url('fnbgallery/view_album/'.$album->id.'?page=') . "$i>".($i+1)."</a>\n";
    }

//     $navigation .= $next;
    ?>
	 <?php if($navigation!=""){ ?> <div align=right class="pagination">Page: <?php echo $navigation ?></div><?php } ?>




<div id="boxes">
	<div class="window" id="upload-file-popup">
		<form action="<?php echo get_url('fnbgallery/upload'); ?>" method="post" enctype="multipart/form-data">
		<input type=hidden name="from_page" value="view_album">
			<div class="titlebar">
		  		<?php echo __('Image Upload'); ?>
		  		<a href="#" class="close"><img src="<?php echo ICONS_URI;?>delete-disabled-16.png"/></a>
		  	</div>
		  <div class="content">
        <?php echo __('Album'); ?> : <?php echo $album->name ?>
			<div id="meta-pages" class="">
				<input value='<?php echo $album->id ?>' type=hidden name="fnbgallery[album_id]">
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
</div>