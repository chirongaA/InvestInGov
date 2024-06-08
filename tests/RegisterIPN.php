<?php
include 'accesstoken.php';

$ipnUrl = "https://arriving-carefully-dingo.ngrok-free.app/callback.php";

if (APP_ENVIRONMENT == 'sandbox') {
    $ipnRegistrationUrl = "https://cybqa.pesapal.com/pesapalv3/api/URLSetup/RegisterIPN";
} elseif (APP_ENVIRONMENT == 'live') {
    $ipnRegistrationUrl = "https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN";
} else {
    echo "Invalid APP_ENVIRONMENT";
    exit();
}
$headers = array(
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
);
$data = array(
    "url" => "$ipnUrl",
    "ipn_notification_type" => "POST"
);
$ch = curl_init($ipnRegistrationUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$data = json_decode($response);
$ipn_id = $data->ipn_id;
// ipn_url= $data->url;
