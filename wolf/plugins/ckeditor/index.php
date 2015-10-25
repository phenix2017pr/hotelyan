<?php defined('IN_CMS') || exit();

Plugin::setInfos(array(
    'id'                    => 'ckeditor',
    'title'                 => __('CKEditor'),
    'description'           => __('CKEditor Wysiwyg filter'),
    'version'               => '2.1.2',
    'license'               => 'GPLv3',
    'author'                => 'andrewmman',
    'website'               => 'http://www.wolfcms.org/forum/topic1957.html',
    'update_url'            => 'http://andrewmman.byethost7.com/wolfplugins.xml',
    'require_wolf_version'  => '0.7.5',
    'type'                  => 'both'
));

Filter::add('ckeditor', 'ckeditor/filter/Ckeditor.php');
Plugin::addController('ckeditor', 'CKEditor', '', false);

AutoLoader::addFile('CkeditorPublicController',  PLUGINS_ROOT.DS.'ckeditor'.DS.'classes'.DS.'CkeditorPublicController.php');
AutoLoader::addFile('CkeditorPluginsController', PLUGINS_ROOT.DS.'ckeditor'.DS.'CkeditorPluginsController.php');

if (AuthUser::isLoggedIn()) {

    $CKFILTER_URI = '/wolf/plugins/ckeditor/';
    $CKPLUGINS_URI = $CKFILTER_URI.'plugins/';

    // Routes needed by the filter to fetch user setup/settings and use filemanager
    Dispatcher::addRoute(array(
        $CKFILTER_URI.'ckeditor_config.js' => 'plugin/ckeditor/ck_config',
        $CKFILTER_URI.'filemanager/:any'   => 'plugin/ckeditor/filemanager/$1'
    ));

    // Routes for custom plugins using CkeditorPluginsController
    Dispatcher::addRoute(array(
        $CKPLUGINS_URI.'wolf_pages.js' => 'ckeditor_plugins/wolf_pages'/*,
        $CKPLUGINS_URI.'my_plugin.js'  => 'ckeditor_plugins/my_action'*/
    ));

}

Observer::observe('dispatch_route_found','ckeditor_filter_setup');

function ckeditor_filter_setup() {
    $config_path = (USE_MOD_REWRITE) ? 'ckeditor/' : '../../?/wolf/plugins/ckeditor/';
    $controllers = '(page|snippet)';
    $actions = '(add|edit)';
    $pattern = '/^'.ADMIN_DIR.'\/'.$controllers.'\/'.$actions.'/';

    if (preg_match($pattern, CURRENT_URI)) {
        Plugin::addJavascript('ckeditor', 'scripts/ckeditor/ckeditor.js');
        Plugin::addJavascript('ckeditor', 'scripts/init.js');
        /* nasty way of including scripts */
        Plugin::$javascripts[] = $config_path.'ckeditor_config.js';
        // load it AFTER ckeditor_config!
//         Plugin::addJavascript('ckeditor', 'scripts/user/config.js');
    }

}