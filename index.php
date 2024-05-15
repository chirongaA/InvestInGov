<?php 

//Include routes file
include_once 'routes.php';

//Get the uri being requested
$uri = $_SERVER['REQUEST_URI'];

$router->route($uri);