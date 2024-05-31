<?php
$response=[
    "status"=>null,
    "message"=>null
];
//Load the admin class
use models\Admin;
//Get the POST data
$email = $_POST['email'];
$password = $_POST['password'];
//create a new admin Model instance
$admin=new Admin();
$exists=$admin->exists($email);
if(!$exists)
{
    //Account does not exists
    $response['status']="error";
    $response['message']="Admin account does not exist";
    header("Content-Type: application/json");
    http_response_code(403); //Forbidden
    echo  json_encode($response);
    exit();
}
//Account exists we continue
//To verify the data
$verify=$admin->verifyUser($email,$password);
if($verify)
{
    //Start session
    session_start();
    $_SESSION['email']=$email;
    $response['status']="success";
    $response['message']="Admin Login successful";
    header("Content-Type: application/json");
    http_response_code(200); //Forbidden
    echo  json_encode($response);
}
else{
    //Account does not exists
    $response['status']="error";
    $response['message']="Wrong Password";
    header("Content-Type: application/json");
    http_response_code(403); //Forbidden
    echo  json_encode($response);
}

