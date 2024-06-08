<?php
define('APP_ENVIRONMENT', 'live');

if(APP_ENVIRONMENT == 'sandbox'){
    $apiUrl = "https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken";
    $consumerKey = "";
    $consumerSecret = "";
}elseif(APP_ENVIRONMENT == 'live'){
    $apiUrl = "https://pay.pesapal.com/v3/api/Auth/RequestToken";
    $consumerKey = "xfatJSddoeXK5Hy0viKeU716Lx1HrtJU";
    $consumerSecret = "iuDF568STadhVxr6kiCnM0+L6G8=";
}else{
    echo "Invalid APP_ENVIRONMENT";
    exit();
}
$headers = [
    "Accept: application/json",
    "Content-Type: application/json"
];
$data = [
    "consumer_key" => $consumerKey,
    "consumer_secret" => $consumerSecret
];
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$data= json_decode($response);
$token= $data->token;