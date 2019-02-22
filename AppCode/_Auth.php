<?php require_once '_Session.php'; ?>

<?php

require '_Protect.php';

require_once '_Conn.php';

require_once 'Models/User.php';
require_once 'Models/Admin.php';

class Auth {
    private static $guard = 'customer';

    public function __construct($guard) {
        self::$guard = $guard;
    }

    public static function check() {
        /*
         * Check is User is logged in!
         */
        if(session(self::$guard) !== null) {
            return self::authenticated();
        }
        return false;
    }

    private function getUserClass() {
        switch (self::$guard) {
            case 'admin':
                return new Admin();
                break;
            case 'customer':
                return new User();
                break;
            default:
                return new User();
        }
    }

    public static function authenticate($username,$password) {
        /*
         * Authenticate the user
         */
        $user = self::getUserClass()->where('username', $username);
        if(sizeof($user)>0) {
            $user = $user[0];
            if (password_verify($password, $user->password)) {
                $user = (object)array(
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                );
                session(self::$guard, $user);
                return true;
            }
        } else {
            return false;
        }
    }
    
    public static function authenticated() {
        /*
         * Return true if user is authenticated
         */
        $sessionUser = session(self::$guard);
        $user = self::getUserClass()->where('username', $sessionUser->username);
        if(sizeof($user)>0) {
            $user = $user[0];
            if ($user != null) {
                if (property_exists($user, 'username') && $user->username !== '' && $user->username !== null) {
                    return true;
                } else {

                }
            }
        }
        return false;
    }

    public function user() {
        /*
         *  Return Authenticated user instance as object
         */
        if(self::check()) {
            return session(self::$guard);
        } else {
            return (object) array(
                'username' => null,
                'id' => null,
                'name' => null,
                'email' => null,
                'avatar' => null,
            );
        }
    }
}

function auth($guard = 'customer') {
    switch ($guard) {
        case 'admin':
            return new Auth('admin');
            break;
        case 'customer':
            return new Auth('customer');
            break;
        default:
            return new Auth('customer');
    }
    return new Auth('customer');
}