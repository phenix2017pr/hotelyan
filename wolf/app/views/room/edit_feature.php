
<form action="<?php echo get_url('room/edit_feature/'.$feature->id); ?>" method="post" enctype="multipart/form-data"> 
<input type=hidden name="action" value="edit">
<input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />

<h1><?php echo __('Edit Feature'); ?> </h1>

<h3><?php echo __('Title'); ?></h3>
<div id="meta-pages" class="pages">
	<input class="textbox" id="title" name="title" size="60" type="text" value="<?php echo $feature->title ?>" />
</div>

<h3><?php echo __('Feature Image'); ?></h3>
<div id="meta-pages" class="pages">
	<input id="upload_feature_path" name="upload[feature_path]" type="hidden" value="" />
	<input id="upload_feature_file" name="upload_feature_file" type="file" />
</div>
<br />
<img src="<?php echo URL_PUBLIC.'public/room/feature/'.$feature->filename; ?>" style="max-width:100%; clear:both; display:block;" />

<p class="buttons">
    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
    <?php echo __('or'); ?> <a href="<?php echo get_url('room/edit/'.$feature->roomid); ?>"><?php echo __('Cancel'); ?></a>
</p>
	

</form>

