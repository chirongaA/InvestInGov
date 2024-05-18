<?php
//Load the necessary classes
require_once './models/bids.models.php'; //Bids model
?>

<?php
//check and see if all the data has been submitted
/*
[
    "username":
    "b0nd_id":
    "face value":
    "maturity":
    "rate":
    "yield":
]
*/
//Loop through the data and check if all the data has been submitted
foreach($_POST as $key => $value)
{
    if($value == null)
    {
        echo json_encode(array("status"=>"error", "message"=>"Please fill in all the fields","$key"=>null));
        return;
    }
}
//Create a new bids object
$bid = new Bids();
//Create a new bid
$create = $bid->create($_POST);
if($create)
{
    echo json_encode(array("status"=>"success", "message"=>"Bid submitted successfully"));
    //Set http response code
    http_response_code(201);
}
else
{
    echo json_encode(array("status"=>"error", "message"=>"Bid could not be submitted"));
    //Set http response code
    http_response_code(500);
}