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
<h1><?php echo __('F&B'); ?></h1>
<br />
<form name="thisform" method="post" action="<?php echo get_url('fnb/save_order') ?>">
<div align=right><input type=submit value="<?php echo __('Save Order'); ?>"></div>
<table id="users" class="index" cellpadding="0" cellspacing="0" border="0">
  <thead>
    <tr>
      <th><?php echo __('Menu Name'); ?></th>
      <!--<th><?php echo __('Detail'); ?></th> -->
      <th class="size"><?php echo __('Order'); ?></th>
      <th><?php echo __('Created On'); ?></th>
      <th><?php echo __('Last Updated On'); ?></th>
      <th class="modify" width=50><?php echo __('Action'); ?></th>
    </tr>
  </thead>
  <tbody>
<?php while($fnb = $fnbs->fetchObject()){ ?>
    <tr class="<?php echo odd_even(); ?>">
      <td class="user">
        <a href="<?php echo get_url('fnb/edit/'.$fnb->id); ?>"><?php echo $fnb->name; ?></a>
      </td>
      <!--<td><?php echo $fnb->detail; ?></td>-->
      <td>
      	<input type=hidden name="fnb_id[]" value="<?php echo $fnb->id ?>">
      	<input type="text" value="<?php echo $fnb->sequence ?>" name="order[]" size=1 style="text-align:right;">
      </td>
      <td><?php echo date("d-M-Y", strtotime($fnb->created_on)); ?></td>
      <td><?php echo ($fnb->updated_on === NULL?'':date("d-M-Y", strtotime($fnb->updated_on))); ?></td>
      <td>
        <a href="<?php echo get_url('fnb/delete/'.$fnb->id.'?csrf_token='.SecureToken::generateToken(BASE_URL.'fnb/delete/'.$fnb->id)); ?>" onclick="return confirm('<?php echo __('Are you sure you wish to delete fnb : ').' '.$fnb->name.'?'; ?>');"><img src="<?php echo URI_PUBLIC;?>wolf/admin/images/icon-remove.gif" alt="<?php echo __('delete fnb'); ?>" title="<?php echo __('Delete fnb'); ?>" /></a>
      </td>
    </tr>
<?php } ?>
  </tbody>
</table>
</form>