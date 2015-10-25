
<form action="<?php echo get_url('fnb/edit_location/'.$location->id); ?>" method="post" enctype="multipart/form-data"> 
<input type=hidden name="action" value="edit">
<input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />

<h1><?php echo __('Edit Location'); ?> </h1>

<h3><?php echo __('Title'); ?></h3>
<div id="meta-pages" class="pages">
	<input class="textbox" id="title" name="title" size="60" type="text" value="<?php echo $location->title ?>" />
</div>

<h3><?php echo __('Description'); ?></h3>
<div id="meta-pages" class="pages">
	<textarea id="description" name="description" class="textarea markitup ckeditor" rows=10><?php echo $location->description ?></textarea>
</div>

<h3><?php echo __('URL'); ?></h3>
<div id="meta-pages" class="pages">
	<input class="textbox" id="url" name="url" size="80" type="text" value="<?php echo $location->url ?>" />
</div>

<h3><?php echo __('Location Image'); ?></h3>
<div id="meta-pages" class="pages">
	<input id="upload_location_path" name="upload[location_path]" type="hidden" value="" />
	<input id="upload_loaction_file" name="upload_location_file" type="file" />
</div>
<br />
<img src="<?php echo URL_PUBLIC.'public/fnb/location/'.$location->filename; ?>" style="max-width:100%; clear:both; display:block;" />

<p class="buttons">
    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
    <?php echo __('or'); ?> <a href="<?php echo get_url('fnb/edit/'.$location->fnbid); ?>"><?php echo __('Cancel'); ?></a>
</p>
	

</form>

