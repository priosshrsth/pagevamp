<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 1/26/19
 * Time: 1:28 AM
 */

class Category
{
    public $name;

    public static function find($id) {
        return data()->query("SELECT * FROM categories WHERE id = $id;")->fetchObject(self);
    }
    public static function get($attributes = ['*']) {
        $attributes = implode(',', $attributes);
        return data()->query("SELECT $attributes FROM users;")->fetchAll(PDO::FETCH_CLASS,self);
    }
    public static function update() {

    }
}