<?php defined('IN_CMS') || exit();


class CkeditorController extends PluginController {

    public function __construct() {
        // Check if logged in
        parent::__construct();
        if( defined('CMS_BACKEND')) {
            $this->setLayout('backend');
        }
        else {
            $this->setLayout(null);
        }
    }

    public function index() {
        $this->settings();
    }

    public function documentation() {
        $lang = strtolower(I18n::getLocale());
        // Check for localized documentation or fallback to the default english and display notice
        if( !file_exists(PLUGINS_ROOT.DS.'ckeditor'.DS.'views/admin/documentation/'.$lang.'.php') ) {
            $message = __("There's no translation for the documentation in your language, displaying the default english.");
            $this->display('documentation/en', array( 'message' => $message ));
        }
        else
            $this->display('documentation/'.$lang);
	}

    public function settings() {
        $errors = false;

        if(get_request_method() == 'POST') {
            $data = $_POST['settings'];
            $settings = array();

            $settings['filemanager_base'] = preg_replace('/\s+/','', $data['filemanager_base']);
            $settings['filemanager_base'] = trim($settings['filemanager_base'], '/');

            $settings['filemanager_view'] = isset($data['filemanager_view']) ? $data['filemanager_view'] : 'grid';

            // image extensions
            if(isset($data['filemanager_images'])) {
                $settings['filemanager_images'] = serialize($data['filemanager_images']);
            }
            else {
                $errors[] = __("You need to select at least one image extension!");
            }

            $settings['filemanager_upload_size'] = ( ! empty($data['filemanager_upload_size']) && is_numeric($data['filemanager_upload_size'])) ? $data['filemanager_upload_size'] : '0';
            $settings['filemanager_dateformat'] = ! empty($data['filemanager_dateformat']) ? trim($data['filemanager_dateformat']) : 'd M Y H:i';

            $booleans = array(
                //'urlbrowser_enabled',
                //'urlbrowser_hidden',
                'filemanager_enabled',
                //'filemanager_thumbs',
                'filemanager_browse_only',
                'filemanager_upload_overwrite',
                'filemanager_upload_images_only'
            );
            foreach($booleans as $bool) {
                $settings[$bool] = ( isset($data[$bool]) && $data[$bool] == 1) ? '1' : '0';
            }
            if(Plugin::setAllSettings($settings,'ckeditor')) {
                Flash::setNow('success', 'Settings were updated successfully');
            }
            else {
                $errors[] = __("There was a problem saving the settings.");
            }
        }
        else {
            $settings = Plugin::getAllSettings('ckeditor');
        }

        if($errors !== false) {
            Flash::setNow('error', implode('<br/>', $errors));
        }

        $this->display('settings', array( 'settings' => $settings ));
    }

    // Outputs ckeditor config.js
    public function ck_config() {
        $settings = Plugin::getAllSettings('ckeditor') or array();
        $i18n = $this->_ckeditor_lang();

        $settings['lang'] = $i18n['lang'];
        $settings['dir']  = $i18n['dir'];

        if(empty($settings)) {
            $settings['filemanager_enabled'] = true;
            $settings['filemanager_root'] = CMS_ROOT.DS.'public';
        }
        else {
            $settings['filemanager_root'] = CMS_ROOT.DS.trim($settings['filemanager_base'],'/');
        }

        header("Content-type: application/x-javascript; charset=utf8");
        $this->display('ckeditor_config', array('settings' => $settings) );
    }

    // Outputs filemanager.config.js
    public function filemanager($params) {

        $settings = Plugin::getAllSettings('ckeditor') or array();
        // Set translation if available
        $settings['lang'] = $this->_filemanager_lang();
        // Set defaults
        if(empty($settings)) {
            $settings['filemanager_view'] = 'grid';
            $settings['filemanager_browse_only'] = false;
            $settings['filemanager_base'] = rtrim(URL_PUBLIC,'/').'/public';
            $settings['filemanager_thumbs']  = true;
            $settings['filemanager_images']  = array('gif','jpg','jpeg','png');
        }

        header("Content-type: text/html; charset=utf8");
        $this->display('fm_index', array('settings' => $settings) );
    }

    // define ckeditor i18n depending on available translations
    private function _ckeditor_lang(){
        $tmp = I18n::getLocale();
        $iso = strtolower($tmp);
        // ckeditor available translations
        // alpha2 => is_rtl, rtl_scripts (ar, fa, he)
        $translations = array(
            'af' => 0, 'ar' => 1,
            'bg' => 0, 'bn' => 0, 'bs' => 0,
            'ca' => 0, 'cs' => 0, 'cy' => 0,
            'da' => 0, 'de' => 0,
            'el' => 0, 'en' => 0, 'eo' => 0, 'es' => 0, 'et' => 0, 'eu' => 0,
            'fa' => 1, 'fi' => 0, 'fo' => 0, 'fr' => 0,
            'gl' => 0, 'gu' => 0,
            'he' => 1, 'hi' => 0, 'hr' => 0, 'hu' => 0,
            'is' => 0, 'it' => 0,
            'ja' => 0,
            'ka' => 0, 'km' => 0, 'ko' => 0,
            'lt' => 0, 'lv' => 0,
            'mn' => 0, 'ms' => 0,
            'nb' => 0, 'nl' => 0, 'no' => 0,
            'pl' => 0, 'pt' => 0,
            'ro' => 0, 'ru' => 0,
            'sk' => 0, 'sl' => 0, 'sr' => 0, 'sv' => 0,
            'th' => 0, 'tr' => 0,
            'uk' => 0,
            'vi' => 0,
            'zh' => 0
        );

        $lang = array_key_exists($iso, $translations) ? $iso : 'en';
        $dir = ( (bool)$translations[$lang] ) ? 'rtl' : 'ltr';
        return array( 'lang' => $lang, 'dir' => $dir );
    }

    // define filemanager i18n depending on available translations
    private function _filemanager_lang() {
        $trans =  array( 'ca','cs','da','de','en','es','fi','fr','he','hu','it','ja','nl','pl','pt','ru','sv','tr','vn','cn');
        $user_lang = I18n::getLocale();
        $lang = in_array($user_lang, $trans) ? $user_lang : 'en' ;
        if($lang == 'cn')
            $lang = 'zh-cn';
        return $lang;
    }

    // render method will use our views path ( backend or frontend )
    public function render($view, $vars=array()) {
        $views_path = PLUGINS_ROOT.DS.'ckeditor'.DS.'views'.DS.'filter';

        if (defined('CMS_BACKEND')) {
            $views_path .= DS.'admin';
            if( !empty($this->layout) ) {
                // We assign our Views as content already rendered
                $this->assignToLayout('content_for_layout', new View($views_path.DS.$view, $vars));
                // and render the backend layout as usual
                return new View('../layouts/'.$this->layout, $this->layout_vars);
            }
            else {
                return new View($views_path.DS.$view, $vars);
            }
        }
        else {
            $views_path .= DS.'public';
            return parent::render($views_path.DS.$view,$vars);
        }
    }

    public function display($view, $vars=array(), $exit=true) {
        echo $this->render($view, $vars);
        if ($exit) exit;
    }

}