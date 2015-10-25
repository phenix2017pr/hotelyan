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
class FnbImage extends Record {
    const TABLE_NAME = 'fnbimage';

	/*
	public $id;
	public $fnbid;

    public $created_on;
    public $updated_on;
    public $created_by_id;
    public $updated_by_id;
    */

     /**
     * Find a FnbImage by id
     *
     * @param int $id
     * @return mixed A FnbImage or false on failure.
     */
    public static function findById($id) {
        return self::findByIdFrom('FnbImage', $id);
    }

    public static function findBy($column, $value) {
        return Record::findOneFrom('FnbImage', $column.' = ?', array($value));
    }

    public static function find($args = null) {
		// Collect attributes...
		$where    = isset($args['where']) ? trim($args['where']) : '';
		$order_by = isset($args['order']) ? trim($args['order']) : '';
		$offset   = isset($args['offset']) ? (int) $args['offset'] : 0;
		$limit    = isset($args['limit']) ? trim($args['limit']) : 0;

		// Prepare query parts
		$where_string = empty($where) ? '' : "WHERE $where";
		$order_by_string = empty($order_by) ? '' : "ORDER BY $order_by";
		$limit_string = empty($limit) ? '' : "LIMIT $limit";
		$offset_string = $offset > 0 ? "OFFSET $offset" : '';

		$tablename = self::tableNameFromClassName('FnbImage');

		// Prepare SQL
		$sql = "SELECT $tablename.* FROM $tablename".
			" $where_string $order_by_string $limit_string $offset_string";
		$stmt = self::$__CONN__->prepare($sql);
		$stmt->execute();

		//Flash::set('error', $sql);
		// Run!
		if ($limit == 1) {
			return $stmt->fetchObject('FnbImage');
		}
		else {
			$objects = array();
			while ($object = $stmt->fetchObject('FnbImage')) {
				$objects[] = $object;
			}
			return $objects;
		}
    }

    /**
     * Find a FnbImage by its fnb id.
     *
     * @param string $id
     * @return mixed A FnbImage or false on failure.
     */
    public static function findByFnbId($id) {
        $where = self::tableNameFromClassName('FnbImage').'.fnbid='.(int)$id;
        return self::find(array(
			'where' => $where,
			'order' => 'sequence, id asc'
        ));
    }

    public function beforeInsert() {
        $this->created_by_id = AuthUser::getId();
        $this->created_on = date('Y-m-d H:i:s');
        return true;
    }

    public function beforeUpdate() {
		$this->updated_by_id = AuthUser::getId();
		$this->updated_on = date('Y-m-d H:i:s');
		return true;
	}

	public function saverecord() {
		if ( ! $this->beforeSave()) return false;

		$value_of = array();

		if (empty($this->id)) {
			if ( ! $this->beforeInsert()) return false;

			$columns = $this->getColumns();

			// Escape and format for SQL insert query
			// @todo check if we like this new method of escaping and defaulting
			foreach ($columns as $column) {
				if (!empty($this->$column) || is_numeric($this->$column)) { // Do include 0 as value
					$value_of[$column] = self::$__CONN__->quote($this->$column);
				}
				elseif (isset($this->$column)) { // Properly fallback to the default column value instead of relying on an empty string
					// SQLite can't handle the DEFAULT value
					if (self::$__CONN__->getAttribute(PDO::ATTR_DRIVER_NAME) != 'sqlite') {
						$value_of[$column] = 'DEFAULT';
					}
				}
			}
			$sql = 'INSERT INTO '.self::tableNameFromClassName(get_class($this)).' ('
			                . implode(', ', array_keys($value_of)).') VALUES ('.implode(', ', array_values($value_of)).')';
			$return = self::$__CONN__->exec($sql) !== false;
            $this->id = self::lastInsertId();

			if ( ! $this->afterInsert()) return false;

		} else {
			if ( ! $this->beforeUpdate()) return false;

			$columns = $this->getColumns();

			// Escape and format for SQL update query
			foreach ($columns as $column) {
				if (!empty($this->$column) || is_numeric($this->$column)) { // Do include 0 as value
					$value_of[$column] = $column.'='.self::$__CONN__->quote($this->$column);
				}
				elseif (isset($this->$column)) { // Properly fallback to the default column value instead of relying on an empty string
					// SQLite can't handle the DEFAULT value
					if (self::$__CONN__->getAttribute(PDO::ATTR_DRIVER_NAME) != 'sqlite') {
						$value_of[$column] = $column.'=DEFAULT';
					}
				}
			}

			unset($value_of['id']);
			$sql = 'UPDATE '.self::tableNameFromClassName(get_class($this)).' SET '
				. implode(', ', $value_of).' WHERE id = '.$this->id;
            $return = self::$__CONN__->exec($sql) !== false;

			if ( ! $this->afterUpdate()) return false;
		}

		self::logQuery($sql);

		if ( ! $this->afterSave()) return false;

		return $return;
    }

	/**
     * Make sure we only try to save specified columns in the DB.
     *
     * @return array Array of column names.
     */
    /*
    public function getColumns() {
        return array('id', 'fnbid', 'reference_code', 'url', 'tagcontent', 'publish', 'created_on', 'updated_on', 'created_by_id', 'updated_by_id');
    }
    */
}