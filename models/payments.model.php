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
        return true;
    }
    //To set the data of the bid
    private function setData($data):bool {
        $this->username = $data['username'];
        $this->bond_id = $data['bond_id'];
        $this->yield = $data['yield'];
        $this->phonenumber = $data['phonenumber'];
        return true;
    }
    //Method to enter the payment details into the database
    public function save($paymentInfo)
    {
        //Escape the payment data
        $payment_status_description = $this->escape($paymentInfo->payment_status_description);
        $confirmationCode=$this->escape($paymentInfo->confirmation_code);
        $username =$this->escape($paymentInfo->username);
        $bond_id = $this->escape($paymentInfo->bond_id);
        $yield = $this->escape($paymentInfo->yield);
        $phonenumber = $this->escape($paymentInfo->phonenumber);
        //The query to insert the payment details into the database
        $query = "INSERT INTO payments (username, bond_id, yield, phonenumber,payment_status_description, confirmation_code) VALUES ('$username', '$bond_id', '$yield', '$phonenumber', '$payment_status_description' , '$confirmationCode')";
        //Execute the query
        $result = $this->query($query);
        //check if the query was successful
        if($result){
            return true;
        }else{
            return false;
        }
    }
    //Method to save an intermediary payment into the database
    public function saveRequest($request)
    {
        //The query to insert the payment details into the database
        $query = "INSERT INTO payments_tracking (username, bond_id, yield, phone_number,order_tracking_id,merchant_reference) VALUES ('$request->username', '$request->bond_id', '$request->yield', '$request->phone_number','$request->order_tracking_id','$request->merchant_reference')";
        //Execute the query
        $result = $this->query($query);
        //check if the query was successful
        if($result){
            return true;
        }else{
            return false;
        }
    }

    //Function to fetch the request by a given order_tracking_id
    public function fetchRequest($order_tracking_id)
    {
        //The query to fetch the payment details from the database
        $query = "SELECT * FROM payments_tracking WHERE order_tracking_id = '$order_tracking_id'";
        //Execute the query
        $result = $this->query($query);
        //check if the query was successful
        if($result){
            return $result->fetch_assoc();
        }else{
            return false;
        }
    }
}
?>