<form action="<?php echo get_url('sidebarimage/edit/'.$sidebarimage->id); ?>" method="post" enctype="multipart/form-data" name="thisform">
<input type=hidden name="action" value="edit">

<h1><?php echo __('Edit Sidebar Image'); ?> </h1>

<h3><?php echo __('Title'); ?></h3>
<div id="meta-pages" class="pages">
	<input class="textbox" id="sidebarimage[title]" name="sidebarimage[title]" size="80" type="text" value="<?php echo $sidebarimage->title ?>" />
</div>

<h3><?php echo __('Assign to Page'); ?></h3>
<div id="meta-pages" class="">
	<select id="page_id"  name="sidebarimage[page_id]">
	<option value=""></option>
	<?php
	  foreach($pages as $page){
		$page_selected = ($page->id==$sidebarimage->page_id?"selected":"");

		if($page->id!=1){
			if($page->hasChildren($page->id)){
				echo "<option value='".$page->id."' ".$page_selected.">".$page->title."</option>";
				$subpages = $page->childrenOf($page->id);
				foreach($subpages as $subpage){
					$subpage_selected = ($subpage->id==$sidebarimage->page_id?"selected":"");

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

<?php
	$file_path = FILES_DIR.'/sidebarimage/images/'.$sidebarimage->image;
	if(file_exists($file_path) && $sidebarimage->image!=""){
		$image = '<img src="'.URL_PUBLIC.'public/sidebarimage/images/'.$sidebarimage->image.'">';
	}
?>
<h3><?php echo __('Image'); ?></h3>
<div id="meta-pages" class="pages">
    <input id="upload_path" name="upload[path]" type="hidden" value="" />
    <input id="upload_file" name="upload_file" type="file" />
</div>
<div class="clear"></div>
<?php echo $image; ?>
<input type=hidden value="" name="filename">

<p class="buttons">
    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />
    <input class="button" type="submit" accesskey="s" value="<?php echo __('Save & Continue Editing'); ?>" />
    <?php echo __('or'); ?> <a href="<?php echo get_url('sidebarimage'); ?>"><?php echo __('Cancel'); ?></a>
</p>

</form>