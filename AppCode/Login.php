<?php
require_once '_Protect.php';

unset($_POST['login']);
unset($_POST['_token']);
$flag = true;
foreach($_POST as $key => $value) {
    $$key = $value;
    if($$key=='' || $$key == null) {
        $flag = false;
        $errors->$$key = ucwords($$key). " cannot be empty!";
    }
}
if($flag) {
    if(auth()->authenticate($username,$password)) {
        array_push($success, "Successfully Logged In!");
    } else {
        array_push($exceptions, "Login Failed!");
    }
} else {
    $preventTokenReset = true;
}
