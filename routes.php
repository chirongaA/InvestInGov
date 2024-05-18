<?php
//Import the router class
require_once 'router.class.php';
//Define some routes
$routes=[];
$homepage= new route('GET', '/home', function($parameters) {
    include './controllers/views/home.php';
});
array_push($routes, $homepage);//put the route into the array

$route= new route('GET', '/bids', function($parameters) {
    include './controllers/views/bids.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('GET', '/register', function($parameters) {
    include './controllers/views/register.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('POST', '/submit_register', function($parameters) {
    include './controllers/register.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('POST', '/submit_bid', function($parameters) {
    include './controllers/Bid.php';
});
array_push($routes, $route);//put the route into the array

//Create an instance of the router class
$router=new Router($routes);