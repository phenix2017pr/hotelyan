<?php
	$postdata = Flash::get('postdata');
?>
<form action="<?php echo get_url('fnbgallery/add_fnbgallery'); ?>" method="post" enctype="multipart/form-data">
	<input type=hidden name="action" value="add">

	<h1><?php echo __('Add FnbGallery'); ?> </h1>


	<h3><?php echo __('FnbGallery Title'); ?> *</h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="fnbgallery[title]" name="fnbgallery[title]" size="40" type="text" value="<?php echo(isset($postdata['title']) ? $postdata['title'] : '') ?>" />
	</div>
	
	<h3><?php echo __('Short Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="fnbgallery[short_desc]" name="fnbgallery[short_desc]" size="40" type="text" value="<?php echo(isset($postdata['short_desc']) ? $postdata['short_desc'] : '') ?>" />
	</div>

<!-- 	<h3><?php echo __('Long Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<textarea class="textarea" id="fnbgallery[long_desc]" name="fnbgallery[long_desc]" rows="10"><?php echo(isset($postdata['long_desc']) ? $postdata['long_desc'] : '') ?></textarea>
	</div> -->

	<h3><?php echo __('FnbGallery Image *'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_file" name="upload_file" type="file" />
	</div>

	<p class="buttons">
		<input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />
		<input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
		<?php echo __('or'); ?> <a href="<?php echo get_url('fnbgallery'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>