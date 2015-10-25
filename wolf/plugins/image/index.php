<?php if (!defined('IN_CMS')) { exit(); }

/**
 * Image manipulation plugin for Wolf CMS <http://www.wolfcms.org> based on the Kohana Image.
 *
 * @package Plugins
 * @subpackage image
 *
 * @author Devi Mandiri <devi[dot]mandiri[at]gmail[dot]com>
 * @license UNLICENSE - http://unlicense.org
 *
 * Kohana license refer to http://kohanaframework.org/license
 */

Plugin::setInfos(array(
	'id'	=> 'image',
	'type'	=> 'both',
	'title'	=> __('Image'),
	'description'	=> __('Image manipulation using GD library. Allows images to be resized, cropped, etc.'),
	'version'	=> '1.0.1',
	'license'	=> 'Unlicense',
	'author'	=> 'Devi Mandiri',
    'website'     => 'http://github.com/devi/wolf-image',
    'update_url'  => 'http://devi.web.id/wolf-plugin-versions.xml',
    'require_wolf_version' => '0.7.3'
));

AutoLoader::addFile('Image', PLUGINS_ROOT.'/image/image.class.php');

Plugin::addController('image','',false,false);

// manipulate image on the fly
Dispatcher::addRoute(array(
	'/wolfimage?:any' => '/plugin/image/wolfimage/$1'
));
