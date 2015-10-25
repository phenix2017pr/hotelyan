<?php defined('IN_CMS') || exit();


class CkeditorPublicController extends Controller {

    public function __call($function, $args) {
        return false;
    }

    public function __get($var) {
        return false;
    }

    public function execute($action, $params) {
        if (substr($action, 0, 1) == '_' || ! method_exists($this, $action)) {
            exit('console.warn("Action \''.$action.'\' is not valid!");');
        }
        call_user_func_array(array($this, $action), $params);
    }

    // render method will use our views path ( backend or frontend )
    public function render($view, $vars=array()) {
        $path = PLUGINS_ROOT.DS.'ckeditor'.DS.'views'.DS.'wolf_plugins';

        if (defined('CMS_BACKEND')) {
            if( !empty($this->layout) ) {
                // We assign our Views as content already rendered
                $this->assignToLayout('content_for_layout', new View($path.DS.$view, $vars));
                // and render the backend layout as usual
                return new View('../layouts/'.$this->layout, $this->layout_vars);
            }
            else {
                return new View($path.DS.$view, $vars);
            }
        }
        else {
            return parent::render($path.DS.$view,$vars);
        }
    }

    public function display($view, $vars=array(), $exit=true) {
        echo $this->render($view, $vars);
        if ($exit) exit;
    }


    public function index() {
        die('console.log("Heloo")');
    }


}