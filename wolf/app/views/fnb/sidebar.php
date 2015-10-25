<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2009-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/**
 * @package Views
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @copyright Philippe Archambault, 2008
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 license
 */

if (Dispatcher::getAction() == 'index'):
?>

<!--<p class="button"><a href="<?php echo get_url('fnb/add'); ?>"><img src="<?php echo URI_PUBLIC;?>wolf/admin/images/user.png" align="middle" alt="user icon" /> <?php echo __('New Menu'); ?></a></p>-->

<?php endif;

if (Dispatcher::getAction() == 'edit'):
	foreach(Dispatcher::getParams() as $id){
		$fnbid = $id;
		break;
	}
?>

<!--<p class="button"><a href="#upload-file-popup" class="popupLink"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-img-upload.png" align="middle" alt="upload icon" /><?php echo __('Upload Menu Image'); ?></a></p>

<p class="button"><a href="#upload-location-popup" class="popupLink"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-img-upload.png" align="middle" alt="upload icon" /><?php echo __('Add Location'); ?></a></p>-->

<?php endif; ?>