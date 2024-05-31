<?php
//A test route that only admins can access
session_start();
//To call the admin middleware

use Middleware\checkAdmin;

new checkAdmin();//Call the middleware


/*

....Rest of code will run if only the one logged in is an admin
*/

echo "If you are seeing this, you are an admin";