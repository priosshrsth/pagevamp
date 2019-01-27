<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 1/26/19
 * Time: 12:52 PM
 */
require_once 'Test.php';

class Check extends Test
{
    public static $name = "Check";
}

$x = new Check();
var_dump($x->get());