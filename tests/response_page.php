<?php
//https://arriving-carefully-dingo.ngrok-free.app/callback.php
//?OrderTrackingId=1c298d87-ef37-4e7c-ab33-de3dfccce94d
//&OrderMerchantReference=92582762768768274
// include 'accesstoken.php';
// $OrderTrackingId = $_GET['OrderTrackingId'];
// $OrderMerchantReference = $_GET['OrderMerchantReference'];
// if(APP_ENVIRONMENT == 'sandbox'){
//   $getTransactionStatusUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";
// }elseif(APP_ENVIRONMENT == 'live'){
//   $getTransactionStatusUrl = "https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";
// }else{
//   echo "Invalid APP_ENVIROMENT";
//   exit;
// }
// $headers = array(
//     "Accept: application/json",
//     "Content-Type: application/json",
//     "Authorization: Bearer $token"
// );
// $ch = curl_init($getTransactionStatusUrl);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// echo $response = curl_exec($ch);
// $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);
// $data = json_decode($response);

// //$transaction_status = $data->transaction_status;
$data=file_get_contents("../sth.json");
$data=json_decode($data);
$amount=$data->amount;
$confirmation_code=$data->confirmation_code;
$payment_status_description=$data->payment_status_description;

//To create a new transaction Object
$transaction=new stdClass();
$transaction->confirmation_code=$confirmation_code;
$transaction->amount=$amount;
$transaction->payment_status_description=$payment_status_description;

//Get the username, yield, phonenumber, bondid from the cookie
$username=$_COOKIE['username'];
$bond_id=$_COOKIE['bond_id'];
$phone=$_COOKIE['phonenumber'];
$yield=$_COOKIE['yield'];

//set the user details in the transaction object
$transaction->username=$username;
$transaction->bond_id=$bond_id;
$transaction->phonenumber=$phone;
$transaction->yield=$yield;

//To save the transaction object to the database
$payment=new Payments();
$exec=$payment->save($transaction);
if($exec){
    echo "Payment saved successfully";
}else{
    echo "Payment not saved";
}

