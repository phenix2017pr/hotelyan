<?php
/**
 * Frog CMS - Content Management Simplified. <http://www.madebyfrog.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 *
 * This file is part of Frog CMS.
 *
 * Frog CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Frog CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Frog CMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Frog CMS has made an exception to the GNU General Public License for plugins.
 * See exception.txt for details and the full text.
 */

/**
 * @package frog
 * @subpackage views
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @version 0.1
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Philippe Archambault, 2008
 */

?>

<h1><?php echo __('Gallery'); ?></h1>
<br />
<form name="thisform" method="post" action="<?php echo get_url('gallery/save_order') ?>">
<div align=right><input type=submit value="<?php echo __('Save Order'); ?>"></div>
<table id="sites-list" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th class="files"><?php echo __('Name'); ?></th>
      <th class="files"><?php echo __('Image'); ?></th>
      <th class="size" width=100><?php echo __('Order'); ?></th>
      <th class="size" width=100><?php echo __('Date Added'); ?></th>
      <th class="modify" width=50><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>

<?php while($gallery = $gallerys ->fetchObject()){  ?>
    <tr style="height:35px;" class="<?php echo odd_even(); ?>">
      <td align=left>
      	<a href="<?php echo get_url('gallery/view/'.$gallery->id); ?>">
      		<?php echo $gallery->title ?>
      	</a>
      </td>
      <td>
      	<a href="<?php echo get_url('gallery/view/'.$gallery->id); ?>">
      		<?php echo ($gallery->filename!=''?'<img src="'.BASE_FILES_DIR.'/gallery/images/'.$gallery->filename.'" height=80 />':''); ?>
      	</a>
      </td>
      <td>
        <input type=hidden name="gallery_id[]" value="<?php echo $gallery->id ?>">
        <input type="text" value="<?php echo $gallery->sequence ?>" name="order[]" size=2 style="text-align:right;">
      </td>
      <td align="right"><?php echo date("d-M-Y",strtotime($gallery->created_on)) ?></td>
      <td>
      	<a href="<?php echo get_url('gallery/view/'.$gallery->id); ?>"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-edit.gif" alt="edit icon" /></a>&nbsp;<a href="<?php echo get_url('gallery/delete/'.$gallery->id); ?>" onclick="return confirm('<?php echo __('All images will be removed as well. Are you sure want to remove this gallery: '); ?> <?php echo $gallery->title; ?>?');"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-remove.gif" alt="remove icon" /></a>
      </td>
    </tr>
<?php }  ?>
  </tbody>
</table>
</form>