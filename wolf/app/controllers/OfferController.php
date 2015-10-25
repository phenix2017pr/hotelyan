<?php

class OfferController extends Controller
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
    	$this->assignToLayout('sidebar', new View('offer/sidebar'));
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
		$offer = null;
		if (isset($data)){
			$offer = new Offer($data);
		}
		
		$this->display('offer/edit', array(
			'action'  => 'add',
			'csrf_token' => SecureToken::generateToken(BASE_URL.'offer/add'),
			'offer' => $offer,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
		));
	}

	private function _add() {
		use_helper('Validate');
		$data = $_POST['offer'];
		Flash::set('offer_postdata', $data);
		// Add pre-save checks here
		$errors = false;

		// CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'offer/add')) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('offer/add'));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('offer/add'));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a offer name!'));
			redirect(get_url('offer/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('offer/add'));
		}

		$new_offer = new Offer($data);				
		$new_offer->created_by_id = AuthUser::getId();
		$new_offer->created_on = date('Y-m-d H:i:s');
		if ($new_offer->save()) {
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0||strlen($_FILES['upload_file_home']['name'])>0){
					$offer_id = $new_offer->lastInsertId();
					
					$overwrite=false;
					if(strlen($_FILES['upload_file']['name'])>0){
						$file = $this->upload_pdf_file($offer_id, $_FILES['upload_file']['name'], FILES_DIR.'/offer/images/', $_FILES['upload_file']['tmp_name'], $overwrite);
					}
					if(strlen($_FILES['upload_file_home']['name'])>0){
						$file2 = $this->upload_pdf_file2($offer_id, $_FILES['upload_file_home']['name'], FILES_DIR.'/offer/home/', $_FILES['upload_file_home']['tmp_name'], $overwrite);
					}
					if ($file === false||$file2 === false)
					Flash::set('error', __('File has not been uploaded!'));
		            redirect(get_url('offer/edit/'.$new_offer->id));
	        	}
			}
			
			Flash::set('success', __('Offer has been added!'));
			Observer::notify('offer_after_add', $new_offer->name);

			// save and quit or save and continue editing?
			if (isset($_POST['commit']))
				redirect(get_url('offer'));
			else
	            redirect(get_url('offer/edit/'.$new_offer->id));
		}
		else {
			Flash::set('error', __('Offer has not been added!'));
			redirect(get_url('offer/add'));
		}
	}
	
	function upload_pdf_file($offerid, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['offer'];
			Flash::set('post_data', (object) $data);

			$offer = Offer::findById($offerid);
			$offer->filename = $file_name;

			if ( ! $offer->save())
				Flash::set('error', __('Feature file could not be uploaded!'));
			else
				Flash::set('success', __('Feature file has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file
	
	function upload_pdf_file2($offerid, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['offer'];
			Flash::set('post_data', (object) $data);

			$offer = Offer::findById($offerid);
			$offer->filename_home = $file_name;

			if ( ! $offer->save())
				Flash::set('error', __('Home Imagecould not be uploaded!'));
			else
				Flash::set('success', __('Home Image has been added!'));

			// change mode of the dire to 0644 by default
			chmod($full_dest, 0644);
			return $file_name;
		}

		return false;
	} // upload_file
	
    public function edit($id)
    {
    	if (!$offer = Offer::findById($id))
        {
            Flash::set('error', __('Offer not found!'));
            redirect(get_url('offer'));
        }

        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);

		$offergalleries = OfferImage::findByOfferId($id);
		//$features = FeatureImage::findByOfferId($id);
		$this->display('offer/edit', array(
            'action'  => 'edit',
            'csrf_token' => SecureToken::generateToken(BASE_URL.'offer/edit/'.$id),
			'offer' => $offer,
			'offergalleries' => $offergalleries,
			//'features' => $features,
			'id' => $id,
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')
        ));
    }

    private function _edit($id){
        use_helper('Validate');
        $data = $_POST['offer'];
        Flash::set('offer_postdata', $data);

        $errors = false;
        // CSRF checks
		if (isset($_POST['csrf_token'])) {
			$csrf_token = $_POST['csrf_token'];
			if (!SecureToken::validateToken($csrf_token, BASE_URL.'offer/edit/'.$id)) {
				Flash::set('error', __('Invalid CSRF token found!'));
				redirect(get_url('offer/edit/'.$id));
			}
		}
		else {
			Flash::set('error', __('No CSRF token found!'));
			redirect(get_url('offer/edit/'.$id));
		}
		if (empty($data['name'])){
			Flash::set('error', __('You have to specify a name!'));
			redirect(get_url('offer/add'));
		}

		if ($errors !== false) {
			// Set the errors to be displayed.
			Flash::set('error', implode('<br/>', $errors));
			redirect(get_url('offer/edit/'.$id));
		}

      	$offer = Record::findByIdFrom('Offer', $id);
        $offer->setFromData($data);
		$offer->updated_by_id = AuthUser::getId();
		$offer->updated_on = date('Y-m-d H:i:s');
			
	    if ($offer->save()) {
	    	// print_r($_FILES);exit;
			if (isset($_FILES)) {
				if(strlen($_FILES['upload_file']['name'])>0||strlen($_FILES['upload_file_home']['name'])>0){
					$overwrite=false;
					
					if(strlen($_FILES['upload_file']['name'])>0){
						$file = $this->upload_pdf_file($id, $_FILES['upload_file']['name'], FILES_DIR.'/offer/images/', $_FILES['upload_file']['tmp_name'], $overwrite);
					}
					if(strlen($_FILES['upload_file_home']['name'])>0){
						$file2 = $this->upload_pdf_file2($id, $_FILES['upload_file_home']['name'], FILES_DIR.'/offer/home/', $_FILES['upload_file_home']['tmp_name'], $overwrite);
					}
					
					if ($file === false||$file2 === false)
					Flash::set('error', __('File has not been uploaded!'));
		            redirect(get_url('offer/edit/'.$id));
	        	}
			}
			
			Flash::set('success', __('Offer has been saved!'));
			Observer::notify('offer_after_edit', $offer->name);
		}
		else {
			Flash::set('error', __('Offer has not been saved!'));
		}

		// save and quit or save and continue editing?
		if (isset($_POST['commit']))
			redirect(get_url('offer'));
		else
            redirect(get_url('offer/edit/'.$id));
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

		$this->display('offer/index', array(
            'offers' => Record::query('select * from '.TABLE_PREFIX.'offer ORDER BY '.TABLE_PREFIX.'offer.sequence, '.TABLE_PREFIX.'offer.id desc'),
			'pages' => Record::findAllFrom('Page','parent_id=1 order by parent_id,position')			
        ));
    } // browse

    function delete($id){
        $offer = Record::findByIdFrom('Offer', $id);

        // find the offer to delete
        if ($offer)
        {
            if ($offer->delete())
                Flash::set('success', __('This offer has been deleted.'));
            else
                Flash::set('error', __('This offer has not been deleted!'));
        }
        else Flash::set('error', __('Offer not found!'));

		redirect(get_url('offer'));
    }

    public function upload($id){
		$this->_checkPermission();
		$data = $_POST['upload'];
		$path = str_replace('..', '', $data['path']);
		$overwrite = isset($data['overwrite']) ? true: false;

		$title = $_POST['title'];
		if (isset($_FILES))
		{
			$file = $this->upload_file($id, -1, $title, $_FILES['upload_file']['name'], FILES_DIR.'/offer/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('offer/edit/'.$id));
    }
	
	function edit_offer_image($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'offer/edit_offer_image/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('offer/edit_offer_image/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('offer/edit_offer_image/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$offerImage = OfferImage::findById($id);
			if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/offer/gallery/'.$_FILES['upload_file']['tmp_name'])){			
				$file = $this->upload_file($offerImage->offerid, $offerImage->id, $title, $_FILES['upload_file']['name'], FILES_DIR.'/offer/gallery/', $_FILES['upload_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('offer/edit_offer_image/'.$id));
				}
			} else {
				$offerImage->title = $title;

				if ( ! $offerImage->save())
					Flash::set('error', __('Offer image could not be saved!'));
				else
					Flash::set('success', __('Offer image has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('offer/edit/'.$offerImage->offerid));
			else
				redirect(get_url('offer/edit_offer_image/'.$id));
				
		} else { // display edit page
			$offerImage = OfferImage::findById($id);
			$this->display('offer/edit_offer_image', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'offer/edit_offer_image/'.$id),
				'offerimage' => $offerImage
			));
		}
	}
	
	function upload_file($offerid, $imageid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['offer'];
			Flash::set('post_data', (object) $data);

			if ($imageid == -1){
				$offerimage = new OfferImage();
				$offerimage->offerid = $offerid;
			} else {
				$offerimage = OfferImage::findById($imageid);
			}
			$offerimage->title = $title;
			$offerimage->filename = $file_name;

			if ( ! $offerimage->save())
				Flash::set('error', __('Offer image has not been added!'));
			else
				Flash::set('success', __('Offer image has been added!'));

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
			$file = $this->upload_feature_file($id, $featureid, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/offer/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

			if ($file === false)
			   Flash::set('error', __('File has not been uploaded!'));
		}
		redirect(get_url('offer/edit/'.$id));
    }
	
	function edit_feature($id){
		// check if trying to save
		if (get_request_method() == 'POST') { // form submission
			$this->_checkPermission();
			
			if (isset($_POST['csrf_token'])) {
				$csrf_token = $_POST['csrf_token'];
				if (!SecureToken::validateToken($csrf_token, BASE_URL.'offer/edit_feature/'.$id)) {
					Flash::set('error', __('Invalid CSRF token found!'));
					redirect(get_url('offer/edit_feature/'.$id));
				}
			}
			else {
				Flash::set('error', __('No CSRF token found!'));
				redirect(get_url('offer/edit_feature/'.$id));
			}
			
			$data = $_POST['upload'];
			$path = str_replace('..', '', $data['path']);
			$overwrite = isset($data['overwrite']) ? true: false;

			$title = $_POST['title'];
			$featureimage = FeatureImage::findById($id);
			if(!empty($_FILES['upload_feature_file']['name']) && !file_exists(FILES_DIR.'/offer/feature/'.$_FILES['upload_feature_file']['tmp_name'])){			
				$file = $this->upload_feature_file($featureimage->offerid, $featureimage->id, $title, $_FILES['upload_feature_file']['name'], FILES_DIR.'/offer/feature/', $_FILES['upload_feature_file']['tmp_name'], $overwrite);

				if ($file === false) {
				   Flash::set('error', __('File has not been uploaded!'));
				   redirect(get_url('offer/edit_feature/'.$id));
				}
			} else {
				$featureimage->title = $title;

				if ( ! $featureimage->save())
					Flash::set('error', __('Feature could not be saved!'));
				else
					Flash::set('success', __('Feature has been saved!'));
			}
			
			if (isset($_POST['commit']))
				redirect(get_url('offer/edit/'.$featureimage->offerid));
			else
				redirect(get_url('offer/edit_feature/'.$id));
				
		} else { // display edit page
			$feature = FeatureImage::findById($id);
			$this->display('offer/edit_feature', array(
				'csrf_token' => SecureToken::generateToken(BASE_URL.'offer/edit_feature/'.$id),
				'feature' => $feature
			));
		}
    }
	
	function upload_feature_file($offerid, $featureid, $title, $origin, $dest, $tmp_name, $overwrite=false){
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
			$data = $_POST['offer'];
			Flash::set('post_data', (object) $data);

			if ($featureid == -1){
				$featureimage = new FeatureImage();
				$featureimage->offerid = $offerid;
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

		$offerimage = Record::findByIdFrom('OfferImage', $id);
		if ($offerimage){
			$file = FILES_DIR.'/offer/gallery/'.$offerimage->filename;
			$filename = array_pop($paths);
			$paths = join('/', $paths);

			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}

			// delete record
			if ($offerimage->delete())
				Flash::set('success', __('This offer image has been deleted.'));
			else
				Flash::set('error', __('This offer image has not been deleted!'));
		}
        else Flash::set('error', __('Offer image not found!'));

		redirect(get_url('offer/edit/'.$offerimage->offerid));
    }
	
	function delete_mainimage($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$featureimage = Record::findByIdFrom('Offer', $id);
		if ($featureimage){
			$file = FILES_DIR.'/offer/images/'.$featureimage->filename;
			
			$filename = array_pop($paths);
			$paths = join('/', $paths);
			
			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}
			
			//$featureimage->filename="";
			
			// delete record
			if ($featureimage->update('Offer', array('filename' => ''), 'id='.$id))
				Flash::set('success', __('This  image has been deleted.'));
			else
				Flash::set('error', __('This image could not be deleted!'));
		}
        else Flash::set('error', __('image could not be found!'));

		redirect(get_url('offer/edit/'.$featureimage->id));
    }
	
	function delete_homeimage($id){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));

		$featureimage = Record::findByIdFrom('Offer', $id);
		if ($featureimage){
			$file = FILES_DIR.'/offer/home/'.$featureimage->filename;
			
			$filename = array_pop($paths);
			$paths = join('/', $paths);
			
			if (is_file($file))	{
				if ( ! unlink($file))
					Flash::set('error', __('Permission denied!'));
			}
			
			//$featureimage->filename="";
			
			// delete record
			if ($featureimage->update('Offer', array('filename_home' => ''), 'id='.$id))
				Flash::set('success', __('This  image has been deleted.'));
			else
				Flash::set('error', __('This image could not be deleted!'));
		}
        else Flash::set('error', __('image could not be found!'));

		redirect(get_url('offer/edit/'.$featureimage->id));
    }

    public function save_order(){
        $offer_array = $_POST['offer_id'];
        $order_array = $_POST['order'];

        $offer = new Offer;
        foreach($offer_array as $key => $value){
            $offer_id = $value;
            $offer_order = $order_array[$key];

            $offer->update('Offer', array('sequence' => $offer_order), 'id='.$offer_id);
        }
        Flash::set('success', __('This offer sequence has been saved.'));
        redirect(get_url('offer'));
    }
	
	public function save_imageorder(){
        $offer_array = $_POST['offerimage_id'];
		$offer_id 	= $_POST['offer_id'];
        $order_array = $_POST['order'];

        $offerImg = new OfferImage;
        foreach($offer_array as $key => $value){
            $offerimg_id = $value;
            $offerimg_order = $order_array[$key];

            $offerImg->update('OfferImage', array('sequence' => $offerimg_order), 'id='.$offerimg_id);
        }
        Flash::set('success', __('The offer image sequence has been saved.'));
        redirect(get_url('offer/edit/'.$offer_id));
    }
	
	public function save_featureimageorder(){
        $feature_array = $_POST['featureimage_id'];
		$offer_id 	= $_POST['offer_id'];
        $order_array = $_POST['order'];

        $featureImg = new FeatureImage;
        foreach($feature_array as $key => $value){
            $featureimg_id = $value;
            $featureimg_order = $order_array[$key];

            $featureImg->update('FeatureImage', array('sequence' => $featureimg_order), 'id='.$featureimg_id);
        }
        Flash::set('success', __('The Feature image sequence has been saved.'));
        redirect(get_url('offer/edit/'.$offer_id));
    }
	
}

?>