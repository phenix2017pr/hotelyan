<?php

class BannerController extends Controller
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
    	$this->assignToLayout('sidebar', new View('banner/sidebar'),array(
    		'banners' => Record::findAllFrom('Banner', '1=1 ORDER BY sequence'))
    	);
    }
    
    public function index()
    {
         $this->browse();     
    }

    public function edit($id)
    {
        if ( ! $banner = Banner::findById($id))
        {
            Flash::set('error', __('Banner not found!'));
            redirect(get_url('banner'));
        }
        
        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_edit($id);
        
        $this->display('banner/view', array(
            'banner' => $banner
        ));
    }
     
    private function _edit($id){
        
        $data = $_POST['banner'];
        
        $data['id'] = $id;
        
        $banner = new Banner($data);

        if ( ! $banner->save())
        {
            Flash::set('error', __('Banner has not been saved'));
            redirect(get_url('banner/view/'.$id));
        }
        else
        {
	        $this->edit_upload($id);
            Flash::set('success', __('Banner has been saved!'));
        }
        
        // save and quit or save and continue editing?
		if (isset($_POST['commit']))
            redirect(get_url('banner'));
        else
            redirect(get_url('banner/view/'.$id)); 
    }
    
    public function approval($id,$approval)
    {

        if ($banner = Record::findByIdFrom('Banner', $id))
        {
         
            $banner = Record::findByIdFrom('Banner', $id);
			$banner->approval = $approval;
			$banner->save();
			
			if($approval=="1"){
            	Flash::set('success', __('Selected banner has been approved.'));
        	}else{
	        	Flash::set('success', __('Selected banner has been rejected.'));
        	}
                  
        }
        else Flash::set('error', __('Banner is not found!'));
              

        redirect(get_url('banner'));

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
        
        $this->fullpath = FILES_DIR.'/banner/';
        
        // clean up nicely
        $this->fullpath = preg_replace('/\/\//', '/', $this->fullpath);
        
        $this->display('banner/index', array(
            'dir'   => $this->path,
            'files' => $this->_getListFiles(),
            'banners' => Record::findAllFrom('Banner', '1=1 ORDER BY type,page_id,location,sequence'),
            'pages' => Record::findAllFrom('Page','parent_id=1 OR parent_id=0 order by parent_id,position')
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
                $object->link = '<a href="'.get_url('banner/view'.$this->path.$file).'">'.$file.'</a>';
         
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
    
    public function add()
    {
        // check if trying to save
        if (get_request_method() == 'POST')
            return $this->_add();
        
        // check if user have already enter something
        $banner = Flash::get('post_data');
        
        if (empty($banner))
            $banner = new Banner;
        
//         $this->display('banner/index', array(
//             'action'  => 'add',
//             'filters' => Filter::findAll(),
//             'banner' => $banner
//         ));
        $this->browse();
    }
             
    public function upload(){
          
   
        $this->_checkPermission();
        $data = $_POST['upload'];
        $path = str_replace('..', '', $data['path']);
        $overwrite = isset($data['overwrite']) ? true: false;

        if (isset($_FILES))
        {
            $file = $this->upload_file($_FILES['upload_file']['name'], FILES_DIR.'/banner/', $_FILES['upload_file']['tmp_name'], $overwrite);
            
            if ($file === false)
               Flash::set('error', __('File has not been uploaded!'));
        }
        
        redirect(get_url('banner'));	
           
    }
    
	function upload_file($origin, $dest, $tmp_name, $overwrite=false){
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
        	
	    if (move_uploaded_file($tmp_name, $full_dest))
	    {
    	    //Add Banner to database
            $data = $_POST['banner'];
            Flash::set('post_data', (object) $data);
            
            $last_banner = Record::query('Select sequence from '.TABLE_PREFIX.'banner order by sequence desc LIMIT 0,1');
            $last_banner = $last_banner->fetchObject();		
            $last_seq = $last_banner->sequence;  
            
            $banner = new Banner($data);
            $banner->filename = $file_name;
            $banner->source = URL_PUBLIC.'public/banner/'.$file_name;
            $banner->sequence = $last_seq + 1;
             
            if ( ! $banner->save())
            {
                Flash::set('error', __('Banner has not been added. Name must be unique!'));
                redirect(get_url('banner', 'add'));
            }
            else
            {
                Flash::set('success', __('Banner has been added!'));
                //Observer::notify('snippet_after_add', $banner);
            }               
        
	        // change mode of the dire to 0644 by default
	        chmod($full_dest, 0644);
	        return $file_name;
	    }
	    
	    return false;
	} // upload_file   

	public function edit_upload($id){  
        $this->_checkPermission();
        $data = $_POST['upload'];
        $path = str_replace('..', '', $data['path']);
        $overwrite = isset($data['overwrite']) ? true: false;
		$overwrite = true;
		
        if (isset($_FILES))
        {
	       if(!empty($_FILES['upload_file']['name']) && !file_exists(FILES_DIR.'/banner/'.$_FILES['upload_file']['tmp_name'])){			       	
		        //Remove existing image
				$exist_banners = Record::query('Select filename from '.TABLE_PREFIX.'banner where id="'.$id.'"');
				$exist_banner = $exist_banners->fetchObject();		
				$old_file_name = $exist_banner->filename;
				if(file_exists(FILES_DIR.'/banner/'.$old_file_name) && $old_file_name!=""){
					unlink(FILES_DIR.'/banner/'.$old_file_name);	
				}
				
	            $file = $this->edit_upload_file($_FILES['upload_file']['name'], FILES_DIR.'/banner/', $_FILES['upload_file']['tmp_name'], $overwrite,$id);
	            
	            if ($file === false)
	               Flash::set('error', __('File has not been uploaded!'));
           }
        }
        	
    }
    
	function edit_upload_file($origin, $dest, $tmp_name, $overwrite=false,$id){
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
        	
	    if (move_uploaded_file($tmp_name, $full_dest))
	    {
    	    //Add Banner to database
            $data = $_POST['banner'];
            Flash::set('post_data', (object) $data);
            
      	    $banner = Record::findByIdFrom('Banner', $id);
            $filename = $file_name;
            $source = URL_PUBLIC.'public/banner/'.$file_name;
            
           	if ( ! $banner->update('Banner', array('filename'=> $file_name,'source'=>$source), 'id='.$id))
            {
                Flash::set('error', __('Banner has not been added. Name must be unique!'));
                redirect(get_url('banner', 'add'));
            }
            else
            {
                Flash::set('success', __('Banner has been saved!'));
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
    
    public function view()
    {
        $this->_checkPermission();
        $params = func_get_args();
        $content = '';

        $id = urldecode(join('/', $params));
        $banner = Record::findByIdFrom('Banner', $id);
        
        $file = FILES_DIR.'/banner/'.$banner->filename;
  
        if ( ! $this->_isImage($file) && file_exists($file) && $banner->filename!="")
        {
            $content = file_get_contents($file);
        }

        
        $this->display('banner/view', array(
            'banner' => $banner,
            'pages' => Record::findAllFrom('Page','parent_id=1 OR parent_id=0 order by parent_id,position')
        ));
    }
     
    public function _isImage($file)
    {
        if ( ! @is_file($file))
            return false;
        else if ( ! preg_match('/^(.*).(jpe?g|gif|png)$/i', $file))
            return false;
        
        return true;
    }   
    
    function delete_banner(){
        $this->_checkPermission();
        $paths = func_get_args();
      
        $id = urldecode(join('/', $paths));

        $banner = Record::findByIdFrom('Banner', $id);
        
        $file = FILES_DIR.'/banner/'.$banner->filename;
        $filename = array_pop($paths);
        $paths = join('/', $paths);

        
        if (is_file($file))
        {
            if ( ! unlink($file))
                Flash::set('error', __('Permission denied!'));
        }
               
        // find the banner to delete
        if ($banner = Record::findByIdFrom('Banner', $id))
        {
            if ($banner->delete())
            {
                Flash::set('success', __('This banner has been deleted.'));
                Observer::notify('snippet_after_delete', $banner);
            }
            else
                Flash::set('error', __('This banner has not been deleted!'));
        }
        else Flash::set('error', __('Banner not found!'));
        
        redirect(get_url('banner'));
    }
    
    function delete_image($id){
        $this->_checkPermission();
        $paths = func_get_args();
      
        $id = urldecode(join('/', $paths));

        $banner = Record::findByIdFrom('Banner', $id);
        
        $file = FILES_DIR.'/banner/'.$banner->filename;
        $filename = array_pop($paths);
        $paths = join('/', $paths);

        
        if (is_file($file))
        {
            if ( ! unlink($file))
                Flash::set('error', __('Permission denied!'));
        }
               
        // find the banner to delete
        if ($banner = Record::findByIdFrom('Banner', $id))
        {
            if ($banner->update('Banner', array('filename' => '','source'=>''), 'id='.$id))
            {
                Flash::set('success', __('This image has been deleted.'));
            }
            else
                Flash::set('error', __('This image has not been deleted!'));
        }
        else Flash::set('error', __('Image not found!'));
        
        redirect(get_url('banner/view/'.$id));
    }
    
    public function save_order(){
        $banner_array = $_POST['banner_id'];
        $order_array = $_POST['order'];
                 
        $banner = new Banner;
        
        foreach($banner_array as $key => $value){
            $banner_id = $value;
            $banner_order = $order_array[$key];
            
            $banner->update('Banner', array('sequence' => $banner_order), 'id='.$banner_id);
             
        }
        redirect(get_url('banner'));   
    }
}

?>