<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2008,2009,2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/**
 * @package Models
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @copyright Philippe Archambault, 2008
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 License
 */

/**
 * class PageSetting
 *
 * Provide a administration interface of some configuration
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @since Wolf version 0.8.7
 */
class PageSetting extends Record {
    const TABLE_NAME = 'page_setting';

	public static $settings = array();
	
    public static function init() {
		$settings = Record::findAllFrom('PageSetting');
		$pagesetting = new stdClass();
		
		foreach($settings as $setting) {
			$name = $setting->name;
			$pagesetting->$name = $setting->value;
		}		
		return $pagesetting;
	}

    public static function saveFromData($data) {
        $tablename = self::tableNameFromClassName('PageSetting');

        foreach ($data as $name => $value) {
            $sql = 'UPDATE '.$tablename.' SET value='.self::$__CONN__->quote($value)
                . ' WHERE name='.self::$__CONN__->quote($name);
            self::$__CONN__->exec($sql);
        }
    }
	
	public static function findAll($args = null) {
        return self::find($args);
    }


} // end PageSetting class
