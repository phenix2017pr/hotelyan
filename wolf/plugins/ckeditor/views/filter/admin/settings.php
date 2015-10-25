<style type="text/css" media="screen">
    #ckeditor_settings .tabs { margin-top:20px }
    #ckeditor_settings .page { padding:0 5px }
    #ckeditor_settings fieldset { margin: 5px 0; padding:10px; }
    #ckeditor_settings li { margin:3px 0; padding:4px 0 4px 4px; }
    #ckeditor_settings h3, #ckeditor_settings label { margin:3px 4px 6px; font-size: 14px }
    #ckeditor_settings label { cursor: pointer }
    #ckeditor_settings p.help { margin:3px 4px 0; padding:4px 0; font-size:12px; line-height:1.5; color:#666 }
</style>

<h1><?php echo __('CKEditor plugin - Preferences');?></h1>

<form id="ckeditor_settings" action="<?php echo get_url('plugin/ckeditor/settings'); ?>" method="post">
    <h2>Filemanager</h2>
    <ul>
        <li>
            <h3><?php echo __('Enable filemanager'); ?></h3>
            <label class="inline">
                <?php echo __('Yes'); ?>
                <input type="radio" id="filemanager_enabled_on" name="settings[filemanager_enabled]" value="1"<?php if($settings['filemanager_enabled'] == '1') echo ' checked="checked"'; ?>>
            </label>

            <label class="inline">
                <?php echo __('No'); ?>
                <input type="radio" id="filemanager_enabled_off" name="settings[filemanager_enabled]" value="0"<?php if($settings['filemanager_enabled'] == '0') echo ' checked="checked"'; ?>>
            </label>
        </li>
        <li>
            <label for="filemanager_base"><?php echo __('Default folder'); ?></label>
            <code><?php echo URL_PUBLIC; ?></code>
            <input type="text" id="filemanager_base" name="settings[filemanager_base]" size="16" value="<?php echo $settings['filemanager_base']; ?>" />
            <code>/</code>
            <p class="help"><?php echo __("Relative path from your wolf installation. Remember to check folder permissions."); ?></p>
        </li>
        <li>
            <fieldset>
                <legend><?php echo __("Display options"); ?></legend>
                <ul>
                    <li>
                        <h3><?php echo __('Folder contents default display'); ?></h3>
                        <label class="inline">
                            <?php echo __('Grid'); ?>
                            <input type="radio" id="filemanager_view_grid" name="settings[filemanager_view]" value="grid"<?php if($settings['filemanager_view'] == 'grid') echo ' checked="checked"'; ?>>
                        </label>

                        <label class="inline">
                            <?php echo __('List'); ?>
                            <input type="radio" id="filemanager_view_list" name="settings[filemanager_view]" value="list"<?php if($settings['filemanager_view'] == 'list') echo ' checked="checked"'; ?>>
                        </label>
                    </li>
                    <li>
                        <label for="filemanager_dateformat"><?php echo __('Dateformat'); ?></label>
                        <input type="text" id="filemanager_dateformat" name="settings[filemanager_dateformat]" size="10" value="<?php echo $settings['filemanager_dateformat']; ?>" placeholder="d M Y H:i" />
                        <p class="help"><?php echo __("Format used to display a file's creation date. See the php :link for other options.", array( ':link' => '<a href="http://php.net/manual/en/function.date.php" target="_blank" title="PHP manual date">manual</a>')); ?></p>
                    </li>
                </ul>
            </fieldset>
        </li>
        <li>
            <fieldset>
                <legend><?php echo __("Uploads"); ?></legend>
                <ul>
                    <li>
                        <h3><?php echo __('Allow uploading of files?'); ?></h3>
                        <label>
                            <?php echo __('Yes'); ?>
                            <input type="radio" id="filemanager_browse_only_on" name="settings[filemanager_browse_only]" value="0"<?php if($settings['filemanager_browse_only'] == '0') echo ' checked="checked"'; ?>>
                        </label>

                        <label>
                            <?php echo __('No'); ?>
                            <input type="radio" id="filemanager_browse_only_off" name="settings[filemanager_browse_only]" value="1"<?php if($settings['filemanager_browse_only'] == '1') echo ' checked="checked"'; ?>>
                        </label>
                    </li>
                    <li>
                        <h3><?php echo __('Overwrite files with the same name?'); ?></h3>
                        <label>
                            <?php echo __('Yes'); ?>
                            <input type="radio" id="filemanager_upload_overwrite_on" name="settings[filemanager_upload_overwrite]" value="1"<?php if($settings['filemanager_upload_overwrite'] == '1') echo ' checked="checked"'; ?>>
                        </label>

                        <label>
                            <?php echo __('No'); ?>
                            <input type="radio" id="filemanager_upload_overwrite_off" name="settings[filemanager_upload_overwrite]" value="0"<?php if($settings['filemanager_upload_overwrite'] == '0') echo ' checked="checked"'; ?>>
                        </label>
                        <p class="help"><?php echo __("If disabled, a numeric index will be appended to the uploaded file name."); ?></p>
                    </li>
                    <li>
                        <h3><?php echo __('Allow users to upload files other than images?'); ?></h3>
                        <label>
                            <?php echo __('Yes'); ?>
                            <input type="radio" id="filemanager_upload_images_only_on" name="settings[filemanager_upload_images_only]" value="0"<?php if($settings['filemanager_upload_images_only'] == '0') echo ' checked="checked"'; ?>>
                        </label>

                        <label>
                            <?php echo __('No'); ?>
                            <input type="radio" id="filemanager_upload_images_only_off" name="settings[filemanager_upload_images_only]" value="1"<?php if($settings['filemanager_upload_images_only'] == '1') echo ' checked="checked"'; ?>>
                        </label>
                    </li>
                    <li>
                        <label for="filemanager_upload_size"><?php echo __('Max. upload file size'); ?></label>
                        <input type="number" id="filemanager_upload_size" name="settings[filemanager_upload_size]" size="3" value="<?php echo $settings['filemanager_upload_size']; ?>" />&nbsp;Mb
                        <p class="help"><?php echo __("Maximum file size in Mb or 0 to use the server's setting, please note it won't replace the server limitation."); ?></p>
                    </li>
                    <li>
                        <h3><?php echo __('Allowed images extension'); ?></h3>
                        <?php
                            $fm_img = isset($settings['filemanager_images']) ? unserialize($settings['filemanager_images']) : array() ;
                            $img_ext = array('gif', 'jpg', 'jpeg', 'png');
                        ?>
                        <?php foreach($img_ext as $ie): ?>
                        <label for="filemanager_images_<?php echo $ie; ?>">
                            <input type="checkbox"  id="filemanager_images_<?php echo $ie; ?>" name="settings[filemanager_images][]" value="<?php echo $ie; ?>"<?php if(in_array($ie, $fm_img)) echo ' checked="checked"'; ?>>
                            <?php echo ucwords($ie); ?>
                        </label>
                        <?php endforeach; ?>
                </ul>
            </fieldset>
        </li>
    </ul>

    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
    </p>
</form>