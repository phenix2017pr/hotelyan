<?php defined('IN_CMS') || exit();


class CkeditorPluginsController extends CkeditorPublicController {

    // Outputs wolf pages for link dialog
    public function wolf_pages() {
        $root = Page::findByUri('/');
        $pages = array();
        $pages[] = array('title' => $root->title(), 'url' => $root->url());

        $this->_wolf_pages_list($root, $pages);
        header("Content-type: application/x-javascript; charset=utf8");
        // Display our page list using view in 'views/ckeditor_plugins/wolf_pages/list.php'
        $this->display('wolf_pages/list', array('pages' => $pages));
    }

    // Support function to get the wolf_pages array
    private function _wolf_pages_list(&$page, &$pages_list) {
        if($page) {

            $childs = $page->children(array('order' => 'page.position, page.id ASC'));
            $count = count($childs);

            if($childs != false && $count > 0 ) {

                foreach($childs as $child) {
                    $pages_list[] = array('title' => str_repeat("-", $child->level()).' '.$child->title, 'url' => $child->url() );
                    $this->_wolf_pages_list($child, $pages_list);
                }

            }
        }
    }


}