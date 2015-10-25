<?php defined('IN_CMS') || exit();

$images = serialize(array('gif', 'jpg', 'jpeg', 'png'));

$settings = array(
    'version'               => '2.1.0',
    /* Filemanager */
    'filemanager_enabled'   => '1',
    'filemanager_base'      => 'public/images',
    'filemanager_view'      => 'grid',
    'filemanager_images'    => $images,
    'filemanager_dateformat'         => 'd M Y H:i',
    'filemanager_browse_only'        => '0',
    'filemanager_upload_overwrite'   => '0',
    'filemanager_upload_images_only' => '0',
    'filemanager_upload_size'        => '0'
);

$old = Plugin::getAllSettings('ckeditor');

//Other ckeditor filter
if(isset($old['fileBrowserRootUri'])) {
    $settings['filemanager_base']    = trim($old['fileBrowserRootUri'],'/');    
}
// Update from previous release
else if(isset($old['filemanager_base'])) {
    $settings = $old;
    $settings['version'] = '2.1.0';
}

// Remove all settings from db
Plugin::deleteAllSettings('ckeditor');

// Insert the new ones
if (Plugin::setAllSettings($settings, 'ckeditor'))
    Flash::setNow('success', __('CKEditor - plugin settings initialized.'));
    if(!defined('USE_MOD_REWRITE') || !USE_MOD_REWRITE) {
        Flash::set('info', __('FileManager will not ne ebabled if "MOD_REWRITE" is set to false'));
    }
else
    Flash::setNow('error', __('CKEditor - unable to store plugin settings!'));