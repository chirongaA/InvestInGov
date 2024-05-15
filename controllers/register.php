<?php
//check and see if all the data has been submitted
/*
[
    "email":
    "password":
    "confirm_password":
    "kra_pin_number":
    "phone_number":
    "full_name":
    "Username":
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