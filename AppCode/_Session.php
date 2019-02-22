<?php session_start(); ?>

<?php
require '_Protect.php';
class Session {

}

function get_session() {
    if(session_exists()) {
        return $_SESSION[App::$key];
    } else {
        return null;
    }
}

function session($key,$value = null) {
    if($value == null) {
        if(session_exists()) {
            if(property_exists($_SESSION[App::$key], $key)) {
                return $_SESSION[App::$key]->$key;
            } else {
                return null;
            }
        } else {
            return null;
        }
    } else {
        if(!session_exists()) {
            set_session();
        }
        $_SESSION[App::$key]->$key = $value;
    }
}

function session_exists() {
    return isset($_SESSION[App::$key]);
}

function set_session() {
    $_SESSION[App::$key] = (object) [];
}

function session_remove($key) {
    if(session_exists()) {
        if(session($key) !== null) {
            unset($_SESSION[App::$key]->$key);
        }
    }
}

