<?php

class RoomController extends Controller
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
    	$this->assignToLayout('sidebar', new View('room/sidebar'));
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
		$room = null;
		if (isset($data)){
			$room = new Room($data);
		}
		
		$this->display('room/edit', array(
			'action'  => 'add',
			'csrf_token' => SecureToken::generateToken(BASE_URL.'room/add'),
			'room' => $room,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
		));
	}

	private function _add() {
		use_helper('Validate');
		$data = $_POST['room'];
		Flash::set('room_postdata', $data);
		// Add pre-save checks here
		$errors = false;

		// CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'room/add')) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('room/add'));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('room/add'));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a room name!'));
			redirect(get_url('room/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('room/add'));
		}

		$new_room = new Room($data);				
		$new_room->created_by_id = AuthUser::getId();
		$new_room->created_on = date('Y-m-d H:i:s');
		if ($new_room->save()) {
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0||strlen($_FILES['upload_file_home']['name'])>0){
					$room_id = $new_room->lastInsertId();
					
					$overwrite=false;
					if(strlen($_FILES['upload_file']['name'])>0){
						$file = $this->upload_pdf_file($room_id, $_FILES['upload_file']['name'], FILES_DIR.'/room/images/', $_FILES['upload_file']['tmp_name'], $overwrite);}
					if(strlen($_FILES['upload_file_home']['name'])>0){
						$file2 = $this->upload_pdf_file2($room_id, $_FILES['upload_file_home']['name'], FILES_DIR.'/room/images/', $_FILES['upload_file_home']['tmp_name'], $overwrite);
					}

					if ($file === false||$file2 === false)
					Flash::set('error', __('File has not been uploaded1!'));
		            redirect(get_url('room/edit/'.$new_room->id));
	        	}
				
			}
			
			Flash::set('success', __('Room has been added!'));
			Observer::notify('room_after_add', $new_room->name);

			// save and quit or save and continue editing?
			if (isset($_POST['commit']))
				redirect(get_url('room'));
			else
	            redirect(get_url('room/edit/'.$new_room->id));
		}
		else {
			Flash::set('error', __('Room has not been added!'));
			redirect(get_url('room/add'));
		}
	}
	
	function upload_pdf_file($roomid, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['room'];
			Flash::set('post_data', (object) $data);

			$room = Room::findById($roomid);
			$room->filename = $file_name;

			if ( ! $room->save())
				Flash::set('error', __('Feature file could not be uploaded!'));
			else
				Flash::set('success', __('Feature file has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file
	
	function upload_pdf_file2($roomid, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['room'];
			Flash::set('post_data', (object) $data);

			$room = Room::findById($roomid);
			$room->filename_home = $file_name;

			if ( ! $room->save())
				Flash::set('error', __('Feature file could not be uploaded!'));
			else
				Flash::set('success', __('Feature file has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file

    public function edit($id)
    {
    	if (!$room = Room::findById($id))
        {
            Flash::set('error', __('Room not found!'));
            redirect(get_url('room'));
        }

        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);

		$roomgalleries = RoomImage::findByRoomId($id);
		$features = FeatureImage::findByRoomId($id);
		$this->display('room/edit', array(
            'action'  => 'edit',
            'csrf_token' => SecureToken::generateToken(BASE_URL.'room/edit/'.$id),
			'room' => $room,
			'roomgalleries' => $roomgalleries,
			'features' => $features,
			'id' => $id,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
        ));
    }

    private function _edit($id){
        use_helper('Validate');
        $data = $_POST['room'];
        Flash::set('room_postdata', $data);

        $errors = false;
        // CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'room/edit/'.$id)) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('room/edit/'.$id));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('room/edit/'.$id));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a name!'));
			redirect(get_url('room/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('room/edit/'.$id));
		}

      	$room = Record::findByIdFrom('Room', $id);
        $room->setFromData($data);
		$room->updated_by_id = AuthUser::getId();
		$room->updated_on = date('Y-m-d H:i:s');
			
	    if ($room->save()) {
	    	// print_r($_FILES);exit;
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0||strlen($_FILES['upload_file_home']['name'])>0){
					$overwrite=false;
					if(strlen($_FILES['upload_file']['name'])>0){
						$file = $this->upload_pdf_file($id, $_FILES['upload_file']['name'], FILES_DIR.'/room/images/', $_FILES['upload_file']['tmp_name'], $overwrite);
					}
					if(strlen($_FILES['upload_file_home']['name'])>0){
						$file2 = $this->upload_pdf_file2($id, $_FILES['upload_file_home']['name'], FILES_DIR.'/room/images/', $_FILES['upload_file_home']['tmp_name'], $overwrite);
					}

					if ($file === false||$file2 === false)
					Flash::set('error', __('File has not been uploaded2!'));
		            redirect(get_url('room/edit/'.$id));
	        	}
			}
			
			Flash::set('success', __('Room has been saved!'));
			Observer::notify('room_after_edit', $room->name);
		}
		else {
			Flash::set('error', __('Room has not been saved!'));
		}

		// save and quit or save and continue editing?
		if (isset($_POST['commit']))
			redirect(get_url('room'));
		else
            redirect(get_url('room/edit/'.$id));
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

		$this->display('room/index', array(
            'rooms' => Record::query('select * from '.TABLE_PREFIX.'room ORDER BY '.TABLE_PREFIX.'room.sequence, '.TABLE_PREFIX.'room.id desc'),
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')			
        ));
    } // browse

    function delete($id){
        $room = Record::findByIdFrom('Room', $id);

        // find the room to delete
        if ($room)
        {
            if ($room->delete())
                Flash::set('success', __('This room has been deleted.'));
            else
                Flash::set('error', __('This room has not been deleted!'));
        }
        else Flash::set('error', __('Room not found!'));

		redirect(get_url('room'));
    }

    public function upload($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];
		if (isset($_FILES))
		{
			$file = $this->upload_file($id, -1, $title, $_FILES['upload_file']['name'], FILES_DIR.'/room/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);
			$file2 = $this->upload_file($id, -1, $title, $_FILES['upload_file_home']['name'], FILES_DIR.'/room/gallery/', $_FILES['upload_file_home']['tmp_name'], $overwrite);

			if ($file2 === false&&$file === false)
			   Flash::set('error', __('File has not been uploaded3!'));
		}
		redirect(get_url('room/edit/'.$id));
    }
	
	function edit_room_image($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'room/edit_room_image/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('room/edit_room_image/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('room/edit_room_image/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$roomImage = RoomImage::findById($id);
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/room/gallery/'.$_FILES['upload_file']['tmp_name'])){			
				$file = $this->upload_file($roomImage->roomid, $roomImage->id, $title, $_FILES['upload_file']['name'], FILES_DIR.'/room/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded4!'));
				   redirect(get_url('room/edit_room_image/'.$id));
				}
			} else {
				$roomImage->title = $title;

				if ( ! $roomImage->save())
					Flash::set('error', __('Room image could not be saved!'));
				else
					Flash::set('success', __('Room image has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('room/edit/'.$roomImage->roomid));
			else
				redirect(get_url('room/edit_room_image/'.$id));
				
		} else { // display edit page
			$roomImage = RoomImage::findById($id);
			$this->display('room/edit_room_image', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'room/edit_room_image/'.$id),
				'roomimage' => $roomImage
			));
		}
	}
	
	function upload_file($roomid, $imageid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['room'];
			Flash::set('post_data', (object) $data);

			if ($imageid == -1){
				$roomimage = new RoomImage();
				$roomimage->roomid = $roomid;
			} else {
				$roomimage = RoomImage::findById($imageid);
			}
			$roomimage->title = $title;
			$roomimage->filename = $file_name;

			if ( ! $roomimage->save())
				Flash::set('error', __('Room image has not been added!'));
			else
				Flash::set('success', __('Room image has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file
	
	function uploadfeature($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];
		$featureid = -1;
		if (isset($_FILES))
		{
			$file = $this->upload_feature_file($id, $featureid, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/room/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded5!'));
		}
		redirect(get_url('room/edit/'.$id));
    }
	
	function edit_feature($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'room/edit_feature/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('room/edit_feature/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('room/edit_feature/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$featureimage = FeatureImage::findById($id);
			if(!empty($_FILES['upload_feature_file']['name']) && !file_exists(FILES_DIR.'/room/feature/'.$_FILES['upload_feature_file']['tmp_name'])){			
				$file = $this->upload_feature_file($featureimage->roomid, $featureimage->id, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/room/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded6!'));
				   redirect(get_url('room/edit_feature/'.$id));
				}
			} else {
				$featureimage->title = $title;

				if ( ! $featureimage->save())
					Flash::set('error', __('Feature could not be saved!'));
				else
					Flash::set('success', __('Feature has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('room/edit/'.$featureimage->roomid));
			else
				redirect(get_url('room/edit_feature/'.$id));
				
		} else { // display edit page
			$feature = FeatureImage::findById($id);
			$this->display('room/edit_feature', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'room/edit_feature/'.$id),
				'feature' => $feature
			));
		}
    }
	
	function upload_feature_file($roomid, $featureid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['room'];
			Flash::set('post_data', (object) $data);

			if ($featureid == -1){
				$featureimage = new FeatureImage();
				$featureimage->roomid = $roomid;
			} else {
				$featureimage = FeatureImage::findById($featureid);
			}
			$featureimage->title = $title;
			$featureimage->filename = $file_name;

			if ( ! $featureimage->save())
				Flash::set('error', __('Feature image has not been added!'));
			else
				Flash::set('success', __('Feature image has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_feature_file

	function delete_image($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$roomimage = Record::findByIdFrom('RoomImage', $id);
		if ($roomimage){
			$file = FILES_DIR.'/room/gallery/'.$roomimage->filename;
			
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($roomimage->delete())
				Flash::set('success', __('This room image has been deleted.'));
			else
				Flash::set('error', __('This room image has not been deleted!'));
		}
        else Flash::set('error', __('Room image not found!'));

		redirect(get_url('room/edit/'.$roomimage->roomid));
    }
	
	function delete_homeimage($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$featureimage = Record::findByIdFrom('Room', $id);
		if ($featureimage){
		
			$file2 = FILES_DIR.'/room/images/'.$featureimage->filename_home;
			
			$filename = array_pop($paths);
			$paths = join('/', $paths);
			
			
			if (is_file($file2))	{
				if ( ! unlink($file2))
					Flash::set('error', __('Permission denied!'));
				
			}
			if ($featureimage->update('Room', array('filename_home' => ''), 'id='.$id))
					Flash::set('success', __('Home image has been deleted2.'));
				else
					Flash::set('error', __('This image could not be deleted!'));
			//$featureimage->filename="";
			
			// delete record
			
		}
        else Flash::set('error', __('image could not be found!'));

		redirect(get_url('room/edit/'.$featureimage->id));
    }	
	
	function delete_mainimage($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$featureimage = Record::findByIdFrom('Room', $id);
		if ($featureimage){
			$file = FILES_DIR.'/room/images/'.$featureimage->filename;
			
			
			$filename = array_pop($paths);
			$paths = join('/', $paths);
			
			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
					

			}
			if ($featureimage->update('Room', array('filename' => ''), 'id='.$id))
					Flash::set('success', __('This image has been deleted1.'));
				else
					Flash::set('error', __('This image could not be deleted!'));
			
			//$featureimage->filename="";
			
			// delete record
			
		}
        else Flash::set('error', __('image could not be found!'));

		redirect(get_url('room/edit/'.$featureimage->id));
    }

    public function save_order(){
        $room_array = $_POST['room_id'];
        $order_array = $_POST['order'];

        $room = new Room;
        foreach($room_array as $key => $value){
            $room_id = $value;
            $room_order = $order_array[$key];

            $room->update('Room', array('sequence' => $room_order), 'id='.$room_id);
        }
        Flash::set('success', __('This room sequence has been saved.'));
        redirect(get_url('room'));
    }
	
	public function save_imageorder(){
        $room_array = $_POST['roomimage_id'];
		$room_id 	= $_POST['room_id'];
        $order_array = $_POST['order'];

        $roomImg = new RoomImage;
        foreach($room_array as $key => $value){
            $roomimg_id = $value;
            $roomimg_order = $order_array[$key];

            $roomImg->update('RoomImage', array('sequence' => $roomimg_order), 'id='.$roomimg_id);
        }
        Flash::set('success', __('The room image sequence has been saved.'));
        redirect(get_url('room/edit/'.$room_id));
    }
	
	public function save_featureimageorder(){
        $feature_array = $_POST['featureimage_id'];
		$room_id 	= $_POST['room_id'];
        $order_array = $_POST['order'];

        $featureImg = new FeatureImage;
        foreach($feature_array as $key => $value){
            $featureimg_id = $value;
            $featureimg_order = $order_array[$key];

            $featureImg->update('FeatureImage', array('sequence' => $featureimg_order), 'id='.$featureimg_id);
        }
        Flash::set('success', __('The Feature image sequence has been saved.'));
        redirect(get_url('room/edit/'.$room_id));
    }
	
}

?>