<?php
//Mpesa API keys
$consumerKey = "6LzluxGsY4i1jkec3HFTEDwZo9UuGLVg93dTMo9ijvWspEfF";
$consumerSecret = "wnIQiyBsum77BkALtAipXHdbvGW8AH6HAje5ekL7qppl7vHG4xM3GATGZdoHTPFg";
//access token url
$access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
$headers=['Content-Type:application/json; charset=utf8'];
//Initiate cURL.
$curl= curl_init($access_token_url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_HEADER, FALSE);
curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
$result= curl_exec($curl);
$status= curl_getinfo($curl, CURLINFO_HTTP_CODE);
 
$result = json_decode($result);
echo $access_token = $result->access_token;
curl_close($curl);
