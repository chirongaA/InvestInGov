<?php
//Declare the Bids namespace
namespace models;
//Include the database class
$directory = dirname(__FILE__);
$database = "$directory/database.class.php";
require_once($database);
//Import the database class
use models\Database;
?>

<?php
//Create the Bids class as a child class of the database class
//The bids class will be used to interact with the bids table in the database
class Bids extends Database{
    //The table name
    const TABLE_NAME = 'bids';
    //Members for the bids class
    private $username=null;
    private $bond_id=null;
    private $yield=null;
    private $facevalue=null;
    private $maturity=null;
    private $rate=null;
    //The bids id
    private $bid_id=null;
    
    //The constructor
    function __construct()
    {
        //Create a connection
        parent::__construct();
    }
    //Method to add a new bid to the database
    public function create($bid):bool
    {
        //Escape the bids data
        $username = $this->escape($bid['username']);
        $bond_id = $this->escape($bid['bond_id']);
        $yield = $this->escape($bid['yield']);
        $facevalue = $this->escape($bid['facevalue']);
        $maturity = $this->escape($bid['maturity']);
        $rate = $this->escape($bid['rate']);
        //Create the query
        $table_name = self::TABLE_NAME;
        $query = "INSERT INTO $table_name (username, bond_id, yield, facevalue, maturity, rate) VALUES ('$username', '$bond_id', '$yield','$facevalue', '$maturity', '$rate')";
        //Execute the query
        $exec=$this->query($query);
        if($exec)
        {
            //Return the last inserted id
            $this->bond_id=$this->lastInsertId();
            //Set Data
            $this->setData($bid);
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
        $this->facevalue = $data['facevalue'];
        $this->maturity = $data['maturity'];
        $this->rate = $data['rate'];
        return true;
    }
}
?>