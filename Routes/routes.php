<?php
//Import the router class
use Routes\router;
use Routes\route;
//To protect the routes we can set up a middleware
use Middleware\checkAdmin;

//Define some routes
$routes=[];

// getting the pages

#----------------------------------------------------------------------------------------------------------
//A route to the about page
$route= new route('GET', '/bids', function($parameters) {
    include './controllers/views/bids.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
//A route to the registration page
$route= new route('GET', '/register', function($parameters) {
    include './controllers/views/register.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
//Get the login page
$route= new route('GET', '/login', function($parameters) {
    include './controllers/views/login.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
//A route to get the securities from the database
$route= new route('GET', '/securities', function($parameters) {
    include './controllers/Fetchsecurities.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
$route= new route('GET', '/usersecurities', function($parameters) {
    include './controllers/views/usersecurities.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
$homepage= new route('GET', '/home', function($parameters) {
    include './controllers/views/home.php';
});
array_push($routes, $homepage);//put the route into the array

$homepage= new route('GET', '/payments', function($parameters) {
    include './controllers/views/payments.php';
});
array_push($routes, $homepage);//put the route into the array

$homepage= new route('GET', '/welcome', function($parameters) {
    include './controllers/views/welcome.php';
});
array_push($routes, $homepage);//put the route into the array



// routes for submitting data
$route= new route('POST', '/submit_register', function($parameters) {
    include './controllers/register.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
//A route to submit a bid
$route= new route('POST', '/submit_bid', function($parameters) {
    include './controllers/Bid.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
//A route to submit login data
$route= new route('POST', '/submit_login', function($parameters) {
    include './controllers/Login.php';
});
array_push($routes, $route);//put the route into the array

$route= new route('POST', '/admin/submit_security', function($parameters) {
    include './controllers/Security.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
//A route to get the admin securities dashboard
//Create an instance of the router class
$route= new route('GET', '/adminsecurities', function($parameters) {
    //To call the admin middleware
    new checkAdmin();//Call the middleware
    include './controllers/views/securities.php';
});
array_push($routes, $route);//put the route into the array
#----------------------------------------------------------------------------------------------------------
###########################################################################################################

//Create an instance of the router class
$router=new Router($routes);