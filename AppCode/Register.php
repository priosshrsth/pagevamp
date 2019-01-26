<?php
die();
require_once './AppCode/Models/User.php';

unset($_POST['register']);
unset($_POST['_token']);
$_POST = array_values($_POST);
var_dump($_POST);
die();
foreach($_POST as $key => $value) {
    $$key = $value;
    if($$key=='' || $$key == null) {
        $errors->$$key = ucwords($$key). " cannot be empty!";
    }
}
if(sizeof($errors) < 1) {
    $sql = "INSERT INTO users (name,email,username,password,address,contact) VALUES 
           ($name, $email, $username, $password, $address, $contact)";
    // use exec() because no results are returned
    try {
        $conn->exec($sql);
        array_push($success, "Registration Successfull!");
    }
    catch(PDOException $e)
    {
        array_push($exceptions,$e->getMessage());
    }
}
