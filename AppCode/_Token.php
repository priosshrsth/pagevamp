<?php
/*
 * Generate and set csrf token()
 */
require '_Protect.php';
class Token {
    private static $_TOKEN;

    public function __construct() {
        self::$_TOKEN = md5(uniqid(rand(), TRUE));
        try {
            session('token', self::$_TOKEN);

        } catch (Exception $ex) {
            die("Unable To Set Session!");
        }
    }

    public static function generateToken() {
        new Token();
    }

    public static function getToken() {
        return self::$_TOKEN;
    }
}

function csrf_field() {
    $token = csrf_token();
    echo "<input type='hidden' name='_token' value='$token'>";
}

function csrf_token() {
    return Token::getToken();
}