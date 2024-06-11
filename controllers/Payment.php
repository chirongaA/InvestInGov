<?php
use models\Payments;
//check and see if all the data has been submitted
/*
[
    "username":
    "b0nd_id":
    "phonenumber":
    "yield":
]
*/
//Loop through the data and check if all the data has been submitted
if(!isset($_POST) || empty($_POST))
{
    echo json_encode(array("status"=>"error", "message"=>"Please fill in all the fields"));
    exit();
}
foreach($_POST as $key => $value)
{
    if($value == null || $value == "")
    {
        echo json_encode(array("status"=>"error", "message"=>"Please fill in all the fields","$key"=>null));
        exit();
    }
}
//Create a new payments object
$payment = new Payments();
//Create a new payment
$create = $payment->create($_POST);
if($create)
{
    echo json_encode(array("status"=>"success", "message"=>"Payment request submitted successfully"));
    //Set http response code
    http_response_code(201);
}
else
{
    echo json_encode(array("status"=>"error", "message"=>"Bid could not be submitted"));
    //Set http response code
    http_response_code(500);
}

