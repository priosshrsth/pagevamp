<?php
require_once('../vendor/autoload.php');
use Payment\Payment;

$disablePathProtection = true;
//disable token reset
$preventTokenReset = true;

require_once '_App.php';
//check if csrf token is set
//if(!(isset($_SERVER["HTTP_X_CSRF_TOKEN"]) && $_SERVER['HTTP_X_CSRF_TOKEN'] != null && $_SERVER['HTTP_X_CSRF_TOKEN'] != '' && $_SERVER['HTTP_X_CSRF_TOKEN']==session('token'))) {
//    die('Unauthorized Action!');
//}

require_once '_Auth.php';
require_once 'Models/User.php';
require_once 'Models/Admin.php';
require_once 'Models/Category.php';
require_once 'Models/Product.php';

if(!(isset($_GET['action']) && $_GET['action'] != null && $_GET['action']!= '')) {
    die("No process to do! I don't know what to do!");
}

$action = $_GET['action'];
$role = isset($_GET['role'])?($_GET['role']=='admin'?'admin':'customer'):'customer';

//Check Admin Authorization
if($role=='admin' && !auth('admin')->check() && $action !=='login') {
   echo json_encode((object) [
        'success'=> false,
       'msg'=> 'Admin Not Logged In!',
       'url'=> $BASE_URL."admin/login",
   ]);
   die();
}


//Check Customer Authorization
if(isset($_GET['role']) && $_GET['role']=='customer' && !auth('customer')->check() && $action !== 'login') {
    echo json_encode((object) [
        'success'=> false,
        'msg'=> 'Customer Not Logged In!',
        'url'=> $BASE_URL."login",
    ]);
    die();
}

if($action=='login') {
    if(auth($role)->authenticate($_POST['username'], $_POST['password'])) {
        echo json((object) [
            'success'=> true,
            'msg'=> 'Customer Logged In Successfully!',
        ]);
    } else {
        echo json((object) [
            'success'=> false,
            'msg'=> 'Wrong Credentials!',
        ]);
    }
    die();
}

if($action == 'getCategories') {
    echo json((object) [
        'success' => true,
        'categories' => Category::get(),
    ]);
    die();
}

if($action == 'getProducts') {
    echo json((object) [
        'success' => true,
        'products' => Product::get(),
        'categories' => Category::get(),
    ]);
    die();
}

if($action == 'addProduct') {
    $product = json_decode($_POST['product']);
    $PRODUCT = new Product();
    $PRODUCT->name = $product->name;
    $PRODUCT->category_id = $product->category_id;
    $PRODUCT->price = $product->price;
    $PRODUCT->stock = abs($product->stock);
    $category = Category::find($product->category_id);
    $PRODUCT->image = [];
    foreach ($category->attributes as $attribute) {
        $prop = $attribute->name;
        $PRODUCT->$prop = $product->$prop;
    }
    foreach ($product->image as $image) {
        $img = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image->url));
        $name = str_replace(' ', '_',$image->name);
        $file = App::$base_path.'assets/images/'.$name;
        file_put_contents($file, $img);
        array_push($PRODUCT->image, $name);
    }
    Product::store($PRODUCT);
    echo json((object) [
        'success' => true,
        'product' => $product
    ]);
}

if($action=='checkout') {
    $pay = new Payment();

    $token = $_POST['stripe_token'];

    $amount['amount'] = $_POST['totalPrice'];
    $amount['currency'] = "USD";
    echo $pay->makepayment($amount,$token);
}


//Everything's Good Now
