<?php
//Include the database class
require_once './models/database.class.php';

//Create the Securities class as a child class of the database class
class Securities extends Database{
    //The table name
    const TABLE_NAME = 'securities';
    //Members for the securities class
    private $bond_id=null;
    private $bond_name=null;
    private $facevalue=null;
    private $maturity=null;
    private $rate=null;
    private $status=null;
    //The securities id
    private $security_id=null;
    
    //The constructor
    function __construct()
    {
        //Create a connection
        parent::__construct();
    }
    //Method to add a new security to the database
    public function create($security):bool
    {
        //Escape the securities data
        $bond_id = $this->escape($security['bond_id']);
        $bond_name = $this->escape($security['bond_name']);
        $facevalue = $this->escape($security['facevalue']);
        $maturity = $this->escape($security['maturity']);
        $rate = $this->escape($security['rate']);
        $status = $this->escape($security['status']);
        //Create the query
        $table_name = self::TABLE_NAME;
        $query = "INSERT INTO $table_name (bond_id, bond_name, facevalue, maturity, rate, status) VALUES ('$bond_id', '$bond_name','$facevalue', '$maturity', '$rate', '$status')";
        //Execute the query
        $exec=$this->query($query);
        if($exec)
        {
            //Return the last inserted id
            $this->security_id=$this->lastInsertId();
            //Set Data
            $this->setData($security);
            return true;
        }
        else
        {
            return false;
        }
    }
    //To set the data of the security
    private function setData($data):bool {
        $this->bond_id = $data['bond_id'];
        $this->bond_name = $data['bond_name'];
        $this->facevalue = $data['facevalue'];
        $this->maturity = $data['maturity'];
        $this->rate = $data['rate'];
        $this->status = $data['status'];
        return true;
    }
    //Method to fetch all records from the database
    public function fetchAll():array
    {
        $results=[];
        //Create the query
        $table_name = self::TABLE_NAME;
        $query = "SELECT * FROM $table_name";
        //Execute the query
        $exec=$this->query($query);
        //Fill the results array
        while($row = $exec->fetch_assoc())
        {
            $results[] = $row;
        }
        //Return the result
        return $results;
    }
}
?>