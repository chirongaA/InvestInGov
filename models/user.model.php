<?php
//Include the database class
require_once './models/database.class.php';

//Create the User class as a child class of the database class
class User extends Database{
    //The table name
    const TABLE_NAME = 'users';
    //Members for the user class
    private $username=null;
    private $password=null;
    private $email=null;
    private $id_number=null;
    private $kra_pin_number=null;
    private $phone_number=null;
    private $full_name=null;
    //The user id
    private $user_id=null;
    
    //The constructor
    function __construct()
    {
        //Create a connection
        parent::__construct();
    }
    //Method to add a new user to the database
    public function create($user):bool
    {
        //Escape the user data
        $username = $this->escape($user['username']);
        $password = $this->escape($user['password']);
        $email = $this->escape($user['email']);
        $kra_pin_number = $this->escape($user['kra_pin_number']);
        $phone_number = $this->escape($user['phone_number']);
        $full_name = $this->escape($user['full_name']);
        $id_number=$this->escape($user['id_number']);
        //Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);
        $table_name = self::TABLE_NAME;
        //Create the query
        $query = "INSERT INTO $table_name (username, password, email,id_number, kra_pin, phone, full_name) VALUES ('$username', '$password', '$email','$id_number', '$kra_pin_number', '$phone_number', '$full_name')";
        //Execute the query
        $exec=$this->query($query);
        if($exec)
        {
            //Return the last inserted id
            $this->user_id=$this->lastInsertId();
            //Set Data
            $this->setData($user);
            return true;
        }
        else
        {
            return false;
        }
    }
    //To set the data of the user
    private function setData($data):bool {
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email'];
        $this->kra_pin_number = $data['kra_pin_number'];
        $this->phone_number = $data['phone_number'];
        $this->full_name = $data['full_name'];
        return true;
    }
}