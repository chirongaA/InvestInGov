<?php
use models\Login;


$response=[
    "status"=>null,
    "message"=>null
];

// Start a new session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a new LoginModel object
    $loginModel = new Login();
    // Check if the email exists
    $emailExists = $loginModel->emailExists($email);
    if (!$emailExists) {
        // Email does not exist, show an error message
        $error_message = "Email does not exist. Please try again.";
        $response["status"]="error";
        $response["message"]=$error_message;
        header("Content-Type: application/json");
        //set a 404 (not found) response code
        http_response_code(404);
        echo  json_encode($response);
        exit;
    }

    // Verify the user credentials
    $isVerified = $loginModel->verifyUser($email, $password);
    if ($isVerified) {
        // User is verified, store user info in session
        $_SESSION['email'] = $email;
        // Redirect the user to the dashboard or another protected page
        $response["status"]="success";
        $response["message"]="Login successful";
        header("Content-Type: application/json");
        http_response_code(200);
        echo  json_encode($response);
    } else {
        // User is not verified, show an error message
        $error_message = "Incorrect password. Please try again.";
        $response["status"]="error";
        $response["message"]=$error_message;
        header("Content-Type: application/json");
        //set a 401 (unauthorized) response code
        http_response_code(401);
        echo  json_encode($response);
        }
    }