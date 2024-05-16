<?php
//Include the database class
require_once './models/database.class.php';

//Create the User class as a child class of the database class
class User extends Database{
    //The table name
    const TABLE_NAME = 'bids';
    //Members for the user class
    private $username=null;
    private $bond_id=null;
    private $yield=null;
    private $phone_number=null;
    
    
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
        $password = $this->escape($user['bond_id']);
        $email = $this->escape($user['yield']);
        $phone_number = $this->escape($user['phone_number']);
        //Create the query
        $query = "INSERT INTO $table_name (username, bond_id, yield, phone_number) VALUES ('$username', '$bond', '$email','$id_number', '$kra_pin_number', '$phone_number', '$full_name')";
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