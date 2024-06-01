<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = $_GET['username'];
    $bond_id = $_GET['bond_id'];
    $yield = $_GET['yield'];
    $phonenumber = $_GET['phonenumber'];

    // Ensure the phone number is in the correct format
    $phonenumber = preg_replace('/\D/', '', $phonenumber);

    if (substr($phonenumber, 0, 1) == '0') {
        $phonenumber = '254' . substr($phonenumber, 1);
    }

    if (!preg_match('/^2547\d{8}$/', $phonenumber)) {
        die('Invalid phone number format. Please use the format 07XXXXXXXX or 2547XXXXXXXX.');
    }

    // Debug: Log the transaction details
    error_log("Initiating transaction for amount: $yield, Phone number: $phonenumber");

    // Your M-Pesa API credentials
    $consumerKey = '6LzluxGsY4i1jkec3HFTEDwZo9UuGLVg93dTMo9ijvWspEfF';
    $consumerSecret = 'wnIQiyBsum77BkALtAipXHdbvGW8AH6HAje5ekL7qppl7vHG4xM3GATGZdoHTPFg';
    $BusinessShortCode = '174379';
    $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $TransactionDesc = 'Bond Payment';
    $AccountReference = 'BondRef';

    // Access token request
    $headers = ['Content-Type:application/json; charset=utf8'];
    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_HEADER, FALSE);
    curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
    $result = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);

    if ($status != 200) {
        die('Error fetching access token: HTTP status ' . $status . ' - ' . $result);
    }

    $result = json_decode($result);

    if (!isset($result->access_token)) {
        die('Error: access token not found in the response: ' . print_r($result, true));
    }

    $access_token = $result->access_token;

    // Initiate transaction
    $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $Timestamp = date('YmdHis');
    $Password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $Timestamp);
    $CallBackURL = 'https://arriving-carefully-dingo.ngrok-free.app/callback.php';

    $data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $yield,  // or other relevant amount
        'PartyA' => $phonenumber,
        'PartyB' => $BusinessShortCode,
        'PhoneNumber' => $phonenumber,
        'CallBackURL' => $CallBackURL,
        'AccountReference' => $AccountReference,
        'TransactionDesc' => $TransactionDesc
    );

    $data_string = json_encode($data);

    $curl = curl_init($initiate_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer ' . $access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ($curl_response === false) {
        echo 'Curl error: ' . curl_error($curl) . "<br>";
    } elseif ($status != 200) {
        echo "HTTP request failed with status code: " . $status . "<br>Response: " . $curl_response . "<br>";
    } else {
        $response = json_decode($curl_response, true);
        if (isset($response['CheckoutRequestID'])) {
            $checkoutRequestID = $response['CheckoutRequestID'];
            echo "Transaction Response: " . $curl_response . "<br>";

            // Save CheckoutRequestID in the database
            $sql = "UPDATE payments SET CheckoutRequestID='$checkoutRequestID' WHERE username='$username' AND bond_id='$bond_id' AND payment_status='pending'";
            if ($conn->query($sql) === TRUE) {
                echo "CheckoutRequestID saved successfully.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error in response: " . $curl_response . "<br>";
        }
    }
} else {
    echo "Invalid request method.";
}
?>
