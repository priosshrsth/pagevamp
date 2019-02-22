<?php
$basePath = str_replace('/layouts','',realpath(__DIR__));
require_once "$basePath/AppCode/_App.php";
require_once "$basePath/AppCode/Models/Admin.php";
require_once "$basePath/AppCode/Models/Category.php";
require_once "$basePath/AppCode/Models/User.php";
require_once "$basePath/AppCode/Models/Product.php";
?>