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
 * @package Models
 *
 * @author Philippe Archambault <philippe.archambault@gmail.com>
 * @copyright Philippe Archambault, 2008
 * @license http://www.gnu.org/licenses/gpl.html GPLv3 License
 */

/**
 * class Website
 *
 */
class Room extends Record {
    const TABLE_NAME = 'room';
	
    public static function find($args = null)
    {
        // Collect attributes...
        $where    = isset($args['where']) ? trim($args['where']) : '';
        $order_by = isset($args['order']) ? trim($args['order']) : '';
        $offset   = isset($args['offset']) ? (int) $args['offset'] : 0;
        $limit    = isset($args['limit']) ? (int) $args['limit'] : 0;

        // Prepare query parts
        $where_string = empty($where) ? '' : "WHERE $where";
        $order_by_string = empty($order_by) ? '' : "ORDER BY $order_by";
        $limit_string = $limit > 0 ? "LIMIT $offset, $limit" : '';

        $tablename = self::tableNameFromClassName('Room');

        // Prepare SQL
        $sql = "SELECT $tablename.* FROM $tablename".
               " $where_string $order_by_string $limit_string";

        $stmt = self::$__CONN__->prepare($sql);
        $stmt->execute();

        // Run!
        if ($limit == 1) {
            return $stmt->fetchObject('Room');
        } else {
            $objects = array();
            while ($object = $stmt->fetchObject('Room')) {
                $objects[] = $object;
            }
            return $objects;
        }
    } // find 

    public static function findAll($args = null) {
        return self::find($args);
    }

     /**
     * Find a Room by id
     *
     * @param int $id
     * @return mixed A Room or false on failure.
     */
    public static function findById($id) {
        return self::findByIdFrom('Room', $id);
    }
	
	public static function getRoomByPageId($id) {
	    $where = self::tableNameFromClassName('Room').'.pageid='.(int)$id;
        return self::find(array(
			'where' => $where,
			'limit' => 1
        ));
		
	}
}