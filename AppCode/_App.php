<?php require_once '_Session.php'?>

<?php
$_MODE = 'Prod'; //Supported 'Dev' For development mode
//error_reporting(0);
/*
 * Class to set key name for global variables. This class must be set!
 */
class App {
    public static $key;

    public function __construct($name) {
        self::$key = $name;
    }

}
new App('prios'); //init class once

function slug($value) {
    echo str_replace(' ','-',strtolower($value));
}


/*
 * Check If request is valid and activity is secure
 */
require_once '_Protect.php';

require_once '_Token.php'; //Class To generate and use token;

if(isset($_GET) || isset($_POST)) {
    //handle request
}

/*
 * Generate new token
 */
new Token();

require_once '_Auth.php';

//$data = data()->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_CLASS, 'Category');
//foreach ($data as $d) {
//    var_dump($d->name);
//    echo "<p>";
//}