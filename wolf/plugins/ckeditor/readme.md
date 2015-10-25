CKEditor filter
===============

- Adds CKEditor v3.6.2 Wysiwyg + Core Five filemanager

http://ckeditor.com
https://github.com/simogeo/Filemanager

## Installation

- download plugin to the <code>../wolf/plugins/</code> directory
- unpack it and (re)name it **ckeditor**
- login to your admin area
- go to Administration->Plugins and enable it
- adjusts plugin settings to your liking

## About CKEditor configuration

- User config script 'scripts/user/config.js' 
- Editor stylesheet  'scripts/user/editor.css'
- custom stylesSet   'scripts/user/styles.js'

## About Filemanager

- Filemanager configuration is stored in db, define settings in the 'plugin/ckeditor/settings' screen
- Changes introduced, see 'scripts/filemanager/changes.md'

## Changelog

#### Version 2.1.2

- Add support for sites without MOD_REWRITE

#### Version 2.1.0

- New version to reflect merge with old ckeditor filter and new changes
- Moved user configuration files to 'scripts/user'
- Added a dedicated Controller for ckeditor plugins
- wolfpages is now under 'scripts/wolf_plugins' and use the new Controller
- Fixed wolf_pages urls

#### Version 0.1.1

- Clean up code
- Add Site pages plugin for link dialog

#### Version 0.1.0

- initial release for Wolf 0.7.5