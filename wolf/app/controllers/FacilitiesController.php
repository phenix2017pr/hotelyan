<?php

class FacilitiesController extends Controller
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
    	$this->assignToLayout('sidebar', new View('facilities/sidebar'));
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
		$Facilities = null;
		if (isset($data)){
			$facilities = new Facilities($data);
		}
		else{
			$facilities='';
		}
		
		$this->display('facilities/edit', array(
			'action'  => 'add',
			'csrf_token' => SecureToken::generateToken(BASE_URL.'facilities/add'),
			'facilities' => $facilities,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
		));
	}

	private function _add() {
		use_helper('Validate');
		$data = $_POST['facilities'];
		Flash::set('facilities_postdata', $data);
		// Add pre-save checks here
		$errors = false;

		// CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'facilities/add')) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('facilities/add'));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('facilities/add'));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a facilities name!'));
			redirect(get_url('facilities/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('facilities/add'));
		}

		$new_facilities = new Facilities($data);				
		$new_facilities->created_by_id = AuthUser::getId();
		$new_facilities->created_on = date('Y-m-d H:i:s');
		if ($new_facilities->save()) {
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0){
					$facilities_id = $new_facilities->lastInsertId();
					
					$overwrite=false;
					$file = $this->upload_pdf_file($facilities_id, $_FILES['upload_file']['name'], FILES_DIR.'/facilities/images/', $_FILES['upload_file']['tmp_name'], $overwrite);

					if ($file === false)
					Flash::set('error', __('File has not been uploaded!'));
		            redirect(get_url('facilities/edit/'.$new_facilities->id));
	        	}
			}
			
			Flash::set('success', __('Facilities has been added!'));
			Observer::notify('facilities_after_add', $new_facilities->name);

			// save and quit or save and continue editing?
			if (isset($_POST['commit']))
				redirect(get_url('facilities'));
			else
	            redirect(get_url('facilities/edit/'.$new_facilities->id));
		}
		else {
			Flash::set('error', __('Facilities has not been added!'));
			redirect(get_url('facilities/add'));
		}
	}
	
	function upload_pdf_file($facilitiesid, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['facilities'];
			Flash::set('post_data', (object) $data);

			$facilities = Facilities::findById($facilitiesid);
			$facilities->filename = $file_name;

			if ( ! $facilities->save())
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
    	if (!$facilities = Facilities::findById($id))
        {
            Flash::set('error', __('Facilities not found!'));
            redirect(get_url('facilities'));
        }

        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);

		$facilitiesgalleries = FacilitiesImage::findByFacilitiesId($id);
		//$features = FeatureImage::findByFacilitiesId($id);
		$this->display('facilities/edit', array(
            'action'  => 'edit',
            'csrf_token' => SecureToken::generateToken(BASE_URL.'facilities/edit/'.$id),
			'facilities' => $facilities,
			'facilitiesgalleries' => $facilitiesgalleries,
			//'features' => $features,
			'id' => $id,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
        ));
    }

    private function _edit($id){
        use_helper('Validate');
        $data = $_POST['facilities'];
        Flash::set('facilities_postdata', $data);

        $errors = false;
        // CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'facilities/edit/'.$id)) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('facilities/edit/'.$id));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('facilities/edit/'.$id));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a name!'));
			redirect(get_url('facilities/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('facilities/edit/'.$id));
		}

      	$facilities = Record::findByIdFrom('Facilities', $id);
        $facilities->setFromData($data);
		$facilities->updated_by_id = AuthUser::getId();
		$facilities->updated_on = date('Y-m-d H:i:s');
			
	    if ($facilities->save()) {
	    	// print_r($_FILES);exit;
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0){
					$overwrite=false;
					$file = $this->upload_pdf_file($id, $_FILES['upload_file']['name'], FILES_DIR.'/facilities/images/', $_FILES['upload_file']['tmp_name'], $overwrite);

					if ($file === false)
					Flash::set('error', __('File has not been uploaded!'));
		            redirect(get_url('facilities/edit/'.$id));
	        	}
			}
			
			Flash::set('success', __('Facilities has been saved!'));
			Observer::notify('facilities_after_edit', $facilities->name);
		}
		else {
			Flash::set('error', __('Facilities has not been saved!'));
		}

		// save and quit or save and continue editing?
		if (isset($_POST['commit']))
			redirect(get_url('facilities'));
		else
            redirect(get_url('facilities/edit/'.$id));
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

		$this->display('facilities/index', array(
            'facilitiess' => Record::query('select * from '.TABLE_PREFIX.'facilities ORDER BY '.TABLE_PREFIX.'facilities.sequence, '.TABLE_PREFIX.'facilities.id desc'),
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')			
        ));
    } // browse

    function delete($id){
        $facilities = Record::findByIdFrom('Facilities', $id);

        // find the facilities to delete
        if ($facilities)
        {
            if ($facilities->delete())
                Flash::set('success', __('This facilities has been deleted.'));
            else
                Flash::set('error', __('This facilities has not been deleted!'));
        }
        else Flash::set('error', __('Facilities not found!'));

		redirect(get_url('facilities'));
    }

    public function upload($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];
		if (isset($_FILES))
		{
			$file = $this->upload_file($id, -1, $title, $_FILES['upload_file']['name'], FILES_DIR.'/facilities/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('facilities/edit/'.$id));
    }
	
	function edit_facilities_image($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'facilities/edit_facilities_image/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('facilities/edit_facilities_image/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('facilities/edit_facilities_image/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$facilitiesImage = FacilitiesImage::findById($id);
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/facilities/gallery/'.$_FILES['upload_file']['tmp_name'])){			
				$file = $this->upload_file($facilitiesImage->facilitiesid, $facilitiesImage->id, $title, $_FILES['upload_file']['name'], FILES_DIR.'/facilities/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('facilities/edit_facilities_image/'.$id));
				}
			} else {
				$facilitiesImage->title = $title;

				if ( ! $facilitiesImage->save())
					Flash::set('error', __('Facilities image could not be saved!'));
				else
					Flash::set('success', __('Facilities image has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('facilities/edit/'.$facilitiesImage->facilitiesid));
			else
				redirect(get_url('facilities/edit_facilities_image/'.$id));
				
		} else { // display edit page
			$facilitiesImage = FacilitiesImage::findById($id);
			$this->display('facilities/edit_facilities_image', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'facilities/edit_facilities_image/'.$id),
				'facilitiesimage' => $facilitiesImage
			));
		}
	}
	
	function upload_file($facilitiesid, $imageid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['facilities'];
			Flash::set('post_data', (object) $data);

			if ($imageid == -1){
				$facilitiesimage = new FacilitiesImage();
				$facilitiesimage->facilitiesid = $facilitiesid;
			} else {
				$facilitiesimage = FacilitiesImage::findById($imageid);
			}
			$facilitiesimage->title = $title;
			$facilitiesimage->filename = $file_name;

			if ( ! $facilitiesimage->save())
				Flash::set('error', __('Facilities image has not been added!'));
			else
				Flash::set('success', __('Facilities image has been added!'));

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
			$file = $this->upload_feature_file($id, $featureid, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/facilities/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('facilities/edit/'.$id));
    }
	
	function edit_feature($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'facilities/edit_feature/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('facilities/edit_feature/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('facilities/edit_feature/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$featureimage = FeatureImage::findById($id);
			if(!empty($_FILES['upload_feature_file']['name']) && !file_exists(FILES_DIR.'/facilities/feature/'.$_FILES['upload_feature_file']['tmp_name'])){			
				$file = $this->upload_feature_file($featureimage->facilitiesid, $featureimage->id, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/facilities/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('facilities/edit_feature/'.$id));
				}
			} else {
				$featureimage->title = $title;

				if ( ! $featureimage->save())
					Flash::set('error', __('Feature could not be saved!'));
				else
					Flash::set('success', __('Feature has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('facilities/edit/'.$featureimage->facilitiesid));
			else
				redirect(get_url('facilities/edit_feature/'.$id));
				
		} else { // display edit page
			$feature = FeatureImage::findById($id);
			$this->display('facilities/edit_feature', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'facilities/edit_feature/'.$id),
				'feature' => $feature
			));
		}
    }
	
	function upload_feature_file($facilitiesid, $featureid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['facilities'];
			Flash::set('post_data', (object) $data);

			if ($featureid == -1){
				$featureimage = new FeatureImage();
				$featureimage->facilitiesid = $facilitiesid;
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

		$facilitiesimage = Record::findByIdFrom('FacilitiesImage', $id);
		if ($facilitiesimage){
			$file = FILES_DIR.'/facilities/gallery/'.$facilitiesimage->filename;
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($facilitiesimage->delete())
				Flash::set('success', __('This facilities image has been deleted.'));
			else
				Flash::set('error', __('This facilities image has not been deleted!'));
		}
        else Flash::set('error', __('Facilities image not found!'));

		redirect(get_url('facilities/edit/'.$facilitiesimage->facilitiesid));
    }
	
	
	
	function delete_mainimage($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$featureimage = Record::findByIdFrom('Facilities', $id);
		if ($featureimage){
			$file = FILES_DIR.'/facilities/images/'.$featureimage->filename;
			
			$filename = array_pop($paths);
			$paths = join('/', $paths);
			
			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}
			
			//$featureimage->filename="";
			
			// delete record
			if ($featureimage->update('Facilities', array('filename' => ''), 'id='.$id))
				Flash::set('success', __('This  image has been deleted.'));
			else
				Flash::set('error', __('This image could not be deleted!'));
		}
        else Flash::set('error', __('image could not be found!'));

		redirect(get_url('facilities/edit/'.$featureimage->id));
    }

    public function save_order(){
        $facilities_array = $_POST['facilities_id'];
        $order_array = $_POST['order'];

        $facilities = new Facilities;
        foreach($facilities_array as $key => $value){
            $facilities_id = $value;
            $facilities_order = $order_array[$key];

            $facilities->update('Facilities', array('sequence' => $facilities_order), 'id='.$facilities_id);
        }
        Flash::set('success', __('This facilities sequence has been saved.'));
        redirect(get_url('facilities'));
    }
	
	public function save_imageorder(){
        $facilities_array = $_POST['facilitiesimage_id'];
		$facilities_id 	= $_POST['facilities_id'];
        $order_array = $_POST['order'];

        $facilitiesImg = new FacilitiesImage;
        foreach($facilities_array as $key => $value){
            $facilitiesimg_id = $value;
            $facilitiesimg_order = $order_array[$key];

            $facilitiesImg->update('FacilitiesImage', array('sequence' => $facilitiesimg_order), 'id='.$facilitiesimg_id);
        }
        Flash::set('success', __('The facilities image sequence has been saved.'));
        redirect(get_url('facilities/edit/'.$facilities_id));
    }
	
	public function save_featureimageorder(){
        $feature_array = $_POST['featureimage_id'];
		$facilities_id 	= $_POST['facilities_id'];
        $order_array = $_POST['order'];

        $featureImg = new FeatureImage;
        foreach($feature_array as $key => $value){
            $featureimg_id = $value;
            $featureimg_order = $order_array[$key];

            $featureImg->update('FeatureImage', array('sequence' => $featureimg_order), 'id='.$featureimg_id);
        }
        Flash::set('success', __('The Feature image sequence has been saved.'));
        redirect(get_url('facilities/edit/'.$facilities_id));
    }
	
}

?>