<?php
	$postdata = Flash::get('postdata');
?>
<form action="<?php echo get_url('gallery/edit/'.$gallery->id); ?>" method="post" enctype="multipart/form-data" name="thisform">
	<input type=hidden name="action" value="edit">

	<h1><?php echo __('Edit Gallery'); ?> </h1>

	<h3><?php echo __('Title'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="gallery[title]" name="gallery[title]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['title'] : (isset($gallery)? $gallery->title : '')) ?>" />
	</div>
	
<!-- 	<h3><?php echo __('Type'); ?></h3>
	<div id="meta-pages" class="pages">
 		<input class="textbox" id="home" value='home' name="gallery[type]" type="radio" <?php echo ($gallery->type=='home'?'checked':'') ?> /> Home Page &nbsp;
	    <input class="textbox" id="about" value='about' name="gallery[type]" type="radio" <?php echo ($gallery->type=='about'?'checked':'') ?>  /> About Page
    </div>  -->

<!-- 	<h3><?php echo __('URL'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="gallery[url]" name="gallery[url]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url'] : (isset($gallery) ? $gallery->url : '')) ?>" />
	</div> -->

	<?php
		$file_path = FILES_DIR.'/gallery/images/'.$gallery->filename;
		if(file_exists($file_path) && $gallery->filename!=""){
			$image = '<img src="'.URL_PUBLIC.'public/gallery/images/'.$gallery->filename.'">';
		}
	?>
	<h3><?php echo __('Image *'); ?></h3>
	<div id="meta-pages" class="pages">
		<input id="upload_path" name="upload[path]" type="hidden" value="" />
		<input id="upload_file" name="upload_file" type="file" />
	</div>
	<input type=hidden value="" name="filename">
  	<div style="clear:both; margin-top:10px;"><?php echo $image; ?></div>
	
	<p class="buttons">
		<input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save and Close'); ?>" />
    <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
		<?php echo __('or'); ?> <a href="<?php echo get_url('gallery'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>