<?php
require_once  "../autoload.php"; //This is the file that contains the autoloader function
//We load the autoloader file to load the Admin class since we will run this file outside the index.php file
use models\Payments;
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

//To save the transaction object to the database
$payment=new Payments();
$exec=$payment->save($transaction);
if($exec){
    echo "Payment saved successfully";
}else{
    echo "Payment not saved";
}

