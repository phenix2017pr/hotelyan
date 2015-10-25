<?php

$dirname = dirname(__FILE__);
$root = dirname($dirname.'/../../../../../../');

define('DS', DIRECTORY_SEPARATOR);
define('CMS_ROOT', realpath(dirname($root)));
define('CORE_ROOT', CMS_ROOT.DS.'wolf');
define('APP_PATH', CORE_ROOT.DS.'app');
define('PLUGINS_ROOT', CORE_ROOT.DS.'plugins');

include(CMS_ROOT.DS.'config.php');
include(CORE_ROOT.DS.'Framework.php');
include(APP_PATH.DS.'models'.DS.'AuthUser.php');
include(APP_PATH.DS.'models'.DS.'Plugin.php');

try {
    $__CMS_CONN__ = new PDO(DB_DSN, DB_USER, DB_PASS);
}
catch (PDOException $error) {
    die('DB Connection failed: '.$error->getMessage());
}
 
if ($__CMS_CONN__->getAttribute(PDO::ATTR_DRIVER_NAME) == 'mysql')
    $__CMS_CONN__->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

Record::connection($__CMS_CONN__);
Record::getConnection()->exec("set names 'utf8'");

function auth() {
    return true;
}

function filemanager_lang() {
    // filemanager available translations, fallback to 'english'
    $trans =  array( 'ca','cs','da','de','en','es','fi','fr','he','hu','it','ja','nl','pl','pt','ru','sv','vn','cn');
    $user_lang = ( $user = AuthUser::getRecord() ) ? strtolower($user->language) : 'en';
    $lang = in_array($user_lang, $trans) ? $user_lang : 'en' ;

    if($lang == 'cn')
        $lang = 'zh-cn';
    return $lang;
}

function filemanager_config() {
    $settings = Plugin::getAllSettings('ckeditor');
    $culture = filemanager_lang();
    // Set all defaults
    $config = array(
        'culture'   => $culture,
        'doc_root'  => CMS_ROOT,
        'plugin'    => null,
        'date'      => 'd M Y H:i',
        'icons'     => array(
            'path'      => 'images/fileicons/',
            'directory' => '_Open.png',
            'default'   => 'default.png'
        ),
        'unallowed_files'   => array('.htaccess'),
        'unallowed_dirs'    => array('_thumbs','.CDN_ACCESS_LOGS', 'cloudservers'),
        'upload'    => array(
            'overwrite'     => true,
            'imagesonly'    => false,
            'size'          => false
        ),
        'images'    => array('gif','jpg','jpeg','png')
    );

    // database settings
    if($settings) {
        $config['date']   = $settings['filemanager_dateformat'];
        $config['images'] = unserialize($settings['filemanager_images']);
        $config['upload']['overwrite']  = (bool) $settings['filemanager_upload_overwrite'];
        $config['upload']['imagesonly'] = (bool) $settings['filemanager_upload_images_only'];
        $config['upload']['size']       = ($settings['filemanager_upload_size'] == '0' || empty($settings['filemanager_upload_size']) ) ? false : (int) $settings['filemanager_upload_size'];
    }

    return $config;
}

date_default_timezone_set(DEFAULT_TIMEZONE);

$config = filemanager_config();