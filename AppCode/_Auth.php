<?php require_once '_Session.php'; ?>

<?php

require_once '_Protect.php';

require_once '_Conn.php';

require_once '_App.php';

require_once '_Controller.php';

class Auth {
    public static function check() {
        /*
         * Check is User is logged in!
         */
        return self::authenticated();
    }
    public static function authenticate() {
        /*
         * Authenticate the user
         */
    }
    public static function authenticated() {
        /*
         * Return true if user is authenticated
         */
        if(session(App::$key) && property_exists(session(App::$key), 'user')) {
            $session_user = session(App::$key)->user;
            return true;
        }
        return false;
    }
    public function user() {
        /*
         *  Return Authenticated user instance as object
         */
    }
}

function auth() {
    return new Auth();
}