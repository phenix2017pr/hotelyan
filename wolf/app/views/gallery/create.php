<?php
	$postdata = Flash::get('postdata');
?>
<form action="<?php echo get_url('gallery/add_gallery'); ?>" method="post" enctype="multipart/form-data">
	<input type=hidden name="action" value="add">

	<h1><?php echo __('Add Gallery'); ?> </h1>


	<h3><?php echo __('Title'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="gallery[title]" name="gallery[title]" size="40" type="text" value="<?php echo(isset($postdata['title']) ? $postdata['title'] : '') ?>" />
	</div>
	
<!-- 	<h3><?php echo __('Type'); ?></h3>
	<div id="meta-pages" class="pages">
 		<input class="textbox" id="home" value='home' name="gallery[type]" type="radio" checked /> Home Page &nbsp; 
	    <input class="textbox" id="about" value='about' name="gallery[type]" type="radio" /> About Page
    </div>  -->

<!-- 	<h3><?php echo __('URL'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="gallery[url]" name="gallery[url]" size="40" type="text" value="<?php echo(isset($postdata['url']) ? $postdata['url'] : '') ?>" />
	</div> -->

	<h3><?php echo __('Image *'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_file" name="upload_file" type="file" />
	</div>

	<p class="buttons">
		<input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save & Back'); ?>" />
		<input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
		<?php echo __('or'); ?> <a href="<?php echo get_url('gallery'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>