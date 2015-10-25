<?php

class FnbController extends Controller
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
    	$this->assignToLayout('sidebar', new View('fnb/sidebar'));
    }

    public function index()
    {
    	$this->browse();
    }

    public function add()
	{
		// check if trying to save
		if (get_request_method() == 'POST')
			return $this->_add();

		// check if user have already enter something
		$data = Flash::get('post_data');
		$fnb = null;
		if (isset($data)){
			$fnb = new Fnb($data);
		}
		
		$this->display('fnb/edit', array(
			'action'  => 'add',
			'csrf_token' => SecureToken::generateToken(BASE_URL.'fnb/add'),
			'fnb' => $fnb,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
		));
	}

	private function _add() {
		use_helper('Validate');
		$data = $_POST['fnb'];
		Flash::set('fnb_postdata', $data);
		// Add pre-save checks here
		$errors = false;

		// CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'fnb/add')) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('fnb/add'));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('fnb/add'));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a fnb name!'));
			redirect(get_url('fnb/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('fnb/add'));
		}

		$new_fnb = new Fnb($data);				
		$new_fnb->created_by_id = AuthUser::getId();
		$new_fnb->created_on = date('Y-m-d H:i:s');
		if ($new_fnb->save()) {
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0){
					$fnb_id = $new_fnb->lastInsertId();
					
					$overwrite=false;
					$file = $this->upload_pdf_file($fnb_id, $_FILES['upload_file']['name'], FILES_DIR.'/fnb/files/', $_FILES['upload_file']['tmp_name'], $overwrite);

					// if ($file === false)
					// Flash::set('error', __('File has not been uploaded!'));
		   //          redirect(get_url('fnb/edit/'.$new_fnb->id));
	        	}

				if(strlen($_FILES['upload_left_bg']['name'])>0){
					$fnb_id = $new_fnb->lastInsertId();
					
					$overwrite=false;
					$file = $this->upload_left_bg($fnb_id, $_FILES['upload_left_bg']['name'], FILES_DIR.'/fnb/bg/', $_FILES['upload_left_bg']['tmp_name'], $overwrite);

					// if ($file === false)
					// Flash::set('error', __('Image has not been uploaded!'));
		   //          redirect(get_url('fnb/edit/'.$new_fnb->id));
	        	}

				if(strlen($_FILES['upload_right_bg']['name'])>0){
					$fnb_id = $new_fnb->lastInsertId();
					
					$overwrite=false;
					$file = $this->upload_right_bg($fnb_id, $_FILES['upload_right_bg']['name'], FILES_DIR.'/fnb/bg/', $_FILES['upload_right_bg']['tmp_name'],$overwrite);

					// if ($file === false)
					// Flash::set('error', __('Image has not been uploaded!'));
		   //          redirect(get_url('fnb/edit/'.$new_fnb->id));
	        	}

			}
			
			Flash::set('success', __('Fnb has been added!'));
			Observer::notify('fnb_after_add', $new_fnb->name);

			// save and quit or save and continue editing?
			if (isset($_POST['commit']))
				redirect(get_url('fnb'));
			else
	            redirect(get_url('fnb/edit/'.$new_fnb->id));
		}
		else {
			Flash::set('error', __('Fnb has not been added!'));
			redirect(get_url('fnb/add'));
		}
	}
	
	function upload_pdf_file($fnbid, $origin, $dest, $tmp_name, $overwrite=false){
		FileManagerController::_checkPermission();
		$origin = basename($origin);
		$full_dest = $dest.$origin;
		$file_name = $origin;

		for ($i=1; file_exists($full_dest); $i++) {
			if ($overwrite) {
				unlink($full_dest);
				continue;
			}
			$file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
			$file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
			$full_dest = $dest.$file_name;
		}

		if (move_uploaded_file($tmp_name, $full_dest)) {
			//Add Banner to database
			$data = $_POST['fnb'];
			Flash::set('post_data', (object) $data);

			$fnb = Fnb::findById($fnbid);
			$fnb->filename = $file_name;

			if ( ! $fnb->save())
				Flash::set('error', __('Menu file could not be uploaded!'));
			else
				Flash::set('success', __('Menu file has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file

	function upload_left_bg($fnbid, $origin, $dest, $tmp_name, $overwrite=false){
		FileManagerController::_checkPermission();
		$origin = basename($origin);
		$full_dest = $dest.$origin;
		$file_name = $origin;

		for ($i=1; file_exists($full_dest); $i++) {
			if ($overwrite) {
				unlink($full_dest);
				continue;
			}
			$file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
			$file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
			$full_dest = $dest.$file_name;
		}

		if (move_uploaded_file($tmp_name, $full_dest)) {
			//Add Banner to database
			$data = $_POST['fnb'];
			Flash::set('post_data', (object) $data);

			$fnb = Fnb::findById($fnbid);
			$fnb->left_bg = $file_name;
		
			if ( ! $fnb->save())
				Flash::set('error', __('Background image could not be uploaded!'));
			else
				Flash::set('success', __('Background image been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_left_bg

	function upload_right_bg($fnbid, $origin, $dest, $tmp_name, $overwrite=false){
		FileManagerController::_checkPermission();
		$origin = basename($origin);
		$full_dest = $dest.$origin;
		$file_name = $origin;

		for ($i=1; file_exists($full_dest); $i++) {
			if ($overwrite) {
				unlink($full_dest);
				continue;
			}
			$file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
			$file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
			$full_dest = $dest.$file_name;
		}

		if (move_uploaded_file($tmp_name, $full_dest)) {
			//Add Banner to database
			$data = $_POST['fnb'];
			Flash::set('post_data', (object) $data);

			$fnb = Fnb::findById($fnbid);
			$fnb->right_bg = $file_name;
		
			if ( ! $fnb->save())
				Flash::set('error', __('Background image could not be uploaded!'));
			else
				Flash::set('success', __('Background image been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_right_bg

    public function edit($id)
    {
    	if (!$fnb = Fnb::findById($id))
        {
            Flash::set('error', __('Menu not found!'));
            redirect(get_url('fnb'));
        }

        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);

		$fnbgalleries = FnbImage::findByFnbId($id);
		$locations = Location::findByFnbId($id);
		$this->display('fnb/edit', array(
            'action'  => 'edit',
            'csrf_token' => SecureToken::generateToken(BASE_URL.'fnb/edit/'.$id),
			'fnb' => $fnb,
			'fnbgalleries' => $fnbgalleries,
			'locations' => $locations,
			'id' => $id,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
        ));
    }

    private function _edit($id){
        use_helper('Validate');
        $data = $_POST['fnb'];
        Flash::set('fnb_postdata', $data);

        $errors = false;
        // CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'fnb/edit/'.$id)) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('fnb/edit/'.$id));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('fnb/edit/'.$id));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a name!'));
			redirect(get_url('fnb/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('fnb/edit/'.$id));
		}

      	$fnb = Record::findByIdFrom('Fnb', $id);
        $fnb->setFromData($data);
		$fnb->updated_by_id = AuthUser::getId();
		$fnb->updated_on = date('Y-m-d H:i:s');
			
	    if ($fnb->save()) {
	    	// print_r($_FILES);exit;
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0){
					$overwrite=false;
					$file = $this->upload_pdf_file($id, $_FILES['upload_file']['name'], FILES_DIR.'/fnb/files/', $_FILES['upload_file']['tmp_name'], $overwrite);

					// if ($file === false)
					// Flash::set('error', __('File has not been uploaded!'));
		   //          redirect(get_url('fnb/edit/'.$id));
	        	}

				if(strlen($_FILES['upload_left_bg']['name'])>0){
					$overwrite=false;
					$file = $this->upload_left_bg($id, $_FILES['upload_left_bg']['name'], FILES_DIR.'/fnb/bg/', $_FILES['upload_left_bg']['tmp_name'], $overwrite);

					// if ($file === false)
					// Flash::set('error', __('File has not been uploaded!'));
		   //          redirect(get_url('fnb/edit/'.$id));
	        	}

				if(strlen($_FILES['upload_right_bg']['name'])>0){
					$overwrite=false;
					$file = $this->upload_right_bg($id, $_FILES['upload_right_bg']['name'], FILES_DIR.'/fnb/bg/', $_FILES['upload_right_bg']['tmp_name'], $overwrite);

					// if ($file === false)
					// Flash::set('error', __('File has not been uploaded!'));
		   //          redirect(get_url('fnb/edit/'.$id));
	        	}
			}
			
			Flash::set('success', __('Fnb has been saved!'));
			Observer::notify('fnb_after_edit', $fnb->name);
		}
		else {
			Flash::set('error', __('Fnb has not been saved!'));
		}

		// save and quit or save and continue editing?
		if (isset($_POST['commit']))
			redirect(get_url('fnb'));
		else
            redirect(get_url('fnb/edit/'.$id));
    }

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

		$this->display('fnb/index', array(
            'fnbs' => Record::query('select * from '.TABLE_PREFIX.'fnb ORDER BY '.TABLE_PREFIX.'fnb.sequence, '.TABLE_PREFIX.'fnb.id desc'),
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')			
        ));
    } // browse

    function delete($id){
        $fnb = Record::findByIdFrom('Fnb', $id);

        // find the fnb to delete
        if ($fnb)
        {
			$file = FILES_DIR.'/fnb/files/'.$fnb->filename;
			$file2 = FILES_DIR.'/fnb/bg/'.$fnb->left_bg;
			$file3 = FILES_DIR.'/fnb/bg/'.$fnb->right_bg;
			$filename = array_pop($paths);
			$paths = join('/', $paths);
			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}
			if (is_file($file2))	{
				if ( ! unlink($file2))
					Flash::set('error', __('Permission denied!'));
			}
			if (is_file($file3))	{
				if ( ! unlink($file3))
					Flash::set('error', __('Permission denied!'));
			}
	

            if ($fnb->delete())
                Flash::set('success', __('This fnb has been deleted.'));
            else
                Flash::set('error', __('This fnb has not been deleted!'));
        }
        else Flash::set('error', __('Menu not found!'));

		redirect(get_url('fnb'));
    }

    public function upload($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];
		if (isset($_FILES))
		{
			$file = $this->upload_file($id, -1, $title, $_FILES['upload_file']['name'], FILES_DIR.'/fnb/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('fnb/edit/'.$id));
    }
	
	function edit_fnb_image($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'fnb/edit_fnb_image/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('fnb/edit_fnb_image/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('fnb/edit_fnb_image/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$fnbImage = FnbImage::findById($id);
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/fnb/gallery/'.$_FILES['upload_file']['tmp_name'])){			
				$file = $this->upload_file($fnbImage->fnbid, $fnbImage->id, $title, $_FILES['upload_file']['name'], FILES_DIR.'/fnb/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('fnb/edit_fnb_image/'.$id));
				}
			} else {
				$fnbImage->title = $title;

				if ( ! $fnbImage->save())
					Flash::set('error', __('Menu image could not be saved!'));
				else
					Flash::set('success', __('Menu image has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('fnb/edit/'.$fnbImage->fnbid));
			else
				redirect(get_url('fnb/edit_fnb_image/'.$id));
				
		} else { // display edit page
			$fnbImage = FnbImage::findById($id);
			$this->display('fnb/edit_fnb_image', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'fnb/edit_fnb_image/'.$id),
				'fnbimage' => $fnbImage
			));
		}
	}
	
	function upload_file($fnbid, $imageid, $title, $origin, $dest, $tmp_name, $overwrite=false){
		FileManagerController::_checkPermission();
		$origin = basename($origin);
		$full_dest = $dest.$origin;
		$file_name = $origin;

		for ($i=1; file_exists($full_dest); $i++) {
			if ($overwrite) {
				unlink($full_dest);
				continue;
			}
			$file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
			$file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
			$full_dest = $dest.$file_name;
		}

		if (move_uploaded_file($tmp_name, $full_dest)) {
			//Add Banner to database
			$data = $_POST['fnb'];
			Flash::set('post_data', (object) $data);

			if ($imageid == -1){
				$fnbimage = new FnbImage();
				$fnbimage->fnbid = $fnbid;
			} else {
				$fnbimage = FnbImage::findById($imageid);
			}
			$fnbimage->title = $title;
			$fnbimage->filename = $file_name;

			if ( ! $fnbimage->save())
				Flash::set('error', __('Menu image has not been added!'));
			else
				Flash::set('success', __('Menu image has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file
	
	function uploadlocation($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];

		$locationid = -1;
		if (isset($_FILES))
		{
			$file = $this->upload_location_file($id, $locationid, $_POST, $_FILES['upload_location_file']['name'], FILES_DIR.'/fnb/location/', $_FILES['upload_location_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('fnb/edit/'.$id));
    }
	
	function edit_location($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'fnb/edit_location/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('fnb/edit_location/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('fnb/edit_location/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$location = Location::findById($id);

			$location->title = $_POST['title'];
			$location->description = $_POST['description'];
			$location->url = $_POST['url'];
			$location->save();

			if(!empty($_FILES['upload_location_file']['name']) && !file_exists(FILES_DIR.'/fnb/location/'.$_FILES['upload_location_file']['tmp_name'])){			
				$file = $this->upload_location_file($location->fnbid, $location->id, $_POST, $_FILES['upload_location_file']['name'], FILES_DIR.'/fnb/location/', $_FILES['upload_location_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('fnb/edit_location/'.$id));
				}
			} else {
				$location->title = $title;

				if ( ! $location->save())
					Flash::set('error', __('Location could not be saved!'));
				else
					Flash::set('success', __('Location has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('fnb/edit/'.$location->fnbid));
			else
				redirect(get_url('fnb/edit_location/'.$id));
				
		} else { // display edit page
			$location = Location::findById($id);
			$this->display('fnb/edit_location', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'fnb/edit_location/'.$id),
				'location' => $location
			));
		}
    }
	
	function upload_location_file($fnbid, $locationid, $locdata, $origin, $dest, $tmp_name, $overwrite=false){
		FileManagerController::_checkPermission();
		$origin = basename($origin);
		$full_dest = $dest.$origin;
		$file_name = $origin;

		for ($i=1; file_exists($full_dest); $i++) {
			if ($overwrite) {
				unlink($full_dest);
				continue;
			}
			$file_ext = (strpos($origin, '.') === false ? '': '.'.substr(strrchr($origin, '.'), 1));
			$file_name = substr($origin, 0, strlen($origin) - strlen($file_ext)).'_'.$i.$file_ext;
			$full_dest = $dest.$file_name;
		}

		if (move_uploaded_file($tmp_name, $full_dest)) {
			//Add Banner to database
			$data = $_POST['fnb'];
			Flash::set('post_data', (object) $data);

			if ($locationid == -1){
				$location = new Location();
				$location->fnbid = $fnbid;
			} else {
				$location = Location::findById($locationid);
			}

			$location->title = $locdata['title'];
			$location->description = $locdata['description'];
			$location->url = $locdata['url'];
			$location->filename = $file_name;

			if ( ! $location->save())
				Flash::set('error', __('location has not been added!'));
			else
				Flash::set('success', __('location has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_location_file

	function delete_image($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$fnbimage = Record::findByIdFrom('FnbImage', $id);
		if ($fnbimage){
			$file = FILES_DIR.'/fnb/gallery/'.$fnbimage->filename;
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($fnbimage->delete())
				Flash::set('success', __('This menu image has been deleted.'));
			else
				Flash::set('error', __('This menu image has not been deleted!'));
		}
        else Flash::set('error', __('Menu image not found!'));

		redirect(get_url('fnb/edit/'.$fnbimage->fnbid));
    }
	
	function delete_location($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$location = Record::findByIdFrom('Location', $id);
		if ($location){
			$file = FILES_DIR.'/fnb/location/'.$location->filename;
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($location->delete())
				Flash::set('success', __('This location has been deleted.'));
			else
				Flash::set('error', __('This Location could not be deleted!'));
		}
        else Flash::set('error', __('Location could not be found!'));

		redirect(get_url('fnb/edit/'.$location->fnbid));
    }

    public function save_order(){
        $fnb_array = $_POST['fnb_id'];
        $order_array = $_POST['order'];

        $fnb = new Fnb;
        foreach($fnb_array as $key => $value){
            $fnb_id = $value;
            $fnb_order = $order_array[$key];

            $fnb->update('Fnb', array('sequence' => $fnb_order), 'id='.$fnb_id);
        }
        Flash::set('success', __('This fnb sequence has been saved.'));
        redirect(get_url('fnb'));
    }
	
	public function save_imageorder(){
        $fnb_array = $_POST['fnbimage_id'];
		$fnb_id 	= $_POST['fnb_id'];
        $order_array = $_POST['order'];

        $fnbImg = new FnbImage;
        foreach($fnb_array as $key => $value){
            $fnbimg_id = $value;
            $fnbimg_order = $order_array[$key];

            $fnbImg->update('FnbImage', array('sequence' => $fnbimg_order), 'id='.$fnbimg_id);
        }
        Flash::set('success', __('The menu image sequence has been saved.'));
        redirect(get_url('fnb/edit/'.$fnb_id));
    }
	
	public function save_locationorder(){
        $location_array = $_POST['location_id'];
		$fnb_id 	= $_POST['fnb_id'];
        $order_array = $_POST['order'];

        $locationImg = new Location;
        foreach($location_array as $key => $value){
            $locationimg_id = $value;
            $locationimg_order = $order_array[$key];

            $locationImg->update('Location', array('sequence' => $locationimg_order), 'id='.$locationimg_id);
        }
        Flash::set('success', __('The location sequence has been saved.'));
        redirect(get_url('fnb/edit/'.$fnb_id));
    }
	
}

?>