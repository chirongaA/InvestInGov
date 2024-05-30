<?php
use models\Securities;
//Create a new securities object
$securities = new Securities();
$securities = $securities->fetchAll();
if($securities)
{
    echo json_encode(array("status"=>"success", "message"=>"Securities fetched successfully", "data"=>$securities));
    //Set http response code
    http_response_code(200);
}
else
{
    echo json_encode(array("status"=>"error", "message"=>"Securities could not be fetched"));
    //Set http response code
    http_response_code(500);
}

