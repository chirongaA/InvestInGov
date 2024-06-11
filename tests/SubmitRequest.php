<?php
session_start(); // Start the session at the beginning of the script
require_once  "../autoload.php"; //This is the file that contains the autoloader function
use models\Payments;
// Check if the form data is stored in the session
if(isset($_SESSION['phonenumber']) && isset($_SESSION['yield'])){
    $phone = $_SESSION['phonenumber'];
    $amount = $_SESSION['yield'];
} else {
    echo "Phone number or amount is not set in the session.";
    exit;
}
include 'RegisterIPN.php';
$merchantreference = rand(1, 1000000000000000000);
$phone = $phone;
$amount = $amount;
$callbackurl = "https://arriving-carefully-dingo.ngrok-free.app/tests/response_page.php";
$first_name = "Augustine";
$middle_name = "";
$last_name = "Chironga";
$email_address = "a.chironga52@gmail.com";
if(APP_ENVIRONMENT == 'sandbox'){
  $submitOrderUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest";
}elseif(APP_ENVIRONMENT == 'live'){
  $submitOrderUrl = "https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest";
}else{
  echo "Invalid APP_ENVIROMENT";
  exit;
}
$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
);

// Request payload
$data = array(
    "id" => "$merchantreference",
    "currency" => "KES",
    "amount" => $amount,
    "description" => "Payment description goes here",
    "callback_url" => "$callbackurl",
    "notification_id" => "$ipn_id",
    "billing_address" => array(
        "email_address" => "$email_address",
        "phone_number" => "$phone",
        "country_code" => "KE",
        "first_name" => "$first_name",
        "middle_name" => "$middle_name",
        "last_name" => "$last_name",
        "line_1" => "ChirongaLTD",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => "",
        "zip_code" => ""
    )
);
$ch = curl_init($submitOrderUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$data = json_decode($response);
$redirect_url = $data->redirect_url;
$username=$_SESSION['username'];
$bond_id=$_SESSION['bond_id'];
$phone=$_SESSION['phonenumber'];
$yield=$_SESSION['yield'];

// Save the payment order request into the data
$payment = new Payments();
//create an object to store the details
$request = new stdClass();
$request->username = $username;
$request->bond_id = $bond_id;
$request->yield = $yield;
$request->phone_number = $phone;
$request->order_tracking_id = $data->order_tracking_id;
$request->merchant_reference = $data->merchant_reference;
$req=$payment->saveRequest($request);
if(!$req){
    echo "Failed to save the payment request";
    exit;
}
else{
//echo "<a href= '$redirect_url'>Click here to pay</a>";
echo "<script>window.location.href='$redirect_url'</script>";
}
