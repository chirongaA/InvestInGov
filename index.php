<?php 
//Include the autoloader
include_once 'autoload.php';
//Include routes file
include_once 'Routes/routes.php';
//Get the uri being requested
$uri = $_SERVER['REQUEST_URI'];
//Create a new router object
$router->route($uri);