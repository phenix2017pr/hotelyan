
<form action="<?php echo get_url('offer/edit_offer_image/'.$offerimage->id); ?>" method="post" enctype="multipart/form-data"> 
<input type=hidden name="action" value="edit">
<input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>" />

<h1><?php echo __('Edit Offer Image'); ?> </h1>

<h3><?php echo __('Title'); ?></h3>
<div id="meta-pages" class="pages">
	<input class="textbox" id="title" name="title" size="60" type="text" value="<?php echo $offerimage->title ?>" />
</div>

<h3><?php echo __('Feature Image'); ?></h3>
<div id="meta-pages" class="pages">
	<input id="upload_path" name="upload[path]" type="hidden" value="" />
	<input id="upload_file" name="upload_file" type="file" />
</div>
<br />
<img src="<?php echo URL_PUBLIC.'public/offer/gallery/'.$offerimage->filename; ?>" style="max-width:100%; clear:both; display:block;" />

<p class="buttons">
    <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
    <?php echo __('or'); ?> <a href="<?php echo get_url('offer/edit/'.$offerimage->offerid); ?>"><?php echo __('Cancel'); ?></a>
</p>
	

</form>

