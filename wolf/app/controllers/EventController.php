<?php

class EventController extends Controller
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
    	$this->assignToLayout('sidebar', new View('event/sidebar'));
    }

    public function index()
    {
         $this->browse();
    }

    public function view(){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));
		$myevent = Record::query('select * from '.TABLE_PREFIX.'event where id="'.$id.'"');
		$event = $myevent->fetchObject();

		$this->display('event/view', array(
			'event' => $event
		));
	}

	public function create(){
		$this->_checkPermission();
		$paths = func_get_args();

		$this->display('event/create');
	}

   	public function add_event(){
	 	$this->_checkPermission();

		$data = $_POST['event'];
		Flash::set('postdata', $data);

		$image = $_POST['upload'];
		$path = str_replace('..', '', $image['path']);
		$overwrite = false;

		// verification
		if (empty($data['title'])){
			Flash::set('error', __('You have to specify a event title!'));
			redirect(get_url('event/create'));
		}
		
		if (empty($data['url'])){
			Flash::set('error', __('You have to specify the "Read More" URL!'));
			redirect(get_url('event/create'));
		}

		if (isset($_FILES)) {
			// no image file selected
			if(empty($_FILES['upload_file']['name'])){
				Flash::set('error', __('You have to select a image to be uploaded!'));
				redirect(get_url('event/create'));
			}
		}
		else {
			Flash::set('error', __('You have to select a image to be uploaded!'));
			redirect(get_url('event/create'));
		}

		$event = new Event($data);		
		$event->created_by_id = AuthUser::getId();
		$event->created_on = date('Y-m-d H:i:s');
		if (!$event->save()) {
			Flash::set('error', __('Event is not added!'));
			redirect(get_url('event/create'));
		}
		else {
			if (isset($_FILES)) {
				$event_id = $event->lastInsertId();

				$file = $this->upload_file($_FILES['upload_file']['name'], FILES_DIR.'/event/images/', $_FILES['upload_file']['tmp_name'], $overwrite,$event_id);

				if ($file === false)
				Flash::set('error', __('File has not been uploaded!'));
			}
			Flash::set('success', __('Event has been added!'));
		}
		redirect(get_url('event'));
   	}

 	public function edit($id){
	    if($_POST["action"]=="edit"){
		    $data = $_POST['event'];
		    Flash::set('postdata', $data);

		   	$event = Record::findByIdFrom('Event', $id);
			if (!$event) {
				Flash::set('error', __('Event not found!'));
				redirect(get_url('event'));
			}

			$save = true;
		    // verification
			if (empty($data['title'])){
				Flash::set('error', __('You have to specify a event title!'));
				redirect(get_url('event/view/'.$id));
			}
			
			if (empty($data['url'])){
				Flash::set('error', __('You have to specify the "Read More" URL!'));
				redirect(get_url('event/view/'.$id));
			}

			$event->setFromData($data);
			$event->updated_by_id = AuthUser::getId();
			$event->updated_on = date('Y-m-d H:i:s');
			if (!$event->save()) {
				 Flash::set('error', __('Event is not updated!'));
				 redirect(get_url('event/view/'.$id));
			}
			else {
				$this->upload($id);
				Flash::set('success', __('Event has been updated!'));

				if (isset($_POST['commit']))
					redirect(get_url('event'));
				else
					redirect(get_url('event/view/'.$id));
			}
        }
    }

    public function add()
	{
		// check if trying to save
		if (get_request_method() == 'POST')
			return $this->_add();

		// check if user have already enter something
		$event = Flash::get('post_data');

		if (empty($event))
			$event = new Event;

		$this->browse();
	}

	public function upload($nid){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$overwrite=false;

		if (isset($_FILES))
		{
			//For event image
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/event/images/'.$_FILES['upload_file']['tmp_name'])){
				//Remove existing image
				$exist_event = Record::query('Select image as select_image from '.TABLE_PREFIX.'event where id="'.$nid.'"');
				$exist_new = $exist_event->fetchObject();
				$old_file_name = $exist_new->select_image;
				if(file_exists(FILES_DIR.'/event/images/'.$old_file_name) && $old_file_name!=""){
					unlink(FILES_DIR.'/event/images/'.$old_file_name);
				}

				$file = $this->upload_file($_FILES['upload_file']['name'], FILES_DIR.'/event/images/', $_FILES['upload_file']['tmp_name'], $overwrite,$nid);

				if ($file === false)
					Flash::set('error', __('Event image has not been uploaded!'));
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

		if (move_uploaded_file($tmp_name, $full_dest))
		{
			//Add Image to database
			$data = $_POST['event'];
			Flash::set('post_data', (object) $data);

			$event = Record::findByIdFrom('Event', $nid);
			if ( ! $event->update('Event', array('image' => $file_name), 'id='.$nid))	{
				Flash::set('error', __('Image has not been updated.'));
			}
			else {
				Flash::set('success', __('Event has been updated!'));

				if (isset($_POST['commit']))
					redirect(get_url('event'));
				else
					redirect(get_url('event/view/' . $event->id));
				}
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

        $this->fullpath = FILES_DIR.'/themes/event/images/';
        // clean up nicely
        $this->fullpath = preg_replace('/\/\//', '/', $this->fullpath);

        $events = Record::query('select * from '.TABLE_PREFIX.'event ORDER BY sequence asc, id desc');

        $this->display('event/index', array(
            'dir'   => $this->path,
            'files' => $this->_getListFiles(),
            'events' => $events
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
                $object->link = '<a href="'.get_url('event/view'.$this->path.$file).'">'.$file.'</a>';

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

		    $event = Record::findByIdFrom('Event', $id);

		    //Remove folders and all images
        $dir = FILES_DIR.'/event/images/'.$event->image;
		    unlink($dir);
    	  // End remove folders and all images

        if ($event->delete()) {
            Flash::set('success', __('This event has been deleted.'));
        }
        else
        	Flash::set('error', __('This event has not been deleted!'));

        redirect(get_url('event'));
    }

    public function save_order(){
        $event_array = $_POST['event_id'];
        $order_array = $_POST['order'];

        $event = new Event;
        foreach($event_array as $key => $value){
            $event_id = $value;
            $event_order = $order_array[$key];

            $event->update('Event', array('sequence' => $event_order), 'id='.$event_id);
        }
        Flash::set('success', __('This event sequence has been saved.'));
        redirect(get_url('event'));
    }
}
?>