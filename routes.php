<?php
//Import the router class
require_once 'router.class.php';
//Define some routes
$routes=[];

// getting the pages
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

$route= new route('GET', '/login', function($parameters) {
    include './controllers/views/login.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('GET', '/adminsecurities', function($parameters) {
    include './controllers/views/securities.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('GET', '/securities', function($parameters) {
    include './controllers/Fetchsecurities.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('GET', '/usersecurities', function($parameters) {
    include './controllers/views/usersecurities.php';
});
array_push($routes, $route);//put the route into the array



// routes for submitting data
$route= new route('POST', '/submit_register', function($parameters) {
    include './controllers/register.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('POST', '/submit_bid', function($parameters) {
    include './controllers/Bid.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('POST', '/submit_login', function($parameters) {
    include './controllers/Login.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('POST', '/admin/submit_security', function($parameters) {
    include './controllers/Security.php';
});
array_push($routes, $route);//put the route into the array


//Create an instance of the router class
$router=new Router($routes);