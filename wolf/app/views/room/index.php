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

?>
<h1><?php echo __('Rooms'); ?></h1>
<br />
<form name="thisform" method="post" action="<?php echo get_url('room/save_order') ?>">
<div align=right><input type=submit value="<?php echo __('Save Order'); ?>"></div>
<table id="users" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th width=250><?php echo __('Room Name'); ?></th>
      <!--<th><?php echo __('Detail'); ?></th> -->
      <th class="size"><?php echo __('Order'); ?></th>
      <th class="files"><?php echo __('Image'); ?></th>
      <!-- <th><?php echo __('Created On'); ?></th> -->
      <!-- <th><?php echo __('Last Updated On'); ?></th> -->
      <th class="modify" width=50><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php while($room = $rooms->fetchObject()){ ?>
    <tr class="<?php echo odd_even(); ?>">
      <td class="user">
        <a href="<?php echo get_url('room/edit/'.$room->id); ?>"><?php echo $room->name; ?></a>
      </td>
      <!--<td><?php echo $room->detail; ?></td>-->
      <td>
      	<input type=hidden name="room_id[]" value="<?php echo $room->id ?>">
      	<input type="text" value="<?php echo $room->sequence ?>" name="order[]" size=1 style="text-align:right;">
      </td>
      <td>
        <a href="<?php echo get_url('room/edit/'.$room->id); ?>">
          <?php echo ($room->filename!=''?'<img src="'.BASE_FILES_DIR.'/room/images/'.$room->filename.'" height=80 />':''); ?>
        </a>
      </td>
      <!-- <td><?php echo date("d-M-Y", strtotime($room->created_on)); ?></td> 
      <td><?php echo ($room->updated_on === NULL?'':date("d-M-Y", strtotime($room->updated_on))); ?></td>-->
      <td>
        <a href="<?php echo get_url('room/edit/'.$room->id); ?>"><img src="<?php echo URL_PUBLIC ?>wolf/admin/images/icon-edit.gif" alt="edit icon" /></a> 
         <a href="<?php echo get_url('room/delete/'.$room->id.'?csrf_token='.SecureToken::generateToken(BASE_URL.'room/delete/'.$room->id)); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete room : ').' '.$room->name.'?'; ?>');"><img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="<?php echo __('delete room'); ?>" title="<?php echo __('Delete room'); ?>" /></a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
</form>