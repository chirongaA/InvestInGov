<?php
//Load the necessary classes
require_once './models/user.model.php'; //User model
use models\User; //User model
?>

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
//Create a new user object
$user = new User();
//Check if the passwords match
if($_POST['password'] != $_POST['confirm_password'])
{
    echo json_encode(array("status"=>"error", "message"=>"Passwords do not match"));
    return;
}
//Create a new user
$create = $user->create($_POST);
if($create)
{
    echo json_encode(array("status"=>"success", "message"=>"User created successfully"));
    //Set http response code
    http_response_code(201);
}
else
{
    echo json_encode(array("status"=>"error", "message"=>"User could not be created"));
    //Set http response code
    http_response_code(500);
}