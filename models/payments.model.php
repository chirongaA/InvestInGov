<?php
//Declare the Payents namespace
namespace models;
use models\Database;
@session_start();

//Create the Payments class as a child class of the database class
//The payments class will be used to interact with the payments table in the database
class Payments extends Database{
    //The table name
    const TABLE_NAME = 'payments';
    //Members for the payments class
    private $username=null;
    private $bond_id=null;
    private $yield=null;
    private $phonenumber=null;
    //The payment id
    private $payment_id=null;
    
    //The constructor
    function __construct()
    {
        //Create a connection
        parent::__construct();
    }
    //Method to add a new payment to the database
    public function create($payment):bool
    {
        //Escape the bids data
        $username = $this->escape($payment['username']);
        $bond_id = $this->escape($payment['bond_id']);
        $yield = $this->escape($payment['yield']);
        $phonenumber = $this->escape($payment['phonenumber']);
        $_SESSION['phonenumber']=$phonenumber;
        $_SESSION['yield']=$yield;
        $_SESSION['username']=$username;
        $_SESSION['bond_id']=$bond_id;
        //Create the query
        $table_name = self::TABLE_NAME;
        $query = "INSERT INTO $table_name (username, bond_id, yield, phonenumber) VALUES ('$username', '$bond_id', '$yield','$phonenumber')";
        //Execute the query
        $exec=$this->query($query);
        if($exec)
        {
            //Return the last inserted id
            $this->bond_id=$this->lastInsertId();
            //Set Data
            $this->setData($payment);
            return true;
        }
        else
        {
            return false;
        }
    }
    //To set the data of the bid
    private function setData($data):bool {
        $this->username = $data['username'];
        $this->bond_id = $data['bond_id'];
        $this->yield = $data['yield'];
        $this->phonenumber = $data['phonenumber'];
        return true;
    }
}
?>