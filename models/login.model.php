<?php
// Include your database class
require_once './models/database.class.php';

class LoginModel extends Database {
    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // Method to verify user credentials
    public function emailExists($email)
    {
        $email=$this->escape($email);
        // Prepare a SQL statement
        $stmt = $this->query("SELECT * FROM users WHERE email = '$email'");
       // Get the result
        $result = $stmt;
        // Check if a user was found
        if ($result->num_rows > 0) {
                return true;
        } else {
            // No user was found with this email address
            return false;
        }
    }

    public function verifyUser($email, $password) {
        $email=$this->escape($email);
        $password=$this->escape($password);
        // Prepare a SQL statement
        $stmt = $this->query("SELECT * FROM users WHERE email = '$email'");
        // Get the result
        $result = $stmt;
        // Check if a user was found
        if ($result->num_rows > 0) {
            // Get the user data
            $user = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct
                return true;
            } else {
                // Password is incorrect
                return false;
            }
        } else {
            // No user was found with this email address
            return false;
        }
    }
}
?>
