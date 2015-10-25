<?php

class AttractionController extends Controller
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
    	$this->assignToLayout('sidebar', new View('attraction/sidebar'));
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
		$attraction = null;
		if (isset($data)){
			$attraction = new Attraction($data);
		}
		
		$this->display('attraction/edit', array(
			'action'  => 'add',
			'csrf_token' => SecureToken::generateToken(BASE_URL.'attraction/add'),
			'attraction' => $attraction,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
		));
	}

	private function _add() {
		use_helper('Validate');
		$data = $_POST['attraction'];
		Flash::set('attraction_postdata', $data);
		// Add pre-save checks here
		$errors = false;

		// CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'attraction/add')) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('attraction/add'));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('attraction/add'));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a attraction name!'));
			redirect(get_url('attraction/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('attraction/add'));
		}

		$oAttraction = new Attraction();
		$last_seq = $oAttraction->getLastAttractionSeq();

		$new_attraction = new Attraction($data);				
		$new_attraction->created_by_id = AuthUser::getId();
		$new_attraction->created_on = date('Y-m-d H:i:s');
		$new_attraction->sequence = $last_seq+1;

		if ($new_attraction->save()) {
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0){
					$attraction_id = $new_attraction->lastInsertId();
					
					$overwrite=false;
					$file = $this->upload_attraction_main_image($attraction_id, $_FILES['upload_file']['name'], FILES_DIR.'/attraction/images/', $_FILES['upload_file']['tmp_name'], $overwrite);

					if ($file === false){
						Flash::set('error', __('Image has not been uploaded!'));
		            	redirect(get_url('attraction/edit/'.$new_attraction->id));
		        	}
	        	}
			}
			
			Flash::set('success', __('Attraction has been added!'));
			Observer::notify('attraction_after_add', $new_attraction->name);

			// save and quit or save and continue editing?
			if (isset($_POST['commit']))
				redirect(get_url('attraction'));
			else
	            redirect(get_url('attraction/edit/'.$new_attraction->id));
		}
		else {
			Flash::set('error', __('Attraction has not been added!'));
			redirect(get_url('attraction/add'));
		}
	}
	
	function upload_attraction_main_image($attractionid, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['attraction'];
			Flash::set('post_data', (object) $data);

			$attraction = Attraction::findById($attractionid);
			$attraction->filename = $file_name;

			if ( ! $attraction->save())
				Flash::set('error', __('Image could not be uploaded!'));
			else
				Flash::set('success', __('Image has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file

    public function edit($id)
    {
    	if (!$attraction = Attraction::findById($id))
        {
            Flash::set('error', __('Attraction not found!'));
            redirect(get_url('attraction'));
        }

        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);

		$attractiongalleries = AttractionImage::findByAttractionId($id);
		// $features = FeatureImage::findByAttractionId($id);
		$this->display('attraction/edit', array(
            'action'  => 'edit',
            'csrf_token' => SecureToken::generateToken(BASE_URL.'attraction/edit/'.$id),
			'attraction' => $attraction,
			'attractiongalleries' => $attractiongalleries,
			// 'features' => $features,
			'id' => $id,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
        ));
    }

    private function _edit($id){
        use_helper('Validate');
        $data = $_POST['attraction'];
        Flash::set('attraction_postdata', $data);

        $errors = false;
        // CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'attraction/edit/'.$id)) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('attraction/edit/'.$id));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('attraction/edit/'.$id));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a name!'));
			redirect(get_url('attraction/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('attraction/edit/'.$id));
		}

      	$attraction = Record::findByIdFrom('Attraction', $id);
        $attraction->setFromData($data);
		$attraction->updated_by_id = AuthUser::getId();
		$attraction->updated_on = date('Y-m-d H:i:s');
			
	    if ($attraction->save()) {
	    	// print_r($_FILES);exit;
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0){
					$overwrite=false;
					$file = $this->upload_attraction_main_image($id, $_FILES['upload_file']['name'], FILES_DIR.'/attraction/images/', $_FILES['upload_file']['tmp_name'], $overwrite);

					if ($file === false)
					Flash::set('error', __('File has not been uploaded!'));
		            redirect(get_url('attraction/edit/'.$id));
	        	}
			}
			
			Flash::set('success', __('Attraction has been saved!'));
			Observer::notify('attraction_after_edit', $attraction->name);
		}
		else {
			Flash::set('error', __('Attraction has not been saved!'));
		}

		// save and quit or save and continue editing?
		if (isset($_POST['commit']))
			redirect(get_url('attraction'));
		else
            redirect(get_url('attraction/edit/'.$id));
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

		$this->display('attraction/index', array(
            'attractions' => Record::query('select * from '.TABLE_PREFIX.'attraction ORDER BY '.TABLE_PREFIX.'attraction.sequence, '.TABLE_PREFIX.'attraction.id desc'),
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')			
        ));
    } // browse

    function delete($id){
        $attraction = Record::findByIdFrom('Attraction', $id);

        // find the attraction to delete
        if ($attraction)
        {

			//Remove folders and all images
	        $dir = FILES_DIR.'/attraction/images/'.$attraction->filename;
			unlink($dir);
			// End remove folders and all images

            if ($attraction->delete())
                Flash::set('success', __('This attraction has been deleted.'));
            else
                Flash::set('error', __('This attraction has not been deleted!'));
        }
        else Flash::set('error', __('Attraction not found!'));

		redirect(get_url('attraction'));
    }

    public function upload($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];
		$distance = $_POST['distance'];
		if (isset($_FILES))
		{
			$file = $this->upload_file($id, -1, $title, $distance, $_FILES['upload_file']['name'], FILES_DIR.'/attraction/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('attraction/edit/'.$id));
    }
	
	function edit_attraction_image($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'attraction/edit_attraction_image/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('attraction/edit_attraction_image/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('attraction/edit_attraction_image/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$distance = $_POST['distance'];
			$attractionImage = AttractionImage::findById($id);
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/attraction/gallery/'.$_FILES['upload_file']['tmp_name'])){			
				$file = $this->upload_file($attractionImage->attractionid, $attractionImage->id, $title, $distance, $_FILES['upload_file']['name'], FILES_DIR.'/attraction/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('attraction/edit_attraction_image/'.$id));
				}
			} else {
				$attractionImage->title = $title;
				$attractionImage->distance = $distance;

				if ( ! $attractionImage->save())
					Flash::set('error', __('Attraction image could not be saved!'));
				else
					Flash::set('success', __('Attraction image has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('attraction/edit/'.$attractionImage->attractionid));
			else
				redirect(get_url('attraction/edit_attraction_image/'.$id));
				
		} else { // display edit page
			$attractionImage = AttractionImage::findById($id);
			$this->display('attraction/edit_attraction_image', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'attraction/edit_attraction_image/'.$id),
				'attractionimage' => $attractionImage
			));
		}
	}
	
	function upload_file($attractionid, $imageid, $title, $distance, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['attraction'];
			Flash::set('post_data', (object) $data);

			if ($imageid == -1){
				$attractionimage = new AttractionImage();
				$attractionimage->attractionid = $attractionid;
			} else {
				$attractionimage = AttractionImage::findById($imageid);
			}
			$last_seq = $attractionimage->getLastAttractionImageSeq($attractionid);
			$attractionimage->title = $title;
			$attractionimage->distance = $distance;
			$attractionimage->filename = $file_name;
			$attractionimage->filename = $file_name;
			$attractionimage->sequence = $last_seq+1;

			if ( ! $attractionimage->save())
				Flash::set('error', __('Attraction image has not been added!'));
			else
				Flash::set('success', __('Attraction image has been added!'));

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
			$file = $this->upload_feature_file($id, $featureid, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/attraction/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('attraction/edit/'.$id));
    }
	
	function edit_feature($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'attraction/edit_feature/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('attraction/edit_feature/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('attraction/edit_feature/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$featureimage = FeatureImage::findById($id);
			if(!empty($_FILES['upload_feature_file']['name']) && !file_exists(FILES_DIR.'/attraction/feature/'.$_FILES['upload_feature_file']['tmp_name'])){			
				$file = $this->upload_feature_file($featureimage->attractionid, $featureimage->id, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/attraction/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('attraction/edit_feature/'.$id));
				}
			} else {
				$featureimage->title = $title;

				if ( ! $featureimage->save())
					Flash::set('error', __('Feature could not be saved!'));
				else
					Flash::set('success', __('Feature has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('attraction/edit/'.$featureimage->attractionid));
			else
				redirect(get_url('attraction/edit_feature/'.$id));
				
		} else { // display edit page
			$feature = FeatureImage::findById($id);
			$this->display('attraction/edit_feature', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'attraction/edit_feature/'.$id),
				'feature' => $feature
			));
		}
    }
	
	function upload_feature_file($attractionid, $featureid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['attraction'];
			Flash::set('post_data', (object) $data);

			if ($featureid == -1){
				$featureimage = new FeatureImage();
				$featureimage->attractionid = $attractionid;
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

		$attractionimage = Record::findByIdFrom('AttractionImage', $id);
		if ($attractionimage){
			$file = FILES_DIR.'/attraction/gallery/'.$attractionimage->filename;
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($attractionimage->delete())
				Flash::set('success', __('This attraction image has been deleted.'));
			else
				Flash::set('error', __('This attraction image has not been deleted!'));
		}
        else Flash::set('error', __('Attraction image not found!'));

		redirect(get_url('attraction/edit/'.$attractionimage->attractionid));
    }
	
	function delete_featureimage($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$featureimage = Record::findByIdFrom('FeatureImage', $id);
		if ($featureimage){
			$file = FILES_DIR.'/attraction/feature/'.$featureimage->filename;
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($featureimage->delete())
				Flash::set('success', __('This Feature image has been deleted.'));
			else
				Flash::set('error', __('This Feature image could not be deleted!'));
		}
        else Flash::set('error', __('Feature image could not be found!'));

		redirect(get_url('attraction/edit/'.$featureimage->attractionid));
    }

    public function save_order(){
        $attraction_array = $_POST['attraction_id'];
        $order_array = $_POST['order'];

        $attraction = new Attraction;
        foreach($attraction_array as $key => $value){
            $attraction_id = $value;
            $attraction_order = $order_array[$key];

            $attraction->update('Attraction', array('sequence' => $attraction_order), 'id='.$attraction_id);
        }
        Flash::set('success', __('This attraction sequence has been saved.'));
        redirect(get_url('attraction'));
    }
	
	public function save_imageorder(){
        $attraction_array = $_POST['attractionimage_id'];
		$attraction_id 	= $_POST['attraction_id'];
        $order_array = $_POST['order'];

        $attractionImg = new AttractionImage;
        foreach($attraction_array as $key => $value){
            $attractionimg_id = $value;
            $attractionimg_order = $order_array[$key];

            $attractionImg->update('AttractionImage', array('sequence' => $attractionimg_order), 'id='.$attractionimg_id);
        }
        Flash::set('success', __('The attraction image sequence has been saved.'));
        redirect(get_url('attraction/edit/'.$attraction_id));
    }
	
	public function save_featureimageorder(){
        $feature_array = $_POST['featureimage_id'];
		$attraction_id 	= $_POST['attraction_id'];
        $order_array = $_POST['order'];

        $featureImg = new FeatureImage;
        foreach($feature_array as $key => $value){
            $featureimg_id = $value;
            $featureimg_order = $order_array[$key];

            $featureImg->update('FeatureImage', array('sequence' => $featureimg_order), 'id='.$featureimg_id);
        }
        Flash::set('success', __('The Feature image sequence has been saved.'));
        redirect(get_url('attraction/edit/'.$attraction_id));
    }
	
}

?>