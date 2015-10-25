<?php defined('IN_CMS') || exit();

// Delete settings from db
if (Plugin::deleteAllSettings('ckeditor'))
    Flash::set('success', __('CKEditor - plugin uninstalled successfully.'));
else
    Flash::set('error', __('CKEditor - unable to delete plugin settings!'));