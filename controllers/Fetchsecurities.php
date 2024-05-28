<?php
//Load the necessary classes
$directory = dirname(__FILE__);
$models = realpath("$directory/../models");
require_once("$models/securities.model.php");
?>

<?php
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

