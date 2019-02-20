<?php require_once '_Session.php'; ?>

<?php

require_once '_Protect.php';

require_once '_Conn.php';

require_once './AppCode/Models/User.php';

require_once '_Controller.php';

class Auth {
    public static function check() {
        /*
         * Check is User is logged in!
         */
        if(session('user') !== null) {
            return self::authenticated();
        }
        return false;
    }
    public static function authenticate($username,$password) {
        /*
         * Authenticate the user
         */
        $data = data()->query("SELECT * FROM users WHERE username = '$username' OR email = '$username';")->fetchObject('User');
        if(password_verify($password, $data->password)) {
            $user = (object) array(
                'name' => $data->name,
                'username' => $data->username,
                'email' => $data->email
            );
            session('user', $user);
            return true;
        }
    }
    
    public static function authenticated() {
        /*
         * Return true if user is authenticated
         */
        $user = session('user');
        $data = data()->query("SELECT * FROM users WHERE username = '".$user->username."';")->fetchObject();
        if($data != null) {
            if(property_exists($data,'username') && $data->username !== '' && $data->username !== null) {
                return true;
            } else {

            }
        }
        return false;
    }

    public function user() {
        /*
         *  Return Authenticated user instance as object
         */
        if(self::check()) {
            return session('user');
        } else {
            return (object) array(
                'username' => null,
                'id' => null,
                'name' => null,
                'email' => null
            );
        }
    }
}

function auth() {
    return new Auth();
}