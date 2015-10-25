<?php
	$postdata = Flash::get('postdata');
?>
<form action="<?php echo get_url('attraction/edit/'.$attraction->id); ?>" method="post" enctype="multipart/form-data" name="thisform">
	<input type=hidden name="action" value="edit">

	<h1><?php echo __('Edit Attraction'); ?> </h1>

	<h3><?php echo __('Attraction Title'); ?> *</h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="attraction[title]" name="attraction[title]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['title'] : (isset($attraction)? $attraction->title : '')) ?>" />
	</div>
	
	<h3><?php echo __('Short Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="attraction[short_desc]" name="attraction[short_desc]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['short_desc'] : (isset($attraction) ? $attraction->short_desc : '')) ?>" />
	</div>

<!-- 	<h3><?php echo __('Long Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<textarea class="textarea" id="attraction[long_desc]" name="attraction[long_desc]" rows="10"><?php echo(isset($postdata) ? htmlentities($postdata['long_desc'], ENT_COMPAT, 'UTF-8') : (isset($attraction)? htmlentities($attraction->long_desc, ENT_COMPAT, 'UTF-8') : '')) ?></textarea>
	</div> -->

	<?php
		$file_path = FILES_DIR.'/attraction/images/'.$attraction->image;
		if(file_exists($file_path) && $attraction->image!=""){
			$image = '<img src="'.URL_PUBLIC.'public/attraction/images/'.$attraction->image.'">';
		}
	?>
	<h3><?php echo __('Attraction Image *'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_file" name="upload_file" type="file" />
	</div>
	<input type=hidden value="" name="filename">
  	<div style="clear:both;"><?php echo $image; ?></div>
	

	<p class="buttons">
		<input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save and Close'); ?>" />
    <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
		<?php echo __('or'); ?> <a href="<?php echo get_url('attraction'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>