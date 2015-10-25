<?php
/*
 * Wolf CMS - Content Management Simplified. <http://www.wolfcms.org>
 * Copyright (C) 2009-2010 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Wolf CMS. Wolf CMS is licensed under the GNU GPLv3 license.
 * Please see license.txt for the full license text.
 */

/**
 * @package Models
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @copyright Martijn van der Kleijn, 2010
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 License
 */

/**
 * Role
 *
 * @todo finish phpdoc
 *
 * @author Martijn van der Kleijn <martijn.niji@gmail.com>
 * @since Wolf version 0.7.0
 */
class Country extends Record {
    const TABLE_NAME = 'country';

    public $country_iso_code;
    public $country_name;

    /**
     * This returns the name of the Country if you for example do:
     *
     * <?php
     *     $country = Country::findById(1);
     *     echo $country;
     * ?>
     *
     * @return string Name of the country.
     */
    public function  __toString() {
        return $this->name;
    }

    /**
	 * Find a Country by its country_iso_code.
	 *
	 * @param string $country_iso_code
	 * @return mixed A Country or false on failure.
	 */
	public static function findByCode($country_iso_code) {
		$where = 'country_iso_code=?';
		$values = array($country_iso_code);

		return self::findOneFrom('Country', $where, $values);
    }

    /**
     * Find a Country by its name.
     *
     * @param string $name
     * @return mixed A Country or false on failure.
     */
    public static function findByName($name) {
        $where = 'country_name=?';
        $values = array($name);

		return self::findOneFrom('Country', $where, $values);
    }

    /**
     * Make sure we only try to save specified columns in the DB.
     *
     * @return array Array of column names.
     */
    public function getColumns() {
        return array('id', 'name');
    }
}