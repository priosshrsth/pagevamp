<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 1/26/19
 * Time: 1:30 AM
 */

class Model
{
    function __construct()
    {
        require_once 'Brand.php';
        require_once 'Category.php';
        require_once 'Product.php';
        require_once 'User.php';
    }

    protected function getTableName($obj) {
        $table = get_class($obj);
        if(str)
    }

    public static function find($id) {
        return data()->query("SELECT * FROM users WHERE id = $id;")->fetchObject(self);
    }

    public static function get($attributes = ['*']) {
        $attributes = implode(',', $attributes);
        return data()->query("SELECT $attributes FROM users;")->fetchAll(PDO::FETCH_CLASS,self);
    }

}

