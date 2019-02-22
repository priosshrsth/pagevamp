<?php
/**
 * Created by PhpStorm.
 * User: prios
 * Date: 2/19/19
 * Time: 8:48 PM
 */

require_once '../AppCode/Models/User.php';
require_once '../AppCode/Models/Category.php';
require_once '../AppCode/Models/Product.php';

$user = new User();
$user->name='Anit Shrestha';
$user->email='shrsthprios@gmail.com';
$user->username='anitshrsth';
$user->avatar='https://scontent.fktm3-1.fna.fbcdn.net/v/t1.0-1/p40x40/20525634_215041222358375_2216662784303840017_n.jpg?_nc_cat=100&_nc_ht=scontent.fktm3-1.fna&oh=1b5cf3d73c33e096c63328975affe5c1&oe=5D242B5C';
die(User::store($user));