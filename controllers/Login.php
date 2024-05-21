<?php
// Include your LoginModel class
require_once './models/login.model.php';

// Start a new session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect the data from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create a new LoginModel object
    $loginModel = new LoginModel();

    // Verify the user credentials
    $isVerified = $loginModel->verifyUser($email, $password);

    if ($isVerified) {
        // User is verified, store user info in session
        $_SESSION['email'] = $email;

        // Redirect the user to the dashboard or another protected page
        header("Location: dashboard.php");
        exit();
    } else {
        // User is not verified, show an error message
        if (isset($error_message)) {
            echo "<p>$error_message</p>";
        $error_message = "Invalid email or password. Please try again.";
        }
    }
}