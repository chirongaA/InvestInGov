<?php
session_start();

$errors = array();
$errmsg = '';

$config = array(
    "env" => "sandbox",
    "BusinessShortCode" => "174379",
    "key" => "6LzluxGsY4i1jkec3HFTEDwZo9UuGLVg93dTMo9ijvWspEfF",
    "secret" => "wnIQiyBsum77BkALtAipXHdbvGW8AH6HAje5ekL7qppl7vHG4xM3GATGZdoHTPFg",
    "TransactionType" => "CustomerPaybillOnline",
    "passkey" => "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919",
    "CallBackURL" => "https://arriving-carefully-dingo.ngrok-free.app/tests/callback.php",
    "AccountReference" => "InvestInGov",
    "TransactionDesc" => "Bond Payment"
);

if (isset($_POST['phone_number'])) {
    
    $phone = $_POST['phone_number'];
    $bond_id = $_POST['bond_id'];
    $amount = 1;

    // Normalize phone number
    $phone = (substr($phone, 0, 1) == "+") ? str_replace("+", "", $phone) : $phone;
    $phone = (substr($phone, 0, 1) == "0") ? preg_replace("/^0/", "254", $phone) : $phone;
    $phone = (substr($phone, 0, 1) == "7") ? "254{$phone}" : $phone;

    // Get access token
    $token_url = ($config['env'] == "live") ? "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
    $credentials = base64_encode($config['key'] . ":" . $config['secret']);

    $ch = curl_init($token_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response);
    $token = isset($result->access_token) ? $result->access_token : "N/A";

    // Prepare STK Push request
    $timestamp = date('YmdHis');
    $password = base64_encode($config['BusinessShortCode'] . $config['passkey'] . $timestamp);

    $curl_post_data = array(
        'BusinessShortCode' => $config['BusinessShortCode'],
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => $config['TransactionType'],
        'Amount' => $amount,
        'PartyA' => $phone,
        'PartyB' => $config['BusinessShortCode'],
        'PhoneNumber' => $phone,
        'CallBackURL' => $config['CallBackURL'],
        'AccountReference' => $config['AccountReference'],
        'TransactionDesc' => $config['TransactionDesc']
    );

    $data_string = json_encode($curl_post_data);

    $endpoint = ($config['env'] == "live") ? "https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest" : "https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer " . $token, "Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    // Handle response
    if (!preg_match("/^[0-9]{10}+$/", $phone) && array_key_exists('errorMessage', $result)) {
        $errors['phone'] = $result['errorMessage'];
    }

    if (isset($result['ResponseCode']) && $result['ResponseCode'] === "0") {
        $MerchantRequestID = $result['MerchantRequestID'];
        $CheckoutRequestID = $result['CheckoutRequestID'];
        
        $conn = mysqli_connect("localhost", "root", "", "bonds");
        $username = $_SESSION['username']; // Ensure you have a username in session

        $sql = "INSERT INTO transactions (MerchantRequestID, CheckoutRequestID, Phone, Amount, bond_id, username) VALUES ('$MerchantRequestID', '$CheckoutRequestID', '$phone', '$amount', '$bond_id', '$username')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["MerchantRequestID"] = $MerchantRequestID;
            $_SESSION["CheckoutRequestID"] = $CheckoutRequestID;
            $_SESSION["phone"] = $phone;
            $_SESSION["bond_id"] = $bond_id;

            header("Location: confirm-payment.php");
            exit();
        } else {
            $errors['database'] = "Unable to initiate your order: " . $conn->error;
        }
    } else {
        $errors['mpesastk'] = $result['errorMessage'];
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            $errmsg .= $error . "<br>";
        }
    }
}
?>
