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

require_once '_Auth.php';

function slug($value) {
    echo str_replace(' ','-',strtolower($value));
}

global $errors;
global $exceptions;
global $warnings;
global $success;
$errors = (object) [];
$exceptions = [];
$warnings = [];
$success = [];

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
require_once '_Protect.php';

require_once '_Token.php'; //Class To generate and use token;

require_once './AppCode/Models/Model.php';

new Model();

if(isset($_GET) || isset($_POST)) {
    //handle request
    if(isset($_POST) && sizeof($_POST)>0) {
        if(isset($_POST['_token'])) {
            if(session('token') !== null && $_POST['_token'] == session('token')) {
                //POST is valid
            } else {
                die("No Valid Token Found! Forgery Detected!");
            }
        } else {
            die("No Valid Token Found! Forgery Detected!");
        }
    }

    if(isset($_POST['register'])) {
        require_once 'Register.php';
    }

    if(isset($_POST['login'])) {
        require_once 'Login.php';
    }

    if(isset($_POST['logout'])) {
        session_remove('user');
        header("Location: index.php");
    }

    if((isset($_GET['api']) && $_GET['api'] == true)) {
        if(isset($_GET['filter']) && $_GET['filter'] == 'session') {
            if(session('cart') !== null) {
                $cart = session('cart');
            } else {
                $cart = [];
            }
            die(json($cart));
        }
        if(isset($_GET['filter']) && $_GET['filter'] == 'product') {

        }
        if(isset($_GET['add_to_cart'])) {
            $CART = session('cart');
            $productID = $_GET['id'];
            $flag = true;
            $new = false;
            $success = false;
            if($CART !== null) {
                foreach ($CART as $key=>$item) {
                    if($item->id == $productID) {
                        $item->quantity++;
                        $product = $item;
                        $CART[$key] = $item;
                        $flag = false;
                        $success = true;
                        break;
                    }
                }
            }
            if($flag) {
                $product = Product::find($productID);
                if($product) {
                    $item = (object) array(
                        'id' => $product->id,
                        'name' => $product->name,
                        'price' => $product->price,
                        'image' => $product->image,
                        'quantity' => 1,
                    );
                    if($CART !== null) {
                        array_push($CART, $item);
                    } else {
                        $CART = [$item];
                    }
                    $new = true;
                    $success = true;
                }
            }

            if($success) {
                session('cart', $CART);
                $reponse = (object) array(
                    'success' => true,
                    'product' => $product,
                    'new' => $new,
                    'msg' => "Product Added To Cart!!",
                );
            } else {
                $reponse = (object) array(
                    'success' => false,
                    'msg' => "Product Not Added To Cart!!",
                );
            }
            die(json($reponse));
        }


        die("You are accessing api!!");
    }
}

/*
 * Generate new token
 */

if(!(isset($preventTokenReset) && $preventTokenReset)) {
    new Token();
}