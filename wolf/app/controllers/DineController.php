<?php

class DineController extends Controller
{

    public static function _checkPermission()
    {
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn())
        {
            redirect(get_url('login'));
        }
    }

    public function __construct()
    {
        AuthUser::load();
        if ( ! AuthUser::isLoggedIn()){
            redirect(get_url('login'));
    	}

        $this->setLayout('backend');
    	$this->assignToLayout('sidebar', new View('dine/sidebar'));
    }

    public function index()
    {
         $this->browse();
    }

    public function view(){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));
		$mydine = Record::query('select * from '.TABLE_PREFIX.'dine where id="'.$id.'"');
		$dine = $mydine->fetchObject();

		$this->display('dine/view', array(
			'dine' => $dine
		));
	}

	public function create(){
		$this->_checkPermission();
		$paths = func_get_args();

		$this->display('dine/create');
	}

   	public function add_dine(){
	 	$this->_checkPermission();

		$data = $_POST['dine'];
		Flash::set('postdata', $data);

		$image = $_POST['upload'];
		$path = str_replace('..', '', $image['path']);
		$overwrite = false;

		// verification
		if (empty($data['title'])){
			Flash::set('error', __('You have to specify a dine title!'));
			redirect(get_url('dine/create'));
		}
		
		
		if (isset($_FILES)) {
			// no image file selected
			if(empty($_FILES['upload_file']['name'])){
				Flash::set('error', __('You have to select a image to be uploaded!'));
				redirect(get_url('dine/create'));
			}
		}
		else {
			Flash::set('error', __('You have to select a image to be uploaded!'));
			redirect(get_url('dine/create'));
		}

		$dine = new Dine($data);		
		$dine->created_by_id = AuthUser::getId();
		$dine->created_on = date('Y-m-d H:i:s');
		if (!$dine->save()) {
			Flash::set('error', __('Dine is not added!'));
			redirect(get_url('dine/create'));
		}
		else {
			if (isset($_FILES)) {
				$dine_id = $dine->lastInsertId();

				$file = $this->upload_file($_FILES['upload_file']['name'], FILES_DIR.'/dine/images/', $_FILES['upload_file']['tmp_name'], $overwrite,$dine_id);
				if ($file === false) {
					Flash::set('error', __('Dine image has not been uploaded!'));
				}
				
				//Add Image to database
				$data = $_POST['dine'];
				Flash::set('post_data', (object) $data);
				$dine = Record::findByIdFrom('Dine', $dine_id);
				if ( ! $dine->update('Dine', array('filename' => $file), 'id='.$dine_id))	{
					Flash::set('error', __('Image has not been updated.'));
				}
				else {
					Flash::set('success', __('Dine has been updated!'));

					if (isset($_POST['commit']))
						redirect(get_url('dine'));
					else
						redirect(get_url('dine/view/' . $dine->id));
				}
			}
			Flash::set('success', __('Dine has been added!'));
		}
		redirect(get_url('dine'));
   	}

 	public function edit($id){
	    if($_POST["action"]=="edit"){
		    $data = $_POST['dine'];
		    Flash::set('postdata', $data);

		   	$dine = Record::findByIdFrom('Dine', $id);
			if (!$dine) {
				Flash::set('error', __('Dine could not be found!'));
				redirect(get_url('dine'));
			}

			$save = true;
		    // verification
			if (empty($data['title'])){
				Flash::set('error', __('You have to specify a dine title!'));
				redirect(get_url('dine/view/'.$id));
			}
			
			$dine->setFromData($data);
			$dine->updated_by_id = AuthUser::getId();
			$dine->updated_on = date('Y-m-d H:i:s');
			if (!$dine->save()) {
				 Flash::set('error', __('Dine is not updated!'));
				 redirect(get_url('dine/view/'.$id));
			}
			else {
				$this->upload($id);
				Flash::set('success', __('Dine has been updated!'));

				if (isset($_POST['commit']))
					redirect(get_url('dine'));
				else
					redirect(get_url('dine/view/'.$id));
			}
        }
    }

    public function add() {
		// check if trying to save
		if (get_request_method() == 'POST')
			return $this->_add();

		// check if user have already enter something
		$dine = Flash::get('post_data');

		if (empty($dine))
			$dine = new Dine;

		$this->browse();
	}

	public function upload($nid){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$overwrite=false;

		if (isset($_FILES))
		{
			$dine = Record::findByIdFrom('Dine', $nid);
			
			//For dine image
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/dine/images/'.$_FILES['upload_file']['tmp_name'])){
				//Remove existing image
				$exist_dine = Record::query('Select filename as select_image from '.TABLE_PREFIX.'dine where id="'.$nid.'"');
				$exist_new = $exist_dine->fetchObject();
				$old_file_name = $exist_new->select_image;
				if(file_exists(FILES_DIR.'/dine/images/'.$old_file_name) && $old_file_name!=""){
					unlink(FILES_DIR.'/dine/images/'.$old_file_name);
				}

				$file = $this->upload_file($_FILES['upload_file']['name'], FILES_DIR.'/dine/images/', $_FILES['upload_file']['tmp_name'], $overwrite,$nid);

				if ($file === false)
					Flash::set('error', __('Dine image has not been uploaded!'));
			} else {
				$file = $dine->filename;
			}
		   
			//Add Image to database
			$data = $_POST['dine'];
			Flash::set('post_data', (object) $data);
			
			if ( ! $dine->update('Dine', array('filename' => $file), 'id='.$nid))	{
				Flash::set('error', __('Image has not been updated.'));
			}
			else {
				Flash::set('success', __('Dine has been updated!'));

				if (isset($_POST['commit']))
					redirect(get_url('dine'));
				else
					redirect(get_url('dine/view/' . $dine->id));
			}
		}
	}

	function upload_file($origin, $dest, $tmp_name, $overwrite=false,$nid=null){
		FileManagerController::_checkPermission();
		$origin = basename($origin);
		$full_dest = $dest.$origin;
		$file_name = $origin;

		for ($i=1; file_exists($full_dest); $i++)
		{
			if ($overwrite) {
				unlink($full_dest);
				continue;
			}
			$file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
			$file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
			$full_dest = $dest.$file_name;
		}

		if (move_uploaded_file($tmp_name, $full_dest)) {			
			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file

    public function browse(){

        $this->_checkPermission();
        $params = func_get_args();

        $this->path = join('/', $params);
        // make sure there's a / at the end
        if (substr($this->path, -1, 1) != '/') $this->path .= '/';

        //security

        // we dont allow back link
        if (strpos($this->path, '..') !== false)
        {
            if (Plugin::isEnabled('statistics_api'))
            {
                $user = null;
                if (AuthUser::isLoggedIn())
                    $user = AuthUser::getUserName();
                $ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR']:($_SERVER['REMOTE_ADDR']);
                $event = array('event_type'  => 'hack_attempt',            // simple event type identifier
                               'description' => __('A possible hack attempt was detected.'), // translatable description
                               'ipaddress'   => $ip,
                               'username'    => $user);
                Observer::notify('stats_file_manager_hack_attempt', $event);
            }
        }

        $this->fullpath = FILES_DIR.'/themes/dine/images/';
        // clean up nicely
        $this->fullpath = preg_replace('/\/\//', '/', $this->fullpath);

        $dine_arr = Record::query('select * from '.TABLE_PREFIX.'dine ORDER BY sequence,id desc');

        $this->display('dine/index', array(
            'dir'   => $this->path,
            'files' => $this->_getListFiles(),
            'dine_arr' => $dine_arr
        ));
		
    } // browse

     public function _getListFiles(){
        $files = array();

        if (is_dir($this->fullpath) && $handle = opendir($this->fullpath))
        {
            $i = 0;
            // check each files ...
            while (false !== ($file = readdir($handle)))
            {
                // do not display . and the root ..
                if ($file == '.' || $file == '..')
                    continue;

                $object = new stdClass;
                $file_stat = stat($this->fullpath.$file);

                // make the link depending on if it's a file or a dir

                $object->is_dir = false;
                $object->is_file = true;
                $object->link = '<a href="'.get_url('dine/view'.$this->path.$file).'">'.$file.'</a>';

                $object->name = $file;
                // humain size
                $object->size = convert_size($file_stat['size']);
                // permission
                list($object->perms, $object->chmod) = $this->_getPermissions($this->fullpath.$file);
                // date modification
                $object->mtime = date('D, j M, Y', $file_stat['mtime']);

                $files[$object->name] = $object;

                $i++;
            } // while
            closedir($handle);
        }

        uksort($files, 'strnatcmp');
        return $files;
    } // _getListFiles

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

    public function _isImage($file) {
        if ( ! @is_file($file))
            return false;
        else if ( ! preg_match('/^(.*).(jpe?g|gif|png)$/i', $file))
            return false;

        return true;
    }

    function delete(){
        $this->_checkPermission();
        $paths = func_get_args();

        $id = urldecode(join('/', $paths));
		$dine = Record::findByIdFrom('Dine', $id);

		//Remove folders and all images
        $dir = FILES_DIR.'/dine/images/'.$dine->filename;
		unlink($dir);
		// End remove folders and all images

        if ($dine->delete()) {
            Flash::set('success', __('This dine has been deleted.'));
        }
        else
        	Flash::set('error', __('This dine could not be deleted!'));

        redirect(get_url('dine'));
    }

    public function save_order(){
        $dine_array = $_POST['dine_id'];
        $order_array = $_POST['order'];

        $dine = new Dine;
        foreach($dine_array as $key => $value){
            $dine_id = $value;
            $dine_order = $order_array[$key];

            $dine->update('Dine', array('sequence' => $dine_order), 'id='.$dine_id);
        }
        Flash::set('success', __('This dine sequence has been saved.'));
        redirect(get_url('dine'));
    }
}
?>