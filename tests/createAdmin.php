<?php
//Test file to create a new admin
// use models\Admin;
require_once  "../autoload.php"; //This is the file that contains the autoloader function
//We load the autoloader file to load the Admin class since we will run this file outside the index.php file
use models\Admin;
//Details of the new admin
$username="racquel";
$email="ec@bonds.com";
$password="@admins2024**";

$admin=new Admin();
$admin->create($email,$username,$password);