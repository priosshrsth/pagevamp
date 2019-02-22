<?php require_once '_Session.php'?>

<?php
$_MODE = 'Prod'; //Supported 'Dev' For development mode
//error_reporting(0);
/*
 * Class to set key name for global variables. This class must be set!
 */
$base_path = str_replace('AppCode/../','',__DIR__ . '/../');


require '_Protect.php';

class App {
    public static $key;
    public static $base_path;
    public static $base_url;
    public static $url;
    public function __construct($name) {
        self::$key = $name;
    }

}

App::$base_path = $base_path;
App::$base_url = $BASE_URL;

App::$url = $absolute_url;

new App('prios'); //init class once

require_once 'Models/User.php';
require_once '_Auth.php';

if(strpos($absolute_url,'/admin')>-1 && basename($absolute_url) !== 'login.php' && !auth('admin')->check()) {
    header('Location:'.$BASE_URL.'admin/login.php');
}

function slug($value) {
    echo str_replace(' ','-',strtolower($value));
}

function asset($path) {
    echo App::$base_url.'assets/'.$path;
}

global $errors;
global $exceptions;
global $warnings;
global $success;
$errors = (object) [];
$exceptions = [];
$warnings = [];
$success = [];

function storage($path) {
    return App::$base_path.$path;
}

function error($key) {
    global $errors;
    if(property_exists($errors, $key)) {
        echo "<span class='error'>".$errors->$key."</span>";
    }
}

function json($value) {
    return json_encode($value, JSON_PRETTY_PRINT);
}


/*
 * Check If request is valid and activity is secure
 */


require_once '_Token.php'; //Class To generate and use token;

if(!(isset($preventTokenReset) && $preventTokenReset)) {
    new Token();
}