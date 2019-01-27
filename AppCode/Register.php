<?php
require_once '_Protect.php';
require_once './AppCode/Models/User.php';

unset($_POST['register']);
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
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (name,email,username,password,address,contact) VALUES 
           ('$name', '$email', '$username', '$password', '$address', '$contact')";
    // use exec() because no results are returned
    try {
        data()->exec($sql);
        array_push($success, "Registration Successfull!");
    }
    catch(PDOException $e)
    {
        $preventTokenReset = true;
        array_push($exceptions,$e->getMessage());
    }
} else {
    $preventTokenReset = true;
}
