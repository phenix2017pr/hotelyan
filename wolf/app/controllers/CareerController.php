<?php

class CareerController extends Controller
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
    	$this->assignToLayout('sidebar', new View('career/sidebar'));
    }

    public function index()
    {
         $this->browse();
    }

    public function view(){
		$this->_checkPermission();
		$paths = func_get_args();

		$id = urldecode(join('/', $paths));
		$mycareer = Record::query('select * from '.TABLE_PREFIX.'career where id="'.$id.'"');
		$career = $mycareer->fetchObject();

		$this->display('career/view', array(
			'career' => $career
		));
	}

	public function create(){
		$this->_checkPermission();
		$paths = func_get_args();

		$this->display('career/create');
	}

   	public function add_career(){
	 	$this->_checkPermission();

		$data = $_POST['career'];
		Flash::set('postdata', $data);

		// verification
		if (empty($data['title'])){
			Flash::set('error', __('You have to specify a job title!'));
			redirect(get_url('career/create'));
		}
		
		// if (empty($data['contact_person'])){
		// 	Flash::set('error', __('You have to specify the contact email!'));
		// 	redirect(get_url('career/create'));
		// }
		
		if (empty($data['posted_date'])){
			Flash::set('error', __('You have to specify the posted date!'));
			redirect(get_url('career/create'));
		}
		
		if (empty($data['closing_date'])){
			Flash::set('error', __('You have to specify the closing date!'));
			redirect(get_url('career/create'));
		}

		$career = new Career($data);
		$career->posted_date = date("Y-m-d", strtotime($career->posted_date));
		$career->closing_date = date("Y-m-d", strtotime($career->closing_date));
		$career->status = 1;
		$career->created_by_id = AuthUser::getId();
		$career->created_on = date('Y-m-d H:i:s');
		if (!$career->save()) {
			Flash::set('error', __('Career is not added!'));
			redirect(get_url('career/create'));
		} else {		
			Flash::set('success', __('Career has been added!'));
			if (isset($_POST['commit']))
				redirect(get_url('career'));
			else
				redirect(get_url('career/view/'.$career->lastInsertId()));
		}
		redirect(get_url('career'));
   	}

 	public function edit($id){
	    if($_POST["action"]=="edit"){
		    $data = $_POST['career'];
		    Flash::set('postdata', $data);

		   	$career = Record::findByIdFrom('Career', $id);
			if (!$career) {
				Flash::set('error', __('Career not found!'));
				redirect(get_url('career'));
			}

			$save = true;
		    // verification
			if (empty($data['title'])){
				Flash::set('error', __('You have to specify a job title!'));
				redirect(get_url('career/view/'.$id));
			}
			
			// if (empty($data['contact_person'])){
			// 	Flash::set('error', __('You have to specify the contact email!'));
			// 	redirect(get_url('career/view/'.$id));
			// }
			
			if (empty($data['posted_date'])){
				Flash::set('error', __('You have to specify the posted date!'));
				redirect(get_url('career/view/'.$id));
			}
			
			if (empty($data['closing_date'])){
				Flash::set('error', __('You have to specify the closing date!'));
				redirect(get_url('career/view/'.$id));
			}

			$career->setFromData($data);			
			$career->posted_date = date("Y-m-d", strtotime($career->posted_date));
			$career->closing_date = date("Y-m-d", strtotime($career->closing_date));
			$career->updated_by_id = AuthUser::getId();
			$career->updated_on = date('Y-m-d H:i:s');
			if (!$career->save()) {
				 Flash::set('error', __('Career is not updated!'));
				 redirect(get_url('career/view/'.$id));
			}
			else {
				Flash::set('success', __('Career has been updated!'));

				if (isset($_POST['commit']))
					redirect(get_url('career'));
				else
					redirect(get_url('career/view/'.$id));
			}
        }
    }

    public function add()
	{
		// check if trying to save
		if (get_request_method() == 'POST')
			return $this->_add();

		// check if user have already enter something
		$career = Flash::get('post_data');

		if (empty($career))
			$career = new Career;

		$this->browse();
	}


    public function browse(){
        $this->_checkPermission();
        $params = func_get_args();

        $this->path = join('/', $params);
        // make sure there's a / at the end
        if (substr($this->path, -1, 1) != '/') $this->path .= '/';

        $careers = Record::query('select * from '.TABLE_PREFIX.'career ORDER BY sequence asc, id desc');
        $this->display('career/index', array(
            'careers' => $careers
        ));
    } // browse

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

		    $career = Record::findByIdFrom('Career', $id);

		    //Remove folders and all images
        $dir = FILES_DIR.'/career/images/'.$career->image;
		    unlink($dir);
    	  // End remove folders and all images

        if ($career->delete()) {
            Flash::set('success', __('This career has been deleted.'));
        }
        else
        	Flash::set('error', __('This career has not been deleted!'));

        redirect(get_url('career'));
    }

    public function save_order(){
        $career_array = $_POST['career_id'];
        $order_array = $_POST['order'];

        $career = new Career;
        foreach($career_array as $key => $value){
            $career_id = $value;
            $career_order = $order_array[$key];

            $career->update('Career', array('sequence' => $career_order), 'id='.$career_id);
        }
        Flash::set('success', __('This career sequence has been saved.'));
        redirect(get_url('career'));
    }
}
?>