<?php
namespace Middleware;
//A middleware to check if the user in the system is an admin
use models\Admin;

class checkAdmin extends Admin{
    public function __construct()
    {
        parent::__construct();
        //Get the session
        @session_start();
        if(!isset($_SESSION['email']))
        {
            //Account does not exists
            $response['status']="error";
            $response['message']="Please log in first";
            header("Content-Type: application/json");
            http_response_code(403); //Forbidden
            echo  json_encode($response);
            exit();
        }
        //We have someone logged in but is that an admin?
        //Check if the person logged in is an admin
        if($this->exists($_SESSION['email']))
        {
            //Continues execution of the next piece of code
        }
        else{
            //User is not an admin
            $response['status']="error";
            $response['message']="You are not allowed to access this route";
            header("Content-Type: application/json");
            http_response_code(403); //Forbidden
            echo  json_encode($response);
            exit();
        }
    }
}
