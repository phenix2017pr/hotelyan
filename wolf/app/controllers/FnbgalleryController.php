<?php

class FnbgalleryController extends Controller
{

    public static function _checkPermission()
    {
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn())
        {
            redirect(get_url('login'));
        }
        else if ( ! AuthUser::hasPermission('administrator,developer,editor'))
        {
//             Flash::set('error', __('You do not have permission to access the requested page!'));
//             redirect(get_url());
        }
    }

    public function __construct()
    {
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn()){
            redirect(get_url('login'));
    	}

        $this->setLayout('backend');
    	$this->assignToLayout('sidebar', new View('fnbgallery/sidebar'));
    }

    public function index() {
         $this->browse();
    }

    public function edit($id) {
        if ( ! $fnbgallery = FnbGallery::findById($id)) {
            Flash::set('error', __('Image is not found!'));
            redirect(get_url('fnbgallery'));
        }

        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);

        $this->display('fnbgallery/view', array(
            'fnbgallery' => $fnbgallery
        ));
    }

    private function _edit($id){

        $data = $_POST['fnbgallery'];

        $data['id'] = $id;
        $fnbgallery = new FnbGallery($data);

        if ( ! $fnbgallery->save()){
            Flash::set('error', __('FnbGallery could not be saved.'));
            redirect(get_url('fnbgallery/view/'.$id));
        } 
        else
            Flash::set('success', __('FnbGallery has been saved.'));

        // save and quit or save and continue editing?
		if (isset($_POST['commit']))
            redirect(get_url('fnbgallery'));
        else
            redirect(get_url('fnbgallery/view/'.$id));
    }


    public function browse(){
        $this->_checkPermission();

        /* Pagination */
		if (isset($_GET['page'])) {
			$CurPage = $_GET['page'];
		} else {
			$CurPage = 0;
		}
		$rowspage = 20;
		$start = $CurPage * $rowspage;

		$totalrecords =  Record::countFrom('FnbGallery');
		$galleries = Record::query('select g.*,a.name as album_name from '.TABLE_PREFIX.'album a, '.TABLE_PREFIX.'fnbgallery g where a.id=g.album_id ORDER BY a.id, g.sequence LIMIT ' . $start . ',' . $rowspage);
		$lastpage = ceil($totalrecords / $rowspage);
		if($totalrecords <= $rowspage) { $lastpage = 0; } else { $lastpage = abs($lastpage - 1); }
		/* End Pagination */

		$this->display('fnbgallery/index', array(
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position'),
			'galleries' => $galleries,
			'CurPage' => $CurPage,
			'lastpage' => $lastpage,
			'albums' => Record::query('select * from '.TABLE_PREFIX.'album ORDER BY page_id,sequence,date_added desc,id'),
			'select_albums' => Record::query('select * from '.TABLE_PREFIX.'album ORDER BY page_id,sequence,date_added desc,id')
        ));
    } // browse

    public function upload(){
        $this->_checkPermission();
        $data = $_POST['fnbgallery'];
        $overwrite = isset($data['overwrite']) ? true: false;
		$overwrite  = false;

        $aid = $data['album_id'];

		if (isset($_FILES))
        {

            //Check image dimensions and image portrait or landscape
            list($imgwidth, $imgheight) = getimagesize($_FILES['upload_file']['tmp_name']);                                
            $aspect = $imgheight / $imgwidth;
            if($aspect >= 1)
                $imgtype = "portrait";
            else 
                $imgtype = "landscape";  
            //Check image dimensions and image portrait or landscape

            $file = $this->upload_file($_FILES['upload_file']['name'], FILES_DIR.'/fnb/gallery/'.$aid.'/', $_FILES['upload_file']['tmp_name'], $overwrite,$aid,$imgtype,$imgwidth,$imgheight);

        if ($file === false)
               Flash::set('error', __('File has not been uploaded!'));
        }
        if($_POST['from_page']=='view_album')
            redirect(get_url('fnbgallery/view_album/'.$aid));
        else
            redirect(get_url('fnbgallery'));
    }

	function upload_file($origin, $dest, $tmp_name, $overwrite=false,$aid,$imgtype="portrait",$imgwidth,$imgheight){
	    FileManagerController::_checkPermission();
	    $origin = basename($origin);
	    $full_dest = $dest.$origin;
	    $file_name = $origin;
	    for ($i=1; file_exists($full_dest); $i++)
	    {
	        if ($overwrite)
	        {
	            unlink($full_dest);
	            continue;
	        }

	        $file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
	        $file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
	        $full_dest = $dest.$file_name;
	    }

	    // create new directory
		if (mkdir($dest)){ chmod($dest, 0777); }


	    if (move_uploaded_file($tmp_name, $full_dest))
	    {

            //Resized thumbnail w=767 for fnbgallery thumb
            $thumb_file_name = '767x575_'.$file_name;
            if($imgtype=="landscape"){
                $thumb_url = URL_PUBLIC.'wolfimage?src=public/fnb/gallery/'.$aid.'/'.$file_name.'&h=575';
            }else{
                $thumb_url = URL_PUBLIC.'wolfimage?src=public/fnb/gallery/'.$aid.'/'.$file_name.'&w=767';
            }
            $thumb_image = FILES_DIR.'/fnb/gallery/'.$aid.'/'.$thumb_file_name;
            if(file_put_contents($thumb_image, file_get_contents($thumb_url))){
                //Crop resized thumbnail for w=767 for fnbgallery thumb
                $thumb_url_crop = URL_PUBLIC.'wolfimage?src=public/fnb/gallery/'.$aid.'/'.$thumb_file_name.'&w=767&h=575&c=c';
                $thumb_image_crop = FILES_DIR.'/fnb/gallery/'.$aid.'/'.$thumb_file_name;
                file_put_contents($thumb_image_crop, file_get_contents($thumb_url_crop));
            }

	    	//Add Image to database
            $data = $_POST['fnbgallery'];
            Flash::set('post_data', (object) $data);

            $oFnbGallery = new FnbGallery();
            $last_seq = $oFnbGallery->getLastFnbGallerySeq($aid);

            $fnbgallery = new FnbGallery($data);
            $fnbgallery->filename = $file_name;
            $fnbgallery->sequence = $last_seq+1;

            if ( ! $fnbgallery->save()) {
                Flash::set('error', __('Image could not be added!'));
                redirect(get_url('fnbgallery'));
            }
            else {
                Flash::set('success', __('Image has been added.'));
            }

	        // change mode of the dire to 0644 by default
	        chmod($full_dest, 0644);
	        return $file_name;
	    }

	    return false;
	} // upload_file

	public function _getPermissions($file){
        $perms = fileperms($file);

        if (($perms & 0xC000) == 0xC000) {
            // Socket
            $info = 's';
        } elseif (($perms & 0xA000) == 0xA000) {
            // Symbolic Link
            $info = 'l';
        } elseif (($perms & 0x8000) == 0x8000) {
            // Regular
            $info = '-';
        } elseif (($perms & 0x6000) == 0x6000) {
            // Block special
            $info = 'b';
        } elseif (($perms & 0x4000) == 0x4000) {
            // Directory
            $info = 'd';
        } elseif (($perms & 0x2000) == 0x2000) {
            // Character special
            $info = 'c';
        } elseif (($perms & 0x1000) == 0x1000) {
            // FIFO pipe
            $info = 'p';
        } else {
            // Unknown
            $info = 'u';
        }

        // Owner
        $info .= (($perms & 0x0100) ? 'r' : '-');
        $info .= (($perms & 0x0080) ? 'w' : '-');
        $info .= (($perms & 0x0040) ?
                 (($perms & 0x0800) ? 's' : 'x' ) :
                 (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $info .= (($perms & 0x0020) ? 'r' : '-');
        $info .= (($perms & 0x0010) ? 'w' : '-');
        $info .= (($perms & 0x0008) ?
                 (($perms & 0x0400) ? 's' : 'x' ) :
                 (($perms & 0x0400) ? 'S' : '-'));

        // World
        $info .= (($perms & 0x0004) ? 'r' : '-');
        $info .= (($perms & 0x0002) ? 'w' : '-');
        $info .= (($perms & 0x0001) ?
                 (($perms & 0x0200) ? 't' : 'x' ) :
                 (($perms & 0x0200) ? 'T' : '-'));

        return array($info, substr(sprintf('%o', $perms), -4, 4)); // (perm, chmod)
    } // _getPermissions

    public function view() {
        $this->_checkPermission();
        $params = func_get_args();
        $content = '';

        $id = urldecode(join('/', $params));
        $fnbgallery = Record::findByIdFrom('FnbGallery', $id);

        $file = FILES_DIR.'/fnb/gallery/'.$fnbgallery->album_id.'/'.$fnbgallery->filename;
        if ( ! $this->_isImage($file) && file_exists($file))
        {
            $content = file_get_contents($file);
        }

        $this->display('fnbgallery/view', array(
            'content'  => $content,
            'fnbgallery' => $fnbgallery,
            'albums' => Record::query('select * from '.TABLE_PREFIX.'album ORDER BY date_added desc,id')
        ));
    }

    public function _isImage($file) {
        if ( ! @is_file($file))
            return false;
        else if ( ! preg_match('/^(.*).(jpe?g|gif|png)$/i', $file))
            return false;

        return true;
    }

    function delete() {
        $this->_checkPermission();
        $paths = func_get_args();

        $id = urldecode(join('/', $paths));

        $fnbgallery = Record::findByIdFrom('FnbGallery', $id);

        $file = FILES_DIR.'/fnb/gallery/'.$fnbgallery->album_id.'/'.$fnbgallery->filename;
        $resized_file = FILES_DIR.'/fnb/gallery/'.$fnbgallery->album_id.'/767x575_'.$fnbgallery->filename;
        $filename = array_pop($paths);
        $paths = join('/', $paths);


        if (is_file($file))
        {
            if ( ! unlink($file))
                Flash::set('error', __('Permission denied!'));
        }
        if (is_file($resized_file))
        {
            if ( ! unlink($resized_file))
                Flash::set('error', __('Permission denied!'));
        }
        
        // find the banner to delete
        if ($fnbgallery = Record::findByIdFrom('FnbGallery', $id))
        {
            if ($fnbgallery->delete()) {
                Flash::set('success', __('This image has been deleted.'));
            }
            else
                Flash::set('error', __('This image could not be deleted!'));
        }
        else Flash::set('error', __('Image is not found!'));

        redirect(get_url('fnbgallery'));
    }

	public function createalbum(){
	    $this->_checkPermission();

		$album_name = $_POST['album_name'];
        $sequence = $_POST['sequence'];
 		$page_id = $_POST['page_id'];

	    if($album_name!=""){
	     	Record::query("Insert into ".TABLE_PREFIX."album VALUES(0,'".(int)$page_id."','".addslashes($album_name)."','1','".$sequence."','".date("Y-m-d")."')");

			if (isset($_FILES)) {
				$PDO = Record::getConnection();
				$last_id = $PDO->lastInsertId();

				//Create album folder
				$album_dir = FILES_DIR.'/fnb/gallery/'.$last_id;
				if(mkdir($album_dir)){
					chmod($album_dir, 0777);
				}
			}

	     	Flash::set('success', __('Album has been created.'));
     	}else{
	     	Flash::set('error', __('Album name is empty.'));
     	}

	     redirect(get_url('fnbgallery'));
    }

    function delete_album(){
        $this->_checkPermission();
        $paths = func_get_args();

        $id = urldecode(join('/', $paths));

         //Remove folders and all images
        $dir = FILES_DIR.'/fnb/gallery/'.$id.'/';
		foreach(glob($dir.'*.*') as $v){
			unlink($v);
		}
	    rmdir($dir);
    	// End remove folders and all images

        $galleries = Record::findAllFrom('FnbGallery','album_id="'.$id.'"');
        if(count($galleries)>0){
	        foreach($galleries as $fnbgallery){
		        // find the image to delete
				if ($delete_fnbgallery = Record::findByIdFrom('FnbGallery', $fnbgallery->id)) {
					$delete_fnbgallery->delete();
				}
	        }
    	}

    	$album = Record::query('DELETE from '.TABLE_PREFIX.'album where id="'.$id.'"');
        $album->execute();

        Flash::set('success', __('This album has been deleted.'));

        redirect(get_url('fnbgallery'));
    }

    public function view_album(){
        $this->_checkPermission();
        $paths = func_get_args();

        $id = urldecode(join('/', $paths));

        $albums = Record::query('select * from '.TABLE_PREFIX.'album where id="'.$id.'"');
        $album = $albums->fetchObject();

        /* Pagination */
        if (isset($_GET['page'])) {
            $CurPage = $_GET['page'];
        } else {
            $CurPage = 0;
        }
        $rowspage = 20;
        $start = $CurPage * $rowspage;

        $totalrecords =  Record::countFrom('FnbGallery','album_id="'.$id.'"');
        $galleries = Record::query('select * from '.TABLE_PREFIX.'fnbgallery g where g.album_id = "'.$id.'" ORDER BY g.sequence LIMIT ' . $start . ',' . $rowspage);
        $lastpage = ceil($totalrecords / $rowspage);
        if($totalrecords <= $rowspage) { $lastpage = 0; } else { $lastpage = abs($lastpage - 1); }
        /* End Pagination */


        $this->display('fnbgallery/view_album', array(
            'album' => $album,
            'CurPage' => $CurPage,
            'lastpage' => $lastpage,
            'galleries' => $galleries,
            'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
        ));

    }

    public function edit_album($id){
	    if($_POST["action"]=="edit"){
		    $album_name = $_POST['album_name'];
		    $page_id = $_POST['page_id'];
		    $status = $_POST['status'];
		    $date_added = date("Y-m-d",strtotime($_POST['date_added']));

		    $album=Record::query('Update '.TABLE_PREFIX.'album set page_id="'.$page_id.'",name ="'.$album_name.'", status="'.$status.'",date_added="'.$date_added.'" where id="'.$id.'"');
		    $album->execute();
			Flash::set('success', __('This album has been updated.'));

	     	if (isset($_POST['commit']))
            	redirect(get_url('fnbgallery'));
       		else
            	redirect(get_url('fnbgallery/view_album/'.$id));
        }
    }

    public function save_order(){
		$fnbgallery_array = $_POST['fnbgallery_id'];
		$order_array = $_POST['order'];

		$fnbgallery = new FnbGallery;
		foreach($fnbgallery_array as $key => $value){
			$fnbgallery_id = $value;
			$fnbgallery_order = $order_array[$key];

			$fnbgallery->update('FnbGallery', array('sequence' => $fnbgallery_order), 'id='.$fnbgallery_id);
		}
		Flash::set('success', __('This fnbgallery sequence has been saved.'));
        if($_POST['album_id'] > 0)
		  redirect(get_url('fnbgallery/view_album/'.$_POST['album_id']));
        else
          redirect(get_url('fnbgallery'));
    }

    public function save_album_order(){
        $album_array = $_POST['album_id'];
        $order_array = $_POST['order'];

        // $fnbgallery = new FnbGallery;
        foreach($album_array as $key => $value){
            $album_id = $value;
            $album_order = $order_array[$key];

            Record::query("Update wolf_album SET sequence='".$album_order."' WHERE id='".$album_id."'");
        }
        Flash::set('success', __('This album sequence has been saved.'));
        redirect(get_url('fnbgallery'));
    }

}

?>