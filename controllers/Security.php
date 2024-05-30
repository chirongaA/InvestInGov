<?php
use models\Securities; //Securities model
//check and see if all the data has been submitted
/*
[
    "bond_name":
    "b0nd_id":
    "face value":
    "maturity":
    "rate":
    "status":
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
//Create a new securities object
$security = new Securities();
//Create a new security
$create = $security->create($_POST);
if($create)
{
    echo json_encode(array("status"=>"success", "message"=>"Security posted successfully"));
    //Set http response code
    http_response_code(201);
}
else
{
    echo json_encode(array("status"=>"error", "message"=>"Security could not be posted"));
    //Set http response code
    http_response_code(500);
}