<?php

/**
 * Frog CMS - Content Management Simplified. <http://www.madebyfrog.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 * Copyright (C) 2008 Martijn van der Kleijn <martijn.niji@gmail.com>
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
 * The FileManager allows users to upload and manipulate files.
 *
 * @package frog
 * @subpackage plugin.file_manager
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @version 1.0.0
 * @since Frog version 0.9.0
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Philippe Archambault & Martijn van der Kleijn, 2008
 */

  $out = '';
  $progres_path = '';
  $paths = explode('/', $fnbgallery->filename);
  $nb_path = count($paths);
  foreach ($paths as $i => $path) {
    if ($i+1 == $nb_path) {
      $out .= $path;
    } else {
      $progres_path .= $path.'/';
      $out .= '<a href="'.get_url('fnbgallery/browse/'.rtrim($progres_path, '/')).'">'.$path.'</a>/';
    }
  }
?>

<h1><?php echo __('Edit Images'); ?></h1>

<form method="post" action="<?php echo get_url('fnbgallery/edit/'.$fnbgallery->id); ?>">
		<h3><?php echo __('Album'); ?></h3>
	<div id="meta-pages" class="pages">
	 	<select id="album_id"  name="fnbgallery[album_id]" disabled>
	    <?php
	    	while($album = $albums ->fetchObject()){
	        	echo "<option value='".$album->id."' ".($fnbgallery->album_id==$album->id?"selected":"").">".$album->name."</option>";
        	}
	    ?>
	    </select>
    </div>

    <h3><?php echo __('Title'); ?></h3>
	<div id="meta-pages" class="pages">
	    <input class="textbox" id="fnbgallery_title" name="fnbgallery[title]" size="30" type="text" value="<?php echo $fnbgallery->title ?>" />
    </div>

    <h3><?php echo __('Status'); ?></h3>
    <div id="meta-pages" class="">
      <select id="status"  name="fnbgallery[status]">
      	<option value="1" <?php echo ($fnbgallery->status=="1"?"selected":"") ?>><?php echo __('Show'); ?></option>
          <option value="0" <?php echo ($fnbgallery->status=="0"?"selected":"") ?>><?php echo __('Hidden'); ?></option>
      </select>
    </div>
    <br />
    <img src="<?php echo URL_PUBLIC.'public/fnb/gallery/'.$fnbgallery->album_id.'/'.$fnbgallery->filename; ?>" style="max-width:100%; clear:both; display:block;" />

    <p class="buttons">
        <input class="button" name="commit" type="submit" accesskey="s" value="<?php echo __('Save'); ?>" />
        <input class="button" name="continue" type="submit" accesskey="e" value="<?php echo __('Save and Continue Editing'); ?>" />
        <?php echo __('or'); ?> <a href="<?php echo get_url('fnbgallery'); ?>"><?php echo __('Cancel'); ?></a>
    </p>
</form>
