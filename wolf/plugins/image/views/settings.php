<?php if (!defined('IN_CMS')) { exit(); } ?>

<h1><?php echo __('Settings'); ?></h1>

<form action="<?php echo get_url('plugin/image/save'); ?>" method="post">
	<table class="fieldset" cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td class="label"><label for="img-path"><?php echo __('Images directory:'); ?> </label></td>
			<td class="field"><input name="img-path" id="img-path" type="text" value="<?php echo $path; ?>"/></td>
			<td class="help"><?php echo __('Relative URI to images depending on where Wolf CMS was installed.<br/>For example: /public/images');?></td>
		</tr>
	</table>
	<p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save');?>" />
    </p>
</form>
