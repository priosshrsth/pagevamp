<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 1/26/19
 * Time: 12:51 PM
 */

class Test
{
    public static $name = "Test";
    public function get() {
        $class = get_class($this);
        return (object) array(
            'name' => $this::$name,
            'class' => $class
        );
    }

}