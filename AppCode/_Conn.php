<?php
require '_Protect.php';
// class Conn {
//     private $db = "ecommerce";
//     private $server = "localhost";
//     private $user = "prios";
//     private $pass = "prios";
//
//     public static $cnn;
//
//     function __construct()
//     {
//         try {
//             $conn = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
//
//             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             self::$cnn = $conn;
//         } catch (PDOException $err) {
//             echo "ERROR: Unable to connect: " . $err->getMessage();
//         }
//     }
// }
//
// new Conn();


 require_once 'Models/User.php';
 require_once 'Models/Category.php';
 require_once 'Models/Product.php';

// function data() {
//     if(Conn::$cnn === null) {
//         new Conn();
//     }
//     return Conn::$cnn;
// }
