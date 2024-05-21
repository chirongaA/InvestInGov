<?php
// Include your database class
require_once './models/login.model.php';

class LoginModel extends Database {
    protected $conn;
    // Constructor
    public function __construct() {
        parent::__construct();
    }

    // Method to verify user credentials
    public function verifyUser($email, $password) {
        // Prepare a SQL statement
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

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
