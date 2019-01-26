<?php session_start(); ?>

<?php

class Session {

}

function session($key,$value = null) {
    if($value == null) {
        if(isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return null;
        }
    } else {
        $_SESSION[$key] = $value;
    }
}

function session_remove($key) {
    if (isset($_SESSION[$key])) unset($_SESSION[$key]);
}

