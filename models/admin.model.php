<?php
namespace models;
//Include the database class
use models\Database;
//Create the User class as a child class of the database class
class Admin extends Database{
    //The table name
    const TABLE_NAME = 'admins';
    //Members for the admin class
    private $username=null;
    private $email=null;
    //The user id
    private $user_id=null;
    private $messages=[];
    
    //The constructor
    function __construct()
    {
        //Create a connection
        parent::__construct();
    }
    //Method to create a new Admin
    /**
     * @param string $email
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function create($email, $username,$password):bool
    {
        //Check if the admin exists
        if($this->exists($email))
        {
            return false;
        }
        //Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);
        //Create the query
        $table_name = self::TABLE_NAME;
        $query = "INSERT INTO $table_name (username, password, email) VALUES ('$username', '$password', '$email')";
        //Execute the query
        $exec=$this->query($query);
        if($exec)
        {
            //Return the last inserted id
            $this->user_id=$this->lastInsertId();
            //Set Data
            $data=["username"=>$username,"email"=>$email];
            $this->setData($data);
            return true;
        }
        else
        {
            return false;
        }
    }
    //Function to check if admin exists
    /**
     * @param string $email
     * @return bool
     */
    public function exists($email):bool
    {
        //Create the query
        $table_name = self::TABLE_NAME;
        $query = "SELECT * FROM $table_name WHERE email='$email'";
        //Execute the query
        $exec=$this->query($query);
        //Return the number of rows
        return $exec->num_rows > 0;
    }
    //To set the data of the user
    private function setData($data):bool {
        $this->username = $data['username'];
        $this->email = $data['email'];
        return true;
    }
    //To get messages
    public function messages():array
    {
        return $this->messages;
    }
    ###########Functions to verify the login credentials
    public function emailExists($email)
    {
         //Create the query
        $table_name = self::TABLE_NAME;
        $email=$this->escape($email);
        // Prepare a SQL statement
        $stmt = $this->query("SELECT * FROM $table_name WHERE email = '$email'");
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
    //To verify the user
    public function verifyUser($email, $password) {
        $table_name=self::TABLE_NAME;
        $email=$this->escape($email);
        $password=$this->escape($password);
        // Prepare a SQL statement
        $stmt = $this->query("SELECT * FROM $table_name WHERE email = '$email'");
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