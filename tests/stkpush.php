<?php
//Include the access token file
include 'accessToken.php';

date_default_timezone_set('Africa/Nairobi');
$processrequestUrl= 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl= 'https://arriving-carefully-dingo.ngrok-free.app/tests/callback.php';
$passkey= "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode='174379';
$Timestamp= date('YmdHis');
//encrypt the data sent to get the password
$Passsword = base64_encode($BusinessShortCode . $passkey . $Timestamp);
$phone = '254793704787';
$money ='1';
$PartyA = $phone;
$PartyB = '254708374149';
$AccountReference = 'InvestinGov';
$TransactionDesc = 'stkpush test';
$Amount = $money;  
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $access_token];

//Initiate cURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
$curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Passsword,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $callbackurl,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
echo $curl_response = curl_exec($curl);
  
$data = json_decode($curl_response);
$CheckoutRequestID = $data->CheckoutRequestID;
$ResponseCode = $data->ResponseCode;
if ($ResponseCode == "0") {
  echo "The CheckoutRequestID for this transaction is : " . $CheckoutRequestID;
}
else{
  echo "The transaction was not successful";
}