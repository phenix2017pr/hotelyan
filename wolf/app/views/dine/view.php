<?php
	$postdata = Flash::get('postdata');
?>
<form action="<?php echo get_url('dine/edit/'.$dine->id); ?>" method="post" enctype="multipart/form-data" name="thisform">
	<input type=hidden name="action" value="edit">

	<h1><?php echo __('Edit Dine'); ?> </h1>

	<h3><?php echo __('Dine Title'); ?> *</h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[title]" name="dine[title]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['title'] : (isset($dine)? $dine->title : '')) ?>" />
	</div>

	<h3><?php echo __('Description'); ?></h3>
	<div id="meta-pages" class="pages">
		<textarea class="textbox" id="dine[description]" name="dine[description]" rows=10><?php echo(isset($postdata) ? $postdata['description'] : (isset($dine) ? $dine->description : '')) ?></textarea>
	</div>

	<h3><?php echo __('Button Name'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[url_name]" name="dine[url_name]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url_name'] : (isset($dine) ? $dine->url_name : '')) ?>" />
	</div>

	<h3><?php echo __('URL'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[url]" name="dine[url]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url'] : (isset($dine) ? $dine->url : '')) ?>" />
	</div>

	<h3><?php echo __('Button Name 2'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[url_name2]" name="dine[url_name2]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url_name2'] : (isset($dine) ? $dine->url_name2 : '')) ?>" />
	</div>

	<h3><?php echo __('URL 2'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[url]" name="dine[url2]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url2'] : (isset($dine) ? $dine->url2 : '')) ?>" />
	</div>

	<h3><?php echo __('Button Name 3'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[url_name3]" name="dine[url_name3]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url_name3'] : (isset($dine) ? $dine->url_name3 : '')) ?>" />
	</div>

	<h3><?php echo __('URL 3'); ?></h3>
	<div id="meta-pages" class="pages">
		<input class="textbox" id="dine[url3]" name="dine[url3]" size="40" type="text" value="<?php echo(isset($postdata) ? $postdata['url3'] : (isset($dine) ? $dine->url3 : '')) ?>" />
	</div>



	<?php
		$file_path = FILES_DIR.'/dine/images/'.$dine->filename;
		if(file_exists($file_path) && $dine->filename!=""){
			$image = '<img src="'.URL_PUBLIC.'public/dine/images/'.$dine->filename.'">';
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
		<?php echo __('or'); ?> <a href="<?php echo get_url('dine'); ?>"><?php echo __('Cancel'); ?></a>
	</p>
</form>