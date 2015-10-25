<?php if (!defined('IN_CMS')) { exit(); }
/**
 * Image manipulation plugin for Wolf CMS <http://www.wolfcms.org> based on the Kohana Image.
 *
 * @package Plugins
 * @subpackage image
 *
 * @author Devi Mandiri <devi[dot]mandiri[at]gmail[dot]com>
 * @license UNLICENSE - http://unlicense.org
 *
 * Kohana license refer to http://kohanaframework.org/license
 */

class ImageController extends PluginController {

	// save temporary image for feature use
	protected $_image;

	protected $_image_root;

	protected $_width;
	protected $_height;

	public function __construct()
	{
		if (!function_exists('gd_info'))
		{
			if (! $this->_isInternal())
			{
				page_not_found();
			}
			else
			{
				// TODO: improve this
				Flash::set('error', 'Image - '.__('GD Library is either not installed or not enabled, check your phpinfo().'));
			}

			exit;
		}

		parent::__construct();

		if ($this->_isInternal())
		{
			$this->setLayout('backend');
			$this->assignToLayout('sidebar', new View('../../plugins/image/views/sidebar'));
		}

		// get setting from db
		$src = Plugin::getSetting('path', 'image');

		if ($src !== '/')
			$src = '/'.$src;

		if (substr($src, strlen($src) - 1) !== '/')
			$src = $src . '/';

		$this->_image_root = CMS_ROOT . $src;
	}

	public function index()
	{
		$this->settings();
	}

	public function settings()
	{
		if ( ! $this->_isInternal())
		{
			page_not_found();
		}

		$settings = Plugin::getAllSettings('image');

		if ( ! $settings) {
			Flash::setNow('error', 'Image - '.__('unable to retrieve plugin settings.'));
		}

		if ( ! isset($settings['path']) )
			$settings['path'] = '';

		$this->display('image/views/settings', $settings);
	}

	/*
	 * params:
	 *
	 * c = crop
	 * r = rotate
	 * f = flip
	 * s = sharpen
	 * other/null = resize
	 *
	 */
	public function wolfimage()
	{
		if ($this->_isInternal())
		{
			// sorry folks, external request only
			page_not_found();
		}

		$src = $this->_normalize_src($this->_get_request('src', ''));

		$this->_width = $this->_normalize_size($this->_get_request ('w'));
		$this->_height = $this->_normalize_size($this->_get_request ('h'));

		$this->_image = new Image($src);
		$cmd = $this->_get_request('c');

		switch ($cmd)
		{
			case 'c':
				$this->_cropImg();
			break;

			case 'r':
				$this->_rotateImg();
			break;

			case 'f':
				$this->_flipImg();
			break;

			case 's':
				$this->_sharpenImg();
			break;

			default:
				$this->_resizeImg();
		}

	}

	protected function _get_request($args, $default = NULL)
	{
		if (isset ($_GET[$args])) {
			return $_GET[$args];
		} else {
			return $default;
		}
	}

	// simple cleaning
	protected function _normalize_src($src)
	{
		if ($src == '' || strlen ($src) <= 4)
		{
			page_not_found();
		}
		// remove protocols
		//$src = preg_replace('#^[^:/.]*[:/]+#i', '', $src);
		$src = preg_replace('#^[a-z][a-z0-9+\-.]*:/#i', '', $src);

		// strip tags
		$src = preg_replace('/<[^>]*>/', '', $src);

		// is this necessary ?
		//$src = str_replace (' ', '%20', $src);

		// remove first slash
		$src = ltrim($src, '/');

		//if (substr($src, strlen($src) - 1) !== '/')
		$src = $this->_image_root.$src;

		// reduce slashes
		$src = preg_replace('#(?<!:)//+#', '/', $src);

		$src = realpath($src);

		// is file exists ?
		if ( ! file_exists($src))
		{
			page_not_found();
		}

		// check mime
		$info = getimagesize($src);

		if (!preg_match("/jpg|jpeg|gif|png/i", $info['mime']))
		{
			page_not_found();
		}

		return $src;
	}

	// only positive numbers
    protected function _normalize_size($size = NULL)
    {
		if ($size !== NULL)
			$size = preg_replace('/^-\d*\.{0,1}\d+$/', NULL, $size);

		return $size;
	}

	protected function _browserOutput()
	{
		try
		{
			header('Content-Type: '.$this->_image->mime);
			echo $this->_image;
		}
		catch (Exception $e)
		{
			return '';
		}
	}

	protected function _resizeImg()
	{
		// NULL = Image::AUTO
		$dimension = $this->_get_request('d');

		if ($dimension !== NULL)
		{
			switch ($dimension)
			{
				case 'i':
					$dimension = Image::INVERSE; // don't ask
				break;

				case 'n':
					$dimension = Image::NONE;
				break;
			}
		}

		if ($this->_width !== NULL || $this->_height !== NULL)
			$this->_image->resize($this->_width, $this->_height, $dimension);

		$this->_browserOutput();
	}


	protected function _cropImg()
	{
		$offset_x = $this->_normalize_size($this->_get_request('x'));
		$offset_y = $this->_normalize_size($this->_get_request('y'));

		if ($this->_width !== NULL && $this->_height !== NULL)
			$this->_image->crop($this->_width, $this->_height, $offset_x, $offset_y);

		$this->_browserOutput();
	}

	protected function _rotateImg()
	{
		if (defined('GD_BUNDLED'))
		{
			$degrees = $this->_get_request('d');

			if (! preg_match('#[-+]?\b\d+\b#', $degrees))
			{
				page_not_found();
			}

			if (($degrees >= -360) AND ($degrees <= 360))
			{
				$this->_image->rotate($degrees);

				return $this->_browserOutput();
			}
		}

		page_not_found();
	}

	protected function _flipImg()
	{
		$direction = $this->_get_request('d');

		// other value = Image::VERTICAL
		if ($direction === 'h')
		{
			$direction = Image::HORIZONTAL;
		}

		$this->_image->flip($direction);

		$this->_browserOutput();
	}

	protected function _sharpenImg()
	{
		if (defined('GD_BUNDLED'))
		{
			$amount = $this->_get_request('d');

			if (! preg_match('/^(100|[1-9]?[0-9])$/', $amount))
			{
				page_not_found();
			}

			$this->_image->sharpen($amount);

			return $this->_browserOutput();
		}

		page_not_found();
	}

	protected function _isInternal()
	{
		//return defined('CMS_BACKEND') ? TRUE : FALSE;
		return false;
	}

	public function save()
	{
		if ( ! $this->_isInternal())
		{
			page_not_found();
		}

		$imgPath = array_key_exists('img-path', $_POST) ? $_POST['img-path'] : '';

		if ($imgPath === '/' or $imgPath === '\\')
			$imgPath = '';

		$settings = array('path' => $imgPath);
		if (Plugin::setAllSettings($settings, 'image'))
			Flash::set('success', 'Image - '.__('plugin settings saved.'));
		else
			Flash::set('error', 'Image - '.__('plugin settings not saved!'));

		redirect(get_url('plugin/image/settings'));
	}

}
