<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 1/26/19
 * Time: 1:30 AM
 */
require_once './AppCode/_Conn.php';

class Model
{
    function __construct()
    {
        require_once 'Brand.php';
        require_once 'Category.php';
        require_once 'Product.php';
        require_once 'User.php';
    }

    protected function getTableName($table) {
        $table = strtolower($table);
        $last_letter = strtolower($table[strlen($table)-1]);
        switch($last_letter) {
            case 'y':
                return substr($table,0,-1).'ies';
            case 's':
                return $table.'es';
            default:
                return $table.'s';
        }
    }

    public static function find($id) {
        $class = get_called_class();
        $table = self::getTableName($class);
        return data()->query("SELECT * FROM `$table` WHERE id = $id;")->fetchObject();
    }

    public static function get($attributes = ['*']) {
        $class = get_called_class();
        $table = self::getTableName($class);
        $attributes = implode(',', $attributes);
        return data()->query("SELECT $attributes FROM `$table`;")->fetchAll(PDO::FETCH_CLASS,"$$class");
    }

}

